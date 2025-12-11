<?php
session_start();

// Store a message to show on logout
$_SESSION['logout_message'] = "You have successfully logged out.";

// Destroy all session data
$_SESSION = array();
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();

// Prevent browser caching
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Logging Out - ALS</title>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap');

    body{
        margin:0; padding:0;
        font-family: 'Inter', sans-serif;
        display:flex;
        justify-content:center;
        align-items:center;
        height:100vh;
        background:#f6f8fc;
    }

    .logout-box{
        background:white;
        padding:30px 40px;
        border-radius:15px;
        box-shadow:0 8px 20px rgba(0,0,0,0.2);
        text-align:center;
        max-width:400px;
        width:90%;
        opacity:1;
        transition: opacity 1s ease;
    }

    .logout-box h2{
        color:#003366;
        margin-bottom:10px;
    }

    .logout-box p{
        color:#606368;
    }

</style>
</head>
<body>

<div class="logout-box" id="logoutBox">
    <h2>👋 Logged Out</h2>
    <p>You will be redirected to login page shortly...</p>
</div>

<script>
    const box = document.getElementById('logoutBox');

    // Fade out after 2 seconds
    setTimeout(()=>{
        box.style.opacity = '0';
    }, 2000);

    // Redirect after fade-out completes (~3s)
    setTimeout(()=>{
        window.location.href = 'login.php';
    }, 3000);
</script>

</body>
</html>
