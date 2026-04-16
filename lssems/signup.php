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
  include 'header.php';
?>
<?php 
if(isset($_SESSION['login_id'])){
  $qry = $conn->query("SELECT * from users where id = {$_SESSION['login_id']} ");
  foreach($qry->fetch_array() as $k => $v){
    $$k = $v;
  }
}
?>
<head>
<style>
body {
  background: linear-gradient(135deg, #f0f4ff 0%, #14181f 100%);
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
  min-height: 100vh;
}
body::before {
  content: '';
  position: fixed;
  width: 100%;
  height: 100%;
  background: radial-gradient(circle at 20% 50%, rgba(79, 70, 229, 0.08) 0%, transparent 50%);
  pointer-events: none;
}

.signup-container {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 40px 20px;
  position: relative;
  z-index: 1;
}

.signup-card {
  background: rgba(26, 30, 36, 0.95);
  backdrop-filter: blur(12px);
  border: 1px solid rgba(79, 70, 229, 0.2);
  border-radius: 24px;
  width: 100%;
  max-width: 700px;
  overflow: hidden;
  box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4);
  animation: fadeUp 0.5s ease-out;
}
@keyframes fadeUp {
  from { opacity: 0; transform: translateY(20px); }
  to { opacity: 1; transform: translateY(0); }
}

