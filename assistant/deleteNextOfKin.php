<?php
   session_start();
   include '../connection/db.php';

   $idNo = $nokIdNo = $patientID = "";
   if(isset($_GET['idNo']))
   {
      $idNo = $_GET['idNo'];
   }

   if(isset($_GET['nokIdNo']))
   {
      $nokIdNo = $_GET['nokIdNo'];
   }

   if(isset($_GET['patientID']))
   {
      $patientID = $_GET['patientID'];
   }
   $result = mysqli_query($link,"DELETE FROM nextofkin WHERE ICorPassportNo='$idNo' AND nokICorPassportNo ='$nokIdNo'");
   mysqli_close($link);
   echo "<script>alert('The next of kin record has been deleted');
         window.location.href='viewPatient.php?patientID=$patientID&idNo=$idNo';</script>";
?>

