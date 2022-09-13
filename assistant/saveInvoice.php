<?php

include('../connection/db.php');
$idNo = $_SESSION['idNo'];
date_default_timezone_set('Asia/Singapore');
$date = $_SESSION['dateNow'];
$time = $_SESSION['timeNow'];
$pID = $_SESSION['preID'];
$patientName = $_SESSION['pNames'];
$location = "461 Clementi Rd,Singapore 599491";
$remarks = $_POST['paymentType'];
$consultationCost = $_POST['consultationCost'];
$price = $_SESSION['totalCost'] + $consultationCost;
$paid = 'UNPAID';

$query = "SELECT prescriptionID FROM invoice where prescriptionID = '$pID'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

if (mysqli_num_rows($result) == 1)
{
    echo "<script>alert('This Invoice has been saved previously');
                   window.location.href='invoice.php';
                </script>";
}
else
{
    $result = mysqli_query($link, "INSERT INTO invoice (prescriptionID, NRIC, patientName, date, time, location, remarks, price, consultationCost, payment)
                                    VALUES ('$pID', '$idNo', '$patientName', '$date', '$time', '$location' ,'$remarks' , '$price', '$consultationCost' , '$paid')");

    echo "<script>alert('Invoice has been saved');
                   window.location.href='invoice.php';
                </script>";
}


