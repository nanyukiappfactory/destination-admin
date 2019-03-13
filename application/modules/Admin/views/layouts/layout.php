<!DOCTYPE html>
<html lang="en">

	<?php $this->load->view('admin/layouts/header');?>
    <body>

        <?php $this->load->view('admin/layouts/navigation');?>

        <?php $this->load->view('admin/layouts/sidebar');?>
		
		<?php echo $content;?>
		
		<?php $this->load->view('admin/layouts/footer');?>

	</body>
</html>
