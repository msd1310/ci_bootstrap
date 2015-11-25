<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shree sai samartha pay and park</title>

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
                <a class="navbar-brand" href="">Shree sai samartha enterprise pay and park</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
                            <a href="<?php echo base_url().'index.php/account/insertdata';?>"><i class="fa fa-dashboard fa-fw"></i> Add</a>
                        </li>

                        <li>
                            <a href="<?php echo base_url().'index.php/account/cg';?>"><i class="fa fa-table fa-fw"></i> List</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">

                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
            <legend>VEHICLE OUT RECEIPT</legend>
            <?php
            $attributes = array("class" => "form-horizontal", "id" => "employeeform", "name" => "employeeform");
            echo form_open("account/updateEmployee/" . $empno, $attributes);?>
            <fieldset>
	
 	        <div class="form-group">
                <div class="row colbox">

                <div class="col-lg-4 col-sm-4">
                    <label for="id" class="control-label">Status</label>
                </div>
                <div class="col-lg-8 col-sm-8">
			<?php if($emprecord[0]->status == 1){   $disabled = "disabled";  $print = "Out Print"; $hidden="hidden";  ?>
			<font size="6"><span class="label label-success">Checked Out</span></font>
			<?php } if ($emprecord[0]->status == 0) { $disabled=""; $print = "In Print"; $hidden="";   ?>
			<font size="6"><span class="label label-danger">Not Checked Out</span></font>
			<?php  }  ?>
		</div>
                </div>
                </div>


                <div class="form-group">
                <div class="row colbox">

                <div class="col-lg-4 col-sm-4">
                    <label for="id" class="control-label">Receipt No.</label>
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
                    <label for="noplate" class="control-label">Vehicle No.</label>
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
                    $attributes = 'class = "form-control" id = "parktype" readonly="readonly" disabled="True"';
                    echo form_dropdown('parktype',$parktype,set_value('parktype',$emprecord[0]->typeid),$attributes);?>
                    <span class="text-danger"><?php echo form_error('parktype'); ?></span>
                </div>
                </div>
                </div>

                
				
				 <div class="form-group">
                <div class="row colbox">
                <div class="col-lg-4 col-sm-4">
                    <label for="yard" class="control-label">Yard No. </label>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <input id="yard" name="yard" readonly placeholder="Yard no" type="text" class="form-control" value="<?php 
					if(!empty($yard_name)){ echo set_value('yard',$yard_name[0]->yard_name); }?>" />
                    <input id="vessel_hidden" name="yard_hidden" value="<?php echo set_value('yard_hidden',$emprecord[0]->yardno); ?>" hidden/>
                    <span class="text-danger"><?php echo form_error('yard'); ?></span>
                </div>
                </div>
                </div>

                <div class="form-group">
                <div class="row colbox">
                <div class="col-lg-4 col-sm-4">
                    <label for="vessel" class="control-label">Vessel No. </label>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <input id="vessel" name="vessel" readonly placeholder="Vessel no" type="text" class="form-control" value="<?php 
                    if(!empty($vessel_name)){ echo set_value('vessel',$vessel_name[0]->vessel_name); }?>" />
                    <input id="vessel_hidden" name="vessel_hidden" value="<?php echo set_value('vessel_hidden',$emprecord[0]->vesselno); ?>" hidden/>
                    <span class="text-danger"><?php echo form_error('vessel'); ?></span>
                </div>
                </div>
                </div>

                 <div class="form-group">
                <div class="row colbox">
                <div class="col-lg-4 col-sm-4">
                    <label for="slot" class="control-label">Slot Name. </label>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <input id="slot" name="slot" readonly placeholder="Slot no" type="text" class="form-control" value="<?php 
                    if(!empty($slot_name)){ echo set_value('slot',$slot_name[0]->name); }?>" />
                    <input id="slot_hidden" name="slot_hidden" value="<?php echo set_value('slot_hidden',$emprecord[0]->slotno); ?>" hidden/>
                    <span class="text-danger"><?php echo form_error('slot'); ?></span>
                </div>
                </div>
                </div>

               <div class="form-group">
                <div class="row colbox">
                <div class="col-lg-4 col-sm-4">
                    <label for="containerno" class="control-label">Container No.</label>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <input id="containerno" readonly name="containerno" placeholder="container no" type="text" class="form-control"  value="<?php echo set_value('containerno',$emprecord[0]->containerno); ?>" />
                    <span class="text-danger"><?php echo form_error('containerno'); ?></span>
                </div>
                </div>
                </div>

                <div class="form-group">
                <div class="row colbox">
                <div class="col-lg-4 col-sm-4">
                    <label for="invoiceno" class="control-label">Voyage No.</label>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <input id="invoiceno" readonly name="invoiceno" placeholder="voyage no" type="text" class="form-control"  value="<?php echo set_value('invoiceno',$emprecord[0]->invoiceno); ?>" />
                    <span class="text-danger"><?php echo form_error('invoiceno'); ?></span>
                </div>
                </div>
                </div>


                <div class="form-group">
                <div class="row colbox">
                <div class="col-lg-4 col-sm-4">
                    <label for="intime" class="control-label">In Time</label>
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
                    <label for="outtime" class="control-label">Out Time</label>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <input id="outtime" readonly name="outtime" placeholder="" type="text" class="form-control"  value="<?php echo date('Y-m-d H:i:s',time());?>" />
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

                    <input id="hours" readonly name="hours" placeholder="hours" type="text" class="form-control" value="<?php 
		if($emprecord[0]->status == 0)
		    { 
			$in = $emprecord[0]->intime; 
                $out = date('Y-m-d H:i:s',time());
$hour1 = 0; $hour2 = 0;
$date1 = $in;
$date2 = $out;
$datetimeObj1 = new DateTime($date1);
$datetimeObj2 = new DateTime($date2);
$interval = $datetimeObj1->diff($datetimeObj2);
if($interval->format('%a') > 0){
$hour1 = $interval->format('%a')*24;
}
if($interval->format('%h') > 0){
$hour2 = $interval->format('%h');
}
$hrs = $hour1+ $hour2; $hrs = sprintf("%02d",$hrs);
$minutes = $interval->format('%i');$minutes = sprintf("%02d",$minutes);
$secs = $interval->format('%s');$secs = sprintf("%02d",$secs);

			echo $hours = $hrs.":".$minutes.":".$secs; 

		  } else { 
			echo set_value('hours',$emprecord[0]->hours );
		      } ?>" />
                    <!--input id="hours" readonly name="hours" placeholder="hours" type="text" class="form-control" value="<?php /*if($emprecord[0]->status == 0){ $in = $emprecord[0]->intime; $out = date('Y-m-d H:i:s',time()); echo $hours = (abs(strtotime($in)-strtotime($out)) / 60) / 60; } else { echo set_value('hours',$emprecord[0]->hours );} */ ?>" /-->
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
                    <input id="charges" readonly name="charges" placeholder="charges" type="text" class="form-control" value="<?php if($emprecord[0]->status == 0){ #echo $hours.':'.$charge;
		$start_slab = 0;
		$end_slab = 8;
		
		$sql = "select charges from charges where typeid = '{$emprecord[0]->typeid}'";
	        $query = $this->db->query($sql);
        	$result = $query->result();
		
		$result1 = array();
		foreach ($result as $key => $value) {
		    $result1['charges'] = $value->charges;
		}

		$charges =$result1['charges'];

		#$slab =  date('H:i:s',strtotime('08:00:00'));
