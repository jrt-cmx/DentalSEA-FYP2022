<?php
include('../connection/db.php');
$idNo = $_SESSION['idNo'];
$pID = $_SESSION['pID'];
$patientID = $_SESSION['patientID'];
$paid = 'PAID';

date_default_timezone_set('Asia/Singapore');
$date = date("Y-m-d");
$time = date("h:i:sa");

    if(isset($_POST["medicationName"]))
    {
        for($count = 0; $count < count($_POST["medicationName"]); $count++)
        {

            $query = "
		UPDATE prescriptiondetails SET prescriptionID = '$pID', medicationName = :medicationName,
        dosage = :item_quantity, amtToTake = :amtToTake, amtTimeFrame = :amtTimeFrame WHERE prescriptionID = '$pID' AND medicationName = :medicationName
		";

            $statement = $connect->prepare($query);
            $statement->execute(
                array(
                    ':medicationName'   => $_POST["medicationName"][$count],
                    ':item_quantity'  => $_POST["item_quantity"][$count],
                    ':amtToTake' => $_POST["amtToTake"][$count],
                    ':amtTimeFrame'  => $_POST["amtTimeFrame"][$count]
                )
            );
        }
        $result = $statement->fetchAll();
        if(isset($result))
        {
            echo "<script>alert('Updated completed');
                   window.location.href='../assistant/viewPatient.php?patientID=$patientID&idNo=$idNo';
                </script>";
        }
    }

