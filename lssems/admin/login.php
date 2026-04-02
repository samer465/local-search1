<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
ob_start();
if(!isset($_SESSION['system'])){
  $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
  foreach($system as $k => $v){
    $_SESSION['system'][$k] = $v;
  }
}
ob_end_flush();
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Login | <?php echo $_SESSION['system']['name'] ?></title>
  <?php include('./header.php'); ?>
  <?php 
  if(isset($_SESSION['login_id']))
  header("location:index.php?page=home");
  ?>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      position: relative;
    }
    
    /* Animated Background */
    .bg-animation {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 0;
    }
    
    .bg-animation .circle {
      position: absolute;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 50%;
      animation: float 20s infinite;
    }
    
    @keyframes float {
      0%, 100% { transform: translateY(0) rotate(0deg); }
      50% { transform: translateY(-50px) rotate(180deg); }
    }
    
    .login-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      z-index: 1;
      padding: 20px;
    }
    
    .login-card {
      background: rgba(255, 255, 255, 0.98);
      backdrop-filter: blur(10px);
      border-radius: 24px;
      box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
      width: 100%;
      max-width: 440px;
      overflow: hidden;
      animation: slideUp 0.5s ease-out;
    }
    
    @keyframes slideUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .login-header {
      text-align: center;
      padding: 40px 30px 20px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
    
    .login-header h1 {
      font-size: 28px;
      font-weight: 700;
      color: white;
      margin-bottom: 8px;
    }
    
    .login-header p {
      color: rgba(255, 255, 255, 0.9);
      font-size: 14px;
    }
    
    .login-body {
      padding: 40px;
    }
    
    .form-group {
      margin-bottom: 24px;
    }
    
    .form-group label {
      display: block;
      margin-bottom: 8px;
      color: #333;
      font-weight: 500;
      font-size: 14px;
    }
    
    .form-group input {
      width: 100%;
      padding: 12px 16px;
      border: 2px solid #e0e0e0;
      border-radius: 12px;
      font-size: 14px;
      transition: all 0.3s ease;
      outline: none;
      font-family: inherit;
    }
    
    .form-group input:focus {
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }
    
    .form-group input.error {
      border-color: #f56565;
    }
    
    .error-message {
      color: #f56565;
      font-size: 12px;
      margin-top: 6px;
      display: none;
    }
    
    .form-options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 24px;
      font-size: 14px;
    }
    
    .checkbox {
      display: flex;
      align-items: center;
      cursor: pointer;
    }
    
    .checkbox input {
      margin-right: 8px;
      cursor: pointer;
      width: 16px;
      height: 16px;
    }
    
    .checkbox span {
      color: #666;
    }
    
    .forgot-link {
      color: #667eea;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s ease;
    }
    
    .forgot-link:hover {
      color: #764ba2;
    }
    
    .login-btn {
      width: 100%;
      padding: 14px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border: none;
      border-radius: 12px;
      color: white;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
      position: relative;
      overflow: hidden;
    }
    
    .login-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 25px rgba(102, 126, 234, 0.3);
    }
    
    .login-btn:active {
      transform: translateY(0);
    }
    
    .login-btn.loading {
      opacity: 0.8;
      cursor: not-allowed;
    }
    
    .spinner {
      display: inline-block;
      width: 18px;
      height: 18px;
      border: 2px solid rgba(255, 255, 255, 0.3);
      border-top-color: white;
      border-radius: 50%;
      animation: spin 0.6s linear infinite;
      margin-right: 8px;
      vertical-align: middle;
    }
    
    @keyframes spin {
      to { transform: rotate(360deg); }
    }
    
    .login-footer {
      text-align: center;
      padding: 20px 40px 30px;
      border-top: 1px solid #f0f0f0;
      background: #fafafa;
    }
    
    .login-footer p {
      color: #888;
      font-size: 12px;
    }
    
    /* Alert Styles */
    .alert-custom {
      padding: 12px 16px;
      border-radius: 12px;
      margin-bottom: 24px;
      font-size: 14px;
      display: flex;
      align-items: center;
      gap: 10px;
      animation: shake 0.5s ease;
    }
    
    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      25% { transform: translateX(-5px); }
      75% { transform: translateX(5px); }
    }
    
    .alert-danger-custom {
      background: #fed7d7;
      border-left: 4px solid #f56565;
      color: #c53030;
    }
    
    .alert-success-custom {
      background: #c6f6d5;
      border-left: 4px solid #48bb78;
      color: #22543d;
    }
    
    /* Password Strength Meter */
    .password-strength {
      margin-top: 8px;
      height: 4px;
      background: #e0e0e0;
      border-radius: 2px;
      overflow: hidden;
    }
    
    .strength-bar {
      height: 100%;
      width: 0%;
      transition: all 0.3s ease;
      border-radius: 2px;
    }
    
    .strength-text {
      font-size: 11px;
      margin-top: 6px;
      display: none;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
      .login-card {
        max-width: 95%;
      }
      .login-body {
        padding: 30px 20px;
      }
    }
    
    /* Tooltip */
    .tooltip {
      position: relative;
      display: inline-block;
    }
    
    .tooltip .tooltip-text {
      visibility: hidden;
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 5px 10px;
      border-radius: 6px;
      position: absolute;
      z-index: 1;
      bottom: 125%;
      left: 50%;
      transform: translateX(-50%);
      white-space: nowrap;
      font-size: 12px;
      opacity: 0;
      transition: opacity 0.3s;
    }
    
    .tooltip:hover .tooltip-text {
      visibility: visible;
      opacity: 1;
    }
  </style>