# 		$h = date('h',strtotime($hours));
#		$m = date('i',strtotime($hours));
		
		$tot_str = $hrs.'.'.$minutes;
		$hour_in_float = (float)$tot_str;
		$t_charges = (ceil($hour_in_float/8))*$charges;
		if($t_charges == 0){
			echo $charges;
		}else{
			echo $total_charges = (ceil($hour_in_float/8))*$charges;
		}

		} else { echo set_value('charges',$emprecord[0]->charges); }?>" />
                    <span class="text-danger"><?php echo form_error('charges'); ?></span>
                </div>
                </div>
                </div>

                <div class="form-group">
                <div class="row colbox">
                <div class="col-lg-4 col-sm-4">
                    <label for="type" class="control-label">Select </label>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <input type="radio" name="type" value="nscit" required>NSICT</input>
                    <input type="radio" name="type" value="others" required>OTHERS</input>
                    <?php echo form_error('type'); ?>
                </div>
                </div>
                </div>
                

                <div class="form-group">
            <div class="col-sm-offset-4 col-md-8 text-left">

                <input id="btn_update" name="btn_update" type="submit" class="btn btn-primary" value="Checkout" <?php echo $disabled; ?> />
                <input id="btn_cancel" name="btn_cancel" type="reset" class="btn btn-danger" value="Cancel" />
			<input type="hidden" name="hdnAction" id="hdnAction" value=""/>
                <input id="btn_print" name="btn_print" type="submit" class="btn btn-success" onclick="setHiddenValue('<?php echo $print; ?>')" value="<?php echo $print; ?>" />
