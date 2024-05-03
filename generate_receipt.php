<?php
require_once('tcpdf/tcpdf.php');

function getServiceName($conn, $service_id) {
    $serviceSql = "SELECT serviceName FROM services WHERE service_id = '$service_id'";
    $serviceResult = $conn->query($serviceSql);

    if ($serviceResult) {
        if ($serviceResult->num_rows > 0) {
            $serviceRow = $serviceResult->fetch_assoc();
            return $serviceRow["serviceName"];
        } else {
            return "Service not found";
        }
    } else {
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


function generateReceipt($transactionId, $trackingNumber, $paymentId) {
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
   // Get the transaction ID and tracking number

   
    // Fetch transaction and tracking details
    $sql = "SELECT t.*, tr.*, c.firstname AS customer_firstname, c.lastname AS customer_lastname, p.payment_id
        FROM transactions t
        JOIN trackings tr ON t.transaction_id = tr.transaction_id
        JOIN customers c ON t.customer_id = c.customer_id
        JOIN payments p ON t.transaction_id = p.transaction_id
        WHERE t.transaction_id = '$transactionId' AND tr.trackingNumber = '$trackingNumber' AND p.payment_id = '$paymentId'";


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();


        // Fetch service name
        $name = $row["customer_firstname"].' '.$row["customer_lastname"] ;
        
        $service_id = $row["service_id"];
        $serviceName = getServiceName($conn, $service_id);
        $timeOfDropOff = $row["timeOfDropOff"];
        $loads = $row["numberOfLoads"];
        $clothing = $row["numberOfClothing"];
        $detergent_id = $row["detergent_id"];
        $detergentDetails = getDetergent($conn, $detergent_id);

        $fabric_softener_id = $row["fabric_softener_id"];
        $fabricSoftenerDetails = getFabric($conn, $fabric_softener_id);
        $paymentStatus = $row["paymentStatus"];


        // Other details...
        $totalCost = $row["totalCost"];
        $tenderedAmount = $row["tenderedAmount"];
        $changeAmount = $row["changeAmount"];

        // Create a new PDF document
        $pdf = new TCPDF();

// Add a page to the PDF
// Add a page to the PDF
$pdf->AddPage();

// Set font
$pdf->SetFont('helvetica', 'B', 12); // Set font style to bold

// Header
$pdf->Cell(0, 10, 'STARWHIRL LAUNDRY SERVICES', 0, 1, 'C'); // Centered header
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 0, 'Address: Bantayan, Dumaguete City, Negros Oriental, 6200', 0, 1, 'C');
$pdf->Cell(0, 0, 'Phone: 095634556785 | Email: starwhirl@gmail.com', 0, 1, 'C');
$pdf->Cell(0, 0, 'Website: www.starwhirl.com', 0, 1, 'C');
$pdf->Cell(0, 0, 'JEANICA G. BELNAS-Prop', 0, 1, 'C');
$pdf->Cell(0, 0, 'Non-VAT Reg. TIN # 733-259-577-00000', 0, 1, 'C');
$currentDate = date('Y-m-d');
$currentTime = date('H:i:s');
$pdf->Cell(0, 0, "$currentDate   $currentTime", 0, 1, 'R');

// No bottom margin for this line
$pdf->setCellHeightRatio(0);
$pdf->Cell(0, 0, '---------------------------------------------------------------------------------------------------------------------------------------', 0, 1, 'C');
$pdf->setCellHeightRatio(1);

// Receipt Information
$pdf->SetFont('helvetica', 'B', 12); // Set font style to bold
$pdf->Cell(0, 10, 'OFFICIAL RECEIPT', 0, 1, 'C'); // Centered receipt heading
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, "Transaction ID: $transactionId                                                                                              OR Number: $paymentId", 0, 1, 'L');
$pdf->setCellHeightRatio(0);
$pdf->Cell(0, 0, '---------------------------------------------------------------------------------------------------------------------------------------', 0, 1, 'C');
$pdf->setCellHeightRatio(1);
// Laundry Transaction Details
$pdf->SetFont('helvetica', 'B', 12); // Set font style to bold
$pdf->Cell(0, 10, 'LAUNDRY TRANSACTION DETAILS', 0, 1, 'C'); // Centered transaction heading
$pdf->SetFont('helvetica', '', 12);
$pdf->MultiCell(0, 0, "Name: $name\nTracking Number: $trackingNumber\nTime of Drop Off: $timeOfDropOff\nNumber of Loads: $loads\nNumber of Clothing: $clothing\nDetergent Details: $detergentDetails\nFabric Softener: $fabricSoftenerDetails\nService: $serviceName\nTotal Cost: $totalCost\nAmount Tendered: $tenderedAmount\nChange: $changeAmount", 0, 'L');

// No bottom margin for this line
$pdf->setCellHeightRatio(0);
$pdf->Cell(0, 10, '---------------------------------------------------------------------------------------------------------------------------------------', 0, 1, 'C');
$pdf->setCellHeightRatio(1);

// Footer
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, 'Thank you for using StarWhirl Laundry Services!', 0, 1, 'C'); // Centered footer

// Output the PDF
$pdf->Output('receipt.pdf', 'I');

    } else {
        echo "Error: Transaction details not found.";
    }

    // Close the database connection
    $conn->close();

}

// Get the transaction ID and tracking number
$transactionId = $_GET['transactionId'] ?? '';
$trackingNumber = $_GET['trackingNumber'] ?? '';
$paymentId = $_GET['paymentId'] ?? '';

// Call the function to generate the receipt
generateReceipt($transactionId, $trackingNumber, $paymentId);
?>

