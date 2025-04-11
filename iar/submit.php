<?php
$host = "localhost";
$user = "root"; // change if needed
$pass = "";
$db = "dbpsa";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// General fields
$supplier = $_POST['supplier'];
$pr_no = $_POST['pr_no'];
$iar_no = $_POST['iar_no'];
$date = $_POST['date'];
$invoice_no = $_POST['invoice_no'];
$rcc = $_POST['responsibility_center'];
$d = $_POST['invoice_date']; // this goes to `d`
$date_inspected = $_POST['date_inspected'];
$date_recieved = $_POST['final_date_received'];
$i_officer = $_POST['i_officer']; // fixed for now, or pull from input if needed
$custodian = $_POST['custodian']; // same

// Arrays for multiple items
$property_no = $_POST['property_no'];
$descd = $_POST['descd'];
$unit = $_POST['unit'];
$quantity = $_POST['quantity'];

$sql = "INSERT INTO tbl_iar (
    supplier, pr_no, iar_no, date, property_no, descd, unit, quantity,
    invoice_no, rcc, d, date_inspected, date_recieved, i_officer, custodian
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

for ($i = 0; $i < count($property_no); $i++) {
    if (!empty($property_no[$i]) || !empty($descd[$i])) {
        $stmt->bind_param(
            "sssssssisssssss",
            $supplier, $pr_no, $iar_no, $date,
            $property_no[$i], $descd[$i], $unit[$i], $quantity[$i],
            $invoice_no, $rcc, $d, $date_inspected, $date_recieved,
            $i_officer, $custodian
        );
        
        $stmt->execute();
    }
}

$stmt->close();
$conn->close();

echo json_encode(['success' => true, 'message' => 'Form submitted successfully.']);
?>
