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
   <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"> -->

    <!-- DataTables Responsive CSS -->
<link href="<?php echo base_url('assets/data/bower_components/datatables-responsive/css/dataTables.responsive.css'); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
<link href="<?php echo base_url('assets/data/bower_components/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">

<link href="<?php echo base_url('assets/newjq/jquery-ui.min.css'); ?>" rel="stylesheet">

<body>
  <div class="container">
  <?php  
            $attributes = array("class" => "form-horizontal", "id" => "yardform", "name" => "yardform");
            echo form_open("yard_slot/index", $attributes);?>
            <?php echo $this->session->flashdata('msg_success'); ?>
            <fieldset>

                
                <div class="form-group">
                <div class="row colbox">
                <div class="col-lg-2 col-sm-2">
                    <label for="parktype" class="control-label">Yard Select</label>
                </div>
                <div class="col-lg-4 col-sm-4">

                    <?php
                    $attributes = 'class = "form-control" id = "yard" required="required" ';
                    echo form_dropdown('yard',$yard,set_value('yard'),$attributes);?>
                    <span class="text-danger"><?php echo form_error('yard'); ?></span>
                </div>
                </div>
                </div>


                <div class="form-group">
                <div class="row colbox">
                <div class="col-lg-2 col-sm-2">
                    <label for="parktype" class="control-label">Vessel Select</label>
                </div>
                <div class="col-lg-4 col-sm-4">

                    <?php
                    $attributes = 'class = "form-control" id = "vessel" required="required" ';
                    echo form_dropdown('vessel',$vessel,set_value('vessel'),$attributes);?>
                    <span class="text-danger"><?php echo form_error('vessel'); ?></span>
                </div>
                </div>
                </div>
      
<h3> Choose slots by clicking the corresponding slots in the layout below:</h3>
    <div id="holder"> 
        <ul  id="place">
        </ul>   
    </div>
    <table style="width:800px;height:50px">
  <tbody>
  <tr>
    <td><dt class="skyblue">&nbsp;</dt></td><td><dd>- Available Slots</dd></td>
    <td><dt class="blue">&nbsp;</dt></td><td><dd>-  Booked Slots</dd></td>
  </tr><tr>
    <td><dt class="green">&nbsp;</dt></td><td><dd>- Selected Slots</dd></td>
    <td><dt class="purple">&nbsp;</dt></td><td><dd>- Slots alloted to selected vessel</dd></td>
  </tr><tr>
    <td><dt class="grey">&nbsp;</dt></td><td><dd>- Slots available from selected yard</dd></td>
    <td><dt> &nbsp;</dt></td><td><dd></dd></td>
  </tr>
