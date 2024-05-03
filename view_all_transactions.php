
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=a, initial-scale=1.0">
    <title>View  All Transactions</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<form method="GET" action="">
        <label for="trackingNumber">Search by Tracking Number:</label>
        <input type="text" id="trackingNumber" name="trackingNumber">
        <input type="submit" value="Search">
    </form>


<?php
include('dbcon.php');
// Replace these variables with your actual database credentials


// Assume you have a session variable storing the current customer's ID
// Make sure to start the session before using session variables
session_start();

// Check if staff is logged in, if not, redirect to login page

 // Adjust this line based on how you store customer information in the session

// Fetch transactions data for the current customer from the database
if (isset($_GET['trackingNumber'])) {
    $trackingNumber = $_GET['trackingNumber'];
    $sql = "SELECT transactions.transaction_id, 
                   customers.firstname AS customer_firstname,
                   customers.lastname AS customer_lastname,
                   staffs.firstname AS staff_firstname,
                   staffs.lastname AS staff_lastname,
                   transactions.timeOfDropOff,
                   services.serviceName,
                   transactions.numberofLoads,
                   transactions.numberofClothing,
                   detergents.detergent_name,
                   fabric_softeners.fabric_softener_name,
                   trackings.trackingNumber,
                   trackings.status,
                   transactions.totalCost,
                   transactions.paymentStatus
            FROM transactions
            JOIN customers ON transactions.customer_id = customers.customer_id
            JOIN staffs ON transactions.staff_id = staffs.staff_id
            INNER JOIN services ON transactions.service_id = services.service_id
            JOIN detergents ON transactions.detergent_id = detergents.detergent_id
            JOIN fabric_softeners ON transactions.fabric_softener_id = fabric_softeners.fabric_softener_id
            LEFT JOIN trackings ON transactions.transaction_id = trackings.transaction_id
            WHERE trackings.trackingNumber = '$trackingNumber'
            ORDER BY transactions.timeOfDropOff DESC";
} else {
    // Default query without search
    $sql = "SELECT transactions.transaction_id, 
                   customers.firstname AS customer_firstname,
                   customers.lastname AS customer_lastname,
                   staffs.firstname AS staff_firstname,
                   staffs.lastname AS staff_lastname,
                   transactions.timeOfDropOff,
                   services.serviceName,
                   transactions.numberofLoads,
                   transactions.numberofClothing,
                   detergents.detergent_name,
                   fabric_softeners.fabric_softener_name,
                   trackings.trackingNumber,
                   trackings.status,
                   transactions.totalCost,
                   transactions.paymentStatus
            FROM transactions
            JOIN customers ON transactions.customer_id = customers.customer_id
            JOIN staffs ON transactions.staff_id = staffs.staff_id
            INNER JOIN services ON transactions.service_id = services.service_id
            JOIN detergents ON transactions.detergent_id = detergents.detergent_id
            JOIN fabric_softeners ON transactions.fabric_softener_id = fabric_softeners.fabric_softener_id
            LEFT JOIN trackings ON transactions.transaction_id = trackings.transaction_id
            ORDER BY transactions.timeOfDropOff DESC";
}


$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr>
            <th>Transaction ID</th>
            <th>Customer Name</th>
            <th>Tracking Number</th>
            <th>Status</th>
            <th>Staff</th>
            <th>Details</th>
          </tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["transaction_id"] . "</td>";
        echo "<td>" . $row["customer_firstname"] . " " . $row["customer_lastname"] . "</td>";
        echo "<td>" . $row["trackingNumber"] . "</td>";
        echo "<td>" . $row["status"] . "</td>";
        echo "<td>" . $row["staff_firstname"] . " " . $row["staff_lastname"] . "</td>";
        
        // Combine the desired columns into a single column
        $combinedInfo = $row["serviceName"] . ",<br>" .
                        "Time of Drop Off: " . $row["timeOfDropOff"] . ",<br>" .
                        "Number of Loads: " . $row["numberofLoads"] . ",<br>" .
                        "Number of Clothing: " . $row["numberofClothing"] . ",<br>" .
                        "Detergent Details: " . $row["detergent_name"] . ",<br>" .
                        "Fabric Softener Details: " . $row["fabric_softener_name"] . ",<br>" .
                        "Total Cost: " . $row["totalCost"] . ",<br>" .
                        "Payment Status: " . $row["paymentStatus"];
    
        echo "<td>" . $combinedInfo . "</td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "No transactions found.";
}

$conn->close();
?>
    <a href="owner_dashboard.php">Back to Home</a>
</body>
</html>
