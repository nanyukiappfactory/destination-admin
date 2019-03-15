<!-- Modal -->
<div class="modal fade" id="exampleModal<?php echo $activity_modal->activity_id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Activity</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="">
        <div class="form-group">
            <label class="control-label">Name</label>
            <input type="text" class="form-control boxed" name="activity_name" value="<?php echo $activity_modal->activity_name;?>" disabled>
            
            <label class="control-label">Description</label>
            <input type="text" class="form-control boxed" name="activity_description" value="<?php echo $activity_modal->activity_description;?>" disabled> 
            
            <label class="control-label">Date</label>
            <input type="text" class="form-control boxed" data-date="" data-date-format="DD MMMM YYYY" value="<?php $originalDate = $activity_modal->activity_date;
            $newDate = date("Y-m-d", strtotime($originalDate)); echo $newDate;?>" name="activity_date" disabled>
            
            <label class="control-label">Longitude</label>
            <input type="text" class="form-control boxed" name="activity_longitude" value="<?php echo $activity_modal->activity_longitude;?>" disabled> 
            
            <label class="control-label">Latitude</label>
            <input type="text" class="form-control boxed" name="activity_latitude" value="<?php echo $activity_modal->activity_latitude;?>" disabled> 
            
            <label class="control-label">Email</label>
            <input type="text" class="form-control boxed" name="activity_email" value="<?php echo $activity_modal->activity_email;?>" disabled> 

            <label class="control-label">Status</label>
            <input type="text" class="form-control boxed" name="activity_email" value="<?php echo $activity_modal->activity_status == 0 ? "Inactive" : "Active";?>" disabled> 
            
            <label class="control-label">Created On</label>
            <input type="text" class="form-control boxed" name="activity_created_on" value="<?php echo $activity_modal->created_on;?>" disabled> 
            
            <label class="control-label">Created By</label>
            <input type="text" class="form-control boxed" name="activity_created_by" value="<?php echo $activity_modal->created_by == 0 ? "Admin" : "Admin";?>" disabled> 
            
            <label class="control-label">Last Modified</label>
            <input type="text" class="form-control boxed" name="activity_modified_on" value="<?php echo $activity_modal->modified_on;?>" disabled> 
            
            <label class="control-label">Modified By</label>
            <input type="text" class="form-control boxed" name="activity_modified_by" value="<?php echo $activity_modal->modified_by == 0 ? "Admin" : "Admin";?>" disabled>  
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>