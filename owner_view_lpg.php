<?php
// Step 1: Establish a connection to the database
include('dbcon.php');
session_start();

// Check if owner_id is set in the session
if (!isset($_SESSION['owner_id'])) {
    // Redirect or handle the case where owner_id is not set
    header('Location: owner_login.php'); // Change login.php to your actual login page
    exit();
}

$owner_id = $_SESSION['owner_id'];

// Step 2: Fetch the LPG inventory data for the specific owner_id
$sql = "SELECT * FROM lpg_inventory WHERE owner_id = $owner_id";
$result = $conn->query($sql);

// Step 3: Display the data in a readable format
if ($result->num_rows > 0) {
    echo "<table border='1'>
        <tr>
            <th>LPG ID</th>
            <th>LPG Name</th>
            <th>Status</th>
        </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["lpg_id"] . "</td>
                <td>" . $row["lpg_name"] . "</td>
                <td>" . $row["status"] . "</td>
            </tr>";
    }

    echo "</table>";
} else {
    echo "0 results";
}

// Close the database connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="owner_dashboard.php">Back to Home</a>
</body>
</html>