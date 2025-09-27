<?php
session_start();
require "connection.php";

if (isset($_SESSION["au"])) {
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Panel | Dream Sports</title>

        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="bootstrap.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

        <link rel="icon" href="resources/dream sports (3).svg">
    </head>

    <body class="bg-secondary">
        <div class="container-fluid">
            <div class="row">

                <nav class="navbar navbar-dark bg-secondary fixed-top pt-3 pb-3">
                    <div class="container-fluid">
                        <a class="navbar-brand fw-bold" href="#">DREAM SPORTS</a>
                        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                            <span class="text-white fs-4 fw-bold pe-4">Dashboard</span>
                            <span class="navbar-toggler-icon fs-4"></span>
                        </button>
                        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title fw-bold" id="offcanvasDarkNavbarLabel">DREAM SPORTS</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle active fs-5" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Dashboard
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-dark">
                                            <li><a class="dropdown-item active" href="adminPanel.php">- E-commerce</a></li>
                                            <li><a class="dropdown-item" href="manageUsers.php">- Manage Users</a></li>
                                            <li><a class="dropdown-item" href="manageProduct.php">- Manage Products</a></li>
                                        </ul>
                                    </li>

                                    <div class="col-12">
                                        <hr />
                                    </div>

                                    <li class="nav-item">
                                        <a class="nav-link active fs-5" aria-current="page" href="#">Selling History</a>
                                    </li>

                                    <div class="col-12">
                                        <hr />
                                    </div>

                                    <li class="nav-item">
                                        <label class="form-label">From Date</label>
                                    </li>
                                    <li class="nav-item">
                                        <input type="date" class="form-control">
                                    </li>

                                    <li class="nav-item mt-3">
                                        <label class="form-label">To Date</label>
                                    </li>
                                    <li class="nav-item">
                                        <input type="date" class="form-control">
                                    </li>
                                    <div class="col-12">
                                        <hr />
                                    </div>

                                    <div class="col-12 d-grid">
                                        <button class="btn btn-primary">View Selling</button>
                                    </div>
                                    <div class="col-12 d-grid mt-4">
                                        <button class="btn btn-outline-info" onclick="adminLogout();">Log Out</button>
                                    </div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>

                <div class="col-12 bg-white pb-3" style="margin-top: 80px;">
                    <div class="row">
                        <div class="col-12 col-lg-4 pt-lg-2">
                            <label class="form-label text-dark fw-bold fs-5">Hi, <?php echo ($_SESSION["au"]["first_name"] . " " . $_SESSION["au"]["last_name"]); ?>!</label><br />
                            <label class="form-label fw-bold" style="color: grey;">Here's what's happening with your store today.</label>
                        </div>
                        <div class="col-6 col-lg-4 pt-2 pt-lg-3">
                            <input type="text" class="form-control" placeholder="Search...">
                        </div>
                        <div class="col-2 col-lg-2 pt-2 pt-lg-3">
                            <button class="btn btn-info">Search</button>
                        </div>
                        <div class="col-4 col-lg-2 offset-lg-0 mt-lg-0 pt-lg-2">
                            <span class="fs-5 text-success fw-bold">Active Time</span><br />
                            <?php

                            $start_date = new DateTime("2023-01-01 00:00:00");

                            $tdate = new DateTime();
                            $tz = new DateTimeZone("Asia/Colombo");
                            $tdate->setTimezone($tz);

                            $end_date = new DateTime($tdate->format("Y-m-d H:i:s"));

                            $difference = $end_date->diff($start_date);

                            ?>
                            <span class="text-black-50 fw-bold"><?php echo ($difference->format('%Y')); ?></span>&nbsp;<span class="text-black fw-bold fs-6">: Y</span>
                            <span class="text-black-50 fw-bold"><?php echo ($difference->format('%m')); ?></span>&nbsp;<span class="text-black fw-bold fs-6">: M</span>
                            <span class="text-black-50 fw-bold"><?php echo ($difference->format('%d')); ?></span>&nbsp;<span class="text-black fw-bold fs-6">: D</span><br />
                            <span class="text-black-50 fw-bold"><?php echo ($difference->format('%H')); ?></span>&nbsp;<span class="text-black fw-bold fs-6">: H</span>
                            <span class="text-black-50 fw-bold"><?php echo ($difference->format('%i')); ?></span>&nbsp;<span class="text-black fw-bold fs-6">: M</span>
                            <span class="text-black-50 fw-bold"><?php echo ($difference->format('%s')); ?></span>&nbsp;<span class="text-black fw-bold fs-6">: S</span>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-2 mb-2 d-flex">
                    <div class="row justify-content-center">
                        <div class="col-5 bg-white mx-3 my-3">
                            <div class="col-12">
                                <div class="row  pt-3 pb-3">
                                    <div class="col-6 text-start">
                                        <label class="form-label fw-bold" style="color: grey;">TOTAL EARNINGS</label>
                                        <?php
                                        $ir = Database::search("SELECT SUM(total) AS count FROM invoice");
                                        $record = $ir->fetch_array();
                                        $totalEarning = $record['count'];
                                        ?>
                                    </div>
                                    <div class="col-6 text-end">
                                        <label class="form-label fw-bold text-success">+ 16.24 %</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 pb-3">
                                <span class="form-label text-black fs-5">Rs.<?php echo ($totalEarning); ?>.00</span>
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-10 pb-4">
                                        <a href="#">View net earnings</a>
                                    </div>
                                    <div class="col-2 pb-2">
                                        <i class="bi bi-coin fs-3 text-success"></i>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-5 bg-white mx-3 my-3">

                            <div class="col-12">
                                <div class="row  pt-3 pb-3">
                                    <div class="col-6 text-start">
                                        <label class="form-label fw-bold" style="color: grey;">ORDERS</label>
                                        <?php
                                        $order_rs = Database::search("SELECT * FROM `invoice`");
                                        $order_num = $order_rs->num_rows;
                                        ?>
                                    </div>
                                    <div class="col-6 text-end">
                                        <label class="form-label fw-bold text-danger">- 3.57 %</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 pb-3">
                                <span class="form-label text-black fs-5"><?php echo ($order_num); ?> Orders</span>
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-10 pb-4">
                                        <a href="#">View all orders</a>
                                    </div>
                                    <div class="col-2 pb-2">
                                        <i class="bi bi-bag fs-3 text-primary"></i>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-5 bg-white mx-3 my-3">

                            <div class="col-12">
                                <div class="row  pt-3 pb-3">
                                    <div class="col-6 text-start">
                                        <label class="form-label fw-bold" style="color: grey;">CUSTOMERS</label>
                                        <?php
                                        $user_rs = Database::search("SELECT * FROM `user`");
                                        $user_num = $user_rs->num_rows;
                                        ?>
                                    </div>
                                    <div class="col-6 text-end">
                                        <label class="form-label fw-bold text-succsess">+ 29.08 %</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 pb-3">
                                <span class="form-label text-black fs-5"><?php echo ($user_num); ?> Customers</span>
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-10 pb-4">
                                        <a href="#">See details</a>
                                    </div>
                                    <div class="col-2 pb-2">
                                        <i class="bi bi-person-circle fs-3 text-warning"></i>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-5 bg-white mx-3 my-3">

                            <div class="col-12">
                                <div class="row  pt-3 pb-3">
                                    <div class="col-12 text-start">
                                        <label class="form-label fw-bold" style="color: grey;">DAILY EARNINGS</label>
                                        <?php
                                        $today = date("Y-m-d");

                                        $a = "0";
                                        $b = "0";
                                        $c = "0";
                                        $e = "0";
                                        $f = "0";

                                        $invoice_rs = Database::search("SELECT * FROM `invoice`");
                                        $invoice_num = $invoice_rs->num_rows;

                                        for ($x = 0; $x < $invoice_num; $x++) {
                                            $invoice_data = $invoice_rs->fetch_assoc();

                                            $f = $f + $invoice_data["qty"]; //total qty

                                            $d = $invoice_data["date"];
                                            $splitDate = explode(" ", $d); //separate date from time
                                            $pdate = $splitDate[0]; //sold date

                                            if ($pdate == $today) {
                                                $a = $a + $invoice_data["total"];
                                                $c = $c + $invoice_data["qty"];
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 pb-3">
                                <span class="form-label text-black fs-5">Rs. <?php echo ($a); ?> .00</span>
                            </div>

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-10 pb-4">
                                        <a href="#">View net earnings</a>
                                    </div>
                                    <div class="col-2 pb-2">
                                        <i class="bi bi-coin fs-3 text-success"></i>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-12 bg-white mt-3">
                            <div class="row pt-4 pb-4">
                                <div class="col-12">
                                    <p class="form-label text-secondary fw-bold fs-5">Sales by Locations</p>
                                    <hr />
                                    <p class="form-label text-dark fw-bold">Colombo</p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width: 85%;" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100">85%</div>
                                    </div>
                                    <p class="form-label text-dark fw-bold">Galle</p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width: 70%;" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">70%</div>
                                    </div>
                                    <p class="form-label text-dark fw-bold">Kandy</p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width: 40%;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">40%</div>
                                    </div>
                                    <p class="form-label text-dark fw-bold">Matara</p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width: 52%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100">52%</div>
                                    </div>
                                    <p class="form-label text-dark fw-bold">Gampaha</p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width: 20%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">20%</div>
                                    </div>
                                    <p class="form-label text-dark fw-bold">Kurunagalla</p>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-label="Example with label" style="width: 12%;" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100">12%</div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- best product -->
                        <div class="col-12 mt-4 mb-2 bg-white pt-3 pb-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-4 col-lg-8">
                                            <label class="form-label fs-5 text-secondary fw-bold">Best Selling Products</label>
                                        </div>
                                        <div class="col-4 col-lg-2 text-end pt-1">
                                            <label class="form-label fs-6 text-black fw-bold">SORTBY :</label>
                                        </div>
                                        <div class="col-4 col-lg-2">
                                            <select class="form-select shadow-none text-secondary">
                                                <option>Today</option>
                                                <option>Yesterday</option>
                                                <option>Last 7 Days</option>
                                                <option>Last 30 Days</option>
                                                <option>This Month</option>
                                                <option>Last Month</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr />
                                </div>

                                <?php
                                $freq_rs = Database::search("SELECT `product_id`,COUNT(`product_id`) AS `value_occurence`
                                FROM `invoice` WHERE `date` LIKE '%" . $today . "%' GROUP BY `product_id` ORDER BY 
                                `value_occurence` DESC LIMIT 5");
                                $freq_num = $freq_rs->num_rows;
                                ?>

                                <div class="col-12">

                                    <table class="table">

                                        <tbody>
                                            <?php
                                            for ($x = 0; $x < $freq_num; $x++) {
                                                if ($freq_num > 0) {
                                                    $freq_data = $freq_rs->fetch_assoc();

                                                    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $freq_data["product_id"] . "'");
                                                    $product_data = $product_rs->fetch_assoc();

                                                    $image_rs = Database::search("SELECT * FROM `product_image` WHERE `product_id`='" . $freq_data["product_id"] . "'");
                                                    $image_data = $image_rs->fetch_assoc();

                                                    $qty_rs = Database::search("SELECT SUM(`qty`) AS `qty_total` FROM `invoice` WHERE
                                    `product_id`='" . $freq_data["product_id"] . "' AND `date` LIKE '%" . $today . "%'");
                                                    $qty_data = $qty_rs->fetch_assoc();

                                                    $i_rs = Database::search("SELECT * FROM `invoice` WHERE `product_id`='" . $freq_data["product_id"] . "' AND `date` LIKE '%" . $today . "%'");
                                                    $i_num = $i_rs->num_rows;
                                            ?>
                                                    <tr>
                                                        <td>
                                                            <img src="<?php echo ($image_data["image_path"]); ?>" style="height: 40px;" alt="">

                                                            <span class="fw-bold p-2 text-secondary"><?php echo ($product_data["title"]); ?></span>
                                                        </td>
                                                        <td class="text-start">
                                                            <span class="p-2 text-secondary"><?php echo ($i_num); ?></span><br />
                                                            <span class="text-secondary p-2">Orders</span>
                                                        </td>
                                                        <td class="text-start">
                                                            <span class="p-2 text-secondary"><?php echo ($qty_data["qty_total"]); ?></span><br />
                                                            <span class="text-secondary p-2">Stock</span>
                                                        </td>
                                                        <td class="text-start">
                                                            <span class="p-2 text-secondary text-end">Rs.<?php echo ($qty_data["qty_total"] * $product_data["price"]); ?>.00</span><br />
                                                            <span class="text-secondary p-2">Amount</span>
                                                        </td>
                                                    </tr>
                                                <?php
                                                } else {
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <img src="" style="height: 40px;" alt="">

                                                            <span class="fw-bold p-2 text-secondary">------</span>
                                                        </td>
                                                        <td class="text-start">
                                                            <span class="p-2 text-secondary">------</span><br />
                                                            <span class="text-secondary p-2">Orders</span>
                                                        </td>
                                                        <td class="text-start">
                                                            <span class="p-2 text-secondary">------</span><br />
                                                            <span class="text-secondary p-2">Stock</span>
                                                        </td>
                                                        <td class="text-start">
                                                            <span class="p-2 text-secondary text-end">Rs.------</span><br />
                                                            <span class="text-secondary p-2">Amount</span>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
                                            ?>

                                        </tbody>

                                    </table>
                                </div>

                            </div>
                        </div>
                        <!-- best product -->



                        <!-- best seller -->
                        <div class="col-12 mt-3 mb-4 bg-white pt-3 pb-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-4 col-lg-8">
                                            <label class="form-label fs-5 text-secondary fw-bold">Top Seller</label>
                                        </div>
                                        <div class="col-4 col-lg-2 text-end pt-1">

                                        </div>
                                        <div class="col-4 col-lg-2">
                                            <select class="form-select shadow-none text-secondary">
                                                <option>Today</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <hr />
                                </div>

                                <div class="col-12">
                                    <table class="table">

                                        <tbody>
                                            <?php
                                            $f_rs = Database::search("SELECT `product_id`,COUNT(`product_id`) AS `value_occurence`
                                            FROM `invoice` WHERE `date` LIKE '%" . $today . "%' GROUP BY `product_id` ORDER BY 
                                            `value_occurence` DESC LIMIT 1");
                                            $f_num = $f_rs->num_rows;

                                            if ($f_num > 0) {
                                                $f_data = $f_rs->fetch_assoc();

                                                $p_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $f_data["product_id"] . "'");
                                                $p_data = $p_rs->fetch_assoc();

                                                $profile_rs = Database::search("SELECT * FROM `profile_image` WHERE `user_email`='" . $p_data["user_email"] . "'");
                                                $profile_data = $profile_rs->fetch_assoc();

                                                $user_rs1 = Database::search("SELECT * FROM `user` WHERE `email`='" . $p_data["user_email"] . "'");
                                                $user_data = $user_rs1->fetch_assoc();
                                            ?>
                                                <tr>
                                                    <td>
                                                        <img src="<?php echo ($profile_data["path"]); ?>" style="height: 50px;width: 50px;border-radius: 50px;" alt="">

                                                        <span class="fw-bold p-2 text-secondary"><?php echo ($user_data["first_name"] . " " . $user_data["last_name"]); ?></span><br />
                                                    </td>
                                                    <td class="text-start">
                                                        <span class="p-2 text-dark">Email</span><br />
                                                        <span class="p-2 text-secondary"><?php echo ($user_data["email"]); ?></span>
                                                    </td>
                                                    <td class="text-start">
                                                        <span class="p-2 text-dark">Mobile</span><br />
                                                        <span class="text-secondary p-2"><?php echo ($user_data["mobile"]); ?></span>
                                                    </td>
                                                    <td class="text-start">
                                                        <img src="resources/gold-medal.png" style="height: 50px;width: 50px;border-radius: 50px;" alt="">
                                                    </td>
                                                </tr>
                                            <?php
                                            } else {
                                            }

                                            ?>

                                        </tbody>

                                    </table>
                                </div>

                            </div>
                        </div>
                        <!-- best seller -->


                    </div>
                </div>


                <?php include "footer.php"; ?>
            </div>
        </div>

        <script src="bootstrap.bundle.js"></script>
        <script src="script.js"></script>
    </body>

    </html>

<?php
} else {
    header("Location:adminSignIn.php");
}
?>