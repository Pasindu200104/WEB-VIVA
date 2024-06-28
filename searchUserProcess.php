<?php
require "connection.php";

$text = $_POST["text"];

$userPerPage = 5;

if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $currentPage = (int) $_GET['page'];
} else {
    $currentPage = 1;
}


$offset = ($currentPage - 1) * $userPerPage;


$totaluserResult = Database::search("SELECT COUNT(*) AS `total` FROM `user`");
$totaluser = $totaluserResult->fetch_assoc()['total'];
$totalPages = ceil($totaluser / $userPerPage);

$user_rs = Database::search("SELECT * FROM `user` WHERE `email` LIKE '%" . $text . "%' LIMIT $offset, $userPerPage");
$user_num = $user_rs->num_rows;

for ($p = 0; $p < $user_num; $p++) {
    $user_data = $user_rs->fetch_assoc();
?>
    <div class="col-12">
        <div class="row">
            <div class="col-2 border-end p-3 d-flex justify-content-center">
                <span class="fw-bold"><?php echo $user_data["id"]; ?></span>
            </div>
            <div class="col-2 border-end p-3 d-flex justify-content-center">
                <span class="fw-bold"><?php echo $user_data["fname"]; ?></span>
            </div>
            <div class="col-2 border-end p-3 d-flex justify-content-center">
                <span class="fw-bold"><?php echo $user_data["lname"]; ?></span>
            </div>
            <div class="col-2 border-end p-3 d-flex justify-content-center ">
                <span class="fw-bold overflow-scroll"><?php echo $user_data["email"]; ?></span>
            </div>
            <div class="col-2 p-3  border-end d-flex justify-content-center">
                <span class="fw-bold"><?php echo $user_data["mobile"]; ?></span>
            </div>
            <div class="col-2 p-3 d-flex justify-content-center">
                <?php

                if ($user_data["status_id"] == 1) {
                ?>
                    <button id="ub<?php echo $user_data["id"]; ?>" class="btn btn-danger rounded-0 col-12" onclick="blockUser('<?php echo $user_data['id']; ?>');">Block</button>
                <?php
                } else {
                ?>
                    <button id="ub<?php echo $user_data["id"]; ?>" class="btn btn-success rounded-0 col-12" onclick="blockUser('<?php echo $user_data['id']; ?>');">Unblock</button>
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