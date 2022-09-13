<?php
session_start();
require('../connection/db.php');
$return = '';
$paid = 'PAID';
$unpaid = 'UNPAID';

$query1 = "SELECT payment FROM invoice where payment = '$paid'";
$result1 = mysqli_query($link, $query1) or die(mysqli_error($link));

if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($link, $_POST["query"]);
    $query = "SELECT * FROM invoice
	WHERE invoiceID  LIKE '%" . $search . "%'
	OR prescriptionID LIKE '%" . $search . "%'  
	OR patientName LIKE '%" . $search . "%' 
	";
} else {
    $query = "SELECT * FROM invoice ORDER BY prescriptionID desc ";
}
$result = mysqli_query($link, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row1 = mysqli_fetch_array($result))
    {
        $return .= '
		<div class="table-row">
		<p class="table-column-input">' . $row1["invoiceID"] . '</p>
		<p class="table-column-input">' . $row1["patientName"] . '</p>
		<p class="table-column-input">' . $row1["date"] . '</p>
		<p class="table-column-input column-four">' . $row1["remarks"] . '</p>
		<p class="table-column-input column-five">' . '$' . $row1["price"] . '</p>
		<p class="table-column-input column-six">' . $row1["payment"] . '</p>
		<p class="table-column-input action">'."
			<a class='column-input-link'href='viewInvoice.php?invoiceID=".$row1['invoiceID']."'>
			<i class='fa-solid fa-eye'></i></a>
			<a class='column-input-link' href='editInvoice.php?invoiceID=".$row1['invoiceID']."'>
			<i class='fa-solid fa-pen'></i></a>".'
		</p>
		</div>';
    }
    echo $return;
} else {
    echo 'No results containing all your search terms were found.';
}

// <p class="table-column-header">Prescription ID</p>
// <p class="table-row">' . $row1["prescriptionID"] . '</p>
// <p class="table-column-header">NRIC</p>
// <p class="table-row">' . $row1["NRIC"] . '</p>
