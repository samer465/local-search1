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
           RED & BLACK THEME - CUSTOM OVERRIDES
           ============================================ */
        
        /* Primary Color Variables - Red & Black Theme */
        :root {
            --theme-red: #dc2626;
            --theme-red-dark: #b91c1c;
            --theme-red-darker: #991b1b;
            --theme-red-light: #ef4444;
            --theme-red-soft: #fee2e2;
            --theme-black: #111827;
            --theme-black-light: #1f2937;
            --theme-black-lighter: #374151;
            --theme-gray-dark: #4b5563;
            --theme-white: #ffffff;
            --theme-off-white: #f9fafb;
        }

        /* Body Background - Dark Gradient */
        body {
            background: linear-gradient(135deg, #0a0c10 0%, #14181f 100%);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        /* Main Sidebar (Left Menu) - Black Theme */
        .main-sidebar,
        .main-sidebar .sidebar {
            background: linear-gradient(180deg, #0f1117 0%, #0a0c10 100%);
            border-right: 1px solid rgba(220, 38, 38, 0.15);
        }

        .main-sidebar .nav-sidebar .nav-item > .nav-link {
            color: #d1d5db;
            transition: all 0.25s ease;
        }

        .main-sidebar .nav-sidebar .nav-item > .nav-link:hover {
            background: rgba(220, 38, 38, 0.12);
            color: #ef4444;
        }

        .main-sidebar .nav-sidebar .nav-item > .nav-link.active {
            background: linear-gradient(90deg, rgba(220, 38, 38, 0.2), transparent);
            color: #ef4444;
            border-left: 3px solid #dc2626;
        }

        .main-sidebar .brand-link {
            border-bottom: 1px solid rgba(220, 38, 38, 0.3);
            background: #0a0c10;
        }

        .main-sidebar .brand-link .brand-text {
            color: #ef4444;
            font-weight: 600;
        }

        /* Top Navbar - Black with Red Accent */
        .main-header.navbar {
            background: linear-gradient(90deg, #0f1117 0%, #111827 100%);
            border-bottom: 2px solid #dc2626;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .main-header .nav-link {
            color: #e5e7eb !important;
        }

        .main-header .nav-link:hover {
            color: #ef4444 !important;
        }

        /* Content Wrapper - Dark Background */
        .content-wrapper {
            background: #0f1117;
        }

        /* Cards - Black/Dark with Red Borders */
        .card {
            background: #1a1e24;
            border: 1px solid rgba(220, 38, 38, 0.2);
            border-radius: 0.75rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .card-header {
            background: #1f242c;
            border-bottom: 1px solid rgba(220, 38, 38, 0.3);
            color: #f3f4f6;
        }

        .card-header .card-title {
            color: #ef4444;
            font-weight: 600;
        }

        .card-body {
            background: #1a1e24;
            color: #e5e7eb;
        }

        .card-footer {
            background: #1f242c;
            border-top: 1px solid rgba(220, 38, 38, 0.2);
        }

        /* Buttons - Red Theme */
        .btn-primary {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            border: none;
            box-shadow: 0 2px 6px rgba(220, 38, 38, 0.3);
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.4);
        }

        .btn-danger {
            background: #991b1b;
            border: none;
        }

        .btn-danger:hover {
            background: #b91c1c;
        }

        .btn-outline-primary {
            border-color: #dc2626;
            color: #dc2626;
        }

        .btn-outline-primary:hover {
            background: #dc2626;
            border-color: #dc2626;
            color: #fff;
        }

        .btn-secondary {
            background: #374151;
            border: none;
        }

        /* Tables */
        .table {
            color: #e5e7eb;
        }

        .table thead th {
            background: #1f242c;
            border-bottom: 2px solid #dc2626;
            color: #ef4444;
        }

        .table tbody tr {
            border-bottom: 1px solid rgba(220, 38, 38, 0.15);
        }

        .table tbody tr:hover {
            background: rgba(220, 38, 38, 0.08);
        }

        /* Modals - Dark Theme */
        .modal-content {
            background: #1a1e24;
            border: 1px solid #dc2626;
            border-radius: 1rem;
        }

        .modal-header {
            border-bottom: 1px solid rgba(220, 38, 38, 0.3);
            background: #1f242c;
        }

        .modal-header .modal-title {
            color: #ef4444;
            font-weight: 600;
        }

        .modal-body {
            color: #e5e7eb;
        }

        .modal-footer {
            border-top: 1px solid rgba(220, 38, 38, 0.2);
        }

        /* Form Controls */
        .form-control {
            background: #111827;
            border: 1px solid #374151;
            color: #f3f4f6;
        }

        .form-control:focus {
            background: #1f2937;
            border-color: #dc2626;
            box-shadow: 0 0 0 0.2rem rgba(220, 38, 38, 0.25);
            color: #fff;
        }

        .form-group label {
            color: #ef4444;
            font-weight: 500;
        }

        /* Dropdown Menus */
        .dropdown-menu {
            background: #1f242c;
            border: 1px solid rgba(220, 38, 38, 0.3);
        }

        .dropdown-item {
            color: #e5e7eb;
        }

        .dropdown-item:hover {
            background: rgba(220, 38, 38, 0.15);
            color: #ef4444;
        }

        /* Alerts & Toasts */
        .alert-danger {
            background: rgba(153, 27, 27, 0.2);
            border-color: #dc2626;
            color: #fecaca;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            border-color: #22c55e;
            color: #bbf7d0;
        }

        .toast {
            background: #1f242c;
            border-left: 4px solid #dc2626;
        }

        .toast-body {
            color: #e5e7eb;
        }

        /* Pagination */
        .pagination .page-item .page-link {
            background: #1f242c;
            border-color: #374151;
            color: #e5e7eb;
        }

        .pagination .page-item.active .page-link {
            background: #dc2626;
            border-color: #dc2626;
            color: #fff;
        }

        .pagination .page-item .page-link:hover {
            background: rgba(220, 38, 38, 0.2);
            color: #ef4444;
        }

        /* Footer */
        .main-footer {
            background: #0f1117;
            border-top: 1px solid rgba(220, 38, 38, 0.3);
            color: #9ca3af;
        }

        /* Tabs */
        .nav-tabs {
            border-bottom: 1px solid rgba(220, 38, 38, 0.3);
        }

        .nav-tabs .nav-link {
            color: #9ca3af;
        }

        .nav-tabs .nav-link:hover {
            border-color: #dc2626;
            color: #ef4444;
        }

        .nav-tabs .nav-link.active {
            background: #1a1e24;
            border-color: #dc2626 #dc2626 #1a1e24;
            color: #ef4444;
        }

        /* Progress Bars */
        .progress {
            background: #374151;
        }

        .progress-bar {
            background: #dc2626;
        }

        /* List Groups */
        .list-group-item {
            background: #1a1e24;
            border-color: rgba(220, 38, 38, 0.2);
            color: #e5e7eb;
        }

        /* Badges */
        .badge-danger, .badge-primary {
            background: #dc2626;
        }

        /* Close Button */
        .close {
            color: #ef4444;
            text-shadow: none;
            opacity: 0.8;
        }

        .close:hover {
            color: #dc2626;
            opacity: 1;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #111827;
        }

        ::-webkit-scrollbar-thumb {
            background: #dc2626;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #ef4444;
        }

        /* Select2 Override if used */
        .select2-container--default .select2-selection--single {
            background: #111827;
            border-color: #374151;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #f3f4f6;
        }

        /* Summernote Editor */
        .note-editor.note-frame {
            background: #111827;
            border-color: #374151;
        }

        .note-editor.note-frame .note-editing-area .note-editable {
            background: #111827;
            color: #e5e7eb;
        }

        .note-toolbar {
            background: #1f242c !important;
            border-bottom: 1px solid #dc2626 !important;
        }

        /* Cards with outline */
        .card.card-outline.card-primary {
            border-color: #dc2626;
        }

        .card.card-outline.card-primary .card-header {
            background: #1f242c;
        }

        /* DataTables */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            color: #e5e7eb !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: #dc2626 !important;
            border-color: #dc2626 !important;
            color: #fff !important;
        }

        /* Info Boxes */
        .info-box {
            background: #1a1e24;
            border: 1px solid rgba(220, 38, 38, 0.2);
        }

        .info-box .info-box-icon {
            background: rgba(220, 38, 38, 0.15);
        }

        .info-box .info-box-number {
            color: #ef4444;
        }

        /* Small text adjustments */
        .text-muted {
            color: #9ca3af !important;
        }

        .text-primary {
            color: #ef4444 !important;
        }

        .bg-primary {
            background: #dc2626 !important;
        }

        .bg-gradient-primary {
            background: linear-gradient(135deg, #dc2626, #b91c1c) !important;
        }

        /* Accordion */
        .accordion-item {
            background: #1a1e24;
            border-color: rgba(220, 38, 38, 0.2);
        }

        .accordion-button {
            background: #1f242c;
            color: #ef4444;
        }

        .accordion-button:not(.collapsed) {
            background: #dc2626;
            color: #fff;
        }

        .accordion-body {
            background: #1a1e24;
        }

        /* Sweet Alert Override if used */
        .swal2-popup {
            background: #1a1e24;
        }

        .swal2-title, .swal2-html-container {
            color: #e5e7eb;
        }

        /* Fix for sidebar collapse button */
        .nav-sidebar .nav-link i {
            color: inherit;
        }

        /* User dropdown */
        .user-panel .info {
            color: #e5e7eb;
        }

        .user-panel .image img {
            border-color: #dc2626;
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
            border-color: rgba(220, 38, 38, 0.5);
            transition: all 0.3s ease;
        }

        /* Custom red border for active states */
        .nav-link.active {
            color: #ef4444 !important;
        }

        /* Small icon adjustments */
        .nav-icon {
            color: #9ca3af;
        }

        .nav-link.active .nav-icon {
            color: #ef4444;
        }

        /* Fix for sidebar menu header */
        .nav-sidebar .nav-header {
            color: #dc2626;
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
            color: #ef4444;
        }

        .nav-treeview > .nav-item > .nav-link.active {
            color: #ef4444;
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
  <footer class="main-footer" style="position: static !important; background: #0a0c10; border-top: 1px solid rgba(220,38,38,0.2); padding: 0;">
    <div class="container">
      <div class="row py-4">
        <div class="col-md-4 mb-3 mb-md-0">
          <div class="d-flex align-items-center mb-2">
            <span style="width:32px;height:32px;background:linear-gradient(135deg,#dc2626,#ef4444);border-radius:8px;display:inline-flex;align-items:center;justify-content:center;margin-right:8px;">
              <i class="fas fa-search-location text-white" style="font-size:14px;"></i>
            </span>
            <strong style="color:#f3f4f6;font-size:16px;"><?php echo $_SESSION['system']['name'] ?></strong>
          </div>
          <p style="color:#9ca3af;font-size:13px;line-height:1.6;margin:0;">
            Find trusted local service providers in your area. Your one-stop platform for connecting with professionals.
          </p>
        </div>
        <div class="col-md-4 mb-3 mb-md-0">
          <h6 style="color:#ef4444;font-weight:700;font-size:13px;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:12px;">Quick Links</h6>
          <ul style="list-style:none;padding:0;margin:0;">
            <li style="margin-bottom:6px;"><a href="./" style="color:#9ca3af;font-size:13px;text-decoration:none;transition:color 0.2s;"><i class="fas fa-chevron-right mr-1" style="font-size:10px;color:#dc2626;"></i> Home</a></li>
            <li style="margin-bottom:6px;"><a href="./index.php?page=services" style="color:#9ca3af;font-size:13px;text-decoration:none;"><i class="fas fa-chevron-right mr-1" style="font-size:10px;color:#dc2626;"></i> Services</a></li>
            <li style="margin-bottom:6px;"><a href="./index.php?page=about" style="color:#9ca3af;font-size:13px;text-decoration:none;"><i class="fas fa-chevron-right mr-1" style="font-size:10px;color:#dc2626;"></i> About Us</a></li>
            <li><a href="./index.php?page=contact_us" style="color:#9ca3af;font-size:13px;text-decoration:none;"><i class="fas fa-chevron-right mr-1" style="font-size:10px;color:#dc2626;"></i> Contact Us</a></li>
          </ul>
        </div>
        <div class="col-md-4">
          <h6 style="color:#ef4444;font-weight:700;font-size:13px;text-transform:uppercase;letter-spacing:0.5px;margin-bottom:12px;">Contact Info</h6>
          <?php if(!empty($_SESSION['system']['email'])): ?>
          <p style="color:#9ca3af;font-size:13px;margin-bottom:6px;"><i class="fas fa-envelope mr-2" style="color:#dc2626;font-size:12px;"></i> <?php echo $_SESSION['system']['email'] ?></p>
          <?php endif; ?>
          <?php if(!empty($_SESSION['system']['contact'])): ?>
          <p style="color:#9ca3af;font-size:13px;margin-bottom:6px;"><i class="fas fa-phone mr-2" style="color:#dc2626;font-size:12px;"></i> <?php echo $_SESSION['system']['contact'] ?></p>
          <?php endif; ?>
          <?php if(!empty($_SESSION['system']['address'])): ?>
          <p style="color:#9ca3af;font-size:13px;margin-bottom:0;"><i class="fas fa-map-marker-alt mr-2" style="color:#dc2626;font-size:12px;"></i> <?php echo $_SESSION['system']['address'] ?></p>
          <?php endif; ?>
        </div>
      </div>
      <div class="text-center py-3" style="border-top:1px solid rgba(220,38,38,0.1);">
        <small style="color:#6b7280;font-size:12px;">&copy; <?php echo date('Y') ?> <?php echo $_SESSION['system']['name'] ?>. All rights reserved.</small>
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
            $(this).css('border-left', '3px solid #dc2626');
        });
        
        // Make sure any dataTables pagination has proper styling
        if ($.fn.dataTable) {
            $('.dataTable').on('draw.dt', function() {
                $('.paginate_button.current').css({
                    'background': '#dc2626',
                    'border-color': '#dc2626'
                });
            });
        }
        
        // Toast notifications theme
        $('#alert_toast').css({
            'background': '#1f242c',
            'border-left': '4px solid #dc2626'
        });
        
        console.log('Red & Black Theme Loaded Successfully');
    });
</script>

</body>
</html>