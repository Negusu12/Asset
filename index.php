<?php
session_start();
include 'components/inset.php';
include("connect.php");
include("components/functions.php");

$user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="asset/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

    <script src="asset/js/npm_chart.js"></script>
</head>

<body>
    <section class="">
        <?php include 'side_menu.php'; ?>
    </section>
    <!-- Info boxes -->
    <div class="dashboard">

        <div class="row-d">
            <div class="info-box">
                <div class="iconn">
                    <i class=" fa-brands fa-product-hunt"></i>
                </div>
                <div class="info-box-content">
                    <div class="info-box-row">
                        <span class="info-box-text">Total Asset Quantity</span>
                    </div>
                    <div class="info-box-row">
                        <span class="info-box-number">
                            <?php
                            $result = $con->query("SELECT SUM(qty) AS total_qty FROM asset_record");
                            $row = $result->fetch_assoc();
                            echo $row['total_qty'];
                            ?>
                        </span>

                    </div>
                </div>
                <!-- /.info-box-content -->
            </div>
            <div class="info-box">
                <div class="iconn">
                    <i class="fa-solid fa-money-bill-trend-up"></i>
                </div>
                <div class="info-box-content">
                    <div class="info-box-row">
                        <span class="info-box-text">Number Of Items Loaned</span>
                    </div>
                    <div class="info-box-row">
                        <span class="info-box-number">
                            <?php echo $con->query("SELECT * FROM asset_loan where qty > 0")->num_rows; ?>
                        </span>
                    </div>
                </div>
                <!-- /.info-box-content -->
            </div>
            <div class="info-box" style="display: none;">
                <div class="iconn">
                    <i class="fa-solid fa-hashtag"></i>
                </div>
                <div class="info-box-content">
                    <div class="info-box-row">
                        <span class="info-box-text">Number Of Loaners</span>
                    </div>
                    <div class="info-box-row">
                        <span class="info-box-number">
                            <?php echo $con->query("SELECT * FROM employee")->num_rows; ?>
                        </span>
                    </div>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
        <div class="row-d">
            <div class="info-box" style="display: none;">
                <div class="iconn">
                    <i class="fas fa-users"></i>
                </div>
                <div class="info-box-content">
                    <div class="info-box-row">
                        <span class="info-box-text">Number of Users</span>
                    </div>
                    <div class="info-box-row">
                        <span class="info-box-number">
                            <?php echo $con->query("SELECT * FROM users")->num_rows; ?>
                        </span>
                    </div>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>
    </div>

    <section>
        <div class="row">
            <div class="col-md-6" style="display: none;">
                <div class="graph px-5 my-3">
                    <div class="col-lg-6 col-md-8 col-sm-12 mb-4">
                        <div class="card shadow rounded-0">
                            <div class="card-header rounded-0">
                                <div class="d-flex justify-content-between">
                                    <div class="card-title flex-shrink-1 flex-grow-1">Daily Item Returns</div>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="container-fluid">
                                    <canvas id="returnChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="display: none;">
                <div class="graph">
                    <div class="col-lg-6 col-md-8 col-sm-12 mb-4">
                        <div class="card shadow rounded-0">
                            <div class="card-header rounded-0">
                                <div class="d-flex justify-content-between">
                                    <div class="card-title flex-shrink-1 flex-grow-1">Daily Item Loan</div>

                                </div>
                            </div>
                            <div class="card-body">
                                <div class="container-fluid">
                                    <canvas id="loanChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="graph">
                <div class="col-lg-6 col-md-8 col-sm-12 mb-4">
                    <div class="card shadow rounded-0">
                        <div class="card-header rounded-0">
                            <div class="d-flex justify-content-between">
                                <div class="card-title flex-shrink-1 flex-grow-1">Asset On Hand</div>

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

            <div class="graph">
                <div class="col-lg-6 col-md-8 col-sm-12 mb-4">
                    <div class="card shadow rounded-0">
                        <div class="card-header rounded-0">
                            <div class="d-flex justify-content-between">
                                <div class="card-title flex-shrink-1 flex-grow-1">Asset Category</div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <canvas id="categoryChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </section>


    <?php
    // Fetch data for loan chart
    $loan_query = "SELECT doc_date, SUM(qty_taken) AS items_loaned FROM asset_loan GROUP BY doc_date";
    $loan_result = $con->query($loan_query);
    $loan_dates = array();
    $loan_quantities = array();

    while ($row = $loan_result->fetch_assoc()) {
        $loan_dates[] = $doc_date = date("d F Y", strtotime($row['doc_date']));
        $loan_quantities[] = $row['items_loaned'];
    }

    // Fetch data for return chart
    $return_query = "SELECT doc_date, SUM(qty) AS items_returned FROM asset_return GROUP BY doc_date";
    $return_result = $con->query($return_query);
    $return_dates = array();
    $return_quantities = array();

    while ($row = $return_result->fetch_assoc()) {
        $return_dates[] = $doc_date = date("d F Y", strtotime($row['doc_date']));
        $return_quantities[] = $row['items_returned'];
    }

    $asset_query = "SELECT item_name, SUM(qty) AS items_record FROM asset_record GROUP BY item_name";
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


    $asset_query = "SELECT item_category, SUM(qty) AS items_categoryy FROM asset_record GROUP BY item_category";
    $asset_result = $con->query($asset_query);
    $asset_category = array();
    $asset_quantities = array();

    while ($row = $asset_result->fetch_assoc()) {
        $asset_category[] = $row['item_category'];
        $asset_quantities[] = $row['items_categoryy'];
    }
    $barColors = array(
        "#414142", "#03949B", "#26225B", "#4D7DBF", "#B2B435", "#ff9800", "#795548", "#aa00ff", "#5bc0de", "#d9534f",
        "#007bff", "#28a745", "#ffc107", "#dc3545", "#17a2b8", "#6610f2", "#f012be", "#ff4136", "#2ecc40", "#ff851b", "#7fdbff", "#3d9970",
        "#01ff70", "#ffdc00", "#85144b", "#39cccc", "#ff7f50", "#2c3e50", "#b10dc9", "#2aa198", "#c0392b", "#00bfff", "#8e44ad", "#2d3c4d",
        "#e67e22", "#2e8b57", "#f1c40f", "#e74c3c", "#9b59b6", "#3498db"
    );
    ?>

    <script>
        // Loan chart data
        var loan_dates = <?php echo json_encode($loan_dates); ?>;
        var loan_quantities = <?php echo json_encode($loan_quantities); ?>;

        var loanChart = document.getElementById('loanChart').getContext('2d');

        var loanChartObj = new Chart(loanChart, {
            type: 'line',
            data: {
                labels: loan_dates,
                datasets: [{
                    label: 'Items Loaned',
                    data: loan_quantities,
                    backgroundColor: '#3f51b5',
                    borderColor: '#3f51b5',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        // Return chart data
        var return_dates = <?php echo json_encode($return_dates); ?>;
        var return_quantities = <?php echo json_encode($return_quantities); ?>;

        var returnChart = document.getElementById('returnChart').getContext('2d');

        var returnChartObj = new Chart(returnChart, {
            type: 'bar',
            data: {
                labels: return_dates,
                datasets: [{
                    label: 'Items Returned',
                    data: return_quantities,
                    backgroundColor: '#f44336',
                    borderColor: '#f44336',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
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
                    backgroundColor: barColors,
                    borderColor: '#f44336',
                    borderWidth: 1

                }]
            },
            options: {
                title: {
                    display: true,
                    text: ""
                }
            }
        });



        var asset_category = <?php echo json_encode($asset_category); ?>;
        var asset_quantities = <?php echo json_encode($asset_quantities); ?>;
        var barColors = <?php echo json_encode($barColors); ?>;
        var categoryChart = document.getElementById('categoryChart').getContext('2d');

        var assetChartObj = new Chart(categoryChart, {
            type: 'pie',
            data: {
                labels: asset_category,
                datasets: [{
                    label: 'Asset Category',
                    data: asset_quantities,
                    backgroundColor: barColors,
                    borderColor: '#f44336',
                    borderWidth: 1

                }]
            },
            options: {
                title: {
                    display: true,
                    text: ""
                }
            }
        });
    </script>

</body>

</html>