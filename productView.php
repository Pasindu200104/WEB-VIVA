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
                        $pid = $_GET["id"];
                        $prod_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
                        $prod_data = $prod_rs->fetch_assoc();
                    }
                    ?>
                    <div class="col-lg-10 col-md-10 col-12">
                        <span class=" text-white fs-3 fw-bold">PRODUCT VIEW</span>
                        <div class="row">
                            <div class="col-lg-7 col-md-7 col-12 bg-transparent">
                                <?php
                                $img = array();

                                $pro_img2 = Database::search("SELECT * FROM `pro_img` WHERE `product_id`='" . $prod_data["id"] . "'");
                                $img_num2 = $pro_img2->num_rows;
                                if ($img_num2 > 0) {
                                    for ($x = 0; $x < $img_num2; $x++) {
                                        $img_data2 = $pro_img2->fetch_assoc();

                                        $img[$x] = $img_data2["path"];
                                    }
                                ?>

                                    <div class="row d-flex justify-content-center align-items-center p-3">
                                        <div class="col-lg-6 col-md-12 col-12 bgcol1 border border-2 shadow-lg imghov d-flex justify-content-center align-items-center p-3 rounded-circle" style="width: 150px;height: 150px;">
                                            <img src="<?php echo $img[0]; ?>" class="col-12" alt="spc_view" onclick="loadImg('<?php echo $img[0]; ?>');">
                                        </div>
                                    </div>
                                    <div class="row p-3">
                                        <div class="col-lg-3 col-md-12 col-12   d-flex justify-content-center align-items-center">
                                            <div class="col-6 bgcol1 border border-2 shadow-lg imghov d-flex justify-content-center align-items-center p-3 rounded-circle" style="width: 150px;height: 150px;">
                                                <img src="<?php echo $img[1]; ?>" class="col-12" alt="spc_view" onclick="loadImg('<?php echo $img[1]; ?>');">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-12 d-flex justify-content-center align-items-center">
                                            <div class="col-6 bgcol1 border border-2 shadow-lg imghov d-flex justify-content-center align-items-center p-3 rounded-circle" style="width: 250px;height: 250px;">
                                                <img src="<?php echo $img[0]; ?>" class="col-12" alt="spc_view" id="mainImg">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-12 col-12  d-flex justify-content-center align-items-center">
                                            <div class="col-6 bgcol1 border border-2 shadow-lg imghov d-flex justify-content-center align-items-center p-3 rounded-circle" style="width: 150px;height: 150px;">
                                                <img src="<?php echo $img[2]; ?>" class="col-12" alt="spc_view" onclick="loadImg('<?php echo $img[2]; ?>');">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row d-flex justify-content-center align-items-center p-3">
                                        <div class="col-6 bgcol1 border border-2 shadow-lg imghov d-flex justify-content-center align-items-center p-3 rounded-circle" style="width: 150px;height: 150px;">
                                            <img src="<?php echo $img[3]; ?>" class="col-12" alt="spc_view" onclick="loadImg('<?php echo $img[3]; ?>');">
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-lg-5 col-md-5 col-12 bg-dark text-white p-3">
                                <span class=" fs-3 fw-bold"><?php echo $prod_data["name"]; ?></span><br>
                                <?php
                                $user_rs = Database::search("SELECT * FROM `user` WHERE `id`='" . $prod_data["user_id"] . "'");
                                $user_data = $user_rs->fetch_assoc();
                                ?>
                                <span class=" fw-light">Seller <b><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></b></span><br><br>
                                <span class=" fw-bold fs-5">Price </span><br>
                                <span class=" fs-5 fw-lighter fw-bold text-success">Rs. <b class=" fs-3"><?php echo $prod_data["price"]; ?></b>/= </span><br><br>
                                <span class=" fw-bold fs-5">Delivery fee </span><br>
                                <span class=" fs-5 fw-lighter fw-bold text-success">Rs. <b class=" fs-3"><?php echo $prod_data["delivery_price"]; ?></b>/= </span><br><br>
                                <span class=" fw-bold fs-5">Quantity</span><br>
                                <!-- <input type="text" class="border-0 text-center fs-5 fw-bold text-start" style="outline: none;" pattern="[0-9]" value="1" onkeyup='check_value(<?php echo $prod_data["qty"]; ?>);' id="qty_input" /> -->
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-12">
                                        <div class="row">
                                            <i class="ri-subtract-line sub col-2 bg-black" style="cursor: pointer;" onclick="qty_dec();">-</i>
                                            <input type="text" id="qty_input" value="0" min="1" max="<?php echo $prod_data["quantity"]; ?>" class="border-0 text-center fs-5 fw-bold text-start col-8" style="outline: none;" readonly>
                                            <i class="ri-add-line add col-2 bg-black" style="cursor: pointer;" onclick="qty_inc('<?php echo $prod_data['quantity']; ?>');">+</i>
                                        </div>

                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <span>(Stock : <?php echo $prod_data["quantity"]; ?>)</span>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" id="price" value="<?php echo $prod_data["price"]; ?>">
                                <input type="hidden" id="qty" value="<?php echo $prod_data["quantity"]; ?>">
                                <br><br>
                                <script>
                                    const pricePerItem = <?php echo $prod_data['price']; ?>;
                                    const deliveryPrice = <?php echo $prod_data['delivery_price']; ?>;

                                    function updateTotalPrice(quantity) {
                                        const subTotal = pricePerItem * quantity;
                                        const total = subTotal + deliveryPrice;
                                        document.getElementById('total_price').innerText = 'Rs.' + total + '/=';
                                    }

                                    function qty_dec() {
                                        let qtyInput = document.getElementById('qty_input');
                                        let quantity = parseInt(qtyInput.value);
                                        if (quantity > 1) {
                                            quantity--;
                                            qtyInput.value = quantity;
                                            updateTotalPrice(quantity);
                                        }
                                    }

                                    function qty_inc(maxQuantity) {
                                        let qtyInput = document.getElementById('qty_input');
                                        let quantity = parseInt(qtyInput.value);
                                        if (quantity < maxQuantity) {
                                            quantity++;
                                            qtyInput.value = quantity;
                                            updateTotalPrice(quantity);
                                        }
                                    }
                                </script>
                                <span class=" fw-bold fs-5">Total</span><br>
                                <span id="total_price" class=" fs-3 fw-lighter d-flex justify-content-center fw-bold text-danger"></span><br><br>
                                <span class=" fw-bold fs-5">Warrenty </span><br>
                                <?php
                                $war_rs = Database::search("SELECT * FROM `warenty` WHERE `id`='" . $prod_data["warenty_id"] . "'");
                                $war_data = $war_rs->fetch_assoc();
                                ?>
                                <span class=" fs-5 fw-lighter"><?php echo $war_data["name"]; ?> </span><br><br>
                                <div class="row  d-flex justify-content-center align-items-center">
                                    <div class="col-7">
                                        <div class="row">

                                            <div class="col-3 d-flex justify-content-center align-items-center">
                                                <img src="resources/visa_img.png" class="col-12" alt="spc_payments">
                                            </div>
                                            <div class="col-3 d-flex justify-content-center align-items-center">
                                                <img src="resources/mastercard_img.png" class="col-12" alt="spc_payments">
                                            </div>
                                            <div class="col-3 d-flex justify-content-center align-items-center">
                                                <img src="resources/american_express_img.png" class="col-12" alt="spc_payments">
                                            </div>
                                            <div class="col-3 d-flex justify-content-center align-items-center">
                                                <img src="resources/paypal_img.png" class="col-12" alt="spc_payments">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row mt-3 d-flex justify-content-center">
                                    <a class="btn btnbg1 rounded-0 fw-bold text-white col-lg-6 col-md-8 col-8" type="submit" id="payhere-payment" onclick="payNow('<?php echo $pid; ?>');">Pay</a>
                                </div><br>

                            </div>

                        </div><br>
                        <div class="row bg-dark text-white p-3">
                            <div class="col-12">
                                <span class=" fw-bold fs-5">Specifications </span><br>
                                <span class=" fs-5 fw-lighter"><?php echo $prod_data["specifications"]; ?> </span><br><br>
                                <span class=" fw-bold fs-5">Reason to sell </span><br>
                                <span class=" fs-5 fw-lighter"><?php echo $prod_data["reason"]; ?> </span><br><br>
                            </div>
                        </div><br>
                        <div class="row bg-dark text-white p-3">
                            <span class=" fw-bold text-center"><b class=" text-danger">*</b> If you want to know further more details about the item you can contact seller via this Number :</span><br>
                            <span class=" fw-bold fs-5 text-center"><i class="bi bi-telephone"></i> <?php echo $user_data["mobile"]; ?></span><br>
                            <div class="row  d-flex justify-content-center mt-3">
                            <a href="https://wa.me/<?php echo $user_data["mobile"]; ?>" class="col-lg-2 col-md-3 col-6 btn btn-outline-light">CHAT</a>
                            </div>
                        </div><br>
                        <div class="row bg-dark text-white p-3">
                            <span class="p-3 fw-bold fs-5">Similler Products :</span>
                            <div class="row" id="categorysearch">
                                <?php

                                $productsPerPage = 4;

                                if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                                    $currentPage = (int) $_GET['page'];
                                } else {
                                    $currentPage = 1;
                                }


                                $offset = ($currentPage - 1) * $productsPerPage;


                                $totalProductsResult = Database::search("SELECT COUNT(*) AS `total` FROM `product`");
                                $totalProducts = $totalProductsResult->fetch_assoc()['total'];
                                $totalPages = ceil($totalProducts / $productsPerPage);

                                $pro_rs = Database::search("SELECT * FROM `product` WHERE `category_id`='" . $prod_data["category_id"] . "' LIMIT $offset, $productsPerPage");
                                $pro_num = $pro_rs->num_rows;

                                for ($p = 0; $p < $pro_num; $p++) {
                                    $pro_data = $pro_rs->fetch_assoc();
                                ?>
                                    <div class="col-lg-3 col-md-3 col-6 mb-3 ">
                                        <div class="card">

                                            <div class="row p-3 d-flex justify-content-center align-items-center">
                                                <?php
                                                $img_rs = Database::search("SELECT * FROM `pro_img` WHERE `product_id`='" . $pro_data["id"] . "'");
                                                $img_data = $img_rs->fetch_assoc();
                                                ?>
                                                <img src="<?php echo $img_data["path"]; ?>" class="card-img-top bg-dark-subtle col-12 " style="width: 180px;height: 180px;" alt="spc_cardImage">

                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title text-center"><?php echo $pro_data["name"]; ?></h5>
                                                <p class="card-text text-center">Price : <?php echo $pro_data["price"]; ?></p>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <a href="<?php echo "productView.php?id=" . ($pro_data["id"]); ?>" class="btn rounded-0 mybtn fw-bolder col-12">Buy Now</a>
                                                    </div>
                                                    <div class="col-12 mt-3">
                                                        <button class="btn rounded-0 btn-dark col-12"><i class="bi bi-cart4"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                                <div class="col-12 mt-3 d-flex justify-content-center">

                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <?php if ($currentPage > 1) : ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="<?php echo "productView.php?id=" . ($pro_data["id"]); ?>?page=<?php echo $currentPage - 1; ?>">Previous</a>
                                                </li>
                                            <?php else : ?>
                                                <li class="page-item disabled">
                                                    <a class="page-link" href="#">Previous</a>
                                                </li>
                                            <?php endif; ?>

                                            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                                <li class="page-item <?php if ($i == $currentPage) echo 'active'; ?>">
                                                    <a class="page-link" href="<?php echo "productView.php?id=" . ($pro_data["id"]); ?>?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                                </li>
                                            <?php endfor; ?>

                                            <?php if ($currentPage < $totalPages) : ?>
                                                <li class="page-item">
                                                    <a class="page-link" href="<?php echo "productView.php?id=" . ($pro_data["id"]); ?>?page=<?php echo $currentPage + 1; ?>">Next</a>
                                                </li>
                                            <?php else : ?>
                                                <li class="page-item disabled">
                                                    <a class="page-link" href="#">Next</a>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </nav>
                                </div>

                            </div><br>
                        </div><br>
                        <div class="row bg-dark p-3 text-white">
                            <span class=" fw-bold">Note:</span><br><br>
                            <span>Payments you made through our service are valid and we are responsible for those payments.</span><br>
                            <span>If you make payments outside the system and didn't get your items we wan't take any responsibility for your loss.</span><br><br>
                            <span class=" fw-bold text-danger">Important:</span><br>
                            <span class="text-danger">Make sure you are buying the correct product and make sure to confirm the product details by contacting the seller.
                                Becasue payments made through this site can't be refundable.
                            </span>
                        </div><br>

                    </div>
                </div><br>
            </div>
            <?php include "footer.php"; ?>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
        <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
    </div>
</body>

</html>