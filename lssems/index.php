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
  include 'header.php' 
?>
<head>
    <style>
        /* ============================================
           BLUE & WHITE THEME - CUSTOM OVERRIDES
           ============================================ */
        
        /* Primary Color Variables - Blue & White Theme */
        :root {
            --theme-primary: #4f46e5;
            --theme-primary-dark: #4338ca;
            --theme-primary-darker: #3730a3;
            --theme-primary-light: #6366f1;
            --theme-primary-soft: #eef2ff;
            --theme-bg: #f8fafc;
            --theme-bg-card: #ffffff;
            --theme-bg-dark: #1e293b;
            --theme-border: #e2e8f0;
            --theme-text: #1e293b;
            --theme-text-muted: #64748b;
            --theme-white: #ffffff;
        }

        /* Body Background - Light */
        body {
            background: #f0f4ff;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        /* Main Sidebar (Left Menu) */
        .main-sidebar,
        .main-sidebar .sidebar {
            background: #fff;
            border-right: 1px solid #e2e8f0;
        }

        .main-sidebar .nav-sidebar .nav-item > .nav-link {
            color: #64748b;
            transition: all 0.25s ease;
        }

        .main-sidebar .nav-sidebar .nav-item > .nav-link:hover {
            background: rgba(79, 70, 229, 0.12);
            color: #6366f1;
        }

        .main-sidebar .nav-sidebar .nav-item > .nav-link.active {
            background: linear-gradient(90deg, rgba(79, 70, 229, 0.2), transparent);
            color: #6366f1;
            border-left: 3px solid #4f46e5;
        }

        .main-sidebar .brand-link {
            border-bottom: 1px solid rgba(79, 70, 229, 0.3);
            background: #f0f4ff;
        }

        .main-sidebar .brand-link .brand-text {
            color: #6366f1;
            font-weight: 600;
        }

        /* Top Navbar - Black with Red Accent */
        .main-header.navbar {
            background: linear-gradient(90deg, #f8fafc 0%, #f1f5f9 100%);
            border-bottom: 2px solid #4f46e5;
            box-shadow: 0 2px 10px rgba(79, 70, 229, 0.06);
        }

        .main-header .nav-link {
            color: #475569 !important;
        }

        .main-header .nav-link:hover {
            color: #6366f1 !important;
        }

        /* Content Wrapper - Light Background */
        .content-wrapper {
            background: #f0f4ff;
        }

        /* Cards - Black/Dark with Red Borders */
        .card {
            background: #ffffff;
            border: 1px solid rgba(79, 70, 229, 0.2);
            border-radius: 0.75rem;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.06);
        }

        .card-header {
            background: #f8fafc;
            border-bottom: 1px solid rgba(79, 70, 229, 0.3);
            color: #1e293b;
        }

        .card-header .card-title {
            color: #6366f1;
            font-weight: 600;
        }

        .card-body {
            background: #ffffff;
            color: #475569;
        }

        .card-footer {
            background: #f8fafc;
            border-top: 1px solid rgba(79, 70, 229, 0.2);
        }

        /* Buttons - Red Theme */
        .btn-primary {
            background: linear-gradient(135deg, #4f46e5, #4338ca);
            border: none;
            box-shadow: 0 2px 6px rgba(79, 70, 229, 0.3);
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #6366f1, #4f46e5);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.4);
        }

        .btn-danger {
            background: #3730a3;
            border: none;
        }

        .btn-danger:hover {
            background: #4338ca;
        }

        .btn-outline-primary {
            border-color: #4f46e5;
            color: #4f46e5;
        }

        .btn-outline-primary:hover {
            background: #4f46e5;
            border-color: #4f46e5;
            color: #fff;
        }

        .btn-secondary {
            background: #e2e8f0;
            border: none;
        }

        /* Tables */
        .table {
            color: #475569;
        }

        .table thead th {
            background: #f8fafc;
            border-bottom: 2px solid #4f46e5;
            color: #6366f1;
        }

        .table tbody tr {
            border-bottom: 1px solid rgba(79, 70, 229, 0.15);
        }

        .table tbody tr:hover {
            background: rgba(79, 70, 229, 0.08);
        }

        /* Modals - Dark Theme */
        .modal-content {
            background: #ffffff;
            border: 1px solid #4f46e5;
            border-radius: 1rem;
        }

        .modal-header {
            border-bottom: 1px solid rgba(79, 70, 229, 0.3);
            background: #f8fafc;
        }

        .modal-header .modal-title {
            color: #6366f1;
            font-weight: 600;
        }

        .modal-body {
            color: #475569;
        }

        .modal-footer {
            border-top: 1px solid rgba(79, 70, 229, 0.2);
        }

        /* Form Controls */
        .form-control {
            background: #f1f5f9;
            border: 1px solid #e2e8f0;
            color: #1e293b;
        }

        .form-control:focus {
            background: #f1f5f9;
            border-color: #4f46e5;
            box-shadow: 0 0 0 0.2rem rgba(79, 70, 229, 0.25);
            color: #fff;
        }

        .form-group label {
            color: #6366f1;
            font-weight: 500;
        }

        /* Dropdown Menus */
        .dropdown-menu {
            background: #f8fafc;
            border: 1px solid rgba(79, 70, 229, 0.3);
        }

        .dropdown-item {
            color: #475569;
        }

        .dropdown-item:hover {
            background: rgba(79, 70, 229, 0.15);
            color: #6366f1;
        }

        /* Alerts & Toasts */
        .alert-danger {
            background: rgba(153, 27, 27, 0.2);
            border-color: #4f46e5;
            color: #fecaca;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            border-color: #22c55e;
            color: #bbf7d0;
        }

        .toast {
            background: #f8fafc;
            border-left: 4px solid #4f46e5;
        }

        .toast-body {
            color: #475569;
        }

        /* Pagination */
        .pagination .page-item .page-link {
            background: #f8fafc;
            border-color: #e2e8f0;
            color: #475569;
        }

        .pagination .page-item.active .page-link {
            background: #4f46e5;
            border-color: #4f46e5;
            color: #fff;
        }

        .pagination .page-item .page-link:hover {
            background: rgba(79, 70, 229, 0.2);
            color: #6366f1;
        }

        /* Footer */
        .main-footer {
            background: #f8fafc;
            border-top: 1px solid rgba(79, 70, 229, 0.3);
            color: #94a3b8;
        }

        /* Tabs */
        .nav-tabs {
            border-bottom: 1px solid rgba(79, 70, 229, 0.3);
        }

        .nav-tabs .nav-link {
            color: #94a3b8;
        }

        .nav-tabs .nav-link:hover {
            border-color: #4f46e5;
            color: #6366f1;
        }

        .nav-tabs .nav-link.active {
            background: #ffffff;
            border-color: #4f46e5 #4f46e5 #ffffff;
            color: #6366f1;
        }

        /* Progress Bars */
        .progress {
            background: #e2e8f0;
        }

        .progress-bar {
            background: #4f46e5;
        }

        /* List Groups */
        .list-group-item {
            background: #ffffff;
            border-color: rgba(79, 70, 229, 0.2);
            color: #475569;
        }

        /* Badges */
        .badge-danger, .badge-primary {
            background: #4f46e5;
        }

        /* Close Button */
        .close {
            color: #6366f1;
            text-shadow: none;
            opacity: 0.8;
        }

        .close:hover {
            color: #4f46e5;
            opacity: 1;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #4f46e5;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #6366f1;
        }

        /* Select2 Override if used */
        .select2-container--default .select2-selection--single {
            background: #f1f5f9;
            border-color: #e2e8f0;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #1e293b;
        }

        /* Summernote Editor */
        .note-editor.note-frame {
            background: #f1f5f9;
            border-color: #e2e8f0;
        }

        .note-editor.note-frame .note-editing-area .note-editable {
            background: #f1f5f9;
            color: #475569;
        }

        .note-toolbar {
            background: #f8fafc !important;
            border-bottom: 1px solid #4f46e5 !important;
        }

        /* Cards with outline */
        .card.card-outline.card-primary {
            border-color: #4f46e5;
        }

        .card.card-outline.card-primary .card-header {
            background: #f8fafc;
        }

        /* DataTables */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #475569 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #4f46e5 !important;
            border-color: #4f46e5 !important;
            color: #fff !important;
        }

        /* Info Boxes */
        .info-box {
            background: #ffffff;
            border: 1px solid rgba(79, 70, 229, 0.2);
        }

        .info-box .info-box-icon {
            background: rgba(79, 70, 229, 0.15);
        }

        .info-box .info-box-number {
            color: #6366f1;
        }

        /* Small text adjustments */
        .text-muted {
            color: #94a3b8 !important;
        }

        .text-primary {
            color: #6366f1 !important;
        }

        .bg-primary {
            background: #4f46e5 !important;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #4f46e5, #4338ca) !important;
        }

        /* Accordion */
        .accordion-item {
            background: #ffffff;
            border-color: rgba(79, 70, 229, 0.2);
        }

        .accordion-button {
            background: #f8fafc;
            color: #6366f1;
        }

        .accordion-button:not(.collapsed) {
            background: #4f46e5;
            color: #fff;
        }

        .accordion-body {
            background: #ffffff;
        }

        /* Sweet Alert Override if used */
        .swal2-popup {
            background: #ffffff;
        }

        .swal2-title, .swal2-html-container {
            color: #475569;
        }

        /* Fix for sidebar collapse button */
        .nav-sidebar .nav-link i {
            color: inherit;
        }

        /* User dropdown */
        .user-panel .info {
            color: #475569;
        }

        .user-panel .image img {
            border-color: #4f46e5;
        }

        /* Animation for hover effects */
        .btn, .nav-link, .dropdown-item {
            transition: all 0.2s ease-in-out;
        }

        /* Table striped effect */
        .table-striped tbody tr:nth-of-type(odd) {
            background: rgba(31, 36, 44, 0.6);
        }

        /* Card hover effect */
        .card:hover {
            border-color: rgba(79, 70, 229, 0.5);
            transition: all 0.3s ease;
        }

        /* Custom red border for active states */
        .nav-link.active {
            color: #6366f1 !important;
        }

        /* Small icon adjustments */
        .nav-icon {
            color: #94a3b8;
        }

        .nav-link.active .nav-icon {
            color: #6366f1;
        }

        /* Fix for sidebar menu header */
        .nav-sidebar .nav-header {
            color: #4f46e5;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.7rem;
            letter-spacing: 0.5px;
        }

        /* Treeview menu */
        .nav-treeview > .nav-item > .nav-link {
            color: #b0b7c4;
        }

        .nav-treeview > .nav-item > .nav-link:hover {
            color: #6366f1;
        }

        .nav-treeview > .nav-item > .nav-link.active {
            color: #6366f1;
        }
    </style>
</head>
<body class="hold-transition layout-fixed layout-navbar-fixed layout-footer-fixed sidebar-collapse">
<div class="wrapper">
  <?php include 'topbar.php' ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  	 <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
	    <div class="toast-body text-white">
	    </div>
	  </div>
    <div id="toastsContainerTopRight" class="toasts-top-right fixed"></div>
    <!-- Content Header (Page header) -->
   
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-md">
         <?php 
          $page = isset($_GET['page']) ? $_GET['page'] : 'home';
          include $page.'.php';
          ?>
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
    <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-right"></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
              <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
              <img src="" alt="">
      </div>
    </div>
  </div>
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer" style="position: static !important; background: #f0f4ff; border-top: 1px solid rgba(79,70,229,0.2); padding: 0;">
    <div class="container">
      <div class="row py-4">
        <div class="col-md-4 mb-3 mb-md-0">
          <div class="d-flex align-items-center mb-2">
            <span style="width:32px;height:32px;background:linear-gradient(135deg,#4f46e5,#6366f1);border-radius:8px;display:inline-flex;align-items:center;justify-content:center;margin-right:8px;">
              <i class="fas fa-search-location text-white" style="font-size:14px;"></i>
            </span>
            <strong style="color:#1e293b;font-size:16px;"><?php echo $_SESSION['system']['name'] ?></strong>
          </div>
          <p style="color:#94a3b8;font-size:13px;line-height:1.6;margin:0;">
            Find trusted local service providers in your area. Your one-stop platform for connecting with professionals.
          </p>
        </div>
        <div class="col-md-4 mb-3 mb-md-0">
          <h6 style="color:#6366f1;font-weight:700;font-size:13px;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:12px;">Quick Links</h6>
          <ul style="list-style:none;padding:0;margin:0;">
            <li style="margin-bottom:6px;"><a href="./" style="color:#94a3b8;font-size:13px;text-decoration:none;transition:color 0.2s;"><i class="fas fa-chevron-right mr-1" style="font-size:10px;color:#4f46e5;"></i> Home</a></li>
            <li style="margin-bottom:6px;"><a href="./index.php?page=services" style="color:#94a3b8;font-size:13px;text-decoration:none;"><i class="fas fa-chevron-right mr-1" style="font-size:10px;color:#4f46e5;"></i> Services</a></li>
            <li style="margin-bottom:6px;"><a href="./index.php?page=about" style="color:#94a3b8;font-size:13px;text-decoration:none;"><i class="fas fa-chevron-right mr-1" style="font-size:10px;color:#4f46e5;"></i> About Us</a></li>
            <li><a href="./index.php?page=contact_us" style="color:#94a3b8;font-size:13px;text-decoration:none;"><i class="fas fa-chevron-right mr-1" style="font-size:10px;color:#4f46e5;"></i> Contact Us</a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <h6 style="color:#6366f1;font-weight:700;font-size:13px;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:12px;">Contact Info</h6>
          <?php if(!empty($_SESSION['system']['email'])): ?>
          <p style="color:#94a3b8;font-size:13px;margin-bottom:6px;"><i class="fas fa-envelope mr-2" style="color:#4f46e5;font-size:12px;"></i> <?php echo $_SESSION['system']['email'] ?></p>
          <?php endif; ?>
          <?php if(!empty($_SESSION['system']['contact'])): ?>
          <p style="color:#94a3b8;font-size:13px;margin-bottom:6px;"><i class="fas fa-phone mr-2" style="color:#4f46e5;font-size:12px;"></i> <?php echo $_SESSION['system']['contact'] ?></p>
          <?php endif; ?>
          <?php if(!empty($_SESSION['system']['address'])): ?>
          <p style="color:#94a3b8;font-size:13px;margin-bottom:0;"><i class="fas fa-map-marker-alt mr-2" style="color:#4f46e5;font-size:12px;"></i> <?php echo $_SESSION['system']['address'] ?></p>
          <?php endif; ?>
        </div>
      </div>
      <div class="text-center py-3" style="border-top:1px solid rgba(79,70,229,0.1);">
        <small style="color:#94a3b8;font-size:12px;">&copy; <?php echo date('Y') ?> <?php echo $_SESSION['system']['name'] ?>. All rights reserved.</small>
      </div>
    </div>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<!-- Bootstrap -->
<?php include 'footer.php' ?>

<script>
    // Additional JavaScript to ensure dynamic elements adopt red/black theme
    $(document).ready(function() {
        // Force any dynamically added buttons to have proper red theme
        $(document).on('click', '.btn-primary', function() {
            // Just to ensure any dynamic hover effects work
        });
        
        // Override any inline styles that might conflict
        $('.card-primary').addClass('card-outline');
        
        // Add red border to active sidebar items if missing
        $('.nav-sidebar .nav-link.active').each(function() {
            $(this).css('border-left', '3px solid #4f46e5');
        });
        
        // Make sure any dataTables pagination has proper styling
        if ($.fn.dataTable) {
            $('.dataTable').on('draw.dt', function() {
                $('.paginate_button.current').css({
                    'background': '#4f46e5',
                    'border-color': '#4f46e5'
                });
            });
        }
        
        // Toast notifications theme
        $('#alert_toast').css({
            'background': '#f8fafc',
            'border-left': '4px solid #4f46e5'
        });
        
        console.log('Red & Black Theme Loaded Successfully');
    });
</script>

</body>
</html>