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
                <div class="row mt-5 d-flex justify-content-center">
                    <?php
                    if (isset($_GET["id"])) {
                        $order_id = $_GET["id"];
                    ?>
                        <div class="col-10 text-white ">
                            <span class=" text-white fs-3 fw-bold">TRACK ORDER</span>
                            <div class="row  bg-dark p-3">
                                <div class="col-12">
                                    <div class="row">
                                        <?php
                                        $ship_rs = Database::search("SELECT * FROM `ship` WHERE `order_id`='" . $order_id . "'");
                                        $ship_num = $ship_rs->num_rows;
                                        $ship_data = $ship_rs->fetch_assoc();

                                        $invo_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $ship_data["order_id"] . "'");
                                        $invo_data = $invo_rs->fetch_assoc();

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invo_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();

                                        $seller_rs = Database::search("SELECT * FROM `user` WHERE `id`='" . $product_data["user_id"] . "'");
                                        $seller_data = $seller_rs->fetch_assoc();

                                        $buyer_rs = Database::search("SELECT * FROM `user` WHERE `id`='" . $invo_data["user_id"] . "'");
                                        $buyer_data = $buyer_rs->fetch_assoc();

                                        $address_rs = Database::search("SELECT * FROM `address` WHERE `user_id`='" . $invo_data["user_id"] . "'");
                                        $address_data = $address_rs->fetch_assoc();

                                        $current_date = new DateTime($invo_data["date"]);

                                        $new_date = clone $current_date;
                                        $new_date->modify('+14 days');
                                        ?>
                                        <span class="fw-bold fs-5">Estimated Delivery Date : <?php echo $new_date->format('Y-m-d'); ?></span>
                                        <span></span>
                                    </div>
                                </div>
                            </div><br>
                            <div class="row  bg-dark p-3">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <span>Order ID : </span>
                                    <span><?php echo $order_id; ?></span><br><br>
                                    <span>Seller : </span>
                                    <span><?php echo $seller_data["fname"] . " " . $seller_data["lname"]; ?></span><br>
                                    <span>Contact : </span>
                                    <span><?php echo $seller_data["mobile"]; ?></span><br>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <span>Zip Code : </span>
                                    <span><?php echo $address_data["zipcode"]; ?></span><br><br>
                                    <span>Buyer : </span>
                                    <span><?php echo $buyer_data["fname"] . " " . $seller_data["lname"]; ?></span><br>
                                    <span>Adddress : </span>
                                    <span><?php echo $address_data["line1"] . " " . $address_data["line2"]; ?></span><br>
                                </div>
                            </div><br>
                            <?php
                            if ($ship_data["track_id"] == 1) {
                            ?>
                                <div class="row bg-dark p-3 d-flex justify-content-center">
                                    <div class="col-2 d-flex justify-content-center">
                                        <span><i class="bi bi-info-circle fs-1 text-primary"></i></span><br>
                                    </div>
                                    <div class="col-2 d-flex justify-content-center">
                                        <span><i class="bi bi-box-seam fs-1"></i></span>
                                    </div>
                                    <div class="col-2 d-flex justify-content-center">
                                        <span><i class="bi bi-buildings fs-1"></i></span>
                                    </div>
                                    <div class="col-2 d-flex justify-content-center">
                                        <span><i class="bi bi-truck fs-1"></i></span>
                                    </div>
                                    <div class="col-2 d-flex justify-content-center">
                                        <span><i class="bi bi-check-circle fs-1"></i></span>
                                    </div>
                                </div>
                                <div class="row bg-dark p-3 d-flex justify-content-center">
                                    <div class="col-2">
                                        <span class=" d-flex justify-content-center text-primary">Shipment Info Recived</span><br>
                                    </div>
                                    <div class="col-2">
                                        <span class=" d-flex justify-content-center">Left From Warehouse</span>
                                    </div>
                                    <div class="col-2">
                                        <span class=" d-flex justify-content-center">Handed Over to Delivery Company</span>
                                    </div>
                                    <div class="col-2">
                                        <span class=" d-flex justify-content-center">Out For Delivery</span>
                                    </div>
                                    <div class="col-2">
                                        <span class=" d-flex justify-content-center">Package Deliverd</span>
                                    </div>
                                </div>
                                <div class="row bg-dark p-3 d-flex justify-content-center">
                                    <div class="col-10">
                                        <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 20%"></div>
                                        </div>
                                    </div>

                                </div><br>
                            <?php
                            }
                            ?>
