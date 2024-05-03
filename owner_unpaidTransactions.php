
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unpaid Transactions</title>
</head>
<body>
    <form method="GET" action="unpaid_transactions.php">
        <label for="trackingNumber">Search by Tracking Number:</label>
        <input type="text" id="trackingNumber" name="trackingNumber">
        <input type="submit" value="Search">
    </form>
    <?php
include('dbcon.php');
session_start();

if (!isset($_SESSION['owner_id'])) {
    header("Location: owner_login.php");
    exit();
}

$staff_id = $_SESSION['staff_id']=10;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle form submission to update the database
    $total_amount = $_POST['totalCost'];
    $change_amount = $_POST['changeAmount'];
    $amount_tendered = $_POST['tenderedAmount'];
    // Perform the update query here

    // Redirect back to the ongoing transactions page after update
    header("Location: ongoing_transactions.php");
    exit();
}

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
          WHERE transactions.paymentStatus = 'Unpaid'";

// Check if trackingNumber is provided in the URL (from the form submission)
if(isset($_GET['trackingNumber'])) {
    $searchTrackingNumber = $_GET['trackingNumber'];
    // Modify the query to include the trackingNumber in the WHERE clause
    $query .= " AND trackings.trackingNumber LIKE '%$searchTrackingNumber%'";
}

$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Ongoing Transactions table
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

    echo "<h2>Unpaid Transactions:</h2>";
    echo "<table border='1'>";
    echo "<tr>
            <th>Transaction ID</th>
            <th>Customer Name</th>
            <th>Tracking Number</th>
            <th>Status</th>
            <th>Staff Name</th>
            <th>Details</th>
            <th>Action</th>
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
                <td>
                    <a href='owner_edit_transaction.php?transaction_id={$row['transaction_id']}'>Mark as Paid</a>
                </td>
              </tr>";
    }

    echo "</table>";

} else {
    echo "No unpaid transactions.";
}

$conn->close();
?>



    <a href="owner_dashboard.php">Back to Home</a>
</body>
</html>
