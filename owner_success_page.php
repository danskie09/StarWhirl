<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Success</title>
</head>
<body>
    <h2>Transaction Successful!</h2>

    <?php
include('dbcon.php');

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



    // Retrieve the tracking number from the URL
    $trackingNumber = $_GET['trackingNumber'] ?? 'N/A';
    $trackingSql = "SELECT * FROM trackings WHERE trackingNumber = '$trackingNumber'";
    $trackingResult = $conn->query($trackingSql);

    if ($trackingResult->num_rows > 0) {
        $trackingRow = $trackingResult->fetch_assoc();
        $status = $trackingRow["status"];
        $transactionId = $trackingRow["transaction_id"];


        // Query to fetch transaction information based on transaction_id
        $transactionSql = "SELECT *, numberofLoads as loads, numberofClothing as clothing FROM transactions WHERE transaction_id = '$transactionId'";


        $transactionResult = $conn->query($transactionSql);
      
       
    
    
    echo "<p>Your transaction was successful. Tracking Number: $trackingNumber</p>";

    if ($transactionResult->num_rows > 0) {
        $transactionRow = $transactionResult->fetch_assoc();
        $insertPaymentSql = "INSERT INTO payments (transaction_id) VALUES ('$transactionId')";
        if ($conn->query($insertPaymentSql) === TRUE) {
            // Retrieve the payment_id
            $paymentId = $conn->insert_id;
    
            // Display payment_id in the receipt
           
    
            // Rest of your existing code for displaying transaction details
        } else {
            echo "Error inserting payment: " . $conn->error;
        }

        

// Check if keys exist before accessing them
echo isset($transactionRow["service_id"]) ? "<p>Service: " . getServiceName($conn, $transactionRow["service_id"]) . "</p>" : "";
echo isset($transactionRow["timeOfDropOff"]) ? "<p>Time of Drop Off: " . $transactionRow["timeOfDropOff"] . "</p>" : "";
echo !empty(trim($transactionRow["loads"])) ? "<p>Number of Loads: " . $transactionRow["loads"] . "</p>" : "<p>Number of Loads not available</p>";
echo !empty(trim($transactionRow["clothing"])) ? "<p>Number of Clothing: " . $transactionRow["clothing"] . "</p>" : "<p>Number of Clothing not available</p>";
echo isset($transactionRow["paymentStatus"]) ? "<p>Payment Status: " . $transactionRow["paymentStatus"] . "</p>" : "";
echo isset($transactionRow["totalCost"]) ? "<p>Total Cost: " . $transactionRow["totalCost"] . "</p>" : "";
echo isset($transactionRow["detergent_id"]) ? "<p>Detergent Details: " . getDetergent($conn, $transactionRow["detergent_id"]) . "</p>" : "";

echo isset($transactionRow["fabric_softener_id"]) ? "<p>Fabric Softener Details: " . getFabric($conn, $transactionRow["fabric_softener_id"]) . "</p>" : "";



    } else {
        echo "Error: Transaction not found.";
    }
} else {
    echo "Error: Tracking number not found.";
}

    

    
    ?>

    <p>Thank you for using our services.</p>

    <a href="owner_dashboard.php">Back to Home</a>
    <br>
    <button onclick="returnToForm()">Add Transaction for Existing Customers</button>
    <button onclick="returnToForm2()">Add Transaction for New Customers</button>
    <button onclick="printReceipt()">Print Receipt</button>
    <script>
        // Retrieve the tracking number from the URL
        var trackingNumber = "<?php echo $trackingNumber; ?>";
        
        // Check if the tracking number is not empty or 'N/A'
        if (trackingNumber !== '' && trackingNumber !== 'N/A') {
            // Retrieve the transaction ID and payment ID from the URL
            var transactionId = "<?php echo $transactionId; ?>";
            var paymentId = "<?php echo $paymentId; ?>";
            
            function returnToForm() {
                // Redirect the user back to the form page
                window.location.href = "owner_insert_transactions.php";
            }

            function returnToForm2() {
                // Redirect the user back to the form page
                window.location.href = "owner_new_customer_transactions.php";
            }

            function printReceipt() {
                // Open the generate_receipt.php script in a new window to generate the PDF
                window.open('generate_receipt.php?transactionId=' + transactionId + '&trackingNumber=' + trackingNumber + '&paymentId=' + paymentId, '_blank');
            }
        } else {
            alert('Error: Tracking number not found.');
        }
    </script>
</body>
</html>



    
