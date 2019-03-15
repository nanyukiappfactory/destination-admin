<?php echo anchor("/admin/activities/add_activity", "Add Activity", "class ='btn btn-sm mt-2 mb-2 btn-outline-secondary'") ?>

<div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
          <thead>
          <tr>
            <th>No.</th>
            <th>Name<?php
            if($order_method == "ASC")
            {?>
              <a href="<?php echo base_url();?>activities/all-activities/activity.activity_name/DESC" style="color:#000"><i class="far fa-arrow-alt-circle-down"></i></a>
            <?php }
            else{?>
              <a href="<?php echo base_url();?>activities/all-activities/activity.activity_name/ASC" style="color:#000"><i class="far fa-arrow-alt-circle-up"></i></a>
            <?php }?></th>
            <th>Date<?php
                if($order_method == "ASC"){?>
                    <a href="<?php echo base_url();?>activities/all-activities/activity.activity_date/DESC" style="color:#000"><i class="far fa-arrow-alt-circle-down"></i></a>
                <?php }
                else{ ?>
                    <a href="<?php echo base_url();?>activities/all-activities/activity.activity_date/ASC" style="color:#000"><i class="far fa-arrow-alt-circle-up"></i></a>
                <?php }?>
            </th>
            <th>Status<?php
            if($order_method == "ASC"){?>
                <a href="<?php echo base_url();?>activities/all-activities/activity.activity_status/DESC" style="color:#000"><i class="far fa-arrow-alt-circle-down"></i></a>
            <?php }
            else{ ?>
                <a href="<?php echo base_url();?>activities/all-activities/activity.activity_status/ASC" style="color:#000"><i class="far fa-arrow-alt-circle-up"></i></a>
            <?php }?>
            </th>
            <th>Longitude</th>
            <th>Latitude</th>
            <th>Phone<?php
            if($order_method == "ASC"){?>
                <a href="<?php echo base_url();?>activities/all-activities/activity.activity_phone/DESC" style="color:#000"><i class="far fa-arrow-alt-circle-down"></i></a>
            <?php }
            else{ ?>
                <a href="<?php echo base_url();?>activities/all-activities/activity.activity_phone/ASC" style="color:#000"><i class="far fa-arrow-alt-circle-up"></i></a>
            <?php }?></th>
            <th>Email<?php
            if($order_method == "ASC"){?>
                <a href="<?php echo base_url();?>activities/all-activities/activity.activity_email/DESC" style="color:#000"><i class="far fa-arrow-alt-circle-down"></i></a>
            <?php }
            else{ ?>
                <a href="<?php echo base_url();?>activities/all-activities/activity.activity_email/ASC" style="color:#000"><i class="far fa-arrow-alt-circle-up"></i></a>
            <?php }?></th>
            <th>Actions</th>
          </tr>
          </thead>
          <tbody>

         <?php
          if (is_array($activities->result())) {
              $count = $counter;
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
        <div class="p-3" id="pagination-links">
									<?php if (isset($links)) { ?>
										<?php echo $links ?>
									<?php } ?>
								</div>
      </div>
    </main>
    </div>
</div>
