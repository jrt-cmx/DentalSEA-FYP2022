<!DOCTYPE html>
<html>

<head>

    <!--------------------- Head --------------------->
    <?php include "../includes/head.php" ?>
    <script src="https://code.jquery.com/jquery-1.11.3.js"></script>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <title> View patient </title>
</head>

<body class="body">
    <!-- <h1 class="header">New Patient Profile</h1> -->
    <!--------------------- Header --------------------->
    <?php include "../includes/header.php"; ?>
    <!--------------------- Side Bar --------------------->
    <?php include "../includes/navBar/navBar.php"; ?>
    <?php include "../includes/sideBar.php"; ?>

    <section class="home-section">
        <div class="prescription-form">

            <?php
            date_default_timezone_set('Asia/Singapore');
            include "../connection/db.php";

            $patientName = $_SESSION['pNames'];
            $idNo = $_SESSION['idNo'];
            $pID = $_SESSION['pID'];
            $count = 1;
            ?>

            <div class="form-top-presc">
                <label class="form-label">Name:</label>
                <input disabled="disabled" type="text" class="form-label" value="<?php echo $patientName ?>">
                <label class="form-label">NRIC:</label>
                <input disabled="disabled" type="text" class="form-label" value="<?php echo ' ', $idNo ?>">
                <label class="form-label">Prescription ID:</label>
                <input disabled="disabled" type="text" class="form-label" value="<?php echo ' ', $pID ?>">
            </div>

            <!-- INPUT FOR medicine  -->
            <div class="container">
                <?php
                //index.php
                function fill_unit_select_box($connect)
                {
                    $output = '';
                    $query = "SELECT * FROM medication ORDER BY medicationName ASC";
                    $statement = $connect->prepare($query);
                    $statement->execute();
                    $result = $statement->fetchAll();
                    foreach ($result as $row) {
                        $output .= '<option value="' . $row["medicationName"] . '">' . $row["medicationName"] . '</option>';
                    }
                    return $output;
                }

                ?>
                <h4 align="Left">Enter Medicine Details</h4>
                <form method="post" id="insert_form">
                    <div class="table-repsonsive">
                        <span id="error"></span>
                        <table class="table table-bordered table-striped" id="item_table">
                            <tr>
                                <th>Medicine</th>
                                <th>Enter Quantity</th>
                                <th>Amount to Take(Per Day)</th>
                                <th>Time Frame</th>
                                <th><button type="button" name="add" class="btn btn-success btn-sm add"><i class="fas fa-plus"></i></button></th>
                            </tr>
                        </table>
                        <div class="addrow-presc-buttons">
                            <input type="submit" name="submit" class="btn-submit" value="Insert" />
                            <a href="javascript:history.go(-1)" class="btn-return">Back</a>
                        </div>
                    </div>
                </form>
            </div>

    </section>


</body>

</html>
<script>
    $(document).ready(function() {
        var count = 0;
        // Append the table while the click button is clicked
        $(document).on('click', '.add', function() {
            var html = '';
            html += '<tr>';
            html += '<td><select name="medicationName[]" class="form-control medicationName" data-live-search="true"><option value="">Select Medicine</option><?php echo fill_unit_select_box($connect); ?></select></td>';
            html += '<td><select name="item_quantity[]" class="form-control item_quantity">' +
                '<option value="">Select Quantity</option>' +
                '<option value="1">1</option>' +
                '<option value="2">2</option>' +
                '<option value="3">3</option>' +
                '<option value="4">4</option>' +
                '<option value="5">5</option></select></td>';
            html += '<td><input type="text" name="amtToTake[]" class="form-control amtToTake" /></td>';
            html += '<td><input type="text" name="amtTimeFrame[]" class="form-control amtTimeFrame" /></td>';
            html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove">Remove</button></td></tr>';
            $('#item_table').append(html);
        });

        // Remove the table row when the romove button is clicked
        $(document).on('click', '.remove', function() {
            $(this).closest('tr').remove();
        });

        // Insert the collected data when the submit button is clicked
        $('#insert_form').on('submit', function(event) {
            event.preventDefault();
            var error = '';
            count = 1;
            $("select[name='medicationName[]']").each(function() {
                if ($(this).val() == '') {
                    error += "<li>Select medicine at " + count + " Row</li>";
                }
                count = count + 1;
            });
            count = 1;

            $("select[name='item_quantity[]']").each(function() {
                if ($(this).val() == '') {
                    error += "<li>Select quantity at " + count + " Row</li>";
                }
                count = count + 1;
            });
            count = 1;

            $('.amtToTake').each(function() {
                if ($(this).val() == '') {
                    error += "<li>Enter amount to take at " + count + " Row</li>";
                }
                count = count + 1;
            });
            count = 1;

            $('.amtTimeFrame').each(function() {
                if ($(this).val() == '') {
                    error += "<li>Enter amount time frame at " + count + " Row</li>";
                }
                count = count + 1;
            });
            count = 1;

            var form_data = $(this).serialize();
            if (error === '') {
                $.ajax({
                    url: "../dentist/addAdditionalPre.php",
                    method: "POST",
                    data: form_data,
                    success: function(data) {
                        if (data === 'ok') {
                            $('#item_table').find("tr:gt(0)").remove();
                            $('#error').html('<div class="alert alert-success">Prescription Details Saved</div>');
                        }
                    }
                });
            } else {
                $('#error').html('<div class="alert alert-danger">' + error + '</div>');
            }
        });
    });
</script>