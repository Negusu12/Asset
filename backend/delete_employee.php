<?php
if (isset($_GET["employee_id"])) {
    include('../connect.php');
    $employee_id = $_GET['employee_id'];

    try {
        // Delete the record
        $sql = "DELETE FROM employee WHERE employee_id=$employee_id";
        if ($con->query($sql) == TRUE) {
            echo "<script>
        window.onload = function() {
            // Display a success message using SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Borrower Record has been deleted Successfully',
                showConfirmButton: true,
                confirmButtonText: 'OK'
            }).then(function() {
                window.location.href = '../index.php?page=reports/report_employee';
            });
        }
     </script>";
        } else {
            echo "<script>
            window.onload = function() {
                // Display a success message using SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'failed to Delete Borrower Record.',
                    showConfirmButton: false,
                    showDenyButton: true,
                    denyButtonText: 'OK'
                });
            }
         </script>";
        }
    } catch (mysqli_sql_exception $e) {
        // Display the foreign key constraint error in a SweetAlert
        echo "<script>
            window.onload = function() {
                // Display a success message using SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Cannot delete or update a parent row: a foreign key constraint fails.',
                    showConfirmButton: false,
                    showDenyButton: true,
                    denyButtonText: 'OK'
                }).then(function() {
                    window.location.href = '../index.php?page=reports/report_employee';
                });
            }
         </script>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="stylesheet" href="../assets/dist/css/sweetalert2.min.css">
</head>

<body>
    <script src="../assets/dist/js/sweetalert2.min.js"></script>
</body>

</html>