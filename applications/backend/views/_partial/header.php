<style type="text/css">
.custom-logo{
display: block;
    float: left;
    height: 50px;
    font-size: 20px;
    line-height: 50px;
    text-align: center;
    width: auto;
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    padding: 0 15px;
    font-weight: 300;
    color:#fff;
}
</style>
<header class="main-header">
	<a href="<?php site_url(); ?>" class="logo"><b></b></a>
	<nav class="navbar navbar-static-top" role="navigation">
		<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</a>
	<b class="custom-logo">Shree Sai Samartha Enterprises Pay And Park</b>
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<li class="dropdown user user-menu">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<span class="hidden-xs"><?php echo $user['full_name']; ?></span>
					</a>
					<ul class="dropdown-menu">
						<li class="user-header">
							<p><?php echo $user['full_name']; ?></p>
						</li>
						<li class="user-footer">
							<div class="pull-left">
								<a href="<?php echo site_url('account'); ?>" class="btn btn-default btn-flat">Account</a>
							</div>
							<div class="pull-right">
								<a href="<?php echo site_url('account/logout'); ?>" class="btn btn-default btn-flat">Sign out</a>
							</div>
						</li>
					</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>
