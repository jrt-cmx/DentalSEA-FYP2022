<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <?php include "../includes/head.php" ?>

</head>

<body class="body">
    <!--------------------- Header --------------------->
    <?php include "../includes/header.php"; ?>
    <!--------------------- Side Bar --------------------->
    <?php include '../includes/sideBar.php'; ?>
    <?php include "../includes/navBar/navBar.php"; ?>


    <section class="home-section">
        <div class="form--top">
            <h2 class="page-title">Add Medicine</h2>
        </div>
        <form class="form" action="uploadMedicine.php" method="post">
            <label class="form-label span-2" for="medicationName">Medicine Name</label>
            <input class="form-user-input span-2" type="text" placeholder="Enter Medicine" name="medicationName" id="medicationName" required>

            <label class="form-label span-2" for="description">Description</label>
            <input class="form-user-input span-2" type="text" placeholder="Enter description" name="description" id="description" required>

            <label class="form-label span-2" for="price">Price</label>
            <input class="form-user-input span-2" type="text" placeholder="Enter the price" name="price" id="price" required>

            <label class="form-label span-2" for="date">Expiry Date</label>
            <input class="form-user-input span-2" type="date" name="date" id="date" required pattern="\d{4}-\d{2}-\d{2}">
            <label class="form-label span-2" for="quantity">Quantity</label>
            <input class="form-user-input span-2" type="number" placeholder="Enter quantity" name="quantity" id="quantity" required>
            <button type="submit" class="btn-submit span-2">Add</button>
            <a class="btn-return span-2" href="stocks.php">Back</a>
        </form>
    <?php include "../includes/footer/footer.php"; ?>
    </section>


    <!--------------------- Scripts --------------------->
    <?php include '../includes/scripts.php' ?>
</body>

</html>