<html>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap Core CSS -->
  <link href="<?php echo base_url('assets/data/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
      <!-- MetisMenu CSS -->
      <link href="<?php echo base_url('assets/data/bower_components/metisMenu/dist/metisMenu.min.css'); ?>" rel="stylesheet">
  <!-- Custom CSS -->
<link href="<?php echo base_url('assets/data/dist/css/sb-admin-2.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/data/bower_components/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
  <!-- Custom Fonts -->
<link href="<?php echo base_url('assets/newjq/jquery-ui.min.css'); ?>" rel="stylesheet">




<?php
      require_once 'Paginator.class.php';

      $conn       = new mysqli( '127.0.0.1', 'root', 'MahitNahi', 'testing' );

      $limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 1;
      $page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
      $links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;
      $query = "SELECT pid,noplate,intime,outtime,hours,charges,status,typeid,id,confirm,status from park where status = 0 order by id asc";

      $Paginator  = new Paginator( $conn, $query );

      $results    = $Paginator->getData( $page, $limit );

  ?>



<body>
<div class="panel panel-primary">


    <div class="panel-heading">
       <h1 class="panel-title"><center>Information Form</center></h1>

  </div>

   <div class="text-center">

    <br>

<div class="form-group">
  <div class="row colbox">
  <div class="col-lg-2 col-sm-2">

      <label for="noplate" class="control-label">Search</label>
  </div>
  <div class="col-lg-2 col-sm-2">
      <input id="noplate"  name="noplate" placeholder="noplate" type="text"  class="form-control" keyup=""  required="required" />
      <input id="noplate_hidden" name="noplate_hidden" hidden/>


      <span class="text-danger"><?php echo form_error('noplate'); ?></span>


  </div>
  </div>
  </div>

       <div class="panel-body">
         <table class="table" table align="center" table width="600" border="1" cellpadding="2" id="mytable">
           <thead style="background-color: aliceblue;">

             <tr>
                 <th style="width:10%;">Receipt No.</th>
                 <th>Vehicle No.</th>
                 <th style="width:20%;">Status</th>
                 <th>Update</th>
             </tr>
         </thead>
         <tbody>



           <?php for( $i = 0; $i < count( $results->data ); $i++ ) : ?>
               <tr class="odd gradeX">
                   <td><?php echo $results->data[$i]['pid']; ?></td>
                   <td><?php echo $results->data[$i]['noplate']; ?></td>
                   <td><?php if($results->data[$i]['status'] == 1){echo $check_status = "OUT";}else{echo $check_status = "IN";} ; ?></td>
<td>

<a href=updateEmployee/<?php echo $results->data[$i]['pid']; ?> >
<?php if($results->data[$i]['status'] == 1){ ?>
<input type="button" class="btn btn-success btn-md" onclick="<a href=updateEmployee/<?php echo $results->data[$i]['pid']; ?>>" value="Details" >
<?php }else{ ?>
<input type="button" class="btn btn-primary btn-md" onclick="<a href=updateEmployee/<?php echo $results->data[$i]['pid']; ?>>" value="Check Out" >
<?php } ?>
</a>


<?php
 $in = $results->data[$i]['intime'];
                 $out = date('Y-m-d H:i:s',time());
                 $date_a = strtotime($in);
                 $date_b = strtotime($out);
                 #$interval = date_diff($date_a,$date_b); echo $hours = $interval->format('%h:%i:%s'); $h = $interval->format('%h'); $m = $interval->format('%i');
                 $interval = abs($date_b - $date_a);
                 $hrs = round($interval /(60*60));
                 $minutes   = round($interval / 60);

$tot_str = $hrs.'.'.$minutes;
if( (	$results->data[$i]['status']) == 0){
if($tot_str >= "24.00" and ($results->data[$i]['confirm']) != 1){ ?>
<i class="fa fa-spinner fa-spin" style="color:red"></i>
<a href="<?php echo site_url();?>/account/updateConfirm/<?php echo $results->data[$i]['pid']; ?>">Alert</a>
<!--span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span><a href="<?php echo site_url();?>/account/update">Click</a-->
<?php	}
}
?>
                         </td>
                     </tr>
                     <?php endfor; ?>
                     </tbody>
                   </table>
                   <div class="center">
                     <button  id="previous" class="btn btn-sm btn-primary">Previous</button>
                      <lable>Page <lable id="page_number"></lable> of <lable id="total_page"></lable></lable>
                      <button  id="next" class="btn btn-sm btn-primary">Next</button>
                      <div class="col-md-4 pull-right">
                        <ul class="nav navbar-nav pull-right">
                                    <li class="active"><a href="<?php echo base_url() ?>index.php/account/ExportToExcel"><i class="glyphicon glyphicon-log-in"></i>&nbsp;&nbsp;Export Excel</a></li>
                                </ul>




             </div>
             </div>


         </div>             <!-- /.table-responsive -->
    </div>            <!-- /.panel-body -->
 </div>        <!-- /.panel -->
</div>
<!-- /.col-lg-6 -->
</div><!-- /.row -->
</div><!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<style>
.glyphicon-refresh-animate {
-animation: spin .7s infinite linear;
-webkit-animation: spin2 .7s infinite linear;
}

@-webkit-keyframes spin2 {
from { -webkit-transform: rotate(0deg);}
to { -webkit-transform: rotate(360deg);}
}

