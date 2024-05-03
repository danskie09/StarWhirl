<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Form</title>
</head>
<body>

<?php
include('dbcon.php');
// Replace these variables with your actual database credentials

session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php"); // Redirect to your login page
    exit();
}



$currentStaffId = $_SESSION["staff_id"]=10;


// Fetch customer and staff data for dropdown menus
$customerQuery = "SELECT customer_id, firstname, lastname FROM customers ORDER BY lastname, firstname";
$staffQuery = "SELECT staff_id, firstname, lastname FROM staffs WHERE staff_id = $currentStaffId"; // Fetch only the currently logged-in staff
$serviceQuery = "SELECT service_id,serviceName FROM services";
$detergentQuery = "SELECT detergent_id,detergent_name FROM detergents ";
$fabricSoftQuery = "SELECT fabric_softener_id,fabric_softener_name FROM fabric_softeners ";

$customerResult = $conn->query($customerQuery);
$staffResult = $conn->query($staffQuery);
$serviceResult = $conn->query($serviceQuery);
$detergentResult = $conn->query($detergentQuery);
$fabricSoftenResult = $conn->query( $fabricSoftQuery);

// Handle form submission
// ...

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $customer_id = $_POST["customer_id"];
    $staff_id = $_POST["staff_id"]=10;
    $service_id = $_POST["service_id"];
    $timeOfDropOff = $_POST["timeOfDropOff"];
    $numberofLoads = $_POST["numberofLoads"];
    $numberofClothing = $_POST["numberofClothing"];
    $totalCost = $_POST["totalCost"];
    $paymentStatus = $_POST["paymentStatus"];
    $tenderedAmount = $_POST["tenderedAmount"];
    $changeAmount = $_POST["changeAmount"];
    $detergentDetails = $_POST["detergent_id"];
    $numberOfDetergent = $_POST["numberOfDetergent"];

    $fabricSoftenerDetails = $_POST["fabric_softener_id"];
    $numberOfFabricSoft = $_POST["numberOfFabricSoft"];


    if ($detergentDetails != $_POST["detergent_id"]= 18) {

        $updateDetergentQuery = "UPDATE detergents SET stock_quantity = stock_quantity - $numberOfDetergent WHERE detergent_id = '$detergentDetails'";
        if ($conn->query($updateDetergentQuery) === TRUE) {
            echo "Detergent stock updated successfully.<br>";
        } else {
            echo "Error updating detergent stock: " . $conn->error . "<br>";
        }
    }
    
    // Update fabric softener stock quantity
    if ($fabricSoftenerDetails != $_POST["fabric_softener_id"] = 7) {
        
        $updateFabricSoftenerQuery = "UPDATE fabric_softeners SET stock_quantity = stock_quantity - $numberOfFabricSoft WHERE fabric_softener_id = '$fabricSoftenerDetails'";

        
        
        if ($conn->query($updateFabricSoftenerQuery) === TRUE) {
            echo "Fabric softener stock updated successfully.<br>";
        } else {
            echo "Error updating fabric softener stock: " . $conn->error . "<br>";
        }
    }

    // Generate a random 8-digit tracking number
    $trackingNumber = generateTrackingNumber();

    



    // Insert data into the transactions table
    $sql = "INSERT INTO transactions (customer_id, staff_id, service_id, timeOfDropOff, numberofLoads, numberofClothing, totalCost,paymentStatus, tenderedAmount,changeAmount, detergent_id,numberOfDetergent, fabric_softener_id,numberOfFabricSoft)
            VALUES ('$customer_id', '$staff_id', '$service_id', '$timeOfDropOff', '$numberofLoads', '$numberofClothing', '$totalCost','$paymentStatus','$tenderedAmount','$changeAmount', '$detergentDetails','$numberOfDetergent', '$fabricSoftenerDetails','$numberOfFabricSoft')";

    if ($conn->query($sql) === TRUE) {
        // Get the last inserted transaction_id
        $lastTransactionId = $conn->insert_id;

        // Insert tracking information into the trackings table
        $trackingSql = "INSERT INTO trackings (trackingNumber, transaction_id, status)
                        VALUES ('$trackingNumber', '$lastTransactionId', 'In Progress')";

        if ($conn->query($trackingSql) === TRUE) {
            header('Location: admin_success_page.php?trackingNumber=' . $trackingNumber);
        } else {
            echo "Error inserting tracking information: " . $conn->error;
        }
    } else {
        echo "Error inserting transaction: " . $conn->error;
    }

    
}

