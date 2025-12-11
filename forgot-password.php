<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Forgot Password - ALS</title>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap');

    *{ margin:0; padding:0; box-sizing:border-box; font-family:"Inter",sans-serif; }
    body{ width:100%; height:100vh; background:#f6f8fc; display:flex; }

    /* LEFT */
    .left-section{
        width:50%; background:linear-gradient(to bottom right,#003366,#0059b3);
        color:white; padding:60px; display:flex; flex-direction:column; justify-content:center;
    }
    .left-section h1{ font-size:48px; font-weight:700; margin-bottom:20px; }

    /* RIGHT */
    .right-section{
        width:50%; background:white; display:flex; justify-content:center; align-items:center;
        padding:30px;
    }

    /* ZOOM-IN */
    @keyframes zoomIn {
        0%{ opacity:0; transform:scale(0.8); }
        100%{ opacity:1; transform:scale(1); }
    }
    .zoom-in { animation:zoomIn 0.6s ease forwards; }

    .form-box{ width:85%; max-width:450px; }
    .form-box h2{ font-size:32px; font-weight:700; margin-bottom:10px; }
    .subtitle{ color:#6b7280; margin-bottom:25px; }

    .field{ margin-bottom:20px; }
    .field input{
        width:100%; padding:14px 18px; border-radius:40px; border:1px solid #ced4da;
        background:#f9fafb; transition:0.3s; font-size:16px;
    }
    .field input:focus{
        background:white; border-color:#1a73e8; box-shadow:0 0 12px rgba(26,115,232,0.4);
    }

    .btn input{
        width:100%; padding:15px; border:none; border-radius:40px;
        background:#1a73e8; color:white; font-size:18px; cursor:pointer;
        font-weight:600; transition:0.3s;
    }
    .btn input:hover{ background:#1558b0; }

    .link{ margin-top:15px; text-align:center; }
    .link a{ color:#1a73e8; font-weight:600; text-decoration:none; }
</style>
</head>

<body>

<!-- LEFT -->
<div class="left-section">
    <h1>Reset Your Password</h1>
    <p>We will send you a verification code to reset your password securely.</p>
</div>

<!-- RIGHT -->
<div class="right-section">
    <div class="form-box zoom-in">

        <h2>Forgot Password</h2>
        <p class="subtitle">Enter your email to receive the OTP</p>

        <form method="POST" action="forgot-password-action.php">
            <div class="field">
                <input type="email" name="email" placeholder="Email Address" required>
            </div>

            <div class="btn">
                <input type="submit" value="Send OTP">
            </div>

            <div class="link">
                Remember your password? <a href="login.php">Login</a>
            </div>
        </form>

    </div>
</div>

</body>
</html>
