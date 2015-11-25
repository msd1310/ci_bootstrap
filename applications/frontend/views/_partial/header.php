
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">

  <?php include('head.php'); ?>    
    <div class="navbar-header">
  <?php include('headers.php'); ?>    
  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo site_url(); ?>"><?php echo lang('website_name'); ?></a>
    </div>

    <div class="navbar-collapse collapse">
      <?php //$this->load->view('_partial/menu'); ?>
      <?php //$this->load->view('_partial/menu_right'); ?>
    </div>

  </div>

</nav>
