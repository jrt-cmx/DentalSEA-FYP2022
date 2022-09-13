<!DOCTYPE html>
<html>

<head>
    <!--------------------- Head --------------------->
    <?php include "../includes/head.php" ?>
    <title> Prescription </title>
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
    $date = $_GET['date'];
    $time = $_GET['time'];
    $pID = $_GET['pID'];
    ?>

    <section class="home-section">
        <div class="prescription-form">
            <div class="form-top">
                <img class="presc-image" src="../image/dentalSea.png" alt="dentalSea logo" />
                <div class="form-top-date">
                    <p class="form-label">Date: <span><?php echo $date; ?></span></p>
                    <p class="form-label">Time: <span><?php echo $time; ?></span> </p>
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
            <div class="table-section">
                <div class="table-part">
                    <p class="table-column-header">No.</p>
                    <p class="table-column-header">Medicine</p>
                    <p class="table-column-header header-right">QTY </p>
                    <p class="table-column-header header-right">Amount(Per Day)</p>
                    <p class="table-column-header header-right">Duration</p>
                </div>
                <?php
                $count = 1;
                $sql = "SELECT p.date ,p.prescriptionID ,pd.medicationName, pd.dosage, pd.amtToTake,  pd.amtTimeFrame
                                    FROM prescription p
                                    INNER JOIN prescriptiondetails pd ON p.prescriptionID = pd.prescriptionID WHERE date = '$date' AND NRIC = '$idNo' AND time = '$time' ;
                                    ";
                $result = $link->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='table-row'>"
                            . "<p class='table-column-input'>" . $count++ . "</p>"
                            . "<p class='table-column-input'>" . $row['medicationName'] . "</p>"
                            . "<p class='table-column-input header-right'>" . $row['dosage'] . "</p>"
                            . "<p class='table-column-input header-right'>" . $row['amtToTake'] . "</p>"
                            . "<p class='table-column-input header-right'>" . $row['amtTimeFrame'] . "</p>"
                            . "</div>";
                    }
                }
                $link->close(); ?>
            </div>
        </div>
        </div>
        <div class="presc-buttons">
            <?php
            $paid = 'PAID';
            $unpaid = 'UNPAID';
            include "../connection/db.php";
            $query2 = "SELECT payment FROM invoice where (payment = '$paid' OR payment = '$unpaid') AND prescriptionID = '$pID'";
            $result2 = mysqli_query($link, $query2) or die(mysqli_error($link));

            if (mysqli_num_rows($result2) == 1) { ?>
                <a href="../assistant/invoice.php" class="btn-submit">Go to Invoice Page </a>
            <?php  } else { ?>
                <a href="../assistant/createInvoice.php?pID=<?php echo $pID; ?>" id="createInvoice" class="btn-submit">Create Invoice</a>
            <?php  }
            ?>
            <a href="javascript:history.go(-1)" class="btn-return">Back</a>
        </div>
    </section>


    <!--------------------- Scripts --------------------->
    <?php include "../includes/scripts.php"; ?>
</body>

</html>