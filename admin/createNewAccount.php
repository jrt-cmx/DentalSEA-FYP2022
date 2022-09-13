<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!--------------------- Head --------------------->
    <?php include "../includes/head.php" ?>
    <title> Create Account </title>
</head>

<body class="body">
    <!-- <h1 class="header">New Patient Profile</h1> -->
    <!--------------------- Header --------------------->
    <?php include "../includes/header.php"; ?>
    <!--------------------- Side Bar --------------------->
    <?php include "../includes/sideBar.php"; ?>
    <?php include "../includes/navBar/navBar.php"; ?>

    <section class="home-section">
        <div class="form--top">
            <h2 class="page-title">Create User Account</h2>
        </div>
        <form method="POST" class="form" autocomplete="off" action="doRegister.php">
            <label class="form-label span-2" for="loginId">Username</label>
            <input id="loginId" class="form-user-input span-2" name="loginId" value="" required autofocus />
            <div class="invalid-feedback">Username is invalid</div>

            <label class="form-label span-2" for="fname">First Name</label>
            <input id="fname" class="form-user-input span-2" name="fname" value="" required autofocus />
            <div class="invalid-feedback">First name is invalid</div>

            <label class="form-label span-2" for="lname">Last Name</label>
            <input id="lname" class="form-user-input span-2" name="lname" value="" required autofocus />
            <div class="invalid-feedback">Last name is invalid</div>
            <label class="form-label span-2" for="password">Password</label>

            <input id="password" type="text" class="form-user-input span-2" name="password" required />
            <div class="invalid-feedback">Password is required</div>

            <label class="form-label span-2" for="roles">User Type</label>

            <select class="form-select span-2" name="roles" id="roles" aria-label="Default select example">
                <option selected>Select User Type</option>
                <option value="Admin">Admin</option>
                <option value="Assistant">Assistant</option>
                <option value="Dentist">Dentist</option>
            </select>

            <button type="submit" class="btn-submit span-2">
                Register
            </button>
            <a href="userAccount.php" class="btn-return span-2">Back</a>
        </form>

    <?php include "../includes/footer/footer.php"; ?>
    </section>

    <!--------------------- Scripts --------------------->
    <script src="../javascript/indexNLogin.js"></script>
    <?php include "../includes/scripts.php"; ?>
</body>

</html>