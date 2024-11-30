<div class="wrapperr">
	<div class="container-fluidd">
		<div class="navigation_arrow">
			<button class="navigation-btn" onclick="goBack()"><i class="fas fa-arrow-left"></i></button>
			<button class="navigation-btn" onclick="goForward()"><i class="fas fa-arrow-right"></i></button>
		</div>
		<div class="col-lg-12">
			<div class="card">
				<div class="card-body">
					<table class="table table-hover table-bordered mydatatable" id="mydatatable">
						<thead>
							<tr>
								<th>#</th>
								<th>Transaction ID</th>
								<th>Current Holder</th>
								<th>Given Date</th>
								<th>Status</th>
								<th>Description</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
							// Replace with your DB connection
							include 'connect.php';

							$status = isset($_GET['status']) ? $_GET['status'] : '';
							$sql = "SELECT
st.transaction_id,
e.full_name AS current_holder,
st.given_date,
st.status,
st.description
from sim_card_transactions st
LEFT JOIN employee e ON st.current_holder = e.employee_id";

							// Append condition for payment_type if specified
							if ($status === 'Loaned') {
								$sql .= " WHERE st.status = 'Loaned'";
							}

							$sql .= " ORDER BY st.transaction_id DESC";
							$result = mysqli_query($con, $sql);
							$i = 1;

							if ($result) {
								while ($row = mysqli_fetch_assoc($result)) :
							?>
									<tr>
										<th class="text-center"><?php echo $i++; ?></th>
										<td><b><?php echo $row['transaction_id']; ?></b></td>
										<td><b><?php echo $row['current_holder']; ?></b></td>
										<td><b><?php echo date('Y-m-d', strtotime($row['given_date'])); ?></b></td>
										<td><b><?php echo $row['status']; ?></b></td>
										<td><b><?php echo $row['description']; ?></b></td>
										<td class="text-center">
											<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
												Action
											</button>
											<div class="dropdown-menu">
												<li><button class='dropdown-item' onclick='viewDetails(<?php echo $row['transaction_id']; ?>)'>View Details</button></li>
												<li class='dropdown-divider'></li>
												<a class="dropdown-item" onclick='editRow(<?php echo json_encode($row); ?>)'>Edit</a>
											</div>
										</td>

									</tr>
							<?php
								endwhile;
							}
							?>
						</tbody>
					</table>




				</div>
			</div>

			<!-- Modal for viewing details -->
			<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="detailsModalLabel">Sales Details</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="table-responsive">
								<table class="table table-hover table-bordered" id="mydatatablemodel">
									<thead>
										<tr>
											<th>Transaction Id Line</th>
											<th>Charge</th>
											<th>Owner</th>
											<th>Phone Number</th>
											<th>Payment Period</th>
											<th>Expire Date</th>
											<th>Taken Date</th>
											<th>Payment Type</th>
											<th>Status Line</th>
											<th>Description Line</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody id="detailsTableBody">
										<!-- Details will be loaded here using AJAX -->
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

			<!-- Edit detail -->
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
									<label for="" class="control-label">Status</label>
									<select name="status" id="status" class="custom-select custom-select-sm select2" oninvalid="this.setCustomValidity('Select status Here')" oninput="setCustomValidity('')" required>
										<option value=""></option>
										<option value="Returned">Returned</option>
										<option value="Expired">Expired</option>
										<option value="Loaned">Loaned</option>
									</select>
								</div>
								<div class="form-group">
									<label for="description">Description</label>
									<textarea class="form-control" id="descriptionn" name="description"></textarea>
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

			<!-- Edit detail -->
			<div class="modal fade" id="editModalLine" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<form action="backend/edit_report.php" method="POST">
							<div class="modal-header">
								<h5 class="modal-title" id="editModalLabel">Edit Record Line</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<input type="hidden" id="transactionIdLine" name="transaction_id_line">
								<div class="form-group">
									<label for="takenDate">Taken Date</label>
									<input type="date" class="form-control" id="takenDate" name="taken_date">
								</div>
								<div class="form-group">
									<label for="" class="control-label">Status</label>
									<select name="status" id="statuss" class="custom-select custom-select-sm select2" oninvalid="this.setCustomValidity('Select status Here')" oninput="setCustomValidity('')" required>
										<option value=""></option>
										<option value="Returned">Returned</option>
										<option value="Expired">Expired</option>
										<option value="Loaned">Loaned</option>
									</select>
								</div>

								<div class="form-group">
									<label for="description">Description Line</label>
									<textarea class="form-control" id="description_line" name="description_line"></textarea>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
								<button type="submit" class="btn btn-primary" name="update_transaction_line">Save Changes</button>
							</div>
						</form>
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

				// Add Date Range Filtering Inputs
				$('#mydatatable thead th').each(function() {
					var columnTitle = $(this).text().trim();
					var that = table.column($(this).index());

					// Check if the column title matches 'Date'
					if (columnTitle === 'Given Date') {
						var dateFilterHtml = `
                <input type="text" id="minDate" class="form-control datepicker" placeholder="From Date" style="margin-bottom:5px;"/>
                <input type="text" id="maxDate" class="form-control datepicker" placeholder="To Date"/>
            `;
						$(this).append(dateFilterHtml);

						// Initialize jQuery UI Datepicker on both inputs
						$(".datepicker").datepicker({
							dateFormat: 'yy-mm-dd', // Set the format to match your database format
							onSelect: function() {
								table.draw();
							}
						});
					} else {
						// Create a regular text input element for other columns
						$('<input type="text" class="form-control" placeholder="Filter"/>')
							.appendTo($(this))
							.on('keyup change', function() {
								that.search($(this).val()).draw();
							});
					}
				});

				// Custom filtering function for date range
				$.fn.dataTable.ext.search.push(
					function(settings, data, dataIndex) {
						var min = $('#minDate').val();
						var max = $('#maxDate').val();
						var date = data[3]; // Assuming the date column index is 3

						if (min && new Date(min).toString() === "Invalid Date") {
							min = null;
						}
						if (max && new Date(max).toString() === "Invalid Date") {
							max = null;
						}

						// Convert string to date for comparison
						var dateValue = new Date(date);

						if ((min === "" || min === null) && (max === "" || max === null)) {
							return true; // No filtering if both min and max are empty
						}
						if ((min === "" || min === null) && dateValue <= new Date(max)) {
							return true; // Only max filter
						}
						if (min && !max && dateValue.toDateString() === new Date(min).toDateString()) {
							return true; // Only min filter with exact date match
						}
						if (dateValue >= new Date(min) && dateValue <= new Date(max)) {
							return true; // Within the range

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

			function viewDetails(transaction_id) {
				$.ajax({
					url: 'backend/fetch_item_details.php',
					method: 'POST',
					data: {
						transaction_id: transaction_id
					},
					success: function(response) {
						$('#detailsTableBody').html(response);
						$('#detailsModal').modal('show');
					}
				});
			}
		</script>
		<script>
			function editRow(row) {
				$('#transactionId').val(row.transaction_id);
				$('#status').val(row.status).trigger('change');
				$('#descriptionn').val(row.description);
				$('#editModal').modal('show');
			}
		</script>
		<script>
			function editRowLine(row) {
				$('#transactionIdLine').val(row.transaction_id_line);
				$('#takenDate').val(row.taken_date);
				$('#statuss').val(row.status).trigger('change'); // Use .trigger('change') to update select2
				$('#description_line').val(row.description_line);
				$('#editModalLine').modal('show');
			}
		</script>


		<script>
			$(document).ready(function() {
				$('#detailsModal').on('shown.bs.modal', function() {
					if (!$.fn.DataTable.isDataTable('#mydatatablemodel')) {

						var isDataTableInitialized = $.fn.DataTable.isDataTable('#mydatatablemodel');

						// If DataTable is initialized, destroy it
						if (isDataTableInitialized) {
							$('#mydatatablemodel').DataTable().destroy();
						}

						var table = $('#mydatatablemodel').DataTable({
							dom: 'Bfrtip',
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


						// Add Date Range Filtering Inputs
						$('#mydatatable thead th').each(function() {
							var columnTitle = $(this).text().trim();
							var that = table.column($(this).index());

							// Check if the column title matches 'Date'
							if (columnTitle === 'Expire Date') {
								var dateFilterHtml = `
                <input type="text" id="minDate" class="form-control datepicker" placeholder="From Date" style="margin-bottom:5px;"/>
                <input type="text" id="maxDate" class="form-control datepicker" placeholder="To Date"/>
            `;
								$(this).append(dateFilterHtml);

								// Initialize jQuery UI Datepicker on both inputs
								$(".datepicker").datepicker({
									dateFormat: 'yy-mm-dd', // Set the format to match your database format
									onSelect: function() {
										table.draw();
									}
								});
							} else {
								// Create a regular text input element for other columns
								$('<input type="text" class="form-control" placeholder="Filter"/>')
									.appendTo($(this))
									.on('keyup change', function() {
										that.search($(this).val()).draw();
									});
							}
						});

						// Custom filtering function for date range
						$.fn.dataTable.ext.search.push(
							function(settings, data, dataIndex) {
								var min = $('#minDate').val();
								var max = $('#maxDate').val();
								var date = data[5]; // Assuming the date column index is 3

								if (min && new Date(min).toString() === "Invalid Date") {
									min = null;
								}
								if (max && new Date(max).toString() === "Invalid Date") {
									max = null;
								}

								// Convert string to date for comparison
								var dateValue = new Date(date);

								if ((min === "" || min === null) && (max === "" || max === null)) {
									return true; // No filtering if both min and max are empty
								}
								if ((min === "" || min === null) && dateValue <= new Date(max)) {
									return true; // Only max filter
								}
								if (min && !max && dateValue.toDateString() === new Date(min).toDateString()) {
									return true; // Only min filter with exact date match
								}
								if (dateValue >= new Date(min) && dateValue <= new Date(max)) {
									return true; // Within the range

									input = $('<input type="text" class="form-control" placeholder="Filter"/>')
										.appendTo($(this.header()))
										.on('keyup change', function() {
											that.search($(this).val()).draw();
										});
								}
							});
					}
				});

				table.buttons().container()
					.appendTo('#mydatatable_wrapper .col-md-6:eq(0)');
			});
		</script>