<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--------------------- Head --------------------->
    <?php include "../includes/head.php" ?>
    <title>View Notes</title>
</head>

<body class="body">
    <!--------------------- Header --------------------->
    <?php include "../includes/header.php"; ?>
    <!--------------------- Side Bar --------------------->
    <?php include "../includes/sideBar.php"; ?>
    <?php include "../includes/navBar/navBar.php"; ?>

    <!-- Main content -->
    <section class="home-section">
        <?php
        include "../connection/db.php";
        $patientName = $_SESSION['pNames'];
        ?>
        <form>
            <!-- <link rel="stylesheet" href="../css/popUp.css"> -->
            <div class="form">
                <h2>View Notes</h2>
                <div class="content span-2">
                    <div class="container">
                        <form class="needs-validation" novalidate="" autocomplete="off">
                            <label >Name</label>
                            <input placeholder="Your name.." type="text" value="<?php echo $patientName ?>" disabled="disabled">
                            <div class="mb-3">
                                <label>Remarks</label>
                                <?php
                                $idNo = $_SESSION['idNo'];
                                $numberNotes = $_GET['number'];
                                $sql2 = "SELECT * FROM patientnotes WHERE idNo = '" . $idNo . "' AND number = '$numberNotes'";
                                $result2 = $link->query($sql2);

                                if ($result2->num_rows > 0) {
                                    // output data of each row
                                    while ($row = $result2->fetch_assoc()) { ?>
                                        <textarea iplaceholder="Write something.." id="remarks" name="remarks" class="form-control" disabled="disabled"><?php echo $row['remarks'] ?></textarea>
                                <?php
                                    }
                                } else {
                                    echo "0 results";
                                }
                                $link->close();
                                ?>
                            </div>
                            <div class="button_group">
                                <a href="javascript:history.go(-1)" type="button" class="btn-return">Back</a>
                                <script src="/javascript/indexNLogin.js"></script>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </form>
    </section>
    <?php include "../includes/footer/footer.php"; ?>
    <!--------------------- Scripts --------------------->
    <?php include '../includes/scripts.php' ?>


</body>

</html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>