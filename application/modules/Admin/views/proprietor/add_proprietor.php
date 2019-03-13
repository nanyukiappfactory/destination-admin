<!-- Button trigger modal -->
<div class="title-block">
	<button type="button" class="btn btn-sm mt-2 mb-2 btn-outline-secondary" data-toggle="modal" data-target="#addProprietorModal">Add
		Proprietor</button>
</div>
<!-- Modal -->
<div class="modal fade" id="addProprietorModal" tabindex="-1" role="dialog" aria-labelledby="addProprietorModalLabel"
 aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="addProprietorModalLabel">Add Proprietor</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php echo form_open(base_url() . 'proprietors/add-proprietors'); ?>
			<div class="modal-body">

				<div class="form-group">
					<label class="control-label">First Name</label>
					<input type="text" class="form-control boxed" name="first_name">
				</div>
				<div class="form-group">
					<label class="control-label">Last Name</label>
					<input type="text" class="form-control boxed" name="last_name">
				</div>
				<div class="form-group">
					<label class="control-label">Phone Number</label>
					<input type="text" class="form-control boxed" name="proprietor_phone">
				</div>
				<div class="form-group">
					<label class="control-label">National ID</label>
					<input type="text" class="form-control boxed" name="national_id">
				</div>
				<div class="form-group">
					<label class="control-label">Business Reg ID</label>
					<input type="text" class="form-control boxed" name="business_reg_id">
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
