<?php include('connect.php') ?>
<!-- Info boxes -->
<div class="row">
  <div class="col-12 col-sm-6 col-md-3">
    <a href="index.php?page=report_asset_onhand" class="info-box-link">
      <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-warehouse"></i></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total on Hand Asset Quantity</span>
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
    <a href="index.php?page=report_loan" class="info-box-link">
      <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="far fa-credit-card"></i></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Number Of Items Loaned</span>
          <span class="info-box-number">
            <?php
            // Assuming $con is your database connection object

            $result = $con->query("SELECT SUM(qty) AS total_qty FROM asset_loan_v");
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
  <div class="col-12 col-sm-6 col-md-3">
    <a href="index.php?page=report_loan" class="info-box-link">
      <div class="info-box">
        <span class="info-box-icon bg-info elevation-1"><i class="far fa-credit-card"></i></span>
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

</div>
<div class="containerr">
  <div class="sideba">
    <section class="cccc">
      <div class="ccc">

        <ul class="category_li">
          <h1 style="font-size: 22px;">Asset On Store</h1>
          <?php
          // Fetch item categories and their total quantities from asset_record
          $category_query = "SELECT item_category, SUM(qty) AS total_qty FROM asset_record WHERE qty > 0 GROUP BY item_category ORDER BY total_qty DESC";
          $category_result = $con->query($category_query);
          if ($category_result->num_rows > 0) {
            while ($row = $category_result->fetch_assoc()) {
              echo '<li class="category" data-category="' . $row["item_category"] . '"><i class="fas fa-arrow-right" style="color: #414142;"></i> ' . $row["item_category"] . ' - Total Qty: ' . $row["total_qty"] . '</li>';
              echo '<ul class="item-list" style="display:none;"></ul>'; // Hidden item list for each category
            }
          } else {
            echo "0 results";
          }
          ?>
        </ul>
      </div>
      <div class="ccc">

        <ul class="category_li">
          <h1 style="font-size: 22px;">Asset On Loan</h1>
          <?php
          // Fetch item categories and their total quantities from asset_loan_v
          $category_query_loan = "SELECT item_category, SUM(qty) AS total_qty FROM asset_loan_v WHERE qty > 0 GROUP BY item_category ORDER BY total_qty DESC";
          $category_result_loan = $con->query($category_query_loan);
          if ($category_result_loan->num_rows > 0) {
            while ($row = $category_result_loan->fetch_assoc()) {
              echo '<li class="category_loan" data-category_loan="' . $row["item_category"] . '"><i class="fas fa-arrow-right" style="color: #414142;"></i> ' . $row["item_category"] . ' - Total Qty: ' . $row["total_qty"] . '</li>';
              echo '<ul class="item-list_loan" style="display:none;"></ul>'; // Hidden item list for each category
            }
          } else {
            echo "0 results";
          }
          ?>
        </ul>
      </div>
      <div class="ccc">

        <ul class="category_li">
          <h1 style="font-size: 22px;">Total Asset</h1>
          <?php
          // Fetch item categories and their total quantities from asset_loan_v
          $category_query_total = "SELECT item_category, SUM(total_qty) AS total_qty FROM total_item_qty_view GROUP BY item_category ORDER BY total_qty DESC";
          $category_result_total = $con->query($category_query_total);
          if ($category_result_total->num_rows > 0) {
            while ($row = $category_result_total->fetch_assoc()) {
              echo '<li class="category_total" data-category_total="' . $row["item_category"] . '"><i class="fas fa-arrow-right" style="color: #414142;"></i> ' . $row["item_category"] . ' - Total Qty: ' . $row["total_qty"] . '</li>';
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
            <div class="card-title flex-shrink-1 flex-grow-1">Asset On Store</div>

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
$category_query = "SELECT item_category, SUM(total_qty) AS items_categoryy FROM total_item_qty_view GROUP BY item_category";
$category_result = $con->query($category_query);
$asset_category = array();
$category_quantities = array();

while ($row = $category_result->fetch_assoc()) {
  $asset_category[] = $row['item_category'];
  $category_quantities[] = $row['items_categoryy'];
}

$asset_query = "SELECT item_name, SUM(qty) AS items_record FROM asset_record where qty > 0 GROUP BY item_name";
$asset_result = $con->query($asset_query);
$asset_name = array();
$asset_quantities = array();

while ($row = $asset_result->fetch_assoc()) {
  $asset_name[] = $row['item_name'];
  $asset_quantities[] = $row['items_record'];
}

$barColors = array(
  "#03949B", "#26225B", "#4D7DBF", "#B2B435", "#414142", "#ff9800", "#795548", "#aa00ff", "#5bc0de", "#d9534f",
  "#007bff", "#28a745", "#ffc107", "#dc3545", "#17a2b8", "#6610f2", "#f012be", "#ff4136", "#2ecc40", "#ff851b", "#7fdbff", "#3d9970",
  "#01ff70", "#ffdc00", "#85144b", "#39cccc", "#ff7f50", "#2c3e50", "#b10dc9", "#2aa198", "#c0392b", "#00bfff", "#8e44ad", "#2d3c4d",
  "#e67e22", "#2e8b57", "#f1c40f", "#e74c3c", "#9b59b6", "#3498db"
);
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



?>
<script>
  var asset_category = <?php echo json_encode($asset_category); ?>;
  var category_quantities = <?php echo json_encode($category_quantities); ?>;
  var barColors = <?php echo json_encode($barColors); ?>;
  var categoryChart = document.getElementById('categoryChart').getContext('2d');

  var assetChartObj = new Chart(categoryChart, {
    type: 'bar',
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


  var asset_name = <?php echo json_encode($asset_name); ?>;
  var asset_quantities = <?php echo json_encode($asset_quantities); ?>;
  var barColors = <?php echo json_encode($barColors); ?>;
  var assetChart = document.getElementById('assetChart').getContext('2d');

  var assetChartObj = new Chart(assetChart, {
    type: 'pie',
    data: {
      labels: asset_name,
      datasets: [{
        label: 'Asset on Hand',
        data: asset_quantities,
        borderColor: 'rgb(75, 192, 192)',
        backgroundColor: barColors,
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

  // PHP data for line chart
  var used_dates = <?php echo json_encode($used_dates); ?>;
  var used_quantities = <?php echo json_encode($used_quantities); ?>;
  var barColors = <?php echo json_encode($barColors); ?>;

  // Configure line chart
  var useChart = document.getElementById('useChart').getContext('2d');
  var useChartObj = new Chart(useChart, {
    type: 'doughnut',
    data: {
      labels: used_dates,
      datasets: [{
        label: 'Usage Quantity',
        data: used_quantities,
        borderColor: 'rgb(75, 192, 192)',
        backgroundColor: barColors,
        borderWidth: 1
      }]
    },
    options: {
      legend: {
        display: false
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
    $(".category").click(function() {
      var category = $(this).data('category');
      var itemList = $(this).next('.item-list');

      if (itemList.is(':visible')) {
        itemList.hide(); // Hide the item list if it's visible
      } else {
        $.ajax({
          url: "get_items_by_category.php",
          method: "POST",
          data: {
            category: category
          },
          success: function(data) {
            itemList.html(data).show(); // Show and populate the item list
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
          }
        });
      }
    });
  });
</script>
<script>
  $(document).ready(function() {
    $(".category_loan").click(function() {
      var category_loan = $(this).data('category_loan');
      var itemList_loan = $(this).next('.item-list_loan');

      if (itemList_loan.is(':visible')) {
        itemList_loan.hide(); // Hide the item list if it's visible
      } else {
        $.ajax({
          url: "get_items_by_category.php",
          method: "POST",
          data: {
            category_loan: category_loan
          },
          success: function(data) {
            itemList_loan.html(data).show(); // Show and populate the item list
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
          }
        });
      }
    });
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