</head>
<body>
  <div class="bg-animation">
    <div class="circle" style="width: 300px; height: 300px; top: -100px; left: -100px; animation-duration: 25s;"></div>
    <div class="circle" style="width: 200px; height: 200px; bottom: -50px; right: -50px; animation-duration: 20s;"></div>
    <div class="circle" style="width: 150px; height: 150px; top: 50%; left: 10%; animation-duration: 30s;"></div>
    <div class="circle" style="width: 250px; height: 250px; bottom: 20%; right: 10%; animation-duration: 22s;"></div>
  </div>
  
  <div class="login-container">
    <div class="login-card">
      <div class="login-header">
        <h1><?php echo $_SESSION['system']['name'] ?></h1>
        <p>Welcome back! Please login to your account</p>
      </div>
      
      <div class="login-body">
        <form id="login-form">
          <div id="alert-message"></div>
          
          <div class="form-group">
            <label>Username or Email</label>
            <input type="text" id="username" name="username" placeholder="Enter your username or email" required autocomplete="off">
            <div class="error-message" id="username-error">Username is required</div>
          </div>
          
          <div class="form-group">
            <label>Password</label>
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <div class="password-strength">
              <div class="strength-bar" id="strength-bar"></div>
            </div>
            <div class="strength-text" id="strength-text"></div>
            <div class="error-message" id="password-error">Password is required</div>
          </div>
          
          <div class="form-options">
            <label class="checkbox">
              <input type="checkbox" name="remember" id="remember">
              <span>Remember me</span>
            </label>
            <a href="#" class="forgot-link tooltip" id="forgot-link">
              Forgot Password?
              <span class="tooltip-text">Contact administrator</span>
            </a>
          </div>
          
          <button type="submit" class="login-btn" id="login-btn">
            Sign In
          </button>
        </form>
      </div>
      
      <div class="login-footer">
        <p>&copy; <?php echo date('Y'); ?> <?php echo $_SESSION['system']['name'] ?> - All Rights Reserved</p>
        <p style="margin-top: 8px;">Secure Admin Access</p>
      </div>
    </div>
  </div>

  <script>
    // Password strength meter
    function checkPasswordStrength(password) {
      const strengthBar = document.getElementById('strength-bar');
      const strengthText = document.getElementById('strength-text');
      
      if (!password) {
        strengthBar.style.width = '0%';
        strengthBar.style.background = '#e0e0e0';
        strengthText.style.display = 'none';
        return;
      }
      
      strengthText.style.display = 'block';
      
      let strength = 0;
      
      if (password.length >= 8) strength++;
      if (password.match(/[a-z]+/)) strength++;
      if (password.match(/[A-Z]+/)) strength++;
      if (password.match(/[0-9]+/)) strength++;
      if (password.match(/[$@#&!]+/)) strength++;
      
      const strengths = {
        0: { width: '20%', color: '#f56565', text: 'Very Weak' },
        1: { width: '40%', color: '#ed8936', text: 'Weak' },
        2: { width: '60%', color: '#ecc94b', text: 'Fair' },
        3: { width: '80%', color: '#48bb78', text: 'Good' },
        4: { width: '100%', color: '#38a169', text: 'Strong' },
        5: { width: '100%', color: '#2f855a', text: 'Very Strong' }
      };
      
      const level = strengths[strength] || strengths[0];
      strengthBar.style.width = level.width;
      strengthBar.style.background = level.color;
      strengthText.textContent = `Password strength: ${level.text}`;
      strengthText.style.color = level.color;
    }
    
    // Real-time validation
    document.getElementById('password').addEventListener('input', function(e) {
      checkPasswordStrength(e.target.value);
      
      if (e.target.value) {
        document.getElementById('password-error').style.display = 'none';
        e.target.classList.remove('error');
      }
    });
    
    document.getElementById('username').addEventListener('input', function(e) {
      if (e.target.value.trim()) {
        document.getElementById('username-error').style.display = 'none';
        e.target.classList.remove('error');
      }
    });
    
    // Forgot password handler
    document.getElementById('forgot-link').addEventListener('click', function(e) {
      e.preventDefault();
      showAlert('Please contact the system administrator to reset your password.', 'info');
    });
    
    function showAlert(message, type) {
      const alertDiv = document.getElementById('alert-message');
      const alertClass = type === 'info' ? 'alert-success-custom' : 'alert-danger-custom';
      alertDiv.innerHTML = `<div class="alert-custom ${alertClass}">${message}</div>`;
      
      setTimeout(() => {
        alertDiv.innerHTML = '';
      }, 5000);
    }
    
    // Track login attempts (security feature)
    let loginAttempts = 0;
    const maxAttempts = 5;
    
    // Handle form submission
    $('#login-form').submit(function(e) {
      e.preventDefault();
      
      const $btn = $('#login-btn');
      const $alert = $('#alert-message');
      let isValid = true;
      
      $alert.html('');
      
      const username = $('#username').val().trim();
      const password = $('#password').val().trim();
      
      // Real-time validation
      if (!username) {
        $('#username-error').show();
        $('#username').addClass('error');
        isValid = false;
      } else {
        $('#username-error').hide();
        $('#username').removeClass('error');
      }
      
      if (!password) {
        $('#password-error').show();
        $('#password').addClass('error');
        isValid = false;
      } else {
        $('#password-error').hide();
        $('#password').removeClass('error');
      }
      
      if (!isValid) {
        return false;
      }
      
      // Check login attempts
      if (loginAttempts >= maxAttempts) {
        showAlert('Too many failed attempts. Please try again after 5 minutes.', 'error');
        $btn.prop('disabled', true);
        setTimeout(() => {
          loginAttempts = 0;
          $btn.prop('disabled', false);
        }, 300000);
        return false;
      }
      
      // Show loading state
      $btn.html('<span class="spinner"></span> Authenticating...').addClass('loading');
      $btn.prop('disabled', true);
      
      $.ajax({
        url: 'ajax.php?action=login',
        method: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        success: function(resp) {
          if (resp == 1) {
            // Success - redirect to dashboard
            $btn.html('✓ Redirecting...');
            showAlert('Login successful! Redirecting to dashboard...', 'success');
            setTimeout(function() {
              location.href = 'index.php?page=home';
            }, 800);
          } else {
            // Error - increment attempts
            loginAttempts++;
            const remaining = maxAttempts - loginAttempts;
            let message = 'Invalid username or password.';
            if (remaining > 0) {
              message += ` ${remaining} attempt(s) remaining.`;
            } else {
              message += ' Account temporarily locked.';
            }
            showAlert(message, 'error');
            $btn.html('Sign In').removeClass('loading');
            $btn.prop('disabled', false);
            
            // Shake animation
            $('.login-card').css('animation', 'shake 0.5s ease');
            setTimeout(function() {
              $('.login-card').css('animation', '');
            }, 500);
            
            // Clear password field
            $('#password').val('');
          }
        },
        error: function(err) {
          showAlert('Connection error. Please check your internet connection and try again.', 'error');
          $btn.html('Sign In').removeClass('loading');
          $btn.prop('disabled', false);
        }
      });
      
      return false;
    });
    
    // Enter key press
    $('#password, #username').keypress(function(e) {
      if (e.which == 13) {
        $('#login-form').submit();
      }
    });
    
    // Add CSS for shake animation
    $('head').append(`
      <style>
        @keyframes shake {
          0%, 100% { transform: translateX(0); }
          25% { transform: translateX(-8px); }
          75% { transform: translateX(8px); }
        }
      </style>
    `);
    
    // Check for saved credentials
    if (localStorage.getItem('remembered_user')) {
      $('#username').val(localStorage.getItem('remembered_user'));
      $('#remember').prop('checked', true);
    }
    
    // Save credentials if remember me is checked
    $('#login-form').on('submit', function() {
      if ($('#remember').is(':checked')) {
        localStorage.setItem('remembered_user', $('#username').val());
      } else {
        localStorage.removeItem('remembered_user');
      }
    });
  </script>
</body>
</html>