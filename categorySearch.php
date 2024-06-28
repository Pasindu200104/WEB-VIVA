<?php
session_start();
require "connection.php";

$user = $_SESSION["u"];
$user_id = $user["id"];

$cid = $_GET["id"];

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

$pro_rs = Database::search("SELECT * FROM `product` WHERE `category_id` = '" . $cid . "' LIMIT $offset, $productsPerPage");
$pro_num = $pro_rs->num_rows;

while ($pro_data = $pro_rs->fetch_assoc()) {
?>
    <div class="col-3 mb-3">
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
                        <button class="btn rounded-0 bgcol1 text-white fw-bolder col-12">Buy Now</button>
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


</div><br>
<div class="col-12 d-flex justify-content-center">

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