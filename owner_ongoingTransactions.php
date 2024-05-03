
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ongoing Transactions</title>
</head>
<body>
<form method="GET" action="">
        <label for="trackingNumber">Search by Tracking Number:</label>
        <input type="text" id="trackingNumber" name="trackingNumber">
        <input type="submit" value="Search">
    </form>



<?php
include('dbcon.php');
session_start();
// Replace these variables with your actual database credentials


if (!isset($_SESSION['owner_id'])) {
    header("Location: owner_login.php"); // Redirect to your login page
    exit();
}

if (isset($_GET['trackingNumber'])) {
    $trackingNumber = $_GET['trackingNumber'];
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
            transactions.numberofLoads,
            transactions.numberofClothing,
            transactions.totalCost,
            detergents.detergent_name,
               fabric_softeners.fabric_softener_name,
            transactions.paymentStatus
          FROM trackings
          INNER JOIN transactions ON trackings.transaction_id = transactions.transaction_id
          INNER JOIN customers ON transactions.customer_id = customers.customer_id
          INNER JOIN staffs ON transactions.staff_id = staffs.staff_id
          INNER JOIN services ON transactions.service_id = services.service_id
          JOIN detergents ON transactions.detergent_id = detergents.detergent_id
        JOIN  fabric_softeners ON transactions.fabric_softener_id = fabric_softeners.fabric_softener_id
          WHERE trackings.status = 'In Progress' 
          AND trackings.trackingNumber = '$trackingNumber' 
          ORDER BY transactions.transaction_id, customers.firstname, trackings.trackingNumber, trackings.status, staffs.firstname";
}else{
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
    transactions.numberofLoads,
    transactions.numberofClothing,
    transactions.totalCost,
    detergents.detergent_name,
       fabric_softeners.fabric_softener_name,
    transactions.paymentStatus
  FROM trackings
  INNER JOIN transactions ON trackings.transaction_id = transactions.transaction_id
  INNER JOIN customers ON transactions.customer_id = customers.customer_id
  INNER JOIN staffs ON transactions.staff_id = staffs.staff_id
  INNER JOIN services ON transactions.service_id = services.service_id
  JOIN detergents ON transactions.detergent_id = detergents.detergent_id
JOIN  fabric_softeners ON transactions.fabric_softener_id = fabric_softeners.fabric_softener_id
  WHERE trackings.status = 'In Progress' 
  
  ORDER BY transactions.transaction_id, customers.firstname, trackings.trackingNumber, trackings.status, staffs.firstname";

}
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
    <a href="owner_dashboard.php">Back to Home</a>
</body>
</html>
