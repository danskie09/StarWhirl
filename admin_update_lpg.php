<?php
session_start();

// Database connection
include('dbcon.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ownerId = $_SESSION['owner_id']=1;

    // Check which button was clicked
    if (isset($_POST["replace_lpg1"])) {
        // Replace LPG 1 logic
        $result = $conn->query("UPDATE lpg_inventory SET status = 'Replace' WHERE lpg_name = 'LPG 1'");
        $result = $conn->query("UPDATE lpg_inventory SET status = 'In use' WHERE lpg_name = 'LPG 2'");
    } elseif (isset($_POST["replace_lpg2"])) {
        // Replace LPG 2 logic
        $result = $conn->query("UPDATE lpg_inventory SET status = 'Replace' WHERE lpg_name = 'LPG 2'");
        $result = $conn->query("UPDATE lpg_inventory SET status = 'In use' WHERE lpg_name = 'LPG 1'");
    }
}

// Fetch current LPG statuses
$result = $conn->query("SELECT * FROM lpg_inventory");
while ($row = $result->fetch_assoc()) {
    if ($row['lpg_name'] == 'LPG 1') {
        $lpg1_status = $row['status'];
    } elseif ($row['lpg_name'] == 'LPG 2') {
        $lpg2_status = $row['status'];
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LPG Inventory</title>
    <style>
        button { margin-top: 10px; }
    </style>
</head>
<body>

<h2>LPG Inventory</h2>

<p>LPG 1 Status: <?php echo $lpg1_status; ?></p>
<p>LPG 2 Status: <?php echo $lpg2_status; ?></p>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <button type="submit" name="replace_lpg1">Replace LPG 1</button>
    <button type="submit" name="replace_lpg2">Replace LPG 2</button>
</form>



<a href="admin_dashboard.php">Back to Home</a>
</body>
</html>
