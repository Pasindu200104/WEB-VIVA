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
                    if (isset($_SESSION["u"])) {
                        $user_data = $_SESSION["u"];

                        if ($user_data["status_id"] == 1) {
                    ?>
                            <div class="col-lg-10 col-md-10 col-12 text-white">
                                <span class=" text-white fs-3 fw-bold">MY SELLING</span>
                                <div class="row bg-dark p-3">
                                    <div class="col-12 bg-body mb-4">
                                        <div class="row">
                                            <div class="col-lg-3 col-md-3 col-12 p-3 border-end d-flex justify-content-center">
                                                <span class="fw-bold text-black">Image</span>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-6 p-3 border-end d-flex justify-content-center">
                                                <span class="fw-bold text-black">Order Details</span>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-6 p-3 border-end d-flex justify-content-center">
                                                <span class="fw-bold text-black">Buyer Details</span>
                                            </div>
                                            <div class="col-lg-3 col-md-3 col-12 p-3 d-flex justify-content-center">
                                                <span class="fw-bold text-black ">Change Delivery Status</span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `user_id`='" . $user_data["id"] . "'");
                                    $product_num = $product_rs->num_rows;

                                    for ($x = 0; $x < $product_num; $x++) {
                                        $product_data = $product_rs->fetch_assoc();

                                        $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `product_id`='" . $product_data["id"] . "'");
                                        $invoice_num = $invoice_rs->num_rows;

                                        for ($y = 0; $y < $invoice_num; $y++) {
                                            $invoice_data = $invoice_rs->fetch_assoc();

                                            $buyer_rs = Database::search("SELECT * FROM `user` WHERE `id`='" . $invoice_data["user_id"] . "'");
                                            $buyer_data = $buyer_rs->fetch_assoc();

                                            $address_rs = Database::search("SELECT * FROM `address` WHERE `user_id`='" . $buyer_data["id"] . "'");
                                            $address_data = $address_rs->fetch_assoc();

                                            $city_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $address_data["city_id"] . "'");
                                            $city_data = $city_rs->fetch_assoc();

                                            $pro_img = Database::search("SELECT * FROM `pro_img` WHERE `product_id`='" . $invoice_data["product_id"] . "'");
                                            $pro_data = $pro_img->fetch_assoc();
                                    ?>
                                            <div class="col-12">

                                                <div class="row border-bottom border-top">
                                                    <div class="col-lg-3 col-md-3 col-12 p-3 border-end d-flex justify-content-center align-items-center">
                                                        <img src="<?php echo $pro_data["path"]; ?>" class="col-12" style="width: 200px;height: 200px;" alt="SPC_img">
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-12 p-3 border-end">
                                                        <span>Order ID :</span>
                                                        <span id="order"><?php echo $invoice_data["order_id"]; ?></span><br><br>
                                                        <span>Title :</span>
                                                        <span><?php echo $product_data["name"]; ?></span><br>
                                                        <span>Price :</span>
                                                        <span><?php echo $product_data["price"]; ?></span><br>
                                                        <span>Quantity :</span>
                                                        <span><?php echo $invoice_data["qty"]; ?></span><br>
                                                        <span>Delivery fee :</span>
                                                        <span><?php echo $product_data["delivery_price"]; ?></span><br><br>
                                                        <span class="fw-bold">Total Paid :</span>
                                                        <span class="fw-bold text-success">Rs.<?php echo $invoice_data["price"]; ?>.00/=</span><br>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-12 p-3 border-end">
                                                        <span>Buyer :</span>
                                                        <span><?php echo $buyer_data["fname"] . " " . $buyer_data["lname"]; ?></span><br><br>
                                                        <span>Mobile :</span>
                                                        <span><?php echo $buyer_data["mobile"]; ?></span><br>
                                                        <span>Address :</span>
                                                        <span><?php echo $address_data["line1"] . " " . $address_data["line2"]; ?></span><br>
                                                        <span>Nearest City :</span>
                                                        <span><?php echo $city_data["name"]; ?></span><br><br>
                                                        <span>Zip Code :</span>
                                                        <span><?php echo $address_data["zipcode"]; ?></span><br>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-12 p-3">
                                                        <span>Delivery Status</span>
                                                        <select class="form-select" id="deliState<?php echo $x; ?>">
                                                            <?php
                                                            $track_rs = Database::search("SELECT * FROM `track`");
                                                            $track_num = $track_rs->num_rows;
                                                            for ($z = 0; $z < $track_num; $z++) {
                                                                $track_data = $track_rs->fetch_assoc();
                                                            ?>
                                                                <option value="<?php echo $track_data["id"]; ?>"><?php echo $track_data["status"]; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select><br>
                                                        <div class="row p-3">
                                                            <button class="btn mybtn rounded-0" onclick="deliveryStatus('<?php echo $invoice_data['order_id']; ?>','<?php echo $x; ?>');">Update</button>
                                                        </div>
                                                    </div>
                                                </div><br>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>


                            </div>
                        <?php
                        } else {
                        ?>

                            <div class="row vh-100 vw-100 d-flex align-items-center">
                                <span class=" text-center fs-1 fw-bold text-danger">Your Seller Account Has Been Banded.</span>
                            </div>
                        <?php

                        }
                        ?>

                    <?php
                    } else {
                    ?>
                        <div class="row vh-100 vw-100 d-flex align-items-center">
                            <span class=" text-center fs-1 fw-bold text-danger">Access Denid</span>
                        </div>
                    <?php
                    }
                    ?>
                </div><br>
            </div>
            <?php include "footer.php"; ?>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </div>
</body>

</html>