<?php
session_start();
include "../connection/db.php";
$pID = $_GET['pID'];

$sql = "DELETE FROM prescription WHERE prescriptionID ='$pID'";
$status = mysqli_query($link, $sql);

$sql1 = "DELETE FROM prescriptiondetails WHERE prescriptionID ='$pID'";
$status1 = mysqli_query($link, $sql1);

echo "<script>alert('Prescription has been deleted');
    window.location.href='javascript:history.go(-1)';
</script>";
