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
                    <label for="vessel" class="control-label">Vessel No. </label>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <input id="vessel" name="vessel" placeholder="Vessel no" type="text" class="form-control" required="required"  />
                    <input id="vessel_hidden" name="vessel_hidden" hidden/>
                    <input id="slot_hidden" name="slot_hidden" required="required" hidden/>
                    <span class="text-danger"><?php echo form_error('vessel'); ?></span>
                </div>
                </div>
                </div> -->

                <div class="form-group">
                <div class="row colbox">
                <div class="col-lg-4 col-sm-4">
                    <label for="containerno" class="control-label">Container No. </label>
                </div>
                <div class="col-lg-8 col-sm-8">
                    <input id="containerno" name="containerno" placeholder="Container no" type="text" class="form-control"  value="" />
                    <span class="text-danger"><?php echo form_error('containerno'); ?></span>
                    <input id="slot_hidden" name="slot_hidden" required="required" hidden/>
                </div>
                </div>
                </div>

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
                <div class="col-sm-3  blog-sidebar">
    <h3> Choose slots by clicking  the layout below:</h3>
    <div id="holder">
              <ul id="place">
        </ul>
    </div>
    <table style="width:500px;height:50px">
  <tbody>
  <tr>
    <td><dt class="skyblue">&nbsp;</dt></td><td><dd>- Alloted Slots</dd></td></tr><tr>
    <td><dt class="blue">&nbsp;</dt></td><td><dd>-  Booked Slots</dd></td>
  </tr><tr>
    <td><dt class="green">&nbsp;</dt></td><td><dd>- Selected Slots</dd></td></tr><tr>
    <td><dt class="red">&nbsp;</dt></td><td><dd>- Fulled Slots</dd></td></tr><tr>
    <td></td><td><dd></dd></td>
  </tr>
</tbody></table>
    </div>
        <div >
          <!-- <input id="btnShowNew" name="btnShowNew" type="button" class="btn btn-primary" value="Show Selected Seats" /> -->
        <!-- <input type="button" id="btnShow" value="Show All" />            -->
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
/*******************slots assign code***********************/


 var slot_data = new Array();
  slot_data = <?php echo json_encode($slot);?>;
  var yard_slots = new Array();
//alert(slot_data[0].name);

var settings = {
               rows: 6,
               cols: 10,
               rowCssPrefix: 'row-',
               colCssPrefix: 'col-',
               seatWidth: 40,
               seatHeight:40,
               seatCss: 'seat',
               selectedSeatCss: 'selectedSeat',
               assignedSeatCss: 'assignedSeat',
               selectingSeatCss: 'selectingSeat'
           };


          var init = function (reservedSeat,assignedSeat) {

                var str = [], seatNo, className;

                var rows_s = 6;
                var cols_s = slot_data.length/rows_s;


               for (i = 0; i < rows_s; i++) {
                    for (j = 0; j < cols_s; j++) {

                        seatNo = (i + j * rows_s + 1);
                        className = settings.seatCss + ' ' + settings.rowCssPrefix + i.toString() + ' ' + settings.colCssPrefix + j.toString();
                        if($.isArray(reservedSeat) && $.inArray(seatNo, reservedSeat) != -1) {
                            className += ' ' + settings.selectedSeatCss;
                        }
                        if($.isArray(assignedSeat) && $.inArray(seatNo, assignedSeat) != -1) {
                            className += ' ' + settings.assignedSeatCss;
                        }
                         if(seatNo <= (slot_data.length)){

                        str.push('<li class="' + className + '"' +
                                  /*'style="top:' + (i * settings.seatHeight).toString() + 'px;left:' + (j * settings.seatWidth).toString() + 'px">' +*/
                                  'style="top:' + (i * settings.seatHeight).toString() + 'px;left:' + (j * settings.seatWidth).toString() + 'px">' +
                                  '<a title="' + slot_data[seatNo - 1].id + '">' + slot_data[seatNo - 1].name + '</a>' +
                                  '</li>');
                        }

                    }
                }
                $('#place').html(str.join(''));

            };

            /*function demo(value){

                $.ajax({
                                                    url:"<?php echo site_url('back_slot/getVesselSlotDetails');?>",
                                                    type: 'POST',
                                                    dataType: "json",
                                                    data:{'vessel_id': value},
                                                    success: function (data) {
                                                             init(data.booked,data.packed);

                                                                $('.' + settings.seatCss).click(function () {
                                                              if ($(this).hasClass(settings.selectedSeatCss)){
                                                                    $('.' + settings.seatCss).removeClass(settings.selectingSeatCss);
                                                                   $(this).toggleClass(settings.selectingSeatCss);
                                                                   //alert($('#place li').attr('title'));
                                                                   $.each($('#place li.' + settings.selectingSeatCss + ' a'), function (index, value) {
                                                                        item = $(this).attr('title');
                                                                       $("#slot_hidden").val(item);
                                                                    });
                                                              }
                                                              else if ($(this).hasClass(settings.assignedSeatCss)){
                                                                   alert('Sorry,No space available');
                                                              }
                                                             else{
                                                                 alert('Slot is not alloted to vessel');
                                                                  }
                                                              });
                                                    }
                                     });
            }*/


                var booked ;
                $.ajax({
                  url:"<?php echo site_url('back_slot/getSlotDetails');?>",
                  type: 'POST',
                  dataType: "json",
                  success: function (data) {
                           //alert(data.booked);
                           init(data.booked,data.fulled);
                           $('.' + settings.seatCss).click(function () {
                                                              if ($(this).hasClass(settings.selectedSeatCss)){
                                                                    $('.' + settings.seatCss).removeClass(settings.selectingSeatCss);
                                                                   $(this).toggleClass(settings.selectingSeatCss);

                                                                   $.each($('#place li.' + settings.selectingSeatCss + ' a'), function (index, value) {
                                                                        item = $(this).attr('title');
                                                                       $("#slot_hidden").val(item);
                                                                    });
                                                              }
                                                              else if ($(this).hasClass(settings.assignedSeatCss)){
                                                                   alert('Sorry,No space available');
                                                              }
                                                             else{
                                                                 alert('Slot is not alloted to yard');
                                                                  }
                                                              });

                  }
                });


