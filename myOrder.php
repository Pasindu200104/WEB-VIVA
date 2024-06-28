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
                    <?php
                    if (isset($_SESSION["u"])) {
                        $user = $_SESSION["u"];
                    ?>
                        <div class="col-lg-10 col-md-10 col-12 text-white">
                            <span class=" text-white fs-3 fw-bold">MY ORDERS</span>
                            <div class="row d-flex justify-content-center bg-dark">
                                <div class="col-lg-8 col-md-8 col-12 p-3" id="pending">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" aria-current="page" onclick="pending();">PENDING</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link text-white" onclick="finished();">FINISHED</a>
                                        </li>
                                    </ul><br>
                                    <?php
                                    $ship_rs = Database::search("SELECT * FROM `ship` WHERE `user_id`='" . $user["id"] . "'");
                                    $ship_num = $ship_rs->num_rows;

                                    $pending_status = false;

                                    for ($x = 0; $x < $ship_num; $x++) {
                                        $ship_data = $ship_rs->fetch_assoc();

                                        $invo_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $ship_data["order_id"] . "'");
                                        $invo_data = $invo_rs->fetch_assoc();

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invo_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();

                                        $seller_rs = Database::search("SELECT * FROM `user` WHERE `id`='" . $product_data["user_id"] . "'");
                                        $seller_data = $seller_rs->fetch_assoc();

                                        if ($ship_data["track_id"] != 5) {
                                            $pending_status = true;
                                    ?>
                                            <div class="row  border-bottom border-top">
                                                <div class="col-lg-4 col-md-4 col-12 border-end d-flex justify-content-center align-items-center p-3">
                                                    <?php
                                                    $pro_img = Database::search("SELECT * FROM `pro_img` WHERE `product_id`='" . $product_data["id"] . "'");
                                                    $pro_data = $pro_img->fetch_assoc();
                                                    ?>
                                                    <img src="<?php echo $pro_data["path"]; ?>" class="col-12" alt="SPC_img" style="width: 150px;height: 150px;">
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-12 border-end text-light p-3">
                                                    <span class=" text-danger fw-bold fs-5">Order Pending</span><br><br>
                                                    <span>Invoice ID :</span>
                                                    <span><?php echo $ship_data["order_id"]; ?></span><br>
                                                    <span>Seller :</span>
                                                    <span><?php echo $seller_data["fname"] . " " . $seller_data["lname"]; ?></span><br><br>
                                                    <span>Title :</span>
                                                    <span><?php echo $product_data["name"]; ?></span><br>
                                                    <span>Price :</span>
                                                    <span>Rs.<?php echo $product_data["price"]; ?>.00/=</span><br>
                                                    <span>Delivery fee :</span>
                                                    <span>Rs.<?php echo $product_data["delivery_price"]; ?>.00/=</span><br>
                                                    <span>Quantity :</span>
                                                    <span><?php echo $invo_data["qty"]; ?></span><br><br>
                                                    <span class=" fw-bold">Total Paid :</span>
                                                    <span class=" fw-bold">Rs.<?php echo $invo_data["price"]; ?>.00/=</span><br>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-12 d-flex justify-content-center align-items-center">
                                                    <div class="row p-3">
                                                        <button class="btn mybtn rounded-0 mb-2" onclick="confirm('<?php echo $ship_data['order_id']; ?>');">Confirm Recive</button>
                                                        <a href="<?php echo "track.php?id=" . ($ship_data["order_id"]); ?>" class="btn mybtn rounded-0 mt-2">Track Item</a>
                                                    </div>
                                                </div>
                                            </div><br>
                                        <?php
                                        }
                                    }
                                    if (!$pending_status) {
                                        ?>
                                        <div class="row mt-5 mb-5">
                                            <span class=" text-warning fw-bold fs-2 text-center">Nothing to Show...</span>
                                        </div><br>
                                        <div class="row d-flex justify-content-center">
                                            <img src="resources/pngwing.com(112).png" style="width: 150px;height: 150px;" alt="spc_empty">
                                        </div><br>
                                    <?php
                                    }
                                    ?>

                                </div>
                                <div class="col-lg-8 col-md-8 col-12 p-3 d-none" id="finished">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link text-white" onclick="pending();">PENDING</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" aria-current="page" onclick="finished();">FINISHED</a>
                                        </li>
                                    </ul><br>
                                    <?php
                                    $ship_rs = Database::search("SELECT * FROM `ship` WHERE `user_id`='" . $user["id"] . "'");
                                    $ship_num = $ship_rs->num_rows;

                                    $finished_status = false;

                                    for ($x = 0; $x < $ship_num; $x++) {
                                        $ship_data = $ship_rs->fetch_assoc();

                                        $invo_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id`='" . $ship_data["order_id"] . "'");
                                        $invo_data = $invo_rs->fetch_assoc();

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $invo_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();

                                        $seller_rs = Database::search("SELECT * FROM `user` WHERE `id`='" . $product_data["user_id"] . "'");
                                        $seller_data = $seller_rs->fetch_assoc();

                                        if ($ship_data["track_id"] == 5) {
                                            $finished_status = true;
                                    ?>
                                            <div class="row  border-bottom border-top">
                                                <div class="col-lg-4 col-md-4 col-12 border-end d-flex justify-content-center align-items-center p-3">
                                                    <?php
                                                    $pro_img = Database::search("SELECT * FROM `pro_img` WHERE `product_id`='" . $product_data["id"] . "'");
                                                    $pro_data = $pro_img->fetch_assoc();
                                                    ?>
                                                    <img src="<?php echo $pro_data["path"]; ?>" class="col-12" alt="SPC_img" style="width: 150px;height: 150px;">
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-12 border-end text-light p-3">
                                                    <span class=" text-success fw-bold fs-5">Order Complete</span><br><br>
                                                    <span>Invoice ID :</span>
                                                    <span><?php echo $ship_data["order_id"]; ?></span><br>
                                                    <span>Seller :</span>
                                                    <span><?php echo $seller_data["fname"] . " " . $seller_data["lname"]; ?></span><br><br>
                                                    <span>Title :</span>
                                                    <span><?php echo $product_data["name"]; ?></span><br>
                                                    <span>Price :</span>
                                                    <span>Rs.<?php echo $product_data["price"]; ?>.00/=</span><br>
                                                    <span>Delivery fee :</span>
                                                    <span>Rs.<?php echo $product_data["delivery_price"]; ?>.00/=</span><br>
                                                    <span>Quantity :</span>
                                                    <span><?php echo $invo_data["qty"]; ?></span><br><br>
                                                    <span class=" fw-bold">Total Paid :</span>
                                                    <span class=" fw-bold">Rs.<?php echo $invo_data["price"]; ?>.00/=</span><br>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-12 d-flex justify-content-center align-items-center">
                                                    <div class="row p-3">
                                                        <div class="col-12">
                                                            <div class="row">
                                                                <span class="fw-bold fs-5">Feedback</span>
                                                            </div><br>
                                                            <div class="row">
                                                                <span>Rate Seller:</span>
                                                                <div class="col-12">
                                                                    <span class="star" data-value="1"><i class="bi bi-star-fill"></i></span>
                                                                    <span class="star" data-value="2"><i class="bi bi-star-fill"></i></span>
                                                                    <span class="star" data-value="3"><i class="bi bi-star-fill"></i></span>
                                                                    <span class="star" data-value="4"><i class="bi bi-star-fill"></i></span>
                                                                    <span class="star" data-value="5"><i class="bi bi-star-fill"></i></span>
                                                                </div>
                                                            </div><br>
                                                            <input type="hidden" name="rating" id="rating<?php $x; ?>">
                                                            <div class="row">
                                                                <span>Description</span>
                                                                <textarea id="desc" cols="30" rows="3" class="col-12"></textarea>
                                                            </div>
                                                            <div class="row">
                                                                <button class="btn mybtn rounded-0 mt-2" onclick="submit();">Submit</button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div><br>
                                        <?php
                                        }
                                    }
                                    if (!$finished_status) {
                                        ?>
                                        <div class="row mt-5 mb-5">
                                            <span class=" text-warning fw-bold fs-2 text-center">Nothing to Show...</span>
                                        </div><br>
                                        <div class="row d-flex justify-content-center">
                                            <img src="resources/pngwing.com(112).png" style="width: 150px;height: 150px;" alt="spc_empty">
                                        </div><br>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div><br>
                            <div class="row p-3 bg-dark">
                                <span><b class=" text-danger">*</b> If you recive the item make sure to confirm recive. Or after transaction time period, if you didn't comfirm item within 10 days we count it as comfirm.</span>
                            </div><br>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="row vh-100 vw-100 d-flex align-items-center">
                            <span class=" text-center fs-1 fw-bold text-danger">Access Denid</span>
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