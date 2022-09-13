<?php
session_start();
require('../connection/db.php');
$return = '';
if (isset($_POST["query"])) {
	$search = mysqli_real_escape_string($link, $_POST["query"]);
	$query = "SELECT * FROM useraccount
	WHERE loginID  LIKE '%" . $search . "%'
	OR userType LIKE '%" . $search . "%' 
	";
} else {
	$query = "SELECT * FROM useraccount";
}
$result = mysqli_query($link, $query);
if (mysqli_num_rows($result) > 0) {
	while ($row1 = mysqli_fetch_array($result)) {
		$return .= '
		<div class="table-row">
		<p class="table-column-input">' . $row1["loginID"] . '</p>
		<p class="table-column-input column-six">' . "" . '</p>
		<p class="table-column-input column-four">' . "" . '</p>
		<p class="table-column-input">' . $row1["userType"] . '</p>
		<p class="table-column-input">' . "" . '</p>
		<p class="table-column-input column-five">' . "" . '</p>
		<p class="table-column-input action">'."
			<a class='column-input-link' href='updateUserAccount.php?loginID=".$row1['loginID']."'>
			<i class='fa-solid fa-pen'></i></a>
			<a class='column-input-link' onClick=\"javascript: return confirm('Please confirm deletion for ".$row1['loginID']."');\" 
				href=\"delete.php?loginID=".$row1['loginID']."\">
				<i class='fa-solid fa-trash-can'></i></a>".'
		</p>
		</div>'; 
	}
	echo $return;
} else {
	echo 'No results containing all your search terms were found.';
}
