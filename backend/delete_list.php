<?php
if (isset($_GET["list_id"])) {
    include('../connect.php');
    $list_id = $_GET['list_id'];

    try {
        // Delete the record
        $sql = "DELETE FROM drop_down_list WHERE list_id=$list_id";
        if ($con->query($sql) == TRUE) {
            echo "<script>
        window.onload = function() {
            // Display a success message using SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'List Choice has been deleted Successfully',
                showConfirmButton: true,
                confirmButtonText: 'OK'
            }).then(function() {
                window.location.href = '../index.php?page=report_list';
            });
        }
     </script>";
        } else {
            echo "<script>
            window.onload = function() {
                // Display a success message using SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'failed to Delete Loner Record.',
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
                    window.location.href = '../index.php?page=report_employee';
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