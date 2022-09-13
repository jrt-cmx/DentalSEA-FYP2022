<?php
    session_start();
    include "../connection/db.php";

    //initialize variable
    $search = "";

    $patientID = $patientName = $idNo = $idType = $dob = 
    $allergy = $allergyNote = $source = $sourceNote = 
    $title = $sex = $maritalStatus = $postalCode = 
    $address = $phone = $email = $prefLang = 
    $origin = "";

    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        if(isset($_POST['search']))
        {
            $search = $_POST['search'];
        }

        $sql = "SELECT * FROM patient WHERE patientName LIKE '%" . $search . "%' ";
        $result = $link->query($sql);

        if (!empty($result->num_rows) && $result->num_rows > 0) 
        {
            // output data of each row
            while($row = $result->fetch_assoc()) 
            {
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
        else
        {
            echo "<script>alert('Patient not found');
                        window.location.href='patient.php';</script>";
        }
    }
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>DentalSEA</title>
    <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
	<h1 class="header">Patient Profile</h1>
	<div class= "container">
	<h2>Patient Profile</h2>
	<label>Patient information</label><br>        
    <label>Patient ID: </label><label><?php echo $patientID; ?></label><br><br>
    <label>Name : </label><label><?php echo $patientName; ?></label><br><br>
    <label>Identification number : </label><label><?php echo $idNo; ?></label><br><br>
    <label>ID Type : </label><label><?php echo $idType; ?></label><br><br>
    <label>Date of Birth :</label><label><?php echo $dob; ?></label><br><br>
    <label>Allergy : </label><label><?php echo $allergy; ?></label><br><br>
    <label>Allergy Notes : </label><label><?php echo $allergyNote; ?></label><br><br>
    <label>Source : </label><label><?php echo $source; ?></label><br><br>
    <label>Source Note: </label><label><?php echo $sourceNote; ?></label><br><br>
    <label>Title : </label><label><?php echo $title; ?></label><br><br>
    <label>Sex : </label><label><?php echo $sex; ?></label><br><br>
    <label>Marital Status : </label><label><?php echo $maritalStatus; ?></label><br><br>
    <label>Postal Code : </label><label><?php echo $postalCode; ?></label><br><br>
    <label>Address : </label><label><?php echo $address; ?></label><br><br>
    <label>Phone Number : </label><label><?php echo $phone; ?></label><br><br>
    <label>Email : </label><label><?php echo $email; ?></label><br><br>
    <label>Preferred Language : </label><label><?php echo $prefLang; ?></label><br><br>
    <label>Origin : </label><label><?php echo $origin; ?></label><br><br>
    <br><br>
    <a href="patient.php"><button class="Submit">Back To Patient Page</button></a>
	</div>
	</div> 
</body>
</html>