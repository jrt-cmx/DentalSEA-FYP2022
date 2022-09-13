<?php
include('../connection/db.php');
$invoiceID = $_SESSION['invoiceID'];
$pID = $_SESSION['preID'];
$remarks = $_POST['paymentType'];
$consultationCost = $_POST['consultationCost'];
$price = $_SESSION['totalCost'] + $consultationCost;
$paid = 'PAID';

$query = "SELECT payment FROM invoice WHERE invoiceID = '$invoiceID' AND payment = '$paid'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

if (mysqli_num_rows($result) == 1)
{
    echo "<script>alert('This Invoice has been paid, cannot be updated');
                   window.location.href='javascript:history.go(-2)';
                </script>";
}
else
{
    $sql = "UPDATE invoice SET remarks = '$remarks', consultationCost = '$consultationCost', price = '$price' WHERE invoiceID ='$invoiceID'";
    $status1 = mysqli_query($link, $sql);

    echo "<script>alert('Invoice has been updated');
                   window.location.href='javascript:history.go(-2)';
                </script>";
}





