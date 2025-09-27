<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In | Admin | Dream Sports</title>

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <link rel="icon" href="resources/dream sports (3).svg">

</head>

<body class="bg-secondary">

    <!-- loder -->
    <div class="loder" id="loder">
        <img src="resources/loading.gif" alt="Loading...">
    </div>
    <!-- loder -->

    <div class="container-fluid vh-100 d-flex justify-content-center">
        <div class="row align-content-center">

            <div class="col-12 d-flex flex-row justify-content-center mb-3">

                <div class="col-10 col-lg-10 text-center bg-white" >
                    <div class="row mt-5 pt-5 pt-lg-0">

                        <div class="col-12 key"></div>
                        <div class="col-12">
                            <div class="row">
                                <h4 class="fw-bold text-uppercase text-white">addmin panel</h4>
                            </div>
                        </div>
                        <div class="col-8 offset-2 mt-5 mb-3">
                            <div class="row">

                                <div class="col-12 text-start">
                                    <div class="row">
                                        <label class="form-label fw-bold text-white-50 text-uppercase">username</label>
                                    </div>
                                </div>
                                <div class="col-12 text-start">
                                    <div class="row">
                                        <div class="col-10 pt-2">
                                            <input type="text" class="line mb-3 pb-6" placeholder="EX : admin@gmail.com" id="e" />
                                            <p id="msg"></p>
                                        </div>
                                        <div class="col-2 text-end  pb-4">
                                            <i class="bi bi-person-fill fs-3 text-white-50"></i>
                                        </div>
                                    </div>
                                </div>
                                <!-- verify code -->
                                <div class="col-12">
                                    <div class="row" id="verificationModal">


                                        <div class="col-12 mt-3 mb-5">
                                            <div class="row">
                                                <div class="col-6 d-grid">
                                                    <button class="btn btn-outline-info fw-bold" onclick="adminVerification();">SEND VERIFICATION CODE</button>
                                                </div>
                                                <div class="col-6 d-grid ">
                                                    <button class="btn btn-outline-danger fw-bold" onclick="window.location = 'index.php';">BACK TO CUSTOMER LOGIN</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- verify code -->

                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- modal -->
            <!-- <div class="modal" tabindex="-1" id="verificationModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Admin Verification</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label">Enter your Verification Code</label>
                            <input type="text" class="form-control" id="vcode">
                            <p id="msgv"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" onclick="verify();">Verify</button>
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- modal -->

            <div class="col-12 fixed-bottom text-center text-dark">
                <p>&copy; 2022 DreamSports.lk | All Rights Reserved</p>
                <p class="fw-bold">Dream Sports &trade;</p>
            </div>


            
        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>