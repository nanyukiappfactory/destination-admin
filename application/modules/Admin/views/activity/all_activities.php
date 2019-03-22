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
$check_active =  $this->session->userdata('search_activity_status') == 'active' ? 'checked' : '';
$check_inactive =  $this->session->userdata('search_activity_status') == 'inactive' ? 'checked' : '';
$search_email = $this->session->userdata('search_activity_email');
$search_name = $this->session->userdata('search_activity_name');
$search_date = $this->session->userdata('search_activity_date');
$search_phone = $this->session->userdata('search_activity_phone');
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
		<button type="button" class="btn btn-sm btn-oval btn-primary" data-toggle="modal" data-target="#editModal' . $activity->activity_id . '"><i class="fa fa-edit"></i></button>
		</td>
	</tr>';

		$this->load->view('activity/view_activity', $v_data);
		$this->load->view('activity/edit_activity', $v_data);
  }
}
?>

<div>
<?php echo anchor("/admin/activities/add_activity", "Add Activity", "class ='btn btn-sm mt-2 mb-2 btn-outline-secondary'") ?>
</div>

<div class="my-2">
    <?php
    echo form_open("/admin/activities/search_activity", array("class" => "form-inline my-2 my-lg-0"));?>
		<input type="radio" name="activity_status" value="active" class ="ml-2" <?php echo $check_active;?> > Active
		<input type="radio" name="activity_status" value="inactive" class ="ml-2" <?php echo $check_inactive;?> > Inactive
		<input type="text" name="activity_email" value="<?php echo $search_email;?>" Placeholder="search email" class ="ml-1" />
		<input type="text" name="activity_name" value="<?php echo $search_name;?>"Placeholder="search name" class ="ml-1"/>
		<input type="text" name="activity_date" value="<?php echo $search_date;?>"Placeholder="search date" class ="ml-1"/>
		<input type="text" name="activity_phone" value="<?php echo $search_phone;?>"Placeholder="search phone" class ="ml-1"/>
		<button class="btn btn-outline-success my-2 my-sm-0 ml-sm-1" type="submit"><i class="fas fa-search"></i></button>
		<?php if($this->session->userdata('search_activity_params')){?>
		<a href="<?php echo base_url();?>activities/close-search" class="btn btn-outline-danger my-2 my-sm-0 ml-sm-2"><i class="fas fa-times"></i></a>
		<?php }?>
	<?php echo  form_close();?>
</div>
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
