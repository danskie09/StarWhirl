<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>

       
       



        *{
	padding: 0;
	margin: 0;
	box-sizing: border-box;
	font-family: 'Montserrat', sans-serif;
	text-decoration: none;
	list-style: none;
	scroll-behavior: smooth;
}

:root{
	--bg-color: #f5f5f5;
	--text-color: #121212;
	--main-font: 2.2rem;
	--p-font: 1.1rem;
}
body{
	background: var(--bg-color);
	color: var(--text-color);
}
header{
	width: 100%;
	top: 0;
	right: 0;
	z-index: 1000;
	position: fixed;
	background: var(--bg-color);
	box-shadow: 0px 14px 18px 0 rgba(0, 0, 0, 0.2);
	display: flex;
	align-items: center;
	justify-content: space-between;
	padding: 20px 8%;
	transition: .3s;
    box-sizing: border-box;
    height: 70px;
}
.logo {
    width: 150px;
    height: 150px;
    display: block; /* Ensure it's a block-level element for centering */
   
}
#menu-icon{
	font-size: 38px;
	color: var(--text-color);
	z-index: 10001;
	display: none;
}
.navbar{
	display: flex;
   
}
.navbar a{
	font-size: var(--p-font);
	color: var(--text-color);
	font-weight: 600;
	padding: 10px 15px;
	margin: 0 10px;
	transition: all .40s ease;
}
.navbar a:hover{
	background: #f5bf42;
	color: #fff;
}
.icons{
	display: inline-block;
}
.icons a{
	color: var(--text-color);
	font-size: var(--p-font);
    background: black;
	color: #fff;
    margin-right: 30px;
	margin-left: 30px;
    font-weight: 600;
	padding: 5px 10px;
    border-radius: 5px;
}
.icons a:hover{
	opacity: 0.7;
    background: #f5bf42;
    color: white;
}

.result{
        
        margin-top: 30px;
        align-items: center;
        justify-content: center;
         text-align: center;
    border: 2px #f5bf42 dashed;
    border-radius: 30px;
        padding: 30px 30px;
        width: 1000px;
        height: auto;
        margin-left: 150px;
        margin-right: 100px;
        background-color: white;
    } 

    .formContainer{
        display: flex;
        margin-top: 100px;
        margin-bottom: 40px;
        justify-content: center;
        text-align: center;
        
    }

    .formContainer form{
        color: #f5bf42;
        width: 500px;
    }

    .searchContainer{
    display: flex;
}

    .formContainer input[type=text] {
width: 400px;
box-sizing: border-box;
border: 2px solid #ccc;
border-radius: 4px;
font-size: 16px;
background-color: white;
background-image: url('images/search.png');
background-position: 2px 3px;
background-size: 20px 20px; 
background-repeat: no-repeat;
padding: 12px 20px 12px 40px;
height: 20px;
}

.formContainer input[type=submit]{
    width: 100px;
    box-sizing: border-box;
    font-size: 16px;
    border-radius: 5px;
    background-color: #f5bf42;
    color: white;
    border: none;

}

.formContainer input[type=submit]:hover{
    opacity: 0.5;
}


.welcome {
  background-image: url('images/final.webp'); /* Ag black background ni sa welcome to gadget haven sa homepage*/
  background-size: cover;
  background-position: center;
  text-align: center;
  color: black;
  padding: 100px 0;
}


    .btn {
  display: inline-block;
  padding: 10px 20px;
  background-color: black;
  color: white;
  font-weight: 600;
  text-decoration: none;
  border-radius: 5px;
  margin-top: 20px;
  transition: background-color 0.3s;
}

.btn:hover{
    opacity: 0.7;
}

@media screen and (max-width: 600px) {
    header {
        padding: 15px 5%;
    }

    .navbar {
        
        align-items: center;
        text-align: center;
        display: flex;
        position: absolute;
        top: 70px;
        left: 0;
        right: 0;
        background: var(--bg-color);
        box-shadow: 0px 14px 18px 0 rgba(0, 0, 0, 0.2);
        margin-bottom: 60px;

    }

    .navbar.active {
        display: flex;
    }

    .navbar a {
        margin: 10px 0;
        font-size: 15px;
        padding: 5px 5px;
    }

    #menu-icon {
        display: block;
    }

    .logo {
        width: 100px; /* Adjust size as needed */
        height: 100px; /* Adjust size as needed */
    }

    .formContainer {
        margin-top: 100px;
    }

    .formContainer form {
        width: 90%;
    }

    .formContainer input[type=text] {
        width: 100%;
    }

    .result {
        width: 90%;
        margin-left: auto;
        margin-right: auto;
    }

    .welcome {
        padding: 50px 0;
    }

    .container-welcome {
        text-align: center;
    }
}


    </style>
</head>
<body>
<header>
        <!-- <a href="#" class="logo">StarWhirl</a> -->
            <img src="images/starWhirl.png" alt="" class="logo">
        
    
        <ul class="navbar">
            <li><a href="index.php">Tracking</a></li>
            <li><a href="services.php">Services</a></li>
            <li><a href="aboutus.php">About Us</a></li>
        </ul>
    
        <div class="icons">
            

            
            
            <a href="login.php">Login</a>
            
        </div>
    </header>  

    
    <div class="formContainer">
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <div class="searchContainer">
    <input   type="text"  placeholder="Enter Tracking Number"   name="trackingNumber" required>
    <input type="submit" value="Track"> 
    </div>
    </div>
