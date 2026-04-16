<!DOCTYPE html>
<html lang="en">
<?php session_start() ?>
<?php 
 include 'admin/db_connect.php';
 ob_start();
 if(!isset($_SESSION['system'])){
   $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
   foreach($system as $k => $v){
     $_SESSION['system'][$k] = $v;
   }
 }
 ob_end_flush();
 if(isset($_SESSION['login_id']))
   header("location:index.php?page=home");
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | <?php echo $_SESSION['system']['name'] ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap">
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      background: linear-gradient(135deg, #f0f4ff 0%, #e8eeff 50%, #f5f7ff 100%);
      min-height: 100vh;
    }
    .login-container {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    .login-card {
      background: #fff;
      border-radius: 20px;
      box-shadow: 0 10px 40px rgba(79, 70, 229, 0.1), 0 2px 10px rgba(0,0,0,0.05);
      width: 100%;
      max-width: 460px;
      overflow: hidden;
      animation: slideUp 0.5s ease-out;
    }
    @keyframes slideUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .login-header {
      text-align: center;
      padding: 36px 30px 20px;
    }
    .logo-icon {
      width: 64px; height: 64px;
      background: linear-gradient(135deg, #4f46e5, #6366f1);
      border-radius: 16px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 14px;
      box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
    }
    .logo-icon span {
      font-size: 28px; font-weight: 800; color: #fff;
    }
    .login-header h2 {
      font-size: 22px; font-weight: 700; color: #1e293b; margin-bottom: 4px;
    }
    .login-header p {
      font-size: 13px; color: #94a3b8;
    }

    /* Tabs */
    .login-tabs {
      display: flex;
      border-bottom: 2px solid #e2e8f0;
      margin: 0 28px;
    }
    .login-tab {
      flex: 1;
      text-align: center;
      padding: 12px 8px;
      font-size: 13px;
      font-weight: 600;
      color: #94a3b8;
      cursor: pointer;
      border-bottom: 2px solid transparent;
      margin-bottom: -2px;
      transition: all 0.2s ease;
    }
    .login-tab:hover { color: #4f46e5; }
    .login-tab.active {
      color: #4f46e5;
      border-bottom-color: #4f46e5;
    }

    /* Tab Panels */
    .tab-panel { display: none; padding: 24px 28px 28px; }
    .tab-panel.active { display: block; }

    /* Form Styles */
    .form-label {
      font-size: 12px; font-weight: 700; color: #475569;
      text-transform: uppercase; letter-spacing: 0.5px;
      margin-bottom: 6px; display: block;
    }
    .input-group-custom {
      position: relative; margin-bottom: 18px;
    }
    .input-group-custom .form-control {
      padding: 11px 14px 11px 40px;
      border: 1.5px solid #e2e8f0;
      border-radius: 10px;
      font-size: 14px;
      color: #1e293b;
      background: #f8fafc;
      transition: all 0.2s ease;
      width: 100%;
    }
    .input-group-custom .form-control:focus {
      border-color: #4f46e5;
      box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
      background: #fff;
      outline: none;
    }
    .input-group-custom .form-control::placeholder { color: #94a3b8; }
    .input-group-custom .input-icon {
      position: absolute; left: 13px; top: 50%; transform: translateY(-50%);
      color: #94a3b8; font-size: 14px; z-index: 2;
    }
    .input-group-custom .toggle-pass {
      position: absolute; right: 13px; top: 50%; transform: translateY(-50%);
      color: #94a3b8; cursor: pointer; font-size: 14px; z-index: 2;
    }
    .input-group-custom .toggle-pass:hover { color: #4f46e5; }

    .btn-login {
      width: 100%;
      padding: 12px;
      background: linear-gradient(135deg, #4f46e5, #6366f1);
      border: none;
      border-radius: 10px;
      color: #fff;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.2s ease;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }
    .btn-login:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(79, 70, 229, 0.35);
    }
    .btn-login:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }

    .form-links {
      text-align: center; margin-top: 16px; font-size: 13px; color: #94a3b8;
    }
    .form-links a {
      color: #4f46e5; font-weight: 600; text-decoration: none;
    }
    .form-links a:hover { text-decoration: underline; }

    .remember-row {
      display: flex; justify-content: space-between; align-items: center;
      margin-bottom: 18px; font-size: 13px;
    }
    .remember-row label { color: #64748b; cursor: pointer; display: flex; align-items: center; gap: 6px; }
    .remember-row label input { accent-color: #4f46e5; }
    .remember-row a { color: #4f46e5; text-decoration: none; font-weight: 500; }
    .remember-row a:hover { text-decoration: underline; }

    .alert-custom {
      padding: 10px 14px; border-radius: 10px; font-size: 13px;
      display: flex; align-items: center; gap: 8px; margin-bottom: 14px;
    }
    .alert-danger-custom { background: #fef2f2; border: 1px solid #fecaca; color: #dc2626; }
    .alert-success-custom { background: #f0fdf4; border: 1px solid #bbf7d0; color: #16a34a; }

    /* Signup form columns */
    .signup-cols { display: flex; gap: 16px; }
    .signup-cols .signup-col { flex: 1; }
    @media (max-width: 576px) { .signup-cols { flex-direction: column; gap: 0; } }

    .login-footer {
      text-align: center; padding: 16px 28px 24px;
      border-top: 1px solid #f1f5f9;
    }
    .login-footer p { color: #94a3b8; font-size: 12px; margin: 0; }

    .spinner { display: inline-block; width: 16px; height: 16px; border: 2px solid rgba(255,255,255,0.3); border-top-color: #fff; border-radius: 50%; animation: spin 0.6s linear infinite; }
    @keyframes spin { to { transform: rotate(360deg); } }
  </style>
</head>
<body>
<div class="login-container">
  <div class="login-card">
    <div class="login-header">
      <div class="logo-icon"><span>L</span></div>
      <h2><?php echo $_SESSION['system']['name'] ?></h2>
      <p>Secure sign in for users and administrators.</p>
    </div>

    <!-- Tabs -->
    <div class="login-tabs">
      <div class="login-tab active" data-tab="user">User</div>
      <div class="login-tab" data-tab="admin">Admin</div>
      <div class="login-tab" data-tab="signup">Sign Up</div>
      <div class="login-tab" data-tab="forgot">Forgot</div>
    </div>

    <!-- User Login Panel -->
    <div class="tab-panel active" id="panel-user">
      <form id="user-login-form" autocomplete="off">
        <div id="user-alert"></div>
        <label class="form-label">Email Address</label>
        <div class="input-group-custom">
          <i class="fas fa-envelope input-icon"></i>
          <input type="email" class="form-control" name="email" placeholder="your@email.com" required>
        </div>
        <label class="form-label">Password</label>
        <div class="input-group-custom">
          <i class="fas fa-lock input-icon"></i>
          <input type="password" class="form-control" name="password" id="user-pass" placeholder="Enter your password" required>
          <span class="toggle-pass" onclick="togglePass('user-pass', this)"><i class="fas fa-eye"></i></span>
        </div>
        <div class="remember-row">
          <label><input type="checkbox"> Remember me</label>
          <a href="javascript:void(0)" onclick="switchTab('forgot')">Forgot password</a>
        </div>
        <button type="submit" class="btn-login" id="userLoginBtn">
          <i class="fas fa-sign-in-alt"></i> Sign In
        </button>
        <div class="form-links">
          Need an account? <a href="javascript:void(0)" onclick="switchTab('signup')">Sign up</a> &middot; <a href="javascript:void(0)" onclick="switchTab('forgot')">Forgot password</a>
        </div>
      </form>
    </div>

    <!-- Admin Login Panel -->
    <div class="tab-panel" id="panel-admin">
      <form id="admin-login-form" autocomplete="off">
        <div id="admin-alert"></div>
        <label class="form-label">Username</label>
        <div class="input-group-custom">
          <i class="fas fa-user-shield input-icon"></i>
          <input type="text" class="form-control" name="username" placeholder="Admin username" required>
        </div>
        <label class="form-label">Password</label>
        <div class="input-group-custom">
          <i class="fas fa-lock input-icon"></i>
          <input type="password" class="form-control" name="password" id="admin-pass" placeholder="Admin password" required>
          <span class="toggle-pass" onclick="togglePass('admin-pass', this)"><i class="fas fa-eye"></i></span>
        </div>
        <button type="submit" class="btn-login" id="adminLoginBtn">
          <i class="fas fa-sign-in-alt"></i> Admin Sign In
        </button>
      </form>
    </div>

    <!-- Sign Up Panel -->
    <div class="tab-panel" id="panel-signup">
      <form id="signup-form" autocomplete="off">
        <div id="signup-alert"></div>
        <div class="signup-cols">
          <div class="signup-col">
            <label class="form-label">First Name</label>
            <div class="input-group-custom">
              <i class="fas fa-user input-icon"></i>
              <input type="text" class="form-control" name="firstname" placeholder="First name" required>
            </div>
            <label class="form-label">Last Name</label>
            <div class="input-group-custom">
              <i class="fas fa-user input-icon"></i>
              <input type="text" class="form-control" name="lastname" placeholder="Last name" required>
            </div>
            <label class="form-label">Contact</label>
            <div class="input-group-custom">
              <i class="fas fa-phone input-icon"></i>
              <input type="text" class="form-control" name="contact" placeholder="Phone number" required>
            </div>
          </div>
          <div class="signup-col">
            <label class="form-label">Email</label>
            <div class="input-group-custom">
              <i class="fas fa-envelope input-icon"></i>
              <input type="email" class="form-control" name="email" placeholder="your@email.com" required>
            </div>
            <label class="form-label">Password</label>
            <div class="input-group-custom">
              <i class="fas fa-lock input-icon"></i>
              <input type="password" class="form-control" name="password" id="signup-pass" placeholder="Create password" required>
            </div>
            <label class="form-label">Confirm Password</label>
            <div class="input-group-custom">
              <i class="fas fa-lock input-icon"></i>
              <input type="password" class="form-control" name="cpass" id="signup-cpass" placeholder="Confirm password" required>
            </div>
          </div>
        </div>
        <label class="form-label">Address</label>
        <div class="input-group-custom">
          <i class="fas fa-map-marker-alt input-icon"></i>
          <input type="text" class="form-control" name="address" placeholder="Your address" required>
        </div>
        <small id="signup-pass-match" style="display:block;margin-bottom:10px;"></small>
        <button type="submit" class="btn-login" id="signupBtn">
          <i class="fas fa-user-plus"></i> Create Account
        </button>
        <div class="form-links">
          Already have an account? <a href="javascript:void(0)" onclick="switchTab('user')">Sign in</a>
        </div>
      </form>
    </div>

    <!-- Forgot Password Panel -->
    <div class="tab-panel" id="panel-forgot">
      <form id="forgot-form" autocomplete="off">
        <div id="forgot-alert"></div>
        <p style="color:#64748b;font-size:13px;margin-bottom:16px;">Enter your email address and we will send you a password reset link.</p>
        <label class="form-label">Email Address</label>
        <div class="input-group-custom">
          <i class="fas fa-envelope input-icon"></i>
          <input type="email" class="form-control" name="email" placeholder="your@email.com" required>
        </div>
        <button type="submit" class="btn-login" id="forgotBtn">
          <i class="fas fa-paper-plane"></i> Send Reset Link
        </button>
        <div class="form-links">
          Remember your password? <a href="javascript:void(0)" onclick="switchTab('user')">Sign in</a>
        </div>
      </form>
    </div>

    <div class="login-footer">
      <p>&copy; <?php echo date('Y') ?> <?php echo $_SESSION['system']['name'] ?> &mdash; Secure login portal.</p>
    </div>
  </div>
</div>

<script>
function switchTab(tab) {
  $('.login-tab').removeClass('active');
  $('.login-tab[data-tab="'+tab+'"]').addClass('active');
  $('.tab-panel').removeClass('active');
  $('#panel-'+tab).addClass('active');
}
$('.login-tab').click(function(){ switchTab($(this).data('tab')); });

function togglePass(id, el) {
  var inp = document.getElementById(id);
  var icon = el.querySelector('i');
  if(inp.type === 'password') { inp.type = 'text'; icon.className = 'fas fa-eye-slash'; }
  else { inp.type = 'password'; icon.className = 'fas fa-eye'; }
}

// User Login
$('#user-login-form').submit(function(e){
  e.preventDefault();
  var $btn = $('#userLoginBtn');
  $('#user-alert').html('');
  $btn.html('<span class="spinner"></span> Signing in...').prop('disabled', true);
  $.ajax({
    url: 'admin/ajax.php?action=login2',
    method: 'POST',
    data: $(this).serialize(),
    success: function(resp){
      if(resp == 1){
        $btn.html('<i class="fas fa-check"></i> Success!');
        setTimeout(function(){ location.href = 'index.php?page=home'; }, 400);
      } else {
        $('#user-alert').html('<div class="alert-custom alert-danger-custom"><i class="fas fa-exclamation-circle"></i> Invalid email or password.</div>');
        $btn.html('<i class="fas fa-sign-in-alt"></i> Sign In').prop('disabled', false);
      }
    },
    error: function(){
      $('#user-alert').html('<div class="alert-custom alert-danger-custom"><i class="fas fa-exclamation-circle"></i> Connection error. Try again.</div>');
      $btn.html('<i class="fas fa-sign-in-alt"></i> Sign In').prop('disabled', false);
    }
  });
});

// Admin Login
$('#admin-login-form').submit(function(e){
  e.preventDefault();
  var $btn = $('#adminLoginBtn');
  $('#admin-alert').html('');
  $btn.html('<span class="spinner"></span> Signing in...').prop('disabled', true);
  $.ajax({
    url: 'admin/ajax.php?action=login',
    method: 'POST',
    data: $(this).serialize(),
    success: function(resp){
      if(resp == 1){
        $btn.html('<i class="fas fa-check"></i> Success!');
        setTimeout(function(){ location.href = 'admin/index.php?page=home'; }, 400);
      } else {
        $('#admin-alert').html('<div class="alert-custom alert-danger-custom"><i class="fas fa-exclamation-circle"></i> Invalid credentials.</div>');
        $btn.html('<i class="fas fa-sign-in-alt"></i> Admin Sign In').prop('disabled', false);
      }
    },
    error: function(){
      $('#admin-alert').html('<div class="alert-custom alert-danger-custom"><i class="fas fa-exclamation-circle"></i> Connection error.</div>');
      $btn.html('<i class="fas fa-sign-in-alt"></i> Admin Sign In').prop('disabled', false);
    }
  });
});

// Sign Up
$('#signup-form [name="cpass"], #signup-form [name="password"]').keyup(function(){
  var p = $('#signup-pass').val(), c = $('#signup-cpass').val();
  if(p && c){
    if(p === c) $('#signup-pass-match').html('<span style="color:#16a34a;font-size:12px;"><i class="fas fa-check"></i> Passwords match</span>');
    else $('#signup-pass-match').html('<span style="color:#dc2626;font-size:12px;"><i class="fas fa-times"></i> Passwords do not match</span>');
  } else { $('#signup-pass-match').html(''); }
});

$('#signup-form').submit(function(e){
  e.preventDefault();
  var $btn = $('#signupBtn');
  $('#signup-alert').html('');
  if($('#signup-pass').val() !== $('#signup-cpass').val()){
    $('#signup-alert').html('<div class="alert-custom alert-danger-custom"><i class="fas fa-exclamation-circle"></i> Passwords do not match.</div>');
    return;
  }
  $btn.html('<span class="spinner"></span> Creating account...').prop('disabled', true);
  $.ajax({
    url: 'admin/ajax.php?action=signup',
    data: new FormData($(this)[0]),
    cache: false, contentType: false, processData: false, method: 'POST',
    success: function(resp){
      if(resp == 1){
        $('#signup-alert').html('<div class="alert-custom alert-success-custom"><i class="fas fa-check-circle"></i> Account created! Redirecting...</div>');
        setTimeout(function(){ location.href = 'index.php?page=home'; }, 700);
      } else if(resp == 2){
        $('#signup-alert').html('<div class="alert-custom alert-danger-custom"><i class="fas fa-exclamation-circle"></i> Email already exists.</div>');
        $btn.html('<i class="fas fa-user-plus"></i> Create Account').prop('disabled', false);
      }
    },
    error: function(){
      $('#signup-alert').html('<div class="alert-custom alert-danger-custom"><i class="fas fa-exclamation-circle"></i> Connection error.</div>');
      $btn.html('<i class="fas fa-user-plus"></i> Create Account').prop('disabled', false);
    }
  });
});

// Forgot Password
$('#forgot-form').submit(function(e){
  e.preventDefault();
  var $btn = $('#forgotBtn');
  $('#forgot-alert').html('');
  $btn.html('<span class="spinner"></span> Sending...').prop('disabled', true);
  $.ajax({
    url: 'admin/ajax.php?action=forgot_password',
    method: 'POST',
    data: $(this).serialize(),
    dataType: 'json',
    success: function(resp){
      if(resp && resp.status === 'success'){
        $('#forgot-alert').html('<div class="alert-custom alert-success-custom"><i class="fas fa-check-circle"></i> '+resp.message+'</div>');
        $('#forgot-form')[0].reset();
      } else {
        var msg = (resp && resp.message) ? resp.message : 'Something went wrong.';
        $('#forgot-alert').html('<div class="alert-custom alert-danger-custom"><i class="fas fa-exclamation-circle"></i> '+msg+'</div>');
      }
      $btn.html('<i class="fas fa-paper-plane"></i> Send Reset Link').prop('disabled', false);
    },
    error: function(){
      $('#forgot-alert').html('<div class="alert-custom alert-danger-custom"><i class="fas fa-exclamation-circle"></i> Server error.</div>');
      $btn.html('<i class="fas fa-paper-plane"></i> Send Reset Link').prop('disabled', false);
    }
  });
});
</script>
</body>
</html>