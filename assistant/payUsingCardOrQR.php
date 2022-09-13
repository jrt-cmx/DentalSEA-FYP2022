<?php
include('../connection/db.php');

$invoiceID = $_GET['invoiceID'];
$paid = 'PAID';

$sql = "UPDATE invoice SET payment = '$paid' WHERE invoiceID ='$invoiceID'";
$status1 = mysqli_query($link, $sql);

echo "<script>alert('Successfully pay. Redirecting to receipt');
                   window.location.href='createReceipt.php?invoiceID=$invoiceID';
                </script>";