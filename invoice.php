<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPC</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="resources/second hand.png">
</head>

<body>
    <div class=" container-fluid">
        <div class="row bgH">
            <?php include "header.php"; ?>
            <div class="col-12 mt-5">
                <div class="row d-flex justify-content-center mt-5">
                    <div class="col-lg-10 col-md-10 col-12 ">
                        <span class=" text-white fs-3 fw-bold">INVOICE</span>
                        <?php
                        if (isset($_GET["id"])) {
                            $invoice_id = $_GET["id"];

                            $invo_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $invoice_id . "'");
                            $invo_data = $invo_rs->fetch_assoc();

                            $prod_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invo_data["product_id"] . "'");
                            $prod_data = $prod_rs->fetch_assoc();

                            $buyer_rs = Database::search("SELECT * FROM `user` WHERE `id`='" . $invo_data["user_id"] . "'");
                            $buyer_data = $buyer_rs->fetch_assoc();

                            $buyeradd_rs = Database::search("SELECT * FROM `address` WHERE `user_id`='" . $buyer_data["id"] . "'");
                            $buyeradd_data = $buyeradd_rs->fetch_assoc();

                            $seller_rs = Database::search("SELECT * FROM `user` WHERE `id`='" . $prod_data["user_id"] . "'");
                            $seller_data = $seller_rs->fetch_assoc();
                        ?>
                            <div class="row text-white bg-dark p-3">
                                <div class="col-12 border-bottom d-flex justify-content-end">
                                    <button class="btn btnbg1 rounded-0 fw-bold text-white col-lg-2 col-md-3 col-6" onclick="printInvoice();">Download</button>
                                </div><br><br>
                                <div class="col-12 bg-dark" id="invoice">
                                    <div class="row ">
                                        <div class="col-lg-3 col-md-3 col-8 ms-4">
                                        <img src="resources/second hand.png" class="col-5" alt="SPC_invoice">                                     
                                        </div>
                                    </div>
                                    <div class="row">
                                    <span class="A" style="color:#ff33ff;">SECONDHAND <span class=" text-danger">PC</span></span>
                                    </div>
                                    <div class="row">
                                        <span class="tec1 text-center fs-3 fw-bold">INVOICE</span>
                                    </div>
                                    <div class="row">
                                        <span class=" text-end"><?php echo $buyer_data["fname"] . " " . $buyer_data["lname"]; ?></span>
                                        <span class=" text-end"><?php echo $buyeradd_data["line1"] . " " . $buyeradd_data["line2"]; ?></span>
                                        <span class=" text-end"><?php echo $buyeradd_data["zipcode"]; ?></span>
                                        <span class=" text-end"><?php echo $invo_data["date"]; ?></span>
                                    </div><br>
                                    <div class="row">
                                        <span>INVOICE ID : <?php echo $invoice_id; ?></span>
                                    </div><br>
                                    <div class="row">
                                        <span>Seller : <?php echo $seller_data["fname"] . " " . $seller_data["lname"]; ?></span>
                                        <span>Seller Contact : <?php echo $seller_data["mobile"]; ?></span>
                                    </div><br>
                                    <div class="row mb-2">
                                        <div class="col-lg-3 col-md-3 col-6 bgcol1 d-flex justify-content-center p-2">
                                            <span class=" fw-bold">Title</span>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-6 bgcol2 d-flex justify-content-center p-2">
                                            <span class=" fw-bold">Price</span>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-6 bgcol1 d-flex justify-content-center p-2">
                                            <span class=" fw-bold">Quantity</span>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-6 bgcol2 d-flex justify-content-center p-2">
                                            <span class=" fw-bold">Specifications</span>
                                        </div>
                                    </div>
                                    <div class="row mt-1">
                                        <div class="col-lg-3 col-md-3 col-6 bgcol1 d-flex justify-content-center p-2">
                                            <span class=" fw-light"><?php echo $prod_data["name"]; ?></span>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-6 bgcol2 d-flex justify-content-center p-2">
                                            <span class=" fw-light"><?php echo $prod_data["price"]; ?></span>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-6 bgcol1 d-flex justify-content-center p-2">
                                            <span class=" fw-light"><?php echo $invo_data["qty"]; ?></span>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-6 bgcol2 d-flex justify-content-center p-2">
                                            <span class=" fw-light"><?php echo $prod_data["specifications"]; ?></span>
                                        </div>
                                    </div><br>
                                    <div class="row d-flex justify-content-end">
                                        <div class="col-lg-5 col-md-5 col-12 ">
                                            <div class="row border-bottom p-2">
                                                <div class="col-6">
                                                    <span>Sub Total :</span><br>
                                                    <span>Delivery Price :</span>
                                                </div>
                                                <div class="col-6">
                                                    <?php
                                                    $sub = $prod_data["price"] * $invo_data["qty"];
                                                    ?>
                                                    <span>Rs.<?php echo $sub; ?>.00/=</span><br>
                                                    <span>Rs.<?php echo $prod_data["delivery_price"]; ?>.00/=</span>
                                                </div>
                                            </div>
                                            <div class="row border-bottom p-2">
                                                <div class="col-5">
                                                    <span class=" fs-4">Total :</span>
                                                </div>
                                                <div class="col-7">
                                                    <?php
                                                    $total = $sub + $prod_data["delivery_price"];
                                                    ?>
                                                    <span class="fw-bold fs-4 text-success">Rs.<?php echo $total; ?>.00/=</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div><br><br>
                                    <div class="row d-flex justify-content-center">
                                        <span class="col-lg-2 col-md-2 col-5 fw-bold fs-4 text-success text-center border-start border-end border-success">PAID</span>
                                    </div><br><br>
                                    <div class="row">
                                        <span class=" fw-bold fs-3 text-center">Thank You For Using Our Service!</span><br>
                                        <span class=" text-center">SPC.lk</span>
                                    </div><br>
                                </div>
                            </div><br>
                        <?php
                        } else {
                        ?>
                            <div class="row vh-100 vw-100 d-flex justify-content-center align-items-center">
                                <span class=" fs-1 fw-bold text-danger">Access Denid.</span>
                            </div>
                        <?php
                        }
                        ?>

                    </div>
                </div>
            </div>
            <?php include "footer.php"; ?>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </div>
</body>

</html>