@keyframes spin {
from { transform: scale(1) rotate(0deg);}
to { transform: scale(1) rotate(360deg);}
}
.fa-spin-custom, .glyphicon-spin {
-webkit-animation: spin 1000ms infinite linear;
animation: spin 1000ms infinite linear;
}
@-webkit-keyframes spin {
0% {
 -webkit-transform: rotate(0deg);
 transform: rotate(0deg);
}
100% {
 -webkit-transform: rotate(359deg);
 transform: rotate(359deg);
}
}
@keyframes spin {
0% {
 -webkit-transform: rotate(0deg);
 transform: rotate(0deg);
}
100% {
 -webkit-transform: rotate(359deg);
 transform: rotate(359deg);
}
}




</style>


<!-- Page-Level Demo Scripts - Tables - Use for reference -->






     <!-- /.row -->
 </div>
 <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>


<!-- Page-Level Demo Scripts - Tables - Use for reference -->





<script>

  $(document).ready(function() {
   // To searchtable
//       searchTable($(this).val());

//Pagination to html table

          var page_number=0;
          var total_page =null;
          var pid =0;
          var pid_no =0;


                 var getReport = function(page_number){
                    if(page_number==0){
                      $("#previous").prop('disabled', true);}
                     else{
                     $("#previous").prop('disabled', false);}

                 if(page_number==(total_page-1)){
                   $("#next").prop('disabled', true);}
                   else{
                     $("#next").prop('disabled', false);}

                 $("#page_number").text(page_number+1);

                  $.ajax({
                      url:"<?php echo base_url() ?>index.php/account/pagination",
                      type:"POST",
                      dataType: 'json',
                      data:'page_number='+page_number,
                      success:function(result){
                          window.mydata = result;
                           total_page= mydata[0].TotalRows;
                          $("#total_page").text(total_page);
                          var record_per_page = mydata[0].Rows;
                          $("#mytable").empty();
                          $("#mytable").html('<thead style="background-color: aliceblue;"><tr><th>Receipt No.</th><th>Vehicle No</th><th>Status</th><th>Update</th></tr></thead>');


                           $.each(record_per_page, function (key, result) {
                                pid =(key+1);

                                $("#mytable").append("<tr><td>"+result.pid+"</td><td>"+result.noplate+"</td><td>IN</td><td><a href=updateEmployee/"+result.pid+"><input type='button' class='btn btn-primary btn-md' value='check out' /></a></td></tr>");

                            });
                       }
                  });
                };




        $(document).ready(function(){

           getReport(page_number);
           console.log(pid);

          $("#next").on("click", function(){
                $("#mytable").html("");
                page_number = (page_number+1);
                getReport(page_number);
                console.log(pid);

          });

          $("#previous").on("click", function(){
               $("#mytable").html("");
               page_number = (page_number-1);
               getReport(page_number);
          });



     });





 $("#noplate").keyup(function(){

    loaddata();

function loaddata(){
var id = $("input#id").val();
var noplate = $("input#noplate").val();



var dataString = 'id='+ id + '&noplate=' + noplate ;

$.ajax({
type: "POST",
url: "<?php  echo base_url(); ?>/index.php/account/getnoplate",
data: dataString,
success: function(result) {


// $("#mytable").html("<tr><td>"+result.pid+"</td></tr>");
    $("#mytable").empty();
      $("#mytable").append("<thead style='background-color: aliceblue;'><tr><th>Receipt No.</th><th>Vehicle No.</th><th>Status</th><th>Update</th></tr></thead>");
 $.each(JSON.parse(result), function(key,value) {
        var status = value.status;
$("#mytable").append("<tr><td>"+value.pid+"</td><td>"+value.noplate+"</td><td>IN</td><td><a href=updateEmployee/"+value.pid+"><input type='button' class='btn btn-primary btn-md' value='check out' /></a></td></tr>");


  });
}
});
}
});

/*
//$('#noplate').keyup(function(){

   //  searchTable($(this).val());
   //  done();
     //  updates();


function done() {
	  setTimeout( function() {
	  updates();
	  done();
  }, 10000);
}

function updates() {

	 $.getJSON("<?php  echo base_url(); ?>/index.php/account/Get_All", function(data) {
       $("ul").empty();
	     $.each(data.result, function(){
	     $("ul").append('<?php  echo base_url(); ?>/index.php/account/Get_All');
	   });
 });
}
});

function searchTable(inputVal)
{
var table = $('#mytable');
table.find('tr').each(function(index, row)
{
  var allCells = $(row).find('td');
  if(allCells.length > 0)
  {
    var found = false;
    allCells.each(function(index, td)
    {
      var regExp = new RegExp(inputVal, 'i');
      if(regExp.test($(td).text()))
      {
        found = true;
        return false;
      }
    });
    if(found == true)$(row).show();else $(row).hide();
  }
});
}

/*


     $("#noplate").autocomplete({
    source: function (request, response) {
    $.ajax({
        url:"<?php  echo base_url(); ?>/index.php/account/getnoplate",
        type: 'POST',
        dataType: "json",
        data:{ search : $('#park').val() },
        success: function (data) {
                 response($.map(data, function(v,i){
                    return {
                                label: v.noplate,
                                value: v.id
                               };
                }));

        }
    });
         },
      select:function(event, ui) {
    event.preventDefault();
    $("#noplate").val(ui.item.name); //alert(ui.item.value);
    $("#noplate_hidden").val(ui.item.value);
    //$("#selected-customer").val(ui.item.label);
    },
    focus: function(event, ui) {
    event.preventDefault();
    $("#noplate").val(ui.item.label);
  }
});
*/
});
  </script>



</body>
</html>
