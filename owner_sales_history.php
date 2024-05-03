<?php
include('dbcon.php');
session_start();

// Default sorting order
$sortingOrder = 'DESC';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["sort_by_date"])) {
        // User selected to sort by date
        $sortingOrder = $_POST["sorting_order"];
    }

    // Update the selected customer, staff, and service variables
    $selectedCustomer = $_POST['selected_customer'] ?? '';
    $selectedStaff = $_POST['selected_staff'] ?? '';
    $selectedService = $_POST['selected_service'] ?? '';

    // Check if "View All" buttons are clicked
    if (isset($_POST['view_all'])) {
        $selectedCustomer = ''; // Reset selected customer
        $selectedStaff = ''; // Reset selected staff
        $selectedService = '';
        $selectedMonth = ''; // Reset selected service

    }
}

// Fetch distinct customer names from the database
$customerSql = "SELECT DISTINCT CONCAT(customers.firstname, ' ', customers.lastname) AS customer_name
                FROM customers";
$customerResult = $conn->query($customerSql);

// Fetch distinct staff names from the database
$staffSql = "SELECT DISTINCT CONCAT(staffs.firstname, ' ', staffs.lastname) AS staff_name
             FROM staffs";
$staffResult = $conn->query($staffSql);

// Fetch distinct service names from the database
$serviceSql = "SELECT DISTINCT serviceName FROM services";
$serviceResult = $conn->query($serviceSql);

// Fetch all paid transactions data from the database
$sql = "SELECT transactions.transaction_id, 
           customers.firstname AS customer_firstname,
           customers.lastname AS customer_lastname,
           staffs.firstname AS staff_firstname,
           staffs.lastname AS staff_lastname,
           transactions.timeOfDropOff,
           services.serviceName,
           transactions.numberofLoads,
           transactions.numberofClothing,
           detergents.detergent_name,
           fabric_softeners.fabric_softener_name,
           trackings.trackingNumber,
           trackings.status,
           transactions.totalCost,
           transactions.paymentStatus
    FROM transactions
    JOIN customers ON transactions.customer_id = customers.customer_id
    JOIN staffs ON transactions.staff_id = staffs.staff_id
    INNER JOIN services ON transactions.service_id = services.service_id
    JOIN detergents ON transactions.detergent_id = detergents.detergent_id
    JOIN fabric_softeners ON transactions.fabric_softener_id = fabric_softeners.fabric_softener_id
    LEFT JOIN trackings ON transactions.transaction_id = trackings.transaction_id
    WHERE transactions.paymentStatus = 'Paid' AND trackings.status = 'Finished' ";

// Add conditions to filter by customer, staff, and service if selected
if (!empty($selectedCustomer)) {
    $sql .= " AND CONCAT(customers.firstname, ' ', customers.lastname) LIKE '%$selectedCustomer%'";
}

if (!empty($selectedStaff)) {
    $sql .= " AND CONCAT(staffs.firstname, ' ', staffs.lastname) LIKE '%$selectedStaff%'";
}

if (!empty($selectedService)) {
    $sql .= " AND services.serviceName LIKE '%$selectedService%'";
}

$selectedMonth = $_POST['selected_month'] ?? '';

if (!empty($selectedMonth)) {
    $sql .= " AND MONTH(transactions.timeOfDropOff) = '$selectedMonth'";
}


