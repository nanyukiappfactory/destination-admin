<?php echo form_open($this->uri->uri_string()); ?>
	<div class=''>

		<div class="form-group">
			<label class="control-label">Business Type Name</label>
			<input type="text" class="form-control boxed" name="business_type_name" value='<?php echo $business_type_name;?>' >
		</div>
	</div>
	<div class=''>
		<?php echo anchor("/admin/business_types/", "Close", "class='btn btn-info mt-2 mb-2 '")?>
		<button type="submit" class="btn btn-info">Save</button>
	</div>
<?php echo form_close(); ?>

