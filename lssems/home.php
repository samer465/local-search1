<?php include('admin/db_connect.php') ?>

<!-- Hero Section -->
<div class="hero-section position-relative overflow-hidden" style="margin: -0.5rem -15px 0; border-radius: 0 0 24px 24px;">
  <div class="hero-overlay"></div>
  <img src="assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>" class="hero-bg-img" alt="Cover">
  
  <div class="hero-content position-relative text-center" style="z-index:2;">
    <h1 class="hero-title">Find Local Service Providers</h1>
    <p class="hero-subtitle">Search trusted professionals in your area by service category and location</p>
    
    <!-- Search Card -->
    <div class="search-card mx-auto">
      <div class="search-card-inner">
        <div class="row align-items-end">
          <div class="col-md-5 mb-3 mb-md-0">
            <label class="search-label"><i class="fas fa-briefcase"></i> Service Category</label>
            <select name="service_id" class="form-control select2 select2-sm">
              <option value=""></option>
              <?php 
              $services = $conn->query("SELECT * FROM services order by service asc");
              while($row = $services->fetch_assoc()):
              ?>
              <option value="<?php echo $row['id'] ?>" <?php echo isset($_GET['s']) && $_GET['s'] == $row['id'] ? 'selected' : '' ?>><?php echo ucwords($row['service']) ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="col-md-5 mb-3 mb-md-0">
            <label class="search-label"><i class="fas fa-map-marker-alt"></i> Location</label>
            <select name="area_id" class="form-control select2 select2-sm">
              <option value=""></option>
              <?php 
              $areas = $conn->query("SELECT * FROM areas order by area asc");
              while($row = $areas->fetch_assoc()):
              ?>
              <option value="<?php echo $row['id'] ?>" <?php echo isset($_GET['a']) && $_GET['a'] == $row['id'] ? 'selected' : '' ?>><?php echo ucwords($row['area']) ?></option>
              <?php endwhile; ?>
            </select>
          </div>
          <div class="col-md-2">
            <button class="btn btn-search-hero w-100" id="find_sp">
              <i class="fas fa-search mr-1"></i> Search
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Results Section -->
<div class="results-section mt-4 px-2">
  <div id="results-header" class="d-none mb-3">
    <h5 class="results-title"><i class="fas fa-list-ul mr-2"></i>Search Results</h5>
  </div>
  <div class="row" id="sp-list">
  </div>
</div>

<!-- Clone Template (hidden) -->
<div class="d-none" id="clone-sp-item">
  <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
    <div class="sp-card sp-item" style="cursor:pointer;">
      <div class="sp-card-header">
        <div class="sp-card-avatar">
          <img class="sp-img" src="" alt="">
        </div>
      </div>
      <div class="sp-card-body">
        <h6 class="sp-name"></h6>
        <span class="sp-c"></span>
      </div>
      <div class="sp-card-footer">
        <span class="sp-view-btn"><i class="fas fa-eye mr-1"></i> View Details</span>
      </div>
    </div>
  </div>
</div>

