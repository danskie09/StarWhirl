



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }

        h2, p {
            margin: 0;
            padding: 5px;
        }

        #transaction-container {
            text-align: center;
            border: 1px solid #ccc;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin-top: 20px;
        }

        form {
            margin-top: 20px;
        }

        #finish-button {
            margin-top: 20px;
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        #finish-button:hover {
            background-color: #45a049;
        }

        a {
            text-decoration: none;
            color: #333;
            margin: 0 10px;
        }

        a:hover {
            color: #000;
        }
    </style>
</head>
<body>
<?php  
include('dbcon.php');
// Replace these variables with your actual database credentials

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php"); // Redirect to your login page
    exit();
}

$admin_id = $_SESSION['admin_id'];
$sql = "SELECT firstname, lastname FROM admin WHERE admin_id = $admin_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $admin_firstname = $row['firstname'];
    $admin_lastname = $row['lastname'];
} else {
    // Handle the case where owner data is not found
    $admin_firstname = 'Unknown';
    $admin_lastname = 'Unknown';
}



// Create connection


// $staff_id = $_SESSION['staff_id'];
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





















// Fetch staff's data from the database
// $sql = "SELECT firstname, lastname FROM staffs WHERE staff_id = $staff_id";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//     $row = $result->fetch_assoc();
//     $staff_firstname = $row['firstname'];
//     $staff_lastname = $row['lastname'];
// } else {
//     // Handle the case where staff data is not found
//     $staff_firstname = 'Unknown';
//     $staff_lastname = 'Unknown';
// }

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if trackingNumber is set before using it
    if (isset($_POST["trackingNumber"])) {
        $trackingNumber = $_POST["trackingNumber"];

        // Query to fetch tracking information based on trackingNumber
        $trackingSql = "SELECT * FROM trackings WHERE trackingNumber = '$trackingNumber'";
        $trackingResult = $conn->query($trackingSql);

        if ($trackingResult->num_rows > 0) {
            $trackingRow = $trackingResult->fetch_assoc();
            $status = $trackingRow["status"];
            $transactionId = $trackingRow["transaction_id"];

            // Query to fetch transaction information based on transaction_id
            $transactionSql = "SELECT t.*, c.firstname AS customer_firstname, c.lastname AS customer_lastname , numberofLoads as loads, numberofClothing as clothing
                    FROM transactions t
                    JOIN customers c ON t.customer_id = c.customer_id
                    WHERE t.transaction_id = '$transactionId'";
$transactionResult = $conn->query($transactionSql);

if ($transactionResult->num_rows > 0) {
    $transactionRow = $transactionResult->fetch_assoc();

    // Display transaction and tracking information
    echo "<div id='transaction-container'>";
    echo "<h2>Transaction Details</h2>";
    echo "<p>Tracking Number: $trackingNumber</p>";
    echo "<p>Status: $status</p>";

    // Display customer's first name and last name
    echo "<p>Customer Name: " . $transactionRow["customer_firstname"] . " " . $transactionRow["customer_lastname"] . "</p>";

    // Check if keys exist before accessing them
    echo isset($transactionRow["service_id"]) ? "<p>Service: " . getServiceName($conn, $transactionRow["service_id"]) . "</p>" : "";
    echo isset($transactionRow["timeOfDropOff"]) ? "<p>Time of Drop Off: " . $transactionRow["timeOfDropOff"] . "</p>" : "";
    echo isset($transactionRow["loads"]) ? "<p>Number of Loads: " . $transactionRow["loads"] . "</p>" : "";
    echo isset($transactionRow["clothing"]) ? "<p>Number of Clothing : " . $transactionRow["clothing"] . "</p>" : "";
    echo isset($transactionRow["paymentStatus"]) ? "<p>Payment Status: " . $transactionRow["paymentStatus"] . "</p>" : "";
    echo isset($transactionRow["totalCost"]) ? "<p>Total Cost: " . $transactionRow["totalCost"] . "</p>" : "";
    echo isset($transactionRow["detergent_id"]) ? "<p>Detergent Details: " . getDetergent($conn, $transactionRow["detergent_id"]) . "</p>" : "";

echo isset($transactionRow["fabric_softener_id"]) ? "<p>Fabric Softener Details: " . getFabric($conn, $transactionRow["fabric_softener_id"]) . "</p>" : "";


    // Add the "Finish" button and form
    echo "<form method='post' action='".$_SERVER["PHP_SELF"]."'>";
    echo "<input type='hidden' name='transactionId' value='$transactionId'>";
    echo "<input type='submit' name='finishTransaction' value='Finish' id='finish-button'>";
    echo "</form>";
    echo "</div>";

            } else {
                echo "Error: Transaction not found.";
            }
        } else {
            echo "Error: Tracking number not found.";
        }
    }
}

// Handle finishing transaction
// Handle finishing transaction
if (isset($_POST["finishTransaction"])) {
    $transactionId = $_POST["transactionId"];

    // Update the tracking status to "finished" in the database
    $updateStatusSql = "UPDATE trackings SET status = 'Finished' WHERE transaction_id = '$transactionId'";
    if ($conn->query($updateStatusSql) === TRUE) {
        // Retrieve customer_id and trackingNumber from the transaction data
        $transactionDataSql = "SELECT t.customer_id, tk.trackingNumber
                               FROM transactions t
                               JOIN trackings tk ON t.transaction_id = tk.transaction_id
                               WHERE t.transaction_id = '$transactionId'";
        $transactionDataResult = $conn->query($transactionDataSql);

        if ($transactionDataResult->num_rows > 0) {
            $transactionDataRow = $transactionDataResult->fetch_assoc();
            $customer_id = $transactionDataRow['customer_id'];
            $trackingNumber = $transactionDataRow['trackingNumber'];
            

            // Insert a notification for the customer
            $insertNotificationSql = "INSERT INTO notifications (customer_id, transaction_id, message, status)
                                      VALUES ('$customer_id', '$transactionId', 'Your laundry is finished with tracking number: $trackingNumber', 'Unread')";
            $conn->query($insertNotificationSql);

            echo "Transaction finished successfully.";
        } else {
            echo "Error retrieving transaction data.";
        }
    } else {
        echo "Error updating transaction status: " . $conn->error;
    }
}


?>
<h2>Admin Dashboard: <?php echo $admin_firstname . ' ' . $admin_lastname; ?></h2>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="trackingNumber">Enter Tracking Number:</label>
    <input type="text" name="trackingNumber" required>
    <input type="submit" value="Search">
</form>



<a href="admin_transaction_selection.php">Insert a Transaction</a>  <br>
<a href="admin_staff_signup.php">Add Staff</a><br>
<a href="admin_viewStaff.php">View All Staff</a><br>
<a href="admin_viewCustomer.php">View All Customer</a><br>
    <a href="admin_view_all_transactions.php">View all transactions</a><br>
    <a href="admin_ongoingTransactions.php">Ongoing Transactions</a>  <br>
    <a href="admin_unpaidTransactions.php">Unpaid Transactions</a>  <br>
    <a href="admin_stock_process.php">Add Stocks</a>  <br>
    <a href="admin_view_stocks.php">View Stocks</a>   <br>
    <a href="admin_update_lpg.php">Update LPG</a>  <br>
    <a href="admin_view_lpg.php">View LPG Status</a>  <br>
    <a href="admin_sales_history.php">Sales History</a>  <br>
    
    <a href="admin_schedule.php">Schedule Maintenance</a> <br>

    <a href="admin_logout.php">Logout</a>
</body>
</html>
