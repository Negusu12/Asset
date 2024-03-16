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
</div>
<div class="roww">
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
  </section>

  <div class="graph">
    <div class="card shadow rounded-0">
      <div class="card-header rounded-0">
        <div class="d-flex justify-content-between">
          <div class="card-title flex-shrink-1 flex-grow-1">Store Asset by Category</div>

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
</div>


<?php
$category_query = "SELECT item_category, SUM(qty) AS items_categoryy FROM asset_record GROUP BY item_category";
$category_result = $con->query($category_query);
$asset_category = array();
$category_quantities = array();

while ($row = $category_result->fetch_assoc()) {
  $asset_category[] = $row['item_category'];
  $category_quantities[] = $row['items_categoryy'];
}

$barColors2 = array(
  "#01ff70", "#ffdc00", "#85144b", "#39cccc", "#ff7f50", "#2c3e50", "#b10dc9", "#2aa198", "#c0392b", "#00bfff", "#8e44ad", "#2d3c4d",
  "#e67e22", "#2e8b57", "#f1c40f", "#e74c3c", "#9b59b6", "#3498db", "#414142", "#03949B", "#26225B", "#4D7DBF", "#B2B435", "#ff9800", "#795548", "#aa00ff", "#5bc0de", "#d9534f",
  "#007bff", "#28a745", "#ffc107", "#dc3545", "#17a2b8", "#6610f2", "#f012be", "#ff4136", "#2ecc40", "#ff851b", "#7fdbff", "#3d9970"

);

$asset_query = "SELECT item_name, SUM(qty) AS items_record FROM asset_record where qty > 0 GROUP BY item_name";
$asset_result = $con->query($asset_query);
$asset_name = array();
$asset_quantities = array();

while ($row = $asset_result->fetch_assoc()) {
  $asset_name[] = $row['item_name'];
  $asset_quantities[] = $row['items_record'];
}

$barColors = array(
  "#414142", "#03949B", "#26225B", "#4D7DBF", "#B2B435", "#ff9800", "#795548", "#aa00ff", "#5bc0de", "#d9534f",
  "#007bff", "#28a745", "#ffc107", "#dc3545", "#17a2b8", "#6610f2", "#f012be", "#ff4136", "#2ecc40", "#ff851b", "#7fdbff", "#3d9970",
  "#01ff70", "#ffdc00", "#85144b", "#39cccc", "#ff7f50", "#2c3e50", "#b10dc9", "#2aa198", "#c0392b", "#00bfff", "#8e44ad", "#2d3c4d",
  "#e67e22", "#2e8b57", "#f1c40f", "#e74c3c", "#9b59b6", "#3498db"
);

?>
<script>
  var asset_category = <?php echo json_encode($asset_category); ?>;
  var category_quantities = <?php echo json_encode($category_quantities); ?>;
  var barColors2 = <?php echo json_encode($barColors2); ?>;
  var categoryChart = document.getElementById('categoryChart').getContext('2d');

  var assetChartObj = new Chart(categoryChart, {
    type: 'pie',
    data: {
      labels: asset_category,
      datasets: [{
        label: 'Asset Category',
        data: category_quantities,
        backgroundColor: barColors2,
        borderColor: '#f44336',
        borderWidth: 1
      }]
    },
    options: {
      title: {
        display: true,
        text: "Asset Category"
      }
    }
  });


  var asset_name = <?php echo json_encode($asset_name); ?>;
  var asset_quantities = <?php echo json_encode($asset_quantities); ?>;
  var barColors = <?php echo json_encode($barColors); ?>;
  var assetChart = document.getElementById('assetChart').getContext('2d');

  var assetChartObj = new Chart(assetChart, {
    type: 'bar',
    data: {
      labels: asset_name,
      datasets: [{
        label: 'Asset on Hand',
        data: asset_quantities,
        backgroundColor: barColors,
        borderColor: '#f44336',
        borderWidth: 1

      }]
    },
    options: {
      title: {
        display: true,
        text: "Asset On Hand"
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