<?php
session_start();

include "../connection/db.php";

$id = $_SESSION['loginID'];
$fName = $_POST['fName'];
$lName = $_POST['lName'];
$userType = $_SESSION['userType'];

if ($userType == "Admin")
{
    $sql = "UPDATE admin SET fName= '$fName', lName = '$lName' WHERE loginID='$id'";
    $status1 = mysqli_query($link, $sql);

    echo "<script>alert('$userType profile, update completed');
                   window.location.href='userProfile.php';
                </script>";
}
else if ($userType == "Assistant")
{
    $sql = "UPDATE dentalassistant SET fName= '$fName', lName = '$lName' WHERE loginID='$id'";
    $status1 = mysqli_query($link, $sql);

    echo "<script>alert('$userType profile, update completed');
                   window.location.href='userProfile.php';
                </script>";
}
else if ($userType == "Dentist")
{
    $sql = "UPDATE dentist SET fName= '$fName', lName = '$lName' WHERE loginID='$id'";
    $status1 = mysqli_query($link, $sql);

    echo "<script>alert('$userType profile, update completed');
                   window.location.href='userProfile.php';
                </script>";
}