<?php
                            if ($ship_data["track_id"] == 2) {
                            ?>
                                <div class="row bg-dark p-3 d-flex justify-content-center">
                                    <div class="col-2 d-flex justify-content-center">
                                        <span><i class="bi bi-info-circle fs-1 text-primary"></i></span><br>
                                    </div>
                                    <div class="col-2 d-flex justify-content-center">
                                        <span><i class="bi bi-box-seam fs-1 text-primary"></i></span>
                                    </div>
                                    <div class="col-2 d-flex justify-content-center">
                                        <span><i class="bi bi-buildings fs-1"></i></span>
                                    </div>
                                    <div class="col-2 d-flex justify-content-center">
                                        <span><i class="bi bi-truck fs-1"></i></span>
                                    </div>
                                    <div class="col-2 d-flex justify-content-center">
                                        <span><i class="bi bi-check-circle fs-1"></i></span>
                                    </div>
                                </div>
                                <div class="row bg-dark p-3 d-flex justify-content-center">
                                    <div class="col-2">
                                        <span class=" d-flex justify-content-center text-primary">Shipment Info Recived</span><br>
                                    </div>
                                    <div class="col-2">
                                        <span class=" d-flex justify-content-center text-primary">Left From Warehouse</span>
                                    </div>
                                    <div class="col-2">
                                        <span class=" d-flex justify-content-center">Handed Over to Delivery Company</span>
                                    </div>
                                    <div class="col-2">
                                        <span class=" d-flex justify-content-center">Out For Delivery</span>
                                    </div>
                                    <div class="col-2">
                                        <span class=" d-flex justify-content-center">Package Deliverd</span>
                                    </div>
                                </div>
                                <div class="row bg-dark p-3 d-flex justify-content-center">
                                    <div class="col-10">
                                        <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" style="width: 40%"></div>
                                        </div>
                                    </div>

                                </div><br>
                            <?php
                            }
                            ?>
                            <?php
                            if ($ship_data["track_id"] == 3) {
                            ?>
                                <div class="row bg-dark p-3 d-flex justify-content-center">
                                    <div class="col-2 d-flex justify-content-center">
                                        <span><i class="bi bi-info-circle fs-1 text-warning"></i></span><br>
                                    </div>
                                    <div class="col-2 d-flex justify-content-center">
                                        <span><i class="bi bi-box-seam fs-1 text-warning"></i></span>
                                    </div>
                                    <div class="col-2 d-flex justify-content-center">
                                        <span><i class="bi bi-buildings fs-1 text-warning"></i></span>
                                    </div>
                                    <div class="col-2 d-flex justify-content-center">
                                        <span><i class="bi bi-truck fs-1"></i></span>
                                    </div>
                                    <div class="col-2 d-flex justify-content-center">
                                        <span><i class="bi bi-check-circle fs-1"></i></span>
                                    </div>
                                </div>
                                <div class="row bg-dark p-3 d-flex justify-content-center">
                                    <div class="col-2">
                                        <span class=" d-flex justify-content-center text-warning">Shipment Info Recived</span><br>
                                    </div>
                                    <div class="col-2">
                                        <span class=" d-flex justify-content-center text-warning">Left From Warehouse</span>
                                    </div>
                                    <div class="col-2">
                                        <span class=" d-flex justify-content-center text-warning">Handed Over to Delivery Company</span>
                                    </div>
                                    <div class="col-2">
                                        <span class=" d-flex justify-content-center">Out For Delivery</span>
                                    </div>
                                    <div class="col-2">
                                        <span class=" d-flex justify-content-center">Package Deliverd</span>
                                    </div>
                                </div>
                                <div class="row bg-dark p-3 d-flex justify-content-center">
                                    <div class="col-10">
                                        <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" style="width: 60%"></div>
                                        </div>
                                    </div>

                                </div><br>
                            <?php
                            }
                            ?>
                            <?php
                            if ($ship_data["track_id"] == 4) {
                            ?>
                                <div class="row bg-dark p-3 d-flex justify-content-center">
                                    <div class="col-2 d-flex justify-content-center">
                                        <span><i class="bi bi-info-circle fs-1 text-warning"></i></span><br>
                                    </div>
                                    <div class="col-2 d-flex justify-content-center">
                                        <span><i class="bi bi-box-seam fs-1 text-warning"></i></span>
                                    </div>
                                    <div class="col-2 d-flex justify-content-center">
                                        <span><i class="bi bi-buildings fs-1 text-warning"></i></span>
                                    </div>
                                    <div class="col-2 d-flex justify-content-center">
                                        <span><i class="bi bi-truck fs-1 text-warning"></i></span>
                                    </div>
                                    <div class="col-2 d-flex justify-content-center">
                                        <span><i class="bi bi-check-circle fs-1"></i></span>
                                    </div>
                                </div>
                                <div class="row bg-dark p-3 d-flex justify-content-center">
                                    <div class="col-2">
                                        <span class=" d-flex justify-content-center text-warning">Shipment Info Recived</span><br>
                                    </div>
                                    <div class="col-2">
                                        <span class=" d-flex justify-content-center text-warning">Left From Warehouse</span>
                                    </div>
                                    <div class="col-2">
                                        <span class=" d-flex justify-content-center text-warning">Handed Over to Delivery Company</span>
                                    </div>
                                    <div class="col-2">
                                        <span class=" d-flex justify-content-center text-warning">Out For Delivery</span>
                                    </div>
                                    <div class="col-2">
                                        <span class=" d-flex justify-content-center">Package Deliverd</span>
                                    </div>
                                </div>
                                <div class="row bg-dark p-3 d-flex justify-content-center">
                                    <div class="col-10">
                                        <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" style="width: 80%"></div>
                                        </div>
                                    </div>

                                </div><br>
                            <?php
                            }
                            ?>
                            <?php
                            if ($ship_data["track_id"] == 5) {
                            ?>
                                <div class="row bg-dark p-3 d-flex justify-content-center">
                                    <div class="col-2 d-flex justify-content-center">
                                        <span><i class="bi bi-info-circle fs-1 text-success"></i></span><br>
                                    </div>
                                    <div class="col-2 d-flex justify-content-center">
                                        <span><i class="bi bi-box-seam fs-1 text-success"></i></span>
                                    </div>
                                    <div class="col-2 d-flex justify-content-center">
                                        <span><i class="bi bi-buildings fs-1 text-success"></i></span>
                                    </div>
                                    <div class="col-2 d-flex justify-content-center">
                                        <span><i class="bi bi-truck fs-1 text-success"></i></span>
                                    </div>
                                    <div class="col-2 d-flex justify-content-center">
                                        <span><i class="bi bi-check-circle fs-1 text-success"></i></span>
                                    </div>
                                </div>
                                <div class="row bg-dark p-3 d-flex justify-content-center">
                                    <div class="col-2">
                                        <span class=" d-flex justify-content-center text-success">Shipment Info Recived</span><br>
                                    </div>
                                    <div class="col-2">
                                        <span class=" d-flex justify-content-center text-success">Left From Warehouse</span>
                                    </div>
                                    <div class="col-2">
                                        <span class=" d-flex justify-content-center text-success">Handed Over to Delivery Company</span>
                                    </div>
                                    <div class="col-2">
                                        <span class=" d-flex justify-content-center text-success">Out For Delivery</span>
                                    </div>
                                    <div class="col-2">
                                        <span class=" d-flex justify-content-center text-success">Package Deliverd</span>
                                    </div>
                                </div>
                                <div class="row bg-dark p-3 d-flex justify-content-center">
                                    <div class="col-10">
                                        <div class="progress" role="progressbar" aria-label="Animated striped example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                                            <div class="progress-bar bg-success progress-bar-animated" style="width: 100%"></div>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row bg-dark p-3 d-flex justify-content-center">
                                        <span class=" text-center fw-bold fs-3 text-success">Order Complete</span>
                                </div><br>
                            <?php
                            }
                            ?>
                        </div>
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
            <?php include "footer.php"; ?>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </div>
</body>

</html>