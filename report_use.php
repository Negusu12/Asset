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
    <title>Asset Management System</title>
    <link rel="icon" href="images/logo.png" type="image">
    <link rel="stylesheet" href="lib/css/bootstrap.css">
    <link rel="stylesheet" href="lib/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="asset/css/style.css">


</head>

<body class="body">


    <section class="">
        <?php include 'side_menu.php'; ?>
    </section>

    <section class="report_table">

        <div class="text">
            Assets Used
        </div>
        <div class="table-responsive" id="no-more-tables">
            <table class="table bg-white table-bordered mydatatable" id="mydatatable">
                <thead class="tbll text-dark">
                    <tr>
                        <th scope="col">Use ID</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Item Condition</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Document Date</th>
                        <th scope="col">Description</th>
                        <th scope="col">Prepared By</th>
                    </tr>
                </thead>

                <?php
                include "connect.php";
                $sql = "select * from used_asset_report";
                $result = $con->query($sql);
                if (!$result) {
                    die("Invalid query!");
                }
                while ($row = $result->fetch_assoc()) {
                    $id = $row['u_asset'];
                    echo '<tr>
          <td>' . $row['u_asset'] . '</td>
          <td>' . $row['item_name'] . '</td>
          <td>' . $row['item_condition'] . '</td>
          <td>' . $row['qty'] . '</td>
          <td>' . $row['doc_date'] . '</td>
          <td>' . $row['description'] . '</td>
          <td>' . $row['user_name'] . '</td>
        </tr>';
                }
                ?>

                </tbody>
            </table>
        </div>
    </section>

    <script src="lib/jquery-3.3.1.min.js"></script>
    <script src="lib/popper.min.js"></script>
    <script src="lib/jquery.dataTables.min.js"></script>
    <script src="lib/dataTables.bootstrap4.min.js"></script>
    <script src="lib/dataTables.buttons.min.js"></script>
    <script src="lib/buttons.bootstrap4.min.js"></script>
    <script src="lib/jszip.min.js"></script>
    <script src="lib/pdfmake.min.js"></script>
    <script src="lib/vfs_fonts.js"></script>
    <script src="lib/buttons.html5.min.js"></script>
    <script src="lib/buttons.print.min.js"></script>
    <script src="lib/buttons.colVis.min.js"></script>
    <script src="lib/dataTables.responsive.min.js"></script>
    <script src="lib/responsive.bootstrap4.min.js"></script>


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