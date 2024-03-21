<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <table class="table tabe-hover table-bordered mydatatable" id="mydatatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th scope="col">loan ID</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Model</th>
                        <th scope="col">Category</th>
                        <th scope="col">Type</th>
                        <th scope="col">Loaner Name</th>
                        <th scope="col">UOM</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Document Date</th>
                        <th scope="col">Description</th>
                        <th scope="col">Prepared By</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    $qry = $con->query("select * from asset_return_v");
                    while ($row = $qry->fetch_assoc()) :
                    ?>
                        <tr>
                            <th class="text-center"><?php echo $i++ ?></th>
                            <td><b><?php echo $row['loan_id'] ?></b></td>
                            <td><b><?php echo ucwords($row['item_name']) ?></b></td>
                            <td><b><?php echo $row['brand'] ?></b></td>
                            <td><b><?php echo $row['model'] ?></b></td>
                            <td><b><?php echo $row['item_category'] ?></b></td>
                            <td><b><?php echo $row['item_type'] ?></b></td>
                            <td><b><?php echo $row['full_name'] ?></b></td>
                            <td><b><?php echo $row['uom'] ?></b></td>
                            <td><b><?php echo $row['qty'] ?></b></td>
                            <td><b><?php echo date('F d Y', strtotime($row['doc_date'])) ?></b></td>
                            <td><b><?php echo $row['description'] ?></b></td>
                            <td><b><?php echo $row['user_name'] ?></b></td>
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
                    targets: [1, 6], // index of the "Password" column (zero-based index)
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