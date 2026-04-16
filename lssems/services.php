<?php include 'admin/db_connect.php' ?>

<div class="services-page py-4 px-2">
  <!-- Page Header -->
  <div class="text-center mb-4">
    <h2 class="section-heading">
      <i class="fas fa-concierge-bell" style="color:#4f46e5;"></i> Our Services
    </h2>
    <p class="section-desc">Browse our service categories to find what you need</p>
    <div style="width:60px;height:3px;background:#4f46e5;margin:12px auto 0;border-radius:2px;"></div>
  </div>

  <!-- Search Bar -->
  <div class="d-flex justify-content-center mb-4">
    <div class="service-search-wrapper">
      <div class="input-group">
        <span class="input-group-prepend">
          <span class="input-group-text" style="background:#f8fafc;border:1px solid rgba(79,70,229,0.3);border-right:none;border-radius:10px 0 0 10px;color:#6366f1;">
            <i class="fas fa-search"></i>
          </span>
        </span>
        <input type="search" id="filter" class="form-control" placeholder="Search services..." style="border-radius:0 10px 10px 0;border-left:none;">
      </div>
    </div>
  </div>

  <!-- Service Grid -->
  <div class="row" id="service-list">
    <?php 
    $services = $conn->query("SELECT * FROM services order by service asc");
    $icons = ['fas fa-code', 'fas fa-paint-brush', 'fas fa-chart-line', 'fas fa-mobile-alt', 
              'fas fa-database', 'fas fa-cloud', 'fas fa-shield-alt', 'fas fa-camera',
              'fas fa-video', 'fas fa-music', 'fas fa-book', 'fas fa-graduation-cap',
              'fas fa-tools', 'fas fa-truck', 'fas fa-cut', 'fas fa-broom',
              'fas fa-hands-helping', 'fas fa-chalkboard', 'fas fa-laptop', 'fas fa-server',
              'fas fa-cogs', 'fas fa-wrench', 'fas fa-hammer', 'fas fa-stethoscope'];
    $i = 0;
    while($row = $services->fetch_assoc()):
      $trans = get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
      unset($trans["\""], $trans["<"], $trans[">"]);
      $desc = strtr(html_entity_decode($row['description']), $trans);
      $desc = str_replace(array("<li>","</li>"), array("",", "), $desc);
      $desc_clean = strip_tags($desc);
      $icon = $icons[$i % count($icons)];
    ?>
    <div class="col-lg-4 col-md-6 mb-4 s-item" data-id="<?php echo $row['id'] ?>" data-title="<?php echo htmlspecialchars(ucwords($row['service'])) ?>">
      <div class="service-card">
        <div class="service-card-icon">
          <i class="<?php echo $icon ?>"></i>
        </div>
        <h5 class="service-card-title"><?php echo ucwords($row['service']) ?></h5>
        <p class="service-card-desc"><?php echo mb_strimwidth($desc_clean, 0, 120, '...') ?></p>
        <div class="service-card-action">
          <span class="service-learn-more">Learn More <i class="fas fa-arrow-right ml-1"></i></span>
        </div>
      </div>
    </div>
    <?php 
    $i++;
    endwhile; 
    ?>
  </div>
</div>

<style>
.section-heading {
  font-family: 'Inter', sans-serif;
  font-size: 28px;
  font-weight: 800;
  color: #1e293b;
  letter-spacing: -0.3px;
}
.section-desc {
  color: #94a3b8;
  font-size: 15px;
  margin-top: 8px;
}
.service-search-wrapper {
  width: 100%;
  max-width: 420px;
}
.service-card {
  background: #ffffff;
  border: 1px solid rgba(79, 70, 229, 0.15);
  border-radius: 16px;
  padding: 28px 24px 20px;
  text-align: center;
  transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
  height: 100%;
  display: flex;
  flex-direction: column;
  cursor: pointer;
}
.service-card:hover {
  transform: translateY(-6px);
  border-color: rgba(79, 70, 229, 0.5);
  box-shadow: 0 12px 32px rgba(79, 70, 229, 0.06);
}
.service-card-icon {
  width: 64px;
  height: 64px;
  background: linear-gradient(135deg, rgba(79,70,229,0.15), rgba(79,70,229,0.08));
  border: 1px solid rgba(79, 70, 229, 0.2);
  border-radius: 16px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 16px;
  transition: all 0.3s ease;
}
.service-card:hover .service-card-icon {
  background: linear-gradient(135deg, #4f46e5, #4338ca);
  border-color: #4f46e5;
  box-shadow: 0 6px 16px rgba(79, 70, 229, 0.3);
}
.service-card-icon i {
  font-size: 26px;
  color: #6366f1;
  transition: color 0.3s ease;
}
.service-card:hover .service-card-icon i {
  color: #fff;
}
.service-card-title {
  font-family: 'Inter', sans-serif;
  font-size: 16px;
  font-weight: 700;
  color: #1e293b;
  margin-bottom: 8px;
}
.service-card-desc {
  color: #94a3b8;
  font-size: 13px;
  line-height: 1.6;
  flex-grow: 1;
  margin-bottom: 12px;
}
.service-card-action {
  padding-top: 12px;
  border-top: 1px solid rgba(79, 70, 229, 0.1);
}
.service-learn-more {
  color: #6366f1;
  font-size: 13px;
  font-weight: 600;
  transition: all 0.2s ease;
}
.service-card:hover .service-learn-more {
  color: #f87171;
}
.service-learn-more i {
  transition: transform 0.2s ease;
}
.service-card:hover .service-learn-more i {
  transform: translateX(4px);
}
</style>

<script>
$('.s-item').click(function(){
  uni_modal($(this).attr('data-title'), "view_service.php?id="+$(this).attr('data-id'), 'mid-large');
});

function _filter(){
  var _ftxt = $('#filter').val().toLowerCase();
  $('.s-item').each(function(){
    var _content = $(this).text().toLowerCase();
    if(_content.includes(_ftxt)){
      $(this).toggle(true);
    } else {
      $(this).toggle(false);
    }
  });
  check_list();
}

function check_list(){
  var count = $('.s-item:visible').length;
  if(count > 0){
    if($('#ns').length > 0) $('#ns').remove();
  } else {
    var ns = $('<div class="col-12 text-center py-5" id="ns"><i class="fas fa-search fa-3x mb-3" style="color:#e2e8f0;"></i><br><b style="color:#94a3b8;">No services match your search.</b></div>');
    $('#service-list').append(ns);
  }
}

$('#filter').on('input', function(){
  _filter();
});
$('#filter').on('keypress', function(e){
  if(e.which == 13){
    _filter();
    return false;
  }
});
$('#filter').on('search', function(){
  _filter();
});
</script>