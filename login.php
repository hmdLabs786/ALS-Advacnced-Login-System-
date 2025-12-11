<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - ALS</title>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap');

    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Inter", sans-serif;
    }

    body{
        width: 100%;
        height: 100vh;
        background: #f6f8fc;
        display: flex;
    }

    /* LEFT SECTION */
    .left-section{
        width: 50%;
        background: linear-gradient(to bottom right, #003366, #0059b3);
        color: white;
        padding: 60px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .left-section h1{
        font-size: 48px;
        font-weight: 700;
        margin-bottom: 20px;
        text-shadow: 0 4px 10px rgba(0,0,0,0.25);
    }

    .left-section p{
        font-size: 18px;
        line-height: 1.6;
        max-width: 450px;
        opacity: 0.9;
    }

    /* Popup styling */
    #successPopup, #errorPopup{
        position: fixed;
        top:0; left:0;
        width:100%; height:100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(0,0,0,0.5);
        visibility: hidden;
        opacity: 0;
        transition: 0.3s;
        z-index: 999;
    }

    #successPopup.active, #errorPopup.active{
        visibility: visible;
        opacity: 1;
    }

    .popup-content{
        background: #fff;
        padding: 30px 40px;
        border-radius: 15px;
        text-align: center;
        max-width: 400px;
        width: 90%;
        box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    }

    .progress-bar{
        width: 100%;
        background: #e5e7eb;
        height: 10px;
        border-radius: 10px;
        margin-top: 15px;
        overflow: hidden;
    }

    .progress-bar-fill{
        width: 0%;
        height: 100%;
        background: #1a73e8;
        border-radius: 10px;
        transition: width 0.3s;
    }

    /* RIGHT SECTION */
    .right-section{
        width: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #fff;
        padding: 30px;
    }

    .form-box{
        width: 85%;
        max-width: 450px;
    }

    .password-field {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        right: 15px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        font-size: 18px;
        user-select: none;
    }

    .form-box h2{
        font-size: 32px;
        font-weight: 700;
        color: #202124;
        margin-bottom: 5px;
    }

    .subtitle{
        color: #606368;
        margin-bottom: 25px;
        font-size: 15px;
    }

    /* GOOGLE BUTTON */
    .google-btn{
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        padding: 12px;
        border-radius: 50px;
        background: #fff;
        cursor: pointer;
        border: 1px solid #d0d7de;
        font-size: 15px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        transition: 0.22s;
    }

    .google-btn img{
        width: 20px;
    }

    .google-btn:hover{
        background: #f3f4f6;
    }

    .divider{
        margin: 25px 0;
        text-align: center;
        font-size: 14px;
        color: #999;
        position: relative;
    }

    .divider:before,
    .divider:after{
        content: "";
        width: 42%;
        height: 1px;
        background: #e5e7eb;
        position: absolute;
        top: 50%;
    }

    .divider:before{
        left: 0;
    }

    .divider:after{
        right: 0;
    }

    /* GLOWING INPUT FIELDS */
    .field{
        margin-bottom: 18px;
    }

    .field input{
        width: 100%;
        padding: 14px 18px;
        border-radius: 40px;
        border: 1px solid #ced4da;
        background: #f9fafb;
        font-size: 16px;
        transition: 0.28s;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.06);
    }

    .field input:focus{
        background: #fff;
        border-color: #1a73e8;
        box-shadow: 0 0 10px rgba(26,115,232,0.4);
        outline: none;
    }

    /* BUTTON */
    .btn input{
        width: 100%;
        padding: 15px;
        border: none;
        border-radius: 40px;
        background: #1a73e8;
        color: white;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(26,115,232,0.3);
        transition: 0.3s;
    }

    .btn input:hover{
        background: #1558b0;
        box-shadow: 0 5px 14px rgba(26,115,232,0.4);
    }

    .link{
        margin-top: 15px;
        text-align: center;
        font-size: 14px;
    }

    .link a{
        color: #1a73e8;
        text-decoration: none;
        font-weight: 600;
    }

    .link a:hover{
        text-decoration: underline;
    }

    /* ZOOM-IN ANIMATION */
    @keyframes zoomIn {
        0% {
            opacity: 0;
            transform: scale(0.8);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }

    .zoom-in {
        animation: zoomIn 0.6s ease forwards;
    }

    /* MOBILE */
    @media (max-width: 900px){
        body{
            flex-direction: column;
        }
        .left-section, .right-section{
            width: 100%;
        }
        .left-section{
            text-align: center;
            padding: 40px;
        }
    }
</style>

</head>

<body>

<!-- LEFT SIDE -->
<div class="left-section">
    <h1>Welcome Back</h1>
    <p>
        Login to access your secure ALS dashboard.  
        Your authentication is protected with enterprise-grade security.
    </p>
</div>

<!-- RIGHT SIDE -->
<div class="right-section">
    <div class="form-box zoom-in">
        
        <h2>Login</h2>
        <p class="subtitle">Welcome back! Please enter your details</p>

        <div class="google-btn">
              <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg">
              Continue with Google
          </div>
          <br>

        <form id="loginForm" method="POST" >
            <div class="field">
                <input type="text" name="email" placeholder="Email Address" required>
            </div>

            <div class="field password-field">
                <input type="password" name="password" placeholder="Password" required id="passwordInput">
                <span class="toggle-password" id="togglePassword">👁️</span>
            </div>

            <div class="link" style="margin-bottom: 10px;">
                <a href="forgot-password.php">Forgot Password?</a>
            </div>

            <div class="btn">
                <input type="submit" value="Login">
            </div>

            <div class="link">
                Not a member? <a href="signup.php">Create an account</a>
            </div>
        </form>
    </div>
</div>

<!-- SUCCESS POPUP -->
<div id="successPopup">
    <div class="popup-content">
        <h2>🎉 Welcome!</h2>
        <p id="welcomeEmail"></p>
        <div class="progress-bar">
            <div class="progress-bar-fill" id="loginProgress"></div>
        </div>
    </div>
</div>

<!-- ERROR POPUP -->
<div id="errorPopup">
    <div class="popup-content">
        <h2>❌ Login Failed!</h2>
        <p>Invalid email or password</p>
    </div>
</div>

<script>
// Password visibility toggle
const passwordInput = document.getElementById('passwordInput');
const togglePassword = document.getElementById('togglePassword');

togglePassword.addEventListener('click', () => {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
});

// Handle form submission
document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent default form submission

    const formData = new FormData(this);

    fetch('login-action.php', {
        method: 'POST',
        credentials: 'include',
        body: formData  // 🔥 VERY IMPORTANT
    })
    .then(res => res.json())
    .then(data => {
        if (data.status === 'success') {
            // Show success popup animation
            document.getElementById('welcomeEmail').textContent = `Hello, ${data.email}`;
            document.getElementById('successPopup').classList.add('active');

            let width = 0;
            const interval = setInterval(() => {
                width += 1;
                document.getElementById('loginProgress').style.width = width + '%';
                if (width >= 100) {
                    clearInterval(interval);
                    document.getElementById('successPopup').classList.remove('active');
                    // Redirect based on role after login
                    if (data.role === 'admin') {
                        window.location.href = 'admin_dashboard.php'; // Admin dashboard
                    } else {
                        window.location.href = 'user_dashboard.php'; // User dashboard
                    }
                }
            }, 30);
        } else {
            // Show error popup briefly
            document.getElementById('errorPopup').classList.add('active');
            setTimeout(() => document.getElementById('errorPopup').classList.remove('active'), 1500);
        }
    })
    .catch(err => alert("Error: " + err));
});
</script>

</body>
</html>
