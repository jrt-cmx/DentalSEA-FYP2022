<?php
session_start();
include '../connection/db.php';

$id = $_GET['medicationID']; // $id is now defined

//Delete userAccount and Profile
$sql1 = "DELETE FROM medication WHERE medicationID = '$id'";
$status1 = mysqli_query($link, $sql1);

echo "<script>alert('Deleted');
                window.history.go(-1);
                </script>";



