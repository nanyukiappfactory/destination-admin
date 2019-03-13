<article class="content responsive-tables-page">
<?php $this->load->view('activity/add_activity');?>
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-block">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Date<?php
                                                if($order_method == "ASC"){?>
                                                    <a href="<?php echo base_url();?>administration/all-activities/activities.activity_date/DESC" style="color:#000"><i class="far fa-arrow-alt-circle-down"></i></a>
                                                <?php }
                                                else{ ?>
                                                    <a href="<?php echo base_url();?>administration/all-activities/activities.activity_date/ASC" style="color:#000"><i class="far fa-arrow-alt-circle-up"></i></a>
                                                <?php }?>
                                            </th>
                                            <th>Status</th>
                                            <th>Longitude</th>
                                            <th>Latitude</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        if(is_array($activities->result()))
                                        {
                                            $count = 0;
                                            foreach ($activities->result() as $activity) 
                                            { 
                                                $v_data['activity_modal'] =  $activity;
                                                $count++;?>
                                                <tr>
                                                    <td><?php echo $count;?></td> 
                                                    <td><?php echo $activity->activity_name;?></td> 
                                                    <td><?php echo $activity->activity_description;?></td> 
                                                    <td><?php echo date('Y m js', strtotime($activity->activity_date));?></td> 
                                                    <td>
                                                        <?php 
                                                            if($activity->activity_status == 1)
                                                            {?>
                                                                <span class="badge badge-pill badge-success">Active</span>
                                                            <?php }
                                                            else
                                                            { ?>
                                                                <span class="badge badge-pill badge-warning">Inactive</span>
                                                            <?php } ?>
                                                    </td>
                                                    <td><?php echo $activity->activity_longitude;?></td> 
                                                    <td><?php echo $activity->activity_latitude;?></td> 
                                                    <td><?php echo $activity->activity_phone;?></td>
                                                    <td><?php echo $activity->activity_email;?></td> 
                                                    
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-oval btn-info" data-toggle="modal" data-target="#exampleModal<?php echo $activity->activity_id;?>"><i class="fa fa-eye"></i></button>
                                                        <?php $this->load->view('activity/view_activity', $v_data)?>
                                                        
                                                        <button type="button" class="btn btn-sm btn-oval btn-primary" data-toggle="modal" data-target="#updateModal<?php echo $activity->activity_id;?>"><i class="fa fa-edit"></i></button>
                                                        <?php $this->load->view('activity/update_activity', $v_data)?>
                                                        
                                                        <?php 
                                                            if($activity->activity_status == 1)
                                                            {?>
                                                                <a href="<?php echo base_url();?>administration/deactivate-activity/<?php echo $activity->activity_id;?>/<?php echo $activity->activity_status;?>" class="btn btn-sm btn-warning" onclick="return confirm('Are you Sure You want to Deactivate?')"><i class="fas fa-thumbs-down"></i></a> 
                                                            <?php }
                                                            else
                                                            { ?>
                                                                <a href="<?php echo base_url();?>administration/deactivate-activity/<?php echo $activity->activity_id;?>/<?php echo $activity->activity_status;?>" class="btn btn-sm btn-success" onclick="return confirm('Are you Sure You want to Activate?')"><i class="fas fa-thumbs-up"></i></a>
                                                        <?php } ?>

                                                        <a href="<?php echo base_url();?>administration/delete-activity/<?php echo $activity->activity_id;?>" onclick="return confirm('Are you sure you wan to delete?')"  class="btn btn-sm btn-oval btn-danger"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php }
                                        }
                                    ?>
                                    </tbody>
                                </table>
                                <div class="p-3" id="pagination-links">
									<?php if (isset($links)) { ?>
										<?php echo $links ?>
									<?php } ?>
								</div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
</article>