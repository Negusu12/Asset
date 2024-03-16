<!DOCTYPE html>
<html lang="en">
<?php include('connect.php') ?>
<?php
include 'header.php'
?>
<style>
  img {
    height: 50px;
    width: 50px;
    background-color: red;
    margin-top: -7px;
    margin-left: 80%;
    animation: shake 0.5s ease-in-out infinite;
  }

  @keyframes shake {
    0% {
      transform: translateX(0);
    }

    10%,
    30%,
    50%,
    70%,
    90% {
      transform: translateX(-5px);
    }

    20%,
    40%,
    60%,
    80% {
      transform: translateX(5px);
    }

    100% {
      transform: translateX(0);
    }
  }

  .notification-container {
    position: relative;
    display: inline-block;
    margin-left: 80%;
  }

  .notification-count {
    position: absolute;
    top: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: red;
    color: white;
    font-size: 30px;
    text-align: center;
    line-height: 20px;

  }
</style>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php include 'topbar.php' ?>
    <?php include 'sidebar.php' ?>

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
        <div class="container-fluid">
          <?php
          $page = isset($_GET['page']) ? $_GET['page'] : 'home'; // Set a default value if $_GET['page'] is not set
          $page_file = $page . '.php'; // Construct the file path

          // Check if the file exists before including it
          if (file_exists($page_file)) {
            include $page_file;
          } else {
            // Handle the case where the file does not exist (e.g., display an error message)
            echo "Error: Page not found";
          }

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
    <footer class="main-footer">
      <strong>Copyright &copy; 2024 <a1 href="https://abhpartners.com/"></a1>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>ABH inventory Management System</b>
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <!-- Bootstrap -->
  <?php include 'footer.php' ?>
</body>

</html>