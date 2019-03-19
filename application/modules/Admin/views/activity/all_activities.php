<?php
if($order_method == "ASC")
{
	$new_order_method = "DESC";
	$order_method_icon = '<i class="far fa-arrow-alt-circle-down"></i>';
}
if($order_method == "DESC")
{
	$new_order_method = "ASC";
	$order_method_icon = '<i class="far fa-arrow-alt-circle-up"></i>';
}
?>

<?php echo anchor("/admin/activities/add_activity", "Add Activity", "class ='btn btn-sm mt-2 mb-2 btn-outline-secondary'") ?>
<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>No.</th>
				<th>Name
				<a href="<?php echo base_url();?>activities/all-activities/activity.activity_name/<?php echo $new_order_method;?>" style="color:#000"><?php echo $order_method_icon;?></a></th>							      			
				<th>Date				              
				<a href="<?php echo base_url();?>activities/all-activities/activity.activity_date/<?php echo $new_order_method;?>" style="color:#000"><?php echo $order_method_icon;?></a></th>							      									   					</th>
				<th>Status	
				<a href="<?php echo base_url();?>activities/all-activities/activity.activity_status/<?php echo $new_order_method;?>" style="color:#000"><?php echo $order_method_icon;?></a></th>
				<th>Longitude</th>
				<th>Latitude</th>
				<th>Phone<a href="<?php echo base_url();?>activities/all-activities/activity.activity_status/<?php echo $new_order_method;?>" style="color:#000"><?php echo $order_method_icon;?></a></th>									
				<th>Email<a href="<?php echo base_url();?>activities/all-activities/activity.activity_status/<?php echo $new_order_method;?>" style="color:#000"><?php echo $order_method_icon;?></a></th>
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
				<td>
					<?php echo $count; ?>
				</td>
				<td>
					<?php echo $activity->activity_name; ?>
				</td>
				<td>
					<?php echo $activity->activity_date; ?>
				</td>

				<td>
					<?php
                        if ($activity->activity_status == 1) {?>
					<span class="badge badge-pill badge-success">Active</span>
					<?php } else {?>
					<span class="badge badge-pill badge-warning">Inactive</span>
					<?php }?>
				</td>
				<td>
					<?php echo $activity->activity_longitude; ?>
				</td>
				<td>
					<?php echo $activity->activity_latitude; ?>
				</td>
				<td>
					<?php echo $activity->activity_phone; ?>
				</td>
				<td>
					<?php echo $activity->activity_email; ?>
				</td>
				<td>
					<button type="button" class="btn btn-sm btn-oval btn-info" data-toggle="modal" data-target="#exampleModal<?php echo $activity->activity_id;?>"><i
						 class="fa fa-eye"></i></button>
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
