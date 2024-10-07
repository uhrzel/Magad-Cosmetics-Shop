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
				<?php
				// Decode the JSON string to an array
				$type_application = json_decode($meta['type_application'], true);
				?>

				<div class="form-group">
					<label>Type of Application</label><br>
					<input type="checkbox" name="type_application[]" value="New" <?php echo (isset($type_application) && in_array('New', $type_application)) ? 'checked' : ''; ?>> New<br>
					<input type="checkbox" name="type_application[]" value="Renewal" <?php echo (isset($type_application) && in_array('Renewal', $type_application)) ? 'checked' : ''; ?>> Renewal
					<label for="certificate_number">Certificate Number</label>
				</div>


				<!-- Farm Details -->
				<div class="form-group">
					<label for="farm_name">Farm Name</label>
					<input type="text" name="farm_name" id="farm_name" class="form-control" value="<?php echo isset($meta['farm_name']) ? $meta['farm_name'] : '' ?>" required>
				</div>
				<div class="form-group">
					<label for="email_address">Email Address</label>
					<input type="email" name="email_address" id="email_address" class="form-control" value="<?php echo isset($meta['email_address']) ? $meta['email_address'] : '' ?>">
				</div>
				<div class="form-group">
					<label for="mobile_number">Mobile Number</label>
					<input type="text" name="mobile_number" id="mobile_number" class="form-control" value="<?php echo isset($meta['mobile_number']) ? $meta['mobile_number'] : '' ?>">
				</div>
				<div class="form-group">
					<label for="hectarage_farm_size">Farm Size (Hectarage) 1</label>
					<input type="text" name="hectarage_farm_size" id="hectarage_farm_size" class="form-control" value="<?php echo isset($meta['hectarage_farm_size']) ? $meta['hectarage_farm_size'] : '' ?>">
				</div>
				<div class="form-group">
					<label>Address 1</label>
					<input type="text" name="street" class="form-control" placeholder="Street" value="<?php echo isset($meta['street']) ? $meta['street'] : '' ?>">
					<input type="text" name="barangay" class="form-control" placeholder="Barangay" value="<?php echo isset($meta['barangay']) ? $meta['barangay'] : '' ?>">
					<input type="text" name="city" class="form-control" placeholder="City" value="<?php echo isset($meta['city']) ? $meta['city'] : '' ?>">
					<input type="text" name="province" class="form-control" placeholder="Province" value="<?php echo isset($meta['province']) ? $meta['province'] : '' ?>">
				</div>


				<div class="form-group">
					<label for="hectarage_farm_size2">Farm Size (Hectarage) 2</label>
					<input type="text" name="hectarage_farm_size2" id="hectarage_farm_size" class="form-control" value="<?php echo isset($meta['hectarage_farm_size2']) ? $meta['hectarage_farm_size2'] : '' ?>">
				</div>
				<div class="form-group">
					<label>Address 2</label>
					<input type="text" name="street2" class="form-control" placeholder="Street" value="<?php echo isset($meta['street2']) ? $meta['street2'] : '' ?>">
					<input type="text" name="barangay2" class="form-control" placeholder="Barangay" value="<?php echo isset($meta['barangay2']) ? $meta['barangay2'] : '' ?>">
					<input type="text" name="city2" class="form-control" placeholder="City" value="<?php echo isset($meta['city2']) ? $meta['city2'] : '' ?>">
					<input type="text" name="province2" class="form-control" placeholder="Province" value="<?php echo isset($meta['province2']) ? $meta['province2'] : '' ?>">
				</div>



				<div class="form-group">
					<label for="hectarage_farm_size3">Farm Size (Hectarage) 3</label>
					<input type="text" name="hectarage_farm_size3" id="hectarage_farm_size3" class="form-control" value="<?php echo isset($meta['hectarage_farm_size3']) ? $meta['hectarage_farm_size3'] : '' ?>">
				</div>
				<div class="form-group">
					<label>Address 3</label>
					<input type="text" name="street3" class="form-control" placeholder="Street" value="<?php echo isset($meta['street3']) ? $meta['street3'] : '' ?>">
					<input type="text" name="barangay3" class="form-control" placeholder="Barangay" value="<?php echo isset($meta['barangay3']) ? $meta['barangay3'] : '' ?>">
					<input type="text" name="city3" class="form-control" placeholder="City" value="<?php echo isset($meta['city3']) ? $meta['city3'] : '' ?>">
					<input type="text" name="province3" class="form-control" placeholder="Province" value="<?php echo isset($meta['province3']) ? $meta['province3'] : '' ?>">
				</div>

				<!-- Crops Applied for Certification -->
				<div class="form-group">
					<label>Crops Applied for PhilGap Certification</label>
					<input type="text" name="crop" class="form-control" value="<?php echo isset($meta['crop']) ? $meta['crop'] : '' ?>" placeholder="Crop">
					<input type="text" name="variety" class="form-control" value="<?php echo isset($meta['variety']) ? $meta['variety'] : '' ?>" placeholder="Variety">
					<input type="text" name="hectarage_crop" class="form-control" value="<?php echo isset($meta['hectarage_crop']) ? $meta['hectarage_crop'] : '' ?>" placeholder="Hectarage">
					<input type="text" name="harvest" class="form-control" value="<?php echo isset($meta['harvest']) ? $meta['harvest'] : '' ?>" placeholder="Harvest">
					<input type="text" name="purpose" class="form-control" value="<?php echo isset($meta['purpose']) ? $meta['purpose'] : '' ?>" placeholder="Purpose">
				</div>

				<!-- Required Documents -->
				<?php
				// Decode the JSON strings to arrays
				$required_documents = json_decode($meta['required_documents'], true);

				?>

				<!-- Required Documents -->
				<div class="form-group">
					<label>Required Documents</label><br>
					<input type="checkbox" name="required_documents[]" value="Farm or organization profile" <?php echo (isset($required_documents) && in_array('Farm or organization profile', $required_documents)) ? 'checked' : ''; ?>> Farm or organization profile<br>
					<input type="checkbox" name="required_documents[]" value="Farm map" <?php echo (isset($required_documents) && in_array('Farm map', $required_documents)) ? 'checked' : ''; ?>> Farm map<br>
					<input type="checkbox" name="required_documents[]" value="Farm layout" <?php echo (isset($required_documents) && in_array('Farm layout', $required_documents)) ? 'checked' : ''; ?>> Farm layout<br>
					<input type="checkbox" name="required_documents[]" value="Field operation Procedures" <?php echo (isset($required_documents) && in_array('Field operation Procedures', $required_documents)) ? 'checked' : ''; ?>> Field operation Procedures<br>
					<input type="checkbox" name="required_documents[]" value="Production and Harvesting Records" <?php echo (isset($required_documents) && in_array('Production and Harvesting Records', $required_documents)) ? 'checked' : ''; ?>> Production and Harvesting Records<br>
					<input type="checkbox" name="required_documents[]" value="List of Farm inputs (Annex B)" <?php echo (isset($required_documents) && in_array('List of Farm inputs (Annex B)', $required_documents)) ? 'checked' : ''; ?>> List of Farm inputs (Annex B)<br>
					<input type="checkbox" name="required_documents[]" value="Certificate of Nutrient Soil Analysis" <?php echo (isset($required_documents) && in_array('Certificate of Nutrient Soil Analysis', $required_documents)) ? 'checked' : ''; ?>> Certificate of Nutrient Soil Analysis<br>
					<input type="checkbox" name="required_documents[]" value="Certificate of training on GAP conducted by ATI, BPI, LGU, DA RFO, SUCs or by ATI accredited service providers" <?php echo (isset($required_documents) && in_array('Certificate of training on GAP conducted by ATI, BPI, LGU, DA RFO, SUCs or by ATI accredited service providers', $required_documents)) ? 'checked' : ''; ?>> Certificate of training on GAP conducted by ATI, BPI, LGU, DA RFO, SUCs or by ATI accredited service providers<br>
					<input type="checkbox" name="required_documents[]" value="Certification of Registration and other permits e.g. RSBSA, SEC, DTI, CDA (as applicable)" <?php echo (isset($required_documents) && in_array('Certification of Registration and other permits e.g. RSBSA, SEC, DTI, CDA (as applicable)', $required_documents)) ? 'checked' : ''; ?>> Certification of Registration and other permits e.g. RSBSA, SEC, DTI, CDA (as applicable)
				</div>
				<?php
				// Decode the JSON string to an array
				$additional_requirements = json_decode($meta['additional_documents'], true);
				?>
				<!-- Additional Documents -->
				<div class="form-group">
					<label>Additional Requirements</label><br>
					<input type="checkbox" name="additional_documents[]" value="Quality Management System/Internal Control System" <?php echo (isset($additional_requirements) && in_array("Quality Management System/Internal Control System", $additional_requirements)) ? 'checked' : ''; ?>> Quality Management System/Internal Control System<br>
					<input type="checkbox" name="additional_documents[]" value="Procedure for accreditation of farmers/growers" <?php echo (isset($additional_requirements) && in_array("Procedure for accreditation of farmers/growers", $additional_requirements)) ? 'checked' : ''; ?>> Procedure for accreditation of farmers/growers<br>
					<input type="checkbox" name="additional_documents[]" value="Manual of Procedure for outgrowership scheme" <?php echo (isset($additional_requirements) && in_array("Manual of Procedure for outgrowership scheme", $additional_requirements)) ? 'checked' : ''; ?>> Manual of Procedure for outgrowership scheme
				</div>

			</form>
		</div>
	</div>
	<div class="card-footer">
		<div class="col-md-12">
			<div class="row" style="gap: 10px;">
				<button class="btn btn-sm btn-primary" form="manage-user">Update</button>
				<form id="generate-pdf-form" action="user/generate_pdf.php" method="POST" target="_blank">
					<input type="hidden" name="id" value="<?php echo $_settings->userdata('id') ?>">
					<button type="submit" class="btn btn-sm btn-warning" style="background-color: red; color: white;">Generate PDF</button>
				</form>
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