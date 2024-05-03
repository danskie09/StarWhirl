<?php
// Assuming you have a database connection established
// You should replace these values with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "washing";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $customerId = $_POST["customer_id"];
    $staffId = $_POST["staff_id"];
    $timeOfDropOff = $_POST["time_of_drop_off"];
    $serviceId = $_POST["service_id"];
    $numberOfLoads = $_POST["number_of_loads"];
    $numberOfClothingPerLoad = $_POST["number_of_clothing_per_load"];
    $totalCost = $_POST["total_cost"];
    $detergentDetails = $_POST["detergent_details"];
    $fabricSoftenerDetails = $_POST["fabric_softener_details"];

    // Insert data into the transactions table
    $sql = "INSERT INTO transactions (customer_id, staff_id, timeOfDropOff, service_id, numberofLoads, 
            numberofClothingPerLoad, totalCost, detergentDetails, fabricSoftenerDetails) 
            VALUES ('$customerId', '$staffId', '$timeOfDropOff', '$serviceId', '$numberOfLoads', 
            '$numberOfClothingPerLoad', '$totalCost', '$detergentDetails', '$fabricSoftenerDetails')";

    if ($conn->query($sql) === TRUE) {
        echo "Transaction inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert Transaction</title>
</head>
<body>

<h2>Insert Transaction</h2>

<form method="post" action="insert_transactions.php">
    <!-- Add dropdown for selecting service -->

    <label for="customer_id">Select Customer:</label>
    <select name="customer_id">
        <?php
        while ($customer = $customerResult->fetch_assoc()) {
            echo "<option value='" . $customer["customer_id"] . "'>" . $customer["firstname"] . " " . $customer["lastname"] . "</option>";
        }
        ?>
    </select>
    <br>

    <!-- Dropdown for selecting staff -->
    <label for="staff_id">Select Staff:</label>
    <select name="staff_id">
        <?php
        while ($staff = $staffResult->fetch_assoc()) {
            echo "<option value='" . $staff["staff_id"] . "'>" . $staff["firstname"] . " " . $staff["lastname"] . "</option>";
        }
        ?>
    </select>
    <br>
<label for="service_id">Select Service:</label>
<select name="service_id">
    <?php
    // Fetch services from the database
    $serviceSql = "SELECT * FROM services";
    $result = $conn->query($serviceSql);

    // Display services in the dropdown
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["service_id"] . "'>" . $row["serviceName"] . "</option>";
    }
    ?>
</select>
<br>

<!-- Add other input fields here (time_of_drop_off, number_of_loads, etc.) -->
<label for="time_of_drop_off">Time of Drop-off:</label>
<input type="text" name="time_of_drop_off" required>
<br>

<label for="number_of_loads">Number of Loads:</label>
<input type="number" name="number_of_loads" required>
<br>

<label for="number_of_clothing_per_load">Number of Clothing per Load:</label>
<input type="number" name="number_of_clothing_per_load" required>
<br>

<label for="total_cost">Total Cost:</label>
<input type="number" name="total_cost" required>
<br>

<label for="detergent_details">Detergent Details:</label>
<input type="text" name="detergent_details" required>
<br>

<label for="fabric_softener_details">Fabric Softener Details:</label>
<input type="text" name="fabric_softener_details" required>
<br>

    <!-- Add other input fields here (time_of_drop_off, number_of_loads, etc.) -->

    <input type="submit" value="Submit">
</form>

</body>
</html>
