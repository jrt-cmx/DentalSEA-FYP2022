<?php
session_start();
include "../connection/db.php";

//initialize variable for patient info
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

//initialize variable for next of kin
$nokName = $nokIdNo = $nokIdType =
$relationship = $contactNo = "";

$sql2 = "SELECT * FROM nextofkin WHERE ICorPassportNo = '" . $idNo . "' ";
$result3 = $link->query($sql2);

?>

<!DOCTYPE html>
<html>

<head>
    <!--------------------- Head --------------------->
    <?php include "../includes/head.php" ?>
    <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <title> View patient </title>
</head>

<body class="body">
<!-- <h1 class="header">New Patient Profile</h1> -->
<!--------------------- Header --------------------->
<?php include "../includes/header.php"; ?>
<!--------------------- Side Bar --------------------->
<?php include "../includes/navBar/navBar.php"; ?>
<?php include "../includes/sideBar.php"; ?>

<div class="home-section">
    <h2 class="page-title">Patient Information</h2>
    <div class="patient-page">
        <div class="patient-tabs">
            <a class="tab-link info active" data-toggle="tab" href="#info-part"><i class=" fa-solid fa-address-card"></i>Patient</a>
            <a class="tab-link nok " data-toggle="tab" href="#nok-part"><i class="fa-solid fa-people-roof"></i>Next of Kin</a>
            <a class="tab-link img" data-toggle="tab" href="#image-part"><i class="fa-solid fa-x-ray"></i>Images</a>
            <a class="tab-link notes" data-toggle="tab" href="#notes-part"><i class="fa-solid fa-notes-medical"></i>Notes</a>
            <a class="tab-link presc" data-toggle="tab" href="#presc-part"><i class="fa-solid fa-pills"></i>Prescription</a>
        </div>
        <div class="patient-contents">
            <div class="tab-content active" id="info-part">
                <div class="form patient-form">
                    <label class="form-label">ID</label>
                    <p class="form-input span-2"><?php echo $patientID; ?> </p>
                    <label class="form-label">Title</label>
                    <label class="form-label">Name</label>
                    <p class="form-input"><?php echo $title; ?> </p>
                    <p class="form-input"><?php echo $patientName; ?> </p>
                    <label class="form-label">Identification Type</label>
                    <label class="form-label">Identification Number</label>
                    <p class="form-input"><?php echo $idType; ?> </p>
                    <p class="form-input"><?php echo $idNo; ?> </p>
                    <label class="form-label">Date of Birth</label>
                    <p class="form-input span-2"><?php echo $dob; ?> </p>
                    <label class="form-label">Allergy</label>
                    <label class="form-label">Remarks</label>
                    <p class="form-input"><?php echo $allergy; ?> </p>
                    <p class="form-input"><?php echo $allergyNote; ?> </p>
                    <label class="form-label">Gender</label>
                    <label class="form-label">Marital Status</label>
                    <p class="form-input"><?php echo $sex; ?> </p>
                    <p class="form-input"><?php echo $maritalStatus; ?> </p>
                    <label class="form-label">Phone Number</label>
                    <label class="form-label">Email</label>
                    <p class="form-input"><?php echo $phone; ?> </p>
                    <p class="form-input"><?php echo $email; ?> </p>
                    <label class="form-label">Address</label>
                    <label class="form-label">Postal Code</label>
                    <p class="form-input"><?php echo $address; ?> </p>
                    <p class="form-input"><?php echo $postalCode; ?> </p>
                    <label class="form-label">Preferred Language</label>
                    <label class="form-label">Country of Origin</label>
                    <p class="form-input"><?php echo $prefLang; ?> </p>
                    <p class="form-input"><?php echo $origin; ?> </p>
                    <label class="form-label">How did you hear about us</label>
                    <label class="form-label">Remarks</label>
                    <p class="form-input"><?php echo $source; ?> </p>
                    <p class="form-input"><?php echo $sourceNote; ?> </p>
                    <div class="form-buttons  span-2">
                        <a href="patient.php" class="btn-back">Back</a>
                    </div>
                </div>
            </div>

            <div class="tab-content" id="nok-part">
                <div class="nok-part">
                    <a href='../assistant/addNextOfKin.php?idNo=<?php echo $idNo ?>&patientID=<?php echo $patientID ?>' class="btn-add"><i class="fa-solid fa-square-plus"></i><span>Add</span></a>
                    <div class="table-section ">
                        <div class="table-part">
                            <p class="table-column-header">Name</p>
                            <p class="table-column-header column-four">Relationship</p>
                            <p class="table-column-header">Phone Number</p>
                            <p class="table-column-header column-five">Identification Type</p>
                            <p class="table-column-header column-four">Identification No</p>
                            <!-- <p class="table-column-header hide"></p> -->
                            <p class="table-column-header column-six">Patient?</p>
                            <p class="table-column-header action">Action</p>
                        </div>
                        <?php
                        if ($result3->num_rows > 0) {
                            //output data of each row
                            while ($row2 = $result3->fetch_assoc()) {
                                echo "<div class='table-row'>
                                    <p class='table-column-input'>" . $row2["nokName"] . "</p>
                                    <p class='table-column-input column-four'>" . $row2['relationship'] . "</p>
                                    <p class='table-column-input'>" . $row2['contactNo'] . "</p>
                                    <p class='table-column-input column-five'>" . $row2['nokIdType'] . "</p>
                                    <p class='table-column-input column-four'>" . $row2['nokICorPassportNo'] . "</p>
                                    <p class='table-column-input column-six'>" . "" . "</p>
                                    <p class='table-column-input action'>
                                        <a class='column-input-link' href='../assistant/updateNextOfKin.php?idNo=" . $row2['ICorPassportNo'] . "&nokIdNo=" . $row2['nokICorPassportNo'] . "&patientID=" . $patientID . "'>
                                            <i class='fa-solid fa-pen'></i></a>" . " 
                                        <a class='column-input-link' onClick=\"javascript: return confirm('Please confirm deletion for " . $row2['nokName'] . " ');\" href='../assistant/deleteNextOfKin.php?idNo=" . $row2['ICorPassportNo'] . "&nokIdNo=" . $row2['nokICorPassportNo'] . "&patientID=" . $patientID . "'>
                                            <i class='fa-solid fa-trash-can'></i></a>" . "
                                    </p>
                                </div>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <!-- Graphic        -->
            <div class="tab-content" id="image-part">
                <div class="xray-part">
                    <!-- <a href="#divTwo" class="page--buttons"><i class="fa-solid fa-square-plus"></i>Add Next Of Kin</a> -->
                    <?php include "../dentist/viewImage.php"; ?>
                </div>
            </div>
            <!--  View Notes  -->
            <div class="tab-content" id="notes-part">
                <div class="notes-part">
                    <span class="upload-div"> <a href="#divOne" class="btn-add upload">Add Notes</a></span>
                    <?php
                    include "../connection/db.php";
                    $sql2 = "SELECT * FROM patientnotes WHERE idNo = '" . $idNo . "' ";
                    $result2 = $link->query($sql2);


                    $_SESSION['idNo'] = $idNo;
                    $_SESSION['pNames'] = $patientName;
                    $_SESSION['address'] = $address;
                    $_SESSION['postalCode'] = $postalCode;
                    $_SESSION['phone'] = $phone;
                    $_SESSION['patientID'] = $patientID;
                    if ($result2->num_rows > 0) {
                        // output data of each row
                        while ($row = $result2->fetch_assoc()) { ?>
                            <div class="card-container">
                                <p class="components--text"><?php echo $row['remarks'] ?></p>
                                <div class="notes-bottom">
                                    <?php echo "<a class='btn-view' href='../dentist/viewNotes.php?number=" . $row['number'] . "'>
			                <i class='fa-solid fa-magnifying-glass'></i>View</a>" ?>
                                    <?php echo "<a class='btn-update' href='../dentist/updateNotes.php?number=" . $row['number'] . "'>
			                Edit</a>" ?>
                                    <?php echo "<a class='btn-delete' onClick=\"javascript: return confirm('Please confirm deletion for " . $patientName . " notes contain: " . $row['remarks'] . "');\" 
				            href=\"../dentist/deleteNotes.php?number=" . $row['number'] . "\">
			                Delete</a>" ?>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "0 results";
                    }
                    $link->close();
                    ?>
                </div>

            </div>
            <!-- Add notes   -->
            <form action="../dentist/addNotes.php" method="post">
                <link rel="stylesheet" href="../css/popUp.css">
                <div class="overlay" id="divOne">
                    <div class="wrapper">
                        <h2>Add Notes</h2><a class="close" href="#">&times;</a>
                        <div class="content">
                            <div class="container">
                                <form class="needs-validation" novalidate="" autocomplete="off">
                                    <label>Name</label>
                                    <input placeholder="Your name.." type="text" value="<?php echo $patientName ?>" disabled="disabled">
                                    <div class="mb-3">
                                        <label>Remarks</label>
                                        <textarea maxlength="140" iplaceholder="Write something.." id="remarks" name="remarks" class="form-control" required></textarea>
                                        <div class="invalid-feedback">remarks is require</div>
                                    </div>
                                    <input type="submit" value="Submit">
                                    <script src="/javascript/indexNLogin.js"></script>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Prescription      -->

            <?php include "../dentist/prescription.php";  ?>
        </div>
    </div>
</div>
</div>
<?php include "../includes/footer/footer.php"; ?>
</div>

<!--------------------- Scripts --------------------->
<script src="../includes/patientTab.js"></script>
<?php include "../includes/scripts.php"; ?>
</body>

</html>