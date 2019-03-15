  <?php echo anchor("/admin/Proprietors/add_proprietor", "Add proprietor", "class='btn btn-sm mt-2 mb-2 btn-outline-secondary'")?>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>


            <tr>

        </thead>
        <tbody>
		<?php
			if (is_array($proprietors->result())) 
			{
				$count = $counter;
				foreach ($proprietors->result() as $proprietor) 
				{
					$v_data['prop'] =  $proprietor;
					$count++;?>
		<tr>
			<td>
				<?php echo $count;?>
			</td>
			<td>
				<?php echo $proprietor->first_name;?>
			</td>
			<td>
				<?php echo $proprietor->last_name;?>
			</td>
			<td>
				<?php echo $proprietor->proprietor_phone;?>
			</td>

			<td>
				<?php echo $proprietor->national_id;?>
			</td>
			<td>
				<?php echo $proprietor->business_reg_id;?>
			</td>
			<td>
				<?php 
						if($proprietor->proprietor_status == 1)
						{?>
				<span class="badge badge-pill badge-success">Active</span>
				<?php }
						else
						{ ?>
				<span class="badge badge-pill badge-warning">Inactive</span>
				<?php } ?>
			</td>
			
		<tr>
        <td>
		<button type="button" class="btn btn-sm btn-info"><i class="fa fa-eye" data-toggle="modal" data-target="#exampleModalLabel<?php echo $proprietor->proprietor_id;?>"></i></button>
		<?php $this->load->view('proprietor/view_proprietor', $v_data)?>
		<button type="button" class="btn btn-sm btn-info"><i class="fa fa fa-edit" ></i></button>
        <button type="button" class="btn btn-sm btn-danger"><i class="fa fa-trash" ></i></button>
			</td>
			<?php
					
				}
			}
		?>

	</tbody>

    </table>
	<div class="p-3" id="pagination-links">
	<?php if (isset($links)) { ?>
		<?php echo $links ?>
	<?php } ?>
</div>

