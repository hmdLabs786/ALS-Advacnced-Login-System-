<?php
session_start();
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db = "als_db";
$conn = new mysqli($host,$user,$pass,$db);
if($conn->connect_error){
    die("DB Connection Failed");
}

// Get email
$email = $_POST['email'];

// Check if email exists
$stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
$stmt->bind_param("s",$email);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows == 0){
    $stmt->close();
    die("Email not found.");
}
$stmt->bind_result($user_id);
$stmt->fetch();
$stmt->close();

// Generate 6-digit OTP
$otp = rand(100000, 999999);

// Store OTP and expiration in session
// Store OTP and expiration in session
$_SESSION['otp'] = $otp;
$_SESSION['otp_email'] = $email;
$_SESSION['otp_expiry'] = time() + 300; // 5 minutes

// IMPORTANT: store email for reset later
$_SESSION['reset_email'] = $email;

// Send email via Gmail SMTP
$mail = new PHPMailer(true);
try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'habban.madani786@gmail.com'; // Gmail account
    $mail->Password   = 'gbxk wyzb mlpt upje';    // App password (highly recommended)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    //Recipients
    $mail->setFrom('habban.madani786@gmail.com', 'ALS');
    $mail->addAddress($email);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Your ALS Password Reset OTP';

    $mailContent = '
    <div style="font-family:Inter,sans-serif; background:#f6f8fc; padding:30px;">
        <div style="max-width:500px; margin:auto; background:white; padding:30px; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.1);">
            <h2 style="color:#003366;">Password Reset OTP</h2>
            <p>Hi,</p>
            <p>You requested to reset your password. Use the OTP below to verify your email:</p>
            <h1 style="text-align:center; color:#1a73e8;">'.$otp.'</h1>
            <p style="font-size:14px; color:#6b7280;">This OTP will expire in 5 minutes.</p>
            <hr>
            <p style="text-align:center; font-size:12px; color:#606368;">Powered by ALS</p>
        </div>
    </div>
    ';

    $mail->Body = $mailContent;

    $mail->send();
    // Redirect to verify OTP page
    header("Location: verify-otp.php");
    exit();

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

$conn->close();
?>
