<?php
// DB connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "dbpsa"; // Adjust as needed

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get general fields
$division = $_POST['division'];
$office = $_POST['office'];
$rcc = $_POST['rcc'];
$ris_no = $_POST['ris_no'];
$purpose = $_POST['purpose'];

// Get item rows
$stock_no_arr = $_POST['stock_no'];
$unit_arr = $_POST['unit'];
$qty_arr = $_POST['qty'];
$i_qty_arr = $_POST['i_qty'];
$remarks_arr = $_POST['remarks'];

for ($i = 0; $i < count($stock_no_arr); $i++) {
    $stock_no = $conn->real_escape_string($stock_no_arr[$i]);
    $unit = $conn->real_escape_string($unit_arr[$i]);
    $qty = (int)$qty_arr[$i];
    $i_qty = (int)$i_qty_arr[$i];
    $remarks = $conn->real_escape_string($remarks_arr[$i]);

    // Only insert if stock_no and unit are not empty
    if (!empty($stock_no) && !empty($unit)) {
        $sql = "INSERT INTO tbl_ris (division, office, rcc, ris_no, stock_no, unit, qty, i_qty, remarks, purpose)
                VALUES ('$division', '$office', '$rcc', '$ris_no', '$stock_no', '$unit', $qty, $i_qty, '$remarks', '$purpose')";

        $conn->query($sql);
    }
}

echo json_encode(['success' => true, 'message' => 'Form submitted successfully.']);
?>
