<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-primary navbar-dark ">
  <!-- Left navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
    <div class="navigation_arrow">
      <button class="navigation-btn" onclick="goBack()"><i class="fas fa-arrow-left"></i></button>
      <button class="navigation-btn" onclick="goForward()"><i class="fas fa-arrow-right"></i></button>
    </div>
    <li>
      <a class="nav-link text-white" href="./" role="button">
        <large><b>ABH inventory Management System</b></large>
      </a>
    </li>
    <div style="max-height: 2px; max-width: 2px;">
      <a href="index.php?page=reports/report_tele_transactions_detail&filter=approaching_deadline" class="info-box-link">

        <div class="row mb-2">
          <div class="col-sm-6 bell row">

            <?php
            // Calculate the current date
            $current_date = date('Y-m-d');

            // Calculate the date four days from now
            $four_days_from_now = date('Y-m-d', strtotime('+7 days'));

            // Construct the SQL query to count the number of records where the deadline is approaching within four days
            $query = "SELECT COUNT(*) as num_records             
                    FROM sim_card_transactions_line
                    WHERE expire_date BETWEEN '$current_date' AND '$four_days_from_now' and status = 'Loaned'";

            // Execute the query and fetch the result
            $result = $con->query($query);

            // Check if the query was successful
            if ($result) {
              // Fetch the row as an associative array
              $row = $result->fetch_assoc();

              // Get the number of records from the 'num_records' column
              $num_records = $row['num_records'];

              // Output the number of records

            }
            ?>
            <?php if ($num_records > 0) : ?>
              <div class="notification-container">
                <img src="assets/dist/img/bell-solid.png" style="max-height: 2px; max-width: 2px;">
                <span class="notification-count"><?php echo $num_records; ?></span>
              </div>

            <?php endif; ?>

          </div><!-- /.col -->

        </div><!-- /.row -->
        <hr class="border-primary">
      </a>
    </div>
  </ul>

  <ul class="navbar-nav ml-auto">

    <li class="nav-item">
      <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
      </a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->