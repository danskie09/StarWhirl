<?php
include('dbcon.php');
session_start();

if (!isset($_SESSION['staff_id'])) {
    header("Location: staff_login.php");
    exit();
}
function getServiceName($conn, $service_id) {
    $serviceSql = "SELECT serviceName FROM services WHERE service_id = '$service_id'";
    $serviceResult = $conn->query($serviceSql);

    if ($serviceResult) {
        // Check if any rows are returned
        if ($serviceResult->num_rows > 0) {
            $serviceRow = $serviceResult->fetch_assoc();
            return $serviceRow["serviceName"];
        } else {
            return "Service not found";
        }
    } else {
        // Handle query error
        return "Error fetching service name: " . $conn->error;
    }
}

function getDetergent($conn, $detergent_id) {
    $detergentSql = "SELECT detergent_name FROM detergents WHERE detergent_id = '$detergent_id'";
    $detergentResult = $conn->query($detergentSql);

    if ($detergentResult) {
        // Check if any rows are returned
        if ($detergentResult->num_rows > 0) {
            $detergentRow = $detergentResult->fetch_assoc();
            return $detergentRow["detergent_name"];
        } else {
            return "Detergent not found";
        }
    } else {
        // Handle query error
        return "Error fetching detergent name: " . $conn->error;
    }
}

function getFabric($conn, $fabric_softener_id) {
    $fabricSql = "SELECT fabric_softener_name FROM fabric_softeners WHERE fabric_softener_id = '$fabric_softener_id'";
    $fabricResult = $conn->query($fabricSql);

    if ($fabricResult) {
        // Check if any rows are returned
        if ($fabricResult->num_rows > 0) {
            $fabricRow = $fabricResult->fetch_assoc();
            return $fabricRow["fabric_softener_name"];
        } else {
            return "Fabric Softener not found";
        }
    } else {
        // Handle query error
        return "Error fetching fabric softener name: " . $conn->error;
    }
}



$transaction_id = null;

// Check if the transaction_id is present in the URL (GET request)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['transaction_id'])) {
    $transaction_id = $_GET['transaction_id'];

    // Fetch transaction details from the database
    $query = "SELECT 
    transactions.*,numberofLoads as loads, numberofClothing as clothing,
    trackings.trackingNumber,
    payments.payment_id,
    customers.firstname AS customer_firstname,
    customers.lastname AS customer_lastname,
    staffs.firstname AS staff_firstname,
    staffs.lastname AS staff_lastname,
    
    services.serviceName
  FROM transactions
  INNER JOIN trackings ON transactions.transaction_id = trackings.transaction_id
  LEFT JOIN payments ON transactions.transaction_id = payments.transaction_id
  LEFT JOIN customers ON transactions.customer_id = customers.customer_id
  LEFT JOIN staffs ON transactions.staff_id = staffs.staff_id
  LEFT JOIN services ON transactions.service_id = services.service_id
  JOIN detergents ON transactions.detergent_id = detergents.detergent_id
        JOIN  fabric_softeners ON transactions.fabric_softener_id = fabric_softeners.fabric_softener_id
  WHERE transactions.transaction_id = $transaction_id";

    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $transaction = $result->fetch_assoc();
    } else {
        echo "Transaction not found.";
        exit();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['transaction_id'])) {
    // Handle form submission to update the database
    $transaction_id = $_POST['transaction_id'];
    $total_amount = $_POST['totalCost'];
    $change_amount = $_POST['changeAmount'];
    $amount_tendered = $_POST['tenderedAmount'];
    $payment_status = $_POST['payment_status']; // Added line to retrieve payment status

    // Perform the update query here
    $update_query = "UPDATE transactions SET totalCost = $total_amount, changeAmount = $change_amount, tenderedAmount = $amount_tendered, paymentStatus = '$payment_status' WHERE transaction_id = $transaction_id";

    if ($conn->query($update_query) === TRUE) {
        $redirect_url = "payLater_success.php?transaction_id={$transaction_id}";
    header("Location: " . $redirect_url);
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaction</title>
</head>
<body>
    <h2>Edit Transaction</h2>

    <form method="POST" action="">
        <input type="hidden" name="transaction_id" value="<?php echo $transaction_id; ?>">
        <label for="payment_status">Payment Status:</label>
        <select name="payment_status" required>
           
            <option value="Paid" <?php echo ($transaction['paymentStatus'] == 'Paid') ? 'selected' : ''; ?>>Paid</option>
        </select>
        <p><strong>Tracking Number:</strong> <?php echo $transaction['trackingNumber']; ?></p>
        <p><strong>Payment ID:</strong> <?php echo $transaction['payment_id']; ?></p>
        <!-- Additional Information Display -->
        <p><strong>Customer Name:</strong> <?php echo $transaction['customer_firstname']." ".$transaction['customer_lastname']; ?></p>
        <p><strong>Service:</strong> <?php echo getServiceName($conn, $transaction['service_id']); ?></p>

        <p><strong>Time of Drop-Off:</strong> <?php echo $transaction['timeOfDropOff']; ?></p>
        
        <p><strong>Number of Loads:</strong> <?php echo $transaction['loads']; ?></p>
        <p><strong>Number of Clothing Per Load:</strong> <?php echo $transaction['clothing']; ?></p>
        <p><strong>Detergent Details:</strong> <?php echo getDetergent($conn, $transaction['detergent_id']); ?></p>
        <p><strong>Fabric Softener Details:</strong> <?php echo  getFabric($conn, $transaction['fabric_softener_id']); ?></p>

        <!-- Existing Form Inputs -->
        <label for="total_amount">Total Amount:</label>
        <input type="number" name="totalCost" id="totalCost" value="<?php echo $transaction['totalCost']; ?>" readonly>
        <br>

        <label for="amount_tendered">Amount Tendered:</label>
        <input type="number" name="tenderedAmount" name="tenderedAmount" id="tenderedAmount" oninput="calculateTotalAmount()" value="<?php echo $transaction['tenderedAmount']; ?>" required>
        <br>



        <label for="change_amount">Change Amount:</label>
        <input type="number" name="changeAmount" id="changeAmount" value="<?php echo $transaction['changeAmount']; ?>" readonly>
        <br>

        

        <!-- Display tracking number and payment ID -->
        

        <!-- Added input for payment status -->
        
        <br>

        <input type="submit" value="Update">
    </form>

    <br>
    <a href="unpaid_transactions.php">Back to Unpaid Transactions</a>
    <script>
function calculateTotalAmount(){
    var tendered = document.getElementById("tenderedAmount").value;
    var total = document.getElementById("totalCost").value;

    var totalAmount = tendered - total;
    document.getElementById('changeAmount').value = totalAmount.toFixed(2);



}


    </script>
</body>
</html>


<?php
$conn->close();
?>
