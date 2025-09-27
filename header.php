<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="bootstrap.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

</head>

<body>
    <div class="col-12 p-2" style="z-index: 110;background-color: #F0F0F0;">
        <div class="row  mb-1">

            <div class="col-5 offset-lg-1 col-lg-8 mt-2">
                <span class="text-lg-start fs-6 text-uppercase">Customer Care</span> &nbsp;&nbsp;&nbsp;&nbsp;
            </div>

            <div class="col-7 col-lg-3">
                <div class="row mt-1 text-center pe-2 pe-lg-4">

                    <div class="col-2 col-lg-2 pt-1">
                        <a href="watchlist.php"><i class="bi bi-heart fs-4 text-danger"></i></a>
                    </div>

                    <div class="col-4 col-lg-4 pt-1">
                        <a href="cart.php" ><i class="bi bi-cart4 text-black fs-4"></i><span class="badge bg-danger" id="cartNum"></span></a>
                    </div>

                    <div class="col-3 col-lg-3 mt-2 ">
                        <span class="text-start" onclick="window.location = 'addProduct.php'" style="cursor: pointer;">Sell</span>
                    </div>

                    <div class="col-3 col-lg-3 dropdown shadow-none">
                        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person fs-6 dropdown"></i>
                        </button>

                        <ul class="dropdown-menu text-center dropdown-content" style="width: 210px;">
                            <?php
                            session_start();
                            if (isset($_SESSION["userData"])) {
                                $data = $_SESSION["userData"];
                            ?>
                                <i class="bi bi-person-circle fs-4 mt-3 text-danger"></i>
                                <span class="text-center fw-bold" style="color: grey;">Welcome to back,<br /><span class="fs-5"><?php echo ($data["first_name"]." ".$data["last_name"]); ?></span></span>
                                <!-- <span class="text-center fw-bold lbl1 ms-4"></span> &nbsp; &nbsp; --> <br /> 
                                <span class="text-center fw-bold text-primary" onclick="signout();" style="cursor: pointer;">Sign Out</span>
                            <?php
                            } else {
                            ?>
                                <p class="text-center fw-bold" style="color: grey;">Welcome to Dream Sports!</p>
                                <a href="index.php"><button class="btn btn-danger fw-bold ms-4">Register</button></a>
                                <a href="index.php"><button class="btn btn-primary fw-bold">Sign In</button></a>


                            <?php
                            }
                            ?>


                            <hr />

                            <li><a class="dropdown-item text-start" href="home.php">My eShop</a></li>
                            <li><a class="dropdown-item text-start" href="userProfile.php">My Profile</a></li>
                            <li><a class="dropdown-item text-start" href="#">My Sellings</a></li>
                            <li><a class="dropdown-item text-start" href="cart.php">My Cart</a></li>
                            <li><a class="dropdown-item text-start" href="myProduct.php">My Products</a></li>
                            <li><a class="dropdown-item text-start" href="watchlist.php">Wishlist</a></li>
                            <li><a class="dropdown-item text-start" href="purchasingHistory.php">Purchase History</a></li>
                            <li><a class="dropdown-item text-start" href="#">Contact Admin</a></li>
                            <li><a class="dropdown-item text-start" href="messageModel.php">Message</a></li>
                        </ul>
                    </div>





                </div>
            </div>

        </div>
    </div>

    
    <script src="script.js"></script>
</body>

</html>