<div class="wrapperr">
    <div class="container-fluidd">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table tabe-hover table-bordered mydatatable" id="mydatatable">
                        <thead>
                            <tr>
                                <th>Row No.</th>
                                <th scope="col">Loan ID</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Model</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Item Category</th>
                                <th scope="col">Item Condition</th>
                                <th scope="col">Item Type</th>
                                <th scope="col">Serial No.</th>
                                <th scope="col">UOM</th>
                                <th scope="col">Inactive Quantity</th>
                                <th scope="col">Quantity still Inactive</th>
                                <th scope="col">Document Date</th>
                                <th scope="col">Description</th>
                                <th scope="col">Item Image</th>
                                <th scope="col">Prepared By</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $qry = $con->query("select * from asset_loan_v where qty > 0 and department = 'damaged' order by loan_id desc");
                            while ($row = $qry->fetch_assoc()) {
                                $id = $row['loan_id'];
                            ?>
                                <tr>
                                    <th class="text-center"><?php echo $i++ ?></th>
                                    <td><b><?php echo $row['loan_id'] ?></b></td>
                                    <td><b><?php echo ucwords($row['item_name']) ?></b></td>
                                    <td><b><?php echo $row['brand'] ?></b></td>
                                    <td><b><?php echo $row['model'] ?></b></td>
                                    <td><b><?php echo $row['item_category'] ?></b></td>
                                    <td><b><?php echo $row['item_condition'] ?></b></td>
                                    <td><b><?php echo $row['item_type'] ?></b></td>
                                    <td><b><?php echo $row['serial_no'] ?></b></td>
                                    <td><b><?php echo $row['uom'] ?></b></td>
                                    <td><b><?php echo ucwords($row['qty_taken']) ?></b></td>
                                    <td><b><?php echo $row['qty'] ?></b></td>
                                    <td><b><?php echo date('F d Y', strtotime($row['doc_date'])) ?></b></td>
                                    <td><b><?php echo $row['description'] ?></b></td>
                                    <td class="img_tbl">
                                        <?php
                                        $image_data = $row['item_image'];
                                        if (!empty($image_data)) {
                                            $base64_image = base64_encode($image_data);
                                            if ($base64_image) {
                                                echo '<img src="data:image/jpeg;base64,' . $base64_image . '" alt="Image" class="img-thumbnail" style="cursor: pointer;" onclick="openImageModal(\'' . $base64_image . '\')">';
                                            } else {
                                                echo '<p>Error: Unable to encode image data.</p>';
                                            }
                                        } else {
                                            echo '<p></p>';
                                        }
                                        ?>
                                    </td>
                                    <td><b><?php echo $row['user_name'] ?></b></td>

                                    <td class="text-center">
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                            Action
                                        </button>
                                        <div class="dropdown-menu">
                                            <?php if ($user_data['role'] == 1 || $user_data['role'] == 3) : ?>
                                                <a class="dropdown-item" href="./index.php?page=backend/edit_inactive&loan_id=<?php echo $row['loan_id'] ?>">Edit</a>
                                            <?php endif; ?>

                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Check if DataTable is already initialized
        var isDataTableInitialized = $.fn.DataTable.isDataTable('#mydatatable');

        // If DataTable is initialized, destroy it
        if (isDataTableInitialized) {
            $('#mydatatable').DataTable().destroy();
        }

        // Initialize DataTable
        var table = $('#mydatatable').DataTable({
            ordering: true,
            buttons: [{
                    extend: 'excel',
                    text: 'Export Excel',
                    exportOptions: {
                        columns: ':visible' // Export only visible columns
                    }
                },
                {
                    extend: 'pdf',
                    text: 'Export PDF',
                    orientation: 'landscape', // Set orientation to landscape
                    exportOptions: {
                        columns: ':visible' // Export only visible columns
                    }
                },
                'colvis'
            ],
            pagingType: 'full_numbers',
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            columnDefs: [{
                    targets: [0, 7, 12], // index of the "Password" column (zero-based index)
                    visible: false // set to false to hide the column by default
                }
                // Add similar blocks for other columns you want to hide by default
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
                window.location.href = 'delete_user.php?id=' + userId;
            }
        });
    }
</script>