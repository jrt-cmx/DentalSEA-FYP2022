<?php
session_start();
include "../connection/db.php";

//initialize variable
$idNo = $patientID = $nokIdNo =  $nokName =
    $nokIdType = $relationship = $contactNo = "";

if (isset($_GET['idNo'])) {
    $idNo = $_GET['idNo'];
}

if (isset($_GET['nokIdNo'])) {
    $nokIdNo = $_GET['nokIdNo'];
}

if (isset($_GET['patientID'])) {
    $patientID = $_GET['patientID'];
}

$sql = "SELECT * FROM nextofkin WHERE ICorPassportNo = '" . $idNo . "' AND nokICorPassportNo = '" . $nokIdNo . "' ";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $nokName = $row['nokName'];
        $nokIdType = $row['nokIdType'];
        $relationship = $row['relationship'];
        $contactNo = $row['contactNo'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //initialize variable
    $newNokName = $newNokIdNo = $newNokIdType =
        $newRelationship = $newContactNo = "";

    //fetch from session
    $thisIdNo = $_POST['thisidno'];
    $thisPatientID = $_POST['patientid'];
    $thisNokIdNo = $_POST['thisnokidno'];
    $newNokName = $_POST['nokname'];
    $newNokIdNo = $_POST['nokidno'];
    $newNokIdType = $_POST['idtype'];
    $newRelationship = $_POST['relationship'];
    $newContactNo = $_POST['contactno'];

    //other checks
    $error = false;
    $phoneregex = "/(6|8|9)\d{7}/"; //using SG local number format

    //check if record is in the system
    //Composite Key IC and nokIC
    $check_nok = mysqli_query($link, "SELECT nokName FROM nextofkin where ICorPassportNo = '$thisIdNo' and nokICorPassportNo = '$newNokIdNo' ");
    if (mysqli_num_rows($check_nok) > 0) {
        if ($thisNokIdNo != $newNokIdNo) {
            echo "<script>alert('Next of Kin record exists'); </script>";
            $error = true;
        }
    }

    //phone
    if (!preg_match($phoneregex, $newContactNo)) {
        echo "<script>alert('Enter a valid phone number');</script>";
        $error = true;
    }


    if ($error == false) {
        $sql = "UPDATE nextofkin 
                SET nokName='$newNokName', nokICorPassportNo='$newNokIdNo', 
                    nokIdType='$newNokIdType', relationship='$newRelationship', 
                    contactNo='$newContactNo'
                WHERE ICorPassportNo = '$thisIdNo' and nokICorPassportNo = '$thisNokIdNo'";

        $qRes = @mysqli_query($link, $sql);
        if ($qRes === FALSE) {
            //$_SESSION['errmsg'] = "Unable to add. Error code " . mysqli_errno($link) . " : " . mysqli_error($link);
            echo "<script>alert('Unable to update new next of kin');
                    window.location.href='../assistant/updateNextOfKin.php?idNo=$thisIdNo&nokIdNo=$thisNokIdNo&patientID=$patientID';</script>";
        } else {
            echo "<script>alert('Next of kin updated');
                    window.location.href='../assistant/viewPatient.php?patientID=$thisPatientID&idNo=$thisIdNo';</script>";
        }
    } else {
        echo "<script>alert('Check your input and try again');
                window.location.href='../assistant/updateNextOfKin.php?idNo=$thisIdNo&nokIdNo=$thisNokIdNo&patientID=$patientID';</script>";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <!--------------------- Head --------------------->
    <?php include "../includes/head.php" ?>
    <title> Update Next of Kin </title>
</head>

<body class="body">
    <!-- <h1 class="header">New Patient Profile</h1> -->
    <!--------------------- Header --------------------->
    <?php include "../includes/header.php"; ?>
    <!--------------------- Side Bar --------------------->
    <?php include "../includes/navBar/navBar.php"; ?>
    <?php include "../includes/sideBar.php"; ?>


    <div class="home-section">
        <div class="form--top">
            <h2 class="page-title">Update Next Of Kin Details</h2>
        </div>
        <form class="form" id="addNextOfKin" method="POST" action="updateNextOfKin.php">
            <input type="hidden" name="thisidno" id="thisidno" value="<?php echo $idNo ?>">
            <input type="hidden" name="thisnokidno" id="thisnokidno" value="<?php echo $nokIdNo ?>">
            <input type="hidden" name="patientid" id="patientid" value="<?php echo $patientID ?>">
            <label class="form-label span-2">Name</label>
            <input class="form-user-input span-2" type="text" name="nokname" id="nokname" value="<?php echo $nokName ?>" required>
            <label class="form-label span-2">Relationship</label>
            <input class="form-user-input span-2" type="text" name="relationship" id="relationship" value="<?php echo $relationship ?>" required>
            <label class="form-label span-2">Identification Type</label>
            <select class="form-user-input span-2" id="idtype" name="idtype" required>
                <option value="NRIC" <?php if ($nokIdType == "NRIC") echo "selected=\"selected\""; ?>>NRIC</option>
                <option value="FIN" <?php if ($nokIdType == "FIN") echo "selected=\"selected\""; ?>>FIN</option>
                <option value="Passport" <?php if ($nokIdType == "Possport") echo "selected=\"selected\""; ?>>Passport</option>
                <option value="Birth Certificate" <?php if ($nokIdType == "Birth Certificate") echo "selected=\"selected\""; ?>>Birth Certificate</option>
                <option value="Others" <?php if ($nokIdType == "Others") echo "selected=\"selected\""; ?>>Others</option>
            </select>
            <label class="form-label span-2">Identification Number</label>
            <input class="form-user-input span-2" type="text" name="nokidno" id="nokidno" value="<?php echo $nokIdNo ?>" required>
            <label class="form-label span-2">Contact Number</label>
            <input class="form-user-input span-2" type="text" name="contactno" id="contactno" value="<?php echo $contactNo ?>" required>
            <button class="btn-submit span-2" id="submit" type="submit" value="Submit">Submit</button>
            <a href='viewPatient.php?patientID=<?php echo $patientID ?>' class="btn-return span-2">Back</a>
        </form>
    </div>
    <!--------------------- Scripts --------------------->
    <?php include "../includes/scripts.php"; ?>
</body>

</html>