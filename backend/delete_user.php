<?php
if (isset($_GET["id"])) {
    include('../connect.php');
    $id = $_GET['id'];

    try {
        // Delete the record
        $sql = "DELETE FROM users WHERE id=$id";
        if ($con->query($sql) == TRUE) {
            echo "<script>
        window.onload = function() {
            // Display a success message using SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'User has been deleted Successfully',
                showConfirmButton: true,
                confirmButtonText: 'OK'
            }).then(function() {
                window.location.href = '../index.php?page=users';
            });
        }
     </script>";
        } else {
            echo "<script>
            window.onload = function() {
                // Display a success message using SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'failed to Delete User Record.',
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
                    window.location.href = '../index.php?page=users';
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