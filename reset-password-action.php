<?php
session_start();
header('Content-Type: application/json');

if(!isset($_SESSION['reset_email'])){
    echo json_encode(['status'=>'error','message'=>'Session expired']);
    exit();
}

$host="localhost";
$user="root";
$pass="";
$db="als_db";

$conn = new mysqli($host,$user,$pass,$db);
if($conn->connect_error){
    echo json_encode(['status'=>'error','message'=>'DB connection failed']);
    exit();
}

$email = $_SESSION['reset_email'];
$password = $_POST['password'];

// Hash password
$hashed = password_hash($password, PASSWORD_DEFAULT);

// Update DB
$stmt = $conn->prepare("UPDATE users SET password=? WHERE email=?");
$stmt->bind_param("ss",$hashed,$email);

if($stmt->execute()){
    // Clear reset session
    unset($_SESSION['reset_email']);
    echo json_encode(['status'=>'success']);
}else{
    echo json_encode(['status'=>'error','message'=>'Failed to update password']);
}

$stmt->close();
$conn->close();
?>
