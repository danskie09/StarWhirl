<?php
include('dbcon.php');
session_start();

// Check if customer is logged in, if not, redirect to login page
if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php"); // Redirect to your login page
    exit();
}



$customer_id = $_SESSION['customer_id'];

// Fetch customer's data from the database
$sql = "SELECT firstname, lastname FROM customers WHERE customer_id = $customer_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $customer_firstname = $row['firstname'];
    $customer_lastname = $row['lastname'];
} else {
    // Handle the case where customer data is not found
    $customer_firstname = 'Unknown';
    $customer_lastname = 'Unknown';
}

// Fetch customer's notifications from the database
$notificationSql = "SELECT * FROM notifications WHERE customer_id = '$customer_id' ORDER BY created_at DESC";
$notificationResult = $conn->query($notificationSql);



// Delete all notifications when the "Delete All" button is clicked
if (isset($_POST['deleteAllNotifications'])) {
    $deleteAllSql = "DELETE FROM notifications WHERE customer_id = '$customer_id'";
    if ($conn->query($deleteAllSql) === TRUE) {
        echo "All notifications deleted successfully.";
        // Refresh the page to reflect the changes
        header("Refresh:0");
    } else {
        echo "Error deleting notifications: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
</head>
<body>
    <h1>Welcome to Customer Dashboard, <?php echo $customer_firstname . ' ' . $customer_lastname; ?>!</h1>

    <!-- Display notifications within a div -->
    <div id="notifications-container">
        <h2>Notifications</h2>
        <ul>
            <?php
            while ($notificationRow = $notificationResult->fetch_assoc()) {
                echo "<li>{$notificationRow['message']} ({$notificationRow['created_at']})</li>";
            }
            ?>
        </ul>

        <!-- Button to delete all notifications -->
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="submit" name="deleteAllNotifications" value="Delete All Notifications">
        </form>

        <!-- Button to hide notifications -->
        <button onclick="hideNotifications()">Hide</button>
    </div>

    <!-- Button to show notifications -->
    <button id="showButton" onclick="showNotifications()">Show</button>

    <p><a href="transaction_history.php">Transaction History</a></p>
    <p><a href="ongoing_transactions.php">Ongoing Transaction</a></p>
    <p><a href="search_trackingNumber.php">Search</a></p>
    <p><a href="view_customer_info.php">View Your Personal Information</a></p>
    <p><a href="logout.php">Logout</a></p>

    <script>
         // Initially hide the notifications
         var notificationsContainer = document.getElementById("notifications-container");
        notificationsContainer.style.display = "block";

        // Initially hide the "Show" button
        var showButton = document.getElementById("showButton");
        showButton.style.display = "none";

        function hideNotifications() {
            var displayStyle = notificationsContainer.style.display;

            if (displayStyle === "" || displayStyle === "none") {
                notificationsContainer.style.display = "block";
                showButton.style.display = "none";
            } else {
                notificationsContainer.style.display = "none";
                showButton.style.display = "block";
            }
        }

        function showNotifications() {
            notificationsContainer.style.display = "block";
            showButton.style.display = "none";
        }
    </script>
</body>
</html>
