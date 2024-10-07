<?php
$user = $conn->query("SELECT * FROM users where id ='" . $_settings->userdata('id') . "'");
foreach ($user->fetch_array() as $k => $v) {
	$meta[$k] = $v;
}
?>
<?php if ($_settings->chk_flashdata('success')): ?>
	<script>
		alert_toast("<?php echo $_settings->flashdata('success') ?>", 'success')
	</script>
<?php endif; ?>

<div class="card card-outline card-primary">
	<div class="card-body">
		<div class="container-fluid">
			<div id="msg"></div>
			<form action="" id="manage-user">
				<input type="hidden" name="id" value="<?php echo $_settings->userdata('id') ?>">

				<!-- First Name -->
				<div class="form-group">
					<label for="firstname">First Name</label>
					<input type="text" name="firstname" id="firstname" class="form-control" value="<?php echo isset($meta['firstname']) ? $meta['firstname'] : '' ?>" required>
				</div>

				<!-- Last Name -->
				<div class="form-group">
					<label for="lastname">Last Name</label>
					<input type="text" name="lastname" id="lastname" class="form-control" value="<?php echo isset($meta['lastname']) ? $meta['lastname'] : '' ?>" required>
				</div>

				<!-- Username -->
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" name="username" id="username" class="form-control" value="<?php echo isset($meta['username']) ? $meta['username'] : '' ?>" required autocomplete="off">
				</div>

				<!-- Password -->
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" name="password" id="password" class="form-control" value="" autocomplete="off">
					<small><i>Leave this blank if you don't want to change the password.</i></small>
				</div>

				<!-- Avatar -->
				<div class="form-group">
					<label for="customFile" class="control-label">Avatar</label>
					<div class="custom-file">
						<input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" onchange="displayImg(this,$(this))" accept="image/png, image/jpeg">
						<label class="custom-file-label" for="customFile">Choose file</label>
					</div>
				</div>

				<div class="form-group d-flex justify-content-center">
					<img src="<?php echo validate_image(isset($meta['avatar']) ? $meta['avatar'] : '') ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
				</div>

				<!-- Type Application -->


				<!-- Farm Details -->

				<div class="form-group">
					<label for="email_address">Email Address</label>
					<input type="email" name="email_address" id="email_address" class="form-control" value="<?php echo isset($meta['email_address']) ? $meta['email_address'] : '' ?>">
				</div>
				<div class="form-group">
					<label for="mobile_number">Mobile Number</label>
					<input type="text" name="mobile_number" id="mobile_number" class="form-control" value="<?php echo isset($meta['mobile_number']) ? $meta['mobile_number'] : '' ?>">
				</div>

			</form>
		</div>
	</div>
	<div class="card-footer">
		<div class="col-md-12">
			<div class="row" style="gap: 10px;">
				<button class="btn btn-sm btn-primary" form="manage-user">Update</button>
				<!-- 	<form id="generate-pdf-form" action="user/generate_pdf.php" method="POST" target="_blank">
					<input type="hidden" name="id" value="<?php echo $_settings->userdata('id') ?>">
					<button type="submit" class="btn btn-sm btn-warning" style="background-color: red; color: white;">Generate PDF</button>
				</form> -->
				<button class="btn btn-sm btn-default" type="button" id="close">Close</button>
			</div>
		</div>
	</div>
</div>

<style>
	img#cimg {
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100%;
	}
</style>

<script>
	function displayImg(input, _this) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$('#cimg').attr('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		} else {
			$('#cimg').attr('src', "<?php echo validate_image(isset($meta['avatar']) ? $meta['avatar'] : '') ?>");
		}
	}

	$('#manage-user').submit(function(e) {
		e.preventDefault();
		start_loader();
		$.ajax({
			url: _base_url_ + 'classes/Users.php?f=save_farmer',
			data: new FormData($(this)[0]),
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			success: function(resp) {
				if (resp == 1) {
					location.reload();
				} else {
					$('#msg').html('<div class="alert alert-danger">' + resp + '</div>');
					end_loader();
				}
			}
		});
	});
</script>