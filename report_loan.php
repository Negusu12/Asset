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
    <title>AMS Asset Loaned</title>
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
            Assets on Loan
        </div>
        <div class="table-responsive" id="no-more-tables">
            <table class="table bg-white table-bordered mydatatable" id="mydatatable">
                <thead class="tbll text-dark">
                    <tr>
                        <th>Row No.</th>
                        <th scope="col">Loan ID</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Model</th>
                        <th scope="col">Item Category</th>
                        <th scope="col">Serial No.</th>
                        <th scope="col">Loaned To</th>
                        <th scope="col">Loaner Department</th>
                        <th scope="col">UOM</th>
                        <th scope="col">Loaned Quantity</th>
                        <th scope="col">Quantity on Loan</th>
                        <th scope="col">Document Date</th>
                        <th scope="col">Description</th>
                        <th scope="col">Prepared By</th>
                        <th scope="col">Print</th>
                    </tr>
                </thead>


                <?php
                include "connect.php";
                $row_count = 1;

                $sql = "select * from asset_loan_v where qty > 0 and department != 'damaged'";
                $result = $con->query($sql);
                if (!$result) {
                    die("Invalid query!");
                }
                while ($row = $result->fetch_assoc()) {
                    $id = $row['loan_id'];
                    echo '<tr>
         <td>' . $row_count . '</td>
          <td>' . $row['loan_id'] . '</td>
          <td>' . $row['item_name'] . '</td>
          <td>' . $row['model'] . '</td>
          <td>' . $row['item_category'] . '</td>
          <td>' . $row['serial_no'] . '</td>
          <td>' . $row['full_name'] . '</td>
          <td>' . $row['department'] . '</td>
          <td>' . $row['uom'] . '</td>
          <td>' . $row['qty_taken'] . '</td>
          <td>' . $row['qty'] . '</td>
          <td>' . $row['doc_date'] . '</td>
          <td>' . $row['description'] . '</td>
          <td>' . $row['user_name'] . '</td>
          <td>
            <ul class="action_list">
              <li class="action_item action_view" title="View">
                <a href="components/print_loan.php?loan_id=' . $row['loan_id'] . '" target="_blank"><i class="fa fa-eye"></i></a>
              </li>
            </ul>
          </td>
        </tr>';
                    $row_count++;
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
                ],
                columnDefs: [{
                        targets: [0, 4, 7, 11, 14], // index of the "Password" column (zero-based index)
                        visible: false // set to false to hide the column by default
                    }
                    // Add similar blocks for other columns you want to hide by default
                ]
            });


            table.columns().every(function() {
                var that = this;
                var columnTitle = $(this.header()).text().trim();

                // Create the input element based on the column title
                var input;
                {
                    // Create a regular text input element for other columns
                    input = $('<input type="text" class="form-control" placeholder="Filter"/>')
                        .appendTo($(this.header()))
                        .on('keyup change', function() {
                            that.search($(this).val()).draw();
                        });
                }
            });

            table.buttons().container()
                .appendTo('#mydatatable_wrapper .col-md-6:eq(0)');
        });
    </script>



</body>

</html>