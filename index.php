<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPC</title>
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
                            <div class="col-lg-6 col-md-6 col-12 d-none d-md-flex p-5 border border-end rounded-start-5 justify-content-center align-items-center">
                                <img src="resources/second hand.png" class="col-10" alt="secondhand">
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 p-5">
                                <div class="row">
                                    <span class=" mb-3 fw-bold fs-3 text-center tec1">Welcome!</span>
                                    <span class=" text-center fw-bold fs-5">Sign In</span>
                                </div><br>
                                <div class="row">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                        <label for="floatingInput">Email</label>
                                    </div>

                                    <div class="form-floating">
                                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                                        <label for="floatingPassword">Password</label>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <input type="checkbox" id="check">
                                        <span>Remember me?</span>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-12">
                                        <a href="#" class="text-decoration-none text-dark d-flex justify-content-sm-end justify-content-md-center justify-content-lg-end" data-bs-toggle="modal" data-bs-target="#forgotmodel">Forgot Password?</a>
                                    </div>
                                </div><br>
                                <div class="row d-flex justify-content-center align-items-center">
                                    <button class="btn rounded-0 mybtn text-white col-lg-6 col-md-6 col-8" onclick="signin();">Sign in</button>
                                </div><br>
                                <span>Don't Have an account?</span>
                                <div class="row d-flex justify-content-center align-items-center">
                                    <button class="btn btnbg2 rounded-0 text-white col-lg-6 col-md-6 col-8" onclick="window.location='register.php'">Register</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- model -->
        <div class="modal" tabindex="-1" id="forgotmodel">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Forgot Password?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <span>If you forgot your password enter your email here and we will send a verification code to reset the password.</span>
                        </div><br>
                        <div class="row">
                            <span>Email</span>
                            <input type="email" class="form-control" id="passemail">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn rounded-0 mybtn" onclick="verification();">Get Code</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- model -->
        <!-- model2 -->
        <div class="modal" tabindex="-1" id="resetPassModal">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Reset Password</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                        <div class="col-6">
                                <span>Email</span>
                                <input type="email" class="form-control" id="em">
                            </div>
                            <div class="col-6">
                                <span>Verification Code</span>
                                <input type="text" class="form-control" id="veri">
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="col-6">
                                <span>Password</span>
                                <input type="password" class="form-control" id="pass1">
                            </div>
                            <div class="col-6">
                                <span>Confirm Password</span>
                                <input type="password" class="form-control" id="pass2">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn rounded-0 mybtn" onclick="resetPass();">Reset</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- model2 -->
        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </div>
</body>

</html>