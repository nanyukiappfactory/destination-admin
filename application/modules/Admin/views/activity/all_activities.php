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
$tr_activities = "";

if($activities->num_rows() > 0)
{
  $count = $counter;
  foreach($activities->result() as $activity)
  {
	$v_data['activity_modal'] = $activity;
	$count++;

	if($activity->activity_status == 1)
	{
		$badge_class = 'badge badge-pill badge-success';
		$status = 'Active';
	}
	else
	{
		$badge_class = 'badge badge-pill badge-warning';
		$status = 'Inactive';
	}

	$tr_activities .= '<tr>
		<td>' . $count . '</td>
		<td>' . $activity->activity_name . '</td>
		<td>' . $activity->activity_date . '</td>
		<td>
			<span class="' . $badge_class . '">'. $status . '</span>
		</td>
		<td>' . $activity->activity_longitude . '</td>
		<td>' . $activity->activity_latitude . '</td>
		<td>' . $activity->activity_phone . '</td>
		<td>' . $activity->activity_email . '</td>
		<td>
		<button type="button" class="btn btn-sm btn-oval btn-info" data-toggle="modal" data-target="#exampleModal' . $activity->activity_id . '"><i class="fa fa-eye"></i></button>
		</td>
	</tr>';

  	$this->load->view('activity/view_activity', $v_data);
  }
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
         echo $tr_activities;
        ?>
          </tbody>          
        </table>
       </div>
			
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
