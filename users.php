<?php

session_start();
include 'components/inset.php';
include("connect.php");
include("components/functions.php");

$user_data = check_login($con);
if ($user_data['role'] == 2) {
    // Redirect or display an error message
    header("Location: index.php"); // Redirect to login page
    exit();
}

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
    <link rel="stylesheet" href="asset/css/sweetalert2.min.css">


</head>

<body class="body">


    <section class="">
        <?php include 'side_menu.php'; ?>
    </section>

    <section class="report_table">

        <div class="text">
            Users
        </div>
        <div class="table-responsive" id="no-more-tables">
            <table class="table bg-white table-bordered mydatatable" id="mydatatable">
                <thead class="tbll text-dark">
                    <tr>
                        <th scope="col">row_No</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Password</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>

                <?php
                include "connect.php";
                $sql = "select * from users";
                $result = $con->query($sql);
                if (!$result) {
                    die("Invalid query!");
                }
                while ($row = $result->fetch_assoc()) {

                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['user_name'] . "</td>";
                    echo "<td>" . $row['password'] . "</td>";
                    echo "<td>" . ($row['role'] == 1 ? 'Admin and User' : ($row['role'] == 2 ? 'User' : '')) . "</td>";

                    echo "<td>
        <a class='btn btn-success' href='edit.php?id=$row[id]'>Edit</a>
        <button class='btn btn-danger' onclick='confirmDelete($row[id])'>Delete</button>
      </td>";
                    echo "</tr>";
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
    <script>
        function confirmDelete(userId) {
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
                    // Redirect to your delete script with the user ID
                    window.location.href = 'delete.php?id=' + userId;
                }
            });
        }
    </script>



</body>

</html>