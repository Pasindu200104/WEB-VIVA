<?php

require "connection.php";

$searchText = $_POST["searchText"];
$category = $_POST["category"];
$city = $_POST["city"];
$condition = $_POST["condition"];
$fromPrice = $_POST["fromPrice"];
$toPrice = $_POST["toPrice"];
$searchText = $_POST["searchText"];

$query = "SELECT * FROM `product`";
$status = 0;

if (!empty($searchText)) {
    $query .= " WHERE `name` LIKE '%" . $searchText . "%'";
    $status = 1;
}

if ($category != 0 && $status == 0) {
    $query .= " WHERE `category_id`='" . $category . "'";
    $status = 1;
} else if ($category != 0 && $status != 0) {
    $query .= " AND `category_id`='" . $category . "'";
}

$cid = 0;
if ($city != 0) {
    $city_rs = Database::search("SELECT * FROM `city` WHERE `id`='" . $city . "'");
    $city_num = $city_rs->num_rows;
    for ($x = 0; $x < $city_num; $x++) {
        $city_data = $city_rs->fetch_assoc();
        $cid = $city_data["id"];
    }

    if ($status == 0) {
        $query .= "WHERE `city_id`= '" . $cid . "'";
        $status = 1;
    } else if ($status != 0) {
        $query .= "AND `city_id`='" . $cid . "'";
    }
}


if ($condition != 0 && $status == 0) {
    $query .= "WHERE `condition_id`='" . $condition . "'";
    $status = 1;
} else if ($condition != 0 && $status != 0) {
    $query .= "AND `condition_id`='" . $condition . "'";
}


if (!empty($fromPrice) && empty($toPrice)) {
    if ($status == 0) {
        $query .= "WHERE `price` >= '" . $fromPrice . "'";
        $status = 1;
    } else if ($status != 0) {
        $query .= "AND `price` >= '" . $fromPrice . "'";
    }
} else if (empty($fromPrice) && !empty($toPrice)) {
    if ($status == 0) {
        $query .= "WHERE `price` <= '" . $toPrice . "'";
        $status = 1;
    } else if ($status != 0) {
        $query .= "AND `price` <= '" . $toPrice . "'";
    }
} else if (!empty($fromPrice) && !empty($toPrice)) {
    if ($status == 0) {
        $query .= "WHERE `price` BETWEEN '" . $fromPrice . "' AND '" . $toPrice . "'";
        $status = 1;
    } else if ($status != 0) {
        $query .= "AND `price` BETWEEN '" . $fromPrice . "' AND '" . $toPrice . "'";
    }
}


$productsPerPage = 12;

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = (int) $_GET['page'];
} else {
    $currentPage = 1;
}


$offset = ($currentPage - 1) * $productsPerPage;


$totalProductsResult = Database::search($query);
$totalProducts = $totalProductsResult->fetch_assoc()['total'];
$totalPages = ceil($totalProducts / $productsPerPage);

$pro_rs = Database::search($query);
$pro_num = $pro_rs->num_rows;

for ($p = 0; $p < $pro_num; $p++) {
    $pro_data = $pro_rs->fetch_assoc();
    $condition_rs = Database::search("SELECT * FROM `condition` WHERE `id`='" . $pro_data["condition_id"] . "'");
    $condition_data = $condition_rs->fetch_assoc();
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