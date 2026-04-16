<?php include 'admin/db_connect.php'; ?>

<div class="booking-page py-4 px-2">
  <div class="text-center mb-4">
    <h2 style="font-family:'Inter',sans-serif;font-size:28px;font-weight:800;color:#1e293b;">
      <i class="fas fa-calendar-check" style="color:#4f46e5;"></i> My Bookings
    </h2>
    <p style="color:#94a3b8;font-size:15px;margin-top:8px;">Track and manage your service appointments</p>
    <div style="width:60px;height:3px;background:#4f46e5;margin:12px auto 0;border-radius:2px;"></div>
  </div>

  <?php if(!isset($_SESSION['login_id'])): ?>
  <div class="text-center py-5">
    <i class="fas fa-lock fa-3x mb-3" style="color:#e2e8f0;"></i>
    <p style="color:#94a3b8;">Please <a href="login.php" style="color:#4f46e5;font-weight:600;">sign in</a> to view your bookings.</p>
  </div>
  <?php else: ?>
  <div class="row justify-content-center">
    <div class="col-lg-10">
      <div class="booking-list-card" style="background:#fff;border:1px solid #e2e8f0;border-radius:16px;padding:24px;box-shadow:0 2px 8px rgba(0,0,0,0.04);">
        <div id="booking-list">
          <div class="text-center py-4">
            <div class="spinner-border text-primary" role="status"></div>
            <p style="color:#94a3b8;margin-top:8px;">Loading bookings...</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php endif; ?>
</div>

<style>
.booking-item {
  border: 1px solid #e2e8f0;
  border-radius: 12px;
  padding: 16px 20px;
  margin-bottom: 12px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  transition: all 0.2s ease;
  background: #fff;
}
.booking-item:hover {
  border-color: #4f46e5;
  box-shadow: 0 4px 12px rgba(79,70,229,0.08);
}
.booking-info h6 { font-weight: 700; color: #1e293b; margin-bottom: 4px; font-size: 15px; }
.booking-info p { color: #64748b; font-size: 13px; margin: 0; }
.booking-meta { text-align: right; }
.booking-date { font-size: 13px; color: #64748b; margin-bottom: 4px; }
.badge-pending { background: #fef3c7; color: #d97706; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 600; }
.badge-confirmed { background: #dbeafe; color: #2563eb; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 600; }
.badge-completed { background: #d1fae5; color: #059669; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 600; }
.badge-cancelled { background: #fee2e2; color: #dc2626; padding: 4px 10px; border-radius: 6px; font-size: 11px; font-weight: 600; }
.no-bookings { text-align: center; padding: 40px 20px; }
.no-bookings i { font-size: 48px; color: #e2e8f0; margin-bottom: 12px; }
.no-bookings p { color: #94a3b8; font-size: 14px; }
</style>

<?php if(isset($_SESSION['login_id'])): ?>
<script>
$(document).ready(function(){
  $.ajax({
    url: 'admin/ajax.php?action=get_bookings',
    method: 'POST',
    data: { user_id: <?php echo $_SESSION['login_id'] ?> },
    success: function(resp){
      var data = JSON.parse(resp);
      if(data.length === 0){
        $('#booking-list').html('<div class="no-bookings"><i class="fas fa-calendar-times d-block"></i><p>No bookings yet. Browse services to make your first booking!</p><a href="index.php?page=home" class="btn btn-primary btn-sm" style="background:#4f46e5;border:none;border-radius:8px;padding:8px 20px;font-weight:600;">Browse Services</a></div>');
        return;
      }
      var html = '';
      var badges = {Pending:'badge-pending',Confirmed:'badge-confirmed',Completed:'badge-completed',Cancelled:'badge-cancelled'};
      data.forEach(function(b){
        html += '<div class="booking-item">';
        html += '<div class="booking-info"><h6>'+b.provider_name+'</h6><p><i class="fas fa-concierge-bell mr-1"></i> '+b.service+'</p>';
        if(b.notes) html += '<p style="margin-top:4px;"><i class="fas fa-sticky-note mr-1"></i> '+b.notes+'</p>';
        html += '</div>';
        html += '<div class="booking-meta"><div class="booking-date"><i class="fas fa-calendar mr-1"></i> '+b.booking_date;
        if(b.booking_time) html += ' at '+b.booking_time;
        html += '</div><span class="'+(badges[b.status_text]||'badge-pending')+'">'+b.status_text+'</span></div>';
        html += '</div>';
      });
      $('#booking-list').html(html);
    }
  });
});
</script>
<?php endif; ?>
