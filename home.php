<?php include('connect.php') ?>
<!-- Info boxes -->
<div class="row">

  <div class="col-12 col-sm-6 col-md-3">
    <a href="index.php?page=reports/report_total_summary" class="info-box-link">
      <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-globe-africa"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Asset</span>
          <span class="info-box-number">
            <?php
            // Assuming $con is your database connection object

            // Query to get total quantity of on-hand assets
            $result_on_hand = $con->query("SELECT SUM(qty) AS total_qty FROM asset_record");
            $row_on_hand = $result_on_hand->fetch_assoc();
            $total_qty_on_hand = $row_on_hand['total_qty'];

            // Query to get total quantity of loaned assets
            $result_loaned = $con->query("SELECT SUM(qty) AS total_qty FROM asset_loan_v");
            $row_loaned = $result_loaned->fetch_assoc();
            $total_qty_loaned = $row_loaned['total_qty'];

            // Calculate total assets by adding on-hand and loaned quantities
            $total_assets = $total_qty_on_hand + $total_qty_loaned;

            echo $total_assets;
            ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </a>
    <!-- /.info-box -->
  </div>
  <div class="col-12 col-sm-6 col-md-3">
    <a href="index.php?page=reports/report_asset_onhand" class="info-box-link">
      <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-warehouse"></i></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Asset in Store</span>
          <span class="info-box-number">
            <?php
            $result = $con->query("SELECT SUM(qty) AS total_qty FROM asset_record");
            $row = $result->fetch_assoc();
            echo $row['total_qty'];
            ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </a>
    <!-- /.info-box -->
  </div>
  <div class="col-12 col-sm-6 col-md-3">
    <a href="index.php?page=reports/report_loan" class="info-box-link">
      <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="far fa-credit-card"></i></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Assets on Loan</span>
          <span class="info-box-number">
            <?php
            // Assuming $con is your database connection object

            $result = $con->query("SELECT SUM(qty) AS total_qty FROM asset_loan_v where department != 'damaged'");
            $row = $result->fetch_assoc();
            $total_qty = $row['total_qty'];

            echo "" . $total_qty;
            ?>
          </span>
        </div>
        <!-- /.info-box-content -->
      </div>
    </a>
    <!-- /.info-box -->

  </div>
  <?php if (in_array($user_data['role'], [1, 3])) : ?>
    <div class="col-12 col-sm-6 col-md-3">
      <a href="index.php?page=reports/report_damaged" class="info-box-link">
        <div class="info-box">
          <span class="info-box-icon bg-info elevation-1"><i class="fas fa-dumpster-fire"></i></i></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Inactive Assets</span>
            <span class="info-box-number">
              <?php
              // Assuming $con is your database connection object

              $result = $con->query("SELECT SUM(qty) AS total_qty FROM asset_loan_v where department = 'damaged'");
              $row = $result->fetch_assoc();
              $total_qty = $row['total_qty'];

              echo "" . $total_qty;
              ?>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
      </a>
      <!-- /.info-box -->

    </div>
  <?php endif; ?>
  <?php if (in_array($user_data['role'], [1])) : ?>
    <div class="col-12 col-sm-6 col-md-3">
      <a href="index.php?page=reports/report_tele_transactions_detail&filter=approaching_deadline" class="info-box-link">

        <div class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-bullhorn"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">EthioTele Packages Approaching Deadline</span>
            <span class="info-box-number">
              <?php
              // Calculate the current date
              $current_date = date('Y-m-d');

              // Calculate the date four days from now
              $four_days_from_now = date('Y-m-d', strtotime('+7 days'));

              // Construct the SQL query to count the number of records where the deadline is approaching within four days
              $query = "SELECT COUNT(*) as num_records             
                    FROM sim_card_transactions_line
                    WHERE expire_date BETWEEN '$current_date' AND '$four_days_from_now'";

              // Execute the query and fetch the result
              $result = $con->query($query);

              // Check if the query was successful
              if ($result) {
                // Fetch the row as an associative array
                $row = $result->fetch_assoc();

                // Get the number of records from the 'num_records' column
                $num_records = $row['num_records'];

                echo $num_records;
              } else {
                // If the query fails, output an error message or handle the error as needed
                echo "Error executing query: " . $con->error;
              }
              ?>
            </span>
          </div>
          <!-- /.info-box-content -->
        </div>
      </a>
      <!-- /.info-box -->

    </div>
  <?php endif; ?>

