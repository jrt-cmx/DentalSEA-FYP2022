<div class="tab-content" id="presc-part">
    <div class="presc-part">
        <a href="#addPrescription" class="btn-add"><i class="fa-solid fa-square-plus"></i><span>Add</span></a>
        <div class="table-section">
            <div class="table-part">
                <!-- <p class="table-column-header">No.</p> -->
                <p class="table-column-header">ID</p>
                <p class="table-column-header">Date</p>
                <p class="table-column-header">Time</p>
                <p class="table-column-header column-four"></p>
                <p class="table-column-header column-five"></p>
                <p class="table-column-header column-six"></p>
                <p class="table-column-header action">Action</p>
            </div>
            <?php
            date_default_timezone_set('Asia/Singapore');
            include "../connection/db.php";

            $patientName = $_SESSION['pNames'];
            $idNo = $_GET['idNo'];
            $count = 1;
            $pID = '';
            $prescription = "SELECT * FROM prescription WHERE NRIC = '$idNo' ORDER BY date DESC, time DESC;
                     ";
            $result4 = $link->query($prescription);
            if ($result4->num_rows > 0) {
                // output data of each row
                while ($row = $result4->fetch_assoc()) {
                    echo "<div class='table-row'>"
                        . "<p class='table-column-input'>" . $row['prescriptionID'] . "</p>"
                        . "<p class='table-column-input'>" . $row['date'] . "</p>"
                        . "<p class='table-column-input'>" . $row['time'] . "</p>"
                        . "<p class='table-column-input column-four'>" . "" . "</p>"
                        . "<p class='table-column-input column-five'>" . "" . "</p>"
                        . "<p class='table-column-input column-six'>" . "" . "</p>"
                        . "<p class='table-column-input action'>"
                        . "<a class='column-input-link' href='../dentist/viewPrescription.php?date=" . $row['date'] . "&time=" . $row['time'] . "&pID=" . $row['prescriptionID'] . "'><i class='fa-solid fa-eye'></i></a> " . " "
                        . "<a class='column-input-link' href='../dentist/editPrescription.php?date=" . $row['date'] . "&time=" . $row['time'] . "&pID=" . $row['prescriptionID'] . "'><i class='fa-solid fa-pen'></i></a> " . " "
                        . "<a class='column-input-link' onClick=\"javascript: return confirm('Please confirm deletion for this prescription');\"
				                        href=\"../dentist/deletePrescription.php?pID=" . $row['prescriptionID'] . "\"><i class='fa-solid fa-trash'></i></a> " . "</p>"
                        . "</div>";
                    $pID = $row['prescriptionID'];
                }
            }
            $link->close();
            ?>
            <!-- . "<p class='table-column-input'>" . $count++ . "</p>" -->

        </div>
        <link rel="stylesheet" href="../css/prescriptionPopup.css">
        <div class="overlay" id="addPrescription">
            <div class="wrapper">
                <h2>Add Prescription</h2><a class="close" href="#">&times;</a>
                <div class="content">
                    <div class="container">
                        <div class="mb-3">
                            <br>
                            <label>
                                <label>Name:</label>
                                <label>
                                    <input disabled="disabled" type="text" class="text" value="<?php echo $patientName ?>">
                                </label>
                                <br>
                                <label>NRIC:</label>
                                <label>
                                    <input disabled="disabled" type="text" class="text" value="<?php echo ' ', $idNo ?>">
                                </label>
                            </label>
                        </div>
                        <div>
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
                                $patientID = $_SESSION['patientID'];
                                ?>
                                <br />
                                <h4 align="Left">Enter Medicine Details</h4>
                                <br />
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
                                        <div align="left">
                                            <input type="submit" name="submit" class="btn btn-block btn-success" value="Insert" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                            url: "../dentist/addPrescription.php",
                            method: "POST",
                            data: form_data,
                            success: function(data) {
                                if (data === 'ok') {
                                    $('#item_table').find("tr:gt(0)").remove();
                                    $('#error').html('<div class="alert alert-success">Prescription Details Saved</div>');
                                    window.location.href = 'viewPatient.php?patientID=<?php echo $patientID ?>&idNo=<?php echo $idNo ?>';
                                }
                            }
                        });
                    } else {
                        $('#error').html('<div class="alert alert-danger">' + error + '</div>');
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function() {
                $("#createInvoice").submit(function(e) {
                    //stop submitting the form to see the disabled button effect
                    e.preventDefault();
                    //disable the submit button
                    $("#btnSubmit").attr("disabled", true);
                    return true;
                });
            });
        </script>