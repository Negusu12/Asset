<div class="wrapperr">
	<div class="container-fluidd">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<table class="table tabe-hover table-bordered mydatatable" id="mydatatable">
						<thead>
							<tr>
								<th>#</th>
								<th scope="col">Transaction ID</th>
								<th scope="col">Transaction Line ID</th>
								<th scope="col">Charge</th>
								<th scope="col">SIM Card Owner</th>
								<th scope="col">Current Holder</th>
								<th scope="col">Phone Number</th>
								<th scope="col">Payment Period</th>
								<th scope="col">Expire Date</th>
								<th scope="col">Given Date</th>
								<th scope="col">Taken Date</th>
								<th scope="col">Payment Type</th>
								<th scope="col">Line Status</th>
								<th scope="col">Line Description</th>
								<th scope="col">Status</th>
								<th scope="col">Description</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;
							$qry = $con->query(" SELECT 
    st.transaction_id,
    stl.transaction_id_line,
    c.charge AS charge,
    eo.full_name AS owner,
    ec.full_name AS current_holder,
    stl.phone_number,
    stl.payment_period,
    stl.expire_date,
    st.given_date,
    stl.taken_date,
    stl.payment_type,
    stl.status AS line_status,
    stl.description_line AS line_description,
    st.status AS transaction_status,
    st.description AS transaction_description
FROM sim_card_transactions st
LEFT JOIN sim_card_transactions_line stl ON st.transaction_id = stl.transaction_id
LEFT JOIN charges c ON stl.charge = c.charge_id
LEFT JOIN employee ec ON st.current_holder = ec.employee_id
LEFT JOIN employee eo ON stl.owner = eo.employee_id
where stl.status != 'Loaned'
order by stl.taken_date desc");
							while ($row = $qry->fetch_assoc()) :
							?>
								<tr>
									<th class="text-center"><?php echo $i++ ?></th>
									<td><b><?php echo $row['transaction_id'] ?></b></td>
									<td><b><?php echo $row['transaction_id_line'] ?></b></td>
									<td><b><?php echo $row['charge'] ?></b></td>
									<td><b><?php echo $row['owner'] ?></b></td>
									<td><b><?php echo $row['current_holder'] ?></b></td>
									<td><b><?php echo $row['phone_number'] ?></b></td>
									<td><b><?php echo $row['payment_period'] ?></b></td>
									<td><b><?php echo $row['expire_date'] ?></b></td>
									<td><b><?php echo $row['given_date'] ?></b></td>
									<td><b><?php echo $row['taken_date'] ?></b></td>
									<td><b><?php echo $row['payment_type'] ?></b></td>
									<td><b><?php echo $row['line_status'] ?></b></td>
									<td><b><?php echo $row['line_description'] ?></b></td>
									<td><b><?php echo $row['transaction_status'] ?></b></td>
									<td><b><?php echo $row['transaction_description'] ?></b></td>

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
			],
			columnDefs: [{
					targets: [], // index of the "Password" column (zero-based index)
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