</div>
<div class="containerr">
  <div class="sideba">
    <section class="cccc">
      <div class="ccc">

        <ul class="category_li">
          <h1 style="font-size: 22px;">Assets</h1>
          <?php
          // Fetch item categories and their total quantities from asset_loan_v
          $category_query_total = "SELECT item_category, SUM(total_qty) AS total_qty FROM total_item_qty_view GROUP BY item_category ORDER BY item_category ASC";
          $category_result_total = $con->query($category_query_total);
          if ($category_result_total->num_rows > 0) {
            while ($row = $category_result_total->fetch_assoc()) {
              echo '<li class="category_total" data-category_total="' . $row["item_category"] . '"><i class="fas fa-arrow-right" style="color: #414142;"></i> ' . $row["item_category"] . ' -  ' . $row["total_qty"] . '</li>';
              echo '<ul class="item-list_total" style="display:none;"></ul>'; // Hidden item list for each category
            }
          } else {
            echo "0 results";
          }
          ?>
        </ul>
      </div>


    </section>
  </div>
  <div class="content">

    <div class="graph">
      <div class="card shadow rounded-0">
        <div class="card-header rounded-0">
          <div class="d-flex justify-content-between">
            <div class="card-title flex-shrink-1 flex-grow-1">Total Asset Quantity</div>

          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <canvas id="categoryChart"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="grapha">
      <div class="card shadow rounded-0">
        <div class="card-header rounded-0">
          <div class="d-flex justify-content-between">
            <div class="card-title flex-shrink-1 flex-grow-1">Asset in Store and On Loan</div>

          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <canvas id="assetChart"></canvas>
          </div>
        </div>
      </div>
    </div>

    <div class="graph">
      <div class="card shadow rounded-0">
        <div class="card-header rounded-0">
          <div class="d-flex justify-content-between">
            <div class="card-title flex-shrink-1 flex-grow-1">Asset Usage Over Time</div>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <canvas id="useChart"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="graph">
      <div class="card shadow rounded-0">
        <div class="card-header rounded-0">
          <div class="d-flex justify-content-between">
            <div class="card-title flex-shrink-1 flex-grow-1">Asset Purchase Over Time</div>
          </div>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <canvas id="buyChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php

// Fetch Total QTY
$category_query = "SELECT item_category, SUM(total_qty) AS items_categoryy FROM total_item_qty_view GROUP BY item_category";
$category_result = $con->query($category_query);
$asset_category = array();
$category_quantities = array();

while ($row = $category_result->fetch_assoc()) {
  $asset_category[] = $row['item_category'];
  $category_quantities[] = $row['items_categoryy'];
}
// Fetch data by item name store
$asset_query = "SELECT item_name, SUM(qty) AS items_record FROM asset_record where qty > 0 GROUP BY item_name";
$asset_result = $con->query($asset_query);
$asset_name = array();
$asset_quantities = array();

while ($row = $asset_result->fetch_assoc()) {
  $asset_name[] = $row['item_name'];
  $asset_quantities[] = $row['items_record'];
}
// Fetch data category for store and loan
$category_query = "SELECT item_category, total_store_qty, total_loan_qty FROM store_loan_dash_v";
$store_result = $con->query($category_query);
$store_category = array();
$store_quantities = array();
$loan_quantities = array(); // Initialize loan_quantities array

while ($row = $store_result->fetch_assoc()) {
  $store_category[] = $row['item_category'];
  $store_quantities[] = $row['total_store_qty'];
  $loan_quantities[] = $row['total_loan_qty'];
}


// Query to fetch data for asset usage over time
$used_query = "SELECT doc_date, SUM(qty) AS total_qty FROM used_asset_report GROUP BY doc_date ORDER BY doc_date";
$used_result = $con->query($used_query);
$used_dates = array();
$used_quantities = array();

while ($row = $used_result->fetch_assoc()) {
  // Convert the database date string to a UNIX timestamp
  $timestamp = strtotime($row['doc_date']);
  // Format the UNIX timestamp to the desired date format
  $formatted_date = date("F j Y", $timestamp);

  $used_dates[] = $formatted_date; // Assuming doc_date is the label for x-axis
  $used_quantities[] = $row['total_qty'];
}


$buy_query = "SELECT doc_date, SUM(qty) AS total_qty FROM buy_asset_report GROUP BY doc_date ORDER BY doc_date";
$buy_result = $con->query($buy_query);
$buy_dates = array();
$buy_quantities = array();

while ($row = $buy_result->fetch_assoc()) {
  // Convert the database date string to a UNIX timestamp
  $timestamp = strtotime($row['doc_date']);
  // Format the UNIX timestamp to the desired date format
  $formatted_date = date("F j Y", $timestamp);

  $buy_dates[] = $formatted_date; // Assuming doc_date is the label for x-axis
  $buy_quantities[] = $row['total_qty'];
}

