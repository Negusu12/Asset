<div class="wrapperr">
    <div class="container-fluidd">
        <div class="navigation_arrow">
            <button class="navigation-btn" onclick="goBack()"><i class="fas fa-arrow-left"></i></button>
            <button class="navigation-btn" onclick="goForward()"><i class="fas fa-arrow-right"></i></button>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table tabe-hover table-bordered mydatatable" id="mydatatable">
                        <thead>
                            <tr>
                                <th scope="col">row_No</th>
                                <th scope="col">list_id</th>
                                <th scope="col">Department</th>
                                <th scope="col">Category</th>
                                <th scope="col">UOM</th>
                                <th scope="col">Location</th>
                                <?php if ($user_data['role'] == 1 || $user_data['role'] == 3) : ?>
                                    <th scope="col">Action</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $qry = $con->query("select * from drop_down_list order by list_id desc");
                            while ($row = $qry->fetch_assoc()) :
                            ?>
                                <tr>
                                    <th class="text-center"><?php echo $i++ ?></th>
                                    <td><b><?php echo $row['list_id'] ?></b></td>
                                    <td><b><?php echo $row['department'] ?></b></td>
                                    <td><b><?php echo $row['category'] ?></b></td>
                                    <td><b><?php echo $row['uom'] ?></b></td>
                                    <td><b><?php echo $row['location'] ?></b></td>
                                    <?php if ($user_data['role'] == 1 || $user_data['role'] == 3) : ?>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                                Action
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" onclick='editRow(<?php echo json_encode($row); ?>)'>Edit</a>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" onclick='confirmDelete(<?php echo $row['list_id']; ?>)'>Delete</a>
                                            </div>
                                        </td>

                                    <?php endif; ?>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Row</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editForm" method="post" action="backend/edit_list.php">
                <div class="modal-body">
                    <input type="hidden" name="list_id" id="edit-list_id">
                    <div class="form-group">
                        <label for="edit-department">Department</label>
                        <input type="text" class="form-control" id="edit-department" name="department">
                    </div>
                    <div class="form-group">
                        <label for="edit-category">Category</label>
                        <input type="text" class="form-control" id="edit-category" name="category">
                    </div>
                    <div class="form-group">
                        <label for="edit-uom">UOM</label>
                        <input type="text" class="form-control" id="edit-uom" name="uom">
                    </div>
                    <div class="form-group">
                        <label for="edit-location">Location</label>
                        <input type="text" class="form-control" id="edit-location" name="location">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
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
                    targets: [0], // index of the "Password" column (zero-based index)
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
                window.location.href = 'backend/delete_list.php?list_id=' + userId;
            }
        });
    }
</script>
<script>
    function editRow(rowData) {
        // Populate the modal with the current values
        const listIdField = document.getElementById('edit-list_id');
        const departmentField = document.getElementById('edit-department');
        const categoryField = document.getElementById('edit-category');
        const uomField = document.getElementById('edit-uom');
        const locationField = document.getElementById('edit-location');

        listIdField.value = rowData.list_id;
        departmentField.value = rowData.department;
        categoryField.value = rowData.category;
        uomField.value = rowData.uom;
        locationField.value = rowData.location;

        // Enable all fields initially
        departmentField.disabled = false;
        categoryField.disabled = false;
        uomField.disabled = false;
        locationField.disabled = false;

        // Disable fields based on current values
        if (departmentField.value) {
            categoryField.disabled = true;
            uomField.disabled = true;
            locationField.disabled = true;
        } else if (categoryField.value) {
            departmentField.disabled = true;
            uomField.disabled = true;
            locationField.disabled = true;
        } else if (uomField.value) {
            departmentField.disabled = true;
            categoryField.disabled = true;
            locationField.disabled = true;
        } else if (locationField.value) {
            departmentField.disabled = true;
            categoryField.disabled = true;
            uomField.disabled = true;
        }

        // Add event listeners to disable other fields when one field is filled
        departmentField.addEventListener('input', () => {
            if (departmentField.value) {
                categoryField.disabled = true;
                uomField.disabled = true;
                locationField.disabled = true;
            } else {
                categoryField.disabled = false;
                uomField.disabled = false;
                locationField.disabled = false;
            }
        });

        categoryField.addEventListener('input', () => {
            if (categoryField.value) {
                departmentField.disabled = true;
                uomField.disabled = true;
                locationField.disabled = true;
            } else {
                departmentField.disabled = false;
                uomField.disabled = false;
                locationField.disabled = false;
            }
        });

        uomField.addEventListener('input', () => {
            if (uomField.value) {
                departmentField.disabled = true;
                categoryField.disabled = true;
                locationField.disabled = true;
            } else {
                departmentField.disabled = false;
                categoryField.disabled = false;
                locationField.disabled = false;
            }
        });

        locationField.addEventListener('input', () => {
            if (locationField.value) {
                departmentField.disabled = true;
                categoryField.disabled = true;
                uomField.disabled = true;
            } else {
                departmentField.disabled = false;
                categoryField.disabled = false;
                uomField.disabled = false;
            }
        });

        // Show the modal
        $('#editModal').modal('show');
    }
</script>