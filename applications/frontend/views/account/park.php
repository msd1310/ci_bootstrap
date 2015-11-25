<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>
    <!-- Bootstrap Core CSS -->
<link href="<?php echo base_url('assets/data/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- MetisMenu CSS -->
<link href="<?php echo base_url('assets/data/bower_components/metisMenu/dist/metisMenu.min.cs'); ?>" rel="stylesheet">


    <!-- DataTables CSS -->
<link href="<?php echo base_url('assets/data/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css'); ?>" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
<link href="<?php echo base_url('assets/data/bower_components/datatables-responsive/css/dataTables.responsive.css'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
<link href="<?php echo base_url('assets/data/dist/css/sb-admin-2.css'); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
<link href="<?php echo base_url('assets/data/bower_components/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
    .colbox {
        margin-left: 0px;
        margin-right: 0px;
    }
    </style>

    <script type="text/javascript">
    //load datepicker control onfocus
    $(function() {
        $("#hireddate").datepicker();
    });
    </script>

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
        <legend>Add Employee Details</legend>
        <?php
//$sql = "SELECT max(id) from park";
//$result = $conn->query($sql);

        $attributes = array("class" => "form-horizontal", "id" => "employeeform", "name" => "employeeform");
        echo form_open("account/eg", $attributes);?>
        <fieldset>

            <div class="form-group">
            <div class="row colbox">

            <div class="col-lg-4 col-sm-4">
                <label for="pid" class="control-label">ID</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="pid" disabled name="id" readonly type="text" class="form-control"  value="<?php echo $maxid+1; ?>" />
                <span class="text-danger"><?php echo form_error('pid'); ?></span>
            </div>
            </div>
            </div>

            <div class="form-group">
                      <div class="row colbox">
                      <div class="col-md-4">
                <label for="typeid" class="control-label">Vehicle Type</label>
                      </div>
                      <div class="col-md-8">

                          <?php
                          $attributes = 'class = "form-control" id = "typeid"';
                          echo form_dropdown('typeid',$typename, set_value('typename',$typename[0]->typename), $attributes);?>

                          <span class="text-danger"><?php echo form_error('designation'); ?></span>
                      </div>
                      </div>
                      </div>


            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="typeid" class="control-label">Vehicle Type</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="typeid" name="typeid" placeholder="Park Type" type="text" class="form-control"  value="<?php echo set_value('typeid'); ?>" />
                <span class="text-danger"><?php echo form_error('typeid'); ?></span>
            </div>
            </div>
            </div>

            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="noplate" class="control-label">Vehicle No</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="noplate" name="noplate" placeholder="Vehicle No" type="text" class="form-control"  value="<?php echo set_value('noplate'); ?>" />
                <span class="text-danger"><?php echo form_error('noplate'); ?></span>
            </div>
            </div>
            </div>


            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="intime" class="control-label">In Time</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="intime"  name="intime" readonly placeholder="" type="datetime" class="form-control"  value="<?php echo  date('Y-m-d H:i:s',time());  ?>" />
                <span class="text-danger"><?php echo form_error('intime'); ?></span>
            </div>
            </div>
            </div>

            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="outtime" class="control-label">Out Time</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="outtime"  name="outtime" readonly placeholder="" type="text" class="form-control"  value="<?php echo date('Y-m-d H:i:s',time()); ?>" />
                <span class="text-danger"><?php echo form_error('outtime'); ?></span>
            </div>
            </div>
            </div>

            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="hours" class="control-label">Total hours</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="hours" name="totalhours" placeholder="totalhours" type="text" class="form-control"  value="<?php echo set_value('hours'); ?>" />
                <span class="text-danger"><?php echo form_error('hours'); ?></span>
            </div>
            </div>
            </div>

            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="totalcharges" class="control-label">Total Charges</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="totalcharges" name="totalcharges" placeholder="totalcharges" type="text" class="form-control" value="<?php echo set_value('totalcharges'); ?>" />
                <span class="text-danger"><?php echo form_error('totalcharges'); ?></span>
            </div>
            </div>
            </div>


            <div class="form-group">
            <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="submit" />
                <input id="btn_cancel" name="btn_cancel" type="reset" class="btn btn-danger" value="Cancel" />
            </div>
            </div>
        </fieldset>
        <?php echo form_close(); ?>
        <?php echo $this->session->flashdata('msg'); ?>
        </div>
    </div>
</div>
</body>
</html>
