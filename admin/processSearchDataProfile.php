<?php
session_start();
require('../connection/db.php');
$return = '';
if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($link, $_POST["query"]);
    $query = "(SELECT loginID, fName, lName, 'admin' as type FROM admin WHERE loginID LIKE '%" . $search . "%' OR fName LIKE '%" . $search . "%' OR lName LIKE '%" . $search . "%')
             UNION
             (SELECT loginID, fName, lName, 'dentalassistant' as type FROM dentalassistant WHERE loginID LIKE '%" . $search . "%' OR fName LIKE '%" . $search . "%' OR lName LIKE '%" . $search . "%')
             UNION
             (SELECT loginID, fName, lName, 'dentist' as type FROM dentist WHERE loginID LIKE '%" . $search . "%' OR fName LIKE '%" . $search . "%' OR lName LIKE '%" . $search . "%')
	";
} else {
    $query = "SELECT *, useraccount.userType
                        FROM admin
                        INNER JOIN useraccount ON admin.loginID = useraccount.loginID
                        UNION ALL
                        SELECT *, useraccount.userType
                        FROM dentalassistant
                        INNER JOIN useraccount ON dentalassistant.loginID = useraccount.loginID
                        UNION ALL
                        SELECT *, useraccount.userType
                        FROM dentist
                        INNER JOIN useraccount ON dentist.loginID = useraccount.loginID ";
}
$result = mysqli_query($link, $query);
if (mysqli_num_rows($result) > 0) {
    while ($row1 = mysqli_fetch_array($result)) {
        $return .= '
		<div class="table-row">
            <p class="table-column-input">' . $row1["loginID"] . '</p>
		<p class="table-column-header column-four"></p>
            <p class="table-column-input">' . $row1["fName"] . '</p>
		<p class="table-column-header column-five"></p>
            <p class="table-column-input">' . $row1["lName"] . '</p>
		<p class="table-column-header column-six"></p>
            <p class="table-column-input action">' . "
                <a class='column-input-link' href='updateUserProfile.php?loginID=" . $row1['loginID'] . "'>
                <i class='fa-solid fa-pen'></i></a>
                <a class='column-input-link' onClick=\"javascript: return confirm('Please confirm deletion for " . $row1['loginID'] . "');\" 
                href=\"delete.php?loginID=" . $row1['loginID'] . "\">
                    <i class='fa-solid fa-trash-can'></i></a>" . '
            </p>
		</div>';
    }
    echo $return;
} else {
    echo 'No results containing all your search terms were found.';
}
