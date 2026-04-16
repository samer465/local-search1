<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>
<?php include 'admin/db_connect.php'; ?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reset Password</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap">
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <style>
    body { font-family:'Inter',sans-serif; background:#f0f4ff; min-height:100vh; }
    .reset-container { min-height:100vh; display:flex; align-items:center; justify-content:center; padding:20px; }
    .reset-card { background:#fff; border-radius:20px; box-shadow:0 10px 40px rgba(79,70,229,0.1); max-width:440px; width:100%; padding:40px 32px; text-align:center; }
    .reset-card h2 { font-size:22px; font-weight:700; color:#1e293b; margin-bottom:8px; }
    .reset-card p { color:#94a3b8; font-size:13px; margin-bottom:24px; }
    .form-control { border:1.5px solid #e2e8f0; border-radius:10px; padding:11px 14px; font-size:14px; }
    .form-control:focus { border-color:#4f46e5; box-shadow:0 0 0 3px rgba(79,70,229,0.1); }
    .btn-reset { width:100%; padding:12px; background:linear-gradient(135deg,#4f46e5,#6366f1); border:none; border-radius:10px; color:#fff; font-size:15px; font-weight:600; cursor:pointer; }
    .btn-reset:hover { box-shadow:0 6px 20px rgba(79,70,229,0.3); }
    .alert-custom { padding:10px 14px; border-radius:10px; font-size:13px; margin-bottom:14px; }
    .alert-danger-custom { background:#fef2f2; border:1px solid #fecaca; color:#dc2626; }
    .alert-success-custom { background:#f0fdf4; border:1px solid #bbf7d0; color:#16a34a; }
  </style>
</head>
<body>
<div class="reset-container">
  <div class="reset-card">
    <div style="width:56px;height:56px;background:linear-gradient(135deg,#4f46e5,#6366f1);border-radius:14px;display:inline-flex;align-items:center;justify-content:center;margin-bottom:16px;">
      <i class="fas fa-key" style="color:#fff;font-size:24px;"></i>
    </div>
    <h2>Reset Your Password</h2>
    <p>Enter your new password below.</p>
    <div id="reset-alert"></div>
    <form id="reset-form">
      <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token'] ?? '') ?>">
      <div class="form-group text-left">
        <label style="font-size:12px;font-weight:600;color:#475569;">New Password</label>
        <input type="password" class="form-control" name="password" placeholder="Enter new password" required>
      </div>
      <div class="form-group text-left">
        <label style="font-size:12px;font-weight:600;color:#475569;">Confirm Password</label>
        <input type="password" class="form-control" name="cpass" placeholder="Confirm new password" required>
      </div>
      <button type="submit" class="btn-reset"><i class="fas fa-save mr-1"></i> Reset Password</button>
    </form>
    <p style="margin-top:16px;"><a href="login.php" style="color:#4f46e5;font-weight:600;text-decoration:none;">Back to Login</a></p>
  </div>
</div>
<script>
$('#reset-form').submit(function(e){
  e.preventDefault();
  var p = $('[name="password"]').val(), c = $('[name="cpass"]').val();
  if(p !== c){ $('#reset-alert').html('<div class="alert-custom alert-danger-custom">Passwords do not match.</div>'); return; }
  $.ajax({
    url:'admin/ajax.php?action=reset_password', method:'POST', data:$(this).serialize(), dataType:'json',
    success:function(r){
      if(r.status==='success'){
        $('#reset-alert').html('<div class="alert-custom alert-success-custom"><i class="fas fa-check-circle mr-1"></i> '+r.message+'</div>');
        setTimeout(function(){ location.href='login.php'; },1500);
      } else {
        $('#reset-alert').html('<div class="alert-custom alert-danger-custom">'+r.message+'</div>');
      }
    }
  });
});
</script>
</body>
</html>