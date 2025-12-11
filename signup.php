  <!DOCTYPE html>
  <html lang="en">
  <head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Account - ALS</title>
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap');

  *{margin:0; padding:0; box-sizing:border-box; font-family:"Inter",sans-serif;}
  body{width:100%; height:100vh; display:flex; background:#f6f8fc;}

  .left-section{
      width:50%; background:linear-gradient(to bottom right,#003366,#0059b3);
      color:white; padding:60px; display:flex; flex-direction:column; justify-content:center;
  }
  .left-section h1{font-size:50px; margin-bottom:20px; text-shadow:0 4px 10px rgba(0,0,0,0.2);}
  .left-section p{font-size:18px; line-height:1.6; opacity:0.95; max-width:450px;}

  .right-section{
      width:50%; background:#fff; display:flex; justify-content:center; align-items:center; padding:30px;
  }
  .form-box{width:85%; max-width:480px; animation:zoomIn 0.6s ease;}
  .form-box h2{font-size:32px; font-weight:700; margin-bottom:5px; color:#1f1f1f;}
  .subtitle{font-size:15px; color:#6b7280; margin-bottom:25px;}

  .google-btn{
      width:100%; display:flex; align-items:center; gap:12px; background:#fff; border:1px solid #d0d7de; padding:12px;
      border-radius:50px; cursor:pointer; font-size:15px; font-weight:500; justify-content:center; transition:0.25s; box-shadow:0px 3px 6px rgba(0,0,0,0.06);
  }
  .google-btn img{width:20px;}
  .google-btn:hover{background:#f3f4f6;}
  .divider{margin:25px 0; text-align:center; color:#9ca3af; font-size:14px; position:relative;}
  .divider:before,.divider:after{content:""; position:absolute; top:50%; width:40%; height:1px; background:#e5e7eb;}
  .divider:before{left:0;}
  .divider:after{right:0;}

  .field{margin-bottom:18px; position:relative;}
  .field input{
      width:100%; padding:15px 40px 15px 18px; border:1px solid #ced4da; border-radius:40px; font-size:16px;
      background:#f9fafb; transition:0.25s; box-shadow:inset 0 2px 4px rgba(0,0,0,0.05);
  }
  .field input:focus{background:white; border-color:#1a73e8; box-shadow:0 0 10px rgba(26,115,232,0.4); outline:none;}
  .field .eye{
      position:absolute; top:50%; right:15px; transform:translateY(-50%); cursor:pointer; width:20px; opacity:0.6;
  }
  .password-strength{
      height:6px; width:100%; background:#e5e7eb; border-radius:10px; margin-top:5px;
  }
  .password-strength-fill{
      height:100%; width:0%; border-radius:10px; transition:0.3s;
  }

  .btn input{
      width:100%; padding:15px; border:none; background:#1a73e8; border-radius:40px; font-size:18px; font-weight:600; cursor:pointer; color:white; transition:0.25s; box-shadow:0 4px 12px rgba(26,115,232,0.3);
  }
  .btn input:hover{background:#1558b0; box-shadow:0 5px 14px rgba(26,115,232,0.4);}

  .link{margin-top:15px; font-size:14px; text-align:center;}
  .link a{color:#1a73e8; text-decoration:none; font-weight:600;}
  .link a:hover{text-decoration:underline;}

  @keyframes zoomIn{0%{opacity:0; transform:scale(0.8);}100%{opacity:1; transform:scale(1);}}

  #popup{position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); display:flex; justify-content:center; align-items:center; visibility:hidden;}
  #popup.active{visibility:visible;}
  .popup-content{background:#fff; padding:40px; border-radius:15px; text-align:center; width:90%; max-width:400px; box-shadow:0 8px 20px rgba(0,0,0,0.3);}
  .popup-content h2{margin-bottom:20px; font-size:24px;}
  .progress-bar{width:100%; background:#e5e7eb; height:10px; border-radius:10px; overflow:hidden; margin-top:20px;}
  .progress-bar-fill{width:0%; height:100%; background:#1a73e8; border-radius:10px; transition:width 0.3s;}
  @media(max-width:900px){body{flex-direction:column;} .left-section, .right-section{width:100%;}}
  /* Style for select field to match inputs */
.field select {
    width: 100%;
    padding: 14px 18px;
    border-radius: 40px;
    border: 1px solid #ced4da;
    background: #f9fafb;
    font-size: 16px;
    transition: 0.28s;
    box-shadow: inset 0 2px 4px rgba(0,0,0,0.06);
    appearance: none; /* Remove default arrow */
    -webkit-appearance: none;
    -moz-appearance: none;
    cursor: pointer;
    position: relative;
}

.field select:focus {
    background: #fff;
    border-color: #1a73e8;
    box-shadow: 0 0 10px rgba(26,115,232,0.4);
    outline: none;
}

/* Add a custom arrow */
.field {
    position: relative;
}

.field select::-ms-expand {
    display: none; /* Remove default arrow in IE */
}

.field::after {
    
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    pointer-events: none;
    color: #606368;
    font-size: 12px;
}
  </style>
  </head>
  <body>

  <div class="left-section">
      <h1>Welcome to ALS</h1>
      <p>Create your account and secure your access to our advanced authentication system.</p>
  </div>

  <div class="right-section">
      <div class="form-box">
          <h2>Create Account</h2>
          <p class="subtitle">Enter your details to get started</p>
          
          <div class="google-btn">
              <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg">
              Continue with Google
          </div>
          <br>
 <form id="signupForm">
    <div class="field">
        <select name="role" required>
            <option value="user" selected>User</option>
            <option value="admin">Admin</option>
        </select>
    </div>

    <div class="field">
        <input type="text" name="email" placeholder="Email Address" required>
    </div>

    <div class="field">
        <input type="password" name="password" placeholder="Password" id="password" required>
        <span class="eye" onclick="togglePassword('password')">&#128065;</span>
        <div class="password-strength"><div class="password-strength-fill" id="passwordStrength"></div></div>
    </div>

    <div class="field">
        <input type="password" name="confirm_password" placeholder="Confirm Password" id="confirm_password" required>
        <span class="eye" onclick="togglePassword('confirm_password')">&#128065;</span>
    </div>

    <div class="btn"><input type="submit" value="Sign Up"></div>
    <div class="link">Already have an account? <a href="login.php">Login here</a></div>
</form>
      </div>
  </div>

  <div id="popup">
      <div class="popup-content">
          <h2>🎉 Congratulations!</h2>
          <p>Your account has been successfully created.</p>
          <div class="progress-bar"><div class="progress-bar-fill" id="progressBar"></div></div>
      </div>
  </div>

  <script>
  // Toggle eye icon password
  function togglePassword(id){
      const input = document.getElementById(id);
      if(input.type === 'password') input.type='text';
      else input.type='password';
  }

  // Password Strength Check
  const password = document.getElementById('password');
  const confirm_password = document.getElementById('confirm_password');
  const strengthBar = document.getElementById('passwordStrength');

  password.addEventListener('input', function(){
      const val = password.value;
      let strength = 0;

      if(val.length >= 8) strength += 1;
      if(/[A-Z]/.test(val)) strength += 1;
      if(/[0-9]/.test(val)) strength += 1;
      if(/[!@#$%^&*(),.?":{}|<>]/.test(val)) strength += 1;

      let color = 'red', width = (strength/4)*100 + '%';
      if(strength <= 1) color = 'red';
      else if(strength <= 2) color = 'orange';
      else color = 'green';

      strengthBar.style.width = width;
      strengthBar.style.backgroundColor = color;
  });

  // Confirm password match
  confirm_password.addEventListener('input', function(){
      if(password.value !== confirm_password.value){
          confirm_password.style.borderColor = 'red';
      } else {
          confirm_password.style.borderColor = '#1a73e8';
      }
  });

  // Handle Signup AJAX
  document.getElementById('signupForm').addEventListener('submit', function(e){
      e.preventDefault();
      const formData = new FormData(this);

      // Validations
      if(password.value.length < 8){
          alert("Password must be at least 8 characters");
          return;
      }
      if(password.value !== confirm_password.value){
          alert("Passwords do not match!");
          return;
      }

      fetch('signup-action.php', {method:'POST', body: formData})
      .then(res=>res.text())
      .then(data=>{
          if(data.trim() === "success"){
              const popup = document.getElementById('popup');
              const bar = document.getElementById('progressBar');
              popup.classList.add('active');
              let width = 0;
              const interval = setInterval(()=>{
                  width += 1;
                  bar.style.width = width+'%';
                  if(width>=100){ clearInterval(interval); window.location.href='login.php'; }
              },30);
          }else alert(data);
      }).catch(err=>alert("Error: "+err));
  });
  </script>

  </body>
  </html>
