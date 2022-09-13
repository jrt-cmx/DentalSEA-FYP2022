<?php
   include '../connection/db.php';

   $apptID = "";
   if (isset($_GET['appointmentID'])) 
   {
      $apptID = $_GET['appointmentID'];
   }

   mysqli_query($link,"DELETE FROM appointment WHERE appointmentID='".$apptID."'");
   mysqli_close($link);
   echo "<script>alert('Appointment $apptID has been deleted');
         window.location.href='appointment.php';</script>";
?>

