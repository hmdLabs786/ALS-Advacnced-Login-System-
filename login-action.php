<?php
error_log("SESSION ID BEFORE: " . session_id());

session_start();
error_log("SESSION ID AFTER: " . session_id());


header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Origin: http://localhost/ALS/"); 

header('Content-Type: application/json');
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");

// Optional: for debugging, log errors
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/php_errors.log');
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

// ---- Database connection ----
$host = "localhost";
$user = "root";
$pass = "";
$db = "als_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    echo json_encode(['status' => 'error', 'message' => 'DB connection failed']);
    exit;
}

// ---- Get POST data ----
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// ---- Check user credentials ----
$stmt = $conn->prepare("SELECT id, password, role FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->bind_result($id, $hashed, $role);
$stmt->fetch();
        
if ($id && password_verify($password, $hashed)) {
    // ---- Store user data in session ----
    $_SESSION['user_email'] = $email;       // Store email
    $_SESSION['user_role'] = $role;         // Store role for redirection
    $_SESSION['user_id'] = $id;             // Store user ID

    // ---- Successful login ----
    echo json_encode(['status' => 'success', 'message' => 'Login successful', 'role' => $role, 'email' => $email]);
} else {
    // Failed login attempt
    echo json_encode(['status' => 'fail', 'message' => 'Invalid email or password']);
}

$stmt->close();
$conn->close();
exit;
?>
