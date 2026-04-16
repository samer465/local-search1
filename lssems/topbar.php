<!-- Navbar -->
  <nav class="main-header navbar navbar-expand-lg navbar-dark" style="background: linear-gradient(90deg, #0a0c10 0%, #111827 100%); border-bottom: 2px solid #dc2626; box-shadow: 0 4px 20px rgba(0,0,0,0.4); padding: 0;">
    <div class="container">
      <!-- Brand -->
      <a class="navbar-brand d-flex align-items-center" href="./" style="padding: 12px 0;">
        <span style="width:38px;height:38px;background:linear-gradient(135deg,#dc2626,#ef4444);border-radius:10px;display:inline-flex;align-items:center;justify-content:center;margin-right:10px;box-shadow:0 4px 12px rgba(220,38,38,0.3);">
          <i class="fas fa-search-location text-white" style="font-size:18px;"></i>
        </span>
        <span style="font-size:20px;font-weight:700;color:#fff;letter-spacing:-0.3px;"><?php echo $_SESSION['system']['name'] ?></span>
      </a>

      <!-- Mobile Toggle -->
      <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation" style="padding:8px;">
        <span class="fas fa-bars" style="color:#ef4444;font-size:20px;"></span>
      </button>

      <!-- Nav Links -->
      <div class="collapse navbar-collapse" id="mainNavbar">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link nav-home px-3" href="./" style="font-weight:600;font-size:14px;letter-spacing:0.3px;transition:all 0.2s ease;">
              <i class="fas fa-home mr-1" style="font-size:12px;"></i> Home
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-services px-3" href="./index.php?page=services" style="font-weight:600;font-size:14px;letter-spacing:0.3px;transition:all 0.2s ease;">
              <i class="fas fa-concierge-bell mr-1" style="font-size:12px;"></i> Services
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-about px-3" href="./index.php?page=about" style="font-weight:600;font-size:14px;letter-spacing:0.3px;transition:all 0.2s ease;">
              <i class="fas fa-info-circle mr-1" style="font-size:12px;"></i> About
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-contact_us px-3" href="./index.php?page=contact_us" style="font-weight:600;font-size:14px;letter-spacing:0.3px;transition:all 0.2s ease;">
              <i class="fas fa-envelope mr-1" style="font-size:12px;"></i> Contact
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <style>
    .main-header.navbar .nav-link {
      color: #d1d5db !important;
      position: relative;
      padding-top: 16px !important;
      padding-bottom: 16px !important;
    }
    .main-header.navbar .nav-link:hover {
      color: #ef4444 !important;
      background: rgba(220, 38, 38, 0.08);
    }
    .main-header.navbar .nav-link.active {
      color: #ef4444 !important;
      background: rgba(220, 38, 38, 0.1);
    }
    .main-header.navbar .nav-link.active::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 60%;
      height: 2px;
      background: #dc2626;
      border-radius: 2px;
    }
    @media (max-width: 991px) {
      .main-header.navbar .navbar-collapse {
        background: #0f1117;
        border-top: 1px solid rgba(220,38,38,0.2);
        padding: 8px 0;
        margin-top: 4px;
        border-radius: 0 0 12px 12px;
      }
      .main-header.navbar .nav-link.active::after {
        display: none;
      }
      .main-header.navbar .nav-link.active {
        border-left: 3px solid #dc2626;
      }
    }
  </style>
  <!-- /.navbar -->
  <script>
    $(document).ready(function(){
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
      if($('.nav-link.nav-'+page).length > 0){
        $('.nav-link.nav-'+page).addClass('active')
        if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
          $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
          $('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
        }
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }
      }
      $('.manage_account').click(function(){
        uni_modal('Manage Account','manage_user.php?id='+$(this).attr('data-id'))
      })
    })
  </script>
