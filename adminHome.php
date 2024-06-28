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
        <div class="row bgH vh-100">
            <?php
            require "connection.php";
            session_start();
            if (isset($_SESSION["a"])) {
                $admin_data = $_SESSION["a"];

            ?>
                <div class="col-12">
                    <div class="row p-3 bg-dark text-white">
                        <div class="col-lg-4 col-md-4 col-12 d-flex justify-content-start">
                            <span class="A ms-3" style="color:#ff33ff;">SECONDHAND <span class=" text-danger">PC</span></span>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12 d-flex justify-content-center align-items-center">
                            <span><b>ADMIN PANEL</b></span>
                        </div>
                        <div class="col-4 d-none d-md-flex justify-content-end align-items-center ">
                            <span><i class="bi bi-chat-left-text fs-5"></i></span>
                        </div>
                    </div>
                    <div class="row p-3">
                        <div class="col-lg-3 col-md-3 col-12">
                            <div class="row d-flex justify-content-center">
                                <div class="col-10 shadow-lg bg-dark">
                                    <div class="row p-3">
                                        <a href="#" class="btn btn-outline-light rounded-0 col-12" onclick="loadDashboardContent('dashboard')"><i class="bi bi-speedometer"></i> Dashboard</a><br>
                                    </div>
                                    <div class="row p-3">
                                        <a href="#" class="btn btn-outline-light rounded-0 col-12" onclick="loadDashboardContent('userM')"><i class="bi bi-people"></i> User Management</a><br>
                                    </div>
                                    <div class="row p-3">
                                        <a href="#" class="btn btn-outline-light rounded-0 col-12" onclick="loadDashboardContent('proM')"><i class="bi bi-laptop"></i> Product Management</a><br>
                                    </div>
                                    <div class="row p-3">
                                        <a href="#" class="btn btn-outline-light rounded-0 col-12" onclick="loadDashboardContent('adminP')"><i class="bi bi-person-gear"></i> Update Profile</a><br>
                                    </div><br><br>
                                    <div class="row p-3 border-top">
                                        <a href="#" class="btn btn-outline-light rounded-0 col-12" onclick="logout();"><i class="bi bi-box-arrow-left"></i> Log Out</a><br>
                                    </div>
                                </div>
                            </div><br>
                            <div class="row d-flex justify-content-center ">
                                <div class="col-10 shadow-lg bg-dark p-3">
                                    <div class="row p-3 d-flex justify-content-center align-items-center">
                                        <?php
                                        $img_rs = Database::search("SELECT * FROM `admin_img` WHERE `admin_email`='" . $admin_data["email"] . "'");
                                        $img_num = $img_rs->num_rows;

                                        if ($img_num > 0) {
                                            $img_data = $img_rs->fetch_assoc();
                                        ?>
                                            <img src="<?php echo $img_data["path"]; ?>" class="col-12 rounded-circle bg-body" style="width: 150px;height: 150px;" alt="SPC_ADMIN">
                                        <?php
                                        } else {
                                        ?>
                                            <img src="resources/1564534_customer_man_user_account_profile_icon(1).png" class="col-12 rounded-circle bg-body" style="width: 150px;height: 150px;" alt="SPC_ADMIN">
                                        <?php
                                        }
                                        ?>

                                    </div>
                                    <div class="row text-white">
                                        <span class=" fw-bold fs-3 text-center">ADMIN</span>
                                        <span class="text-center"><?php echo $admin_data["fname"] . " " . $admin_data["lname"]; ?></span>
                                        <span class="text-center"><?php echo $admin_data["email"]; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-9 col-12">
                            <div class="row shadow-lg text-white" id="dashboard-content">

                            </div>
                        </div>
                    </div>
                </div>
                <span class=" fixed-bottom text-center text-secondary p-3">Powerd by Minisoft Solutions &copy; 2024</span>
            <?php
            } else {
            ?>
                <div class="row vh-100 vw-100 d-flex justify-content-center align-items-center">
                    <span class=" fs-1 fw-bold text-danger">Access Denid.</span>
                </div>
            <?php
            }
            ?>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </div>
</body>

</html>