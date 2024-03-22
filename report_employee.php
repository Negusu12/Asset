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
                        <th scope="col">employee_id</th>
                        <th scope="col">full_name</th>
                        <th scope="col">department</th>
                        <?php if ($user_data['role'] == 1) : ?>
                            <th scope="col">Action</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $qry = $con->query("select * from employee order by employee_id desc");
                    while ($row = $qry->fetch_assoc()) :
                    ?>
                        <tr>
                            <th class="text-center"><?php echo $i++ ?></th>
                            <td><b><?php echo $row['employee_id'] ?></b></td>
                            <td><b><?php echo $row['full_name'] ?></b></td>
                            <td><b><?php echo $row['department'] ?></b></td>
                            <?php if ($user_data['role'] == 1) : ?>
                                <td class="text-center">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                        Action
                                    </button>
                                    <div class="dropdown-menu" style="">
                                        <a class="dropdown-item" href="./index.php?page=backend/edit_employee&employee_id=<?php echo $row['employee_id'] ?>">Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" onclick='confirmDelete(<?php echo $row['employee_id']; ?>)'>Delete</a>

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
            buttons: ['excel', 'pdf', 'colvis'],
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
                window.location.href = 'backend/delete_employee.php?employee_id=' + userId;
            }
        });
    }
</script>