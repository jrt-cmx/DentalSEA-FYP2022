<?php
include('../connection/db.php');

$invoiceID = $_GET['invoiceID'];
$totalCost = $_GET['totalCost'];
$paid = 'PAID';
$card = 'Card Payment';
$qr = 'QR Payment';

// paid, go to receipt
$query = "SELECT payment FROM invoice where payment = '$paid' AND invoiceID = '$invoiceID'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

//card payment
$query = "SELECT remarks FROM invoice where remarks = '$card' AND invoiceID = '$invoiceID'";
$result1 = mysqli_query($link, $query) or die(mysqli_error($link));

//qr payment
$query = "SELECT remarks FROM invoice where remarks = '$qr' AND invoiceID = '$invoiceID'";
$result2 = mysqli_query($link, $query) or die(mysqli_error($link));


if (mysqli_num_rows($result) == 1)
{
    echo "<script>alert('Invoice has already been paid, redirect to receipt');
                   window.location.href='createReceipt.php?invoiceID=$invoiceID';
                </script>";
}
else if (mysqli_num_rows($result1) == 1)
{
//  Card Payment
    echo "<script>alert('Redirecting to Card payment');
                   window.location.href='cardPayment.php?invoiceID=$invoiceID&totalCost=$totalCost';
                </script>";
}
else if (mysqli_num_rows($result2) == 1)
{
    //  QR Payment
    echo "<script>alert('Redirecting to QR payment');
                   window.location.href='qrPayment.php?invoiceID=$invoiceID&totalCost=$totalCost';
                </script>";
}
else
{
//  Cash Payment
    $sql = "UPDATE invoice SET payment = '$paid' WHERE invoiceID ='$invoiceID'";
    $status1 = mysqli_query($link, $sql);


    echo "<script>alert('Invoice as been successfully pay using Cash. Redirecting to receipt');
                   window.location.href='createReceipt.php?invoiceID=$invoiceID';
                </script>";
}





