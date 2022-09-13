<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <!--------------------- Head --------------------->
    <?php include "../includes/head.php" ?>
    <title> Appointments </title>
</head>

<body class="body">
    <!--------------------- Header --------------------->
    <?php include "../includes/header.php"; ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            load_data();

            function load_data(query) {
                $.ajax({
                    url: "processSearchDataAppointment.php",
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
        <h2 class="page-title">Appointments</h2>
        <div class="list--top">
            <input class="searchText" type="text" id="search" name="search" placeholder="Search" autocomplete="off" required>
            <a href="../assistant/addAppointment.php" class="btn-add"><i class="fa-solid fa-calendar-plus"></i><span>Add</span></a>
        </div>
        <div class="table-section">
            <div class="table-part">
                <p class="table-column-header">Number</p>
                <p class="table-column-header">Type</p>
                <p class="table-column-header">Patient</p>
                <p class="table-column-header column-four">Dentist</p>
                <p class="table-column-header column-five">Start Time</p>
                <p class="table-column-header column-six">End Time</p>
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