</form>

</div>

<?php
// Replace these variables with your actual database credentials
include('dbcon.php');
function getServiceName($conn, $service_id) {
    $serviceSql = "SELECT serviceName FROM services WHERE service_id = '$service_id'";
    $serviceResult = $conn->query($serviceSql);

    if ($serviceResult) {
        // Check if any rows are returned
        if ($serviceResult->num_rows > 0) {
            $serviceRow = $serviceResult->fetch_assoc();
            return $serviceRow["serviceName"];
        } else {
            return "Service not found";
        }
    } else {
        // Handle query error
        return "Error fetching service name: " . $conn->error;
    }
}


function getDetergent($conn, $detergent_id) {
    $detergentSql = "SELECT detergent_name FROM detergents WHERE detergent_id = '$detergent_id'";
    $detergentResult = $conn->query($detergentSql);

    if ($detergentResult) {
        // Check if any rows are returned
        if ($detergentResult->num_rows > 0) {
            $detergentRow = $detergentResult->fetch_assoc();
            return $detergentRow["detergent_name"];
        } else {
            return "Detergent not found";
        }
    } else {
        // Handle query error
        return "Error fetching detergent name: " . $conn->error;
    }
}

function getFabric($conn, $fabric_softener_id) {
    $fabricSql = "SELECT fabric_softener_name FROM fabric_softeners WHERE fabric_softener_id = '$fabric_softener_id'";
    $fabricResult = $conn->query($fabricSql);

    if ($fabricResult) {
        // Check if any rows are returned
        if ($fabricResult->num_rows > 0) {
            $fabricRow = $fabricResult->fetch_assoc();
            return $fabricRow["fabric_softener_name"];
        } else {
            return "Fabric Softener not found";
        }
    } else {
        // Handle query error
        return "Error fetching fabric softener name: " . $conn->error;
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $trackingNumber = $_POST["trackingNumber"];

    // Query to fetch tracking information based on trackingNumber
    $trackingSql = "SELECT * FROM trackings WHERE trackingNumber = '$trackingNumber'";
    $trackingResult = $conn->query($trackingSql);

    if ($trackingResult->num_rows > 0) {
        $trackingRow = $trackingResult->fetch_assoc();
        $status = $trackingRow["status"];
        $transactionId = $trackingRow["transaction_id"];

        // Query to fetch transaction information based on transaction_id
        $transactionSql = "SELECT t.*, c.firstname AS customer_firstname, c.lastname AS customer_lastname , numberofLoads as loads, numberofClothing as clothing
        FROM transactions t
        JOIN customers c ON t.customer_id = c.customer_id
        WHERE t.transaction_id = '$transactionId'";


        $transactionResult = $conn->query($transactionSql);
      
        if ($transactionResult->num_rows > 0) {
            $transactionRow = $transactionResult->fetch_assoc();

       echo  "<div class='result'>";
       echo "<center>";  
// Display transaction and tracking information
echo "<h2>Transaction Details</h2>";
echo "<p>Tracking Number: $trackingNumber</p>";
echo "<p><strong>Status: $status</strong></p>";


echo "<p>Customer Name: " . $transactionRow["customer_firstname"] . " " . $transactionRow["customer_lastname"] . "</p>";
// Check if keys exist before accessing them
echo isset($transactionRow["service_id"]) ? "<p>Service: " . getServiceName($conn, $transactionRow["service_id"]) . "</p>" : "";
echo isset($transactionRow["timeOfDropOff"]) ? "<p>Time of Drop Off: " . $transactionRow["timeOfDropOff"] . "</p>" : "";
echo !empty(trim($transactionRow["loads"])) ? "<p>Number of Loads: " . $transactionRow["loads"] . "</p>" : "<p>Number of Loads not available</p>";
echo !empty(trim($transactionRow["clothing"])) ? "<p>Number of Clothing: " . $transactionRow["clothing"] . "</p>" : "<p>Number of Clothing not available</p>";
echo isset($transactionRow["paymentStatus"]) ? "<p>Payment Status: " . $transactionRow["paymentStatus"] . "</p>" : "";
echo isset($transactionRow["detergent_id"]) ? "<p>Detergent Details: " . getDetergent($conn, $transactionRow["detergent_id"]) . "</p>" : "";
echo isset($transactionRow["fabric_softener_id"]) ? "<p>Fabric Softener Details: " . getFabric($conn, $transactionRow["fabric_softener_id"]) . "</p>" : "";

echo isset($transactionRow["totalCost"]) ? "<p>Total Cost: " . $transactionRow["totalCost"] . "</p>" : "";
echo "</center>";
echo "</div>";

        } else {
            echo "Error: Transaction not found.";
        }
    } else {
        echo "Error: Tracking number not found.";
    }
}
?>

</div>
</div>
<section class="welcome">
            <div class="container-welcome">
                <h1>Or just sit back and let us notify you!</h1>
                <p>Get live updates and track your laundry in real-time on your favorite website.</p>
                <a href="signup.php" class="btn">Signup Now</a>
            </div>
        </section>  

</head>
</body>
</html>
