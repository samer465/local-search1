<!DOCTYPE html>
<html lang="en">
<?php session_start() ?>
<?php 
  if(!isset($_SESSION['login_id']))
  header('location:login.php');
 include 'admin/db_connect.php';
    ob_start();
  if(!isset($_SESSION['system'])){

    $system = $conn->query("SELECT * FROM system_settings")->fetch_array();
    foreach($system as $k => $v){
      $_SESSION['system'][$k] = $v;
    }
  }
  ob_end_flush();
  include 'header.php' ;
?>
<head>
    <style>
        /* Professional Login Page - Red & Black Theme */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #1a1a1a 0%, #2c2c2c 100%);
            font-family: 'Poppins', 'Segoe UI', 'Source Sans Pro', sans-serif;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }
        
        /* Animated Background Effect */
        body::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 20% 50%, rgba(192, 57, 43, 0.15) 0%, transparent 50%);
            animation: pulse 8s ease-in-out infinite;
        }
        
        body::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 80% 80%, rgba(192, 57, 43, 0.1) 0%, transparent 50%);
            animation: pulse 10s ease-in-out infinite reverse;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 0.6; transform: scale(1.05); }
        }
        
        /* Login Container */
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 1;
            padding: 20px;
        }
        
        /* Login Card */
        .login-card {
            background: rgba(26, 26, 26, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 30px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 450px;
            overflow: hidden;
            position: relative;
            border: 1px solid rgba(192, 57, 43, 0.3);
            animation: slideUp 0.6s ease-out;
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
        
        /* Red Top Border Animation */
        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #c0392b, #e74c3c, #c0392b);
            background-size: 200% 100%;
            animation: shimmer 3s ease-in-out infinite;
        }
        
        @keyframes shimmer {
            0%, 100% { background-position: -200% 0; }
            50% { background-position: 200% 0; }
        }
        
        /* Logo Section */
        .login-logo {
            text-align: center;
            padding: 40px 30px 20px;
            position: relative;
        }
        
        .logo-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            animation: bounce 2s ease-in-out infinite;
            box-shadow: 0 10px 25px rgba(192, 57, 43, 0.3);
        }
        
        @keyframes bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }
        
        .logo-icon i {
            font-size: 40px;
            color: white;
        }
        
        .login-logo a {
            font-size: 28px;
            font-weight: 800;
            background: linear-gradient(135deg, #ffffff, #e0e0e0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-decoration: none;
        }
        
        .login-subtitle {
            text-align: center;
            color: #888;
            font-size: 14px;
            margin-top: 8px;
        }
        
        /* Card Body */
        .login-card-body {
            padding: 20px 40px 40px;
        }
        
        /* Form Groups */
        .input-group {
            position: relative;
            margin-bottom: 25px;
            display: flex;
            align-items: center;
        }
        
        .form-control {
            width: 100%;
            padding: 14px 45px 14px 45px;
            background: rgba(255, 255, 255, 0.05);
            border: 2px solid rgba(192, 57, 43, 0.3);
            border-radius: 12px;
            font-size: 14px;
            color: white;
            transition: all 0.3s ease;
            outline: none;
        }
        
        .form-control:focus {
            border-color: #c0392b;
            box-shadow: 0 0 0 3px rgba(192, 57, 43, 0.1);
            background: rgba(255, 255, 255, 0.08);
        }
        
        .form-control::placeholder {
            color: #888;
        }
        
        .input-group-text {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            color: #c0392b;
            padding: 0;
            z-index: 1;
        }
        
        .input-group-text i {
            font-size: 18px;
        }
        
        /* Password Toggle */
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
            transition: color 0.3s ease;
            z-index: 1;
        }
        
        .password-toggle:hover {
            color: #c0392b;
        }
        
        /* Remember Me Row */
        .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .icheck-primary {
            display: flex;
            align-items: center;
            cursor: pointer;
        }
        
        .icheck-primary input {
            margin-right: 8px;
            cursor: pointer;
            accent-color: #c0392b;
            width: 16px;
            height: 16px;
        }
        
        .icheck-primary label {
            color: #aaa;
            font-size: 13px;
            cursor: pointer;
            margin: 0;
        }
        
        .forgot-link {
            color: #c0392b;
            text-decoration: none;
            font-size: 13px;
            transition: color 0.3s ease;
        }
        
        .forgot-link:hover {
            color: #e74c3c;
            text-decoration: underline;
        }
        
        /* Login Button */
        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #c0392b, #e74c3c);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(192, 57, 43, 0.4);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .btn-login i {
            font-size: 16px;
        }
        
        /* Loading State */
        .btn-login.loading {
            opacity: 0.7;
            cursor: not-allowed;
        }
        
        .spinner {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* Alert Messages */
        .alert {
            padding: 12px 15px;
            border-radius: 12px;
            margin-bottom: 20px;
            font-size: 13px;
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
        
        .alert-danger {
            background: rgba(220, 53, 69, 0.2);
            border-left: 3px solid #dc3545;
            color: #ff6b6b;
        }
        
        .alert-danger i {
            color: #dc3545;
        }
        
        .alert-success {
            background: rgba(40, 167, 69, 0.2);
            border-left: 3px solid #28a745;
            color: #6bff6b;
        }
        
        /* Footer */
        .login-footer {
            text-align: center;
            padding: 20px 30px 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .login-footer p {
            color: #666;
            font-size: 12px;
            margin: 0;
        }
        
        .login-footer a {
            color: #c0392b;
            text-decoration: none;
        }
        
        .login-footer a:hover {
            text-decoration: underline;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .login-card {
                max-width: 95%;
            }
            
            .login-card-body {
                padding: 20px 25px 35px;
            }
            
            .login-logo {
                padding: 30px 20px 15px;
            }
            
            .login-logo a {
                font-size: 24px;
            }
            
            .logo-icon {
                width: 70px;
                height: 70px;
            }
            
            .logo-icon i {
                font-size: 35px;
            }
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #1a1a1a;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #c0392b;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #e74c3c;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-logo">
                <div class="logo-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <a href="#"><b><?php echo $_SESSION['system']['name'] ?></b></a>
                <div class="login-subtitle">Admin Access Portal</div>
            </div>
            
            <div class="login-card-body">
                <form action="" id="login-form">
                    <div id="alert-message"></div>
                    
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <input type="email" class="form-control" name="email" required placeholder="Email Address">
                    </div>
                    
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" class="form-control" name="password" id="password" required placeholder="Password">
                        <span class="password-toggle" onclick="togglePassword()">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">Remember Me</label>
                            </div>
                        </div>
                        <div class="col-4 text-right">
                            <a href="#" class="forgot-link">Forgot Password?</a>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-login" id="loginBtn">
                        <i class="fas fa-sign-in-alt"></i> Sign In
                    </button>
                </form>
            </div>
            
            <div class="login-footer">
                <p>&copy; <?php echo date('Y'); ?> <?php echo $_SESSION['system']['name']; ?> - All Rights Reserved</p>
                <p>Secure Admin Access</p>
            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.password-toggle i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
        
        $(document).ready(function(){
            $('#login-form').submit(function(e){
                e.preventDefault();
                
                const $btn = $('#loginBtn');
                const $alert = $('#alert-message');
                
                // Clear previous alerts
                $alert.html('');
                
                // Validate inputs
                const email = $('input[name="email"]').val().trim();
                const password = $('input[name="password"]').val().trim();
                
                if(!email) {
                    $alert.html('<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> Please enter your email address</div>');
                    $('input[name="email"]').focus();
                    return false;
                }
                
                if(!password) {
                    $alert.html('<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> Please enter your password</div>');
                    $('input[name="password"]').focus();
                    return false;
                }
                
                // Show loading state
                $btn.html('<span class="spinner"></span> Signing In...').addClass('loading');
                $btn.prop('disabled', true);
                
                $.ajax({
                    url: 'admin/ajax.php?action=login2',
                    method: 'POST',
                    data: $(this).serialize(),
                    error: function(err){
                        console.log(err);
                        $alert.html('<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> Connection error. Please try again.</div>');
                        $btn.html('<i class="fas fa-sign-in-alt"></i> Sign In').removeClass('loading');
                        $btn.prop('disabled', false);
                    },
                    success: function(resp){
                        if(resp == 1){
                            // Success - redirect to dashboard
                            $btn.html('<i class="fas fa-check-circle"></i> Success! Redirecting...');
                            setTimeout(function(){
                                location.href = 'index.php?page=home';
                            }, 500);
                        } else {
                            $alert.html('<div class="alert alert-danger"><i class="fas fa-exclamation-circle"></i> Invalid email or password. Please try again.</div>');
                            $btn.html('<i class="fas fa-sign-in-alt"></i> Sign In').removeClass('loading');
                            $btn.prop('disabled', false);
                            
                            // Shake animation
                            $('.login-card').addClass('shake');
                            setTimeout(function() {
                                $('.login-card').removeClass('shake');
                            }, 500);
                        }
                    }
                });
                
                return false;
            });
            
            // Enter key support
            $('#password, input[name="email"]').keypress(function(e) {
                if (e.which == 13) {
                    $('#login-form').submit();
                }
            });
        });
        
        // Add shake animation style
        $('head').append(`
            <style>
                .shake {
                    animation: shakeAnim 0.5s ease;
                }
                
                @keyframes shakeAnim {
                    0%, 100% { transform: translateX(0); }
                    25% { transform: translateX(-8px); }
                    75% { transform: translateX(8px); }
                }
            </style>
        `);
    </script>
    
    <?php include 'footer.php' ?>
</body>
</html>