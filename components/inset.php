<?php
include('connect.php');

//Register Asset
if (isset($_POST['submit'])) {
    $item_c = /*addlashes so it accept commas and sympols*/ addslashes($_POST['item_c']);
    $item_name = addslashes($_POST['item_name']);
    $item_condition = addslashes($_POST['item_condition']);
    $qty = addslashes($_POST['qty']);
    $doc_date = addslashes($_POST['doc_date']);
    $description = addslashes($_POST['description']);
    $user_name = addslashes($_POST['user_name']);
    $uom = addslashes($_POST['uom']);

    $sql = "insert into `asset_record`(item_c,item_name,qty,item_condition,doc_date,description,user_name,uom)
    values ('$item_c','$item_name', '$qty','$item_condition', '$doc_date', '$description', '$user_name', '$uom')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "<script>
        window.onload = function() {
            // Display a success message using SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Item Has been Sucessfully Added',
                showConfirmButton: true,
                confirmButtonText: 'OK',
                timer: 2000
            }).then(function() {
                window.location.href = 'asset_record.php';
            });
        }
     </script>";
    } else {
        echo "<script>
        window.onload = function() {
            // Display a success message using SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'faild to record item.',
                showConfirmButton: false,
                showDenyButton: true,
                denyButtonText: 'OK'
            });
        }
     </script>";
    }
}

// End Register Asset

//Register Employee

if (isset($_POST['submit_e'])) {
    $full_name = /*addlashes so it accept commas and sympols*/ addslashes($_POST['full_name']);
    $department = addslashes($_POST['department']);

    $sql = "insert into `employee`(full_name,department)
    values ('$full_name','$department')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "<script>
                window.onload = function() {
                    // Display a success message using SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Employee has bee registered successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        timer: 2000
                    }).then(function() {
                        window.location.href = 'employee.php';
                    });
                }
             </script>";
    } else {
        echo "<script>
                window.onload = function() {
                    // Display a success message using SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'faild to add employee.',
                        showConfirmButton: false,
                        showDenyButton: true,
                        denyButtonText: 'OK'
                    });
                }
             </script>";
    }
}


// End Register Employee

//  Asset Loan

if (isset($_POST['submit_l'])) {
    $item_code = /*addslashes so it accept commas and symbols*/ addslashes($_POST['item_code']);
    $employee_id = addslashes($_POST['employee_id']);
    $qty = addslashes($_POST['qty']);
    $qty_taken = addslashes($_POST['qty']);
    $doc_date = addslashes($_POST['doc_date']);
    $description = addslashes($_POST['description']);
    $user_name = addslashes($_POST['user_name']);

    // Retrieve the current quantity for the selected item_code from the asset_record table
    $sql = "SELECT qty FROM asset_record WHERE item_code='$item_code'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $current_qty = $row['qty'];

    // Calculate the new quantity
    $new_qty = $current_qty - $qty;

    // Check if the new quantity is less than 0
    if ($new_qty < 0) {
        echo "<script>
                window.onload = function() {
                    // Display a success message using SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'The selected item is out of stock.',
                        showConfirmButton: false,
                        showDenyButton: true,
                        denyButtonText: 'OK'
                    });
                }
             </script>";
    } else {
        // Update the qty column in the asset_record table with the new quantity
        $update_sql = "UPDATE asset_record SET qty='$new_qty' WHERE item_code='$item_code'";
        $update_result = mysqli_query($con, $update_sql);

        if ($update_result) {
            // Insert the data into the asset_loan table
            $insert_sql = "INSERT INTO asset_loan (item_code, employee_id, qty, qty_taken,doc_date, user_name, description)
                           VALUES ('$item_code', '$employee_id', '$qty', '$qty_taken', '$doc_date', '$user_name', '$description')";
            $insert_result = mysqli_query($con, $insert_sql);

            if ($insert_result) {
                echo "<script>
                window.onload = function() {
                    // Display a success message using SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Loan submited successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        timer: 2000
                    }).then(function() {
                        window.location.href = 'asset_loan.php';
                    });
                }
             </script>";
            } else {
                echo "<script>
                window.onload = function() {
                    // Display a success message using SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to insert data into the asset_loan table.',
                        showConfirmButton: false,
                        showDenyButton: true,
                        denyButtonText: 'OK'
                    });
                }
             </script>";
            }
        } else {
            echo "<script>
            window.onload = function() {
                // Display a success message using SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to update the asset_record table.',
                    showConfirmButton: false,
                    showDenyButton: true,
                    denyButtonText: 'OK'
                });
            }
         </script>";
        }
    }

    // Display the error message, if any
    if (isset($error_message)) {
        echo $error_message;
    }
}



