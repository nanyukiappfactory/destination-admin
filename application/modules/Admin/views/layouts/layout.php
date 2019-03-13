<!DOCTYPE html>
<html >

	<?php $this->load->view('admin/layouts/header');?>
    <body>
	
		<?php $this->load->view('admin/layouts/sidebar');?>

		<?php $this->load->view('admin/layouts/navigation');?>

		<?php echo $content;?>
		
		<?php $this->load->view('admin/layouts/footer');?>

	</body>
</html>
