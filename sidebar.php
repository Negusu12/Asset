<head>
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>
<aside class="main-sidebar sidebar_background elevation-4">
  <div class="dropdown">
    <a href="javascript:void(0)" class="brand-link dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
      <span class="brand-image img-circle elevation-3 d-flex justify-content-center align-items-center bg-primary text-white font-weight-500" style="width: 38px;height:50px"><?php echo strtoupper(substr($user_data['user_name'], 0, 1)) ?></span>
      <span class="brand-text font-weight-light"><?php echo ucwords($user_data['user_name']); ?></span>

    </a>
    <div class="dropdown-menu">
      <a class="dropdown-item" href="index.php?page=manage_user">Manage Account</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="logout.php">Logout</a>
    </div>
  </div>
  <div class="sidebar">
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item dropdown">
          <a href="./" class="nav-link nav-home">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>

        </li>

        <li class="nav-item">
          <a href="#" class="nav-link nav-edit_customer">
            <i class="nav-icon far fa-folder-open"></i>
            <p>
              Forms
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./index.php?page=asset_record" class="nav-link nav-asset_record tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Asset Record</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=asset_buy" class="nav-link nav-asset_buy tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>GRN</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=asset_loan" class="nav-link nav-asset_loan tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Asset Loan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=asset_return" class="nav-link nav-asset_return tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Asset Return</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=asset_use" class="nav-link nav-asset_use tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Asset usage</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=asset_inactive" class="nav-link nav-asset_inactive tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Asset Inactive</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=employee" class="nav-link nav-employee tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Register Borrower</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=list" class="nav-link nav-list tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Add List Choice</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link nav-edit_staff">
            <i class="nav-icon fas fa-scroll"></i>
            <p>
              Report
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="./index.php?page=reports/report_total_summary" class="nav-link nav-report_total_summary tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Total Asset Summary</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=reports/report_asset_onhand" class="nav-link nav-report_asset_onhand tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Asset in Store</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=reports/report_loan" class="nav-link nav-report_loan tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Assets Loan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=reports/report_return" class="nav-link nav-report_return tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Returned Assets</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=reports/report_damaged" class="nav-link nav-report_damaged tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Inactive Assets</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=reports/report_buy" class="nav-link nav-report_buy tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>GRN</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=reports/report_register_asset" class="nav-link nav-report_register_asset tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Asset Log Record</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=reports/report_use" class="nav-link nav-report_use tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Consumption Record</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=reports/report_employee" class="nav-link nav-report_employee tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Borrowers List</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="./index.php?page=reports/report_generate" class="nav-link nav-report_generate tree-item">
                <i class="fas fa-angle-right nav-icon"></i>
                <p>Generate Responsibility Form</p>
              </a>
            </li>
          </ul>
        </li>
        <?php if ($user_data['role'] == 1) : ?>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_staff">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Admin
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=add_user" class="nav-link nav-add_user tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=users" class="nav-link nav-users tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Users Record</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=reports/report_list" class="nav-link nav-report_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List Choice</p>
                </a>
              </li>
            </ul>
          </li>
        <?php endif; ?>
        <?php if ($user_data['role'] == 3) : ?>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_staff">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Super Admin
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=add_user" class="nav-link nav-add_user tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=users" class="nav-link nav-users tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Users Record</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=reports/report_list" class="nav-link nav-report_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List Choice</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=record_adjustment" class="nav-link nav-record_adjustment tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Record Adjustment</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=reports/report_record_adjustment" class="nav-link nav-report_record_adjustment tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Asset Adjustment Log</p>
                </a>
              </li>
            </ul>
          </li>
        <?php endif; ?>
        <?php if (in_array($user_data['role'], [1])) : ?>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_staff">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Ethio Tele
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=charge_record" class="nav-link nav-charge_record tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add Charge</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=ethiotele_transaction" class="nav-link nav-ethiotele_transaction tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add Transaction</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=reports/report_charge" class="nav-link nav-report_charge tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Report Charge</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=reports/report_tele_transactions" class="nav-link nav-report_tele_transactions tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Report Transaction</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=reports/report_tele_transactions_detail" class="nav-link nav-report_tele_transactions_detail tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Report Transaction Detail</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=reports/report_past_tele_transactions" class="nav-link nav-report_past_tele_transactions tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Report inactive Transaction</p>
                </a>
              </li>
            </ul>
          </li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
</aside>
<script>
  $(document).ready(function() {
    var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
    var pageWithoutPath = page.split('/').pop(); // Get the file name from the path
    if ($('.nav-link.nav-' + pageWithoutPath).length > 0) {
      $('.nav-link.nav-' + pageWithoutPath).addClass('active')
      if ($('.nav-link.nav-' + pageWithoutPath).hasClass('tree-item') == true) {
        $('.nav-link.nav-' + pageWithoutPath).closest('.nav-treeview').siblings('a').addClass('active')
        $('.nav-link.nav-' + pageWithoutPath).closest('.nav-treeview').parent().addClass('menu-open')
      }
    }

    $('#search-nav').on('keyup', function() {
      var value = $(this).val().toLowerCase();
      $('.nav-item').filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });

    $('.manage_account').click(function() {
      uni_modal('Manage Account', 'manage_user.php?id=' + $(this).attr('data-id'))
    })
  })
</script>