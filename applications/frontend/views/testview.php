<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">



    <style type="text/css">
    .colbox {
        margin-left: 0px;
        margin-right: 0px;
    }
    </style>
    <!-- Bootstrap Core CSS -->
<link href="<?php echo base_url('assets/data/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- MetisMenu CSS -->
<link href="<?php echo base_url('assets/data/bower_components/metisMenu/dist/metisMenu.min.css'); ?>" rel="stylesheet">


    <!-- DataTables CSS -->
<link href="<?php echo base_url('assets/data/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css'); ?>" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
<link href="<?php echo base_url('assets/data/bower_components/datatables-responsive/css/dataTables.responsive.css'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
<link href="<?php echo base_url('assets/data/dist/css/sb-admin-2.css'); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
<link href="<?php echo base_url('assets/data/bower_components/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">

      <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
    <script type="text/javascript">
    //load datepicker control onfocus

    </script>

</head>
<body>

  <?php
  // Turn off all error reporting
  error_reporting(0);
  ?>



<div class="container">


    <div class="row">
        <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
        <legend>Add Parking Details</legend>
        <?php
        $attributes = array("class" => "form-horizontal", "id" => "employeeform", "name" => "employeeform");
        echo form_open("account/insertdata", $attributes);?>
        <fieldset>

            <div class="form-group">
            <div class="row colbox">

            <div class="col-lg-4 col-sm-4">
                <label for="id" class="control-label">ID</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="pid" readonly name="pid" placeholder="id" type="text" class="form-control"  value="<?php echo $maxid; set_value('max'); ?>" />
                <span class="text-danger"><?php echo form_error('pid'); ?></span>
            </div>
            </div>
            </div>

            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="noplate" class="control-label">No. Plate</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="noplate" name="noplate" placeholder="noplate" type="text" class="form-control"  value="<?php echo set_value('noplate'); ?>" />
                <span class="text-danger"><?php echo form_error('noplate'); ?></span>
            </div>
            </div>
            </div>

            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="parktype" class="control-label">Parking Type</label>
            </div>
            <div class="col-lg-8 col-sm-8">

                <?php
                $attributes = 'class = "form-control" id = "parktype"';
                echo form_dropdown('parktype',$parktype,set_value('parktype'),$attributes);?>
                <span class="text-danger"><?php echo form_error('parktype'); ?></span>
            </div>
            </div>
            </div>

            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="intime" class="control-label">Intime</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="intime" readonly name="intime" placeholder="" type="text" class="form-control"  value="<?php echo date('Y-m-d H:i:s',time()); ?>" />
                <span class="text-danger"><?php echo form_error('intime'); ?></span>
            </div>
            </div>
            </div>

            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="outtime" class="control-label">Outtime</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="outtime" readonly name="outtime" placeholder="" type="text" class="form-control"  value="" />
                <span class="text-danger"><?php echo form_error('outtime'); ?></span>
            </div>
            </div>
            </div>

            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="hours" class="control-label">Total Hours</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="hours" readonly name="hours" placeholder="hours" type="text" class="form-control" value="<?php echo set_value('hours'); ?>" />
                <span class="text-danger"><?php echo form_error('hours'); ?></span>
            </div>
            </div>
            </div>

            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="charges" class="control-label">Total Charges</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="charges" readonly name="charges" placeholder="charges" type="text" class="form-control" value="<?php echo set_value('charges'); ?>" />
                <span class="text-danger"><?php echo form_error('charges'); ?></span>
            </div>
            </div>
            </div>

            <div class="form-group">
            <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Insert" />
                <input id="btn_cancel" name="btn_cancel" type="reset" class="btn btn-danger" value="Cancel" />
                  <input id="btn_print" name="btn_print" type="reset" class="btn btn-primary" value="print" />
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
