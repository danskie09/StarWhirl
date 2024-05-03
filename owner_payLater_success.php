<?php
include('dbcon.php');
session_start();

if (!isset($_SESSION['owner_id'])) {
    header("Location: owner_login.php");
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
    
    services.serviceName,
    detergents.detergent_name,
               fabric_softeners.fabric_softener_name
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
} 
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Page</title>
</head>
<body>
    <h2>Transaction Updated Successfully</h2>
    <p><strong>Transaction ID:</strong> <?php echo $transaction['transaction_id']; ?></p>
    <p><strong>Tracking Number:</strong> <?php echo $transaction['trackingNumber']; ?></p>
        <p><strong>Payment ID:</strong> <?php echo $transaction['payment_id']; ?></p>
    <p><strong>Customer Name:</strong> <?php echo $transaction['customer_firstname']." ".$transaction['customer_lastname']; ?></p>
        <p><strong>Service:</strong> <?php echo getServiceName($conn, $transaction['service_id']); ?></p>
        

        <p><strong>Time of Drop-Off:</strong> <?php echo $transaction['timeOfDropOff']; ?></p>
        
        <p><strong>Number of Loads:</strong> <?php echo $transaction['loads']; ?></p>
        <p><strong>Number of Clothing Per Load:</strong> <?php echo $transaction['clothing']; ?></p>
        <p><strong>Detergent Details:</strong> <?php echo getDetergent($conn, $transaction['detergent_id']); ?></p>
        <p><strong>Fabric Softener Details:</strong> <?php echo getFabric($conn, $transaction['fabric_softener_id']); ?></p>
        <p><strong>Total Cost:</strong> <?php echo $transaction['totalCost']; ?></p>
        <p><strong>Amount Tendered:</strong> <?php echo $transaction['tenderedAmount']; ?></p>
        <p><strong>Change:</strong> <?php echo $transaction['changeAmount']; ?></p>
    
        <form action="generateReceipt.php" method="get" target="_blank">
        <!-- Add hidden input fields to pass necessary data to the receipt generation script -->
        <input type="hidden" name="transactionId" value="<?php echo $transaction['transaction_id']; ?>">
        <input type="hidden" name="trackingNumber" value="<?php echo $transaction['trackingNumber']; ?>">
        <input type="hidden" name="paymentId" value="<?php echo $transaction['payment_id']; ?>">
        <input type="hidden" name="customer_firstname" value="<?php echo $transaction['customer_firstname']; ?>">
        <input type="hidden" name="customer_lastname" value="<?php echo $transaction['customer_lastname']; ?>">
        <input type="hidden" name="service_id" value="<?php echo getServiceName($conn, $transaction['service_id']); ?>">
        <input type="hidden" name="detergent_id" value="<?php echo getDetergent($conn, $transaction['detergent_id']); ?>">
        <input type="hidden" name="fabric_softener_id" value="<?php echo getFabric($conn, $transaction['fabric_softener_id']); ?>">

        <!-- Button to trigger receipt generation -->
        <button type="submit" name="generateReceipt" href="owner_generateReceipt.php">Generate Receipt</button>
    </form>
    <br>
    <a href="owner_UnpaidTransactions.php">Back to Ongoing Transactions</a>
    <a href="owner_dashboard.php">Back to Dashboard</a>
    

    
</body>
</html>
