<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>shree sai samartha enterprise pay and park</title>

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

<link href="<?php echo base_url('assets/newjq/jquery-ui.min.css'); ?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Shree Sai Samartha Enterprises Pay and Park</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo site_url();?>/account/logout_user/"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="insertdata"><i class="fa fa-dashboard fa-fw"></i> Add </a>
                        </li>

                        <li>
                            <a href="cg"><i class="fa fa-table fa-fw"></i> List</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row container-fluid">
                        <!-- /.row -->
            <div class="col-lg-6 col-sm-6 well">
            <legend>VEHICLE IN RECEIPT</legend>
            <?php
            $attributes = array("class" => "form-horizontal", "id" => "employeeform", "name" => "employeeform");
            echo form_open("account/insertdata", $attributes);?>
            <?php echo $this->session->flashdata('msg_success'); ?>
            <fieldset>

                <div class="form-group">
                <div class="row colbox">

                <div class="col-lg-4 col-sm-4">
                    <label for="id" class="control-label">Receipt No.</label>
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
                    <label for="noplate" class="control-label">Vehicle No. </label>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <input id="noplate" name="noplate" required placeholder="vehicle no" type="text" class="form-control"  value="<?php echo set_value('noplate'); ?>" />
                    <span class="text-danger"><?php echo form_error('noplate'); ?></span>
                </div>
                </div>
                </div>

                <div class="form-group">
                <div class="row colbox">
                <div class="col-lg-4 col-sm-4">
                    <label for="containerno" class="control-label">Container No. </label>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <input id="containerno" name="containerno" placeholder="Container no" type="text" class="form-control"  value="" />
                    <span class="text-danger"><?php echo form_error('containerno'); ?></span>
                  <!--  <input id="slot_hidden" name="slot_hidden" required="required" hidden/> -->
                </div>
                </div>
                </div>



                <div class="form-group">
                <div class="row colbox">
                <div class="col-lg-4 col-sm-4">
                    <label for="vessel" class="control-label">Vessel No. </label>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <input id="vessel" name="vessel" placeholder="Vessel no" type="text" class="form-control" required="required"  />
                    <input id="vessel_hidden" name="vessel_hidden" hidden/>
                  <!--  <input id="slot_hidden" name="slot_hidden" required="required" hidden/> -->
                    <span class="text-danger"><?php echo form_error('vessel'); ?></span>
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
                    $attributes = 'class = "form-control" id = "parktype" required="required" ';
                    echo form_dropdown('parktype',$parktype,set_value('parktype'),$attributes);?>
                    <span class="text-danger"><?php echo form_error('parktype'); ?></span>
                </div>
                </div>
                </div>


  <!--
                <div class="form-group">
                <div class="row colbox">
                <div class="col-lg-4 col-sm-4">
                    <label for="invoiceno" class="control-label">Voyage No. </label>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <input id="invoiceno" name="invoiceno" placeholder="voyage no" type="text" class="form-control"  value="" />
                    <span class="text-danger"><?php echo form_error('invoiceno'); ?></span>
                </div>
                </div>
                </div>
  -->

                <div class="form-group">
                <div class="row colbox">
                <div class="col-lg-4 col-sm-4">
                    <label for="intime" class="control-label">In Time</label>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <input id="intime" readonly name="intime" placeholder="" type="text" class="form-control"  value="" />
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
                    <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Save" />
                    <input id="btn_cancel" name="btn_cancel" type="reset" class="btn btn-danger" value="Reset" />

                </div>
                </div>
                </div>


    </div>
            </fieldset>
            <?php echo form_close(); ?>
            <?php echo $this->session->flashdata('msg'); ?>
            </div>

        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

	<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="yard_vessel">Yard Details</h4>
      </div>
      <div class="modal-body">
         <table border="1" cellspacing="0" cellpadding="0" class="table">
          <tbody>
                <tr class="odd">
                    <td>Total Slots</td>
                    <td id="total_slots">0.00</td>
                </tr>
                 <tr class="even">
                    <td>Alloted Slots</td>
                    <td id="alloted_slots">0.00</td>
                </tr>
                 <tr class="odd">
                    <td>Remaining Slots</td>
                    <td id="remaining_slots">0.00</td>
                </tr>
          </tbody>
         </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
       <!--  <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    <!-- jQuery -->
        <script src="<?php echo base_url('assets/newjq/jquery-1.10.2.js'); ?>"></script>
        <script src="<?php echo base_url('assets/newjq/jquery-ui.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/metisMenu/dist/metisMenu.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/dist/js/sb-admin-2.js'); ?>"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
	    <script>
    $(document).ready(function() {
       		timer();

function timer(){
 var now = new Date,
     hours = now.getHours(),
     //ampm  = hours<=11 ? ' AM' : ' PM'
     minutes = now.getMinutes(),
     seconds = now.getSeconds(),
	 indate = (now.getUTCFullYear())+'-'+(now.getUTCMonth()+1)+'-'+(now.getUTCDate());
     t_str = [indate + ' ' +hours,
              (minutes < 10 ? "0" + minutes : minutes),
              (seconds < 10 ? "0" + seconds : seconds)]
                 .join(':');

 document.getElementById('intime').value = t_str;
 setTimeout(timer,1000);
}

$("#vessel").autocomplete({
    source: function (request, response) {
        $.ajax({
            url: "<?php  echo site_url('account/getVesselList'); ?>",
            type: 'POST',
            dataType: "json",
            data:{ search : $('#vessel').val() },
            success: function (data) {
                     response($.map(data, function(v,i){
                        return {
                                    label: v.name,
                                    value: v.id
                                   };
                    }));


            }
        });


             },
    select:function(event, ui) {
        event.preventDefault();
        $("#vessel").val(ui.item.label); //alert(ui.item.value);
        $("#vessel_hidden").val(ui.item.value);
        demo(ui.item.value);
    },
    focus: function(event, ui) {
        event.preventDefault();
        $("#vessel").val(ui.item.label);
    }
});

</style>
</body><?php include('footer.php'); ?>


</html>
