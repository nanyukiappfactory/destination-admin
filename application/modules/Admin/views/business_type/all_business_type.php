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

$check_active =  $this->session->userdata('checked_status') == 'active' ? 'checked' : '';
$check_inactive =  $this->session->userdata('checked_status') == 'inactive' ? 'checked' : '';
$search_business_type_name = $this->session->userdata('search_business_type_name');

$tr_business_types = "";

if($business_types->num_rows() > 0)
{
	$count = $counter;
	foreach($business_types->result() as $business_type)
	{
		$v_data['business_type_page'] = $business_type;
		$count++;

		if($business_type->business_type_status == 1)
		{
			$badge_class = 'badge badge-pill badge-success';
			$status = 'Active';
			$status_active_class = 'btn btn-sm btn-warning';
			$base_url = base_url();
			$business_type_route = 'business-types/deactivate-business-types';
			$id_param = $business_type->business_type_id .'/'; 
			$status_param = $business_type->business_type_status;
			$link_status = 'btn btn-sm btn-success';
			$onclick = 'return confirm("Are you sure you want to Deactivate")';
			$i_status = 'fas fa-thumbs-down';
		}
		else
		{
			$badge_class = 'badge badge-pill badge-warning';
			$status = 'Inactive';
			$base_url = base_url();
			$business_type_route = 'business-types/activate-business-types';
			$id_param = $business_type->business_type_id .'/'; 
			$status_param = $business_type->business_type_status;
			$link_status = 'btn btn-sm btn-warning';
			$onclick = 'return confirm("Are you sure you want to Activate")';
			$i_status = 'fas fa-thumbs-up';
		}

		$tr_business_types .= '<tr>
			<td>' . $count . '</td>
			<td>' . $business_type->business_type_name . '</td>
			<td>
				<span class="' . $badge_class . '">'. $status . '</span>
			</td>
			<td>
				<button type="button" class="btn btn-sm btn-oval btn-info" data-toggle="modal" data-target="#viewModal' . $business_type->business_type_id . '"><i class="fa fa-eye"></i></button>
			</td>
			<td>
				<button type="button" class="btn btn-sm btn-oval btn-primary" data-toggle="modal" data-target="#editModal' . $business_type->business_type_id . '"><i class="fa fa-edit"></i></button>
			</td>
			<td>
				<a href="'. $base_url . $business_type_route.'/'. $id_param. $status_param.'" class="'. $link_status .'" onclick="'. $onclick .'"><i class="'. $i_status.'"></i></a>
			</td>
		</tr>';

		$this->load->view('business_type/view_business_type', $v_data);
		$this->load->view('business_type/edit_business_type', $v_data);
	}
}

echo anchor("/admin/Business_types/add_business_type", "Add Business Type", "class ='btn btn-sm mt-2 mb-2 btn-outline-secondary'")?>

<div>
    <?php
    echo form_open("/admin/business_types/search_business_type", array("class" => "form-inline my-2 my-lg-0"));?>
		<input type="radio" name="status" value="active" class ="m-2" <?php echo $check_active;?> > Active
		<input type="radio" name="status" value="inactive" class ="m-2" <?php echo $check_inactive;?> > Inactive
		<input type="text" name="business_type_name" value="<?php echo $search_business_type_name;?>" Placeholder="Search Business Type" />
		
		<button class="btn btn-outline-success my-2 my-sm-0 ml-sm-2" type="submit"><i class="fas fa-search"></i></button>
		<?php if($this->session->userdata('search_business_type_params')){?>
		<a href="<?php echo base_url();?>business-types/close-search" class="btn btn-outline-danger my-2 my-sm-0 ml-sm-2"><i class="fas fa-times"></i></a>
		<?php }?>
	<?php echo  form_close();?>
</div>

<div class="table-responsive">
        <table class="table table-striped table-sm">
			<thead>
				<tr>
					<th>No</th>
					<th>Business Type Name
							<a href="<?php echo base_url();?>business-types/all-business-types/business_type.business_type_name/<?php echo $new_order_method;?>" style="color:#000"><?php echo $order_method_icon;?></a></th>
					<th>Business Status
							<a href="<?php echo base_url();?>business-types/all-business-types/business_type.business_type_status/<?php echo $new_order_method;?>" style="color:#000"><?php echo $order_method_icon;?></a>
					</th>
				<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
					echo $tr_business_types;
				?>
			</tbody>          
        </table>
      	</div>
		<div class="">
			<?php if (isset($links)) { ?>
				<?php echo $links; ?>
			<?php } ?>
		</div>
    </main>
  </div>
</div>
    