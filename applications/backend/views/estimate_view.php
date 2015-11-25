<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Shree sai samartha Pay & Park</title>

    <!-- Bootstrap Core CSS -->
<link href="<?php echo base_url('assets/data/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- MetisMenu CSS -->
<link href="<?php echo base_url('assets/data/bower_components/metisMenu/dist/metisMenu.min.css'); ?>" rel="stylesheet">
    <!-- DataTables CSS -->
<link href="<?php echo base_url('assets/data/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css'); ?>" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
<link href="<?php echo base_url('assets/data/bower_components/datatables-responsive/css/dataTables.responsive.css'); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
<link href="<?php echo base_url('assets/data/bower_components/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">

<link href="<?php echo base_url('assets/newjq/jquery-ui.min.css'); ?>" rel="stylesheet">


 <script type="text/javascript">
    $(document).ready(function() {

$('.datepicker').each(function(){
    $(this).datepicker({
        changeMonth: true,//this option for allowing user to select month
        changeYear: true //this option for allowing user to select from year range
        });
        //$(this).datepicker().datepicker("setDate", new Date());
});
    $("#show-row").click(function() {
        var name = $(this).attr('name');
                //alert($('#caption-head').text());
        $(".hiderow").each(function(){
                if(name == "show"){
                $(".hiderow").show();
                $('#show-row').attr('name','hide');
                $('#export-button').text("Detailed Report");
			$("#show-row").tooltip('hide')
			          .attr('data-original-title', "Click here to hide details")
			          .tooltip('fixTitle')
			          .tooltip('show');
                }else if (name == "hide"){
                $(".hiderow").hide();           
                $('#show-row').attr('name','show');
                $('#export-button').text("Estimate Report");
			$("#show-row").tooltip('hide')
			          .attr('data-original-title', "Click here to show details")
			          .tooltip('fixTitle')
			          .tooltip('show');
                }
        });
    });

$("[data-toggle='tooltip']").tooltip();
});
    </script>
<style>
#show-row {
    background-color: grey;
    color: black;
    font-weight: bold;
}
.red-tooltip + .tooltip > .tooltip-inner {background-color:#104e8b ;}
#show-row:hover {
    background-color: #444444;
}
</style>

