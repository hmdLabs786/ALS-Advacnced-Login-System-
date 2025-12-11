<?php
session_start();
header('Content-Type: application/json');
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(!isset($_SESSION['otp_email'])){
    echo json_encode(['status'=>'fail','message'=>'No email set']); 
    exit;
}

// ------------------ RESEND OTP PROTECTION ------------------
if(!isset($_SESSION['resend_otp_attempts'])){
    $_SESSION['resend_otp_attempts'] = 0;
    $_SESSION['resend_otp_time'] = time();
}

$max_resends = 3;
$lockout_time = 300; // 5 minutes

if($_SESSION['resend_otp_attempts'] >= $max_resends){
    $elapsed = time() - $_SESSION['resend_otp_time'];
    if($elapsed < $lockout_time){
        echo json_encode(['status'=>'fail','message'=>"Too many resend attempts. Try again in ".($lockout_time-$elapsed)." seconds."]);
        exit;
    } else {
        // Reset after lockout
        $_SESSION['resend_otp_attempts'] = 0;
        $_SESSION['resend_otp_time'] = time();
    }
}
// -------------------------------------------------------------

$email = $_SESSION['otp_email'];
$otp = rand(100000,999999);
$_SESSION['otp'] = $otp;
$_SESSION['otp_expiry'] = time() + 300; // 5 minutes

try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'habban.madani786@gmail.com';
    $mail->Password = 'gbxk wyzb mlpt upje';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->setFrom('habban.madani786@gmail.com','ALS');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Your ALS Password Reset OTP';
    $mail->Body = '
    <div style="font-family:Inter,sans-serif; background:#f6f8fc; padding:30px;">
        <div style="max-width:500px;margin:auto;background:white;padding:30px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.1);">
            <h2 style="color:#003366;">Password Reset OTP</h2>
            <p>Your OTP is:</p>
            <h1 style="text-align:center;color:#1a73e8;">'.$otp.'</h1>
            <p style="font-size:14px;color:#6b7280;">Expires in 5 minutes.</p>
            <hr>
            <p style="text-align:center;font-size:12px;color:#606368;">Powered by ALS</p>
        </div>
    </div>
    ';
    $mail->send();
    
    // Update resend attempts
    $_SESSION['resend_otp_attempts']++;
    if($_SESSION['resend_otp_attempts'] == 1) $_SESSION['resend_otp_time'] = time();

    echo json_encode(['status'=>'success']);
} catch(Exception $e){
    echo json_encode(['status'=>'fail','message'=>'Failed to send OTP']);
}
?>
