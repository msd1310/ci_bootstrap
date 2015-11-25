<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeIgniter | Insert Employee Details into MySQL Database</title>
    <!--link the bootstrap css file-->
    <link href="<?php echo base_url("assets/bootstrap/css/bootstrap.css"); ?>" rel="stylesheet" type="text/css" />
    <!-- link jquery ui css-->
    <link href="<?php echo base_url('assets/jquery-ui-1.11.2/jquery-ui.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!--include jquery library-->
    <script src="<?php echo base_url('assets/js/jquery-1.10.2.js'); ?>"></script>
    <!--load jquery ui js file-->
    <script src="<?php echo base_url('assets/jquery-ui-1.11.2/jquery-ui.min.js'); ?>"></script>

    <style type="text/css">
    .colbox {
        margin-left: 0px;
        margin-right: 0px;
    }
    </style>


    <script type="text/javascript">
    //load datepicker control onfocus
    $(function() {
      $(document).ready(function(){
    function showRoom(){
        $.ajax({
            type:"POST",
            url:"process.php",
            data:{action:"showroom"},
            success:function(data){
              alert(data);
                $("#content").html(data);
            }
        });
    }
    showRoom();
});
        $("#hireddate").datepicker();
    });
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
        <legend>Update Parking Details</legend>
        <?php
        $attributes = array("class" => "form-horizontal", "id" => "employeeform", "name" => "employeeform");
        echo form_open("account/updateEmployee/" . $empno, $attributes);?>
        <fieldset>

            <div class="form-group">
            <div class="row colbox">

            <div class="col-lg-4 col-sm-4">
                <label for="id" class="control-label">ID</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="pid" readonly name="pid" placeholder="pid" type="text" class="form-control"  value="<?php echo $emprecord[0]->pid;  ?>" />
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
                <input id="noplate" readonly name="noplate" placeholder="noplate" type="text" class="form-control"  value="<?php echo set_value('noplate',$emprecord[0]->noplate); ?>" />
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
                $attributes = 'class = "form-control" id = "parktype" readonly="readonly"';
                echo form_dropdown('parktype',$parktype,set_value('parktype',$emprecord[0]->typeid),$attributes);?>
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
                <input id="intime" readonly name="intime" placeholder="" type="text" class="form-control"  value="<?php echo set_value(date('Y-m-d H:i:s',time()),$emprecord[0]->intime ); ?>" />
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
                <input id="outtime" readonly name="outtime" placeholder="" type="text" class="form-control"  value="<?php if($emprecord[0]->status == 0){echo date('Y-m-d H:i:s',time()); } else { echo  set_value(date('Y-m-d H:i:s',time()),$emprecord[0]->outtime );} ?>" />
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

                <input id="hours" readonly name="hours" placeholder="hours" type="text" class="form-control" value="<?php if($emprecord[0]->status == 0){ $in = $emprecord[0]->intime; $out = date('Y-m-d H:i:s',time()); echo $hours = (abs(strtotime($in)-strtotime($out)) / 60) / 60; } else { echo set_value('hours',$emprecord[0]->hours );} ?>" />
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
                <input id="charges" readonly name="charges" placeholder="charges" type="text" class="form-control" value="<?php if($emprecord[0]->status == 0){ echo $charge;} else { echo set_value('charges',$emprecord[0]->charges); }?>" />
                <span class="text-danger"><?php echo form_error('charges'); ?></span>
            </div>
            </div>
            </div>

            <div class="form-group">
        <div class="col-sm-offset-4 col-md-8 text-left">
            <input id="btn_update" name="btn_update" type="submit" class="btn btn-primary" value="Checkout" />
            <input id="btn_cancel" name="btn_cancel" type="reset" class="btn btn-danger" value="Cancel" />
            <input id="btn_print" name="btn_print" type="reset" class="btn btn-danger" value="Print" />
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
