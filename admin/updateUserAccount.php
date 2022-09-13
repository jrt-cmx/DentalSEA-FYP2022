<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!--------------------- Head --------------------->
    <?php include "../includes/head.php" ?>
    <title> Update Account </title>
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
            <h2 class="page-title">Update User Account</h2>
        </div>
        <form method="POST" class="form" autocomplete="off" action="doUpdateUser.php">
            <?php
            include "../connection/db.php";
            error_reporting(0);

            $rollno = $_GET['loginID'];
            $query = "SELECT * FROM useraccount WHERE loginID = '$rollno'";
            $result = $link->query($query);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) { ?>
                    <label class="form-label span-2" for="loginID">Username</label>
                    <input id="loginID" class="form-user-input span-2" name="loginID" value=" <?php echo $_SESSION['loginID'] = $row['loginID'] ?>" disabled="disabled" required autofocus />
                    <div class="invalid-feedback">Username is invalid</div>
                    <label class="form-label span-2" for="updatePassword">Password</label>
                    <input id="updatePassword" type="text" class="form-user-input span-2" name="updatePassword" required />
                    <div class="invalid-feedback">Password is required</div>
                    <label class="form-label span-2" for="updateRoles">User Type</label>
                    <select class="form-select span-2" name="updateRoles" id="updateRoles" aria-label="Default select example">
                        <option selected value="Admin">Admin</option>
                        <option value="Assistant">Assistant</option>
                        <option value="Dentist">Dentist</option>
                    </select>

                    <button type="submit" class="btn-submit span-2">
                        Update
                    </button>
                    <a class="btn-return span-2" href="userAccount.php">Back</a>
            <?php }
            }
            $link->close(); ?>
        </form>
    <?php include "../includes/footer/footer.php"; ?>
    </section>
    <!--------------------- Scripts --------------------->
    <script src="/javascript/indexNLogin.js"></script>
    <?php include "../includes/scripts.php"; ?>
</body>

</html>