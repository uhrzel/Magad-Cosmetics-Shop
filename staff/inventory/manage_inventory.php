<?php
// Fetch the current user ID from the session or other authentication mechanism
$current_user_id = isset($_SESSION['userdata']['id']) ? $_SESSION['userdata']['id'] : null;
?>

<div class="card card-outline card-info">
	<div class="card-header">
		<h3 class="card-title"><?php echo isset($id) ? "Update " : "Create New " ?> Inventory</h3>
	</div>
	<div class="card-body">
		<form action="" id="inventory-form">
			<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
			<input type="hidden" name="user_id_inventory" value="<?php echo $current_user_id; ?>">
			<div class="form-group">
				<label for="product_id" class="control-label">Product</label>
				<select name="product_id" id="product_id" class="custom-select select2" required>
					<option value=""></option>
					<?php
					$qry = $conn->query("SELECT * FROM `products` WHERE delete_flag = 0 AND user_id = '{$current_user_id}' " . (isset($product_id) ? " OR id = '{$product_id}'" : "") . " ORDER BY `name` ASC");
					while ($row = $qry->fetch_assoc()):
						foreach ($row as $k => $v) {
							$row[$k] = trim(stripslashes($v));
						}
					?>
						<option value="<?php echo $row['id'] ?>" <?php echo isset($product_id) && $product_id == $row['id'] ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
					<?php endwhile; ?>
				</select>
			</div>
			<div class="form-group">
				<label for="variant" class="control-label">Variant</label>
				<input type="text" class="form-control form" required name="variant" value="<?php echo isset($variant) ? $variant : '' ?>">
			</div>
			<div class="form-group">
				<label for="quantity" class="control-label">Beginning Quantity</label>
				<input type="number" class="form-control form" required name="quantity" value="<?php echo isset($quantity) ? $quantity : '' ?>">
			</div>
			<div class="form-group">
				<label for="price" class="control-label">Price</label>
				<input type="number" step="any" class="form-control form" required name="price" value="<?php echo isset($price) ? $price : '' ?>">
			</div>
		</form>
	</div>
	<div class="card-footer">
		<button class="btn btn-flat btn-primary" form="inventory-form">Save</button>
		<a class="btn btn-flat btn-default" href="?page=inventory">Cancel</a>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('.select2').select2({
			placeholder: "Please Select here",
			width: "relative"
		});
		$('#inventory-form').submit(function(e) {
			e.preventDefault();
			var _this = $(this);
			$('.err-msg').remove();
			start_loader();
			$.ajax({
				url: _base_url_ + "classes/Master.php?f=save_inventory",
				data: new FormData($(this)[0]),
				cache: false,
				contentType: false,
				processData: false,
				method: 'POST',
				type: 'POST',
				dataType: 'json',
				error: err => {
					console.log(err);
					alert_toast("An error occurred", 'error');
					end_loader();
				},
				success: function(resp) {
					if (typeof resp == 'object' && resp.status == 'success') {
						location.href = "./?page=inventory";
					} else if (resp.status == 'failed' && !!resp.msg) {
						var el = $('<div>');
						el.addClass("alert alert-danger err-msg").text(resp.msg);
						_this.prepend(el);
						el.show('slow');
						$("html, body").animate({
							scrollTop: _this.closest('.card').offset().top
						}, "fast");
						end_loader();
					} else {
						alert_toast("An error occurred", 'error');
						end_loader();
						console.log(resp);
					}
				}
			});
		});
	});
</script>