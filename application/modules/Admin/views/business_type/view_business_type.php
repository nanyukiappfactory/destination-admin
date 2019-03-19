<!-- Modal -->
<div class="modal fade" id="viewPage<?php echo $business_type_page->business_type_id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Business Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="">
        <div class="form-group">
            <label class="control-label">Name</label>
            <input type="text" class="form-control boxed" name="business_type_name" value="<?php echo $business_type_page->business_type_name;?>" disabled>
            
            <label class="control-label">Status</label>
            <input type="text" class="form-control boxed" name="business_type_status" value="<?php echo $business_type_page->business_type_status == 0 ? "Inactive" : "Active";?>" disabled> 
            
            <label class="control-label">Created On</label>
            <input type="text" class="form-control boxed" name="business_type_created_on" value="<?php echo date('D, M j, Y H:i:s', strtotime($business_type_page->created_on));?>" disabled> 
            
            <label class="control-label">Created By</label>
            <input type="text" class="form-control boxed" name="business_type_created_by" value="<?php echo $business_type_page->created_by == 0 ? "Admin" : "Admin";?>" disabled> 
            
            <label class="control-label">Last Modified</label>
            <input type="text" class="form-control boxed" name="business_type_modified_on" value="<?php echo date('D, M j, Y H:i:s', strtotime($business_type_page->modified_on));?>" disabled> 
            
            <label class="control-label">Modified By</label>
            <input type="text" class="form-control boxed" name="business_type_modified_by" value="<?php echo $business_type_page->modified_by == 0 ? "Admin" : "Admin";?>" disabled>  
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>