<?php
include('connect.php');

//Register Asset
if (isset($_POST['submit'])) {
    // Retrieve form data
    $item_c = addslashes($_POST['item_c']);
    $item_name = addslashes($_POST['item_name']);
    $brand = addslashes($_POST['brand']);
    $model = addslashes($_POST['model']);
    $item_category = addslashes($_POST['item_category']);
    $item_condition = addslashes($_POST['item_condition']);
    $item_type = addslashes($_POST['item_type']);
    $qty = addslashes($_POST['qty']);
    $doc_date = addslashes($_POST['doc_date']);
    $description = addslashes($_POST['description']);
    $user_name = addslashes($_POST['user_name']);
    $uom = addslashes($_POST['uom']);

    // Check if a file has been uploaded
    if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) {
        // File upload handling
        $image = $_FILES['image'];
        $image_data = file_get_contents($image['tmp_name']); // Get binary data of the image
        $image_data = mysqli_real_escape_string($con, $image_data); // Escape special characters to prevent SQL injection
    } else {
        // Set default value for image data if no file is uploaded
        $image_data = null; // Or any other default value you want to assign
    }

    // Add image data to the SQL query
    $sql_asset_record = "INSERT INTO asset_record (item_c, item_name, model, qty, item_category, item_condition, brand, item_type, doc_date, description, user_name, uom, item_image)
                         VALUES ('$item_c', '$item_name', '$model', '$qty', '$item_category', '$item_condition', '$brand', '$item_type', '$doc_date', '$description', '$user_name', '$uom', '$image_data')";
    $result_asset_record = mysqli_query($con, $sql_asset_record);

    $sql_asset_register_record = "INSERT INTO asset_register_record (item_c, item_name, model, qty, item_category, item_condition, brand, item_type, doc_date, description, user_name, uom, item_image)
    VALUES ('$item_c', '$item_name', '$model', '$qty', '$item_category', '$item_condition', '$brand', '$item_type', '$doc_date', '$description', '$user_name', '$uom', '$image_data')";
    $result_asset_register_record = mysqli_query($con, $sql_asset_register_record);

    if ($result_asset_record && $result_asset_register_record) {
        echo "<script>
              window.onload = function() {
                  // Display a success message using SweetAlert
                  Swal.fire({
                      icon: 'success',
                      title: 'Item has been successfully recorded',
                      showConfirmButton: true,
                      confirmButtonText: 'OK',
                      timer: 2000
                  }).then(function() {
                      window.location.href = 'index.php?page=asset_record';
                  });
              }
              </script>";
    } else {
        echo "<script>
              window.onload = function() {
                  // Display an error message using SweetAlert
                  Swal.fire({
                      icon: 'error',
                      title: 'Failed to record item.',
                      showConfirmButton: false,
                      showDenyButton: true,
                      denyButtonText: 'OK'
                  });
              }
              </script>";
    }

    // Close the database connection
    mysqli_close($con);
}



// End Register Asset

//Register Employee

