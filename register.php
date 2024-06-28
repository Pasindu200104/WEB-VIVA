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
        <div class="row">
            <div class="col-12 vh-100 vw-100 bg">
                <div class="row vh-100 vw-100 d-flex justify-content-center align-items-center">
                    <div class="col-lg-8 col-md-8 col-10 bg-white rounded-5 shadow-lg">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 d-none d-md-flex  p-5 border border-end rounded-start-5 justify-content-center align-items-center">
                                <img src="resources/second hand.png" class="col-10" alt="secondhand">
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 p-5">
                                <div class="row">
                                    <span class=" mb-3 fw-bold fs-3 text-center tec1">Welcome!</span>
                                    <span class=" text-center fw-bold fs-5">Register</span>
                                </div><br>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="row mt-1">
                                            <span>First Name</span>
                                            <input type="text" class="form-control" id="fname">
                                        </div>
                                        <div class="row mt-1">
                                            <span>Last Name</span>
                                            <input type="text" class="form-control" id="lname">
                                        </div>
                                        <div class="row mt-1">
                                            <span>Email</span>
                                            <input type="email" class="form-control" id="email">
                                        </div>
                                        <div class="row mt-1">
                                            <span>Password</span>
                                            <input type="password" class="form-control" id="pass">
                                        </div>
                                        <div class="row mt-1">
                                            <span>Mobile No</span>
                                            <input type="text" class="form-control" id="mob">
                                        </div>
                                        <div class="row mt-1">
                                            <span>Gender</span>
                                            <select class="form-select" id="gen">
                                                <option value="0">Select Gender</option>
                                                <?php
                                                require "connection.php";

                                                $gen = Database::search("SELECT * FROM `gender`");
                                                $gen_num = $gen->num_rows;

                                                for ($g = 0; $g < $gen_num; $g++) {
                                                    $gen_data = $gen->fetch_assoc();
                                                ?>
                                                    <option value="<?php echo $gen_data["id"] ?>"><?php echo $gen_data["name"] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>

                                    </div>

                                </div><br>
                                <div class="row d-flex justify-content-center align-items-center">
                                    <button class="btn btnbg2 rounded-0 text-white col-lg-6 col-md-6 col-8" onclick="register();">Register</button>
                                </div>
                                <!-- <div class="row mt-3">
                                    <span class=" text-center">Or Register via:</span>
                                </div> -->
                                <!-- <div class="row mt-2">
                                    <div class="col-6">
                                        <button class="btn btn-outline-primary col-12"><i class="bi bi-google"></i> Google</button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-outline-primary col-12"><i class="bi bi-facebook"></i> Facebook</button>
                                    </div>
                                </div> -->
                                <br>
                                <span>Alredy Have an account?</span>
                                <div class="row d-flex justify-content-center align-items-center">
                                    <button class="btn rounded-0 mybtn text-white col-lg-6 col-md-6 col-8" onclick="window.location='index.php'">Sign in</button>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </div>
</body>

</html>