// End Asset Loan


// Buy A new Asset

if (isset($_POST['submit_b'])) {
    $item_code = /*addslashes so it accept commas and symbols*/ addslashes($_POST['item_code']);
    $qty = addslashes($_POST['qty']);
    $doc_date = addslashes($_POST['doc_date']);
    $description = addslashes($_POST['description']);
    $user_name = addslashes($_POST['user_name']);
    // Retrieve the current quantity for the selected item_code from the asset_record table
    $sql = "SELECT qty FROM asset_record WHERE item_code='$item_code'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $current_qty = $row['qty'];
    // Calculate the new quantity
    $new_qty = $current_qty + $qty;
    // Update the qty column in the asset_record table with the new quantity
    $update_sql = "UPDATE asset_record SET qty='$new_qty' WHERE item_code='$item_code'";
    $update_result = mysqli_query($con, $update_sql);

    if ($update_result) {
        // Insert the data into the asset_loan table
        $insert_sql = "INSERT INTO buy_asset (item_code, qty, doc_date, description, user_name)
                           VALUES ('$item_code', '$qty', '$doc_date', '$description', '$user_name')";
        $insert_result = mysqli_query($con, $insert_sql);

        if ($insert_result) {
            // Display a success message using SweetAlert
            echo "<script>
    window.onload = function() {
        // Display a success message using SweetAlert
        Swal.fire({
            icon: 'success',
            title: 'item updated successfully',
            showConfirmButton: true,
            confirmButtonText: 'OK',
            timer: 2000
        }).then(function() {
            window.location.href = 'asset_buy.php';
        });
    }
 </script>";
        } else {
            echo "<script>
            window.onload = function() {
                // Display a success message using SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'faild to insert data to buy asset table.',
                    showConfirmButton: false,
                    showDenyButton: true,
                    denyButtonText: 'OK'
                });
            }
         </script>";
        }
    }
}
// End Buy A new Asset

// Use Asset

if (isset($_POST['submit_u'])) {
    $item_code = /*addslashes so it accept commas and symbols*/ addslashes($_POST['item_code']);
    $qty = addslashes($_POST['qty']);
    $doc_date = addslashes($_POST['doc_date']);
    $description = addslashes($_POST['description']);
    $user_name = addslashes($_POST['user_name']);
    // Retrieve the current quantity for the selected item_code from the asset_record table
    $sql = "SELECT qty FROM asset_record WHERE item_code='$item_code'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $current_qty = $row['qty'];
    // Calculate the new quantity
    $new_qty = $current_qty - $qty;
    // Update the qty column in the asset_record table with the new quantity
    $update_sql = "UPDATE asset_record SET qty='$new_qty' WHERE item_code='$item_code'";
    $update_result = mysqli_query($con, $update_sql);

    if ($update_result) {
        // Insert the data into the asset_loan table
        $insert_sql = "INSERT INTO use_asset (item_code, qty, doc_date, description, user_name)
                           VALUES ('$item_code', '$qty', '$doc_date', '$description', '$user_name')";
        $insert_result = mysqli_query($con, $insert_sql);

        if ($insert_result) {
            // Display a success message using SweetAlert
            echo "<script>
    window.onload = function() {
        // Display a success message using SweetAlert
        Swal.fire({
            icon: 'success',
            title: 'item updated successfully',
            showConfirmButton: true,
            confirmButtonText: 'OK',
            timer: 2000
        }).then(function() {
            window.location.href = 'asset_use.php';
        });
    }
 </script>";
        } else {
            echo "<script>
            window.onload = function() {
                // Display a success message using SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'faild to insert data to buy asset table.',
                    showConfirmButton: false,
                    showDenyButton: true,
                    denyButtonText: 'OK'
                });
            }
         </script>";
        }
    }
}
// End Use Asset

// Asset Return

