<?php
// Include the database connection file
include 'dbcon.php';

// Start the session
session_start();

if (isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];
} else {
    // Redirect to the login page if the customer is not authenticated
    header('Location: login.php');
    exit();
}

// Check if the form for updating personal information is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    // Validate old password
    $old_password = $_POST['old_password'];
    $old_password_query = "SELECT password FROM customers WHERE customer_id = ?";
    if ($stmt = $conn->prepare($old_password_query)) {
        $stmt->bind_param("i", $customer_id);
        $stmt->execute();
        $stmt->bind_result($stored_old_password);
        $stmt->fetch();
        $stmt->close();

        // Verify the old password
        if ($old_password !== $stored_old_password) {
            echo "Incorrect old password. Please enter the correct old password.";
            
        }
    } else {
        echo "Error preparing the old password query: " . $conn->error;
        
    }

    // Validate new password and confirm password
    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        echo "New password and confirm password do not match. Please enter matching passwords.";
        exit();
    }

    // Continue with the rest of the code to update the information
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];

    // Update the customer's information in the database
    // Update the customer's information in the database
$update_query = "UPDATE customers 
SET firstname = ?, lastname = ?, email = ?, contact_number = ?, password = ?
WHERE customer_id = ?";

if ($stmt = $conn->prepare($update_query)) {
$stmt->bind_param("sssssi", $firstname, $lastname, $email, $contact_number, $new_password, $customer_id);

if ($stmt->execute()) {
echo "Personal information updated successfully.";
} else {
echo "Error updating personal information: " . $stmt->error;
}

$stmt->close();
} else {
echo "Error preparing the update query: " . $conn->error;
}

}

// Retrieve the customer's current information
$query = "SELECT * FROM customers WHERE customer_id = $customer_id";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $current_firstname = $row['firstname'];
    $current_lastname = $row['lastname'];
    $current_email = $row['email'];
    $current_contact_number = $row['contact_number'];
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Dashboard</title>
</head>
<body>
    <h1>Customer Dashboard</h1>
    <h2>Personal Information</h2>
    <form method="post" action="">
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" value="<?php echo $current_firstname; ?>" required><br><br>

        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" value="<?php echo $current_lastname; ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $current_email; ?>" required><br><br>

        <label for="contact_number">Contact Number:</label>
        <input type="text" name="contact_number" value="<?php echo $current_contact_number; ?>" required><br><br>

        <label for="old_password">Old Password:</label>
        <input type="password" name="old_password" required><br><br>

        <label for="password">New Password:</label>
        <input type="password" name="password" required><br><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" required><br><br>

        <input type="submit" name="update" value="Update Information">
    </form>
    <a href="customer_dashboard.php">Back to Home</a></p>
</body>
</html>