$barColors = array(
  "#03949B",
  "#26225B",
  "#4D7DBF",
  "#B2B435",
  "#414142",
  "#ff9800",
  "#795548",
  "#aa00ff",
  "#5bc0de",
  "#d9534f",
  "#b84d4d",
  "#6082b6",
  "#de994d",
  "#5c5c8a",
  "#c19a5f",
  "#6497b1",
  "#a57f8d",
  "#4a8468",
  "#d09494",
  "#619b78",
  "#ad6b88",
  "#7a9aa7",
  "#c7a685",
  "#5274ab",
  "#9f7b56",
  "#4f4f7f",
  "#ae6f7f",
  "#9b9b6b",
  "#5b8fa3",
  "#b29b75",
  "#4b6584",
  "#936e4d",
  "#6b6b94",
  "#c4a493",
  "#497c87",
  "#a37356",
  "#4f7d6b",
  "#a69b6c",
  "#6d8b92",
  "#d8af8f"
);

?>
<script>
  var asset_category = <?php echo json_encode($asset_category); ?>;
  var category_quantities = <?php echo json_encode($category_quantities); ?>;
  var barColors = <?php echo json_encode($barColors); ?>;
  var categoryChart = document.getElementById('categoryChart').getContext('2d');

  var assetChartObj = new Chart(categoryChart, {
    type: 'pie',
    data: {
      labels: asset_category,
      datasets: [{
        label: 'Asset Category',
        data: category_quantities,
        backgroundColor: barColors,
        borderColor: 'rgb(75, 192, 192)',
        borderWidth: 1
      }]
    },
    options: {
      title: {
        display: false
      },
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          display: false // hide x-axis labels
        }]
      }
    }
  });


  var store_category = <?php echo json_encode($store_category); ?>;
  var store_quantities = <?php echo json_encode($store_quantities); ?>;
  var loan_quantities = <?php echo json_encode($loan_quantities); ?>;
  var barColors = <?php echo json_encode($barColors); ?>; // Assuming you define $barColors somewhere
  var assetChart = document.getElementById('assetChart').getContext('2d');

  var assetChartObj = new Chart(assetChart, {
    type: 'bar',
    data: {
      labels: store_category,
      datasets: [{
        label: 'Asset on Store',
        data: store_quantities,
        backgroundColor: barColors, // Use correct variable name
        borderColor: '#f44336',
        borderWidth: 1
      }, {
        label: 'Asset on Loan',
        data: loan_quantities,
        backgroundColor: barColors, // Use correct variable name
        borderColor: '#f44336',
        borderWidth: 1
      }]
    },
    options: {
      title: {
        display: false
      },
      legend: {
        display: true
      },
      scales: {
        xAxes: [{
          display: false // hide x-axis labels
        }]
      }
    }
  });


  // PHP data for line chart
  var used_dates = <?php echo json_encode($used_dates); ?>;
  var used_quantities = <?php echo json_encode($used_quantities); ?>;
  var barColors = <?php echo json_encode($barColors); ?>;

  // Configure line chart
  var useChart = document.getElementById('useChart').getContext('2d');
  var useChartObj = new Chart(useChart, {
    type: 'line',
    data: {
      labels: used_dates,
      datasets: [{
        label: 'Usage Quantity',
        data: used_quantities,
        borderColor: '#4D7DBF',
        borderWidth: 1
      }]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          display: false // hide x-axis labels
        }]
      }
    }
  });

  var buy_dates = <?php echo json_encode($buy_dates); ?>;
  var buy_quantities = <?php echo json_encode($buy_quantities); ?>;

  // Configure line chart
  var buyChart = document.getElementById('buyChart').getContext('2d');
  var buyChartObj = new Chart(buyChart, {
    type: 'line',
    data: {
      labels: buy_dates,
      datasets: [{
        label: 'Purchase Quantity',
        data: buy_quantities,
        borderColor: 'rgb(75, 192, 192)',
        borderWidth: 1
      }]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          display: false // hide x-axis labels
        }]
      }
    }
  });
</script>


<script>
  $(document).ready(function() {
    $(".category_total").click(function() {
      var category_total = $(this).data('category_total');
      var itemList_total = $(this).next('.item-list_total');

      if (itemList_total.is(':visible')) {
        itemList_total.hide(); // Hide the item list if it's visible
      } else {
        $.ajax({
          url: "get_items_by_category.php",
          method: "POST",
          data: {
            category_total: category_total
          },
          success: function(data) {
            itemList_total.html(data).show(); // Show and populate the item list
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
          }
        });
      }
    });
  });
</script>