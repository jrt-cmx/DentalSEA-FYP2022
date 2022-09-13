<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Receipt</title>

    <!-- Invoice styling -->
    <style>
        @media print {
            #printPageButton {
                display: none;
            }
        }
    </style>
</head>

<body>
<form>
    <div class="card">
        <div class="card-body">
            <div class="container mb-5 mt-3">
                <div class="row d-flex align-items-baseline">
                    <?php
                    include "../connection/db.php";
                    $invoiceID = $_GET['invoiceID'];
                    $date = '';
                    $time = '';
                    $idNo = '';
                    $totalAmount = '';
                    $consultationCost = '';
                    $sql1 = "SELECT * FROM invoice WHERE invoiceID = '$invoiceID'";

                    $result1 = $link->query($sql1);
                    if ($result1->num_rows > 0) {
                    while ($row = $result1->fetch_assoc()) {

                    ?>
                    <div class="col-xl-9">
                        <p style="color: #7e8d9f;font-size: 20px;">Receipt >> <strong><?php echo $row['invoiceID']; $consultationCost = $row['consultationCost'];?></strong></p>
                    </div>
                    <div class="col-xl-3 float-end">
                        <button class="btn btn-light text-capitalize border-0" id="printPageButton" onclick="myFunction();" disabled="disabled" data-mdb-ripple-color="dark"><i
                                    class="fas fa-print text-primary"></i> Control-P to Print </button>
                        <a href="invoice.php" class="btn btn-light text-capitalize" id="printPageButton" data-mdb-ripple-color="dark"><i
                                    class="fas fa-home text-primary"></i> Back </a>
                    </div>
                    <hr>
                </div>

                <div class="container">
                    <div class="col-md-12">
                        <div class="text-center">
                            <p class="pt-0"><img src="../image/dentalSea.png" alt="Company logo" style="width: 100%; max-width: 300px" /></p>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-xl-8">
                            <ul class="list-unstyled">
                                <li class="text-muted">To: <span style="color:#5d9fc5 ;"><?php echo $row['patientName']; ?></span></li>
                                <li class="text-muted">NRIC: <span style="color:#5d9fc5 ;"><?php echo $idNo = $row['NRIC']?></span></li>
                            </ul>
                        </div>
                        <div class="col-xl-4">
                            <p class="text-muted">Receipt</p>
                            <ul class="list-unstyled">
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                            class="fw-bold">Prescription ID: </span><?php echo $row['prescriptionID']; ?></li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                            class="fw-bold">Creation Date: </span> <?php echo $date = $row['date']; ?></li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                            class="fw-bold">Time: </span> <?php echo $time = $row['time']; ?></li>
                                <li class="text-muted"><i class="fas fa-circle" style="color:#84B0CA ;"></i> <span
                                            class="me-1 fw-bold">Status:</span><span class="badge bg-warning text-black fw-bold">
                                            <?php echo $row['payment']; $totalAmount = $row['price'];?></span><?php  echo ' ' . $row['remarks']; ?></li>
                            </ul>
                        </div>
                    </div>

                    <div class="row my-2 mx-1 justify-content-center">
                        <table class="table table-striped table-borderless">
                            <thead style="background-color:#84B0CA ;" class="text-white">
                            <tr>
                                <td>Item</td>
                                <td>Quantity</td>
                                <td>Price</td>
                                <td>Total</td>
                            </tr>
                            </thead>
                            <tbody>
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
                            $result1 = $link->query($sql);
                            if ($result1->num_rows > 0) {
                            while($row1 = $result1->fetch_assoc()) {
                            echo "<tr class='details'>"
                                . "<td>" .$row1['medicationName']. "</td>"
                                . "<td>" . $row1['dosage']. "</td>"
                                . "<td>" ."$". $row1['price']. "</td>"
                                . "<td>" ."$". $price = $row1['price'] * $row1['dosage'] . "</td>"
                                . "</tr>";
                            $total += (int)$price;
                            }
                            }
                            $link->close();?>
                            </tbody>

                        </table>

                    </div>
                    <div class="row">
                        <div class="col-xl-3">
                            <ul class="list-unstyled">
                                <li class="text-muted ms-3"><span class="text-black me-4">SubTotal: </span>$<?php echo $total?></li>
                                <li class="text-muted ms-3"><span class="text-black me-4">Consultation Cost: </span>$<?php echo $consultationCost;?></li>
                            </ul>
                            <p class="text-black float-start"><span class="text-black me-3"> Total Amount:</span><span
                                        style="font-size: 25px;">$<?php echo $totalAmount?></span></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xl-10">
                            <p>Thank you for your purchase</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>
    <!-- Font Awesome -->
    <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
            rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
            href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
            rel="stylesheet"
    />
    <!-- MDB -->
    <link
            href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.css"
            rel="stylesheet"
    />
    <!-- MDB -->
    <script
            type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.js"
    ></script>
<script>
    function myFunction(){
        window.print();
    }

    window.onafterprint = function(e){
        closePrintView();
    };

    function closePrintView() {
        window.location.href = 'createReceipt.php?invoiceID=<?php echo $invoiceID ?>
    }
</script>