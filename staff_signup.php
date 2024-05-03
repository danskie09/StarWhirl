<?php
include('dbcon.php');
session_start();

// Check if the user is already logged in, redirect to homepage if true
// if (isset($_SESSION['staff_id'])) {
//     header("Location: staff_dashboard.php");
//     exit();
// }

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form inputs
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $contact_number = $_POST['contact_number'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $verifyPassword = $_POST['verify_password'];

    // Validate form inputs (add more validation as per your requirements)
    if (empty($firstname) || empty($lastname) || empty($username) || empty($contact_number) || empty($address) || empty($password) || empty($verifyPassword)) {
        $error = "All fields are required.";
    } elseif ($password !== $verifyPassword) {
        $error = "Passwords do not match.";
    } else {
        // Connect to your database (replace with your database credentials)
        

        // Prepare and execute SQL statement to insert user into the database
        $stmt = $conn->prepare("INSERT INTO staffs (firstname, lastname, username, contact_number,address, password) VALUES (?, ?, ?, ?,?,?)");
        $stmt->bind_param("ssssss", $firstname, $lastname, $username, $contact_number, $address, $password);
        if ($stmt->execute()) {
            $success = "Registration successful. Staff Added Successfully.";
            
        
        } else {
            $error = "Error occurred. Please try again.";
        }

        // Close statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Staff</title>
    
</head>
<body>
    <h2> Add Staff</h2>
    <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } elseif (isset($success)) { ?>
        <p><?php echo $success; ?></p>
    <?php } ?>

    <form method="POST" action="">
        <label for="firstname">First Name:</label>
        <input type="text" name="firstname" required><br>

        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" required><br>

        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="contact_number">Contact Number:</label>
        <input type="text" name="contact_number" required><br>

        <label for="address">Address:</label>
        <input type="text" name="address" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="verify_password">Verify Password:</label>
        <input type="password" name="verify_password" required><br>

        <div class="signup-button-container">
            <input type="submit" value="Sign Up">
        </div>
    </form>
   <a href="owner_dashboard.php">Back to Home</a>
</body>
</html>
