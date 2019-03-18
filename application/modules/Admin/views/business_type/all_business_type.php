<div>
	<?php echo anchor("/admin/Business_types/add_business_type", "Add Business Type", "class ='btn btn-sm mt-2 mb-2 btn-outline-secondary'")?>    
  <?php echo form_open(base_url() . $route.'/search-' . $route, array("class" => "form-inline my-2 my-lg-0"));?>
      <?php 
          foreach($search_options as $search_option_array)
              {?>
              <select class="form-control custom-select2 p-3" name="<?php echo $search_option_array[0];?>">
                  <option value="">Select <?php echo $search_option_array[2]; ?></option>
                <?php foreach ($search_option_array[1] as $key => $search_option) {
                  ?>
                  <option value="<?php echo $search_option['id'];?>"><?php echo $search_option['name'];?></option>
              <?php } ?>
              </select>
        <?php }
      ?>
      <button class="btn btn-outline-success my-2 my-sm-0 ml-sm-2" type="submit"><i class="fas fa-search"></i></button>
      <?php if($this->session->userdata($route.'_search_params')){?>
          <a href="<?php echo base_url();?><?php echo $route;?>/close-search" class="btn btn-outline-danger my-2 my-sm-0 ml-sm-2"><i class="fas fa-times"></i></a>
      <?php }?>
  <?php echo  form_close();?>
</div>

<div class="table-responsive">
	<table class="table table-striped table-sm">
		<thead>
			<tr>
				<th>No</th>
				<th>Business Type Name
					<?php
                if($order_method == "ASC"){?>
					<a href="<?php echo base_url();?>business-types/all-business-types/business_type.business_type_name/DESC" style="color:#000"><i
						 class="far fa-arrow-alt-circle-down"></i></a>
					<?php }
                else{ ?>
					<a href="<?php echo base_url();?>business-types/all-business-types/business_type.business_type_name/ASC" style="color:#000"><i
						 class="far fa-arrow-alt-circle-up"></i></a>
					<?php }?>
				</th>
				<th>Business Status
					<?php
                if($order_method == "ASC"){?>
					<a href="<?php echo base_url();?>business-types/all-business-types/business_type.business_type_status/DESC" style="color:#000"><i
						 class="far fa-arrow-alt-circle-down"></i></a>
					<?php }
                else{ ?>
					<a href="<?php echo base_url();?>business-types/all-business-types/business_type.business_type_status/ASC" style="color:#000"><i
						 class="far fa-arrow-alt-circle-up"></i></a>
					<?php }?>
				</th>
				<th>Action</th>
			</tr>
		</thead>
		<?php
            if($business_types->num_rows() > 0)
            {
              $count = $counter;
              foreach($business_types->result() as $business_type)
              {
                $v_data['business_type_page'] = $business_type;
                $count++;?>
		<tr>
			<td>
				<?php echo $count;?>
			</td>
			<td>
				<?php echo $business_type->business_type_name;?>
			</td>
			<td>
				<?php
                      if($business_type->business_type_status == 1)
                      {?>
				<span class="badge badge-pill badge-success">Active</span>
				<?php }
                      else
                      { ?>
				<span class="badge badge-pill badge-warning">Inactive</span>
				<?php } ?>
			</td>
			<td>
				<button type="button" class="btn btn-sm btn-oval btn-info" data-toggle="modal" data-target="#viewPage<?php echo $business_type->business_type_id;?>"><i
					 class="fa fa-eye"></i></button>
				<?php $this->load->view('business_type/view_business_type', $v_data)?>
			</td>
		</tr>
		<?php }
                }
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
