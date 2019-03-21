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
	$search_name = $this->session->userdata('search_business_type_name');
	$str_proprietor = "";
	if (is_array($proprietors->result())) 
		{
			$count = $counter;
			foreach ($proprietors->result() as $proprietor) 
			{
				$v_data['prop'] =  $proprietor;
				$count++;
		if($proprietor->proprietor_status == 1)
			{
				$badge_class="badge badge-pill badge-success";
				$status = "Active";
			}else
			{
				$badge_class="badge badge-pill badge-warning";
				$status = "Inactive";
			}

			$edit_url = "/proprietors/edit-proprietor/$proprietor->proprietor_id";
			$edit_btn = anchor($edit_url , "<i class='fa fa-edit'></i>", "class='btn btn-sm mt-2 mb-2 btn-outline-secondary'");

			$str_proprietor .= ' <tr>
			<td>'. $count.'</td>
			<td>'.$proprietor->first_name.'</td>
			<td>'. $proprietor->last_name.'</td>
			<td>'. $proprietor->proprietor_phone.'</td>
			<td>'.$proprietor->national_id.'</td>
			<td>'.$proprietor->business_reg_id.'</td>
			<td><span class="' . $badge_class . '">'. $status . '</span></td>
			<td>
			<button type="button" class="btn btn-sm btn-info"><i class="fa fa-eye" data-toggle="modal" data-target="#exampleModalLabel'. $proprietor->proprietor_id.'"></i></button>' .
			$edit_btn . 
			'</td>
			</tr>';
			$this->load->view('proprietor/view_proprietor', $v_data);

		}
	}	
?>
<div>
  	<?php echo anchor("/admin/Proprietors/add_proprietor", "Add proprietor", "class='btn btn-sm mt-2 mb-2 btn-outline-secondary'")?>          
	  <?php 
	  	echo form_open("/admin/proprietors/search_proprietor", array("class" => "form-inline my-2 my-lg-0 "))?>
		<input type="radio" name="status" value="1" class ="m-2" > Active
		<input type="radio" name="status" value="'0'" class="m-2"> Inactive
 		<input type="text" name="proprietor_name" placeholder=" search Name" class =" ml-2">
		<input type="text" name="nationalid" placeholder=" search national id" class =" ml-2" >
		<input type="text" name="businessreg" placeholder=" search business id" class =" ml-2">
		<button class="btn btn-outline-success my-2 my-sm-0 ml-sm-2" type="submit"><i class="fas fa-search"></i></button> 
		<?php if($this->session->userdata('search_proprietor_params')){?>
		<a href="<?php echo base_url();?>proprietors/close-search" class="btn btn-outline-danger my-2 my-sm-0 ml-sm-2"><i class="fas fa-times"></i></a>
		<?php }?>
	<?php echo form_close() ?>
</div>            
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
			 <th>No.</th>
				<th>First Name
					<a href="<?php echo base_url();?>proprietors/all-proprietors/proprietor.first_name/<?php echo $new_order_method;?>" style="color:#000"><?php echo $order_method_icon;?></i></a>
				</th>
				<th>Last Name
					<a href="<?php echo base_url();?>proprietors/all-proprietors/proprietor.last_name/<?php echo $new_order_method;?>" style="color:#000"><?php echo $order_method_icon;?></i></a>
				</th>
				<th>Phone Number</th>
				<th>National ID
					<a href="<?php echo base_url();?>proprietors/all-proprietors/proprietor.national_id/<?php echo $new_order_method;?>" style="color:#000"><?php echo $order_method_icon;?></i></a>
				</th>
				<th>Business Reg ID</th>
				<th>Status
					<a href="<?php echo base_url();?>proprietors/all-proprietors/proprietor.proprietor_status/<?php echo $new_order_method;?>" style="color:#000"><?php echo $order_method_icon;?></i></a>
				<th>
				<th colspan="4">Actions</th>
			<tr>
        </thead>
        <tbody>
			<?php
				echo $str_proprietor;
			?>
		</tbody>

    </table>
	<div class="p-3" id="">
		<?php if (isset($links)) { ?>
			<?php echo $links ?>
		<?php } ?>
	</div>
</div>

