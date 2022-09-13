<?php
session_start();
include "../connection/db.php";

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //initialize variable
    $idNo = $dID = $aID = $date =
        $start = $end = $loc = $rmk = "";

    //fetch from session
    $idNo = $_POST['idNo'];
    $dID = $_POST['drID'];
    $aID = $_POST['assistantID'];
    $start = $_POST['startTime'];
    $end = $_POST['endTime'];
    $type = $_POST['type'];
    $rmk = $_POST['remarks'];

    $sql = "INSERT INTO appointment (ICorPassportNo, dentistID, assistantID, startTime, 
                                    endTime, type, remarks)" .
        " VALUES ('$idNo', '$dID', '$aID', '$start', '$end', '$type', '$rmk')";

    $qRes = @mysqli_query($link, $sql);
    if ($qRes === FALSE) {
        $_SESSION['errmsg'] = "Unable to add. Error code " . mysqli_errno($link) . " : " . mysqli_error($link);
        echo "<script>alert('Unable to add appointment');
                window.location.href='addAppointment.php';</script>";
    } else {
        echo "<script>alert('New Appointment added');
                window.location.href='appointment.php';</script>";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <!--------------------- Head --------------------->
    <?php include "../includes/head.php" ?>
    <title> Add Appointment </title>
</head>

<body class="body">
    <!--------------------- Header --------------------->
    <?php include "../includes/header.php"; ?>
    <!--------------------- Side Bar --------------------->
    <?php include "../includes/navBar/navBar.php"; ?>
    <?php include "../includes/sideBar.php"; ?>


    <div class="home-section">
        <div class="form--top">
            <h2 class="page-title">New Appointment</h2>
        </div>
        <form class="form" id="addAppointment" method="POST" action="addAppointment.php">
            <label class="form-label span-2">Patient</label>
            <select class="form-select span-2" id="idNo" name="idNo">
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

            <label class="form-label span-2">Doctor</label>
            <select class="form-select span-2" id="drID" name="drID">
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

            <label class="form-label span-2">Assistant</label>
            <select class="form-select span-2" id="assistantID" name="assistantID">
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
            <input class="form-user-input" type="datetime-local" id="startTime" name="startTime" required>

            <input class="form-user-input" type="datetime-local" id="endTime" name="endTime" required>

            <!-- <label style="color:red">Example time input 01/01/2022 10:00 am </label> -->

            <label class="form-label span-2">Type</label>
            <select class="form-user-input span-2" type="text" id="type" name="type" required>
                <option value="" disabled selected hidden>Type</option>
                <option value="Cleaning">Cleaning</option>
                <option value="Tooth Extraction">Tooth Extraction</option>
                <option value="Other Services">Other Services</option>
            </select>

            <label class="form-label span-2">Remarks</label>
            <input class="form-user-input span-2" ype="text" id="remarks" name="remarks" placeholder="Remarks" required>

            <button type="submit" class="btn-submit span-2" id="submitButton">Add</button>
            <a href="appointment.php" class="btn-return span-2">Back</a>
        </form>
    <?php include "../includes/footer/footer.php"; ?>

    </div>
    <!--------------------- Scripts --------------------->
    <?php include "../includes/scripts.php"; ?>
</body>

</html>