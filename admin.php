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
                    <div class="col-lg-8 col-md-8 col-12 bg-white rounded-5 shadow-lg">
                        <div class="row">
                            <div class="col-6 d-none d-lg-block d-md-block p-5 border border-end rounded-start-5 d-flex justify-content-center align-items-center">
                                <img src="resources/second hand.png" class="col-10" alt="secondhand">
                            </div>
                            <div class="col-lg-6 col-md-6 col-12 p-5">
                                <div class="row">
                                    <span class=" mb-3 fw-bold fs-3 text-center tec1">Welcome!</span>
                                    <span class=" text-center fw-bold fs-5">Admin Sign In</span>
                                </div><br>
                                <div class="row">
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                                        <label for="floatingInput">Email</label>
                                    </div>
                                </div><br>

                                <div class="row d-flex justify-content-center align-items-center">
                                    <button class="btn rounded-0 mybtn text-white col-6" onclick="adminsignin();">Verification Code</button>
                                </div><br>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- model -->
                <div class="modal" tabindex="-1" id="verify">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Verification</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <span>Verification Code</span>
                                    <input type="text" class="form-control" id="vericode">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn rounded-0 mybtn" onclick="adminverification();">Verify</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- model -->
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