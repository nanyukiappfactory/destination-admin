<!DOCTYPE html>
<html>

	<?php $this->load->view('admin/layouts/header');?>
    <body>
		
		<?php $this->load->view('admin/layouts/navigation');?>	
	
		<?php $this->load->view('admin/layouts/sidebar');?>
		<?php 
			$error = $this->session->flashdata('error');
			if(!empty($error))
			{?>
				<div class="alert alert-danger"><?php echo $error;?></div>
			<?php }
		?>
		<?php 
			$success = $this->session->flashdata('success');
			if(!empty($success))
			{?>
				<div id="welcome_message" class="alert alert-success"><?php echo $success;?></div>
			<?php }
		?> 

		<?php echo $content;?>
		
		<?php $this->load->view('admin/layouts/footer');?>

	</body>
</html>
