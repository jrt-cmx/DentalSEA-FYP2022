<?php
session_start();
require('../connection/db.php');
$return = '';
if (isset($_POST["query"])) {
	$search = mysqli_real_escape_string($link, $_POST["query"]);
	$query = "SELECT * FROM medication
	WHERE medicationName  LIKE '%" . $search . "%'
	OR description LIKE '%" . $search . "%' 
	ORDER BY medicationID ASC
	";
} else {
	$query = "SELECT * FROM medication ORDER BY medicationID ASC";
}
$result = mysqli_query($link, $query);
if (mysqli_num_rows($result) > 0) {
	while ($row1 = mysqli_fetch_array($result)) {
		$return .= '
		<div class="table-row">
		<p class="table-column-input">' . $row1["medicationID"] . '</p>
		<p class="table-column-input">' . $row1["medicationName"] . '</p>
		<p class="table-column-input column-five">' . $row1["price"] . '</p>
		<p class="table-column-input column-four">' . $row1["expiryDate"] . '</p>
		<p class="table-column-input">' . $row1["quantity"] . '</p>
		<p class="table-column-input column-six">' . "" . '</p>
		<p class="table-column-input action">' . "
			<a class='column-input-link' onClick=\"javascript: return confirm('Please confirm deletion for " . $row1['medicationName'] . "');\" 
				href=\"../assistant/deleteMedicine.php?medicationID=" . $row1['medicationID'] . "\">
				<i class='fa-solid fa-trash-can'></i></a>" . '
		</p>
		</div>';
	}
	echo $return;
} else {
	echo 'No results containing all your search terms were found.';
}



// <td class="table-column-input">' . $row1["description"] . '</td>
