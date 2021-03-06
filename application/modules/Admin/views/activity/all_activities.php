<?php
if ($order_method == "ASC") {
    $new_order_method = "DESC";
    $order_method_icon = '<i class="far fa-arrow-alt-circle-down"></i>';
}
if ($order_method == "DESC") {
    $new_order_method = "ASC";
    $order_method_icon = '<i class="far fa-arrow-alt-circle-up"></i>';
}

$activity_delete_route = 'activities/delete-activity';
$link_delete = "btn btn-xs btn-oval btn-danger";
$onclick_delete = "return confirm('Are you sure you want to Delete?')";
$i_delete = 'fa fa-trash';
$search_title = $this->session->userdata('search_activity_title');

$activity_edit_route = 'admin/activities/edit_activity';
$tr_activities = "";
if ($activities->num_rows() > 0) {
    $count = $counter;
    foreach ($activities->result() as $activity) {
        $v_data['activity_modal'] = $activity;
        $count++;
		if ($activity->activity_status == 1) {
			$badge_class = 'badge badge-pill badge-success';
			$status = 'Active';
			$status_active_class = 'btn btn-xs btn-warning';
			$base_url = base_url();
			$activity_route = 'activities/deactivate-activity';
			$id_param = $activity->activity_id;
			$status_param = $activity->activity_status;
			$link_status = 'btn btn-xs btn-warning';
			$onclick = "return confirm('Are you sure you want to Deactivate?')";
			$i_status = 'fas fa-thumbs-down';
		} else {
			$badge_class = 'badge badge-pill badge-warning';
			$status = 'Inactive';
			$base_url = base_url();
			$activity_route = 'activities/activate-activity';
			$id_param = $activity->activity_id;
			$status_param = $activity->activity_status;
			$link_status = 'btn btn-xs btn-success';
			$onclick = "return confirm('Are you sure you want to Activate?')";
			$i_status = 'fas fa-thumbs-up';

		}
		$edit_url = "/activities/edit-activity/$activity->activity_id";
        $edit_btn = anchor($edit_url , "<i class='fa fa-edit'></i>", "class='btn btn-xs btn-oval btn-primary'");
        $tr_activities .= '<tr>
		<td>' . $count . '</td>
		<td>' . $activity->activity_name . '</td>
		<td>' . $activity->activity_date . '</td>
		<td>
			<span class="' . $badge_class . '">' . $status . '</span>
		</td>
		<td>' . $activity->activity_longitude . '</td>
		<td>' . $activity->activity_latitude . '</td>
		<td>' . $activity->activity_phone . '</td>
		<td>' . $activity->activity_email . '</td>
		<td>
		<button type="button" class="btn btn-xs btn-oval btn-info" data-toggle="modal" data-target="#viewModal' . $activity->activity_id . '"><i class="fa fa-eye"></i></button>' .
		$edit_btn . 
		'<a href="' . $base_url . $activity_route . '/' . $id_param . '/' . $status_param . '" class="' . $link_status . '" onclick="' . $onclick . '"><i class="' . $i_status . '"></i></a>
		<a href="'. $base_url . $activity_delete_route.'/'. $id_param.'" class="'. $link_delete .'" onclick="'. $onclick_delete .'"><i class="'. $i_delete.'"></i></a>
		</td>
	</tr>';
        $this->load->view('activity/view_activity', $v_data);
        // $this->load->view('activity/edit_activity', $v_data);
    }
}
?>

<div>
<?php echo anchor("/admin/activities/add_activity", "Add Activity", "class ='btn btn-xs mt-2 mb-2 btn-outline-secondary'") ?>
</div>

<?php
if(!empty($search_title))
{
	?>
	<div class="alert alert-info">
		<p>Filtered by: <?php echo $search_title?></p>
	</div>
	<?php
}
?>
<div class="my-2">
    <?php
echo form_open("/admin/activities/search_activity", array("class" => "form-inline my-2 my-lg-0")); ?>
		<input type="radio" name="activity_status" value="active" class ="ml-2" autocomplete="off"> Active
		<input type="radio" name="activity_status" value="inactive" class ="ml-2" autocomplete="off"> Inactive
		<input type="text" name="activity_email" placeholder="search email" class ="ml-1" autocomplete="off"/>
		<input type="text" name="activity_name" placeholder="search name" class ="ml-1" autocomplete="off"/>
		<input type="text" name="activity_date" id="datetimepicker" placeholder="search date" class ="ml-1" autocomplete="off"/>
		<input type="text" name="activity_phone" placeholder="search phone" class ="ml-1" autocomplete="off"/>
		<button class="btn btn-outline-success my-2 my-sm-0 ml-sm-1" type="submit"><i class="fas fa-search"></i></button>
		<?php if ($this->session->userdata('search_activity_params')) {?>
		<a href="<?php echo base_url(); ?>activities/close-search" class="btn btn-outline-danger my-2 my-sm-0 ml-sm-2"><i class="fas fa-times"></i></a>
		<?php }?>
	<?php echo form_close(); ?>
</div>
<div class="table-responsive">
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>No.</th>
				<th>
				<a href="<?php echo base_url(); ?>activities/all-activities/activity.activity_name/<?php echo $new_order_method; ?>/<?php echo $page; ?>" style="color:#000">Name</a></th>
				<th>
				<a href="<?php echo base_url(); ?>activities/all-activities/activity.activity_date/<?php echo $new_order_method; ?>" style="color:#000">Date</a></th>							      									   					</th>
				<th>
				<a href="<?php echo base_url(); ?>activities/all-activities/activity.activity_status/<?php echo $new_order_method; ?>" style="color:#000">Status</a></th>
				<th>Longitude</th>
				<th>Latitude</th>
				<th><a href="<?php echo base_url(); ?>activities/all-activities/activity.activity_phone/<?php echo $new_order_method; ?>" style="color:#000">Phone</a></th>
				<th><a href="<?php echo base_url(); ?>activities/all-activities/activity.activity_email/<?php echo $new_order_method; ?>" style="color:#000">Email</a></th>
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
		<?php if (isset($links)) {?>
		<?php echo $links ?>
		<?php }?>
	</div>
</div>
</main>
</div>
</div>