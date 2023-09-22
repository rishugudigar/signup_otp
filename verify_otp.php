<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>OTP Confirmation</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>

<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['otp'])) {
        $user_otp = $_POST['otp'];
        if($user_otp == $_SESSION['otp']) {
            header('Location: success_page.php'); // Redirect to success page
            exit(); // Ensure that no further code is executed
        } else {
            echo "<div class='error-message'>Invalid OTP. Please try again.</div>";
    }
}
}
?>
<div class="container form">
<form action="" method="post">
    <label for="otp">Enter OTP:</label>
    <input type="text" id="otp" name="otp" required>
    <button type="submit">Submit</button>
</form>
</div>
</body>
</html>