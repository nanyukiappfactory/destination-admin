<!-- Button trigger modal -->
<div class="title-block">
    <button type="button" class="btn btn-sm mt-2 mb-2 btn-outline-secondary" data-toggle="modal" data-target="#exampleModal">Add Business Type</button>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Business Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open(base_url()."business-types/add-business-types"); ?>
        <div class="modal-body">
            <div class="form-group">
                <label class="control-label">Name</label>
                <input type="text" class="form-control boxed" name="business_type_name">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
      <?php echo form_close();?>
    </div>
  </div>
</div>