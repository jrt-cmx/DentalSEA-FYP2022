<?php

session_start();
require('../connection/db.php');
$return = '';
if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($link, $_POST["query"]);
    $query = "SELECT patientID, title, ICorPassportNo, phoneNO, patientName, sex, origin FROM patient
	WHERE patientID  LIKE '%" . $search . "%'
	OR title LIKE '%" . $search . "%' 
	OR ICorPassportNo LIKE '%" . $search . "%' 
    OR phoneNO LIKE '%" . $search . "%'
	OR patientName LIKE '%" . $search . "%' 
	OR sex LIKE '%" . $search . "%' 
	OR origin LIKE '%" . $search . "%' 
	";
} else {
    $query = "SELECT patientID, title, ICorPassportNo, phoneNO, patientName, sex, origin FROM patient";
}
$result = mysqli_query($link, $query);
if (mysqli_num_rows($result) > 0) {
        while ($row1 = mysqli_fetch_array($result)) {
        $return .= '
		    <div class="table-row"> 
                <p class="table-column-input">' . $row1['title'] . '</p>
                <p class="table-column-input">' . $row1['patientName'] . '</p>
                <p class="table-column-input  column-three">' . $row1['ICorPassportNo'] . '</p>
                <p class="table-column-input  column-four">' . $row1['phoneNO'] . '</p>
                <p class="table-column-input  column-five">' . $row1['sex'] . '</p>
                <p class="table-column-input  column-six">' . $row1['origin'] . '</p>
                <p class="table-column-input action">
                    <a class="column-input-link" href="../assistant/viewPatient.php?patientID=' . $row1['patientID'] . '&idNo='.$row1['ICorPassportNo'].'">
                        <i class="fa-solid fa-eye"></i></a>' . "
                    <a class='column-input-link' href='../assistant/updatePatient.php?patientID=" . $row1['patientID'] . "'>
                        <i class='fa-solid fa-pen'></i></a>" . "
                    <a class='column-input-link' onClick=\"javascript: return confirm('Please confirm deletion for " . $row1['patientName'] . " ');\" 
                        href='../assistant/deletePatient.php?patientID=" . $row1['patientID'] . "&idNo=". $row1['ICorPassportNo'] ."'>
                        <i class='fa-solid fa-trash-can'></i></a>" . "
                </p>
		    </div>";
        }
    echo $return;
} else {
    echo 'No results containing all your search terms were found.';
}
