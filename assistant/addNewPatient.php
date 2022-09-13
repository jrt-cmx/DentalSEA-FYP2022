<?php
session_start();
include "../connection/db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //initialize variable
    $patientID = $patientName = $idNo = $idType = $dob =
        $allergy = $allergyNotes = $source = $sourceNote =
        $title = $sex = $maritalStatus = $postalCode =
        $address = $phone = $email = $prefLang =
        $origin = "";

    //fetch from session
    $patientID = $_POST['patientid'];
    $patientName = $_POST['patientname'];
    $idNo = $_POST['icorpassportno'];
    $idType = $_POST['idtype'];
    $dob = $_POST['dob'];
    $allergy = $_POST['allergy'];
    $allergyNotes = $_POST['allergynotes'];
    $source = $_POST['source'];
    $sourceNote = $_POST['sourcenote'];
    $title = $_POST['title'];
    $sex = $_POST['sex'];
    $maritalStatus = $_POST['maritalstatus'];
    $postalCode = $_POST['postalcode'];
    $address = $_POST['address'];
    $phone = $_POST['phoneno'];
    $email = $_POST['email'];
    $prefLang = $_POST['preferredlang'];
    $origin = $_POST['origin'];

    //other checks
    $error = false;
    $phoneregex = "/(6|8|9)\d{7}/"; //using SG local number format
    $postalregex = "/\d{6}/"; //using SG Postal Code

    //check if ID is in the system
    $check_patientId = mysqli_query($link, "SELECT patientID FROM patient where patientID = '$patientID' ");
    if (mysqli_num_rows($check_patientId) > 0) {
        echo "<script>alert('Patient ID exist'); </script>";
        $error = true;
    }

    //check DOB
    $date_now = date("Y-m-d");
    if ($date_now < $dob) {
        echo "<script>alert('Date of birth must be before today');</script>";
        $error = true;
    }

    //phone
    if (!preg_match($phoneregex, $phone)) {
        echo "<script>alert('Enter a valid phone number');</script>";
        $error = true;
    }

    //email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Enter a valid email address');</script>";
        $error = true;
    }

    //postal code
    if (!preg_match($postalregex, $postalCode)) {
        echo "<script>alert('Enter a valid postal code');</script>";
        $error = true;
    }

    if ($error == false) {
        $sql = "INSERT INTO patient (patientID, patientName, ICorPassportNo, idType, DoB, allergy, 
                                     allergyNote, source, sourceNote, title, sex, maritalStatus, 
                                     postalcode, address, phoneNO, email, preferredLang, origin)" .
            " VALUES ('$patientID', '$patientName', '$idNo', '$idType', '$dob', '$allergy', 
                          '$allergyNotes', '$source', '$sourceNote', '$title', '$sex', '$maritalStatus', 
                          '$postalCode', '$address', '$phone', '$email', '$prefLang', '$origin')";

        $qRes = @mysqli_query($link, $sql);
        if ($qRes === FALSE) {
            $_SESSION['errmsg'] = "Unable to add. Error code " . mysqli_errno($link) . " : " . mysqli_error($link);
            echo "<script>alert('Unable to add new patient');
                    window.location.href='addNewPatient.php';</script>";
        } else {
            echo "<script>alert('New patient added');
                    window.location.href='patient.php';</script>";
        }
    } else {
        echo "<script>alert('Check your input and try again');
            window.location.href='addNewPatient.php'; </script>";
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <!--------------------- Head --------------------->
    <?php include "../includes/head.php" ?>
    <title> Add patient </title>
</head>

<body class="body">
    <!-- <h1 class="header">New Patient Profile</h1> -->
    <!--------------------- Header --------------------->
    <?php include "../includes/header.php"; ?>
    <!--------------------- Side Bar --------------------->
    <?php include "../includes/sideBar.php"; ?>
    <?php include "../includes/navBar/navBar.php"; ?>


    <div class="home-section">
        <div class="form--top">
            <h2 class="page-title">New Patient</h2>
        </div>
        <form class="form" id="addNewPatient" method="POST" autocomplete="off" action="addNewPatient.php">
            <label class="form-label">Title</label>
            <label class="form-label">Name</label>
            <select class="form-select" id="title" name="title" required>
                <option value="" disabled selected hidden>Title</option>
                <option value="Mr">Mr</option>
                <option value="Miss">Miss</option>
                <option value="Ms">Ms</option>
                <option value="Mrs">Mrs</option>
                <option value="Madam">Madam</option>
                <option value="Dr">Dr</option>
                <option value="Prof">Prof</option>
                <option value="Master">Master</option>
            </select>
            <input class="form-user-input" type="text" name="patientname" placeholder="Name" required>
            <label class="form-label">Identification Type</label>
            <label class="form-label">Identification ID</label>
            <select class="form-select" id="idtype" name="idtype" required>
                <option value="" disabled selected hidden>ID Type</option>
                <option value="NRIC">NRIC</option>
                <option value="FIN">FIN</option>
                <option value="Passport">Passport</option>
                <option value="Birth Certificate">Birth Certificate</option>
                <option value="Others">Others</option>
            </select>
            <input class="form-user-input" type="text" name="icorpassportno" placeholder="Identification Number" required>
            <label class="form-label span-2">Date of Birth</label>
            <input class="form-user-input span-2" type="text" name="dob" onfocus="(this.type = 'date')" placeholder="Date of Birth" required>
            <label class="form-label">Allergy</label>
            <label class="form-label">Remarks</label>
            <select class="form-select" id="allergy" name="allergy" required>
                <option value="" disabled selected hidden>Allergy</option>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
                <option value="Unknown">Unknown</option>
            </select>
            <input class="form-user-input" type="text" name="allergynotes" placeholder="If yes, please specify">
            <label class="form-label">Gender</label>
            <label class="form-label">Marital Status</label>
            <select class="form-select" id="sex" name="sex" required>
                <option value="" disabled selected hidden>Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Unspecified">Unspecified</option>
            </select>
            <select class="form-select" id="maritalstatus" name="maritalstatus" required>
                <option value="" disabled selected hidden>Marital Status</option>
                <option value="Single">Single</option>
                <option value="Married">Married</option>
                <option value="Divorced">Divorced</option>
                <option value="Separated">Separated</option>
                <option value="Widowed">Widowed</option>
                <option value="Unspecified">Unspecified</option>
            </select>
            <label class="form-label">Phone Number</label>
            <label class="form-label">Email</label>
            <input class="form-user-input" type="number" name="phoneno" placeholder="Phone Number">
            <input class="form-user-input" type="text" name="email" placeholder="Email">
            <label class="form-label">Address</label>
            <label class="form-label">Postal Code</label>
            <input class="form-user-input" type="text" name="address" placeholder="Address">
            <input class="form-user-input" type="number" name="postalcode" placeholder="Postal Code">
            <label class="form-label">Preferred Language</label>
            <label class="form-label">Country of Origin</label>
            <input class="form-user-input" type="text" name="prefLang" placeholder="Language">
            <input class="form-user-input" type="text" name="origin" placeholder="Origin">
            <label class="form-label">How did you hear about us</label>
            <label class="form-label">Remarks</label>
            <select class="form-select" id="source" name="source" required>
                <option value="" disabled selected hidden>Source</option>
                <option value="Insurance">Insurance</option>
                <option value="Friend/Family of staff">Friend/Family of staff</option>
                <option value="Doctor Referral">Doctor Referral</option>
                <option value="Google/Search engine">Google/Search engine</option>
                <option value="Social Media">Social Media</option>
                <option value="Influencers">Influencers</option>
                <option value="TV/Radio">TV/Radio</option>
                <option value="News">News</option>
                <option value="Walk-in">Walk-in</option>
            </select>
            <input class="form-user-input" type="text" name="sourcenote" placeholder="If any, please specify">
            <button class="btn-submit span-2" id="submit" type="submit" value="Submit">Submit</button>
            <a href="patient.php" class="btn-return span-2">Back</a>
        </form>
        <?php include "../includes/footer/footer.php"; ?>

    </div>
    <!--------------------- Scripts --------------------->
    <?php include "../includes/scripts.php"; ?>
</body>

</html>