<?php
require "connection.php";

$text = $_POST["text"];

$productPerPage = 5;

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = (int) $_GET['page'];
} else {
    $currentPage = 1;
}


$offset = ($currentPage - 1) * $productPerPage;


$totalproductResult = Database::search("SELECT COUNT(*) AS `total` FROM `product`");
$totalproduct = $totalproductResult->fetch_assoc()['total'];
$totalPages = ceil($totalproduct / $productPerPage);

$product_rs = Database::search("SELECT * FROM `product` WHERE `name` LIKE '%" . $text . "%' LIMIT $offset, $productPerPage");
$product_num = $product_rs->num_rows;

for ($p = 0; $p < $product_num; $p++) {
    $product_data = $product_rs->fetch_assoc();
?>
    <div class="col-12">
        <div class="row">
            <div class="col-2 border-end p-3 d-flex justify-content-center">
                <span class="fw-bold"><?php echo $product_data["id"]; ?></span>
            </div>
            <div class="col-2 border-end p-3 d-flex justify-content-center">
                <span class="fw-bold"><?php echo $product_data["name"]; ?></span>
            </div>
            <div class="col-2 border-end p-3 d-flex justify-content-center">
                <span class="fw-bold"><?php echo $product_data["price"]; ?></span>
            </div>
            <div class="col-2 border-end p-3 d-flex justify-content-center ">
                <span class="fw-bold overflow-scroll"><?php echo $product_data["delivery_price"]; ?></span>
            </div>
            <div class="col-2 p-3  border-end d-flex justify-content-center">
                <span class="fw-bold"><?php echo $product_data["quantity"]; ?></span>
            </div>
            <div class="col-2 p-3 d-flex justify-content-center">
                <?php

                if ($product_data["status_id"] == 1) {
                ?>
                    <button id="ub<?php echo $product_data["id"]; ?>" class="btn btn-danger rounded-0 col-12" onclick="blockProduct('<?php echo $product_data['id']; ?>');">Block</button>
                <?php
                } else {
                ?>
                    <button id="ub<?php echo $product_data["id"]; ?>" class="btn btn-success rounded-0 col-12" onclick="blockProduct('<?php echo $product_data['id']; ?>');">Unblock</button>
                <?php

                }

                ?>
            </div>
        </div><br>
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
</div>