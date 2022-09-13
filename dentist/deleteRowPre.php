<?php
session_start();
include "../connection/db.php";

$pID = $_GET['pID'];
$medName = $_GET['newMedicationName'];
$newDosage = $_GET['newDosage'];
$newAmtTake = $_GET['newAmtToTake'];
$newTimeFrame = $_GET['newAmtTimeFrame'];
$patientID = $_SESSION['patientID'];

$sql = "DELETE FROM prescriptiondetails WHERE prescriptionID = '$pID' AND medicationName = '$medName' AND dosage ='$newDosage' AND amtToTake = '$newAmtTake' AND amtTimeFrame = '$newTimeFrame'";
$status = mysqli_query($link, $sql);

echo "<script>alert('Rows has been deleted');
    window.location.href='javascript:history.go(-1)';
</script>";
