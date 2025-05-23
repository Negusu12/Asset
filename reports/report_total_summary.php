<div class="wrapperr">
    <div class="container-fluidd">

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table class="table tabe-hover table-bordered mydatatable" id="mydatatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Model</th>
                                <th scope="col">Item Category</th>
                                <th scope="col">Item Type</th>
                                <th scope="col">UOM</th>
                                <th scope="col">In Store Quantity</th>
                                <th scope="col">In Loan Quantity</th>
                                <th scope="col">Inactive Quantity</th>
                                <th scope="col">Total Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            $qry = $con->query("select * from total_item_qty_view");
                            while ($row = $qry->fetch_assoc()) :
                            ?>
                                <tr>
                                    <th class="text-center"><?php echo $i++ ?></th>
                                    <td><b><?php echo ucwords($row['item_name']) ?></b></td>
                                    <td><b><?php echo $row['brand'] ?></b></td>
                                    <td><b><?php echo $row['model'] ?></b></td>
                                    <td><b><?php echo $row['item_category'] ?></b></td>
                                    <td><b><?php echo $row['item_type'] ?></b></td>
                                    <td><b><?php echo $row['uom'] ?></b></td>
                                    <td><b><?php echo $row['total_qty_record'] ?></b></td>
                                    <td><b><?php echo $row['total_qty_loan'] ?></b></td>
                                    <td><b><?php echo $row['total_qty_inactive'] ?></b></td>
                                    <td><b><?php echo $row['total_qty'] ?></b></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="7" class="text-right">Total Quantity:</th>
                                <th id="storeQuantity"></th>
                                <th id="loanQuantity"></th>
                                <th id="inactiveQuantity"></th>
                                <th id="totalQuantity"></th>
                            </tr>
                        </tfoot>
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
                    targets: [5], // index of the "Password" column (zero-based index)
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
    // Calculate and display total quantity
    function calculateStoreQuantity() {
        var storeQuantity = 0;
        $('#mydatatable tbody tr').each(function() {
            var total_qty_record = parseFloat($(this).find('td:not(.hiddenColumn):eq(5)').text().trim());
            if (!isNaN(total_qty_record)) {
                storeQuantity += total_qty_record;
            }
        });
        $('#storeQuantity').text(storeQuantity);
    }

    calculateStoreQuantity(); // Initial calculation
    $('#mydatatable').on('draw.dt', function() {
        calculateStoreQuantity(); // Recalculate total quantity when the DataTable is redrawn (e.g., page change)
    });

    function calculateLoanQuantity() {
        var loanQuantity = 0;
        $('#mydatatable tbody tr').each(function() {
            var total_qty_loan = parseFloat($(this).find('td:not(.hiddenColumn):eq(6)').text().trim());
            if (!isNaN(total_qty_loan)) {
                loanQuantity += total_qty_loan;
            }
        });
        $('#loanQuantity').text(loanQuantity);
    }

    calculateLoanQuantity(); // Initial calculation

    $('#mydatatable').on('draw.dt', function() {
        calculateLoanQuantity(); // Recalculate total quantity when the DataTable is redrawn (e.g., page change)
    });


    function calculateInactiveQuantity() {
        var inactiveQuantity = 0;
        $('#mydatatable tbody tr').each(function() {
            var total_qty_inactive = parseFloat($(this).find('td:not(.hiddenColumn):eq(7)').text().trim());
            if (!isNaN(total_qty_inactive)) {
                inactiveQuantity += total_qty_inactive;
            }
        });
        $('#inactiveQuantity').text(inactiveQuantity);
    }

    calculateInactiveQuantity(); // Initial calculation
    $('#mydatatable').on('draw.dt', function() {
        calculateInactiveQuantity(); // Recalculate total quantity when the DataTable is redrawn (e.g., page change)
    });

    function calculateTotalQuantity() {
        var totalQuantity = 0;
        $('#mydatatable tbody tr').each(function() {
            var total_qty = parseFloat($(this).find('td:not(.hiddenColumn):eq(8)').text().trim());
            if (!isNaN(total_qty)) {
                totalQuantity += total_qty;
            }
        });
        $('#totalQuantity').text(totalQuantity);
    }

    calculateTotalQuantity(); // Initial calculation
    $('#mydatatable').on('draw.dt', function() {
        calculateTotalQuantity(); // Recalculate total quantity when the DataTable is redrawn (e.g., page change)
    });
</script>