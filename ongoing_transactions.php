<?php
include('dbcon.php');
session_start();
// Replace these variables with your actual database credentials


if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php"); // Redirect to your login page
    exit();
}

// Create connection


$customer_id = $_SESSION['customer_id'];

// Fetch ongoing transactions from the trackings table
$query = "SELECT 
            trackings.trackingNumber,
            transactions.transaction_id,
            customers.firstname AS customer_firstname,
            customers.lastname AS customer_lastname,
            staffs.firstname AS staff_firstname,
            staffs.lastname AS staff_lastname,
            transactions.timeOfDropOff,
            trackings.status,
            services.serviceName,
            detergents.detergent_name,
               fabric_softeners.fabric_softener_name,
            transactions.numberofLoads,
            transactions.numberofClothing,
            transactions.totalCost,
           
            transactions.paymentStatus
          FROM trackings
          INNER JOIN transactions ON trackings.transaction_id = transactions.transaction_id
          INNER JOIN customers ON transactions.customer_id = customers.customer_id
          INNER JOIN staffs ON transactions.staff_id = staffs.staff_id
          INNER JOIN services ON transactions.service_id = services.service_id
          JOIN detergents ON transactions.detergent_id = detergents.detergent_id
        JOIN  fabric_softeners ON transactions.fabric_softener_id = fabric_softeners.fabric_softener_id
          WHERE trackings.status = 'In Progress'  AND customers.customer_id = $customer_id
          ORDER BY transactions.transaction_id, customers.firstname, trackings.trackingNumber, trackings.status, staffs.firstname";

$result = $conn->query($query);

if ($result->num_rows > 0) {
    echo "<style>
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
          </style>";

    echo "<h2>Ongoing Transactions:</h2>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Transaction ID</th>
            <th>Customer Name</th>
            <th>Tracking Number</th>
            <th>Status</th>
            <th>Staff Name</th>
            <th>Details</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['transaction_id']}</td>
                <td>{$row['customer_firstname']} {$row['customer_lastname']}</td>
                <td>{$row['trackingNumber']}</td>
                <td>{$row['status']}</td>
                <td>{$row['staff_firstname']} {$row['staff_lastname']}</td>
                <td>
                    <strong>Service:</strong> {$row['serviceName']}<br>
                    <strong>Time of Drop-Off:</strong> {$row['timeOfDropOff']}<br>
                    <strong>Number of Loads:</strong> {$row['numberofLoads']}<br>
                    <strong>Number of Clothing:</strong> {$row['numberofClothing']}<br>
                    <strong>Detergent Details:</strong> {$row['detergent_name']}<br>
                    <strong>Fabric Softener Details:</strong> {$row['fabric_softener_name']}<br>
                    
                    <strong>Payment Status:</strong> {$row['paymentStatus']}<br>
                    <strong>Total Cost:</strong> {$row['totalCost']}
                </td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No ongoing transactions.";
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ongoing Transactions</title>
</head>
<body>
    <a href="customer_dashboard.php">Back to Home</a>
</body>
</html>
