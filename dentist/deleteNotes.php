<?php
session_start();
include "../connection/db.php";

$number = $_GET['number'];
$patientID = $_SESSION['patientID'];
$idNo = $_SESSION['idNo'];

$sql = "DELETE FROM patientnotes WHERE number='$number'";
$status = mysqli_query($link, $sql);

echo "<script>alert('Notes has been deleted');
    window.location.href='../assistant/viewPatient.php?patientID=$patientID&idNo=$idNo';
</script>";
