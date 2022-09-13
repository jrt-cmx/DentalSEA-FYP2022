<?php
session_start();
require('../connection/db.php');
$return = '';
if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($link, $_POST["query"]);
    $query = "(SELECT patientID, patientName, gender, phoneNO, 'patient' as type FROM patient 
    WHERE patientID LIKE '%" . $search . "%' OR 
    patientName LIKE '%" . $search . "%' OR 
    gender LIKE '%" . $search . "%' OR 
    phoneNO LIKE '%" . $search . "%')
	";
} else {
    $query = "SELECT *, patientID FROM patient";
}
$result = mysqli_query($link, $query);
if (mysqli_num_rows($result) > 0) {
    $return .= '
    <div class="table-section">
    <table class="patient-table">
        <thead>
            <tr class="table-header-row">
                <th id="table-id" class="table-id">ID</th>
                <th id="table-title" class="table-title">Title</th>
                <th id="table-name" class="table-name">Name</th>
                <!-- <th id="table-name" class="table-name"><i class="fa-solid fa-magnifying-glass"></i>
                    <input id="searchInput" type="text" placeholder="Name">
                </th> -->
                <th id="table-gender" class="table-gender">Gender</th>
                <th id="table-number" class="table-number">Phone Number</th>
                <th id="table-email" class="table-email">Email</th>
                <th id="table-action" class="table-action">Action</th>
            </tr>
        </thead>';
    while ($row = mysqli_fetch_array($result)) {
        $return .= "
        <tbody>
		<tr class='table-input'>
                            <td class='table-row table-id'>" . $row["patientID"] . "</td>
                            <td class='table-row table-title'>" . $row["title"] . "</td>
                            <td class='table-row table-name'>" . $row["patientName"] . "</td>
                            <td class='table-row table-gender'>" . $row["sex"] . "</td>
                            <td class='table-row table-number'>" . $row["phoneNO"] . "</td>
                            <td class='table-row table-email'>" . $row["email"] . "</td>
                            <td class='table-row table-action'><i class='fa-solid fa-notes-medical'></i>" . "</td>
                            </tr>";
    }
    echo $return;
} else {
    echo 'No results containing all your search terms were found.';
}
