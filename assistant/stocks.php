<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!--------------------- Head --------------------->
    <?php include "../includes/head.php" ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title> Stocks </title>
    <script>
        $(document).ready(function() {
            load_data();

            function load_data(query) {
                $.ajax({
                    url: "processSearchStock.php",
                    method: "POST",
                    data: {
                        query: query
                    },
                    success: function(data) {
                        $('#result').html(data);
                    }
                });
            }
            $('#search').keyup(function() {
                var search = $(this).val();
                if (search !== '') {
                    load_data(search);
                } else {
                    load_data();
                }
            });
        });
    </script>
</head>

<body class="body">
    <!--------------------- Header --------------------->
    <?php include "../includes/header.php"; ?>
    <!--------------------- Side Bar --------------------->
    <?php include "../includes/sideBar.php"; ?>
    <?php include "../includes/navBar/navBar.php"; ?>

    <!-- Main content -->
    <section class="home-section">
        <h2 class="page-title">Stock</h2>
        <div class="list--top">
            <input class="searchText" type="text" id="search" name="search" placeholder="Search" required>
            <a href="addMedicine.php" class="btn-add"><i class="fa-solid fa-cart-flatbed"></i><span>Add</span></a>
        </div>
        <div class="table-section">
            <div class="table-part">
                <p class="table-column-header">ID</p>
                <p class="table-column-header">Medication</p">
                <p class="table-column-header column-five">Price</p>
                <p class="table-column-header column-four">Expire Date</p>
                <p class="table-column-header">Quantity</p>
                <p class="table-column-header column-six"></p>
                <p class="table-column-header action">Action</p>
            </div>
            <div id="result"></div>
        </div>
    <?php include "../includes/footer/footer.php"; ?>
    </section>

    <!--------------------- Scripts --------------------->
    <?php include '../includes/scripts.php' ?>
</body>

</html>


<!-- <p class="table-column-header">Description</p> -->