if (isset($_POST['submit_r'])) {
    $loan_id = addslashes($_POST['loan_id']);
    $employee_id = addslashes($_POST['employee_id']);
    $item_code = addslashes($_POST['item_code']);
    $qty = addslashes($_POST['qty']);
    $doc_date = addslashes($_POST['doc_date']);
    $description = addslashes($_POST['description']);
    $user_name = addslashes($_POST['user_name']);

    // Retrieve the current quantity for the selected item_code from the asset_loan table
    $sql = "SELECT qty FROM asset_loan WHERE loan_id='$loan_id'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $current_qty = $row['qty'];

    // Calculate the new quantity
    $new_qty = $current_qty - $qty;

    // Retrieve the current quantity for the selected item_code from the asset_record table
    $sql = "SELECT qty FROM asset_record WHERE item_code='$item_code'";
    $result = mysqli_query($con, $sql);
    $row_r = mysqli_fetch_assoc($result);
    $current_qty_r = $row_r['qty'];

    // Calculate the new quantity
    $new_qty_r = $current_qty_r + $qty;

    // Check if the new quantity is less than 0
    if ($new_qty < 0) {
        echo "<script>
        window.onload = function() {
            // Display a success message using SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'The Quantity you are returning is more than you took.',
                showConfirmButton: false,
                showDenyButton: true,
                denyButtonText: 'OK'
            });
        }
     </script>";
    } else {
        // Update the qty column in the asset_loan table with the new quantity
        $update_sql = "UPDATE asset_loan SET qty='$new_qty' WHERE loan_id='$loan_id'";
        $update_result = mysqli_query($con, $update_sql);

        // Update the qty column in the asset_record table with the new quantity
        $update_sql_r = "UPDATE asset_record SET qty='$new_qty_r' WHERE item_code='$item_code'";
        $update_result_r = mysqli_query($con, $update_sql_r);

        if ($update_result && $update_result_r) {
            // Insert the data into the asset_return table
            $insert_sql = "INSERT INTO asset_return (loan_id, employee_id, item_code, qty, doc_date, description, user_name)
                           VALUES ('$loan_id', '$employee_id', '$item_code', '$qty', '$doc_date', '$description', '$user_name')";
            $insert_result = mysqli_query($con, $insert_sql);

            if ($insert_result) {
                echo "<script>
                window.onload = function() {
                    // Display a success message using SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Item Returned Sucessfuly',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        timer: 2000
                    }).then(function() {
                        window.location.href = 'asset_return.php';
                    });
                }
             </script>";
            } else {
                echo "<script>
                window.onload = function() {
                    // Display a success message using SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to insert data into the asset_loan table.',
                        showConfirmButton: false,
                        showDenyButton: true,
                        denyButtonText: 'OK'
                    });
                }
             </script>";
            }
        } else {
            echo "<script>
                window.onload = function() {
                    // Display a success message using SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to update the asset_loan or asset_record table.',
                        showConfirmButton: false,
                        showDenyButton: true,
                        denyButtonText: 'OK'
                    });
                }
             </script>";
        }
    }

    // Display the error message, if any
    if (isset($error_message)) {
        echo $error_message;
    }
}

// End Asset Return

// Change Password
if (isset($_POST['submitp'])) {
    $id = addslashes($_POST['id']);
    $current_passwordd = addslashes($_POST['current_passwordd']);
    $new_password = addslashes($_POST['new_password']);
    $confirm_password = addslashes($_POST['confirm_password']);

    // Retrieve the hashed password from the database
    $sql = "SELECT password FROM users WHERE id='$id'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $hashed_password = $row['password'];

        // Check if the new password and confirm password fields match
        if ($new_password !== $confirm_password) {
            // Display an error message
            echo "<script>
                window.onload = function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'New Passwords and Confirm Password do not match.',
                        showConfirmButton: false,
                        showDenyButton: true,
                        denyButtonText: 'OK'
                    });
                }
            </script>";
        } else if (!password_verify($current_passwordd, $hashed_password)) {
            // Check if the entered current password is incorrect
            echo "<script>
                window.onload = function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Current password is incorrect.',
                        showConfirmButton: false,
                        showDenyButton: true,
                        denyButtonText: 'OK'
                    });
                }
            </script>";
        } else {
            // Update the password in the database
            $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update_sql = "UPDATE users SET password='$hashed_new_password' WHERE id='$id'";
            $update_result = mysqli_query($con, $update_sql);

            if ($update_result) {
                // Display a success message
                echo "<script>
                window.onload = function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Password Updated Successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                    }).then(function() {
                        window.location.href = 'index.php';
                    });
                }
            </script>";
            } else {
                // Display an error message
                echo "<script>
                    window.onload = function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Password not changed.',
                            showConfirmButton: false,
                            showDenyButton: true,
                            denyButtonText: 'OK'
                        });
                    }
                </script>";
            }
        }
    }
}
// End Change Password