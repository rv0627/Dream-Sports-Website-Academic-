<?php
require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST["e"])) {
    $admin_mail = $_POST["e"];

    $admin_rs = Database::search("SELECT * FROM `admin` WHERE `email`='" . $admin_mail . "'");
    $admin_num = $admin_rs->num_rows;

    if ($admin_num > 0) {

        $code = uniqid();
        Database::iud("UPDATE `admin` SET `verification_code`='" . $code . "' WHERE `email`='" . $admin_mail . "'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ravindumaleesha06270107@gmail.com';
        $mail->Password = 'pfarqgtzucyhmytn';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('ravindumaleesha06270107@gmail.com', 'Admin Verification');
        $mail->addReplyTo('ravindumaleesha06270107@gmail.com', 'Admin Verification');
        $mail->addAddress($admin_mail);
        $mail->isHTML(true);
        $mail->Subject = 'Dream Sports Admin Login Verification Code';
        $bodyContent = '<h1 style="color:blue">Your Verification Code is : <span style="color:red">' . $code . '</span></h1>';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo ("Verification code sending failed");
        } else {
            // echo ("Success");
?>
            <div class="col-12 text-start">
                <div class="row">
                    <label class="form-label fw-bold text-white-50 text-uppercase">Enter your Verification Code</label>
                </div>
            </div>
            <div class="col-12 text-start">
                <div class="row">
                    <div class="col-10 pt-2">
                        <input type="text" class="line mb-3 pb-6 text-black" placeholder="EX : 54dfv34fef" id="vcode" />
                        <p id="msgv"></p>
                    </div>
                    <div class="col-2 text-end  pb-4">
                        <i class="bi bi-shield-lock-fill fs-3 text-white-50"></i>
                    </div>
                </div>
            </div>

            <div class="col-6 d-grid">
                <button class="btn btn-outline-success fw-bold" onclick="verify();">LOGIN ADMIN PANEL</button>
            </div>
            <div class="col-6 d-grid ">
                <button class="btn btn-outline-danger fw-bold" onclick="window.location = 'index.php';">BACK TO CUSTOMER LOGIN</button>
            </div>
<?php
        }
    } else {
        echo ("This Email address is Invalid");
    }
} else {
    echo ("Email field should not be empty");
}
?>