</tbody></table>
        <div style="clear:both;width:100%">
        <input id="btnShowNew" name="btnShowNew" type="button" class="btn btn-primary" value="Show Selected Seats" />        
        </div>

    <div class="form-group">
                <div class="col-sm-offset-2 col-lg-8 col-sm-8 text-left">
                     <input id="test_hidden" name="test_hidden" hidden/>
                    
                 <input id="btn_slot" name="btn_slot" type="button" class="btn btn-success" value="Generate Slot" />
                    <input id="btn_cancel" name="btn_cancel" type="reset" class="btn btn-danger" value="Cancel" />
                </div>
                </div>

            </fieldset>
            <?php echo form_close(); ?>
            <?php echo $this->session->flashdata('msg'); ?></div>
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
 -->    <!-- jQuery -->
        <script src="<?php echo base_url('assets/newjq/jquery-ui.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/metisMenu/dist/metisMenu.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/dist/js/sb-admin-2.js'); ?>"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
       
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
               seatHeight: 40,
               seatCss: 'seat',
               selectedSeatCss: 'selectedSeat',
               assignedSeatCss: 'assignedSeat',
               selectingSeatCss: 'selectingSeat',
               vesseledSeatCss: 'vesseledSeat'
           };


          var init = function (reservedSeat,assignedSeat,vesseledSeat) {

                var str = [], seatNo, className;
             
                var rows_s = 6;
                var cols_s =  Math.ceil(slot_data.length/rows_s); 

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
                        if($.isArray(vesseledSeat) && $.inArray(seatNo, vesseledSeat) != -1) {
                            className += ' ' + settings.vesseledSeatCss;
                        }
                         if(seatNo <= (slot_data.length)){
                        str.push('<li class="' + className + '"' +
                                  'style="top:' + (i * settings.seatHeight).toString() + 'px;left:' + (j * settings.seatWidth).toString() + 'px">' +
                                  '<a title="' + slot_data[seatNo - 1].id + '">' + slot_data[seatNo - 1].name + '</a>' +
                                  '</li>');
                        }
                    }
                }
                $('#place').html(str.join(''));
             
            };
          var booked ;
                $.ajax({
                  url:"<?php echo site_url('plaza/getSlotDetails');?>",
                  type: 'POST',
                  dataType: "json",
                  success: function (data) {
                           //alert(data.booked);
                           init(data.booked,null,null);
                           $('#yard').on('change', function() {
  
                                   // alert( this.value );
                                    $.ajax({
                                                    url:"<?php echo site_url('plaza/getYardSlotDetails');?>",
                                                    type: 'POST',
                                                    dataType: "json",
                                                    data:{'yard_id':this.value},
                                                    success: function (data) {
                                                             init(data.booked,data.assigned,null);



                            $('.' + settings.seatCss).click(function () {
                          if ($(this).hasClass(settings.assignedSeatCss)){
                                $(this).removeClass(settings.assignedSeatCss);
                               $(this).toggleClass(settings.selectingSeatCss);
                          }
                          else if ($(this).hasClass(settings.selectedSeatCss)){
                                alert('Slot is already assigned');
                          }
                          else{
                             alert('Slot is not alloted to yard');
                              }
                          });
                                                    }   
                                     });

                                  });
                          
                  }   
                });
                  $('#vessel').on('change', function() {
  
                                   // alert( this.value );
                                    $.ajax({
                                                    url:"<?php echo site_url('plaza/getYardSlotDetails');?>",
                                                    type: 'POST',
                                                    dataType: "json",
                                                    data:{'vessel_id':this.value,'yard_id':$('#yard').val()},
                                                    success: function (data) {
                                                             init(data.newbooked,data.assigned,data.vesseled);

                                                          $('.' + settings.seatCss).click(function () {
                                                        if ($(this).hasClass(settings.assignedSeatCss)){
                                                              $(this).removeClass(settings.assignedSeatCss);
                                                             $(this).toggleClass(settings.selectingSeatCss);
                                                        }
                                                        else if ($(this).hasClass(settings.vesseledSeatCss)){
                                                              alert('Slot is already assigned to selected vessel');
                                                        }
                                                        else if ($(this).hasClass(settings.selectedSeatCss)){
                                                              alert('Slot is already assigned');
                                                        }
                                                        else{
                                                           alert('Slot is not alloted to yard');
                                                            }
                                                        });
                                          }   
                                    });

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
      

      /*****************save yard-slot in table**********/

      $("#btn_slot").click(function(){

        $.each($('#place li.' + settings.selectingSeatCss + ' a'), function (index, value) {
        item = $(this).attr('title');                   
               slots.push(item);                 
        });
         //alert(slots);
             $.ajax({
                  url:"<?php echo site_url('yard_slot/saveYardVesselSlot');?>",
                  type: 'POST',
                  data:{'yard_id':$('#yard').val(),'slotArray':slots,'vessel_id':$('#vessel').val()},
                  dataType: "json",
                  success: function (data) {
                        alert("Slots Assigned Succesfully");
                  }   
              });
              location.href = "<?php echo site_url('yard_slot/insertVessel');?>";
      });

      
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
        background:#6E4653;
        border: 1px solid #000;
        color: #000;
        width: 15px;
        height: 15px;
        }
.green {
        background:#A63522;
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
        background:#A496DD;
        border: 1px solid #000;
        color: #000;
        width: 15px;
        height: 15px;
        }

#holder{    
height:340px;    
width:50%;
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
#place .vesseledSeat
{ 
background-color: #9C449D;
}
#place .selectedSeat
{ 
/*background-image:url("images/booked_seat_img.gif");          
*/
background-color: #6E4653;
}
#place .selectingSeat
{ 
/*background-image:url("images/selected_seat_img.gif");        */
background-color: #A63522;
}

#place .assignedSeat
{ 
/*background-image:url("images/booked_seat_img.gif");          
*/
background-color: #A496DD;
}
#place .row-3, #place .row-4{
margin-top:10px;
}
#seatDescription li{
verticle-align:middle;    
list-style: none outside none;
padding-left:35px;
height:35px;
float:left;
}
    </style>

</body>

</html>
