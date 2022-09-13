<?php
session_start();
include "../connection/db.php";

$no = $_GET['no'];
$patientID = $_SESSION['patientID'];
$idNo = $_SESSION['idNo'];

$query = "SELECT * FROM images WHERE no='$no'";
$result = $link->query($query);
if ($result->num_rows > 0) {
// output data of each row
    while ($row = $result->fetch_assoc()) {
        unlink("../upload/".$row['filename']);
    }
}

$sql = "DELETE FROM images WHERE no='$no'";
$status = mysqli_query($link, $sql);


echo "<script>alert('Image has been deleted');
    window.location.href='../assistant/viewPatient.php?patientID=$patientID&idNo=$idNo';
</script>";
