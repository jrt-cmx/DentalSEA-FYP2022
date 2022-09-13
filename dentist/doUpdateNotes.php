<?php
session_start();
include "../connection/db.php";

$number = $_SESSION['number'];
$newRemarks = $_POST['newRemarks'];
$patientID = $_SESSION['patientID'];
$idNo = $_SESSION['idNo'];


$sql = "UPDATE patientnotes SET remarks= '$newRemarks' WHERE number='$number'";
$status1 = mysqli_query($link, $sql);

echo "<script>alert('notes have been updated');
                   window.location.href='../assistant/viewPatient.php?patientID=$patientID&idNo=$idNo';
                </script>";
