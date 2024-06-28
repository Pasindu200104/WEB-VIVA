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
                <div class="row mt-5">
                    <span class="A fs-1 text-center" style="color:#ff33ff;">SECONDHAND <span class=" text-danger">PC</span></span>
                    <span class="A fs-3 text-white text-center">WELCOME</span>
                    <div class="col-12 d-flex justify-content-center">
                        <span class=" fs-6 text-white text-light text-center col-lg-8 col-10">This is a place where you can find secondhand parts / reusable parts
                            to your computer. Most prople look for reusable parts for low cost because brand new parts are more expensive.
                            So this site will find you what you want easily. But remember all the parts you see here are not brand new.
                        </span>
                    </div>

                </div>
                <div class="row mt-5 mb-5">
                    <div class="col-lg-4 col-md-4 col-12 d-none d-lg-block mt-5">
                        <div class="row ">
                            <img src="resources/PC/pngwing.com(81).png" class="border homeImg border-3 border-black shadow-lg col-12 bgcol1 rounded-circle" style="width: 100px;height: 100px;" alt="Ram">
                        </div><br>
                        <div class="row ">
                            <img src="resources/PC/pngwing.com(87).png" class="border homeImg2 border-3 border-black shadow-lg col-12 bgcol1 rounded-circle" style="width: 100px;height: 100px;" alt="Hard">
                        </div><br>
                        <div class="row ">
                            <img src="resources/PC/pngwing.com(88).png" class="border homeImg3 border-3 border-black shadow-lg col-12 bgcol1 rounded-circle" style="width: 100px;height: 100px;" alt="VGA">
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12 d-none d-lg-block mt-5">
                        <div id="carouselExampleSlidesOnly" class="carousel slide  d-flex justify-content-center" data-bs-ride="carousel">
                            <div class="carousel-inner rounded-circle border border-3 border-black shadow-lg bgcol1" style="width: 350px;height: 350px;">
                                <div class="carousel-item active">
                                    <img src="resources/PC/pngwing.com(82).png" class="d-block col-12" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="resources/PC/pngwing.com(89).png" class="d-block col-12" alt="...">
                                </div>
                                <div class="carousel-item">
                                    <img src="resources/PC/pngwing.com(92).png" class="d-block col-12" alt="...">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-12 d-none d-lg-block mt-5">
                        <div class="row d-flex justify-content-start">
                            <img src="resources/PC/pngwing.com(83).png" class="border homeImg4 border-3 border-black shadow-lg col-12 bgcol1 rounded-circle" style="width: 100px;height: 100px;" alt="Keyboard">
                        </div><br>
                        <div class="row d-flex justify-content-center">
                            <img src="resources/PC/pngwing.com(84).png" class="border homeImg6 border-3 border-black shadow-lg col-12 bgcol1 rounded-circle" style="width: 100px;height: 100px;" alt="Mouse">
                        </div><br>
                        <div class="row d-flex justify-content-start">
                            <img src="resources/PC/pngwing.com(86).png" class="border homeImg5 border-3 border-black shadow-lg col-12 bgcol1 rounded-circle" style="width: 100px;height: 100px;" alt="Monitor">
                        </div>
                    </div>

                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-10 col-md-10 col-12">
                        <div class="row mt-3 mb-3 ">
                            <div class="col-lg-2 col-md-4 col-6 ">
                                <div class="row p-2">
                                    <select class="form-select rounded-5" id="category">
                                        <option value="0">Select Category</option>
                                        <?php
                                        $category_rs = Database::search("SELECT * FROM `category`");
                                        $category_num = $category_rs->num_rows;

                                        for ($r = 0; $r < $category_num; $r++) {
                                            $category_data = $category_rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-6 ">
                                <div class="row p-2">
                                    <select class="form-select rounded-5" id="city">
                                        <option value="0">Select Nearest City</option>
                                        <?php
                                        $city_rs = Database::search("SELECT * FROM `city`");
                                        $city_num = $city_rs->num_rows;

                                        for ($q = 0; $q < $city_num; $q++) {
                                            $city_data = $city_rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $city_data["id"]; ?>"><?php echo $city_data["name"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-4 col-6">
                                <div class="row p-2">
                                    <select class="form-select rounded-5" id="condition">
                                        <option value="0">Select Condition</option>
                                        <?php
                                        $condition_rs = Database::search("SELECT * FROM `condition`");
                                        $condition_num = $condition_rs->num_rows;

                                        for ($c = 0; $c < $condition_num; $c++) {
                                            $condition_data = $condition_rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $condition_data["id"]; ?>"><?php echo $condition_data["name"]; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-12 ">
                                <div class="row p-2">
                                    <div class="col-6">
                                        <input type="text" class="form-control rounded-5" placeholder="From Price" id="fromPrice">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" class="form-control rounded-5" placeholder="To Price" id="toPrice">
                                    </div>
                                </div>
                            </div>

                            <div class="row d-flex justify-content-center">
                                <div class="col-lg-5 col-md-5 col-12">
                                    <div class="row p-2">
                                        <div class="col-9">
                                            <input type="text" class="form-control border border-0 bg-body rounded-5" placeholder="Search Product" id="searchText">
                                        </div>
                                        <div class="col-3">
                                            <button class="btn btn-primary rounded-5 col-12" onclick="search();"><i class="bi bi-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                        <a class="bg-dark p-3 text-decoration-none text-white" style="cursor: pointer;" onclick="categorySearch(<?php echo $category['id']; ?>);"><?php echo $category["name"]; ?></a>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="col-lg-10 col-md-10 col-12 bg-dark">
                                <div class="row">
                                    <span class=" text-white fs-5 fw-bold">POSTWALL</span>
                                </div><br>
                                <div class="row" id="categorysearch">
                                    <?php

                                    $productsPerPage = 2;

                                    if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                                        $currentPage = (int) $_GET['page'];
                                    } else {
                                        $currentPage = 1;
                                    }


                                    $offset = ($currentPage - 1) * $productsPerPage;


                                    $totalProductsResult = Database::search("SELECT COUNT(*) AS `total` FROM `product`");
                                    $totalProducts = $totalProductsResult->fetch_assoc()['total'];
                                    $totalPages = ceil($totalProducts / $productsPerPage);

                                    $pro_rs = Database::search("SELECT * FROM `product` LIMIT $offset, $productsPerPage");
                                    $pro_num = $pro_rs->num_rows;

                                    for ($p = 0; $p < $pro_num; $p++) {
                                        $pro_data = $pro_rs->fetch_assoc();
                                        $condition_rs = Database::search("SELECT * FROM `condition` WHERE `id`='" . $pro_data["condition_id"] . "'");
                                        $condition_data = $condition_rs->fetch_assoc();

                                        if ($pro_data["quantity"] >= 1) {
                                            if ($pro_data["status_id"] == 1) {
                                    ?>
                                                <div class="col-lg-3 col-md-4 col-6 mb-3">
                                                    <div class="card">

                                                        <div class="row p-3 d-flex justify-content-center align-items-center">
                                                            <?php
                                                            $img_rs = Database::search("SELECT * FROM `pro_img` WHERE `product_id`='" . $pro_data["id"] . "'");
                                                            $img_data = $img_rs->fetch_assoc();
                                                            ?>
                                                            <img src="<?php echo $img_data["path"]; ?>" class="card-img-top bg-dark-subtle col-12 " style="width: 180px;height: 180px;" alt="spc_cardImage">

                                                        </div>
                                                        <div class="card-body">
                                                            <p class="card-text text-center fw-light">(<?php echo $condition_data["name"]; ?>)</p>
                                                            <h5 class="card-title text-center"><?php echo $pro_data["name"]; ?></h5>
                                                            <p class="card-text text-center">Price : <?php echo $pro_data["price"]; ?></p>
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <a href="<?php echo "productView.php?id=" . ($pro_data["id"]); ?>" class="btn rounded-0 mybtn fw-bolder col-12">Buy Now</a>
                                                                </div>
                                                                <div class="col-12 mt-3">
                                                                    <button class="btn rounded-0 btn-dark col-12" onclick="addtoCart(<?php echo $pro_data['id']; ?>);"><i class="bi bi-cart4"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>

                                        <?php
                                        }
                                        ?>

                                    <?php
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
                </div><br>
            </div>
            <?php include "footer.php"; ?>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </div>
</body>

</html>