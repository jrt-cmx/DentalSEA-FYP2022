<!DOCTYPE html>
<html>

<head>
    <!--------------------- Head --------------------->
    <?php include "../includes/head.php" ?>
    <title> Edit Prescription </title>
</head>

<body class="body">
    <!--------------------- Header --------------------->
    <?php include "../includes/header.php"; ?>
    <!--------------------- Side Bar --------------------->
    <?php include "../includes/navBar/navBar.php"; ?>
    <?php include '../includes/sideBar.php'; ?>


    <?php
    include "../connection/db.php";
    $idNo = $_SESSION['idNo'];
    $patientName = $_SESSION['pNames'];
    $address = $_SESSION['address'];
    $postalCode = $_SESSION['postalCode'];
    $phone = $_SESSION['phone'];
    $pID = $_GET['pID'];
    $_SESSION['pID'] = $pID;
    $date = $_GET['date'];
    $time = $_GET['time'];
    ?>
    <section class="home-section">
        <div class="prescription-form">
            <div class="form-top">
                <img class="presc-image" src="../image/dentalSea.png" alt="dentalSea logo" />
                <div class="form-top-date">
                    <!-- <small>Address: <?php echo $address; ?></small> -->
                    <!-- <small>Postal Code: <?php echo $postalCode; ?></small> -->
                    <!-- <small>Contact No: <?php echo $phone; ?></small> -->
                    <p class="form-label">Date: <span><?php echo $date; ?></span></p>
                    <p class="form-label">Time: <span><?php echo $time; ?></span> </p>
                    <!-- <small>Prescription ID: <?php echo $pID ?></small> -->
                </div>
            </div>
            <div class="form-credentials">
                <p class="form-label">Name: <span><?php echo $patientName; ?></span></p>
                <!-- <p>Address: <?php echo $address; ?></p> -->
                <!-- <p>Postal Code: <?php echo $postalCode; ?></p> -->
                <p class="form-label">Contact No: <span><?php echo $phone; ?></span></p>
                <?php $_SESSION['dateNow'] = $date;
                $_SESSION['timeNow'] = $time; ?>
                <!-- <small>PrescriptionID: <?php echo $pID ?></small> -->
            </div>
            <h3 class="form-presc-label"></h3>


            <div>
                <?php
                $paid = 'PAID';
                $unpaid = 'UNPAID';
                include "../connection/db.php";
                $query2 = "SELECT payment FROM invoice where (payment = '$paid' OR payment = '$unpaid') AND prescriptionID = '$pID'";
                $result2 = mysqli_query($link, $query2) or die(mysqli_error($link));

                if (mysqli_num_rows($result2) == 1) { ?>

                <?php  } else { ?>
                    <p style="text-align: left"> Edit Prescription <a style="float: right;" href="addRowPrescription.php" class="btn-add" id="add"><i class="fa-solid fa-xmark-large"></i> Add </a></p>
                <?php  }
                ?>
                <div class="table-section">
                    <div class="table-part">
                        <p class="table-column-header">No.</p>
                        <p class="table-column-header">Medicine</p>
                        <p class="table-column-header header-right">QTY</p>
                        <p class="table-column-header header-right">Amount(Per Day)</p>
                        <p class="table-column-header header-right">Duration</p>
                        <p class="table-column-header column-six"></p>
                        <p class="table-column-header header-right">Action</p>
                    </div>
                    <form action="doEditPrescription.php" method="post" class="needs-validation" novalidate="" autocomplete="off">
                        <?php
                        $query1 = "SELECT payment FROM invoice where (payment = '$paid' OR payment = '$unpaid') AND prescriptionID = '$pID'";
                        $result1 = mysqli_query($link, $query1) or die(mysqli_error($link));

                        $options = '';
                        $query2 = "SELECT * FROM medication ORDER BY medicationName ASC";
                        $result2 = $link->query($query2);

                        while ($row = mysqli_fetch_array($result2)) {
                            $options .= '<option value="' . $row["medicationName"] . '">' . $row["medicationName"] . '</option>';
                        }
                        $pID = '';
                        $count = 1;

                        $sql = "SELECT p.date ,p.prescriptionID ,pd.medicationName, pd.dosage, pd.amtToTake,  pd.amtTimeFrame
                                    FROM prescription p
                                    INNER JOIN prescriptiondetails pd ON p.prescriptionID = pd.prescriptionID WHERE date = '$date' AND NRIC = '$idNo' AND time = '$time' ;
                                    ";
                        $result = $link->query($sql);

                        if (mysqli_num_rows($result1) == 1) {

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<div class='table-row'>"
                                        . "<p class='table-column-input'>" . $count++ . "</p>"
                                        . "<p class='table-column-input'>" . "<select name='medicationName[]' disabled='disabled' class='form-control medicationName' ><option value='$row[medicationName]'>$row[medicationName]</option></select>" . "</p>"
                                        . "<p class='table-column-input'>" . "<select name='item_quantity[]' disabled='disabled' class='form-control item_quantity'><option value='$row[dosage]'>$row[dosage]</option>
                                                <option value='1'>1</option>
                                                <option value='2'>2</option>
                                                <option value='3'>3</option>
                                                <option value='4'>4</option>
                                                <option value='5'>5</option>
                                                </select>" . "</p>"
                                        . "<p class='table-column-input'>" . "<input type='text' disabled='disabled' name='amtToTake[]' class='form-control amtToTake' value='$row[amtToTake]'>" . "</p>"
                                        . "<p class='table-column-input column-six'>" . "" . "</p>"
                                        . "<p class='table-column-input'>" . "<input type='text' disabled='disabled' name='amtTimeFrame[]' class='form-control amtTimeFrame' value='$row[amtTimeFrame]'>" . "</p>"
                                        . "<p class='table-column-input column-right'>" . "NA" . "</p>"
                                        . "</div>";
                                }
                            }
                        } else {
                            if ($result->num_rows > 0) {
                                while ($row1 = $result->fetch_assoc()) {
                                    echo "<div class='table-row'>"
                                    . "<p class='table-column-input'>" . $count++ . "</p>"
                                        . "<p class='table-column-input'>" . "<select name='medicationName[]' class='form-control medicationName' ><option value='$row1[medicationName]'>$row1[medicationName]</option></select>" . "</p>"
                                        . "<p class='table-column-input'>" . "<select name='item_quantity[]' class='form-control item_quantity'><option value='$row1[dosage]'>$row1[dosage]</option>
                                                <option value='1'>1</option>
                                                <option value='2'>2</option>
                                                <option value='3'>3</option>
                                                <option value='4'>4</option>
                                                <option value='5'>5</option>
                                                </select>" . "</p>"
                                        . "<p class='table-column-input'>" . "<input type='text' name='amtToTake[]' class='form-control amtToTake' value='$row1[amtToTake]'>" . "</p>"
                                        . "<p class='table-column-input'>" . "<input type='text' name='amtTimeFrame[]' class='form-control amtTimeFrame' value='$row1[amtTimeFrame]'>" . "</p>"
                                        . "<p class='table-column-input column-six'>" . " " . "</p>"
                                        . "<p class='table-column-input'>" . "<a onClick=\"javascript: return confirm('Please confirm deletion for this row');\"
				                        href=\"../dentist/deleteRowPre.php?pID=" . $row1['prescriptionID'] . "&newMedicationName=" . $row1['medicationName'] . "&newDosage=" . $row1['dosage'] . "&newAmtToTake=" . $row1['amtToTake'] . "&newAmtTimeFrame=" . $row1['amtTimeFrame'] . "\" class='btn btn-danger'><i class='fa-solid fa-trash'></i> Trash </a> " . "</p>"
                                        . "</div>";
                                }
                            }
                        }
                        ?>
                        <div class="presc-buttons">
                            <a href="javascript:history.go(-1)" class="btn btn-primary">Back</a>
                            <?php

                            if (mysqli_num_rows($result1) == 1)
                            { ?>
                                <button class="btn btn-secondary" id="update" type="submit" title="Invoice created" disabled="disabled"><i class="fa-solid fa-pen"></i> Invoice created </button>
                            <?php  }
                            else
                            { ?>
                                <button class="btn btn-secondary" id="update" type="submit"><i class="fa-solid fa-pen"></i> Update </button>
                                <?php
                            }
                            ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!--------------------- Scripts --------------------->
    <?php include "../includes/scripts.php"; ?>
</body>
</html>
<link rel="stylesheet" href="../assets/libs/bootstrap/dist/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>