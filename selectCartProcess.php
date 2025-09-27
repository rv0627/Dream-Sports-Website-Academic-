<?php
session_start();
require "connection.php";

if (isset($_GET["select"]) && isset($_GET["pid"])) {
    $check = $_GET["select"];
    $check_pid = $_GET["pid"];

    $total = 0;
    $subtotal = 0;
    $shipping = 0;
    $final_price = 0;



    $cart_rs = Database::search("SELECT * FROM `cart` WHERE `product_id`='" . $check_pid . "'");
    $cart_num = $cart_rs->num_rows;

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $check_pid . "'");
    $product_num = $product_rs->num_rows;
    $product_data = $product_rs->fetch_assoc();

    $price = Database::search("SELECT SUM(`total`) AS `total` FROM `cart` WHERE `product_id`='" . $check_pid . "'");
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
    echo ("Somthing went wrong.Please try again later");
}

?>


<?php

for ($x = 0; $x < $cart_num; $x++) {
    $cart_data = $cart_rs->fetch_assoc();

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
            <?php
            if ($address_data["did"] == 2) {
            ?>
                <span class="fs-6 text-black">Rs. <?php echo ($product_data["delivery_fee_colombo"]); ?> .00</span>
            <?php
            } else {
            ?>
                <span class="fs-6 text-black">Rs. <?php echo ($product_data["delivery_fee_other"]); ?> .00</span>
            <?php
            }
            ?>
        </div>

        <div class="col-12 mt-3">
            <hr />
        </div>

        <div class="col-6 mt-2">
            <span class="fs-5 fw-bold">Total</span>
        </div>

        <div class="col-6 mt-2 text-end">
            <span class="fs-6 fw-bold">Rs. <?php echo ($final_price); ?> .00</span>
        </div>

        <div class="col-12 mt-3 mb-3 d-grid">
            <button class="btn btn-primary fs-5 fw-bold">CHECKOUT</button>
        </div>

    </div>
<?php

}

?>