if (isset($_POST['submit_e'])) {
    $full_name = /*addlashes so it accept commas and sympols*/ addslashes($_POST['full_name']);
    $department = addslashes($_POST['department']);
    $list_id = addslashes($_POST['list_id']);
    $borrower_title = addslashes($_POST['borrower_title']);

    $sql = "insert into `employee`(borrower_title,full_name,department,list_id)
    values ('$borrower_title', '$full_name','$department','$list_id')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "<script>
                window.onload = function() {
                    // Display a success message using SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Borrower has bee registered successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        timer: 2000
                    }).then(function() {
                        window.location.href = 'index.php?page=employee';
                    });
                }
             </script>";
    } else {
        echo "<script>
                window.onload = function() {
                    // Display a success message using SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to add Borrower.',
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
    $item_condition = addslashes($_POST['item_condition']);
    $employee_id = addslashes($_POST['employee_id']);
    $qty = addslashes($_POST['qty']);
    $qty_taken = addslashes($_POST['qty']);
    $doc_date = addslashes($_POST['doc_date']);
    $serial_no = addslashes($_POST['serial_no']);
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
                        title: 'The Selected Item is out of Stock.',
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
            $insert_sql = "INSERT INTO asset_loan (item_code, item_condition, employee_id, qty, qty_taken,doc_date,serial_no, user_name, description)
                           VALUES ('$item_code', '$item_condition', '$employee_id', '$qty', '$qty_taken', '$doc_date','$serial_no', '$user_name', '$description')";
            $insert_result = mysqli_query($con, $insert_sql);

            if ($insert_result) {
                echo "<script>
                window.onload = function() {
                    // Display a success message using SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'Loan Submitted successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        timer: 2000
                    }).then(function() {
                        window.location.href = 'index.php?page=asset_loan';
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
            title: 'Item Bought successfully',
            showConfirmButton: true,
            confirmButtonText: 'OK',
            timer: 2000
        }).then(function() {
            window.location.href = 'index.php?page=asset_buy';
        });
    }
 </script>";
        } else {
            echo "<script>
            window.onload = function() {
                // Display a success message using SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to insert data to buy asset table.',
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
    if ($current_qty < $qty) {
        echo "<script>
                window.onload = function() {
                    // Display a success message using SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'The Selected Item is out of Stock.',
                        showConfirmButton: false,
                        showDenyButton: true,
                        denyButtonText: 'OK'
                    });
                }
             </script>";
    } else {
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
            title: 'Item Updated Successfully',
            showConfirmButton: true,
            confirmButtonText: 'OK',
            timer: 2000
        }).then(function() {
            window.location.href = 'index.php?page=asset_use';
        });
    }
 </script>";
            } else {
                echo "<script>
            window.onload = function() {
                // Display a success message using SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to insert data to buy asset table.',
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

// Display the error message, if any
if (isset($error_message)) {
    echo $error_message;
}

// End Use Asset


// Adjustment record

if (isset($_POST['submit_adj'])) {
    $item_code = addslashes($_POST['item_code']);
    $qty_to_subtract = isset($_POST['qty_to_subtract']) ? addslashes($_POST['qty_to_subtract']) : 0;
    $qty_to_add = isset($_POST['qty_to_add']) ? addslashes($_POST['qty_to_add']) : 0;
    $description = addslashes($_POST['description']);
    $user_name = addslashes($_POST['user_name']);

    $sql = "SELECT qty FROM asset_record WHERE item_code='$item_code'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $current_qty = $row['qty'];

    if ($qty_to_subtract > 0) {
        if ($current_qty < $qty_to_subtract) {
            echo "<script>
                window.onload = function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'The Selected Item is out of Stock.',
                        showConfirmButton: false,
                        showDenyButton: true,
                        denyButtonText: 'OK'
                    });
                }
             </script>";
        } else {
            $new_qty = $current_qty - $qty_to_subtract;
            $update_sql = "UPDATE asset_record SET qty='$new_qty' WHERE item_code='$item_code'";
        }
    } elseif ($qty_to_add > 0) {
        $new_qty = $current_qty + $qty_to_add;
        $update_sql = "UPDATE asset_record SET qty='$new_qty' WHERE item_code='$item_code'";
    }

    if (isset($update_sql) && mysqli_query($con, $update_sql)) {
        $insert_sql = "INSERT INTO adjust_asset (item_code, qty, description, user_name, add_qty)
                       VALUES ('$item_code', '$qty_to_subtract', '$description', '$user_name', '$qty_to_add')";
        $insert_result = mysqli_query($con, $insert_sql);

        if ($insert_result) {
            echo "<script>
                window.onload = function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Item Updated Successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        timer: 2000
                    }).then(function() {
                        window.location.href = 'index.php?page=record_adjustment';
                    });
                }
            </script>";
        } else {
            echo "<script>
                window.onload = function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Failed to insert data into adjust asset table.',
                        showConfirmButton: false,
                        showDenyButton: true,
                        denyButtonText: 'OK'
                    });
                }
            </script>";
        }
    }
}

// End Adjustment Record

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
                        title: 'Item Returned Successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        timer: 2000
                    }).then(function() {
                        window.location.href = 'index.php?page=asset_return';
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


if (isset($_POST['submit_list'])) {
    $department = isset($_POST['department']) ? addslashes($_POST['department']) : '';
    $category = isset($_POST['category']) ? addslashes($_POST['category']) : '';
    $uom = isset($_POST['uom']) ? addslashes($_POST['uom']) : '';
    $location = isset($_POST['location']) ? addslashes($_POST['location']) : '';

    $sql = "INSERT INTO `drop_down_list` (department, category, uom, location)
            VALUES ('$department', '$category', '$uom', '$location')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "<script>
        window.onload = function() {
            // Display a success message using SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'List Choice Has been Successfully Added',
                showConfirmButton: true,
                confirmButtonText: 'OK'
            }).then(function() {
                window.location.href = 'index.php?page=list';
            });
        }
     </script>";
    } else {
        echo "<script>
        window.onload = function() {
            // Display a success message using SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Failed to record List Choice.',
                showConfirmButton: false,
                showDenyButton: true,
                denyButtonText: 'OK'
            });
        }
     </script>";
    }
}


