<?php
include "../connection/db.php";
$medicationName = $_POST['medicationName'];
$description = $_POST['description'];
$price = $_POST['price'];
$date = $_POST['date'];
$quantity = $_POST['quantity'];
$threshold = 10;

$query = "SELECT medicationName FROM medication where medicationName = '$medicationName'";
$result = mysqli_query($link, $query) or die(mysqli_error($link));

if (mysqli_num_rows($result) == 1)
{
    echo "<script>alert('medicine already added, please try again');
    window.location.href='javascript:history.go(-2)';
                </script>";
}
else
{
    $result1 = mysqli_query($link, "INSERT INTO medication (medicationName, description, price, expiryDate, quantity, lowThreshold) VALUES ('$medicationName', '$description', '$price', '$date', '$quantity', '$threshold')");

    echo "<script>alert('medicine has been added');
                   window.location.href='javascript:history.go(-2)';
                </script>";
}


