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
				<div><?php echo $error;?></div>
			<?php }
		?>
		<?php echo $content;?>
		
		<?php $this->load->view('admin/layouts/footer');?>

	</body>
</html>
