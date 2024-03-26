<?php
session_start();
include("connect.php");
include("backend/functions.php");
$user_data = check_login($con);
?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
  ob_start();
  $title = isset($_GET['page']) ? ucwords(str_replace("_", ' ', $_GET['page'])) : "Home";
  ?>
  <title><?php echo $title ?> | ABH inventory Management System</title>
  <?php ob_end_flush() ?>
  <link rel="shortcut icon" type="image/icon" href="assets/dist/img/logo.png" />

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- SweetAlert2 -->
  <!-- Toastr -->
  <link rel="stylesheet" href="assets/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="assets/dist/css/styles.css">
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- summernote -->
  <link rel="stylesheet" href="assets/plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="assets/dist/css/sweetalert2.min.css">
  <script src="assets/dist/js/sweetalert2.min.js"></script>

  <!-- Chart -->
  <link rel="stylesheet" href="assets/plugins/chart.js/Chart.css">
  <link rel="stylesheet" href="assets/plugins/chart.js/Chart.min.css">
  <script src="assets/plugins/chart.js/Chart.min.js"></script>
  <script src="assets/plugins/chart.js/Chart.bundle.js"></script>
  <script src="assets/plugins/chart.js/Chart.bundle.min.js"></script>
  <script src="assets/plugins/chart.js/Chart.js"></script>
  <script src="assets/plugins/chart.js/zoom.min.js"></script>


</head>

<body>
  <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="imageModalLabel">Asset Image</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <img id="previewImage" src="" class="img-fluid" alt="Preview" style="max-width: 100%; max-height: 70vh; margin: auto;">
        </div>

      </div>
    </div>
  </div>
</body>