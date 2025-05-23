<div class="col-lg-12">
    <div class="card">
        <div class="card-body">
            <table class="table tabe-hover table-bordered mydatatable" id="mydatatable">
                <thead>
                    <tr>
                        <th>Row No.</th>
                        <th scope="col">Loan ID</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Model</th>
                        <th scope="col">Item Category</th>
                        <th scope="col">Item Type</th>
                        <th scope="col">Serial No.</th>
                        <th scope="col">Loaned To</th>
                        <th scope="col">Borrower Department</th>
                        <th scope="col">UOM</th>
                        <th scope="col">Loaned Quantity</th>
                        <th scope="col">Quantity on Loan</th>
                        <th scope="col">Document Date</th>
                        <th scope="col">Description</th>
                        <th scope="col">Prepared By</th>
                        <th scope="col">Print</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include("connect.php");
                    $i = 1;
                    if (isset($_GET['item_code'])) {
                        $item_code = $_GET['item_code'];
                        $qry = $con->prepare("SELECT * FROM asset_loan_v WHERE qty > 0 and department != 'damaged' AND item_code = ?");
                        $qry->bind_param("s", $item_code);
                        $qry->execute();
                        $result = $qry->get_result();
                        while ($row = $result->fetch_assoc()) {
                            $id = $row['loan_id'];
                    ?>
                            <tr>
                                <th class="text-center"><?php echo $i++ ?></th>
                                <td><b><?php echo $row['loan_id'] ?></b></td>
                                <td><b><?php echo ucwords($row['item_name']) ?></b></td>
                                <td><b><?php echo $row['brand'] ?></b></td>
                                <td><b><?php echo $row['model'] ?></b></td>
                                <td><b><?php echo $row['item_category'] ?></b></td>
                                <td><b><?php echo $row['item_type'] ?></b></td>
                                <td><b><?php echo $row['serial_no'] ?></b></td>
                                <td><b><?php echo $row['full_name'] ?></b></td>
                                <td><b><?php echo $row['department'] ?></b></td>
                                <td><b><?php echo $row['uom'] ?></b></td>
                                <td><b><?php echo ucwords($row['qty_taken']) ?></b></td>
                                <td><b><?php echo $row['qty'] ?></b></td>
                                <td><b><?php echo date('F d Y', strtotime($row['doc_date'])) ?></b></td>
                                <td><b><?php echo $row['description'] ?></b></td>
                                <td><b><?php echo $row['user_name'] ?></b></td>

                                <td>
                                    <div>
                                        <a class="custom-button" style="padding: 5px;" href="print_loan.php?loan_id=<?php echo $row['loan_id'] ?>" target="_blank">Print</a>
                                    </div>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Include necessary JavaScript libraries -->
<!-- Assuming you already have included jQuery, DataTables, and other required libraries -->
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
                targets: [0, 6, 9, 13], // index of the columns to hide by default
                visible: false
            }]
        });
        table.columns().every(function() {
            var that = this;
            var columnTitle = $(this.header()).text().trim();
            var input = $('<input type="text" class="form-control" placeholder="Filter"/>')
                .appendTo($(this.header()))
                .on('keyup change', function() {
                    that.search($(this).val()).draw();
                });
        });
        table.buttons().container()
            .appendTo('#mydatatable_wrapper .col-md-6:eq(0)');
    });
</script>
<script>
    function confirmDelete(userId) {
        // Confirm delete action
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
                window.location.href = 'delete_user.php?id=' + userId; // Redirect to delete script
            }
        });
    }
</script>