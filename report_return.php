<?php

include("connect.php");

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
            Assets Return
        </div>
        <div class="table-responsive" id="no-more-tables">
            <table class="table bg-white table-bordered  mydatatable" id="mydatatable">
                <thead class="tbll text-dark">
                    <tr>
                        <th scope="col">loan ID</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Loaner Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Document Date</th>
                        <th scope="col">Discription</th>
                    </tr>
                </thead>

                <?php
                include "connect.php";
                $sql = "select * from asset_return_v";
                $result = $con->query($sql);
                if (!$result) {
                    die("Invalid query!");
                }
                while ($row = $result->fetch_assoc()) {
                    echo "
      <tr>
      <td>$row[loan_id]</td>
        <td>$row[item_name]</td>
        <td>$row[full_name]</td>
        <td>$row[qty]</td>
        <td>$row[doc_date]</td>
        <td>$row[description]</td>
      </tr>
      ";
                }
                ?>

                </tbody>
            </table>
        </div>
    </section>

    <script src="lib/jquery-3.3.1.min.js"></script>
    <script src="lib/popper.min.js"></script>
    <script src="bootstrap-4.3.1-dist/js/bootstrap.min.js"></script>
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