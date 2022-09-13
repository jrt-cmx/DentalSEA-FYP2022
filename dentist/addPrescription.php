<?php
include('../connection/db.php');
$idNo = $_SESSION['idNo'];
date_default_timezone_set('Asia/Singapore');
$date = date("Y-m-d");
$time = date("h:i:sa");

if(isset($_POST["medicationName"]))
{
    $query1 = mysqli_query($link, "INSERT INTO prescription (NRIC, date, time) VALUES ('$idNo', '$date', '$time');");
    $id = mysqli_insert_id($link);

    for($count = 0; $count < count($_POST["medicationName"]); $count++)
    {
        $query = "
		INSERT INTO prescriptiondetails
        (prescriptionID ,medicationName, dosage, amtToTake, amtTimeFrame) 
        VALUES ('$id' ,:medicationName, :item_quantity, :amtToTake, :amtTimeFrame) 
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
        echo 'ok';
    }
}

