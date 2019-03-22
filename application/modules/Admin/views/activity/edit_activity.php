<!-- Modal -->
<div>

<div class="modal fade" id="editModal<?php echo $activity_modal->activity_id;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Activity</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open(base_url()."activities/edit-activity/". $activity_modal->activity_id); ?>
      <div class="modal-body">
        <div class="form-group">
          <label class="control-label">Name</label>
          <input type="text" class="form-control boxed" name="activity_name" value="<?php echo $activity_modal->activity_name;?>">   
          <label class="control-label">Date</label>
          <input type="text" class="form-control" id="datetimepicker" name="activity_date" value="<?php echo date($activity_modal->activity_date); ?>" >
          <label class="control-label boxed">Longitude</label>
          <input type="text" class="form-control boxed" name="activity_longitude" value="<?php echo $activity_modal->activity_longitude;?>">    
          <label class="control-label">Latitude</label>
          <input type="text" class="form-control boxed" name="activity_latitude" value="<?php echo $activity_modal->activity_latitude;?>">          
          <label class="control-label">Email</label>
          <input type="text" class="form-control boxed" name="activity_email" value="<?php echo $activity_modal->activity_email;?>">           
          <label class="control-label">Phone</label>
          <input type="text" class="form-control boxed" name="activity_phone" value="<?php echo $activity_modal->activity_phone;?>"> 
          <label class="control-label">Description</label>
          <textarea rows="5" class="textarea_editor form-control border-radius-0" name="activity_description"><?php echo strip_tags($activity_modal->activity_description);?></textarea>  
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      <?php echo form_close();?>
    </div>
  </div>
</div>
</div>