<body>
          <div class="container">
            <?php
            $attributes = array("class" => "form-horizontal", "id" => "employeeform", "name" => "employeeform");
            echo form_open("report/index", $attributes);?>
            <fieldset>
            <div class="col-sm-offset-1 col-lg-8 col-sm-8 text-left">

                 <div class="form-group">
                <div class="row colbox">
                <!--div class="col-lg-2 col-sm-2">
                    <label for="reporttype" class="control-label">Report Type</label>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <select name="reporttype" class="form-control" id="reporttype">
                                <option value="-SELECT-">-SELECT-</option>
                                <option value="1">Collection Report</option>
                                <option value="2">Estimate Report</option>
                    </select>
                    <span class="text-danger"><?php echo form_error('reporttype'); ?></span>
                </div-->
	<?php //print_r($record); echo $record['park'];
	if(!empty($record)){
	$p_type = $record['park'];
	$f_date = $record['fdate'];
	$t_date = $record['tdate'];
	$s_type = $record['slab'];
	}else{
	$p_type="";		$s_type = '';		$f_date = date('Y-m-d');		$t_date = date('Y-m-d');
	}
	?>
                <div class="col-lg-2 col-sm-2">
                    <label for="parktype" class="control-label">Parking Type</label>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <?php
                    $attributes = 'class = "form-control" id = "parktype" ';
                    echo form_dropdown('parktype',$parktype,set_value('parktype',$data['ptype']),$attributes);?>
                    <span class="text-danger"><?php echo form_error('parktype'); ?></span>
                </div>

                </div></div>

               <div class="form-group">
                <div class="row colbox">
                <div class="col-lg-2 col-sm-2">
                    <label for="fromdate" class="control-label">From Date</label>
                </div>
                <div class="col-lg-4 col-sm-4">
                <input type="text" placeholder = "From Date" name = "fromdate" id="datepicker" class="datepicker" value="<?php  echo $data['fdate'];?>"/>
                <span class="fa fa-calendar fa-2x"></span></div>
                <div class="col-lg-2 col-sm-2">
                    <label for="fromtime" class="control-label">From Time</label>
                </div>
                <div class="col-lg-2 col-sm-2">
                    <?php
                    $attributes = 'class = "form-control" id = "fromtime" ';
                    echo form_dropdown('fromtime',$fromtime,set_value('fromtime',$data['ftime']),$attributes);?>
              </div>
                 </div>
                </div>


                <div class="form-group">
                <div class="row colbox">
                <div class="col-lg-2 col-sm-2">
                    <label for="todate" class="control-label">To Date</label>
                </div>
                <div class="col-lg-4 col-sm-4">
                <input type="text" id="datepicker1"  placeholder = "To Date"  name = "todate" class="datepicker" value="<?php  echo $data['tdate'];?>"/>
                <span class="fa fa-calendar fa-2x"></span></div>
                <div class="col-lg-2 col-sm-2">
                    <label for="totime" class="control-label">To Time</label>
                </div>
                <div class="col-lg-2 col-sm-2">
                    <?php
                    $attributes = 'class = "form-control" id = "totime" ';
                    echo form_dropdown('totime',$fromtime,set_value('totime',$data['ttime']),$attributes);?>
               </div>

                </div>
                </div>

                 

                <!-- <div class="form-group">
                <div class="row colbox">
                <div class="col-lg-2 col-sm-2">
                    <label for="slabtype" class="control-label">Slab Time</label>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <?php
                    $attributes = 'class = "form-control" id = "slabtime"';
                    echo form_dropdown('slabtime',$slabtime,set_value('slabtime',$s_type),$attributes);?>
                    <span class="text-danger"><?php echo form_error('slabtime'); ?></span>
                </div>
                </div></div> -->
            <div class="form-group"><input type="hidden" name="hdnAction" id="hdnAction" value=""/>
                <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Search" onclick="setHiddenValue('')"  />
 		<input id="btn_add" name="btn_add" type="submit" class="btn btn-danger" onclick="setHiddenValue('excel')" value="Export To Excel">
        <input id="btn_rep" name="btn_rep" type="button" class="btn btn-success" value="View Total Estimate">
<script type="text/javascript">
        function setHiddenValue($name) {
       // alert($name);
        document.getElementById('hdnAction').value=$name;
    } 
