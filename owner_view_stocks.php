<?php
// Include your database connection code here
include('dbcon.php');
session_start();

if (!isset($_SESSION['owner_id'])) {
    header("Location: owner_login.php"); // Redirect to your login page
    exit();
}

// Retrieve all detergent information
$sqlDetergents = "SELECT * FROM detergents WHERE owner_id = " . $_SESSION['owner_id'] . " AND detergent_id != 18";
$resultDetergents = $conn->query($sqlDetergents);

// Retrieve all fabric softener information excluding customerOwned1
$sqlSofteners = "SELECT * FROM fabric_softeners WHERE owner_id = " . $_SESSION['owner_id'] . " AND fabric_softener_id != 7";
$resultSofteners = $conn->query($sqlSofteners);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Stocks</title>
</head>
<body>
    <h2>View Stocks</h2>

    <h3>Detergents</h3>
    <table border="1">
        <tr>
            <th>Detergent ID</th>
            <th>Detergent Name</th>
            <th>Stock Quantity</th>
        </tr>
        <?php
        while ($row = $resultDetergents->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['detergent_id'] . "</td>";
            echo "<td>" . $row['detergent_name'] . "</td>";
            echo "<td>" . $row['stock_quantity'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h3>Fabric Softeners</h3>
    <table border="1">
        <tr>
            <th>Fabric Softener ID</th>
            <th>Fabric Softener Name</th>
            <th>Stock Quantity</th>
        </tr>
        <?php
        while ($row = $resultSofteners->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['fabric_softener_id'] . "</td>";
            echo "<td>" . $row['fabric_softener_name'] . "</td>";
            echo "<td>" . $row['stock_quantity'] . "</td>";
            echo "</tr>";
        }
        ?>
    </table>

    <a href="owner_dashboard.php">Back to Home</a>
</body>
</html>
