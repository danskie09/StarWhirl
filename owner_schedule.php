<?php
include('dbcon.php');
session_start();

// Check if the owner is logged in, if not, redirect to login page
if (!isset($_SESSION['owner_id'])) {
    header("Location: owner_login.php"); // Replace with the owner's login page
    exit();
}


$owner_id = $_SESSION['owner_id'];
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $owner_id = $_POST['owner_id'];
    $maintenanceDate = $_POST['maintenance_date'];

    // Insert the maintenance schedule into the database
    $insertSql = "INSERT INTO maintenance_schedule (owner_id,maintenance_date) VALUES ($owner_id,'$maintenanceDate')";
    
    if ($conn->query($insertSql) === TRUE) {
        // Get the last inserted schedule_id
        $scheduleId = $conn->insert_id;
        $dayOfWeek = date('l', strtotime($maintenanceDate));
        // Notify customers about the maintenance
        $notificationMessage = "Schedule Maintenance on $dayOfWeek <strong>$maintenanceDate</strong>,announced on:";
        $notifyCustomersSql = "INSERT INTO notifications (customer_id, message)
                               SELECT customer_id,'$notificationMessage' FROM customers";
        $conn->query($notifyCustomersSql);
    
        echo "Maintenance scheduled successfully. Customers notified.";
    } else {
        echo "Error scheduling maintenance: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule Maintenance</title>
</head>
<body>
    <h1>Schedule Maintenance</h1>

    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <input type="hidden" name="owner_id" value="<?php echo $owner_id; ?>">
        <label for="maintenance_date">Maintenance Date:</label>
        <input type="date" name="maintenance_date" required>
        <br>
        <input type="submit" value="Schedule Maintenance">
    </form>


    <a href="owner_dashboard.php">Back to Home</a>
</body>
</html>
