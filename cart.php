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
            <?php include "header.php";
            if (isset($_SESSION["u"])) {
                $user_rs = Database::search("SELECT * FROM `user` WHERE `id`='" . $_SESSION["u"]["id"] . "'");
                $user_num = $user_rs->num_rows;
                if ($user_num > 0) {
            ?>
                    <div class="col-12 mt-5">
                        <div class="row mt-5 d-flex justify-content-center">
                            <div class="col-lg-10 col-md-10 col-12">
                                <span class=" text-white fs-3 fw-bold">CART ITEMS</span>

                                <div class="row p-3 bg-dark text-white">
                                    <div class="col-8">
                                        <?php
                                        $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_id`='" . $_SESSION["u"]["id"] . "'");
                                        $cart_num = $cart_rs->num_rows;

                                        for ($x = 0; $x < $cart_num; $x++) {
                                            $cart_data = $cart_rs->fetch_assoc();

                                            $proc_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
                                            $proc_data = $proc_rs->fetch_assoc();

                                            $imgc_rs = Database::search("SELECT * FROM `pro_img` WHERE `product_id`='" . $cart_data["product_id"] . "'");
                                            $imgc_data = $imgc_rs->fetch_assoc();
                                        ?>
                                            <div class="row border-bottom border-top">
                                                <div class="col-1 p-3 d-flex justify-content-center align-items-center">
                                                    <input type="checkbox" class="item-checkbox" data-price="<?php echo $proc_data["price"]; ?>" data-delivery="<?php echo $proc_data["delivery_price"]; ?>">
                                                </div>
                                                <div class="col-8">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-md-4 col-12 p-3 border-start border-end d-flex justify-content-center align-items-center">
                                                            <img src="<?php echo $imgc_data["path"]; ?>" class="col-12" alt="spc_img" style="height: 150px;width: 150px;">
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-12 p-3">
                                                            <span>Title :</span>
                                                            <span><?php echo $proc_data["name"]; ?></span><br>
                                                            <span>price :</span>
                                                            <span><?php echo $proc_data["price"]; ?></span><br>
                                                            <span>Delivery fee :</span>
                                                            <span><?php echo $proc_data["delivery_price"]; ?></span><br>
                                                            <span>Quantity :</span>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                        <i class="ri-subtract-line sub col-2 bg-black" style="cursor: pointer;" onclick="qty_dec('<?php echo $proc_data['id']; ?>');">-</i>
                                                                        <input type="text" id="qty_input<?php echo $proc_data['id']; ?>" value="0" min="1" max="<?php echo $proc_data["quantity"]; ?>" class="border-0 text-center fs-5 fw-bold text-start col-8" style="outline: none;" readonly>
                                                                        <i class="ri-add-line add col-2 bg-black" style="cursor: pointer;" onclick="qty_inc('<?php echo $proc_data['quantity']; ?>','<?php echo $proc_data['id']; ?>');">+</i>
                                                                    </div>

                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="row">
                                                                        <span>(Stock : <?php echo $proc_data["quantity"]; ?>)</span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <input type="hidden" id="price<?php echo $proc_data['id']; ?>" value="<?php echo $proc_data["price"]; ?>">
                                                            <input type="hidden" id="delivery_price<?php echo $proc_data['id']; ?>" value="<?php echo $proc_data['delivery_price']; ?>">
                                                            <br><br>
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-12 d-flex justify-content-center align-items-center">
                                                    <button class="btn col-lg-12 col-md-12 col-8 btn-danger rounded-0" onclick="cartRemove(<?php echo $proc_data['id']; ?>);">Remove</button>
                                                </div>
                                            </div><br>
                                        <?php
                                        }
                                        ?>

                                    </div>

                                    <div class="col-4 p-3 d-flex justify-content-center">
                                        <div class="row position-fixed">
                                            <div class="col-12 p-3 bg-dark-subtle text-black">
                                                <span>Sub Total </span><br>
                                                <span class="d-flex justify-content-center fw-bold fs-4 text-success" id="sub-total">Rs.0.00/=</span>
                                                <span>Total Delivery fee </span><br>
                                                <span class="d-flex justify-content-center fw-bold fs-4 text-success" id="delivery-total">Rs.0.00/=</span>
                                                <span>Total </span><br>
                                                <span class="d-flex justify-content-center fw-bold fs-3 text-danger" id="grand-total">Rs.0.00/=</span><br>
                                                <div class="row mt-3 d-flex justify-content-center">
                                                    <button class="btn rounded-0 mybtn fw-bold text-white col-lg-6 col-md-6 col-12" onclick="checkout('<?php echo $proc_data['id']; ?>');">Checkout</button>
                                                </div><br>
                                                <div class="row  d-flex justify-content-center align-items-center">
                                                    <div class="col-lg-10 col-md-10 col-12">
                                                        <div class="row">

                                                            <div class="col-lg-3 col-md-3 col-6 d-flex justify-content-center align-items-center">
                                                                <img src="resources/visa_img.png" class="col-12" alt="spc_payments">
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-6 d-flex justify-content-center align-items-center">
                                                                <img src="resources/mastercard_img.png" class="col-12" alt="spc_payments">
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-6 d-flex justify-content-center align-items-center">
                                                                <img src="resources/american_express_img.png" class="col-12" alt="spc_payments">
                                                            </div>
                                                            <div class="col-lg-3 col-md-3 col-6 d-flex justify-content-center align-items-center">
                                                                <img src="resources/paypal_img.png" class="col-12" alt="spc_payments">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><br>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } else {
                ?>

                <div class="row mt-5 mb-5 vh-100 vw-100 d-flex justify-content-center align-items-center">
                    <span class=" text-warning fw-bold fs-2 text-center">Invalid User</span>
                </div><br>
            <?php

            }
            ?>


            <?php include "footer.php"; ?>


        </div>
        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
</body>

</html>