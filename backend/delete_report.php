<?php
include('../connect.php');

if (isset($_GET["list_id"])) {
    // Delete from drop_down_list table
    $list_id = $_GET['list_id'];

    try {
        $sql = "DELETE FROM drop_down_list WHERE list_id=$list_id";
        if ($con->query($sql) === TRUE) {
            echo "<script>
        window.onload = function() {
            Swal.fire({
                icon: 'success',
                title: 'List Choice has been deleted Successfully',
                showConfirmButton: true,
                confirmButtonText: 'OK'
            }).then(function() {
                window.location.href = '../index.php?page=reports/report_list';
            });
        }
     </script>";
        } else {
            echo "<script>
            window.onload = function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to Delete List Choice Record.',
                    showConfirmButton: false,
                    showDenyButton: true,
                    denyButtonText: 'OK'
                });
            }
         </script>";
        }
    } catch (mysqli_sql_exception $e) {
        echo "<script>
            window.onload = function() {
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
    // ---------  end Delete from drop_down_list table------------------------------

    // -------     Delete from Charges table-------------------------
} elseif (isset($_GET["charge_id"])) {
    // Delete from charges table
    $charge_id = $_GET['charge_id'];

    try {
        $sql = "DELETE FROM charges WHERE charge_id=$charge_id";
        if ($con->query($sql) === TRUE) {
            echo "<script>
        window.onload = function() {
            Swal.fire({
                icon: 'success',
                title: 'Charge has been deleted Successfully',
                showConfirmButton: true,
                confirmButtonText: 'OK'
            }).then(function() {
                window.location.href = '../index.php?page=reports/report_charge';
            });
        }
     </script>";
        } else {
            echo "<script>
            window.onload = function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to Delete Charge Record.',
                    showConfirmButton: false,
                    showDenyButton: true,
                    denyButtonText: 'OK'
                });
            }
         </script>";
        }
    } catch (mysqli_sql_exception $e) {
        echo "<script>
            window.onload = function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Cannot delete or update a parent row: a foreign key constraint fails.',
                    showConfirmButton: false,
                    showDenyButton: true,
                    denyButtonText: 'OK'
                }).then(function() {
                    window.location.href = '../index.php?page=reports/report_charge';
                });
            }
         </script>";
    }
}

// ------- ------End Delete from Charges table-------------------------
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