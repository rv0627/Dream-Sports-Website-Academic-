<?php
session_start();
require "connection.php";
if (isset($_GET["sall"])) {
    $all = $_GET["sall"];

    $total = 0;
    $subtotal = 0;
    $shipping = 0;
    $final_price = 0;

    $cart_rs = Database::search("SELECT * FROM `cart`");
    $cart_num = $cart_rs->num_rows;
    $cart_data = $cart_rs->fetch_assoc();
    $pid = $cart_data["product_id"];

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $pid . "'");
    $product_num = $product_rs->num_rows;
    $product_data = $product_rs->fetch_assoc();

    $price = Database::search("SELECT SUM(`total`) AS `total` FROM `cart`");
    $price_num = $price->num_rows;
    $price_data = $price->fetch_assoc();

    $total = $total + ($product_data["price"] * $cart_data["qty"]);

    $address_rs = Database::search("SELECT district.id AS did FROM `user_has_address` INNER JOIN `city` ON
    user_has_address.city_id=city.id INNER JOIN `district` ON
    city.district_id=district.id WHERE `user_email`='" . $_SESSION["userData"]["email"] . "'");

    $address_data = $address_rs->fetch_assoc();

    $ship = 0;

    if ($address_data["did"] == 2) {
        $ship = $product_data["delivery_fee_colombo"];
        $shipping = $shipping + $ship;
    } else {
        $ship = $product_data["delivery_fee_other"];
        $shipping = $shipping + $ship;
    }

    $final_price = $final_price + ($total + $shipping);
} else {
    echo ("Somthing went wrong. Please try again later");
}
?>

<div class="row">

    <div class="col-12">
        <label class="form-label fs-3 fw-bold">Summary</label>
    </div>

    <div class="col-12">
        <hr />
    </div>

    <div class="col-6 mb-3">
        <span class="fs-6 fw-bold">items (<?php echo ($cart_num); ?>)</span>
    </div>

    <div class="col-6 text-end mb-3">
        <span class="fs-6 fw-bold">Rs. <?php echo ($total); ?> .00</span>
    </div>

    <div class="col-6">
        <span class="fs-6 fw-bold">Shipping</span>
    </div>

    <div class="col-6 text-end">
        <span class="fs-6 fw-bold">Rs. <?php echo ($shipping); ?> .00</span>
    </div>

    <div class="col-12 mt-3">
        <hr />
    </div>

    <div class="col-6 mt-2">
        <span class="fs-5 fw-bold">Total</span>
    </div>

    <div class="col-6 mt-2 text-end">
        <span class="fs-5 fw-bold">Rs. <?php echo ($shipping + $total); ?> .00</span>
    </div>

    <div class="col-12 mt-3 mb-3 d-grid">
        <button class="btn btn-primary fs-5 fw-bold">CHECKOUT</button>
    </div>

</div>