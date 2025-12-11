<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reset Password - ALS</title>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap');

*{ margin:0; padding:0; box-sizing:border-box; font-family:"Inter",sans-serif; }
body{ width:100%; height:100vh; background:#f6f8fc; display:flex; }

.left-section{
    width:50%; background:linear-gradient(to bottom right,#003366,#0059b3);
    color:white; padding:60px; display:flex; flex-direction:column; justify-content:center;
}

.left-section h1{ font-size:48px; margin-bottom:20px; }
.left-section p{ font-size:18px; line-height:1.6; opacity:0.9; }

.right-section{
    width:50%; background:white; display:flex; justify-content:center; align-items:center;
}

@keyframes zoomIn {
    0%{ opacity:0; transform:scale(0.8); }
    100%{ opacity:1; transform:scale(1); }
}
.zoom-in{ animation:zoomIn 0.6s ease forwards; }

.form-box{ width:85%; max-width:450px; }

.field{
    position:relative;
    margin-bottom:20px;
}
.field input{
    width:100%; padding:14px 50px 14px 18px; border-radius:40px;
    border:1px solid #ced4da; background:#f9fafb;
    transition:0.3s; font-size:16px;
}
.field input:focus{
    border-color:#1a73e8; background:white;
    box-shadow:0 0 12px rgba(26,115,232,0.4);
    outline:none;
}

/* Eye Icon */
.eye{
    position:absolute; right:15px; top:50%; transform:translateY(-50%);
    cursor:pointer; font-size:18px;
    user-select:none;
}

/* Password Strength Bar */
.password-strength{
    height:10px; width:100%; background:#e5e7eb; border-radius:10px; overflow:hidden; margin-top:8px;
}
.password-strength-fill{
    height:100%; width:0%; background:#1a73e8; border-radius:10px; transition:0.3s;
}

.btn input{
    width:100%; padding:15px; border:none; border-radius:40px;
    background:#1a73e8; color:white; font-size:18px;
    cursor:pointer; font-weight:600; transition:0.3s;
}
.btn input:hover{ background:#1558b0; }

.popup{
    position:fixed; top:0; left:0; width:100%; height:100%;
    background:rgba(0,0,0,0.5); display:flex; justify-content:center; align-items:center;
    visibility:hidden; opacity:0; transition:0.3s; z-index:999;
}
.popup.active{ visibility:visible; opacity:1; }
.popup-content{
    background:#fff; padding:30px 40px; border-radius:15px; text-align:center;
    box-shadow:0 8px 20px rgba(0,0,0,0.3);
}
</style>
</head>

<body>

<div class="left-section">
    <h1>Set New Password</h1>
    <p>Create a strong password to keep your account secure.</p>
</div>

<div class="right-section">
    <div class="form-box zoom-in">

        <h2>Reset Password</h2>
        <p class="subtitle">Enter and confirm your new password</p>

        <form id="resetForm" method="POST" action="reset-password-action.php">

            <div class="field">
                <input type="password" name="password" id="password" placeholder="New Password" required>
                <span class="eye" onclick="togglePassword('password')">&#128065;</span>
                <div class="password-strength"><div class="password-strength-fill" id="passwordStrength"></div></div>
            </div>

            <div class="field">
                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
                <span class="eye" onclick="togglePassword('confirm_password')">&#128065;</span>
            </div>

            <div class="btn">
                <input type="submit" value="Update Password">
            </div>

        </form>

    </div>
</div>

<!-- Success Popup -->
<div class="popup" id="successPopup">
    <div class="popup-content">
        <h2>🎉 Password Changed Successfully!</h2>
        <p>Redirecting to login page...</p>
    </div>
</div>

<script>
// Toggle Password Visibility
function togglePassword(id){
    const field = document.getElementById(id);
    field.type = field.type === "password" ? "text" : "password";
}

// Password Strength
const passwordField = document.getElementById('password');
const confirmField = document.getElementById('confirm_password');
const strengthFill = document.getElementById('passwordStrength');
const form = document.getElementById('resetForm');
const successPopup = document.getElementById('successPopup');

passwordField.addEventListener('input', function(){
    const val = passwordField.value;
    let strength = 0;
    if(val.length >= 8) strength = 100;
    strengthFill.style.width = strength + '%';
});

// Form Submission
form.addEventListener('submit', function(e){
    e.preventDefault();
    const password = passwordField.value;
    const confirm = confirmField.value;

    // Validate
    if(password.length < 8){
        alert("Password must be at least 8 characters");
        return;
    }
    if(password !== confirm){
        confirmField.style.borderColor = 'red';
        alert("Passwords do not match");
        return;
    } else {
        confirmField.style.borderColor = '#ced4da';
    }

    // Submit via fetch to update DB
    const formData = new FormData(form);
    fetch('reset-password-action.php', {
    method:'POST',
    credentials: "include",   //  <-- REQUIRED
    body: formData
})

    .then(res => res.json())
    .then(data=>{
        if(data.status==='success'){
            successPopup.classList.add('active');
            setTimeout(()=> window.location.href='login.php', 2000);
        } else {
            alert(data.message || "Failed to update password");
        }
    })
    .catch(err=>alert("Error: "+err));
});
</script>

</body>
</html>