if (isset($_POST['submit_user'])) {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    if (!empty($user_name) && !empty($password) && !is_numeric(($user_name))) {
        $user_id = random_num(20);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (user_id, user_name, password, role)
                  VALUES ('$user_id', '$user_name', '$hashed_password', '$role')";
        $result = mysqli_query($con, $query);

        if ($result) {
            echo "<script>
                window.onload = function() {
                    // Display a success message using SweetAlert
                    Swal.fire({
                        icon: 'success',
                        title: 'User has bee Registered Successfully',
                        showConfirmButton: true,
                        confirmButtonText: 'OK',
                        timer: 2000
                    }).then(function() {
                        window.location.href = 'index.php?page=add_user';
                    });
                }
             </script>";
        } else {
            echo "<script>
        window.onload = function() {
            // Display a success message using SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Please enter valid information!',
                showConfirmButton: false,
                showDenyButton: true,
                denyButtonText: 'OK'
            });
        }
     </script>";
        }
    }
}

if (isset($_POST['submit_charge'])) {
    $charge = addslashes($_POST['charge']);
    $price_raw = addslashes($_POST['price_raw']);
    $description = addslashes($_POST['description']);

    $price = str_replace(',', '', $price_raw);

    $sql = "INSERT INTO `charges` (charge, price, description)
            VALUES ('$charge', '$price', '$description')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        echo "<script>
        window.onload = function() {
            // Display a success message using SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Charge Has been Successfully Added',
                showConfirmButton: true,
                confirmButtonText: 'OK'
            }).then(function() {
                window.location.href = 'index.php?page=charge_record';
            });
        }
     </script>";
    } else {
        echo "<script>
        window.onload = function() {
            // Display a success message using SweetAlert
            Swal.fire({
                icon: 'error',
                title: 'Failed to record Charge Choice.',
                showConfirmButton: false,
                showDenyButton: true,
                denyButtonText: 'OK'
            });
        }
     </script>";
    }
}


if (isset($_POST['submit_transaction'])) {
    $current_holder = intval($_POST['current_holder']);
    $given_date = mysqli_real_escape_string($con, $_POST['given_date']);
    $description = mysqli_real_escape_string($con, $_POST['description']);

    // Insert into sim_card_transactions
    $sql_transaction = "INSERT INTO sim_card_transactions (current_holder, given_date, status, description) 
                         VALUES ('$current_holder', '$given_date', 'Loaned', '$description')";
    if (mysqli_query($con, $sql_transaction)) {
        $transaction_id = mysqli_insert_id($con);

        // Validate and sanitize arrays
        $charges = isset($_POST['charge']) ? $_POST['charge'] : [];
        $owners = isset($_POST['owner']) ? $_POST['owner'] : [];
        $phone_numbers = isset($_POST['phone_number']) ? $_POST['phone_number'] : [];
        $payment_periods = isset($_POST['payment_period']) ? $_POST['payment_period'] : [];
        $expire_dates = isset($_POST['expire_date']) ? $_POST['expire_date'] : [];
        $payment_types = isset($_POST['payment_type']) ? $_POST['payment_type'] : [];
        $description_lines = isset($_POST['description_line']) ? $_POST['description_line'] : [];

        // Ensure all arrays have the same length
        $row_count = count($charges);

        for ($i = 0; $i < $row_count; $i++) {
            $charge = isset($charges[$i]) ? intval($charges[$i]) : 0;
            $owner = isset($owners[$i]) ? intval($owners[$i]) : 0;
            $phone_number = isset($phone_numbers[$i]) ? mysqli_real_escape_string($con, $phone_numbers[$i]) : '';
            $payment_period = isset($payment_periods[$i]) ? mysqli_real_escape_string($con, $payment_periods[$i]) : '';
            $expire_date = isset($expire_dates[$i]) && !empty($expire_dates[$i]) ? "'" . mysqli_real_escape_string($con, $expire_dates[$i]) . "'" : "NULL";
            $payment_type = isset($payment_types[$i]) ? mysqli_real_escape_string($con, $payment_types[$i]) : '';
            $description_line = isset($description_lines[$i]) ? mysqli_real_escape_string($con, $description_lines[$i]) : '';

            // Insert into sim_card_transactions_line
            $sql_line = "INSERT INTO sim_card_transactions_line 
                         (transaction_id, charge, owner, phone_number, payment_period, expire_date, payment_type, description_line, status) 
                         VALUES 
                         ('$transaction_id', '$charge', '$owner', '$phone_number', '$payment_period', $expire_date, '$payment_type', '$description_line', 'Loaned')";

            if (!mysqli_query($con, $sql_line)) {
                echo "<script>alert('Failed to insert transaction line: " . mysqli_error($con) . "');</script>";
            }
        }

        // Success message
        echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Transaction Successfully Saved!',
            confirmButtonText: 'OK'
        }).then(() => window.location.href = 'index.php?page=ethiotele_transaction');
        </script>";
    } else {
        // Error message for transaction insert
        echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'Failed to Save Transaction',
            text: '" . mysqli_error($con) . "',
            confirmButtonText: 'OK'
        });
        </script>";
    }

    // Close the database connection
    mysqli_close($con);
}
