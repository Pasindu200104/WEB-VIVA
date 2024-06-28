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
            <div class="col-12">
                <div class="row mt-5 d-flex justify-content-center">
                    <?php
                    if (isset($_SESSION["u"])) {
                        $u_data = $_SESSION["u"];

                        if ($u_data["status_id"] == 1) {
                    ?>
                            <div class="col-lg-10 col-md-10 col-12 mt-5">

                                <span class=" text-white fs-3 fw-bold">LISTED ITEMS</span>
                                <div class="row bgcol1 p-3">
                                    <?php
                                    $tot = Database::search("SELECT * FROM `product` WHERE `user_id`='" . $u_data["id"] . "'");
                                    $tot_num = $tot->num_rows;
                                    if ($tot_num > 0) {

                                        $totalPrice = 0;
                                        while ($tot_data = $tot->fetch_assoc()) {
                                            $totalPrice += $tot_data["price"];
                                        }
                                    ?>
                                        <div class="col-lg-3 col-md-3 col-6 bg-body p-3 border-end">
                                            <div class="row text-center">
                                                <span>Total Listed Items</span>
                                                <span class="text-success fw-bold"> <?php echo $tot_num; ?></span>
                                            </div>

                                        </div>
                                        <div class="col-lg-3 col-md-3 col-6 bg-body p-3 border-end d-flex justify-content-center">
                                            <div class="row text-center">
                                                <span>Total Listed Item Price</span>
                                                <span class="text-success fw-bold"> Rs.<?php echo $totalPrice; ?>/=</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-6 bg-body p-3 border-end d-flex justify-content-center">
                                            <div class="row text-center">
                                                <?php
                                                $product_rs = Database::search("SELECT * FROM `product` WHERE `user_id`='" . $u_data["id"] . "'");
                                                $product_num = $product_rs->num_rows;

                                                $total_invo_num = 0;
                                                $total_price = 0;
                                                for ($g = 0; $g < $product_num; $g++) {
                                                    $product_data = $product_rs->fetch_assoc();
                                                    $invo_rs = Database::search("SELECT * FROM `invoice` WHERE `product_id`='" . $product_data["id"] . "'");
                                                    $invo_num = $invo_rs->num_rows;
                                                    $total_invo_num += $invo_num;

                                                    while ($invo_data = $invo_rs->fetch_assoc()) {
                                                        $total_price += $invo_data["price"];
                                                    }
                                                }

                                                ?>
                                                <span>Total Sales</span>
                                                <span class="text-success fw-bold"><?php echo $total_invo_num; ?></span>
                                            </div>

                                        </div>
                                        <div class="col-lg-3 col-md-3 col-6 bg-body p-3 d-flex justify-content-center">
                                            <div class="row text-center">
                                                <span>Total Income</span>
                                                <span class="text-success fw-bold fs-5">Rs.<?php echo $total_price; ?>.00/=</span>
                                            </div>

                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="col-lg-3 col-md-3 col-6 d-flex justify-content-center">
                                            <span>Total Items : </span>
                                            <span class=" text-success">0</span>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-6 d-flex justify-content-center">
                                            <span>Total Listed Item Price : </span>
                                            <span class="text-success"> RS.0.00/=</span>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-6 d-flex justify-content-center">
                                            <span>Total Sales : </span>
                                            <span class="text-success">0</span>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-6 d-flex justify-content-center">
                                            <span>Total Income : </span>
                                            <span class="text-success">Rs.0.00/=</span>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                </div>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 d-none d-lg-block d-md-block bgcol1">
                                        <?php
                                        $result = Database::search("SELECT * FROM `category`");
                                        $categories = [];
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $categories[] = $row;
                                            }
                                        } else {
                                            echo "0 results";
                                        }

                                        foreach ($categories as $category) {
                                        ?>
                                            <div class="row  p-2">
                                                <a class="bg-dark p-3 text-decoration-none text-white" style="cursor: pointer;" onclick="categorySearch2(<?php echo $category['id']; ?>);"><?php echo $category["name"]; ?></a>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-12 bg-dark">
                                        <div class="row">
                                            <span class=" text-white fs-5 fw-bold">POSTWALL</span>
                                        </div><br>
                                        <div class="row" id="categorysearch2">
                                            <?php

                                            $productsPerPage = 12;

                                            if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                                                $currentPage = (int) $_GET['page'];
                                            } else {
                                                $currentPage = 1;
                                            }


                                            $offset = ($currentPage - 1) * $productsPerPage;


                                            $totalProductsResult = Database::search("SELECT COUNT(*) AS `total` FROM `product`");
                                            $totalProducts = $totalProductsResult->fetch_assoc()['total'];
                                            $totalPages = ceil($totalProducts / $productsPerPage);

                                            $pro_rs = Database::search("SELECT * FROM `product` WHERE `user_id`='" . $u_data["id"] . "' LIMIT $offset, $productsPerPage");
                                            $pro_num = $pro_rs->num_rows;

                                            if ($pro_num > 0) {
                                                for ($p = 0; $p < $pro_num; $p++) {
                                                    $pro_data = $pro_rs->fetch_assoc();

                                                    if ($pro_data["status_id"] == 1) {
                                                        if ($pro_data["quantity"] >= 1) {
                                            ?>
                                                            <div class="col-lg-3 col-md-3 col-6 mb-3">
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
                                                                                <a href="<?php echo "updateMyItems.php?id=" . ($pro_data["id"]); ?>" class="btn rounded-0 btn-outline-info fw-bolder col-12">Update</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <div class="col-3 mb-3">
                                                                <div class="card">
                                                                    <div class="row">
                                                                        <div class="col-12 ">
                                                                            <span class="fw-bold fs-5 text-danger d-flex justify-content-center align-items-center rounded bg-opacity-75 position-absolute bg-black" style="width: 100%;height: 100%;">SOLD OUT</span>
                                                                        </div>
                                                                    </div>
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
                                                                                <a href="<?php echo "updateMyItems.php?id=" . ($pro_data["id"]); ?>" class="btn rounded-0 btn-outline-info fw-bolder col-12">Update</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <div class="col-3 mb-3">
                                                            <div class="card">
                                                                <div class="row">
                                                                    <div class="col-12 ">
                                                                        <span class="fw-bold fs-5 text-danger d-flex text-center align-items-center rounded bg-opacity-75 position-absolute bg-black" style="width: 100%;height: 100%;">Your product has been blocked by Admin due to a violation of our rules</span>
                                                                    </div>
                                                                </div>
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
                                                                            <a href="<?php echo "updateMyItems.php?id=" . ($pro_data["id"]); ?>" class="btn rounded-0 btn-outline-info fw-bolder col-12">Update</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                            <?php
                                                    }
                                                }
                                            }
                                            ?>
                                            <div class="col-12 mt-3 d-flex justify-content-center">

                                                <nav aria-label="Page navigation example">
                                                    <ul class="pagination">
                                                        <?php if ($currentPage > 1) : ?>
                                                            <li class="page-item">
                                                                <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>">Previous</a>
                                                            </li>
                                                        <?php else : ?>
                                                            <li class="page-item disabled">
                                                                <a class="page-link" href="#">Previous</a>
                                                            </li>
                                                        <?php endif; ?>

                                                        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                                            <li class="page-item <?php if ($i == $currentPage) echo 'active'; ?>">
                                                                <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                                            </li>
                                                        <?php endfor; ?>

                                                        <?php if ($currentPage < $totalPages) : ?>
                                                            <li class="page-item">
                                                                <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>">Next</a>
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


                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="row vh-100 vw-100 d-flex align-items-center">
                                <span class=" text-center fs-1 fw-bold text-danger">Your Seller Account Has Been banded.</span>
                            </div>
                        <?php
                        }
                        ?>
                    <?php
                    } else {
                    ?> <div class="col-12 vh-100 vw-100 d-flex justify-content-center align-items-center">
                            <span class=" text-danger fw-bold fs-1">Accsess Denided</span>
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