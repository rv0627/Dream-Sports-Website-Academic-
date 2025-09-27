<?php

require "connection.php";

?>

<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dream Sports</title>

    <link rel="icon" href="resources/dream sports (3).svg" />

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body class="main-body">

    <!-- loder -->
    <div class="loder" id="loder">
        <img src="resources/loading.gif" alt="Loading...">
    </div>
    <!-- loder -->

    <div class="container-fluid vh-100 d-flex justify-content-center">
        <div class="row align-content-center mt-0 mt-lg-5">

            <div class="col-12">
                <div class="row d-flex justify-content-end">
                    <div class="col-5 col-md-3 col-lg-2 d-grid">
                        <a href="adminSignIn.php" class="btn btn-danger mt-5 mb-3">Go to Admin login &rarr;</a>
                    </div>
                </div>
            </div>

            <!-- header -->
            <div class="col-12">
                <div class="row">
                    <div class="col-12 logo d-none d-lg-block"></div>
                    <div class="col-12">
                        <h1 class="text-center title1">DREAM SPORTS</h1>
                        <p class="text-center title2 d-none d-lg-block">The best choice for success your sports dreams.</p>
                    </div>
                </div>
            </div>
            <!-- header -->

            <!-- content -->
            <div class="col-12 p-3 mb-4">
                <div class="row">

                    <div class="col-6 d-none d-lg-block background"></div>
                    <div class="col-12 col-lg-6 " id="signUpBox">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class="title3">Create New Account</p>
                            </div>

                            <div class="col-12 d-none" id="errordiv">
                                <div class="alert alert-danger " role="alert" id="erroralertdiv">
                                    <i class="bi bi-info-circle-fill fs-6" id="error"></i>
                                </div>
                            </div>


                            <div class="col-6">
                                <label class="form-label">First Name</label>
                                <input type="text" class="form-control" id="f" />
                            </div>

                            <div class="col-6">
                                <label class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="l" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="e" />
                            </div>
                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" id="p" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Mobile</label>
                                <input type="text" class="form-control" id="m" />
                            </div>
                            <div class="col-6">
                                <label class="form-label">Gender</label>
                                <select class="form-select" id="g">

                                    <?php

                                    $rs = Database::search("SELECT * FROM `gender`");
                                    $n = $rs->num_rows;

                                    for ($x = 0; $x < $n; $x++) {
                                        $d = $rs->fetch_assoc();

                                    ?>

                                        <option value="<?php echo ($d["id"]); ?>"><?php echo ($d["gender_name"]); ?></option>

                                    <?php

                                    }

                                    ?>


                                </select>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button type="button" class="btn btn-primary" onclick="signUpProcess();">Sign Up</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button type="button" class="btn btn-secondary" onclick="changeView();">Already have an account? Sign In</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6 d-none" id="signInBox">
                        <div class="row g-2">
                            <div class="col-12">
                                <p class="title3">Sign In</p>
                                <span class="text-success" id="msg3"></span>
                            </div>

                            <?php

                            $email = "";
                            $password = "";

                            if (isset($_COOKIE["email"])) {
                                $email = $_COOKIE["email"];
                            }

                            if (isset($_COOKIE["password"])) {
                                $password = $_COOKIE["password"];
                            }

                            ?>


                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" id="email2" value="<?php echo ($email); ?>" />
                                <span class="text-danger" id="msg1"></span>
                            </div>
                            <div class="col-12">
                                <label class="form-label">password</label>
                                <input type="password" class="form-control" id="password2" value="<?php echo ($password); ?>" />
                                <span class="text-danger" id="msg2"></span>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="rememberme" />
                                    <label class="form-check-label">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-6 text-end">
                                <a href="#" class="link-primary" onclick="forgotPasswordModal();">Forgot Password</a>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-primary" onclick="signInProcess();">Sign In</button>
                            </div>
                            <div class="col-12 col-lg-6 d-grid">
                                <button class="btn btn-danger" onclick="changeView();">New to eShop? Join Now</button>
                            </div>
                        </div>



                    </div>

                </div>
            </div>
            <!-- content -->


            <!-- modal -->
            <div class="modal" tabindex="-1" id="forgotPasswordModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Reset Password</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="row g-3">
                            <div class="col-12">
                                <span class="text-success form-control" id="verificationCodeSend"></span>

                            </div>
                        </div>

                        <div class="modal-body">

                            <div class="row g-3">

                                <div class="col-6">
                                    <label class="form-label">New Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="newPassword" />
                                        <button class="btn btn-outline-secondary" type="button" onclick="showPassword();"><i id="eye1" class="bi bi-eye-slash-fill"></i></button>
                                    </div>
                                    <span class="text-danger" id="npMsg"></span>

                                </div>

                                <div class="col-6">
                                    <label class="form-label">Re-Type Password</label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" id="reTypePassword" />
                                        <button class="btn btn-outline-secondary" type="button" onclick="reTypePasswordShow();"><i id="eye2" class="bi bi-eye-slash-fill"></i></button>
                                    </div>
                                    <span class="text-danger" id="rtpMsg"></span>

                                </div>

                                <div class="col-12">
                                    <label class="form-label">Verification Code</label>
                                    <input type="text" class="form-control" id="vCode" />
                                </div>
                                <span class="text-danger" id="vCodeMsg"></span>

                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="resetPassword();">Reset Password</button>
                        </div>
                    </div>
                </div>



            </div>
            <!-- modal -->

            <!-- footer -->

            <div class="col-12 pt-5 d-none d-lg-block">
                <div class="col-12 fixed-bottom ">
                    <p class="text-center">&copy; 2022 Dream Sports.lk || All Right Reserved</p>
                </div>
            </div>

            <!-- footer -->

        </div>
    </div>


    <script src="script.js"></script>
    <script src="bootstrap.js"></script>
</body>

</html>