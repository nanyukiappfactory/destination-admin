<!-- Modal -->
<div class="modal fade" id="editModal<?php echo $business_type_page->business_type_id;?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">business_type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open(base_url()."business-types/edit-business-types/". $business_type_page->business_type_id); ?>
      <div class="modal-body">
        <div class="form-group">
            <?php
                $success = $this->session->flashdata('success');
                $error = $this->session->flashdata('error');

                if($success){?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $success;?>
                    </div>
                <?php }
                if($error){?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error;?>
                    </div>
            <?php }?>
            <label class="control-label">Name</label>
            <input type="text" class="form-control boxed" name="business_type_name" value="<?php echo $business_type_page->business_type_name;?>">
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