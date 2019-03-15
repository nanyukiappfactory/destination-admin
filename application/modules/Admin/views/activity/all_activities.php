<?php echo anchor("/admin/activities/add_activity", "Add Activity", "class ='btn btn-sm mt-2 mb-2 btn-outline-secondary'") ?>

<div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
          <thead>
          <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Date</th>
            <th>Status</th>
            <th>Longitude</th>
            <th>Latitude</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody>

         <?php
          if (is_array($activities->result())) {
              $count = 0;
              foreach ($activities->result() as $activity) {
                  $v_data['activity_modal'] = $activity;
                  $count++;
                  ?>
             <tr>
                <td><?php echo $count; ?></td>
                <td><?php echo $activity->activity_name; ?></td>
                <td><?php echo $activity->activity_date; ?></td>

                <td>
                    <?php
                if ($activity->activity_status == 1) {?>
                            <span class="badge badge-pill badge-success">Active</span>
                        <?php } else {?>
                            <span class="badge badge-pill badge-warning">Inactive</span>
                        <?php }?>
                </td>
                <td><?php echo $activity->activity_longitude; ?></td>
                <td><?php echo $activity->activity_latitude; ?></td>
                <td><?php echo $activity->activity_phone; ?></td>
                <td><?php echo $activity->activity_email; ?></td>
                <td>
                  <button type="button" class="btn btn-sm btn-oval btn-info" data-toggle="modal" data-target="#exampleModal<?php echo $activity->activity_id;?>"><i class="fa fa-eye"></i></button> 
                  <?php $this->load->view('activity/view_activity', $v_data)?>
                </td>
            </tr>
          <?php }
              }?>
          </tbody>
        </table>
      </div>
    </main>
    </div>
</div>
