
<?php echo form_open($this->uri->uri_string()); ?>
	<div class=''>

		<div class="form-group">
			<label class="control-label">First Name</label>
			<input type="text" class="form-control boxed" name="first_name" value='<?php echo $first_name;?>' >
		</div>
		<div class="form-group">
			<label class="control-label">Last Name</label>
			<input type="text" class="form-control boxed" name="last_name" value='<?php echo $last_name;?>'>
		</div>
		<div class="form-group">
			<label class="control-label">Phone Number</label>
			<input type="text" class="form-control boxed" name="proprietor_phone" value='<?php echo $proprietor_phone;?>' >
		</div>
		<div class="form-group">
			<label class="control-label">National ID</label>
			<input type="text" class="form-control boxed" name="national_id" value='<?php echo $national_id;?>'>
		</div>
		<div class="form-group">
			<label class="control-label">Business Reg ID</label>
			<input type="text" class="form-control boxed" name="business_reg_id" value='<?php echo $business_reg_id;?>'>
		</div>
	</div>
	<div class=''>
		<?php echo anchor("/admin/Proprietors/", "Close", "class='btn btn-info mt-2 mb-2 '")?>
		<button type="submit" class="btn btn-info">Save</button>
	</div>
<?php echo form_close(); ?>

