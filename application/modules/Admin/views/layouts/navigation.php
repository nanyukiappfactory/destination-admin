<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Destination Laikipia</a>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="<?php echo base_url();?>admin/logout">Sign out</a>
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
    </li>
  </ul>
</nav>
