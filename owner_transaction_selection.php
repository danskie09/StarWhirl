<?php
include('dbcon.php');



session_start();

if (!isset($_SESSION['owner_id'])) {
    header("Location: owner_login.php"); // Redirect to your login page
    exit();
}

// Create connection


$owner_id = $_SESSION['owner_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Radio Button Form</title>
</head>
<body>

<h2>Does the user have an account?:</h2>

<form action="#" method="" id="radioForm">
    <label>
        <input type="radio" name="option" value="option1" checked>
        Yes
    </label>

    <label>
        <input type="radio" name="option" value="option2">
        No
    </label>

    <br>

    <input type="submit" value="Submit">
</form>
<a href="owner_dashboard.php">Back to Home</a>
<script>
document.getElementById('radioForm').addEventListener('submit', function(event) {
    var selectedOption = document.querySelector('input[name="option"]:checked').value;

    // Check which option is selected and set the form action accordingly
    switch (selectedOption) {
        case 'option1':
            this.action = 'owner_insert_transactions.php'; // Replace 'page1.php' with the actual URL for Option 1
            break;
        case 'option2':
            this.action = 'owner_new_customer_transactions.php'; // Replace 'page2.php' with the actual URL for Option 2
            break;
        default:
            // Handle other cases if needed
            break;
    }
});
</script>

</body>
</html>
