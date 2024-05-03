<?php
include('dbcon.php');

session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch staff data
$sql = "SELECT * FROM staffs";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display staff data in a table
    echo "<table border='1'>
            <tr>
                <th>Staff ID</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Contact Number</th>
                <th>Address</th>
                <th>Username</th>
                <th>Password</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['staff_id']}</td>
                <td>{$row['firstname']}</td>
                <td>{$row['lastname']}</td>
                <td>{$row['contact_number']}</td>
                <td>{$row['address']}</td>
                <td>{$row['username']}</td>
                <td>{$row['password']}</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Staffs</title>
</head>
<body>
    <a href="admin_dashboard.php">Back to Home</a>
</body>
</html>