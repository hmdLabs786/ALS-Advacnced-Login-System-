<?php
session_start();

// Session check
if(!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'user'){
    header("Location: login.php");
    exit();
}

// Prevent back navigation
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
error_log("DASHBOARD SESSION ID: " . session_id());
error_log("DASHBOARD USER ID: " . ($_SESSION['user_id'] ?? "NOT SET"));

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Dashboard - ALS</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap');

body{
    font-family: 'Inter', sans-serif;
    margin:0; padding:0;
    background: #f6f8fc;
}

/* HEADER */
header{
    background: #003366;
    color: white;
    padding: 20px 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 8px rgba(0,0,0,0.15);
}

header h1{ 
    font-size: 24px; 
}

header form input{
    padding: 10px 20px;
    border:none;
    border-radius: 25px;
    background: #1a73e8;
    color:white;
    cursor:pointer;
    font-weight:600;
    transition:0.3s;
}
header form input:hover{ 
    background:#1558b0; 
}

/* SIDEBAR */
.sidebar{
    width:200px;
    background: #0059b3;
    color:white;
    position: fixed;
    top:70px;
    bottom:0;
    left:0;
    padding-top:20px;
    display:flex;
    flex-direction: column;
    gap:5px;
}

.sidebar a{
    display:flex;
    align-items:center;
    gap:10px;
    color:white;
    padding:15px 20px;
    text-decoration:none;
    font-weight:500;
    border-radius: 8px;
    transition:0.3s;
}
.sidebar a:hover{ 
    background:#003f7f; 
}

/* MAIN CONTENT */
.main-content{
    margin-left:200px;
    padding:30px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

/* CARD */
.card{
    background:white;
    padding:25px 20px;
    border-radius:15px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    transition: transform 0.3s, box-shadow 0.3s;
}
.card:hover{
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.12);
}

.card h3{ 
    margin-bottom:15px; 
    color:#003366; 
    font-size:20px;
}
.card p{ 
    color:#606368; 
    font-size:16px;
}

/* RESPONSIVE */
@media(max-width:768px){
    .sidebar{ 
        width:100%; 
        height:auto; 
        position:relative; 
        flex-direction:row; 
        justify-content:space-around;
    }
    .main-content{ 
        margin-left:0; 
        padding:20px;
        grid-template-columns: 1fr;
    }
}
</style>
</head>
<body>

<header>
    <h1>User Dashboard</h1>
    <form method="POST" action="logout.php">
        <input type="submit" value="Logout">
    </form>
</header>

<div class="sidebar">
    <a href="#"><span>🏠</span> Dashboard</a>
    <a href="#"><span>📄</span> My Profile</a>
    <a href="#"><span>📝</span> My Tasks</a>
    <a href="#"><span>⚙️</span> Settings</a>
</div>

<div class="main-content">
    <div class="card">
        <h3>Welcome Back</h3>
        <p>Hello, <?php echo htmlspecialchars($_SESSION['user_id']); ?>! Here's your summary.</p>
    </div>
    <div class="card">
        <h3>Pending Tasks</h3>
        <p>You have 4 tasks pending today.</p>
    </div>
    <div class="card">
        <h3>Messages</h3>
        <p>2 new messages from admin.</p>
    </div>
    <div class="card">
        <h3>Account Status</h3>
        <p>Your subscription is active.</p>
    </div>
</div>

</body>
</html>