</script>
<!--	<a href="#" onClick ="$('#dataTables-example').tableExport({type:'excel',escape:'false'});">XLS</a>
	<a href="#" onClick ="$('#dataTables-example').tableExport({type:'csv',escape:'false'});">CSV</a>
	<a href="#" onClick ="$('#dataTables-example').tableExport({type:'pdf',pdfFontSize:'10',tableName:'SONALI',pdfLeftMargin:20,escape:'false'});">PDF</a>-->
            </div>
            </div>
            </fieldset>
            <?php echo form_close(); ?><?php echo $this->session->flashdata('msg'); ?>
            </div>
            <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading" id = "export-button">
                        Estimate Report
                  </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
			<thead style="background-color:#ECF0F5;">
                         <tr>
                              <th>#</th>
                              <th>Vehicle Number</th>
                              <th>Container No.</th>
                              <th>Vehicle Type</th>
                              <th>Check In</th>
                              <th>Check Out</th>
                              <th>Charges</th>
                         </tr>
                    </thead>
                    <tbody>
                         <?php $charges_t = 0;$in_count=0;
                                for ($i = 0; $i < count($report_data); ++$i) {  ?>
                              <tr id="hide-row_<?php echo $i;?>" class="hiderow">
                                   <td><?php echo $report_data[$i]->pid; ?></td>
                                   <td><?php echo $report_data[$i]->noplate; ?></td>
                                   <td><?php echo $report_data[$i]->containerno; ?></td>
                                   <td><?php echo $report_data[$i]->name; ?></td>
                                   <td><?php echo $report_data[$i]->intime; ?></td>
                                   <td><?php echo $report_data[$i]->outtime; ?></td>
                         <?php $charges = $report_data[$i]->charges;
                                $charges_t = $charges_t + $charges;
			
			$in = $report_data[$i]->intime; 
			/*$out = date('Y-m-d H:i:s',time());   
			$date_a = strtotime($in); 
			$date_b = strtotime($out); 
			#$interval = date_diff($date_a,$date_b); echo $hours = $interval->format('%h:%i:%s'); $h = $interval->format('%h'); $m = $interval->format('%i');
			$interval = abs($date_b - $date_a);
			$hrs = round($interval /(60*60));
			$minutes   = round($interval / 60);*/
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


		$sql = "select charges from charges where typeid = '{$report_data[$i]->typeid}'";
                $query = $this->db->query($sql);
                $result = $query->result();
                $result1 = array();
                foreach ($result as $key => $value) {
                    $result1['charges'] = $value->charges;
                }
                $charges =$result1['charges'];

		$tot_str = $hrs.'.'.$minutes;
                $hour_in_float = (float)$tot_str;
                $total_charges = (ceil($hour_in_float/8))*$charges;
		?>
                                   <td><?php echo $total_charges; ?></td>
                              </tr>
		<?php $charges_t = $charges_t + $total_charges;
                
			 }
                         ?>
                    </tbody>
                        <tr id="show-row" name="show" data-original-title="Click Here To show details" data-toggle="tooltip" data-placement="bottom" title=""  class="red-tooltip">
			<td>Total </td><td>IN (<?php echo $i; ?>)</td><td></td><td colspan=2></td><td></td><td><?php echo $charges_t; ?>
                    </table>
                </div>             <!-- /.table-responsive -->
                                     </div>            <!-- /.panel-body -->
        </div>        <!-- /.panel -->
    </div>
    <!-- /.col-lg-6 -->
</div><!-- /.row -->
          </div>
    <!-- jQuery -->

        <script src="<?php echo base_url('assets/newjq/jquery-ui.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/metisMenu/dist/metisMenu.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/dist/js/sb-admin-2.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/dist/js/jquery.base64.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/dist/js/tableExport.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/dist/js/jspdf/jspdf.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/dist/js/jspdf/libs/sprintf.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/dist/js/jspdf/libs/base64.js'); ?>"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });

        document.getElementById("btn_rep").onclick = function () {
                location.href = "<?php echo site_url(); ?>/report";
        };

        $('#fromtime').on('change', function() {
            if(this.value){
             $("#slabtime").prop('disabled', true);
            }else{ 
                 $("#slabtime").prop('disabled', false);
            }
         });

$('#totime').on('change', function() {
  var fromtime = $('#fromtime').val();
  var fromdate = $('#datepicker').val();
  var todate = $('#datepicker1').val();
   
  if(fromtime > this.value  && todate <= fromdate){
    alert("to date should be greater than from date");
    $("#btn_add").prop('disabled', true);
  }else{ $("#btn_add").prop('disabled',false); }
  
});

$('#datepicker').on('change', function() {
  var fromtime = $('#fromtime').val();
  var totime = $('#totime').val();
  var todate = $('#datepicker1').val();
   //alert(this.value);
  if(fromtime > totime  && todate <= this.value){
    alert("to date should be greater than from date");
    $("#btn_add").prop('disabled', true);
  }else{ $("#btn_add").prop('disabled',false); }
  
});

$('#datepicker1').on('change', function() {
  var fromtime = $('#fromtime').val();
  var totime = $('#totime').val();
  var fromdate = $('#datepicker').val();
   //alert(this.value);
  if(fromtime > totime  && fromdate >= this.value){
    alert("to date should be greater than from date");
    $("#btn_add").prop('disabled', true);
  }else{ $("#btn_add").prop('disabled',false); }
  
});


    });
    </script>

</body>

</html>
