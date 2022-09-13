<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!--------------------- Head --------------------->
    <?php include "../includes/head.php" ?>
    <title> Update Notes </title>
</head>

<body class="body">
    <!--------------------- Header --------------------->
    <?php include "../includes/header.php"; ?>
    <!--------------------- Side Bar --------------------->
    <?php include "../includes/navBar/navBar.php"; ?>
    <?php include '../includes/sideBar.php'; ?>

    <section class="home-section">
        <div class="notes-form">
            <h2 class="notes-form-title">Update Notes</h2>
            <form method="POST" class="needs-validation" novalidate="" autocomplete="off" action="doUpdateNotes.php">
                <?php
                include "../connection/db.php";
                error_reporting(0);

                $patientID = $_SESSION['patientID'];
                $patientName = $_SESSION['pNames'];
                $number = $_GET['number'];
                $_SESSION['number'] = $number;
                $query = "SELECT * FROM patientnotes WHERE number = '$number'";
                $result = $link->query($query);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) { ?>
                        <label class="form-label">Name: </label>
                        <input class="notes-input" placeholder="Your name.." type="text" value="<?php echo $patientName ?>" disabled="disabled">
                        <div class="">
                            <label class="form-label">Remarks</label>
                            <textarea maxlength="140" iplaceholder="Write something.." id="newRemarks" name="newRemarks" class="form-control" required><?php echo $row['remarks']; ?></textarea>
                            <div class="invalid-feedback">remarks is require</div>
                        </div>
                        <div class="update-notes-buttons">
                            <button type="submit" class="btn-submit">
                                Update
                            </button>
                            <a href="javascript:history.go(-1)" class="btn-return">Back</a>
                        </div>
                <?php }
                }
                $link->close(); ?>
            </form>
        </div>
    </section>
    <!--------------------- Scripts --------------------->
    <?php include "../includes/scripts.php"; ?>
</body>

</html>