// Function to generate a random 8-digit tracking number
function generateTrackingNumber() {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $trackingNumber = '';
    for ($i = 0; $i < 8; $i++) {
        $trackingNumber .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $trackingNumber;
}
?>

<h2>Transaction Form</h2>
<label for="customer_search">Search Customer:</label>
<form method="get" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <input type="text" name="customer_search" id="customer_search">
    <input type="submit" value="Search">
</form>





<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
<label for="customer_id">Customer:</label>
    <select name="customer_id" required>
        <?php
        $searchTerm = isset($_GET['customer_search']) ? $_GET['customer_search'] : '';
        
        // Modify the customer query to include search
        $customerQuery = "SELECT customer_id, firstname, lastname FROM customers WHERE firstname LIKE '%$searchTerm%' OR lastname LIKE '%$searchTerm%' ORDER BY lastname, firstname";
        $customerResult = $conn->query($customerQuery);

        while ($customer = $customerResult->fetch_assoc()) {
            echo "<option value='{$customer["customer_id"]}'>{$customer["lastname"]} {$customer["firstname"]}</option>";
        }
        ?>
    </select><br>


    <label for="staff_id">Staff:</label>
    <select name="staff_id" required>
        <?php
        while ($staff = $staffResult->fetch_assoc()) {
            echo "<option value='{$staff["staff_id"]}'>{$staff["firstname"]} {$staff["lastname"]}</option>";
        }
        ?>
    </select><br>


    <label for="service_id">Services:</label>
    <select name="service_id"  id="serviceType" required>
        <?php
        while ($service = $serviceResult->fetch_assoc()) {
            echo "<option value='{$service["service_id"]}'>{$service["serviceName"]} </option>";
        }
        ?>
    </select><br>



    <!-- <label for="serviceType">Service Type:</label>
    <select name="serviceType" id="serviceType" required>
        <option value="washing">Washing</option>
        <option value="dryer">Dryer</option>
        <option value="dropoff">Drop Off</option>
         Add more options as needed -->
    <!-- </select><br> -->

    <label for="timeOfDropOff">Time of Drop Off:</label>
    <input type="datetime-local" name="timeOfDropOff" required><br>

    <label for="numberofLoads">Number of Loads:</label>
    <input type="number" name="numberofLoads" id="numberofLoads" required oninput="calculateTotalCost()" oninput="calculateTotalAmount()"><br>

    <label for="numberofClothing">Number of Clothing:</label>
    <input type="number" name="numberofClothing" id="numberofClothing" required oninput="calculateTotalCost()"><br>

  

    <label for="detergent_id">Detergent Details:</label>
    <select name="detergent_id"  id="detergentDetails" required>
        
        <?php
        while ($detergent = $detergentResult->fetch_assoc()) {
            
            echo "<option value='{$detergent["detergent_id"]}'>{$detergent["detergent_name"]} </option>";
        }
        ?>
    </select><br>

<!-- Additional field for the number of detergent -->
<div id="numberOfDetergentContainer" style="display:none;">
    <label for="numberOfDetergent">Number of Detergent:</label>
    <input type="number" name="numberOfDetergent" id="numberOfDetergent" oninput="calculateTotalCost()" oninput="calculateTotalAmount()">
</div>


 







<label for="fabric_softener_id">Fabric Softener Details:</label>
    <select name="fabric_softener_id"  id="fabricSoftenerDetails" required>
        <?php
        while ($fabricSoftener = $fabricSoftenResult->fetch_assoc()) {
            echo "<option value='{$fabricSoftener["fabric_softener_id"]}'>{$fabricSoftener["fabric_softener_name"]} </option>";
        }
        ?>
    </select><br>

<!-- Additional field for the number of detergent -->
<div id="numberOfFabricSoftenerContainer" style="display:none;">
    <label for="numberOfFabric">Number of Fabric Softener:</label>
    <input type="number" name="numberOfFabricSoft" id="numberOfFabric" oninput="calculateTotalCost()" oninput="calculateTotalAmount()">
</div>



<label for="paymentStatus">Payment Status:</label>
<select name="paymentStatus" id="paymentStatus" onchange="daniel()"required>
    <option value="Unpaid">Pay Later</option>
    <option value="Paid">Pay Now</option>
    


    
</select>
<br>







   <!-- Display the calculated total cost in real-time -->
   <label for="totalCost">Total Cost:</label>
    <input type="text" name="totalCost" id="totalCost" readonly><br>


    <div id="statusContainer" style="display:none;">
    <label for="tenderedAmount">Tendered Amount:</label>
    <input type="text" name="tenderedAmount" id="tenderedAmount" oninput="calculateTotalAmount()"><br>


    <label for="changeAmount">Change:</label>
    <input type="text" name="changeAmount" id="changeAmount" readonly><br>
    </div>

  


    <input type="submit"value="Submit">
</form>

<script>
function calculateTotalAmount(){
    var tendered = document.getElementById("tenderedAmount").value;
    var total = document.getElementById("totalCost").value;

    var totalAmount = tendered - total;
    document.getElementById('changeAmount').value = totalAmount.toFixed(2);



}


function daniel(){

// Your condition or code here when the select element is clicked

var statusContainer = document.getElementById('statusContainer').style.display='block';
var payment = document.getElementById('paymentStatus').value;

switch(payment){
case 'Unpaid':
document.getElementById('statusContainer').style.display='none';
break;
case 'Paid':
document.getElementById('statusContainer').style.display='block';
break;

default:
break;


}

}




function calculateTotalCost() {
   
    var fabricTypeSelect = document.getElementById('fabricSoftenerDetails');
    var selectedIndex = fabricTypeSelect.selectedIndex;
var fabricType = fabricTypeSelect.options[selectedIndex].text;
   
    
    var numberOfFabric = document.getElementById('numberOfFabric').value;

    var costPerFabric = 0;

    // Set cost based on detergent type
    switch (fabricType) {
        case 'customerOwned':
            costPerFabric = 0; // No additional cost for customer-owned detergent
            document.getElementById('numberOfFabricSoftenerContainer').style.display = 'none';
            break;
        case 'del':
            costPerFabric = 10;
            document.getElementById('numberOfFabricSoftenerContainer').style.display = 'block';
            break;
        case 'downy':
            costPerFabric = 15;
            document.getElementById('numberOfFabricSoftenerContainer').style.display = 'block';
            break;
        default:
            break;
    }
   
    var detergentTypeSelect = document.getElementById('detergentDetails');
    var selectedIndex = detergentTypeSelect.selectedIndex;
var detergentType = detergentTypeSelect.options[selectedIndex].text;
    var numberOfDetergent = document.getElementById('numberOfDetergent').value;

    var costPerDetergent = 0;

    // Set cost based on detergent type
    switch (detergentType) {
        case 'customerOwned':
            costPerDetergent = 0; // No additional cost for customer-owned detergent
            document.getElementById('numberOfDetergentContainer').style.display = 'none';
            break;
        case 'breeze':
        case 'ariel':
            costPerDetergent = 25;
            document.getElementById('numberOfDetergentContainer').style.display = 'block';
            break;
        case 'champion':
            costPerDetergent = 20;
            document.getElementById('numberOfDetergentContainer').style.display = 'block';
            break;
        default:
            break;
    }

    var numberofLoads = document.getElementById('numberofLoads').value;
    var numberofClothing = document.getElementById('numberofClothing').value;
    
    var serviceTypeSelect = document.getElementById('serviceType');
var selectedIndex = serviceTypeSelect.selectedIndex;
var serviceType = serviceTypeSelect.options[selectedIndex].text;

    var costPerLoad = 0;

    switch (serviceType) {
        case 'Wash':
            costPerLoad = 60;
            break;
        case 'Wash and Dry':
            costPerLoad = 130;
            break;
        case 'Drop-Off':
            costPerLoad = 160;
            break;
        // Add more cases as needed for other service types
    }

    var totalCost = (numberofLoads * costPerLoad) + (numberOfDetergent * costPerDetergent) + (numberOfFabric * costPerFabric);

    // Display the calculated total cost in the form
    document.getElementById('totalCost').value = totalCost.toFixed(2); // Displaying with two decimal places
}

// Attach the calculateTotalCost function to input events for real-time computation
document.getElementById('numberofLoads').addEventListener('input', calculateTotalCost);
document.getElementById('numberofLoads').addEventListener('input', calculateTotalAmount);

document.getElementById('serviceType').addEventListener('change', calculateTotalCost);
document.getElementById('serviceType').addEventListener('change', calculateTotalAmount);

document.getElementById('detergentDetails').addEventListener('change', calculateTotalCost);
document.getElementById('detergentDetails').addEventListener('change', calculateTotalAmount);

document.getElementById('numberOfDetergent').addEventListener('input', calculateTotalCost);
document.getElementById('numberOfDetergent').addEventListener('input', calculateTotalAmount);



document.getElementById('fabricSoftenerDetails').addEventListener('change', calculateTotalCost);
document.getElementById('fabricSoftenerDetails').addEventListener('change', calculateTotalAmount);
document.getElementById('numberOfFabric').addEventListener('input', calculateTotalCost);
document.getElementById('numberOfFabric').addEventListener('input', calculateTotalAmount);


document.getElementById('tenderedAmount').addEventListener('input', calculateTotalAmount);
</script>
<a href="admin_dashboard.php">Back to Home</a>
</body>
</html>
