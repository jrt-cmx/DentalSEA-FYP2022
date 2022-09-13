<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: Arial;
            font-size: 17px;
            padding: 8px;
        }

        * {
            box-sizing: border-box;
        }

        .row {
            display: -ms-flexbox; /* IE10 */
            display: flex;
            -ms-flex-wrap: wrap; /* IE10 */
            flex-wrap: wrap;
            margin: 0 -16px;
        }

        .col-25 {
            -ms-flex: 25%; /* IE10 */
            flex: 25%;
        }

        .col-50 {
            -ms-flex: 50%; /* IE10 */
            flex: 50%;
        }

        .col-75 {
            -ms-flex: 75%; /* IE10 */
            flex: 75%;
        }

        .col-25,
        .col-50,
        .col-75 {
            padding: 0 16px;
        }

        .container {
            background-color: #f2f2f2;
            padding: 5px 20px 15px 20px;
            border: 1px solid lightgrey;
            border-radius: 3px;
        }

        input[type=text] {
            width: 100%;
            margin-bottom: 20px;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        label {
            margin-bottom: 10px;
            display: block;
        }

        .icon-container {
            margin-bottom: 20px;
            padding: 7px 0;
            font-size: 24px;
        }

        .btn {
            background-color: #04AA6D;
            color: white;
            padding: 12px;
            margin: 10px 0;
            border: none;
            width: 100%;
            border-radius: 3px;
            cursor: pointer;
            font-size: 17px;
        }

        .btn:hover {
            background-color: #45a049;
        }

        a {
            color: #2196F3;
        }

        hr {
            border: 1px solid lightgrey;
        }

        span.price {
            float: right;
            color: grey;
        }

        /* Responsive layout - when the screen is less than 800px wide, make the two columns stack on top of each other instead of next to each other (also change the direction - make the "cart" column go on top) */
        @media (max-width: 600px) {
            .row {
                flex-direction: column-reverse;
            }
            .col-25 {
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>

<h2>QR Payment</h2>
<div class="row">
    <div class="col-75">
        <div class="container">
            <?php
            $totalCost = $_GET['totalCost'];
            $invoiceID = $_GET['invoiceID'];
            ?>
            <form>
                <div class="row">
                    <div class="col-50">
                        <h2> Scan here</h2>
                        <img class="center" src="../image/qr-code.png" alt="QR scan" width="500" height="500">
                    </div>
                </div>
                <a href="payUsingCardOrQR.php?invoiceID=<?php echo $invoiceID?>" class="btn btn-success"> Pay </a>
                <br>
                <a href="javascript:history.go(-1)" class="btn btn-danger"><i class="fa-solid fa-xmark-large"></i> Return </a>
            </form>
        </div>
    </div>
    <div class="col-25">
        <div class="container">
            <h4>DentalSea <span class="price" style="color:black"><b>Invoice ID: <?php echo $invoiceID; ?></b></span></h4>
            <hr>
            <p>Total Cost <span class="price" style="color:black"><b>$<?php echo $totalCost; ?></b></span></p>
        </div>
    </div>
</div>

</body>
</html>
<link rel="stylesheet" href="../assets/libs/bootstrap/dist/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="../assets/libs/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="../assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>