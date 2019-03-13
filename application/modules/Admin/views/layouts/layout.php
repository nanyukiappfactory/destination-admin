<!DOCTYPE html>
<html lang="en">

<?php $this->load->view('admin/layouts/header');?>

<link  href="<?php echo base_url();?>assets/custom/themes/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/custom/themes/vendor/bootstrap/css/dashboard.css" rel="stylesheet">
<body>

<?php $this->load->view('admin/layouts/navigation');?>

<?php $this->load->view('admin/layouts/sidebar');?>

<?php echo $content;?>
<?php $this->load->view('admin/layouts/footer');?>


    
</body>
</html>