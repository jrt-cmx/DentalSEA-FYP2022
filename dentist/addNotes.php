<?php
include "../connection/db.php";
$idNo = $_SESSION['idNo'];
$name = $_SESSION['pNames'];
$remarks = $_POST['remarks'];

$result = mysqli_query($link, "INSERT INTO patientnotes (idNo, remarks) VALUES ('$idNo', '$remarks')");

echo "<script>alert('$name note has been added');
                   window.location.href='javascript:history.go(-2)';
                </script>";