$sql .= " ORDER BY transactions.timeOfDropOff $sortingOrder";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<form method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
    echo "<label>Sort by Date:</label>";
    echo "<select name='sorting_order'>";
    echo "<option value='DESC'>Latest to Oldest</option>";
    echo "<option value='ASC'>Oldest to Latest</option>";
    echo "</select>";

    echo "<label>Select Customer:</label>";
    echo "<select name='selected_customer'>";
    echo "<option value=''>All Customers</option>"; // Option to view all transactions
    while ($customerRow = $customerResult->fetch_assoc()) {
        $customerName = $customerRow['customer_name'];
        echo "<option value='$customerName' " . ($selectedCustomer == $customerName ? 'selected' : '') . ">$customerName</option>";
    }
    echo "</select>";

    // Hidden input to retain selected customer value
    echo "<input type='hidden' name='hidden_selected_customer' value='" . ($selectedCustomer ?? '') . "'>";

    echo "<label>Select Staff:</label>";
    echo "<select name='selected_staff'>";
    echo "<option value=''>All Staff</option>"; // Option to view all transactions
    while ($staffRow = $staffResult->fetch_assoc()) {
        $staffName = $staffRow['staff_name'];
        echo "<option value='$staffName' " . ($selectedStaff == $staffName ? 'selected' : '') . ">$staffName</option>";
    }
    echo "</select>";

    // Hidden input to retain selected staff value
    echo "<input type='hidden' name='hidden_selected_staff' value='" . ($selectedStaff ?? '') . "'>";

    echo "<label>Select Service:</label>";
    echo "<select name='selected_service'>";
    echo "<option value=''>All Services</option>"; // Option to view all transactions
    while ($serviceRow = $serviceResult->fetch_assoc()) {
        $serviceName = $serviceRow['serviceName'];
        echo "<option value='$serviceName' " . ($selectedService == $serviceName ? 'selected' : '') . ">$serviceName</option>";
    }
    echo "</select>";

    // Hidden input to retain selected service value
   echo "<input type='hidden' name='hidden_selected_month' value='" . ($selectedMonth ?? '') . "'>";


    echo "<label>Select Month:</label>";
    echo "<select name='selected_month'>";
    echo "<option value=''>All Months</option>"; // Option to view all transactions
    $months = [
        '01' => 'January', '02' => 'February', '03' => 'March',
        '04' => 'April', '05' => 'May', '06' => 'June',
        '07' => 'July', '08' => 'August', '09' => 'September',
        '10' => 'October', '11' => 'November', '12' => 'December'
    ];
    foreach ($months as $monthNum => $monthName) {
        echo "<option value='$monthNum' " . ($selectedMonth == $monthNum ? 'selected' : '') . ">$monthName</option>";
    }
    echo "</select>";
    







    echo "<button type='submit' name='sort_by_date'>Sort</button>";
    echo "<button type='submit' name='view_all'>View All Transactions</button>";
    // Add the print button here
echo "<button type='button' onclick='printContent()'>Print</button>";
    echo "</form>";
echo '<div class="printable">';
echo "<style>
        .printable table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .printable th, .printable td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .printable th {
            background-color: #f2f2f2;
        }
    </style>";

echo "<table border='1'>";
echo "<tr>
        <th>Transaction ID</th>
        <th>Customer Name</th>
        <th>Tracking Number</th>
        <th>Status</th>
        <th>Staff</th>
        <th>Service Type</th>
        <th>Details</th>
      </tr>";

// Output data of each row
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["transaction_id"] . "</td>";
    echo "<td>" . $row["customer_firstname"] . " " . $row["customer_lastname"] . "</td>";
    echo "<td>" . $row["trackingNumber"] . "</td>";
    echo "<td>" . $row["status"] . "</td>";
    echo "<td>" . $row["staff_firstname"] . " " . $row["staff_lastname"] . "</td>";
    echo "<td>" . $row["serviceName"] . "</td>";
    
    // Combine the desired columns into a single column
    $combinedInfo = "Drop off Time: ".$row["timeOfDropOff"] . "<br>" .
                    "Number of Loads: " . $row["numberofLoads"] . "<br>" .
                    "Number of Clothing: " . $row["numberofClothing"] . "<br>" .
                    "Detergent Details: " . $row["detergent_name"] . "<br>" .
                    "Fabric Softener Details: " . $row["fabric_softener_name"] . "<br>" .
                    "Total Cost: " . $row["totalCost"] . "<br>" .
                    "Payment Status: " . $row["paymentStatus"];
    
    echo "<td>" . $combinedInfo . "</td>";
    echo "</tr>";
}
echo "</table>";
echo '</div>';

} else {
    echo "No paid transactions found.";
}


$conn->close();
?>

<a href="owner_dashboard.php">Back to Home</a>
<script>

function printContent() {
    var printWindow = window.open('', '_blank');
        printWindow.document.write('<html><head><title>Print</title></head><body>');
        printWindow.document.write(document.querySelector('.printable').innerHTML);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    }
</script>
</body>
</html>
