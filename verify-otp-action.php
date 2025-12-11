<?php
session_start();
header('Content-Type: application/json');

if(!isset($_SESSION['otp']) || !isset($_POST['otp'])){
    echo json_encode(['status'=>'fail']); exit;
}

$enteredOtp = trim($_POST['otp']);

if(time() > $_SESSION['otp_expiry']){
    echo json_encode(['status'=>'fail','message'=>'OTP expired']); exit;
}

if($enteredOtp == $_SESSION['otp']){
    $_SESSION['otp_verified'] = true;
    $_SESSION['reset_email'] = $_SESSION['otp_email'];
    echo json_encode(['status'=>'success']);
}

 else {
    echo json_encode(['status'=>'fail']);
}
?>
