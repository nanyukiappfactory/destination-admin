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
	}
	else
	{
		$badge_class = 'badge badge-pill badge-warning';
		$status = 'Inactive';
	}

	$tr_business_types .= '<tr>
		<td>' . $count . '</td>
		<td>' . $business_type->business_type_name . '</td>
		<td>
			<span class="' . $badge_class . '">'. $status . '</span>
		</td>
		<td>
		<button type="button" class="btn btn-sm btn-oval btn-info" data-toggle="modal" data-target="#viewPage' . $business_type->business_type_id . '"><i class="fa fa-eye"></i></button>
		</td>
	</tr>';

  	$this->load->view('business_type/view_business_type', $v_data);
  }
}

echo anchor("/admin/Business_types/add_business_type", "Add Business Type", "class ='btn btn-sm mt-2 mb-2 btn-outline-secondary'")?>

<ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
    <?php
    echo form_open(base_url() . $route.'/search-' . $route, array("class" => "form-inline my-2 my-lg-0"));?>
      <input type="radio" name="radio_status" value="Active"> Active
      <hr>
      <input type="radio" name="radio_status" value="Inactive"> Inactive
      <input type="text" name="Name" Placeholder="Search" />
      <button class="btn btn-outline-success my-2 my-sm-0 ml-sm-2" type="submit"><i class="fas fa-search"></i></button>
  <?php echo  form_close();?>
    
    </li>
  </ul>

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
    