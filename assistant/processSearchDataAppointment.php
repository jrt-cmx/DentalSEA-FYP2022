<?php

session_start();
require('../connection/db.php');
$return = '';
if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($link, $_POST["query"]);
    $query = "SELECT appointmentID, ICorPassportNo, dentistID, assistantID, startTime, endTime, type, remarks FROM appointment
	WHERE appointmentID  LIKE '%" . $search . "%'
	OR dentistID LIKE '%" . $search . "%' 
	OR ICorPassportNo LIKE '%" . $search . "%' 
	OR assistantID LIKE '%" . $search . "%' 
    OR startTime LIKE '%" . $search . "%'
    OR endTime LIKE '%" . $search . "%'  
	OR type LIKE '%" . $search . "%' 
	OR remarks LIKE '%" . $search . "%' 
	";
} else {
    $query = "SELECT appointmentID, ICorPassportNo, dentistID, assistantID, startTime, endTime, type, remarks FROM appointment";
}
$result = mysqli_query($link, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row1 = mysqli_fetch_array($result)) {
        $return .= '
		    <div class="table-row">
                <p class="table-column-input ">' . $row1['appointmentID'] . '</p>
                <p class="table-column-input ">' . $row1['type'] . '</p>
                <p class="table-column-input ">' . $row1['ICorPassportNo'] . '</p>
                <p class="table-column-input column-four">' . $row1['dentistID'] . '</p>
                <p class="table-column-input column-five">' . $row1['startTime'] . '</p>
                <p class="table-column-input column-six">' . $row1['endTime'] . '</p>
                <p class="table-column-input action">
                    <a class="column-input-link" href="../assistant/viewAppointment.php?appointmentID=' . $row1['appointmentID'] . '">
                        <i class="fa-solid fa-eye"></i></a>' . "
                    <a class='column-input-link' href='../assistant/updateAppointment.php?appointmentID=" . $row1['appointmentID'] . "'>
                        <i class='fa-solid fa-pen'></i></a>" . "
                    <a class='column-input-link' onClick=\"javascript: return confirm('Please confirm deletion for Appointment " . $row1['appointmentID'] . " ');\" 
                        href='../assistant/deleteAppointment.php?appointmentID=" . $row1['appointmentID'] . "'>
                        <i class='fa-solid fa-trash-can'></i></a>" . "
                </p>
		    </div>";
    }
    echo $return;
} else {
    echo 'No results containing all your search terms were found.';
}



// <th id="table-remarks" class="table-remarks">Remarks</th>
// <td class="table-row table-remarks">' . $row1['remarks'] . '</td>

// <p class="table-column-header">type</p>
// <p class="table-column-input table-type">' . $row1['type'] . '</p>
// <p class="table-column-header">Assistant ID</p>
// <p class="table-column-input table-aID">' . $row1['assistantID'] . '</p>
