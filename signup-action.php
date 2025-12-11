<?php
// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db = "als_db";

$conn = new mysqli($host,$user,$pass,$db);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'] ?? 'user'; // default to user if role not provided

// Check if user exists
$stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
$stmt->bind_param("s",$email);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows > 0){
    echo "Email already registered!";
    exit;
}
$stmt->close();

// Insert user
$hashed = password_hash($password, PASSWORD_BCRYPT);
$stmt = $conn->prepare("INSERT INTO users (email,password,role) VALUES (?,?,?)");
$stmt->bind_param("sss",$email,$hashed,$role);
if($stmt->execute()){
    echo "success";
}else{
    echo "Failed to create account!";
}
$stmt->close();
$conn->close();
?>
