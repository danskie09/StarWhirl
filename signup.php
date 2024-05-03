<?php
include('dbcon.php');
session_start();

// Check if the user is already logged in, redirect to homepage if true
if (isset($_SESSION['customer_id'])) {
    header("Location: customer_dashboard.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form inputs
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $contact_number = $_POST['contact_number'];
    $password = $_POST['password'];
    $verifyPassword = $_POST['verify_password'];

    // Validate form inputs (add more validation as per your requirements)
    if (empty($firstname) || empty($lastname) || empty($email) || empty($contact_number) || empty($password) || empty($verifyPassword)) {
        $error = "All fields are required.";
    } elseif ($password !== $verifyPassword) {
        $error = "Passwords do not match.";
    } else {
        // Connect to your database (replace with your database credentials)
       
        // Prepare and execute SQL statement to insert user into the database
        $stmt = $conn->prepare("INSERT INTO customers (firstname, lastname, email, contact_number, password) VALUES (?, ?, ?, ?,?)");
        $stmt->bind_param("sssss", $firstname, $lastname, $email, $contact_number, $password);
        if ($stmt->execute()) {
            $success = "Registration successful. You can now login.";
            
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
    <title>Sign Up</title>
    
</head>
<body>
    <h2>Sign Up</h2>
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

        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="contact_number">Contact Number:</label>
        <input type="text" name="contact_number" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <label for="verify_password">Verify Password:</label>
        <input type="password" name="verify_password" required><br>

        <div class="signup-button-container">
            <input type="submit" value="Sign Up">
        </div>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
</body>
</html>
