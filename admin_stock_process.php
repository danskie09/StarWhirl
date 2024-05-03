<?php
// Include your database connection code here
include('dbcon.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php"); // Redirect to your login page
    exit();
}


$success = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $ownerId = $_SESSION['owner_id']=1;
    $detergentId = $_POST['detergent_id'];
    $softenerId = $_POST['fabric_softener_id'];
    $stockQuantityDetergent = $_POST['stock_quantity_detergent'];
    $stockQuantitySoftener = $_POST['stock_quantity_softener'];

    // Validate data (you can add more validation as needed)

    // Update stock quantity in the database
    $sqlDetergent = "UPDATE detergents SET stock_quantity = stock_quantity + $stockQuantityDetergent WHERE owner_id = $ownerId AND detergent_id = $detergentId";
    $sqlSoftener = "UPDATE fabric_softeners SET stock_quantity = stock_quantity + $stockQuantitySoftener WHERE owner_id = $ownerId AND fabric_softener_id = $softenerId";

    // Execute SQL queries
    // Note: You should use prepared statements to prevent SQL injection

    // Redirect to a success page or handle errors
    if ($conn->query($sqlDetergent) === TRUE && $conn->query($sqlSoftener) === TRUE) {
        $success = "Stocks added Successfully";
    } else {
        $error = "Error occurred. Please try again.";
    }

    // Close the database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Detergent and Fabric Softener</title>
</head>
<body>
<?php if ($success) { ?>
        <p><?php echo $success; ?></p>
    <?php } elseif (isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    <h2>Add Detergent and Fabric Softener</h2>
    <form action="admin_stock_process.php" method="post">
        <label for="detergent_id">Select Detergent:</label>
        <select name="detergent_id" required>
            <?php
            include('dbcon.php');
            // Fetch detergent names from the database
            $sqlDetergentNames = "SELECT detergent_id, detergent_name FROM detergents WHERE detergent_id != 18";
            $resultDetergentNames = $conn->query($sqlDetergentNames);

            if ($resultDetergentNames->num_rows > 0) {
                while ($row = $resultDetergentNames->fetch_assoc()) {
                    echo "<option value='" . $row['detergent_id'] . "'>" . $row['detergent_name'] . "</option>";
                }
            }
            ?>
        </select><br>
        <label for="stock_quantity_detergent">Stock Quantity for Detergent:</label>
<input type="number" name="stock_quantity_detergent" value="0" required><br>


        <label for="fabric_softener_id">Select Fabric Softener:</label>
        <select name="fabric_softener_id" required>
            <?php
            include('dbcon.php');
            // Fetch fabric softener names from the database
            $sqlSoftenerNames = "SELECT fabric_softener_id, fabric_softener_name FROM fabric_softeners WHERE fabric_softener_id != 7";
            $resultSoftenerNames = $conn->query($sqlSoftenerNames);

            if ($resultSoftenerNames->num_rows > 0) {
                while ($row = $resultSoftenerNames->fetch_assoc()) {
                    echo "<option value='" . $row['fabric_softener_id'] . "'>" . $row['fabric_softener_name'] . "</option>";
                }
            }
            ?>
        </select><br>

        

<label for="stock_quantity_softener">Stock Quantity for Fabric Softener:</label>
<input type="number" name="stock_quantity_softener" value="0" required><br>


        <input type="submit" value="Add">
    </form>


    <a href="admin_dashboard.php">Back to Home</a>
</body>
</html>
