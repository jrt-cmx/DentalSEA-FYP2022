<?php
session_start();
include "../connection/db.php";

//initialize variable
//load previous data

$apptID = $idNo = $dID = $aID = $start =
    $end = $loc = $rmk = "";

if (isset($_GET['appointmentID'])) {
    $apptID = $_GET['appointmentID'];
}

$sql = "SELECT * FROM appointment WHERE appointmentID = '" . $apptID . "' ";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $idNo = $row['ICorPassportNo'];
        $dID = $row['dentistID'];
        $aID = $row['assistantID'];
        $start = $row['startTime'];
        $end = $row['endTime'];
        $loc = $row['type'];
        $rmk = $row['remarks'];
    }
    $theStart = date('Y-m-d\TH:i', strtotime($start));
    $theEnd = date('Y-m-d\TH:i', strtotime($end));
}

//load all selectable elements from db
//select all patient NRIC and Name
$sql = "SELECT patientName FROM patient WHERE ICorPassportNo='$idNo'";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pName = $row['patientName'];
    }
}

//select all dentist id and first name
$sql2 = "SELECT fName, lName FROM dentist WHERE loginID='$dID'";
$result2 = $link->query($sql2);

if ($result2->num_rows > 0) {
    while ($row2 = $result2->fetch_assoc()) {
        $dFName = $row2['fName'];
        $dLName = $row2['lName'];
    }
}

//select all assistant id and first name
$sql3 = "SELECT fName, lName FROM dentalassistant WHERE loginID='$aID'";
$result3 = $link->query($sql3);

if ($result3->num_rows > 0) {
    while ($row3 = $result3->fetch_assoc()) {
        $aFName = $row3['fName'];
        $aLName = $row3['lName'];
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <!--------------------- Head --------------------->
    <?php include "../includes/head.php" ?>
    <title> View Appointment </title>
</head>

<body class="body">
    <!--------------------- Header --------------------->
    <?php include "../includes/header.php"; ?>
    <!--------------------- Side Bar --------------------->
    <?php include "../includes/navBar/navBar.php"; ?>
    <?php include "../includes/sideBar.php"; ?>


    <div class="home-section">
        <div class="form--top">
            <h2 class="page-title">Appointment Information</h2>
        </div>
        <div class="form appointment-form">
            <label class="form-label span-2">Appointment ID</label>
            <p class="form-input span-2"><?php echo $apptID; ?></p>
            <label class="form-label">Patient</label>
            <label class="form-label">Identification</label>
            <p class="form-input"><?php echo $pName; ?></p>
            <p class="form-input"><?php echo $idNo; ?></p>
            <label class="form-label">Dentist</label>
            <label class="form-label">ID</label>
            <p class="form-input"><?php echo "$dFName $dLName"; ?></p>
            <p class="form-input"><?php echo "$dID"; ?></p>
            <label class="form-label">Assistant</label>
            <label class="form-label">ID</label>
            <p class="form-input"><?php echo "$aFName $aLName"; ?></p>
            <p class="form-input"><?php echo "$aID"; ?></p>
            <label class="form-label">Start time</label>
            <label class="form-label">End time</label>
            <p class="form-input"><?php echo $start; ?></p>
            <p class="form-input"><?php echo $end; ?></p>
            <label class="form-label span-2">Type</label>
            <p class="form-input span-2"><?php echo $loc; ?></p>
            <label class="form-label span-2">Remarks</label>
            <p class="form-input span-2 remarks"><?php echo $rmk; ?></p>
            <a class="btn-back span-2" href="appointment.php">Back</a>
        </div>

    <?php include "../includes/footer/footer.php"; ?>

        <!--------------------- Scripts --------------------->
        <?php include "../includes/scripts.php"; ?>
</body>

</html>