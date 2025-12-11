<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Verify OTP - ALS</title>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap');

    *{ margin:0; padding:0; box-sizing:border-box; font-family:"Inter",sans-serif; }
    body{ width:100%; height:100vh; background:#f6f8fc; display:flex; }

    .left-section{
        width:50%; background:linear-gradient(to bottom right,#003366,#0059b3);
        color:white; padding:60px; display:flex; flex-direction:column; justify-content:center;
    }
    .left-section h1{ font-size:48px; margin-bottom:20px; }

    .right-section{
        width:50%; background:white; display:flex; justify-content:center; align-items:center;
    }

    /* ZOOM */
    @keyframes zoomIn {
        0%{ opacity:0; transform:scale(0.8); }
        100%{ opacity:1; transform:scale(1); }
    }
    .zoom-in{ animation:zoomIn 0.6s ease forwards; }

    .form-box{ width:85%; max-width:450px; }
    .subtitle{ margin-bottom:20px; color:#6b7280; }

    /* OTP BOXES */
    .otp-box{
        display:flex; justify-content:space-between; gap:12px; margin-bottom:25px;
    }
    .otp-box input{
        width:60px; height:60px; font-size:22px; text-align:center;
        border-radius:15px; border:1px solid #ced4da; background:#f9fafb;
        transition:0.3s;
    }
    .otp-box input:focus{
        border-color:#1a73e8;
        box-shadow:0 0 10px rgba(26,115,232,0.4);
        background:white;
    }

    .btn input{
        width:100%; padding:15px; border:none; border-radius:40px;
        background:#1a73e8; color:white; font-size:18px; cursor:pointer;
        font-weight:600;
    }

    .link{ margin-top:15px; text-align:center; }
    .link a{ color:#1a73e8; font-weight:600; }
    #successPopup, #errorPopup{
    position: fixed;
    top:0; left:0;
    width:100%; height:100%;
    display:flex; justify-content:center; align-items:center;
    background: rgba(0,0,0,0.5);
    visibility: hidden; opacity: 0;
    transition: 0.3s;
    z-index: 999;
}
#successPopup.active, #errorPopup.active{
    visibility: visible; opacity: 1;
}
.popup-content{
    background: #fff; padding: 30px 40px; border-radius: 15px;
    text-align:center; max-width: 400px; width: 90%;
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
}
.otp-timer{
    text-align:center;
    color:#1a73e8;
    font-weight:600;
    margin-bottom:15px;
    font-size:16px;
}

</style>
</head>

<body>

<!-- LEFT -->
<div class="left-section">
    <h1>Enter Verification Code</h1>
    <p>We’ve sent a 6-digit OTP to your email address.</p>
</div>

<!-- RIGHT -->
<div class="right-section">
    <div class="form-box zoom-in">
        
        <h2>Verify OTP</h2>
        <p class="subtitle">Enter the 6-digit code sent to your email</p>

        <form method="POST" action="verify-otp-action.php">

            <div class="otp-box">
                <input type="text" maxlength="1" name="otp1" required>
                <input type="text" maxlength="1" name="otp2" required>
                <input type="text" maxlength="1" name="otp3" required>
                <input type="text" maxlength="1" name="otp4" required>
                <input type="text" maxlength="1" name="otp5" required>
                <input type="text" maxlength="1" name="otp6" required>
            </div>

            <div class="btn">
                <input type="submit" value="Verify OTP">
            </div>

            <div class="link">
                Didn't receive it? <a href="#">Resend OTP</a>
            </div>

            <p class="otp-timer">OTP expires in: <span id="timer">05:00</span></p>

        </form>

    </div>
</div>
<div id="successPopup">
    <div class="popup-content">
        <h2>✅ OTP Verified!</h2>
        <p>Redirecting to reset password...</p>
    </div>
</div>

<div id="errorPopup">
    <div class="popup-content">
        <h2>❌ Invalid OTP</h2>
        <p>Please try again.</p>
    </div>
</div>

<script>
const otpForm = document.querySelector('form');
const successPopup = document.getElementById('successPopup');
const errorPopup = document.getElementById('errorPopup');

const resendLink = document.querySelector('.link a');

otpForm.addEventListener('submit', function(e){
    e.preventDefault();
    let otp = '';
    document.querySelectorAll('.otp-box input').forEach(input => otp += input.value);

    fetch('verify-otp-action.php',{
    method:'POST',
    credentials: "include",     // ⬅ THE FIX
    headers:{'Content-Type':'application/x-www-form-urlencoded'},
    body: 'otp='+otp
})
    .then(res => res.json())
    .then(data => {
        if(data.status === 'success'){
            successPopup.classList.add('active');
            setTimeout(()=> window.location.href='reset-password.php', 2000);
        } else {
            errorPopup.classList.add('active');
            setTimeout(()=> errorPopup.classList.remove('active'), 1500);
        }
    });
});

// Resend OTP
resendLink.addEventListener('click', function(e){
    e.preventDefault();
fetch('resend-otp.php', {
    credentials: "include"
})
    .then(res=>res.json())
    .then(data=>{
        if(data.status==='success'){
            alert('OTP resent to your email!');
        } else {
            alert('Failed to resend OTP.');
        }
    });
});
    const inputs = document.querySelectorAll('.otp-box input');

    inputs.forEach((input, index) => {
        
        input.addEventListener("input", () => {
            if (input.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });

        input.addEventListener("keydown", (e) => {
            if (e.key === "Backspace" && input.value === "" && index > 0) {
                inputs[index - 1].focus();
            }
        });

        // Auto paste full OTP (e.g., 123456)
        input.addEventListener("paste", (e) => {
            const data = e.clipboardData.getData("text").trim();
            if (data.length === 6 && !isNaN(data)) {
                const digits = data.split("");
                digits.forEach((digit, i) => {
                    if (inputs[i]) inputs[i].value = digit;
                });
                inputs[5].focus();
            }
            e.preventDefault();
        });
    });
    // OTP countdown timer
let timerDisplay = document.getElementById('timer');
let countdown = 300; // 5 minutes in seconds

function updateTimer() {
    let minutes = Math.floor(countdown / 60);
    let seconds = countdown % 60;
    timerDisplay.textContent = `${minutes.toString().padStart(2,'0')}:${seconds.toString().padStart(2,'0')}`;
    if(countdown <= 0){
        clearInterval(timerInterval);
        alert('OTP expired! Please resend OTP.');
    }
    countdown--;
}

let timerInterval = setInterval(updateTimer, 1000);
updateTimer(); // initial call
resendLink.addEventListener('click', function(e){
    e.preventDefault();
    fetch('resend-otp.php')
    .then(res=>res.json())
    .then(data=>{
        if(data.status==='success'){
            alert('OTP resent to your email!');
            countdown = 300; // reset 5 minutes
        } else {
            alert('Failed to resend OTP.');
        }
    });
});

</script>

</body>
</html>
