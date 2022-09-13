<?php
session_start();
include "../connection/db.php";

$idNo = $patientID = "";

if (isset($_GET['idNo'])) {
    $idNo = $_GET['idNo'];
}

if (isset($_GET['patientID'])) {
    $patientID = $_GET['patientID'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //initialize variable
    $thisIdNo = $patientid = $nokName = $nokIdNo = $nokIdType =
        $relationship = $contactNo = "";

    //fetch from session
    $thisIdNo = $_POST['thisidno'];
    $thisPatientID = $_POST['patientid'];
    $nokName = $_POST['nokname'];
    $nokIdNo = $_POST['nokidno'];
    $nokIdType = $_POST['idtype'];
    $relationship = $_POST['relationship'];
    $contactNo = $_POST['contactno'];

    // echo "<script>alert('$thisIdNo')</script>";
    // echo "<script>alert('$thisPatientID')</script>";
    // echo "<script>alert('$nokName')</script>";

    //other checks
    $error = false;
    $phoneregex = "/(6|8|9)\d{7}/"; //using SG local number format

    //check if record is in the system
    //Composite Key IC and nokIC
    $check_nok = mysqli_query($link, "SELECT nokName FROM nextofkin where ICorPassportNo = '$thisIdNo' and nokICorPassportNo = '$nokIdNo' ");
    if (mysqli_num_rows($check_nok) > 0) {
        echo "<script>alert('Next of Kin record exists'); </script>";
        $error = true;
    }

    //phone
    if (!preg_match($phoneregex, $contactNo)) {
        echo "<script>alert('Enter a valid phone number');</script>";
        $error = true;
    }

    if ($error == false) {
        $sql = "INSERT INTO nextofkin (ICorPassportNo , nokName, nokICorPassportNo, nokIdType, relationship, contactNo)" .
            " VALUES ('$thisIdNo', '$nokName', '$nokIdNo', '$nokIdType', '$relationship', '$contactNo')";

        $qRes = @mysqli_query($link, $sql);
        if ($qRes === FALSE) {
            //$_SESSION['errmsg'] = "Unable to add. Error code " . mysqli_errno($link) . " : " . mysqli_error($link);
            echo "<script>alert('Unable to add new next of kin');
                    window.location.href='addNextOfKin.php?patientID=$thisPatientID&idNo=$thisIdNo';</script>";
        } else {
            echo "<script>alert('New next of kin added');
                    window.location.href='viewPatient.php?patientID=$thisPatientID&idNo=$thisIdNo';</script>";
        }
    } else {
        echo "<script>alert('Check your input and try again');
                window.location.href='addNextOfKin.php?patientID=$thisPatientID&idNo=$thisIdNo';</script>";
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <!--------------------- Head --------------------->
    <?php include "../includes/head.php" ?>
    <title> Add Next of Kin </title>
</head>

<body class="body">
    <!--------------------- Header --------------------->
    <?php include "../includes/header.php"; ?>
    <!--------------------- Side Bar --------------------->
    <?php include "../includes/sideBar.php"; ?>
    <?php include "../includes/navBar/navBar.php"; ?>
    <div class="home-section">


        <h2 class="page-title">Next Of Kin Details</h2>
        <form class="form" id="addNextOfKin" method="POST" action="addNextOfKin.php">
            <input type="hidden" name="thisidno" id="thisidno" value="<?php echo $idNo ?>">
            <input type="hidden" name="patientid" id="patientid" value="<?php echo $patientID ?>">
            <label class="form-label span-2">Name</label>
            <input class="form-user-input span-2" placeholder="Enter name.." type="text" name="nokname" id="nokname" required>
            <label class="form-label span-2">Identification Type</label>
            <select class="form-select span-2" id="idtype" name="idtype" required>
                <option value="" disabled selected hidden>ID Type</option>
                <option value="NRIC">NRIC</option>
                <option value="FIN">FIN</option>
                <option value="Passport">Passport</option>
                <option value="Birth Certificate">Birth Certificate</option>
                <option value="Others">Others</option>
            </select>
            <label class="form-label span-2">Identification Number </label>
            <input class="form-user-input span-2" placeholder="Enter Id Number" type="text" name="nokidno" id="nokidno" required>
            <label class="form-label span-2">Relationship</label>
            <input class="form-user-input span-2" type="text" name="relationship" id="relationship" required>
            <label class="form-label span-2" >Contact Number</label>
            <input class="form-user-input span-2" type="text" name="contactno" id="contactno" required>
            <button class="btn-submit span-2" id="submit" type="submit" value="Submit">Submit</button>
            <a href='viewPatient.php?patientID=<?php echo $patientID ?>' class="btn-return span-2">Back</a>
        </form>
    <?php include "../includes/footer/footer.php"; ?>
    </div>
    <!--------------------- Scripts --------------------->
    <?php include "../includes/scripts.php"; ?>
</body>

</html>