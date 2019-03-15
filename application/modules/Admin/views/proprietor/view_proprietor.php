<!-- Modal -->
<div class="modal fade" id="exampleModalLabel<?php echo $prop->proprietor_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Proprietor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-body">

            <div class="form-group">
                <label class="control-label">First Name</label>
                <input type="text" class="form-control boxed" name="first_name" value='<?php echo $prop->first_name; ?>' disabled>
            </div>
            <div class="form-group">
                <label class="control-label">Last Name</label>
                <input type="text" class="form-control boxed" name="last_name" value='<?php echo $prop->last_name; ?>' disabled>
            </div>
            
            <div class="form-group">
                <label class="control-label">Phone Number</label>
                <input type="text" class="form-control boxed" name="proprietor_phone" value='<?php echo $prop->proprietor_phone; ?>' disabled>
            </div>
            
            <div class="form-group">
                <label class="control-label">National ID</label>
                <input type="text" class="form-control boxed" name="national_id" value='<?php echo $prop->national_id; ?>' disabled>
            </div>
            <div class="form-group">
                <label class="control-label">Business Reg ID</label>
                <input type="text" class="form-control boxed" name="business_reg_id" value='<?php echo $prop->business_reg_id; ?>' disabled>
            </div>
            <div class="form-group">
            <label class="control-label">Status</label>
            <?php
            if ($prop->proprietor_status == 1) {?>
              <span class="badge badge-pill badge-success">Active</span>
            <?php } else {?>
                <span class="badge badge-pill badge-warning">Inactive</span>
            <?php }?>
            </div>
            <div class="form-group">
                <label class="control-label">Created By</label>
                <input type="text" class="form-control boxed" name="last_name" value='<?php echo $prop->created_by; ?>' disabled>
            </div>
            <div class="form-group">
                <label class="control-label">Created On</label>
                <input type="text" class="form-control boxed" name="national_id" value='<?php echo $prop->created_on; ?>' disabled>
            </div>
            <div class="form-group">
                <label class="control-label">Modified By</label>
                <input type="text" class="form-control boxed" value='<?php echo $prop->modified_by; ?>' disabled>
            </div>
            <div class="form-group">
                <label class="control-label">Last Modified</label>
                <input type="text" class="form-control boxed" value='<?php echo $prop->modified_on; ?>' disabled>
            </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>