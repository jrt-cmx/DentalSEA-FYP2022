<?php
session_start();
include "../connection/db.php";
//initialize variable
$patientID = $patientName = $idNo = $idType = $dob =
    $allergy = $allergyNote = $source = $sourceNote =
    $title = $sex = $maritalStatus = $postalCode =
    $address = $phone = $email = $prefLang =
    $origin = "";

if (isset($_GET['patientID'])) {
    $patientID = $_GET['patientID'];
}

$sql = "SELECT * FROM patient WHERE patientID = '" . $patientID . "' ";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        $patientName = $row["patientName"];
        $idNo = $row['ICorPassportNo'];
        $idType = $row['idType'];
        $dob = $row['DoB'];
        $allergy = $row['allergy'];
        $allergyNote = $row['allergyNote'];
        $source = $row['source'];
        $sourceNote = $row['sourceNote'];
        $title = $row['title'];
        $sex = $row['sex'];
        $maritalStatus = $row['maritalStatus'];
        $postalCode = $row['postalcode'];
        $address = $row['address'];
        $phone = $row['phoneNO'];
        $email = $row['email'];
        $prefLang = $row['preferredLang'];
        $origin = $row['origin'];
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //initialize variable
    $newPatientName = $newIdNo = $newIdType = $newDob = $newAllergy =
        $newAllergyNote = $newSource = $newSourceNote = $newTitle = $newSex =
        $newMaritalStatus = $newPostalCode = $newAddress = $newPhone = $newEmail =
        $newPrefLang = $newOrigin = "";

    //fetch from session
    $patientID = $_SESSION['patientID'];
    $newPatientName = $_POST['patientname'];
    $newIdNo = $_POST['icorpassportno'];
    $newIdType = $_POST['idtype'];
    $newDob = $_POST['dob'];
    $newAllergy = $_POST['allergy'];
    $newAllergyNote = $_POST['allergynote'];
    $newSource = $_POST['source'];
    $newSourceNote = $_POST['sourcenote'];
    $newTitle = $_POST['title'];
    $newSex = $_POST['sex'];
    $newMaritalStatus = $_POST['maritalstatus'];
    $newPostalCode = $_POST['postalcode'];
    $newAddress = $_POST['address'];
    $newPhone = $_POST['phoneno'];
    $newEmail = $_POST['email'];
    $newPrefLang = $_POST['preferredlang'];
    $newOrigin = $_POST['origin'];

    //other checks
    $error = false;
    $phoneregex = "/(6|8|9)\d{7}/"; //using SG local number format
    $postalregex = "/\d{6}/"; //using SG Postal Code

    //check DOB
    $date_now = date("Y-m-d");
    if ($date_now < $newDob) {
        echo "<script>alert('Date of birth must be before today');</script>";
        $error = true;
    }

    //phone
    if (!preg_match($phoneregex, $newPhone)) {
        echo "<script>alert('Enter a valid phone number');</script>";
        $error = true;
    }

    //email
    if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Enter a valid email address');</script>";
        $error = true;
    }

    //postal code
    if (!preg_match($postalregex, $newPostalCode)) {
        echo "<script>alert('Enter a valid postal code');</script>";
        $error = true;
    }

    if ($error == false) {
        $sql = "UPDATE patient 
                    SET patientName='$newPatientName', ICorPassportNo='$newIdNo', 
                                       idType='$newIdType', DoB='$newDob', allergy='$newAllergy', 
                                       allergyNote='$newAllergyNote', source='$newSource', sourceNote='$newSourceNote', 
                                       title='$newTitle', sex='$newSex', maritalStatus='$newMaritalStatus', 
                                       postalcode='$newPostalCode', address='$newAddress', phoneNO='$newPhone', 
                                       email='$newEmail', preferredLang='$newPrefLang', origin='$newOrigin' 
                    WHERE patientID='$patientID'";

        $qRes = mysqli_query($link, $sql);

        if ($qRes === FALSE) {
            $_SESSION['errmsg'] = "Unable to add. Error code " . mysqli_errno($link) . " : " . mysqli_error($link);
            echo "<script>alert('Unable to update patient');
                window.location.href='updatePatient.php?patientID='" . $patientID . "';</script>";
        } else {
            echo "<script>alert('Patient $patientID information updated');
                    window.location.href='patient.php';</script>";
        }
    } else {
        echo "<script>alert('Check your input and try again');
            window.location.href='updatePatient.php?patientID='" . $patientID . "';</script>";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <!--------------------- Head --------------------->
    <?php include "../includes/head.php" ?>
    <title> Update patient </title>
</head>

<body class="body">
    <!-- <h1 class="header">New Patient Profile</h1> -->
    <!--------------------- Header --------------------->
    <?php include "../includes/header.php"; ?>
    <!--------------------- Side Bar --------------------->
    <?php include "../includes/navBar/navBar.php"; ?>
    <?php include "../includes/sideBar.php"; ?>


    <div class="home-section">
        <h2 class="page-title">Update Patient</h2>
        <form class="form" id="updatePatient" method="POST" action="updatePatient.php">
            <label class="form-label span-2">Patient ID</label>
            <label class="form-user-input span-2"><?php echo $_SESSION['patientID'] = $patientID; ?></label>
            <label class="form-label">Title</label>
            <label class="form-label">Name</label>
            <select class="form-select" id="title" name="title">
                <option value="" disabled selected hidden>Title</option>
                <option value="Mr" <?php if ($title == "Mr") echo "selected=\"selected\""; ?>>Mr</option>
                <option value="Miss" <?php if ($title == "Miss") echo "selected=\"selected\""; ?>>Miss</option>
                <option value="Ms" <?php if ($title == "Ms") echo "selected=\"selected\""; ?>>Ms</option>
                <option value="Mrs" <?php if ($title == "Mrs") echo "selected=\"selected\""; ?>>Mrs</option>
                <option value="Madam" <?php if ($title == "Madam") echo "selected=\"selected\""; ?>>Madam</option>
                <option value="Dr" <?php if ($title == "Dr") echo "selected=\"selected\""; ?>>Dr</option>
                <option value="Prof" <?php if ($title == "Prof") echo "selected=\"selected\""; ?>>Prof</option>
                <option value="Master" <?php if ($title == "Master") echo "selected=\"selected\""; ?>>Master</option>
            </select>
            <input class="form-user-input" type="text" name="patientname" value="<?php echo $patientName; ?> " required placeholder="Name">
            <label class="form-label">Identification Type</label>
            <label class="form-label">Identification Number</label>
            <select class="form-select" id="idtype" name="idtype" required>
                <option value="" disabled selected hidden>Identification Type</option>
                <option value="NRIC" <?php if ($idType == "NRIC") echo "selected=\"selected\""; ?>>NRIC</option>
                <option value="FIN" <?php if ($idType == "FIN") echo "selected=\"selected\""; ?>>FIN</option>
                <option value="Passport" <?php if ($idType == "Possport") echo "selected=\"selected\""; ?>>Passport</option>
                <option value="Birth Certificate" <?php if ($idType == "Birth Certificate") echo "selected=\"selected\""; ?>>Birth Certificate</option>
                <option value="Others" <?php if ($idType == "Others") echo "selected=\"selected\""; ?>>Others</option>
            </select>
            <input class="form-user-input" type="text" name="icorpassportno" value="<?php echo $idNo; ?>" required placeholder="Identification Number">
            <label class="form-label span-2">Date of Birth</label>
            <input class="form-user-input span-2" type="text" name="dob" onfocus="(this.type = 'date')" placeholder="Date of Birth" value="<?php echo $dob; ?>" required>
            <label class="form-label">Allergy</label>
            <label class="form-label">Remarks</label>
            <select class="form-select" id="allergy" name="allergy" required>
                <option value="" disabled selected hidden>Allergy</option>
                <option value="Yes" <?php if ($allergy == "Yes") echo "selected=\"selected\""; ?>>Yes</option>
                <option value="No" <?php if ($allergy == "No") echo "selected=\"selected\""; ?>>No</option>
                <option value="Unknown" <?php if ($allergy == "Unknown") echo "selected=\"selected\""; ?>>Unknown</option>
            </select>
            <input class="form-user-input" type="text" name="allergynote" value="<?php echo $allergyNote; ?>" placeholder="If yes, please specify">
            <label class="form-label">Gender</label>
            <label class="form-label">Marital Status</label>
            <select class="form-user-input" id="sex" name="sex" required>
                <option value="Male" <?php if ($sex == "Male") echo "selected=\"selected\""; ?>>Male</option>
                <option value="Female" <?php if ($sex == "Female") echo "selected=\"selected\""; ?>>Female</option>
                <option value="Unspecified" <?php if ($sex == "Unspecified") echo "selected=\"selected\""; ?>>Unspecified</option>
            </select>
            <select class="form-user-input" id="maritalstatus" name="maritalstatus" required>
                <option value="Single" <?php if ($maritalStatus == "Single") echo "selected=\"selected\""; ?>>Single</option>
                <option value="Married" <?php if ($maritalStatus == "Married") echo "selected=\"selected\""; ?>>Married</option>
                <option value="Divorced" <?php if ($maritalStatus == "Divorced") echo "selected=\"selected\""; ?>>Divorced</option>
                <option value="Separated" <?php if ($maritalStatus == "Separated") echo "selected=\"selected\""; ?>>Separated</option>
                <option value="Widowed" <?php if ($maritalStatus == "Widowed") echo "selected=\"selected\""; ?>>Widowed</option>
                <option value="Unspecified" <?php if ($maritalStatus == "Unspecified") echo "selected=\"selected\""; ?>>Unspecified</option>
            </select>
            <label class="form-label">Phone Number</label>
            <label class="form-label">Email</label>
            <input class="form-user-input" type="number" name="phoneno" value="<?php echo $phone ?>" placeholder="Phone Number">
            <input class="form-user-input" type="text" name="email" value="<?php echo $email ?>" placeholder="Email">
            <label class="form-label">Address</label>
            <label class="form-label">Postal Code</label>
            <input class="form-user-input" type="text" name="address" value="<?php echo $address ?>" placeholder="Address">
            <input class="form-user-input" type="number" name="postalcode" value="<?php echo $postalCode ?>" placeholder="Postal Code">
            <label class="form-label">Preferred Language</label>
            <label class="form-label">Country of Origin</label>
            <input class="form-user-input" type="text" name="preferredlang" value="<?php echo $prefLang ?>" placeholder="Preferred Language">
            <input class="form-user-input" type="text" name="origin" value="<?php echo $origin ?>" placeholder="Country">
            <label class="form-label">How did you hear about us</label>
            <label class="form-label">Remarks</label>
            <select class="form-select" id="source" name="source" required>
                <option value="Insurance" <?php if ($source == "Insurance") echo "selected=\"selected\""; ?>>Insurance</option>
                <option value="Friend/Family of staff" <?php if ($source == "Friend/Family of staff") echo "selected=\"selected\""; ?>>Friend/Family of staff</option>
                <option value="Doctor Referral" <?php if ($source == "Doctor Referral") echo "selected=\"selected\""; ?>>Doctor Referral</option>
                <option value="Google/Search engine" <?php if ($source == "Google/Search engine") echo "selected=\"selected\""; ?>>Google/Search engine</option>
                <option value="Social Media" <?php if ($source == "Social Media") echo "selected=\"selected\""; ?>>Social Media</option>
                <option value="Influencers" <?php if ($source == "Influencers") echo "selected=\"selected\""; ?>>Influencers</option>
                <option value="TV/Radio" <?php if ($source == "TV/Radio") echo "selected=\"selected\""; ?>>TV/Radio</option>
                <option value="News" <?php if ($source == "News") echo "selected=\"selected\""; ?>>News</option>
                <option value="Walk-in" <?php if ($source == "Walk-in") echo "selected=\"selected\""; ?>>Walk-in</option>
            </select>
            <input class="form-user-input" type="text" name="sourcenote" value="<?php echo $sourceNote; ?>" placeholder="If any, please specify">
            <button class="btn-submit span-2" id="submit" type="submit" value="Submit">Update</button>
            <a href="patient.php" class="btn-return span-2"></i>Back</a>
        </form>
    <?php include "../includes/footer/footer.php"; ?>
    </div>
    <!--------------------- Scripts --------------------->
    <?php include "../includes/scripts.php"; ?>
</body>

</html>