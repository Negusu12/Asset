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
    <title>AMS loners List</title>
    <link rel="icon" href="images/logo.png" type="image">
    <link rel="stylesheet" href="asset/css/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="asset/css/bootstrap/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="asset/css/bootstrap/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="asset/css/bootstrap/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="asset/css/bootstrap/flatpickr.min.css">
    <link rel="stylesheet" href="asset/css/style.css">
    <link rel="stylesheet" href="asset/css/sweetalert2.min.css">
</head>

<body class="body">
    <section class="">
        <?php include 'side_menu.php'; ?>
    </section>
    <section class="report_table">
        <div class="text">
            Loners List
        </div>
        <form method="post" action="">
            <div class="table-responsive" id="no-more-tables">
                <table class="table bg-white table-bordered mydatatable" id="mydatatable">
                    <thead class="tbll text-dark">
                        <tr>
                            <th scope="col">employee_id</th>
                            <th scope="col">full_name</th>
                            <th scope="col">department</th>
                            <?php if ($user_data['role'] == 1) : ?>
                                <th scope="col">Action</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "connect.php";
                        $sql = "SELECT * FROM employee order by employee_id desc";
                        $result = $con->query($sql);
                        if (!$result) {
                            die("Invalid query!");
                        }
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['employee_id'] . "</td>";
                            echo "<td>" . $row['full_name'] . "</td>";
                            echo "<td>" . $row['department'] . "</td>";
                            if ($user_data['role'] == 1) {
                                echo "<td>
                                <a class='btn btn-success' href='components/edit_employee.php?employee_id=" . $row['employee_id'] . "'>Edit</a>
                                <button class='btn btn-danger' onclick='confirmDelete(" . $row['employee_id'] . ")'>Delete</button>
                              </td>";
                            }
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </form>
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
    <script src="asset/js/sweetalert2.min.js"></script>
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

        function confirmDelete(userId) {
            event.preventDefault(); // Prevent default form submission

            Swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'components/delete_employee.php?employee_id=' + userId;
                }
            });
        }
    </script>
</body>

</html>