.signup-card::before {
  content: '';
  display: block;
  height: 3px;
  background: linear-gradient(90deg, #4f46e5, #6366f1, #4f46e5);
  background-size: 200% 100%;
  animation: shimmer 3s ease-in-out infinite;
}
@keyframes shimmer {
  0%, 100% { background-position: -200% 0; }
  50% { background-position: 200% 0; }
}

.signup-header {
  text-align: center;
  padding: 32px 24px 16px;
}

.signup-logo-icon {
  width: 60px;
  height: 60px;
  background: linear-gradient(135deg, #4f46e5, #6366f1);
  border-radius: 16px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 14px;
  box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
}
.signup-logo-icon i {
  font-size: 26px;
  color: #fff;
}

.signup-header h3 {
  font-family: 'Inter', sans-serif;
  font-size: 22px;
  font-weight: 700;
  color: #1e293b;
  margin-bottom: 4px;
}
.signup-header p {
  color: #94a3b8;
  font-size: 14px;
}

.signup-body {
  padding: 8px 32px 32px;
}

.signup-body .form-control {
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(79, 70, 229, 0.2);
  border-radius: 10px;
  color: #1e293b;
  padding: 10px 14px;
  font-size: 14px;
  transition: all 0.2s ease;
}
.signup-body .form-control:focus {
  border-color: #4f46e5;
  box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
  background: rgba(255, 255, 255, 0.08);
}
.signup-body .form-control::placeholder {
  color: #94a3b8;
}

.signup-body textarea.form-control {
  resize: vertical;
}

.signup-section-label {
  color: #6366f1;
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  margin-bottom: 12px;
  display: block;
}

.signup-divider {
  border-left: 1px solid rgba(79, 70, 229, 0.15);
}

.input-icon-group {
  position: relative;
}
.input-icon-group .form-control {
  padding-left: 38px;
}
.input-icon-group .input-icon {
  position: absolute;
  left: 12px;
  top: 50%;
  transform: translateY(-50%);
  color: #6366f1;
  font-size: 13px;
  z-index: 2;
}

.btn-signup {
  background: linear-gradient(135deg, #4f46e5, #4338ca);
  border: none;
  color: #fff;
  padding: 10px 28px;
  border-radius: 10px;
  font-weight: 600;
  font-size: 15px;
  transition: all 0.2s ease;
  box-shadow: 0 4px 14px rgba(79, 70, 229, 0.3);
}
.btn-signup:hover {
  background: linear-gradient(135deg, #6366f1, #4f46e5);
  transform: translateY(-1px);
  box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
  color: #fff;
}

.signup-footer {
  padding: 16px 32px 24px;
  text-align: center;
}
.signup-footer a {
  color: #6366f1;
  font-weight: 600;
  text-decoration: none;
  transition: color 0.2s ease;
}
.signup-footer a:hover {
  color: #f87171;
}

.icheck-primary label {
  color: #64748b;
  font-size: 13px;
}
.icheck-primary label a {
  color: #6366f1;
}

#msg .alert {
  border-radius: 8px;
  font-size: 13px;
}

#pass_match i {
  font-size: 12px;
}

@media (max-width: 768px) {
  .signup-body { padding: 8px 20px 24px; }
  .signup-divider { border-left: none; border-top: 1px solid rgba(79,70,229,0.15); padding-top: 12px; margin-top: 4px; }
}
</style>
</head>

<body>
<div class="signup-container">
  <div class="signup-card">
    <div class="signup-header">
      <div class="signup-logo-icon">
        <i class="fas fa-user-plus"></i>
      </div>
      <h3><?php echo !isset($id) ? 'Create Account' : 'Manage Account'; ?></h3>
      <p><?php echo !isset($id) ? 'Join our platform and find the best services' : 'Update your account details'; ?></p>
    </div>

    <div class="signup-body">
      <form id="manage-signup">
        <input type="hidden" value="<?php echo isset($id) ? $id : '' ?>" name="id">
        <div class="row">
          <!-- Left Column: Personal Info -->
          <div class="col-md-6">
            <span class="signup-section-label"><i class="fas fa-user mr-1"></i> Personal Information</span>

            <div class="input-icon-group mb-3">
              <span class="input-icon fas fa-user"></span>
              <input type="text" class="form-control" name="firstname" required placeholder="First Name" value="<?php echo isset($firstname) ? $firstname : '' ?>">
            </div>
            <div class="input-icon-group mb-3">
              <span class="input-icon fas fa-user"></span>
              <input type="text" class="form-control" name="middlename" placeholder="Middle Name (optional)" value="<?php echo isset($middlename) ? $middlename : '' ?>">
            </div>
            <div class="input-icon-group mb-3">
              <span class="input-icon fas fa-user"></span>
              <input type="text" class="form-control" name="lastname" required placeholder="Last Name" value="<?php echo isset($lastname) ? $lastname : '' ?>">
            </div>
            <div class="input-icon-group mb-3">
              <span class="input-icon fas fa-mobile-alt"></span>
              <input type="text" class="form-control" name="contact" required placeholder="Contact Number" value="<?php echo isset($contact) ? $contact : '' ?>">
            </div>
            <div class="mb-3">
              <textarea cols="30" rows="2" class="form-control" name="address" required placeholder="Address"><?php echo isset($address) ? $address : '' ?></textarea>
            </div>
          </div>

          <!-- Right Column: Account Info -->
          <div class="col-md-6 signup-divider">
            <span class="signup-section-label"><i class="fas fa-lock mr-1"></i> Account Details</span>

            <div class="input-icon-group mb-3">
              <span class="input-icon fas fa-envelope"></span>
              <input type="email" class="form-control" name="email" required placeholder="Email Address" value="<?php echo isset($email) ? $email : '' ?>">
            </div>
            <small id="msg"></small>

            <div class="input-icon-group mb-3">
              <span class="input-icon fas fa-lock"></span>
              <input type="password" class="form-control" name="password" <?php echo isset($id) ? '' : "required" ?> placeholder="Password">
            </div>
            <?php if(isset($id)): ?>
            <small style="color:#94a3b8;font-size:12px;"><i>Leave blank if you don't want to change your password.</i></small>
            <?php endif; ?>

            <div class="input-icon-group mb-3">
              <span class="input-icon fas fa-lock"></span>
              <input type="password" class="form-control" name="cpass" <?php echo isset($id) ? '' : "required" ?> placeholder="Confirm Password">
            </div>
            <small id="pass_match" data-status=''></small>
          </div>
        </div>

        <div class="row mt-3 align-items-center">
          <div class="col-8">
            <?php if(!isset($id)): ?>
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
                I agree to the <a href="#">terms & conditions</a>
              </label>
            </div>
            <?php endif; ?>
          </div>
          <div class="col-4 text-right">
            <button type="submit" class="btn btn-signup"><?php echo !isset($id) ? 'Register' : 'Update'; ?></button>
          </div>
        </div>
      </form>
    </div>

    <?php if(!isset($id)): ?>
    <div class="signup-footer">
      Already have an account? <a href="login.php">Sign in here</a>
    </div>
    <?php endif; ?>
  </div>
</div>

<script>
$(document).ready(function(){
  $('#manage-signup').submit(function(e){
    e.preventDefault();
    $('input').removeClass("border-danger");
    start_load();
    $('#msg').html('');
    if($('#pass_match').attr('data-status') != 1){
      if($("[name='password']").val() != ''){
        $('[name="password"],[name="cpass"]').addClass("border-danger");
        end_load();
        return false;
      }
    }
    $.ajax({
      url:'admin/ajax.php?action=signup',
      data: new FormData($(this)[0]),
      cache: false,
      contentType: false,
      processData: false,
      method: 'POST',
      type: 'POST',
      success:function(resp){
        if(resp == 1){
          alert_toast('Account created successfully.','success');
          setTimeout(function(){
            location.replace('index.php?page=home');
          }, 750);
        } else if(resp == 2){
          $('#msg').html("<div class='alert alert-danger'>Email already exists.</div>");
          $('[name="email"]').addClass("border-danger");
          end_load();
        }
      }
    });
  });

  $('[name="password"],[name="cpass"]').keyup(function(){
    var pass = $('[name="password"]').val();
    var cpass = $('[name="cpass"]').val();
    if(cpass == '' || pass == ''){
      $('#pass_match').attr('data-status','');
    } else {
      if(cpass == pass){
        $('#pass_match').attr('data-status','1').html('<i class="text-success" style="font-size:12px;">Passwords match</i>');
      } else {
        $('#pass_match').attr('data-status','2').html('<i class="text-danger" style="font-size:12px;">Passwords do not match</i>');
      }
    }
  });
});
</script>
<?php include 'footer.php' ?>
</body>
</html>
