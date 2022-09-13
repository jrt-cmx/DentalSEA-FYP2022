<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "../includes/head.php" ?>
    <title> Invoice </title>
</head>

<body class="body">
    <!--------------------- Header --------------------->
    <?php include "../includes/header.php"; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <title>User accounts</title>
    <script>
        $(document).ready(function() {
            load_data();

            function load_data(query) {
                $.ajax({
                    url: "processSearchInvoice.php",
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

    <!--------------------- Side Bar --------------------->
    <?php include "../includes/sideBar.php"; ?>
    <?php include "../includes/navBar/navBar.php"; ?>





    <!-- Main content -->
    <section class="home-section">
        <h2 class="page-title">Invoice</h2>
        <div class="list--top">
            <label for="search"></label><input class="searchText" type="text" id="search" name="search" placeholder="Search invoiceID/PrescriptionID">
        </div>
        <div class="table-section">
            <div class="table-part">
                <p class="table-column-header">Number</p>
                <p class="table-column-header">Patient Name</p>
                <p class="table-column-header">Date</p>
                <p class="table-column-header column-four">Payment Method</p>
                <p class="table-column-header column-five">Total Price</p>
                <p class="table-column-header column-six">Status</p>
                <p class="table-column-header action">Action</p>
            </div>
            <div id="result"></div>
        </div>
    <?php include "../includes/footer/footer.php"; ?>
    </section>
    <!--------------------- Scripts --------------------->
    <?php include '../includes/scripts.php' ?>
</body class="body">


</html>