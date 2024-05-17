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
                                <th>#</th>
                                <th scope="col">Use ID</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Model</th>
                                <th scope="col">Item Category</th>
                                <th scope="col">UOM</th>
                                <th scope="col">Quantity Subtracted</th>
                                <th scope="col">Quantity Added</th>
                                <th scope="col">Document Date</th>
                                <th scope="col">Description</th>
                                <th scope="col">Prepared By</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $qry = $con->query("select * from record_adjustment_report order by u_asset desc");
                            while ($row = $qry->fetch_assoc()) :
                            ?>
                                <tr>
                                    <th class="text-center"><?php echo $i++ ?></th>
                                    <td><b><?php echo $row['u_asset'] ?></b></td>
                                    <td><b><?php echo ucwords($row['item_name']) ?></b></td>
                                    <td><b><?php echo $row['brand'] ?></b></td>
                                    <td><b><?php echo $row['model'] ?></b></td>
                                    <td><b><?php echo $row['item_category'] ?></b></td>
                                    <td><b><?php echo $row['uom'] ?></b></td>
                                    <td><b><?php echo $row['subtract_qty'] != 0 ? $row['subtract_qty'] : '' ?></b></td>
                                    <td><b><?php echo $row['add_qty'] != 0 ? $row['add_qty'] : '' ?></b></td>
                                    <td><b><?php echo date('F d Y H:i:s', strtotime($row['doc_date'])) ?></b></td>
                                    <td><b><?php echo $row['description'] ?></b></td>
                                    <td><b><?php echo $row['user_name'] ?></b></td>
                                </tr>
                            <?php endwhile; ?>
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
    // Calculate and display total quantity
    function calculateTotalQuantity() {
        var totalQuantity = 0;
        $('#mydatatable tbody tr').each(function() {
            var qty = parseFloat($(this).find('td:eq(6)').text().trim()); // 5th column (index starts from 0)
            if (!isNaN(qty)) {
                totalQuantity += qty;
            }
        });
        $('#totalQuantity').text(totalQuantity);
    }

    calculateTotalQuantity(); // Initial calculation

    $('#mydatatable').on('draw.dt', function() {
        calculateTotalQuantity(); // Recalculate total quantity when the DataTable is redrawn (e.g., page change)
    });
</script>