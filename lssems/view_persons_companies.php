<?php include 'admin/db_connect.php' ?>
<?php
if(isset($_GET['id'])){
  $_type = array("","Single/Freelancer","Group/Company");
	$qry = $conn->query("SELECT pc.*,s.service FROM persons_companies pc inner join services s on s.id = pc.service_id where pc.id = ".$_GET['id'])->fetch_array();
foreach($qry as $k => $v){
	$$k = $v;
}
if(!empty($areas_id)){
  $areas= array();
  $aqry = $conn->query("SELECT * FROM areas where id in ($areas_id)");
  while($row=$aqry->fetch_assoc()){
    $areas[] = ucwords($row['area']);
  }
}
}
?>

<div class="provider-detail">
  <div class="row">
    <!-- Profile Card -->
    <div class="col-md-5">
      <div class="provider-profile-card">
        <!-- Header with gradient -->
        <div class="provider-header">
          <div class="provider-avatar">
            <?php if(empty($img_path) || (!empty($img_path) && !is_file('assets/uploads/'.$img_path))): ?>
            <div class="avatar-placeholder">
              <span><?php echo strtoupper(substr($name, 0, 1)) ?></span>
            </div>
            <?php else: ?>
            <img src="assets/uploads/<?php echo $img_path ?>" alt="<?php echo htmlspecialchars($name) ?>">
            <?php endif ?>
          </div>
          <h4 class="provider-name"><?php echo ucwords($name) ?></h4>
          <span class="provider-type-badge"><?php echo $_type[$type] ?></span>
        </div>

        <!-- Details -->
        <div class="provider-details">
          <div class="detail-item">
            <div class="detail-icon"><i class="fas fa-briefcase"></i></div>
            <div class="detail-content">
              <span class="detail-label">Service</span>
              <span class="detail-value"><?php echo ucwords($service) ?></span>
            </div>
          </div>

          <div class="detail-item">
            <div class="detail-icon"><i class="fas fa-map-marker-alt"></i></div>
            <div class="detail-content">
              <span class="detail-label">Address</span>
              <span class="detail-value"><?php echo $address ?></span>
            </div>
          </div>

          <div class="detail-item">
            <div class="detail-icon"><i class="fas fa-phone-alt"></i></div>
            <div class="detail-content">
              <span class="detail-label">Contact</span>
              <span class="detail-value"><?php echo $contact ?></span>
            </div>
          </div>

          <?php if(isset($areas) && count($areas) > 0): ?>
          <div class="detail-item">
            <div class="detail-icon"><i class="fas fa-globe"></i></div>
            <div class="detail-content">
              <span class="detail-label">Areas Serving</span>
              <div class="area-badges">
                <?php foreach($areas as $v): ?>
                <span class="area-badge"><?php echo ucwords($v) ?></span>
                <?php endforeach; ?>
              </div>
            </div>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- Description -->
    <div class="col-md-7">
      <div class="provider-desc-card">
        <h5 class="desc-title"><i class="fas fa-file-alt mr-2"></i>Description & Details</h5>
        <div class="desc-content">
          <?php echo html_entity_decode($description) ?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal-footer display p-0 mt-3" style="justify-content:space-between;">
  <?php if(isset($_SESSION['login_id'])): ?>
  <button type="button" class="btn btn-primary book-provider-btn" data-provider="<?php echo $id ?>" data-service="<?php echo $service_id ?>" style="border-radius:8px;background:#4f46e5;border:none;box-shadow:0 2px 8px rgba(79,70,229,0.2);">
    <i class="fas fa-calendar-plus mr-1"></i> Book Now
  </button>
  <?php endif; ?>
  <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:8px;">
    <i class="fas fa-times mr-1"></i> Close
  </button>
</div>

<!-- Booking Form (inline) -->
<?php if(isset($_SESSION['login_id'])): ?>
<div id="booking-form-section" class="d-none" style="padding:16px;border-top:1px solid #e2e8f0;margin-top:12px;">
  <h6 style="font-weight:700;color:#4f46e5;margin-bottom:12px;"><i class="fas fa-calendar-check mr-1"></i> Book Appointment</h6>
  <div id="booking-alert"></div>
  <form id="booking-form">
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['login_id'] ?>">
    <input type="hidden" name="provider_id" value="<?php echo $id ?>">
    <input type="hidden" name="service_id" value="<?php echo $service_id ?>">
    <div class="row">
      <div class="col-md-6 form-group">
        <label style="font-size:12px;font-weight:600;color:#475569;">Date</label>
        <input type="date" class="form-control" name="booking_date" required style="border-radius:8px;">
      </div>
      <div class="col-md-6 form-group">
        <label style="font-size:12px;font-weight:600;color:#475569;">Preferred Time</label>
        <input type="time" class="form-control" name="booking_time" style="border-radius:8px;">
      </div>
    </div>
    <div class="form-group">
      <label style="font-size:12px;font-weight:600;color:#475569;">Notes (optional)</label>
      <textarea class="form-control" name="notes" rows="2" placeholder="Describe what you need..." style="border-radius:8px;"></textarea>
    </div>
    <button type="submit" class="btn btn-primary btn-sm" style="background:#4f46e5;border:none;border-radius:8px;padding:8px 20px;font-weight:600;">
      <i class="fas fa-check mr-1"></i> Submit Booking
    </button>
    <button type="button" class="btn btn-light btn-sm ml-2" onclick="$('#booking-form-section').addClass('d-none')" style="border-radius:8px;">Cancel</button>
  </form>
