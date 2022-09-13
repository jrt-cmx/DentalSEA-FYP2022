<?php
session_start();
error_reporting(0);

$idNo = $_SESSION['idNo'];
date_default_timezone_set('Asia/Singapore');
$create_datetime = date("Y-m-d H:i:s");

include '../connection/db.php';

// check if the user has clicked the button "UPLOAD"
if (isset($_POST['upload'])) {
    // Get image name
    $image = $_FILES['image']['name'];
    // Get text
    $image_text = mysqli_real_escape_string($link, $_POST['image_text']);

    if (!file_exists('../upload')) {
        mkdir('../upload', 0777, true);
    }
    // image file directory
    $target = "../upload/".basename($image);

    $result = mysqli_query($link, "INSERT INTO images (idNo, filename, imageText, date) VALUES ('$idNo', '$image', '$image_text' , '$create_datetime')");
    // execute query

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        echo "<script>alert('images successfully added');
                   window.location.href='javascript:history.go(-2)';
                </script>";
    }else{
        echo "<script>alert('Fail, please try again');
                   window.location.href='javascript:history.go(-1)';
                </script>";
    }
}
