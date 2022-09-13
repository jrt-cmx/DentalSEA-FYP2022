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
    $newStart = date('Y-m-d\TH:i', strtotime($start));
    $newEnd = date('Y-m-d\TH:i', strtotime($end));
}

//load all selectable elements from db
//select all patient NRIC and Name
$sql = "SELECT patientName, ICorPassportNo FROM patient";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pData[] = $row;
    }
}

//select all dentist id and first name
$sql2 = "SELECT loginID, fName FROM dentist";
$result2 = $link->query($sql2);

if ($result2->num_rows > 0) {
    while ($row2 = $result2->fetch_assoc()) {
        $dData[] = $row2;
    }
}

//select all assistant id and first name
$sql3 = "SELECT loginID, fName FROM dentalassistant";
$result3 = $link->query($sql3);

if ($result3->num_rows > 0) {
    while ($row3 = $result3->fetch_assoc()) {
        $aData[] = $row3;
    }
}

//select the selected patient name
$sql4 = "SELECT patientName FROM patient WHERE ICorPassportNo='$idNo'";
$result4 = $link->query($sql4);

if ($result4->num_rows > 0) {
    while ($row4 = $result4->fetch_assoc()) {
        $pName = $row4["patientName"];
    }
}

//select the selected dentist name
$sql5 = "SELECT fName FROM dentist WHERE loginID='$dID'";
$result5 = $link->query($sql5);

if ($result5->num_rows > 0) {
    while ($row5 = $result5->fetch_assoc()) {
        $dName = $row5["fName"];
    }
}

//select the selected assistant name
$sql6 = "SELECT fName FROM dentalassistant WHERE loginID='$aID'";
$result6 = $link->query($sql6);

if ($result6->num_rows > 0) {
    while ($row6 = $result6->fetch_assoc()) {
        $aName = $row6["fName"];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //initialize variable
    $newIdNo = $newDID = $newAID =
        $newStart = $newEnd = $newLoc = $newRmk = "";

    //fetch from session
    $appointID = $_POST['appointid'];
    $newIdNo = $_POST['idNo'];
    $newDID = $_POST['drID'];
    $newAID = $_POST['assistantID'];
    $newStart = $_POST['startTime'];
    $newEnd = $_POST['endTime'];
    $newLoc = $_POST['type'];
    $newRmk = $_POST['remarks'];

    $updateSQL = "UPDATE appointment 
                    SET ICorPassportNo='$newIdNo', dentistID='$newDID', 
                        assistantID='$newAID', startTime='$newStart', 
                        endTime='$newEnd', type='$newLoc', remarks='$newRmk'
                    WHERE appointmentID='$appointID'";

    $qRes = @mysqli_query($link, $updateSQL);

    if ($qRes === FALSE) {
        $_SESSION['errmsg'] = "Unable to add. Error code " . mysqli_errno($link) . " : " . mysqli_error($link);
        echo "<script>alert('Unable to update appointment');
                window.location.href='updateAppointment.php?appointmentID='" . $appointID . "';</script>";
    } else {
        echo "<script>alert('Appointment updated');
                window.location.href='appointment.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <!--------------------- Head --------------------->
    <?php include "../includes/head.php" ?>
    <title> Update Appointment </title>
</head>

<body class="body">
    <!--------------------- Header --------------------->
    <?php include "../includes/header.php"; ?>
    <!--------------------- Side Bar --------------------->
    <?php include "../includes/navBar/navBar.php"; ?>
    <?php include "../includes/sideBar.php"; ?>



    <div class="home-section">
        <div class="form--top">
            <h2 class="page-title">Update Appointment</h2>
        </div>
        <form class="form appointment-form" id="updateAppointment" method="POST" action="updateAppointment.php">

            <input type="hidden" id="appointid" name="appointid" value=<?php echo "$apptID"; ?>>
            <label class="form-label span-2">Patient Name: </label>
            <select class="form-select span-2" id="idNo" name="idNo">
                <option value=<?php echo "$idNo"; ?>><?php echo "$pName ($idNo)"; ?></option>
                <?php
                $temp1 = $temp2 = "";
                foreach ($pData as $key => $value) {
                    foreach ($value as $akey => $avalue) {
                        if ($akey == "patientName") {
                            $temp1 = $avalue;
                        } else {
                            $temp2 = $avalue;
                        }
                    }
                    if ($temp1 == "" || $temp2 == "") {
                        //parsing incomplete
                    } else {
                ?>
                        <option value=<?php echo "$temp2"; ?>><?php echo "$temp1 ($temp2)"; ?></option>
                <?php
                    }
                }
                ?>
            </select>

            <label class="form-label span-2">Doctor Name: </label>
            <select class="form-select span-2" id="drID" name="drID">
                <option value=<?php echo "$dID"; ?>><?php echo "Dr $dName ($dID)"; ?></option>
                <?php
                $temp3 = $temp4 = "";
                foreach ($dData as $key => $value) {
                    foreach ($value as $akey => $avalue) {
                        if ($akey == "loginID") {
                            $temp3 = $avalue;
                        } else {
                            $temp4 = $avalue;
                        }
                    }
                    if ($temp3 == "" || $temp4 == "") {
                        //parsing incomplete
                    } else {
                ?>
                        <option value=<?php echo "$temp3"; ?>><?php echo "Dr $temp4 ($temp3)"; ?></option>
                <?php
                    }
                }
                ?>
            </select>

            <label class="form-label span-2">Assistant Name: </label>
            <select class="form-select span-2" id="assistantID" name="assistantID">
                <option value=<?php echo "$aID"; ?>><?php echo "$aName ($aID)"; ?></option>
                <?php
                $temp5 = $temp6 = "";
                foreach ($aData as $key => $value) {
                    foreach ($value as $akey => $avalue) {
                        if ($akey == "loginID") {
                            $temp5 = $avalue;
                        } else {
                            $temp6 = $avalue;
                        }
                    }
                    if ($temp3 == "" || $temp4 == "") {
                        //parsing incomplete yet
                    } else {
                ?>
                        <option value=<?php echo "$temp5"; ?>><?php echo "$temp6 ($temp5)"; ?></option>
                <?php
                    }
                }
                ?>
            </select>

            <label class="form-label">Start Time</label>
            <label class="form-label">End Time</label>
            <input class="form-user-input" type="datetime-local" value=<?php echo "$newStart"; ?> id="startTime" name="startTime" required>

            <input class="form-user-input" type="datetime-local" value=<?php echo "$newEnd"; ?> id="endTime" name="endTime" required>

            <!-- <label style="color:red">Example time input 01/01/2022 10:00 am </label> -->

            <label class="form-label span-2">Type</label>
            <select class="form-user-input span-2" type="text" value=<?php echo "$loc"; ?> id="type" name="type" required>
                <option value="<?php echo "$loc"; ?>" disabled selected hidden><?php echo "$loc"; ?></option>
                <option value="Cleaning">Cleaning</option>
                <option value="Tooth Extraction">Tooth Extraction</option>
                <option value="Other Services">Other Services</option>
            </select>

            <label class="form-label span-2">Remarks</label>
            <input class="form-user-input span-2" type="text" value="<?php echo "$rmk"; ?>" id="remarks" name="remarks" placeholder="Remarks" required>

            <button onclick="window.location.href='../assistant/appointment.php'" type="submit" class="btn-submit span-2" id="submitButton">Update</button>
            <a href="appointment.php" class="btn-return span-2">Back</a>
        </form>

    <?php include "../includes/footer/footer.php"; ?>

    </div>
    <!--------------------- Scripts --------------------->
    <?php include "../includes/scripts.php"; ?>
</body>

</html>