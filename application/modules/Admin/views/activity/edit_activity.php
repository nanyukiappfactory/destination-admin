<?php 
$attributes = array( 'autocomplete' => 'off'); 
echo form_open($this->uri->uri_string(), $attributes); ?>
<div class="modal-body">
	<div class="form-group">
		<label class="control-label">Name</label>
		<input type="text" class="form-control boxed" name="activity_name"
			value='<?php echo $activity_name;?>'>
		<label class="control-label">Date</label>
		<input type="text" class="form-control" id="datetimepicker" name="activity_date"
			value='<?php echo $activity_date;?>'>
		<label class="control-label boxed">Longitude</label>
		<input type="text" class="form-control boxed" name="activity_longitude"
			value='<?php echo $activity_longitude?>'>
		<label class="control-label">Latitude</label>
		<input type="text" class="form-control boxed" name="activity_latitude"
			value='<?php echo $activity_latitude;?>'>
		<label class="control-label">Email</label>
		<input type="text" class="form-control boxed" name="activity_email"
			value='<?php echo $activity_email;?>'>
		<label class="control-label">Phone</label>
		<input type="text" class="form-control boxed" name="activity_phone"
			value='<?php echo $activity_phone;?>'>
		<label class="control-label">Description</label>
		<textarea rows="5" class="textarea_editor form-control border-radius-0"
			name="activity_description"><?php echo $activity_description?></textarea>
	</div>
</div>
<div class=''>
	<?php echo anchor("/admin/Activities/", "Close", "class='btn btn-info mt-2 mb-2 '") ?>
	<button type="submit" class="btn btn-info">Save</button>
</div>
<?php echo form_close(); ?>
