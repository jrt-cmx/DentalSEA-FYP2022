<?php
   include '../connection/db.php';
// Next of kin
   if(isset($_GET['idNo']))
   {
      $idNo = $_GET['idNo'];
   }
   $result = mysqli_query($link,"DELETE FROM nextofkin WHERE ICorPassportNo='$idNo'");

// Notes
   $result1 = mysqli_query($link,"DELETE FROM patientnotes WHERE idNo ='$idNo'");

// Image
   $query = "SELECT * FROM images WHERE idNo ='$idNo'";
   $result2 = $link->query($query);
   if ($result2->num_rows > 0) {
   // output data of each row
      while ($row = $result2->fetch_assoc()) {
         unlink("../upload/".$row['filename']);
      }
   }

   $result3 = mysqli_query($link,"DELETE FROM images WHERE idNo ='$idNo'");

   $patientID = "";

   if(isset($_GET['patientID']))
   {
      $patientID = $_GET['patientID'];
   }

   mysqli_query($link,"DELETE FROM patient WHERE patientID='".$patientID."'");
   mysqli_close($link);
   echo "<script>alert('Patient $patientID has been deleted');
         window.location.href='patient.php';</script>";
?>

