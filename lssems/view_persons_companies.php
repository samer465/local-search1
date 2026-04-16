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

<div class="modal-footer display p-0 mt-3">
  <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius:8px;">
    <i class="fas fa-times mr-1"></i> Close
  </button>
</div>

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
  background: #1a1e24;
  border: 1px solid rgba(220, 38, 38, 0.15);
  border-radius: 16px;
  overflow: hidden;
}

.provider-header {
  background: linear-gradient(135deg, #1f242c 0%, #111827 100%);
  padding: 28px 20px 20px;
  text-align: center;
  border-bottom: 1px solid rgba(220, 38, 38, 0.15);
}

.provider-avatar {
  width: 88px;
  height: 88px;
  border-radius: 50%;
  overflow: hidden;
  margin: 0 auto 14px;
  border: 3px solid #dc2626;
  box-shadow: 0 4px 16px rgba(220, 38, 38, 0.25);
}

.provider-avatar img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.avatar-placeholder {
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, #dc2626, #b91c1c);
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
  color: #f3f4f6;
  margin-bottom: 8px;
}

.provider-type-badge {
  display: inline-block;
  background: rgba(220, 38, 38, 0.12);
  color: #ef4444;
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
  border-bottom: 1px solid rgba(220, 38, 38, 0.08);
}
.detail-item:last-child {
  border-bottom: none;
}

.detail-icon {
  width: 36px;
  height: 36px;
  background: rgba(220, 38, 38, 0.1);
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-right: 12px;
  flex-shrink: 0;
}
.detail-icon i {
  color: #ef4444;
  font-size: 14px;
}

.detail-label {
  display: block;
  font-size: 11px;
  font-weight: 600;
  color: #9ca3af;
  text-transform: uppercase;
  letter-spacing: 0.4px;
  margin-bottom: 2px;
}

.detail-value {
  display: block;
  font-size: 14px;
  color: #e5e7eb;
  line-height: 1.5;
}

.area-badges {
  display: flex;
  flex-wrap: wrap;
  gap: 6px;
  margin-top: 4px;
}

.area-badge {
  background: linear-gradient(135deg, #dc2626, #b91c1c);
  color: #fff;
  font-size: 11px;
  font-weight: 600;
  padding: 3px 10px;
  border-radius: 6px;
}

.provider-desc-card {
  background: #1a1e24;
  border: 1px solid rgba(220, 38, 38, 0.15);
  border-radius: 16px;
  padding: 24px;
  height: 100%;
}

.desc-title {
  font-family: 'Inter', sans-serif;
  font-weight: 700;
  font-size: 16px;
  color: #ef4444;
  margin-bottom: 16px;
  padding-bottom: 12px;
  border-bottom: 1px solid rgba(220, 38, 38, 0.15);
}

.desc-content {
  color: #d1d5db;
  font-size: 14px;
  line-height: 1.8;
}

.desc-content img {
  max-width: 100%;
  border-radius: 8px;
}
</style>