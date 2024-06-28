<div class="col-12 bg-dark p-3">
    <span class="fw-bold">ADMIN PROFILE</span>
    <?php
    require "connection.php";
    session_start();
    if (isset($_SESSION["a"])) {
        $admin_data = $_SESSION["a"];

        $admin_img = Database::search("SELECT * FROM `admin_img` WHERE `admin_email`='" . $admin_data["email"] . "'");
        $img_num = $admin_img->num_rows;
    ?>
        <div class="row mt-3">
            <div class="col-lg-4 col-md-4 col-12 border-end">
                <div class="row d-flex justify-content-center">
                        <img src="resources/1564534_customer_man_user_account_profile_icon(1).png" class="col-12 rounded-circle bg-body" style="width: 150px;height: 150px;" alt="SPC_ADMIN" id="p0">
                </div><br>
                <div class="row">
                    <span class=" text-center"><?php echo $admin_data["fname"] . " " . $admin_data["lname"]; ?></span>
                    <span class=" text-center"><?php echo $admin_data["email"]; ?></span>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-12">
                <div class="row">
                    <div class="col-6 mt-2">
                        <span>First Name</span>
                        <input type="text" class="form-control" value="<?php echo $admin_data["fname"]; ?>" id="admf">
                    </div>
                    <div class="col-6 mt-2">
                        <span>Last Name</span>
                        <input type="text" class="form-control" value="<?php echo $admin_data["lname"]; ?>" id="adml">
                    </div>
                    <div class="col-6 mt-2">
                        <span>Mobile No</span>
                        <input type="text" class="form-control" value="<?php echo $admin_data["mobile"]; ?>" id="admm">
                    </div>
                    <div class="col-6 mt-2">
                        <span>Upload Profile Image</span>
                        <input type="file" class=" d-none" id="proImg">
                        <label for="proImg" class="btn btn-outline-light col-12" onclick="proImgSelect();">Selec Image</label>
                    </div>
                </div><br>
                <div class="row d-flex justify-content-center">
                    <button class="btn btn-primary rounded-0 col-6" onclick="updateAdmin();">Update</button>
                </div>
            </div>
        </div>
    <?php
    }
    ?>

</div>