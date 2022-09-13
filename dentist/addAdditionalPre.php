<?php
include('../connection/db.php');
$idNo = $_SESSION['idNo'];
$pID = $_SESSION['pID'];
$paid = 'PAID';

    if (isset($_POST["medicationName"])) {
        for ($count = 0; $count < count($_POST["medicationName"]); $count++) {
            $query = "
		INSERT INTO prescriptiondetails
        (prescriptionID ,medicationName, dosage, amtToTake, amtTimeFrame) 
        VALUES ('$pID' ,:medicationName, :item_quantity, :amtToTake, :amtTimeFrame) 
		";

            $statement = $connect->prepare($query);
            $statement->execute(
                array(
                    ':medicationName' => $_POST["medicationName"][$count],
                    ':item_quantity' => $_POST["item_quantity"][$count],
                    ':amtToTake' => $_POST["amtToTake"][$count],
                    ':amtTimeFrame' => $_POST["amtTimeFrame"][$count]
                )
            );
        }
        $result = $statement->fetchAll();
        if (isset($result)) {
            echo 'ok';
        }
    }

