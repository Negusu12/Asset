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
								<th scope="col">System Item Code</th>
								<th scope="col">Charge</th>
								<th scope="col">Owner</th>
								<th scope="col">Current Holder</th>
								<th scope="col">Phone Number</th>
								<th scope="col">Payment Period</th>
								<th scope="col">Expire Date</th>
								<th scope="col">Given Date</th>
								<th scope="col">Taken Date</th>
								<th scope="col">Payment Type</th>
								<th scope="col">Status</th>
								<th scope="col">Description</th>
								<th scope="col">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;
							$qry = $con->query("select * from sim_card_transactions order by transaction_id desc");
							while ($row = $qry->fetch_assoc()) :
							?>
								<tr>
									<th class="text-center"><?php echo $i++ ?></th>
									<td><b><?php echo $row['transaction_id'] ?></b></td>
									<td><b><?php echo $row['charge'] ?></b></td>
									<td><b><?php echo ucwords($row['owner']) ?></b></td>
									<td><b><?php echo $row['current_holder'] ?></b></td>
									<td><b><?php echo $row['phone_number'] ?></b></td>
									<td><b><?php echo $row['payment_period'] ?></b></td>
									<td><b><?php echo $row['expire_date'] ?></b></td>
									<td><b><?php echo $row['given_date'] ?></b></td>
									<td><b><?php echo $row['taken_date'] ?></b></td>
									<td><b><?php echo $row['payment_type'] ?></b></td>
									<td><b><?php echo $row['status'] ?></b></td>
									<td><b><?php echo $row['description'] ?></b></td>
									<td class="text-center">
										<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
											Action
										</button>
										<div class="dropdown-menu">
											<a class="dropdown-item" onclick='editRow(<?php echo json_encode($row); ?>)'>Edit</a>
										</div>
									</td>

								</tr>
							<?php endwhile; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="backend/edit_report.php" method="POST">
				<div class="modal-header">
					<h5 class="modal-title" id="editModalLabel">Edit Record</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<input type="hidden" id="transactionId" name="transaction_id">
					<div class="form-group">
						<label for="takenDate">Taken Date</label>
						<input type="date" class="form-control" id="takenDate" name="taken_date">
					</div>
					<div class="form-group">
						<label for="status">Status</label>
						<input type="text" class="form-control" id="status" name="status">
					</div>
					<div class="form-group">
						<label for="description">Description</label>
						<textarea class="form-control" id="description" name="description"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-primary" name="update_transaction">Save Changes</button>
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

<script>
	function editRow(row) {
		$('#transactionId').val(row.transaction_id);
		$('#takenDate').val(row.taken_date);
		$('#status').val(row.status);
		$('#description').val(row.description);
		$('#editModal').modal('show');
	}
</script>