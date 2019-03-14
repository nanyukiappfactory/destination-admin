
      <?php echo form_open(base_url()."activities/add-activity"); ?>
        <div class="modal-body">
            <div class="form-group">
                <label class="control-label">Name</label>
                <input type="text" class="form-control boxed" name="activity_name">
               
                <label class="control-label">Date</label>
                <input type="date" class="form-control boxed" data-date="" data-date-format="DD MMMM YYYY" name="activity_date">
                
                <label class="control-label">Longitude</label>
                <input type="text" class="form-control boxed" name="activity_longitude"> 
                
                <label class="control-label">Latitude</label>
                <input type="text" class="form-control boxed" name="activity_latitude"> 
                
                <label class="control-label">Email</label>
                <input type="text" class="form-control boxed" name="activity_email"> 
                
                <label class="control-label">Phone</label>
                <input type="text" class="form-control boxed" name="activity_phone">  

                <label class="control-label">Description</label>
                <textarea class="textarea_editor form-control border-radius-0" name="activity_description" placeholder="Enter text ..."></textarea>
            </div>
        </div>    
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success">Save</button>
        </div>
      <?php echo form_close();?>
    </div>
  </div>
</div>