<script type="text/javascript">
    function setHiddenValue($name) {
       // alert($name);
        document.getElementById('hdnAction').value=$name;
    } 
</script>            
            </div>
            </div>
            </fieldset>
            <?php echo form_close(); ?>
            <?php echo $this->session->flashdata('msg'); ?>
            </div>
        </div>
        <!-- /#page-wrapper -->

        <!-- /#wrapper -->

    <!-- jQuery -->
        <script src="<?php echo base_url('assets/data/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/metisMenu/dist/metisMenu.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/dist/js/sb-admin-2.js'); ?>"></script>
        <script src="<?php echo base_url('assets/newjq/moment.min.js'); ?>"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
        var charges = '<?php echo $charges; ?>';
		
			//	timer();
				
function timer(){
 var now = new Date,
     hours = now.getHours(),
     //ampm  = hours<=11 ? ' AM' : ' PM'
     minutes = now.getMinutes(),
     seconds = now.getSeconds(),
	 indate = (now.getUTCFullYear())+'-'+(now.getUTCMonth()+1)+'-'+(now.getDate());
     t_str = [indate + ' ' +hours,
              (minutes < 10 ? "0" + minutes : minutes),
              (seconds < 10 ? "0" + seconds : seconds)]
                 .join(':');
				 
 document.getElementById('outtime').value = t_str;
 
 
var now  = new Date(document.getElementById('outtime').value);//"04/09/2013 15:00:00";
var then = new Date(document.getElementById('intime').value);//"02/09/2013 14:20:30";

now = (now.getUTCDate())+'/'+(now.getUTCMonth()+1)+'/'+(now.getUTCFullYear() + ' ' + now.getHours() + ':' + now.getMinutes() +':'+now.getSeconds());
then = (then.getDate())+'/'+(then.getMonth()+1)+'/'+(then.getFullYear() + ' ' + then.getHours() + ':' + then.getMinutes() +':'+then.getSeconds());

var ms = moment(now,"DD/MM/YYYY HH:mm:ss").diff(moment(then,"DD/MM/YYYY HH:mm:ss"));
var d = moment.duration(ms);
var s = Math.floor(d.asHours()) + moment.utc(ms).format(":mm:ss");

document.getElementById('hours').value = s;



strDate = s;
arr = strDate.split(':');
hour = parseInt(arr[0]);
min = parseInt(arr[1]);
sec = parseInt(arr[2]);

hrs = hour+'.'+min;
var total_charges = (Math.ceil(hrs/8)*charges);
if(total_charges == 0){
    total_charges = charges;
}
//alert(total_charges);
document.getElementById('charges').value = total_charges;

 setTimeout(timer,1000);
}

$('#btn_cancel').click(function() {
   var siteurl = '<?php echo site_url(); ?>';
   var url = '/account/cg';
   window.location.href = siteurl + url;
   return false;
});
    });
    </script>

</body>
<?php include('footer.php'); ?>

</html>
