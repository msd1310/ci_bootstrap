
<div class="row">

	<div class="col-md-4">

		<?php echo box_open('Welcome!'); ?>
		<?php echo box_close('Box footer here'); ?>

		<?php echo box_open('Shortcuts'); ?>
			<?php if ($user['role']=='admin') echo app_btn('users', 'Backend', $url = 'admin/backend_user', $badge = 2); ?>
			<?php echo app_btn('user', 'Frontend', $url = 'user'); ?>
			<?php echo app_btn('info', 'Account', $url = 'account'); ?>
			<?php echo app_btn('sign-out', 'Logout', $url = 'account/logout'); ?>
		<?php echo box_close(); ?>

	</div>

	<?php if ($user['role']=='admin') { ?>
	<div class="col-md-4">
		<?php echo info_box('aqua', 2, 'Backend Users', 'users', 'admin/backend_user'); ?>
	</div>
	<?php } ?>

	<div class="col-md-4">
		<?php echo info_box('yellow', 0, 'Frontend Users', 'users', 'user'); ?>
	</div>

</div>
