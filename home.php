<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" href="resources/dream sports (3).svg" />

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <title>Home | Dream Sports</title>
</head>

<body style="background-color: #E8E8E8;">
    <div class="container-fluid">
        <div class="row">

            <?php include "header.php";
            require "connection.php";
            if (isset($_SESSION["userData"])) {
            ?>

                <hr />

                <div class="col-12 mt-1 mb-1">
                    <div class="row">
                        <nav class="navbar navbar-expand-lg position-fixed bg-secondary" id="navbar" style="z-index: 99;">
                            <div class="container-fluid">
                                <a class="navbar-brand" href="#"><img src="resources/dream sports (3).svg" style="height: 50px;width: 150px;"></a>
                                <button class="navbar-toggler" onclick="dash();" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                                <div class="collapse navbar-collapse offset-lg-1" id="navbarScroll">
                                    <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                                        <li class="nav-item">
                                            <a class="nav-link active  text-white" aria-current="page" href="home.php">Home</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link  text-white" href="#">About us</a>
                                        </li>

                                        <li class="nav-item">
                                            <a class="nav-link text-white" href="#">Contact us</a>
                                        </li>
                                    </ul>
                                    <div class="col-2 p-2">
                                        <button class="btn btn-dark" onclick="window.location = 'advancedSearch.php';">Advanced</button>
                                    </div>
                                    <form class="d-flex" role="search">
                                        <input class="form-control me-1" type="search" placeholder="Search" aria-label="Search">
                                        <div class="dropdown me-1">
                                            <select class="btn btn-dark dropstart dropdown-toggle text-start" style="max-width: 180px;">
                                                <option value="0">All Categories</option>

                                                <?php
                                                $categories_rs = Database::search("SELECT * FROM `categories`");
                                                $categories_num = $categories_rs->num_rows;

                                                for ($x = 0; $x < $categories_num; $x++) {
                                                    $categories_data = $categories_rs->fetch_assoc();

                                                ?>

                                                    <option value="<?php echo ($categories_data["id"]); ?>"><?php echo ($categories_data["categories_name"]); ?></option>

                                                <?php

                                                }

                                                ?>

                                            </select>
                                        </div>
                                        <button class="btn btn-outline-danger  bg-danger me-1" type="button"><i class="bi bi-search text-light"></i></button>

                                    </form>
                                </div>
                            </div>
                        </nav>
                    </div>
                </div>

                <hr />

                <div class="col-12" style="margin: 0px;">
                    <div class="row">

                        <!-- carousel -->

                        <div class="col-12 d-none d-lg-block mb-3" style="margin-top: 140px;">
                            <div class="row">

                                <div id="carouselExampleIndicators" class="col-12 carousel slide carousel-fade" data-bs-ride="true">
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                                    </div>
                                    <div class="carousel-inner">
                                        <div class="carousel-item active">
                                            <img src="resources/sports slide images/sport2.jpg" class="d-block w-100">
                                            <div class="carousel-caption d-none d-md-block poster-caption animation3" style="animation-name: ani;animation-duration: 4s;">
                                                <h5 class="poster-title">Welcome to Dream Sports</h5>
                                                <p class="poster-text">The World's Best Online Store By One Click. <br />
                                                    <button class="button animation4 text-white" style="background-color: #009900;background-image: linear-gradient(100deg,#009900 0%,#00CC00);">Shop now</button>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <img src="resources/sports slide images/maxresdefault.jpg" style="height: 487px;" class="d-block w-100">
                                            <div class="carousel-caption d-none d-md-block animation3" style="animation-name: ani;animation-duration: 4s;">
                                                <h5 class="poster-text-1">STRENGTH FEEL</h5>
                                                <p class="poster-text-2">Choose among the best quality Gym & Fitness supplies.</p>
                                                <button class="button animation4 text-white" style="background-color: #009900;background-image: linear-gradient(100deg,#009900 0%,#00CC00);">Shop now</button>
                                            </div>
                                        </div>
                                        <div class="carousel-item">
                                            <img src="resources/sports slide images/cathy-pham-1268211-unsplash.jpg" style="height: 487px;" class="d-block w-100">
                                            <div class="carousel-caption d-none d-md-block animation3" style="animation-name: ani;animation-duration: 4s;">
                                                <h5 class="poster-text-1">FEEL THE PAIN</h5>
                                                <p class="poster-text-2">Nothing is over until you stop Trying..</p>
                                                <button class="button animation4 text-white" style="background-color: #009900;background-image: linear-gradient(100deg,#009900 0%,#00CC00);">Shop now</button>
                                            </div>

                                        </div>


                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>

                            </div>
                        </div>

                        <!-- carousel -->

                        <div class="col-12 mt-3 mb-3">
                            <hr class="border-success mx-5" style="border-width: 2px;" />
                        </div>




                        <div class="col-12 cccc">
                            <div class="row">

                                <div class="d-none d-lg-block animate">
                                    <img src="resources/bubble.png">
                                    <img src="resources/bubble.png">
                                    <img src="resources/bubble.png">
                                    <img src="resources/bubble.png">
                                    <img src="resources/bubble.png">
                                    <img src="resources/bubble.png">
                                </div>
                                <!-- category carousel -->

                                <div class="col-lg-12 d-none d-lg-block mt-4 mb-3 placeholder-glow">
                                    <div class="row  gap-lg-1" style="animation-name: slide;animation-duration: 4s;">

                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination pagination-lg justify-content-center">

                                                <div id="carouselExampleSlidesOnly" class="carousel slide animation" data-bs-ride="carousel">
                                                    <div class="carousel-inner  rounded-circle border border-info" style="height: 140px;width: 140px;">
                                                        <div class="carousel-item active">
                                                            <a href="#"><img src="resources/cricket1.jpg" style="height: 130px;width: 130px;" class="d-block img-fluid " alt="..."></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 offset-4">
                                                        <label class="fw-bold text-center text-light">Cricket</label>
                                                    </div>
                                                </div> &nbsp;&nbsp;&nbsp;

                                                <div id="carouselExampleSlidesOnly" class="carousel slide animation" data-bs-ride="carousel">
                                                    <div class="carousel-inner  rounded-circle border border-info" style="height: 140px;width: 140px;">
                                                        <div class="carousel-item active ">
                                                            <a href="#"><img src="resources/football.png" style="height: 140px;width: 140px;" class="d-block img-fluid"></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 offset-4">
                                                        <label class="fw-bold text-center text-light">FootBall</label>
                                                    </div>
                                                </div> &nbsp;&nbsp;&nbsp;

                                                <div id="carouselExampleSlidesOnly" class="carousel slide animation" data-bs-ride="carousel">
                                                    <div class="carousel-inner  rounded-circle border border-info" style="height: 140px;width: 140px;">
                                                        <div class="carousel-item active ">
                                                            <a href="#"><img src="resources/vball.jpg" style="height: 150px;" class="d-block img-fluid " alt="..."></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 offset-3">
                                                        <label class="fw-bold text-center text-light">VolleyBall</label>
                                                    </div>
                                                </div> &nbsp;&nbsp;&nbsp;

                                                <div id="carouselExampleSlidesOnly" class="carousel slide animation" data-bs-ride="carousel">
                                                    <div class="carousel-inner  rounded-circle border border-info" style="height: 140px;width: 140px;">
                                                        <div class="carousel-item active ">
                                                            <a href="#"><img src="resources/badminton.jpg" style="height: 150px;" class="d-block img-fluid" alt="..."></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 offset-3">
                                                        <label class="fw-bold text-center text-light">Badminton</label>
                                                    </div>
                                                </div> &nbsp;&nbsp;&nbsp;

                                                <div id="carouselExampleSlidesOnly" class="carousel slide animation" data-bs-ride="carousel">
                                                    <div class="carousel-inner  rounded-circle border border-info" style="height: 140px;width: 140px;">
                                                        <div class="carousel-item active ">
                                                            <a href="#"><img src="resources/gym.jpg" style="height: 150px;width: 150px;" class="d-block img-fluid" alt="..."></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 offset-3">
                                                        <label class="fw-bold text-center text-light">Gym & Fitness</label>
                                                    </div>
                                                </div> &nbsp;&nbsp;&nbsp;

                                                <div id="carouselExampleSlidesOnly" class="carousel slide animation" data-bs-ride="carousel">
                                                    <div class="carousel-inner  rounded-circle border border-info" style="height: 140px;width: 140px;">
                                                        <div class="carousel-item active ">
                                                            <a href="#"><img src="resources/swimming.jpg" style="height: 150px;" class="d-block img-fluid" alt="..."></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 offset-3">
                                                        <label class="fw-bold text-center text-light">Swimming</label>
                                                    </div>
                                                </div>

                                            </ul>
                                        </nav>



                                    </div>
                                </div>

                                <div class="col-lg-12 d-none d-lg-block mt-4 mb-3 placeholder-glow">
                                    <div class="row  gap-lg-1">

                                        <nav aria-label="Page navigation example">
                                            <ul class="pagination pagination-lg justify-content-center">
                                                <div id="carouselExampleSlidesOnly" class="carousel slide animation" data-bs-ride="carousel">
                                                    <div class="carousel-inner  rounded-circle border border-info" style="height: 140px;width: 140px;">
                                                        <div class="carousel-item active">
                                                            <a href="#"><img src="resources/carrom.jpg" style="height: 140px;width: 140px;" class="d-block img-fluid " alt="..."></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 offset-4">
                                                        <label class="fw-bold text-center text-light">Carrom</label>
                                                    </div>
                                                </div> &nbsp;&nbsp;&nbsp;

                                                <div id="carouselExampleSlidesOnly" class="carousel slide animation" data-bs-ride="carousel">
                                                    <div class="carousel-inner  rounded-circle border border-info" style="height: 140px;width: 140px;">
                                                        <div class="carousel-item active ">
                                                            <a href="#"><img src="resources/shoes.jpg" style="height: 140px;width: 140px;" class="d-block img-fluid"></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 offset-2">
                                                        <label class="fw-bold text-center text-light">Sports Shoes</label>
                                                    </div>
                                                </div> &nbsp;&nbsp;&nbsp;

                                                <div id="carouselExampleSlidesOnly" class="carousel slide animation" data-bs-ride="carousel">
                                                    <div class="carousel-inner  rounded-circle border border-info" style="height: 140px;width: 140px;">
                                                        <div class="carousel-item active ">
                                                            <a href="#"><img src="resources/basketball.jpg" style="height: 140px;width: 140px;" class="d-block img-fluid " alt="..."></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 offset-3">
                                                        <label class="fw-bold text-center text-light">BasketBall</label>
                                                    </div>
                                                </div> &nbsp;&nbsp;&nbsp;

                                                <div id="carouselExampleSlidesOnly" class="carousel slide animation" data-bs-ride="carousel">
                                                    <div class="carousel-inner  rounded-circle border border-info" style="height: 140px;width: 140px;">
                                                        <div class="carousel-item active ">
                                                            <a href="#"><img src="resources/chess.jpg" style="height: 140px;width: 140px;" class="d-block img-fluid" alt="..."></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 offset-4">
                                                        <label class="fw-bold text-center text-light">Chess</label>
                                                    </div>
                                                </div> &nbsp;&nbsp;&nbsp;

                                                <div id="carouselExampleSlidesOnly" class="carousel slide animation" data-bs-ride="carousel">
                                                    <div class="carousel-inner  rounded-circle border border-info" style="height: 140px;width: 140px;">
                                                        <div class="carousel-item active ">
                                                            <a href="#"><img src="resources/boxing.jpg" style="height: 140px;width: 140px;" class="d-block img-fluid" alt="..."></a>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 offset-3">
                                                        <label class="fw-bold text-center text-light">Boxing Sports</label>
                                                    </div>
                                                </div>

                                            </ul>
                                        </nav>



                                    </div>
                                </div>

                                <!-- category carousel -->

                            </div>
                        </div>


                        <div class="col-12 d-none d-lg-block">
                            <hr class="border-success mx-5" style="border-width: 2px;" />
                        </div>


                        <div class="col-12 mt-4 mb-4">
                            <div class="row">
                                <div class="col-12 col-lg-5 ms-1 ms-lg-5">
                                    <p class="fs-4 text-center">When playing cricket, some of the essential equipment you will need includes a cricket bat, cricket ball, and a wicket.
                                        It is heavily recommended to use protective equipment, so we suggest also using cricket shoes,
                                        a cricket helmet, leg pads, thigh guards, arm guards, elbow guards, a chest guard, and gloves.</p>
                                </div>
                                <div class="col-12 offset-lg-1 col-lg-5">
                                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner animation  border rounded-3">
                                            <div class="carousel-item active con">
                                                <img src="resources/cricketimges/images.jpg" class="d-block w-100" style="height: 255px;width: 255px;">
                                                <p class="overlay">When playing cricket, some of the essential equipment you
                                                    will need includes a cricket bat, cricket ball, and a wicket.</p>
                                            </div>
                                            <div class="carousel-item">
                                                <img src="resources/cricketimges/photo-1631194758628-71ec7c35137e.jpg" class="d-block w-100" alt="...">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="resources/cricketimges/wp7419423.jpg" class="d-block w-100" alt="...">
                                            </div>
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <?php

                        $c_rs = Database::search("SELECT * FROM `categories`");
                        $c_num = $c_rs->num_rows;

                        for ($y = 0; $y < $c_num; $y++) {
                            $c_data = $c_rs->fetch_assoc();
                        ?>

                            <!-- category name -->



                            <div class="col-12 mt-3 mb-3">
                                <a href="#" class="text-decoration-none link-dark fs-4 fw-bold"><?php echo ($c_data["categories_name"]) ?></a> &nbsp; &nbsp;
                                <a href="#" class="text-decoration-none link-dark fs-6 fw-bold">See All &nbsp; &rarr;</a>
                            </div>

                            <!-- category name -->

                            <!-- product -->

                            <div class="col-12 mb-3">
                                <div class="row border border-primary">

                                    <div class="col-12">
                                        <div class="row justify-content-center gap-2 ">

                                            <?php

                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `categories_id`='" . $c_data["id"] . "' AND `status_id`='1' ORDER BY `datetime_added` DESC LIMIT 4 OFFSET 0 ");
                                            $product_num = $product_rs->num_rows;

                                            for ($z = 0; $z < $product_num; $z++) {
                                                $product_data = $product_rs->fetch_assoc();

                                            ?>

                                                <div class="card col-6 col-lg-2 mt-2 mb-2 animation3" style="width: 18rem;">

                                                    <?php

                                                    $img_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $product_data["id"] . "' ");
                                                    $image_data = $img_rs->fetch_assoc();

                                                    ?>

                                                    <img src="<?php echo ($image_data["image_path"]) ?>" class="card-img-top img-thumbnail mt-2" style="height: 180px;" />
                                                    <div class="card-body ms-0 m-0 text-center">
                                                        <h5 class="card-title fs-6 fw-bold"><?php echo ($product_data["title"]) ?><br /> <span class="badge bg-info">New</span></h5>
                                                        <span class="card-text text-primary">Rs.<?php echo ($product_data["price"]) ?>.00</span> <br />

                                                        <?php

                                                        if ($product_data["qty"] > 0) {

                                                        ?>

                                                            <span class="card-text text-warning fw-bold">In Stock</span> <br />
                                                            <span class="card-text text-success fw-bold"><?php echo ($product_data["qty"]); ?> Items Available</span>

                                                            <a href='<?php echo ("singleProductView.php?id=" . $product_data["id"]); ?>' class="col-12 btn text-white" style="background-color: #009900;background-image: linear-gradient(100deg,#009900 0%,#00CC00);">Buy Now</a>
                                                            <button class="col-12 btn text-white mt-2" onclick="addCart('<?php echo ($product_data['id']); ?>');" style="background-color: #FF0000;background-image: linear-gradient(100deg,#FF0000 0%,#FF0033);">Add to Cart</button>

                                                        <?php

                                                        } else {

                                                        ?>

                                                            <span class="card-text text-warning fw-bold">Out of Stock</span> <br />
                                                            <span class="card-text text-success fw-bold">0 Items Available</span>

                                                            <button class="col-12 btn text-white disabled" style="background-color: #009900;background-image: linear-gradient(100deg,#009900 0%,#00CC00);">Buy Now</button>
                                                            <button class="col-12 btn text-white mt-2 disabled" style="background-color: #FF0000;background-image: linear-gradient(100deg,#FF0000 0%,#FF0033);">Add to Cart</button>

                                                            <?php

                                                        }

                                                        if (isset($_SESSION["userData"])) {

                                                            $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $product_data["id"] . "' AND
                                                        `user_email`='" . $_SESSION["userData"]["email"] . "'");
                                                            $watchlist_num = $watchlist_rs->num_rows;

                                                            if ($watchlist_num == 1) {
                                                            ?>

                                                                <a class="col-12 mt-2" onclick='addToWatchlist(<?php echo ($product_data["id"]); ?>);'>
                                                                    <i class="bi bi-heart-fill text-danger fs-5" id='heart<?php echo ($product_data["id"]); ?>' style="cursor: pointer;"></i>
                                                                </a>

                                                            <?php

                                                            } else {
                                                            ?>

                                                                <a class="col-12 mt-2" onclick='addToWatchlist(<?php echo ($product_data["id"]); ?>);'>
                                                                    <i class="bi bi-heart-fill text-dark fs-5" id='heart<?php echo ($product_data["id"]); ?>' style="cursor: pointer;"></i>
                                                                </a>

                                                            <?php
                                                            }
                                                        } else {
                                                            ?>

                                                            <a href="index.php" class="col-12 mt-3">
                                                                <i class="bi bi-heart-fill text-dark fs-5" style="cursor: pointer;"></i>
                                                            </a>

                                                        <?php
                                                        }


                                                        ?>
                                                    </div>
                                                </div>

                                            <?php
                                            }

                                            ?>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- product -->

                        <?php
                        }



                        ?>



                    </div>
                </div>

                <div class="col-12">
                    <div class="row">
                        <div class="col-12 mt-4 mb-4">
                            <iframe class="col-12 col-lg-10 offset-lg-1" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d63370.86447099896!2d79.881797!3d6.928915000000001!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae259097a27717b%3A0xe8f74aefc50b71d7!2sColombo%2010%2C%20Colombo!5e0!3m2!1sen!2slk!4v1666003376066!5m2!1sen!2slk" style="border:0;height: 450px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>

                <!-- modelCart -->
                <div class="modal" tabindex="-1" id="viewCart" style="margin-top: 200px;">

                </div>
                <!-- modelCart -->

                <!-- modelWatchlist -->
                <div class="modal" tabindex="-1" id="viewWatchlist" style="margin-top: 200px;">

                </div>
                <!-- modelWatchlist -->

                <?php include "footer.php" ?>

            <?php
            } else {
                header("Location:index.php");
            }
            ?>

        </div>
    </div>




    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>