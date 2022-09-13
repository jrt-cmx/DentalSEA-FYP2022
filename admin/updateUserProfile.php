<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!--------------------- Head --------------------->
    <?php include "../includes/head.php" ?>
    <title> Update Profile </title>
</head>

<body class="body">
    <!-- <h1 class="header">New Patient Profile</h1> -->
    <!--------------------- Header --------------------->
    <?php include "../includes/header.php"; ?>
    <!--------------------- Side Bar --------------------->
    <?php include "../includes/navBar/navBar.php"; ?>
    <?php include "../includes/sideBar.php"; ?>


    <section class="home-section">
        <div class="form--top">
            <h2 class="page-title">Update Profile</h2>
        </div>
        <form method="POST" class="form" autocomplete="off" action="doUpdateProfile.php">
            <?php
            include "../connection/db.php";
            error_reporting(0);

            $rollno = $_GET['loginID'];
            $userType = $_GET['userType'];
            $query = "SELECT * FROM useraccount WHERE loginID = '$rollno'";
            $result = $link->query($query);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) { ?>
                    <label class="form-label span-2" for="loginID">Username</label>
                    <input id="loginID" class="form-user-input span-2" name="loginID" value=" <?php echo $_SESSION['loginID'] = $row['loginID'] ?>" disabled="disabled" required autofocus />

                    <label class="form-label span-2" for="fName">First Name</label>
                    <input id="fName" type="text" class="form-user-input span-2" name="fName" required />
                    <div class="invalid-feedback">First Name is required</div>

                    <label class="form-label span-2" for="lName">Last Name</label>

                    <input id="lName" type="text" class="form-user-input span-2" name="lName" required />
                    <div class="invalid-feedback">Last name is required</div>

                    <label class="form-label span-2" for="userType">User Type</label>

                    <input id="userType" type="text" value="<?php echo $_SESSION['userType'] = $row['userType'] ?>" disabled="disabled" ; class="form-user-input span-2" name="userType" required />

                    <button type="submit" class="btn-submit span-2">Update</button>
                    <a class="btn-return span-2" href="userProfile.php">Back</a>

            <?php }
            }
            $link->close(); ?>
        </form>
        <?php include "../includes/footer/footer.php"; ?>






        <!--------------------- Scripts --------------------->
        <script src="/javascript/indexNLogin.js"></script>
        <?php include "../includes/scripts.php"; ?>
</body>

</html>