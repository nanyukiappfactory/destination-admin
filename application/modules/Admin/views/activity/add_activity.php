<?php 
$attributes = array( 'autocomplete' => 'off'); 
echo form_open_multipart(base_url()."activities/add-activity", $attributes); 
?>
<div class="">
	<div class="form-group">
		<label class="control-label">Name</label>
		<input type="text" class="form-control boxed" name="activity_name"
			value="<?php echo set_value('activity_name')?>" />
	</div>
	<div class="form-group">
		<label for="text">Date</label>
		<input type="text" class="form-control boxed" id="datetimepicker" name="activity_date"
			value="<?php echo set_value('activity_date')?>">
	</div>
	<div class="form-group">
		<label class="control-label">Longitude</label>
		<input type="text" class="form-control boxed" name="activity_longitude"
			value="<?php echo set_value('activity_longitude')?>">
	</div>
	<div class="form-group">
		<label class="control-label">Latitude</label>
		<input type="text" class="form-control boxed" name="activity_latitude"
			value="<?php echo set_value('activity_latitude')?>">
	</div>
	<div class="form-group">
		<label class="control-label">Email</label>
		<input type="text" class="form-control boxed" name="activity_email"
			value="<?php echo set_value('activity_email')?>">
	</div>
	<div class="form-group">
		<label class="control-label">Phone</label>
		<input type="text" class="form-control boxed" name="activity_phone"
			value="<?php echo set_value('activity_phone')?>">
	</div>
	<div class="form-group">
	</div>
	<div class="form-group my-3">
		<label class="control-label">Activity Image</label>
		<input type="file" name="activity_image" id="activity_image" size="20" />
	</div>
	<div class="form-group">
		<label class="control-label">Description</label>
		<textarea rows="5" class="textarea_editor form-control border-radius-0" name="activity_description"
			placeholder="Enter text ..."><?php echo set_value('activity_description')?></textarea>
	</div>
	<div class="">
		<?php echo anchor("/admin/activities/", "Close", "class ='btn btn-info'")?>
		<button type="submit" class="btn btn-success">Save</button>
	</div>
	<?php echo form_close();?>