</div>
<script>
$('.book-provider-btn').click(function(){ $('#booking-form-section').removeClass('d-none'); });
$('#booking-form').submit(function(e){
  e.preventDefault();
  $('#booking-alert').html('');
  $.ajax({
    url:'admin/ajax.php?action=save_booking',
    method:'POST',
    data:$(this).serialize(),
    dataType:'json',
    success:function(r){
      if(r.status==='success'){
        $('#booking-alert').html('<div class="alert alert-success" style="border-radius:8px;font-size:13px;"><i class="fas fa-check-circle mr-1"></i> '+r.message+'</div>');
        $('#booking-form')[0].reset();
      } else {
        $('#booking-alert').html('<div class="alert alert-danger" style="border-radius:8px;font-size:13px;">'+r.message+'</div>');
      }
    }
  });
});
</script>
<?php endif; ?>

<style>
#uni_modal .modal-footer {
  display: none;
}
#uni_modal .modal-footer.display {
  display: flex;
}

.provider-detail {
  padding: 8px;
}

.provider-profile-card {
  background: #ffffff;
  border: 1px solid rgba(79, 70, 229, 0.15);
  border-radius: 16px;
  overflow: hidden;
}

.provider-header {
  background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
  padding: 28px 20px 20px;
  text-align: center;
  border-bottom: 1px solid rgba(79, 70, 229, 0.15);
}

.provider-avatar {
  width: 88px;
  height: 88px;
  border-radius: 50%;
  overflow: hidden;
  margin: 0 auto 14px;
  border: 3px solid #4f46e5;
  box-shadow: 0 4px 16px rgba(79, 70, 229, 0.25);
}

.provider-avatar img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.avatar-placeholder {
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, #4f46e5, #4338ca);
  display: flex;
  align-items: center;
  justify-content: center;
}

.avatar-placeholder span {
  font-size: 32px;
  font-weight: 800;
  color: #fff;
  font-family: 'Inter', sans-serif;
}

.provider-name {
  font-family: 'Inter', sans-serif;
  font-weight: 700;
  font-size: 18px;
  color: #1e293b;
  margin-bottom: 8px;
}

.provider-type-badge {
  display: inline-block;
  background: rgba(79, 70, 229, 0.12);
  color: #6366f1;
  font-size: 11px;
  font-weight: 600;
  padding: 4px 14px;
  border-radius: 20px;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.provider-details {
  padding: 16px 20px;
}

.detail-item {
  display: flex;
  align-items: flex-start;
  padding: 12px 0;
  border-bottom: 1px solid rgba(79, 70, 229, 0.08);
}
.detail-item:last-child {
  border-bottom: none;
}

.detail-icon {
  width: 36px;
  height: 36px;
  background: rgba(79, 70, 229, 0.1);
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 12px;
  flex-shrink: 0;
}
.detail-icon i {
  color: #6366f1;
  font-size: 14px;
}

.detail-label {
  display: block;
  font-size: 11px;
  font-weight: 600;
  color: #94a3b8;
  text-transform: uppercase;
  letter-spacing: 0.4px;
  margin-bottom: 2px;
}

.detail-value {
  display: block;
  font-size: 14px;
  color: #475569;
  line-height: 1.5;
}

.area-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
  margin-top: 4px;
}

.area-badge {
  background: linear-gradient(135deg, #4f46e5, #4338ca);
  color: #fff;
  font-size: 11px;
  font-weight: 600;
  padding: 3px 10px;
  border-radius: 6px;
}

.provider-desc-card {
  background: #ffffff;
  border: 1px solid rgba(79, 70, 229, 0.15);
  border-radius: 16px;
  padding: 24px;
  height: 100%;
}

.desc-title {
  font-family: 'Inter', sans-serif;
  font-weight: 700;
  font-size: 16px;
  color: #6366f1;
  margin-bottom: 16px;
  padding-bottom: 12px;
  border-bottom: 1px solid rgba(79, 70, 229, 0.15);
}

.desc-content {
  color: #64748b;
  font-size: 14px;
  line-height: 1.8;
}

.desc-content img {
  max-width: 100%;
  border-radius: 8px;
}
</style>