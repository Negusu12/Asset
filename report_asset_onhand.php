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
    <title>AMS Asset on Hand</title>
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
            Assets on Hand
        </div>
        <form method="post" action="">
            <div class="filterr">
                <div class="form-group">
                    <label class="labela1 row-2" for="item_condition">item_condition:</label>
                    <select class="form-control selecta1 row-2" name="item_condition" id="item_condition">
                        <option value=""></option>
                        <option value="Functional">Functional</option>
                        <option value="Damaged but Functional">Damaged but Functional</option>
                        <option value="Non Functional">Non Functional</option>
                        <option value="Damaged">Damaged</option>
                        <option value="Damaged and Non-Functional">Damaged and Non-Functional</option>
                        <option value="Damaged or Non-Functional">Damaged or Non-Functional</option>
                    </select>
                </div>


                <button item_condition="submit" class="btn btn-primary submita1">Submit</button>
                <!-- rest of the form goes here -->
            </div>
            <div class="table-responsive" id="no-more-tables">
                <table class="table bg-white table-bordered mydatatable" id="mydatatable">
                    <thead class="tbll text-dark">
                        <tr>
                            <th>#</th>
                            <th scope="col">Item Code</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Item Condition</th>
                            <th scope="col">UOM</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Document Date</th>
                            <th scope="col">Discription</th>
                        </tr>
                    </thead>

                    <?php
                    include "connect.php";

                    $row_count = 1;

                    if (isset($_POST['item_condition'])) {
                        $item_condition = $_POST['item_condition'];

                        if ($item_condition == 'Functional') {
                            $sql = "SELECT * FROM asset_record WHERE item_condition = 'Functional' ";
                        } else if ($item_condition == 'Damaged but Functional') {
                            $sql = "SELECT * FROM asset_record where item_condition = 'Damaged but Functional'";
                        } else if ($item_condition == 'Non Functional') {
                            $sql = "SELECT * FROM asset_record where item_condition = 'Non Functional'";
                        } else if ($item_condition == 'Damaged') {
                            $sql = "SELECT * FROM asset_record where item_condition = 'Damaged'";
                        } else if ($item_condition == 'Damaged and Non-Functional') {
                            $sql = "SELECT * FROM asset_record where item_condition = 'Damaged and Non-Functional'";
                        } else if ($item_condition == 'Damaged or Non-Functional') {
                            $sql = "SELECT * FROM asset_record where item_condition = 'Damaged or Non-Functional'";
                        } else {
                            $sql = "select * from asset_record";
                        }
                    } else {
                        $sql = "select * from asset_record";
                    }
                    $result = $con->query($sql);
                    if (!$result) {
                        die("Invalid query!");
                    }
                    while ($row = $result->fetch_assoc()) {
                        // Format the doc_date column as "dd month yyyy"
                        $doc_date = date("d F Y", strtotime($row['doc_date']));
                        echo "
  <tr>
    <td>$row_count</td>
    <td>$row[item_c]</td>
    <td>$row[item_name]</td>
    <td>$row[item_condition]</td>
    <td>$row[uom]</td>
    <td>$row[qty]</td>
    <td>$doc_date</td>
    <td>$row[description]</td>
  </tr>
  ";
                        $row_count++; // Increment row count
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </form>
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