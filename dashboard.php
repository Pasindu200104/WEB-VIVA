<div class="col-12 bg-dark p-3">

    <span class="fw-bold">DASHBOARD</span>
    <div class="row mt-3">
        <?php
        require "connection.php";

        $user_rs = Database::search("SELECT * FROM `user`");
        $user_num = $user_rs->num_rows;

        $usercount_rs = Database::search("SELECT COUNT(*) as usercount FROM `user` WHERE DATE(`date`) = CURDATE()");
        $dailyusers = $usercount_rs->fetch_assoc()['usercount'];

        $product_rs = Database::search("SELECT * FROM `product`");
        $product_num = $product_rs->num_rows;

        $procount_rs = Database::search("SELECT COUNT(*) as procount FROM `product` WHERE DATE(`date`) = CURDATE()");
        $dailylistingproduct = $procount_rs->fetch_assoc()['procount'];

        $invoice_rs = Database::search("SELECT * FROM `invoice`");
        $invoice_num = $invoice_rs->num_rows;

        $invocount_rs = Database::search("SELECT COUNT(*) as invocount FROM `invoice` WHERE DATE(`date`) = CURDATE()");
        $dailysaled = $invocount_rs->fetch_assoc()['invocount'];
        ?>
        <div class="col-lg-4 col-md-4 col-12 p-3">
            <div class="row d-flex justify-content-center">
                <div class="col-10 p-3 bg-danger">

                    <div class="row ">
                        <Span class=" text-center">Total Users</Span>
                        <span class=" text-center"><?php echo $user_num; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 p-3">
            <div class="row d-flex justify-content-center">
                <div class="col-10 p-3 bg-success">
                    <div class="row ">
                        <Span class=" text-center">Total Products</Span>
                        <span class=" text-center"><?php echo $product_num; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 p-3 ">
            <div class="row d-flex justify-content-center">
                <div class="col-10 p-3 bg-primary">
                    <div class="row ">
                        <Span class=" text-center">Total Sales</Span>
                        <span class=" text-center"><?php echo $invoice_num; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 p-3 ">
            <div class="row d-flex justify-content-center">
                <div class="col-10 p-3 bg-danger">
                    <div class="row ">
                        <Span class=" text-center">Daily Engaging Users</Span>
                        <span class=" text-center"><?php echo $dailyusers; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 p-3 ">
            <div class="row d-flex justify-content-center">
                <div class="col-10 p-3 bg-success">
                    <div class="row ">
                        <Span class=" text-center">Daily Listing Products</Span>
                        <span class=" text-center"><?php echo $dailylistingproduct; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 p-3 ">
            <div class="row d-flex justify-content-center">
                <div class="col-10 p-3 bg-primary">
                    <div class="row ">
                        <Span class=" text-center">Daily Sales</Span>
                        <span class=" text-center"><?php echo $dailysaled; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <div class="row">
<!-- <button onclick="backup();">Backup</button> -->
    </div>
</div>