<style>
/* Hero Section */
.hero-section {
  min-height: 420px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.hero-bg-img {
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
  object-fit: cover;
  z-index: 0;
}
.hero-overlay {
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: linear-gradient(180deg, rgba(10,12,16,0.85) 0%, rgba(10,12,16,0.7) 50%, rgba(10,12,16,0.9) 100%);
  z-index: 1;
}
.hero-content {
  padding: 60px 20px 50px;
  width: 100%;
  max-width: 900px;
}
.hero-title {
  font-family: 'Inter', sans-serif;
  font-size: 36px;
  font-weight: 800;
  color: #fff;
  margin-bottom: 12px;
  letter-spacing: -0.5px;
}
.hero-subtitle {
  font-size: 16px;
  color: #9ca3af;
  margin-bottom: 36px;
  max-width: 500px;
  margin-left: auto;
  margin-right: auto;
}

/* Search Card */
.search-card {
  max-width: 800px;
  width: 100%;
}
.search-card-inner {
  background: rgba(26, 30, 36, 0.95);
  backdrop-filter: blur(12px);
  border: 1px solid rgba(220, 38, 38, 0.25);
  border-radius: 16px;
  padding: 24px 28px;
  box-shadow: 0 8px 32px rgba(0,0,0,0.4);
}
.search-label {
  display: block;
  font-size: 12px;
  font-weight: 600;
  color: #ef4444;
  margin-bottom: 6px;
  text-align: left;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.search-label i {
  margin-right: 4px;
}
.btn-search-hero {
  background: linear-gradient(135deg, #dc2626, #b91c1c);
  color: #fff;
  border: none;
  border-radius: 10px;
  padding: 10px 20px;
  font-weight: 600;
  font-size: 15px;
  transition: all 0.25s ease;
  box-shadow: 0 4px 14px rgba(220, 38, 38, 0.3);
}
.btn-search-hero:hover {
  background: linear-gradient(135deg, #ef4444, #dc2626);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(220, 38, 38, 0.4);
  color: #fff;
}

/* Results Section */
.results-title {
  color: #ef4444;
  font-family: 'Inter', sans-serif;
  font-weight: 700;
  font-size: 18px;
}

/* Service Provider Cards */
.sp-card {
  background: #1a1e24;
  border: 1px solid rgba(220, 38, 38, 0.15);
  border-radius: 16px;
  overflow: hidden;
  transition: all 0.3s cubic-bezier(0.165, 0.84, 0.44, 1);
}
.sp-card:hover {
  transform: translateY(-6px);
  border-color: rgba(220, 38, 38, 0.5);
  box-shadow: 0 12px 32px rgba(0, 0, 0, 0.4);
}
.sp-card-header {
  background: linear-gradient(135deg, #1f242c 0%, #111827 100%);
  padding: 24px 20px 36px;
  text-align: center;
  position: relative;
}
.sp-card-avatar {
  width: 72px;
  height: 72px;
  margin: 0 auto;
  border-radius: 50%;
  overflow: hidden;
  border: 3px solid #dc2626;
  box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25);
}
.sp-card-avatar .sp-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
.sp-card-body {
  padding: 16px 20px 12px;
  text-align: center;
}
.sp-card-body .sp-name {
  color: #f3f4f6;
  font-weight: 700;
  font-size: 15px;
  margin-bottom: 4px;
  font-family: 'Inter', sans-serif;
}
.sp-card-body .sp-c {
  display: inline-block;
  background: rgba(220, 38, 38, 0.12);
  color: #ef4444;
  font-size: 11px;
  font-weight: 600;
  padding: 3px 10px;
  border-radius: 20px;
  text-transform: uppercase;
  letter-spacing: 0.3px;
}
.sp-card-footer {
  padding: 10px 20px 16px;
  text-align: center;
  border-top: 1px solid rgba(220, 38, 38, 0.1);
}
.sp-view-btn {
  color: #9ca3af;
  font-size: 12px;
  font-weight: 500;
  transition: color 0.2s ease;
}
.sp-card:hover .sp-view-btn {
  color: #ef4444;
}

/* No Results State */
#ns {
  padding: 40px 20px;
}
#ns b {
  color: #9ca3af;
  font-size: 16px;
}

@media (max-width: 768px) {
  .hero-title { font-size: 26px; }
  .hero-subtitle { font-size: 14px; }
  .hero-content { padding: 40px 16px 36px; }
  .search-card-inner { padding: 18px 16px; }
  .hero-section { min-height: 360px; }
}
</style>

<script>
$('#find_sp').click(function(){
  var s = $('[name="service_id"]').val();
  var a = $('[name="area_id"]').val();
  window.history.pushState({}, null, 'index.php?search&s='+s+'&a='+a);
  load_sp();
});

$(document).ready(function(){
  load_sp();
});

function load_sp(){
  var nl = new URLSearchParams(window.location.search);
  var s = nl.get('s') || '';
  var a = nl.get('a') || '';
  if(s == '' || a == ''){
    $('#sp-list').html('');
    $('#results-header').addClass('d-none');
    return false;
  }
  $('#ns').remove();
  $('#results-header').removeClass('d-none');
  start_load();
  $.ajax({
    url:'admin/ajax.php?action=find_sp',
    method:"POST",
    data:{s:s, a:a},
    error:function(err){
      alert_toast("An error occurred",'error');
      end_load();
    },
    success:function(resp){
      if(typeof (JSON.parse(resp)) === 'object'){
        resp = JSON.parse(resp);
        if(resp.length <= 0){
          $('#sp-list').html('<div class="col-12 text-center py-5" id="ns"><i class="fas fa-search fa-3x mb-3" style="color:#374151;"></i><br><b>No results found. Try a different search.</b></div>');
        } else {
          $('#sp-list').html('');
          Object.keys(resp).map(function(k){
            var data = resp[k];
            var item = $('#clone-sp-item > div').clone();
            item.find('.sp-name').text(data.name);
            item.find('.sp-c').text(data.type);
            item.find('.sp-img').attr('src','assets/uploads/'+data.img_path);
            item.find('.sp-item').attr('data-id', data.id);
            $('#sp-list').append(item);
          });
        }
      }
    },
    complete:function(){
      end_load();
      if($('#sp-list').offset()){
        $("html, body").animate({ scrollTop: $('#sp-list').offset().top - 80 }, "fast");
      }
      $('.sp-item').click(function(){
        uni_modal("","view_persons_companies.php?view=user&id="+$(this).attr('data-id'),'large');
      });
    }
  });
}
</script>