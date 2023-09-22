<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OTP Verification</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>

<?php
session_start();
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function generateOTP() {
    return rand(1000, 9999); // Generate a 4-digit OTP
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $otp = generateOTP();
        $_SESSION['otp'] = $otp;
        $_SESSION['name'] = $name; 

        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'rishu.college16@gmail.com';
            $mail->Password   = 'hfgzwcsymqgedbrl';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('your-email@example.com', 'Your Name');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'OTP Verification';
            $mail->Body    = 'Hello ' . $name . ',<br>Your OTP is: ' . $otp;

            $mail->send();
            header('Location: verify_otp.php'); // Redirect to OTP verification page
            exit(); // Ensure that no further code is executed
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }


}
?>
<div class="container form">
<form action="" method="post">
    <label for="name">Enter your name:</label>
    <input type="text" id="name" name="name">
    <br>
    <label for="email">Enter your email:</label>
    <input type="email" id="email" name="email">
    <br>
    <label for="password">Enter your password:</label>
    <input type="password" id="password" name="password">
    <br>
    <input type="submit" value="Send OTP">
</form>
</div>
</body>
</html>
