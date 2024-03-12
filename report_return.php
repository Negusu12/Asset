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
    <meta charset="utf-8">
    <title>ASM Loan Returned</title>
    <link rel="icon" href="images/logo.png" type="image">
    <link rel="stylesheet" href="asset/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="asset/css/bootstrap/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="asset/css/bootstrap/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="asset/css/bootstrap/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="asset/css/bootstrap/flatpickr.min.css">
    <link rel="stylesheet" href="asset/css/style.css">

</head>

<body class="body">


    <section class="">
        <?php include 'side_menu.php'; ?>
    </section>

    <section class="report_table">

        <div class="text">
            Assets Return
        </div>
        <div class="table-responsive" id="no-more-tables">
            <table class="table bg-white table-bordered  mydatatable" id="mydatatable">
                <thead class="tbll text-dark">
                    <tr>
                        <th>#</th>
                        <th scope="col">loan ID</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Model</th>
                        <th scope="col">Category</th>
                        <th scope="col">Loaner Name</th>
                        <th scope="col">UOM</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Document Date</th>
                        <th scope="col">Discription</th>
                        <th scope="col">Prepared By</th>
                    </tr>
                </thead>

                <?php
                include "connect.php";
                $row_count = 1;
                $sql = "select * from asset_return_v";
                $result = $con->query($sql);
                if (!$result) {
                    die("Invalid query!");
                }
                while ($row = $result->fetch_assoc()) {
                    echo "
      <tr>
      <td>$row_count</td>
      <td>$row[loan_id]</td>
        <td>$row[item_name]</td>
        <td>$row[model]</td>
        <td>$row[item_category]</td>
        <td>$row[full_name]</td>
        <td>$row[uom]</td>
        <td>$row[qty]</td>
        <td>$row[doc_date]</td>
        <td>$row[description]</td>
        <td>$row[user_name]</td>
      </tr>
      ";
                    $row_count++; // Increment row count
                }
                ?>

                </tbody>
            </table>
        </div>
    </section>

    <script src="asset/js/jquery/jquery-3.3.1.min.js"></script>
    <script src="asset/js/jquery/jquery.dataTables.min.js"></script>
    <script src="asset/js/bootstrap/dataTables.bootstrap4.min.js"></script>
    <script src="asset/js/bootstrap/dataTables.buttons.min.js"></script>
    <script src="asset/js/bootstrap/buttons.bootstrap4.min.js"></script>
    <script src="asset/js/bootstrap/jszip.min.js"></script>
    <script src="asset/js/bootstrap/pdfmake.min.js"></script>
    <script src="asset/js/bootstrap/vfs_fonts.js"></script>
    <script src="asset/js/bootstrap/buttons.html5.min.js"></script>
    <script src="asset/js/bootstrap/buttons.print.min.js"></script>
    <script src="asset/js/bootstrap/buttons.colVis.min.js"></script>
    <script src="asset/js/bootstrap/dataTables.responsive.min.js"></script>
    <script src="asset/js/bootstrap/buttons.bootstrap4.min.js"></script>
    <script src="asset/js/bootstrap/flatpickr.js"></script>


    <script>
        $(document).ready(function() {
            var table = $('#mydatatable').DataTable({
                ordering: true,
                buttons: ['excel', 'pdf', 'colvis'],
                pagingType: 'full_numbers',
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ]
            });


            table.columns().every(function() {
                var that = this;
                $('input', this.header()).on('keyup change', function() {
                    if (that.search() !== this.value) {
                        that.search(this.value).draw();
                    }
                });
            });

            table.buttons().container()
                .appendTo('#mydatatable_wrapper .col-md-6:eq(0)');
        });
    </script>



</body>

</html>