<?php
session_start();
include '../connection/db.php';

$id = $_GET['loginID']; // $id is now defined

//Delete userAccount and Profile
$sql1 = "DELETE FROM useraccount WHERE loginID = '$id'";
$status1 = mysqli_query($link, $sql1);

//Admin

$sql2 = "DELETE FROM admin WHERE loginID = '$id'";
$status2 = mysqli_query($link, $sql2);

//Assistant

$sql3 = "DELETE FROM dentalassistant WHERE loginID = '$id'";
$status3 = mysqli_query($link, $sql3);

//Dentist

$sql4 = "DELETE FROM dentist WHERE loginID = '$id'";
$status4 = mysqli_query($link, $sql4);

echo "<script>alert('$id account/profile has successfully deleted');
                window.history.go(-1);
                </script>";




