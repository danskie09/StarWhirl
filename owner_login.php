<?php
include('dbcon.php');
session_start();

// Check if the user is already logged in, redirect to homepage if true
if (isset($_SESSION['owner_id'])) {
    header("Location: owner_dashboard.php");
    exit();
}




// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form inputs
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate form inputs (add more validation as per your requirements)
    if (empty($username) || empty($password)) {
        $error = "Email and password are required.";
    } else {
        // Connect to your database (replace with your database credentials)
       

        // Prepare and execute SQL statement to fetch user from the database
        $stmt = $conn->prepare("SELECT owner_id, username, password FROM owner WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $username,$password);
        $stmt->execute();
        $stmt->store_result();

        // Check if a user with the given email exists
        if ($stmt->num_rows === 1) {
            $stmt->bind_result($ownerId, $dbUsername, $dbPassword);
            $stmt->fetch();

            // Verify the password
            if ($password === $dbPassword) {
                // Set user ID in session
                $_SESSION['owner_id'] = $ownerId;

                // Redirect to homepage
                header("Location: owner_dashboard.php");
                exit();
            } else {
                $error = "Invalid email or password.";
            }
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
    <title>Login</title>
  
</head>
<body>
    <h2> Owner Login</h2>
    <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>

    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="#">Contact Admin</a></p>
</body>
</html>