$('#btnShow').click(function () {
    var str = [];
    $.each($('#place li.' + settings.selectedSeatCss + ' a, #place li.'+ settings.selectingSeatCss + ' a'), function (index, value) {
        str.push($(this).attr('title'));
    });
    alert(str.join(','));
})

 var slots = [];
$('#btnShowNew').click(function () {
    var str = [], item;
    $.each($('#place li.' + settings.selectingSeatCss + ' a'), function (index, value) {
        item = $(this).attr('title');
        str.push(item);

        slots.push(item);
    });
    alert(str.join(','));
})

});
    </script>


<style type="text/css">

.skyblue {
        background:#B9DEA0;
        border: 1px solid #000;
        color: #000;
        width: 15px;
        height: 15px;
        }
.blue {
        background:#A67585;
        border: 1px solid #000;
        color: #000;
        width: 15px;
        height: 15px;
        }
.green {
        background:#3a78c3;
        border: 1px solid #000;
        color: #000;
        width: 15px;
        height: 15px;
        }
.purple {
        background:#9C449D;
        border: 1px solid #000;
        color: #000;
        width: 15px;
        height: 15px;
        }
  .grey {
        background:grey;
        border: 1px solid #000;
        color: #000;
        width: 15px;
        height: 15px;
        }
  .red {
        background:red;
        border: 1px solid #000;
        color: #000;
        width: 15px;
        height: 15px;
        }

#wrapper{
    margin:0 -135px;
}
#page-wrapper{
    width:100%;
}
#holder{
height:40%;
width:200%;
background-color:#F5F5F5;
border:1px solid #A4A4A4;
margin-left:10px;
}
#place {
position:relative;
margin:20px;
}
#place a{
font-size:12px;
color: #000;
margin-left: 2px;
}
#place li
{
 list-style: none outside none;
 position: absolute;
 margin: 10px;
}
#place li:hover
{
background-color:green;
}
#place .seat{
/*background:url("../../assets/images/slot_p.png") no-repeat scroll 0 0 transparent;*/
height:30px;
width:30px;
display:block;
background-color: #B9DEA0;
border-radius: 5px;
}
#place .selectedSeat
{
/*background-image:url("images/booked_seat_img.gif");
*/
background-color: #A67585;
}
#place .selectingSeat
{
/*background-image:url("images/selected_seat_img.gif");        */
background-color: #3a78c3;
}
#place .assignedSeat
{
/*background-image:url("images/booked_seat_img.gif");
*/
background-color: red;
}
/*#place .row-3, #place .row-4{
margin-top:10px;
}*/
#seatDescription li{
verticle-align:middle;
list-style: none outside none;
padding-left:35px;
height:35px;
float:left;
}

</style>
</body><?php include('footer.php'); ?>


</html>
