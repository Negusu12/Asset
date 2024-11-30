<?php
include("../connect.php");

// --------------  edit list------------------------------

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['list_model'])) {
        // Handle updating the drop_down_list table
        $list_id = $_POST["list_id"];
        $department = $_POST["department"];
        $category = $_POST["category"];
        $uom = $_POST["uom"];
        $location = $_POST["location"];

        $sql = "UPDATE drop_down_list SET department=?, category=?, uom=?, location=? WHERE list_id=?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ssssi', $department, $category, $uom, $location, $list_id);

        if ($stmt->execute()) {
            header('Location: ../index.php?page=reports/report_list');
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();

        // --------------  End edit list------------------------------

        // --------------  edit Charge------------------------------
    } elseif (isset($_POST['charge_model'])) {
        // Handle updating the charges table
        $charge_id = $_POST['charge_id'];
        $charge = $_POST['charge'];
        $price = $_POST['price'];
        $description = $_POST['description'];

        $stmt = $con->prepare("UPDATE charges SET Charge = ?, price = ?, description = ? WHERE charge_id = ?");
        $stmt->bind_param("sssi", $charge, $price, $description, $charge_id);

        if ($stmt->execute()) {
            header("Location: ../index.php?page=reports/report_charge");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    // --------------  End edit Charge------------------------------

    // --------------   edit sim_card_transactions------------------------------

    elseif (isset($_POST['update_transaction'])) {
        $transaction_id = $_POST['transaction_id'];
        $status = $_POST['status'];
        $description = $_POST['description'];

        try {
            // Begin a transaction
            $con->begin_transaction();

            // Update the main sim_card_transactions table
            $sql1 = "UPDATE sim_card_transactions 
                     SET status = ?, description = ? 
                     WHERE transaction_id = ?";
            $stmt1 = $con->prepare($sql1);
            $stmt1->bind_param('ssi', $status, $description, $transaction_id);
            $stmt1->execute();

            // Update the related sim_card_transactions_line table
            $sql2 = "UPDATE sim_card_transactions_line 
                     SET status = ? 
                     WHERE transaction_id = ?";
            $stmt2 = $con->prepare($sql2);
            $stmt2->bind_param('si', $status, $transaction_id);
            $stmt2->execute();

            // Commit the transaction
            $con->commit();

            // Show success message
            echo "<script>
            window.onload = function() {
                Swal.fire({
                    icon: 'success',
                    title: 'SIM Card Transaction and related records have been updated successfully',
                    showConfirmButton: true,
                    confirmButtonText: 'OK'
                }).then(function() {
                    window.location.href = '../index.php?page=reports/report_tele_transactions';
                });
            }
            </script>";
        } catch (Exception $e) {
            // Rollback the transaction in case of an error
            $con->rollback();
            header("Location: ../index.php?page=reports/report_tele_transactions&error=2");
            exit();
        }
    } elseif (isset($_POST['update_transaction_line'])) {
        $transaction_id_line = $_POST['transaction_id_line'];
        $taken_date = !empty($_POST['taken_date']) ? $_POST['taken_date'] : null;
        $status = $_POST['status'];
        $description_line = $_POST['description_line'];

        try {
            $sql = "UPDATE sim_card_transactions_line 
                    SET taken_date = ?, status = ?, description_line = ? 
                    WHERE transaction_id_line = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('sssi', $taken_date, $status, $description_line, $transaction_id_line);

            if ($stmt->execute()) { {
                    echo "<script>
                    window.onload = function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'SIM Card Transaction Line has been updated successfully',
                            showConfirmButton: true,
                            confirmButtonText: 'OK'
                        }).then(function() {
                            window.location.href = '../index.php?page=reports/report_tele_transactions';
                        });
                    }
                    </script>";
                }
            } else {
                echo "Error: " . $stmt->error;
            }
        } catch (Exception $e) {
            echo "Exception: " . $e->getMessage();
        }
    } elseif (isset($_POST['update_past_transaction'])) {
        $transaction_id = $_POST['transaction_id'];
        $taken_date = !empty($_POST['taken_date']) ? $_POST['taken_date'] : null; // Allow null if not selected
        $status = $_POST['status'];
        $description = $_POST['description'];

        try {
            $sql = "UPDATE sim_card_transactions 
                    SET taken_date = ?, status = ?, description = ? 
                    WHERE transaction_id = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param(
                'sssi',
                $taken_date, // This will be NULL if not selected
                $status,
                $description,
                $transaction_id
            );

            if ($stmt->execute()) {
                echo "<script>
                window.onload = function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'SIM Card Transaction has been updated successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'OK'
                    }).then(function() {
                        window.location.href = '../index.php?page=reports/report_past_tele_transactions';
                    });
                }
                </script>";
            } else {
                header("Location: ../index.php?page=reports/report_tele_transactions&error=1");
                exit();
            }
        } catch (Exception $e) {
            header("Location: ../index.php?page=reports/report_tele_transactions&error=2");
            exit();
        }
    } else {
        echo "Invalid submission.";
    }
}
// --------------   End edit sim_card_transactions------------------------------
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