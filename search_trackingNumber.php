<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
</head>
<body>

<?php
include('dbcon.php');
// Replace these variables with your actual database credentials

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


// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $trackingNumber = $_POST["trackingNumber"];

    // Query to fetch tracking information based on trackingNumber
    $trackingSql = "SELECT * FROM trackings WHERE trackingNumber = '$trackingNumber'";
    $trackingResult = $conn->query($trackingSql);

    if ($trackingResult->num_rows > 0) {
        $trackingRow = $trackingResult->fetch_assoc();
        $status = $trackingRow["status"];
        $transactionId = $trackingRow["transaction_id"];

        // Query to fetch transaction information based on transaction_id
        $transactionSql = "SELECT *, numberofLoads as loads, numberofClothing as clothing FROM transactions WHERE transaction_id = '$transactionId'";


        $transactionResult = $conn->query($transactionSql);
      
        if ($transactionResult->num_rows > 0) {
            $transactionRow = $transactionResult->fetch_assoc();

            
// Display transaction and tracking information
echo "<h2>Transaction Details</h2>";
echo "<p>Tracking Number: $trackingNumber</p>";
echo "<p>Status: $status</p>";

// Check if keys exist before accessing them
echo isset($transactionRow["service_id"]) ? "<p>Service: " . getServiceName($conn, $transactionRow["service_id"]) . "</p>" : "";
echo isset($transactionRow["timeOfDropOff"]) ? "<p>Time of Drop Off: " . $transactionRow["timeOfDropOff"] . "</p>" : "";
echo !empty(trim($transactionRow["loads"])) ? "<p>Number of Loads: " . $transactionRow["loads"] . "</p>" : "<p>Number of Loads not available</p>";
echo !empty(trim($transactionRow["clothing"])) ? "<p>Number of Clothing: " . $transactionRow["clothing"] . "</p>" : "<p>Number of Clothing not available</p>";
echo isset($transactionRow["paymentStatus"]) ? "<p>Payment Status: " . $transactionRow["paymentStatus"] . "</p>" : "";
echo isset($transactionRow["detergent_id"]) ? "<p>Detergent Details: " . getDetergent($conn, $transactionRow["detergent_id"]) . "</p>" : "";
echo isset($transactionRow["fabric_softener_id"]) ? "<p>Fabric Softener Details: " . getFabric($conn, $transactionRow["fabric_softener_id"]) . "</p>" : "";

echo isset($transactionRow["totalCost"]) ? "<p>Total Cost: " . $transactionRow["totalCost"] . "</p>" : "";

        } else {
            echo "Error: Transaction not found.";
        }
    } else {
        echo "Error: Tracking number not found.";
    }
}
?>

<h2>Customer Dashboard</h2>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="trackingNumber">Enter Tracking Number:</label>
    <input type="text" name="trackingNumber" required>
    <input type="submit" value="Search">
</form>
<a href="customer_dashboard.php">Back to Home</a>
</body>
</html>
