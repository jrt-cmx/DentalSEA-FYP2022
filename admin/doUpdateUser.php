<?php
session_start();
include "../connection/db.php";

$id = $_SESSION['loginID'];
$password = $_POST['updatePassword'];
$userType = $_POST['updateRoles'];


    $sql = "UPDATE useraccount SET password= SHA1('$password'), userType= '$userType' WHERE loginID='$id'";
    $status1 = mysqli_query($link, $sql);

if ($userType == "Admin")
{
//  copy from old table to new table
    $sql1 = "INSERT INTO admin SELECT * FROM dentalassistant WHERE loginID = '$id'";
    $status2 = mysqli_query($link, $sql1);

    $sql2 = "INSERT INTO admin SELECT * FROM dentist WHERE loginID = '$id'";
    $status3 = mysqli_query($link, $sql2);

    $sql3 = "DELETE FROM dentalassistant WHERE loginID = '$id'";
    $sql4 = "DELETE FROM dentist WHERE loginID = '$id'";
    $status4 = mysqli_query($link, $sql3);
    $status5 = mysqli_query($link, $sql4);

}
elseif ($userType == "Assistant")
{
    //    copy from old table to new table
    $sql1 = "INSERT INTO dentalassistant SELECT * FROM admin WHERE loginID = '$id'";
    $sql2 = "INSERT INTO dentalassistant SELECT * FROM dentist WHERE loginID = '$id'";
    $status2 = mysqli_query($link, $sql1);
    $status3 = mysqli_query($link, $sql2);

    $sql3 = "DELETE FROM admin WHERE loginID = '$id'";
    $sql4 = "DELETE FROM dentist WHERE loginID = '$id'";
    $status4 = mysqli_query($link, $sql3);
    $status5 = mysqli_query($link, $sql4);

}
elseif ($userType == "Dentist")
{
    //    copy from old table to new table
    $sql1 = "INSERT INTO dentist SELECT * FROM admin WHERE loginID = '$id'";
    $sql2 = "INSERT INTO dentist SELECT * FROM dentalassistant WHERE loginID = '$id'";
    $status2 = mysqli_query($link, $sql1);
    $status3 = mysqli_query($link, $sql2);

    $sql3 = "DELETE FROM admin WHERE loginID = '$id'";
    $sql4 = "DELETE FROM dentalassistant WHERE loginID = '$id'";
    $status4 = mysqli_query($link, $sql3);
    $status5 = mysqli_query($link, $sql4);

}
//    $sql = "UPDATE useraccount SET password= SHA1('$password'), userType= '$userType' WHERE loginID='$id'";
//    $status1 = mysqli_query($link, $sql);
//
    echo "<script>alert('$userType account, update completed');
                   window.location.href='userAccount.php';
                </script>";
