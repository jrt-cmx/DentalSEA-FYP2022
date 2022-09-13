<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>View Invoice</title>

    <!-- Invoice styling -->
    <style>
        body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            text-align: center;
            color: #777;
        }

        body h1 {
            font-weight: 300;
            margin-bottom: 0px;
            padding-bottom: 0px;
            color: #000;
        }

        body h3 {
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }

        body a {
            color: #06f;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        .button_group {
            display: flex;
            flex-direction: column;
        }

        .btn {
            text-decoration: none;
        }

        .btn-danger {
            color: #ef233c;
        }

        .btn-danger:hover,
        .btn-danger:focus {
            color: #b40421;

        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <form>
        <div class="invoice-box">
            <table>
                <?php
                include "../connection/db.php";
                $invoiceID = $_GET['invoiceID'];
                $date = '';
                $time = '';
                $idNo = '';
                $totalAmount = '';
                ?>
                <tr class="top">
                    <td colspan="4">
                        <table>
                            <tr>
                                <td class="title">
                                    <img src="../image/dentalSea.png" alt="Company logo" style="width: 100%; max-width: 300px" />

                                </td>

                                <td>
                                    <h2>Invoice</h2>
                                    <?php
                                    $sql1 = "SELECT * FROM invoice WHERE invoiceID = '$invoiceID'";

                                    $result1 = $link->query($sql1);
                                    if ($result1->num_rows > 0) {
                                        while ($row = $result1->fetch_assoc()) {
                                    ?>
                                            <h2 style="color: green">
                                                <?php echo $row['payment']; ?>
                                            </h2>
                                            Invoice ID: <?php echo $row['invoiceID']; ?><br />
                                            Date: <?php echo $date = $row['date']; ?><br />
                                            Time: <?php echo $time = $row['time']; ?><br />
                                            Prescription ID: <?php echo $row['prescriptionID']; ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="information">
                    <td colspan="4">
                        <table>
                            <tr>
                                <td>
                                    <label>
                                        Patient Name: <?php echo $row['patientName'] ?> <br />
                                        NRIC: <?php echo $idNo = $row['NRIC'] ?>
                                    </label>
                                    <br />
                                </td>

                                <td>
                                    DentalSEA.<br />
                                    dentalsea123@gmail.com
                                    <br />
                                    461 Clementi Rd, <br />
                                    Singapore 599491
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr class="heading">
                    <td>Payment Method</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr class="details">
                    <td><label>
                            <input value="<?php echo $row['remarks'] ?>" disabled="disabled">
                        </label>
                    </td>
                    <td></td>
                    <td></td>
                </tr>

                <tr class="heading">
                    <td>Medical Service</td>
                    <td></td>
                    <td></td>
                    <td>Price</td>
                </tr>

                <tr class="details">
                    <td>Consultation</td>
                    <td></td>
                    <td></td>
                    <td>
                        <label for="consultationCost">$</label>
                        <input name="consultationCost" id="consultationCost" type="number" value="<?php echo $row['consultationCost'];
                                                                                                    $totalAmount = $row['price'];
                                                                                                    ?>" disabled="disabled">
                    </td>
                </tr>

                <tr class="heading">
                    <td>Item</td>
                    <td>Quantity</td>
                    <td>Price</td>
                    <td>Total</td>
                </tr>

        <?php
                                        }
                                    }
                                    $price = 0;
                                    $total = 0;
                                    $sql = "SELECT p.date ,p.prescriptionID ,pd.medicationName, pd.dosage, m.price
                                    FROM prescription p
                                    INNER JOIN prescriptiondetails AS pd ON p.prescriptionID = pd.prescriptionID 
                                    INNER JOIN medication AS m ON m.medicationName = pd.medicationName
                                    WHERE date = '$date' AND NRIC = '$idNo' AND time = '$time'
                                    ;
                                    ";
                                    $result = $link->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row1 = $result->fetch_assoc()) {
                                            echo "<tr class='details'>"
                                                . "<td>" . $row1['medicationName'] . "</td>"
                                                . "<td>" . $row1['dosage'] . "</td>"
                                                . "<td>" . "$" . $row1['price'] . "</td>"
                                                . "<td>" . "$" . $price = $row1['price'] * $row1['dosage'] . "</td>"
                                                . "</tr>";
                                            $total += (int)$price;
                                        }
                                    }
                                    $link->close(); ?>
        <tr class="total">
            <td></td>
            <td></td>
            <td></td>
            <td>
                <span>
                    <label for="totalCost">Item Total Cost: $</label>
                    <input name="totalCost" id="totalCost" disabled="disabled" value="<?php echo $total ?>">
                </span>
                <br>
                <span>
                    <label for="totalAmount">Total Amount: $</label>
                    <input name="totalAmount" id="totalAmount" disabled="disabled" value="<?php echo $totalAmount ?>">
                </span>
            </td>
        </tr>
            </table>
            <div class="button_group">
                <a href="payInvoice.php?invoiceID=<?php echo $invoiceID ?>&totalCost=<?php echo $totalAmount ?>" class="btn btn-success"> Pay / View Receipt </a>
                <a href="javascript:history.go(-1)" class="btn btn-danger">Back</a>
            </div>
        </div>
    </form>
</body>

</html>
<link rel="stylesheet" href="../assets/libs/bootstrap/dist/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>