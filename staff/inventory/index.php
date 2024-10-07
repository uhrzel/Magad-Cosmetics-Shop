<?php if ($_settings->chk_flashdata('success')): ?>
	<script>
		alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
	</script>
<?php endif; ?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Inventory</h3>
		<div class="card-tools">
			<a href="?page=inventory/manage_inventory" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span> Create New</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
			<div class="container-fluid">
				<table class="table table-hover table-striped table-bordered">
					<colgroup>
						<col width="5%">
						<col width="25%">
						<col width="20%">
						<col width="20%">
						<col width="20%">
						<col width="10%">
					</colgroup>
					<thead>
						<tr>
							<th>#</th>
							<th>Product</th>
							<th>Variant</th>
							<th>Price</th>
							<th>Stock</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						$current_user_id = isset($_SESSION['userdata']['id']) ? $_SESSION['userdata']['id'] : null;
						if (!$current_user_id) {
							echo "<tr><td colspan='6'>User is not logged in!</td></tr>";
						} else {
							$qry = $conn->query("
                                SELECT i.*, p.name as product, b.name as bname 
                                FROM `inventory` i 
                                INNER JOIN `products` p ON p.id = i.product_id 
                                INNER JOIN brands b ON p.brand_id = b.id 
                                WHERE i.user_id_inventory = $current_user_id 
                                ORDER BY unix_timestamp(i.date_created) DESC
                            ");
							while ($row = $qry->fetch_assoc()):
								$sold = $conn->query("
                                    SELECT SUM(ol.quantity) as sold 
                                    FROM order_list ol 
                                    INNER JOIN orders o ON o.id = ol.order_id 
                                    WHERE ol.inventory_id='{$row['id']}' AND o.`status` != 4
                                ");
								$sold = $sold->num_rows > 0 ? $sold->fetch_assoc()['sold'] : 0;
								$avail = $row['quantity'] - $sold;
								foreach ($row as $k => $v) {
									$row[$k] = trim(stripslashes($v));
								}
						?>
								<tr>
									<td class="text-center"><?php echo $i++; ?></td>
									<td>
										<b><?php echo $row['product'] ?></b> <br>
										<small><b>Brand:</b> <?php echo $row['bname'] ?></small>
									</td>
									<td class=""><?php echo ($row['variant']) ?></td>
									<td class="text-right"><?php echo format_num($row['price']) ?></td>
									<td class="text-right"><?php echo $avail ?></td>
									<td align="center">
										<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
											Action
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<div class="dropdown-menu" role="menu">
											<a class="dropdown-item" href="?page=inventory/manage_inventory&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
										</div>
									</td>
								</tr>
						<?php endwhile;
						} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('.delete_data').click(function() {
			const inventoryId = $(this).attr('data-id');
			_conf("Are you sure to delete this inventory permanently?", "delete_inventory", [inventoryId]);
		});
		$('table th, table td').addClass('align-middle px-2 py1');
		$('.table').dataTable({
			columnDefs: [{
				orderable: false,
				targets: [4]
			}],
			order: [0, 'asc']
		});
		$('.dataTable td, .dataTable th').addClass('py-1 px-2 align-middle');
	});

	function delete_inventory($id) {
		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=delete_inventory",
			method: "POST",
			data: {
				id: $id
			},
			dataType: "json",
			error: err => {
				console.log(err);
				alert_toast("An error occurred.", 'error');
				end_loader();
			},
			success: function(resp) {
				if (typeof resp == 'object' && resp.status == 'success') {
					location.reload();
				} else {
					alert_toast("An error occurred.", 'error');
					end_loader();
				}
			}
		});
	}
</script>