<!DOCTYPE html>
<html>
    
    <?php $this->load->view('admin/layouts/header'); ?>
<body>
    <?php 
        $error = $this->session->flashdata('error');
        if(!empty($error))
        {?>
            <div class="alert alert-danger"><?php echo $error;?></div>
        <?php }
    ?>
    <?php $this->load->view('login'); ?>
</body>
</html>