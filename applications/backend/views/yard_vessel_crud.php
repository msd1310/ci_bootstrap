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
            echo form_open("yard_vessel/index", $attributes);?>
            <?php echo $this->session->flashdata('msg_success'); ?>
            <fieldset>

                
                <div class="form-group">
                <div class="row colbox">
                <div class="col-lg-2 col-sm-2">
                    <label for="parktype" class="control-label">Yard Select</label>
                </div>
                <div class="col-lg-4 col-sm-4">

                    <?php
                    $attributes = 'class = "form-control" id = "yard_id" required="required" ';
                    echo form_dropdown('yard_id',$yard,set_value('yard_id'),$attributes);?>
                    <span class="text-danger"><?php echo form_error('yard_id'); ?></span>
                </div>
                </div>
                </div>

                <div class="form-group">
                <div class="row colbox">
                <div class="col-lg-2 col-sm-2">
                    <label for="vessel" class="control-label">Vessel No. </label>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <input id="vessel" name="vessel" placeholder="Vessel no" type="text" class="form-control" required="required" />
                    <input id="vessel_hidden" name="vessel_hidden" hidden/>
                    <span class="text-danger"><?php echo form_error('vessel'); ?></span>
                </div>
                </div>
                </div>

                <div class="form-group">
                <div class="row colbox">
                <div class="col-lg-2 col-sm-2">
                    <label for="alloted_slot" class="control-label">Allot Slots</label>
                </div>
                <div class="col-lg-4 col-sm-4">
                    <input id="alloted_slot" name="alloted_slot" placeholder="Allot Slots" type="text" class="form-control" required="required"/>
                    <span class="text-danger"><?php echo form_error('alloted_slot'); ?></span>
                </div>
                </div>
                </div>

                <div class="form-group">
                <div class="col-sm-offset-2 col-lg-8 col-sm-8 text-left">
                     <input id="test_hidden" name="test_hidden" hidden/>
                    <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Save" />
                    <input id="btn_cancel" name="btn_cancel" type="reset" class="btn btn-danger" value="Cancel" />
                 
                </div>
                </div>

            </fieldset>
            <?php echo form_close(); ?>
            <input id="btn_slot" name="btn_slot" type="button" class="btn btn-danger" value="Generate Slot" />
            <?php echo $this->session->flashdata('msg'); ?>


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading" id = "export-button">
                Yard Vessel List
            </div>
                <div class="panel-body">
                <div class="dataTable_wrapper">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                 <thead style="background-color:#ECF0F5;">
                         <tr>
                              <th>#</th>
                              <th>Yard Type</th>
                              <th>Vessel Type</th>
                              <th>Alloted Slots</th>
                              <th>Edit</th>
                              <th>Delete</th>
                         </tr>
                    </thead>
                    <tbody><?php //print_r($record);?>
                    <?php for($i = 0;$i < count($record); $i++){ ?>
                    <tr><td><?php echo $i;?></td>
                        <td><?php echo $record[$i]->yard_name; ?></td>
                        <td><?php echo $record[$i]->vessel_name; ?></td>
                        <td><?php echo $record[$i]->alloted_slot; ?></td>
                        <td><a href="<?php echo site_url('yard_vessel/edit'); ?>/<?php echo $record[$i]->id; ?>">Edit</a></td>
                        <td><a href="<?php echo site_url('yard_vessel/delete'); ?>/<?php echo $record[$i]->id; ?>">
                          Delete</a></td>
                     </tr>
                    <?php } ?>
                    </tbody>
                    </table>
                </div>             <!-- /.table-responsive -->
            </div>            <!-- /.panel-body -->
        </div>        <!-- /.panel -->
    </div>
  </div><!-- /.row -->

        </div>        <!-- /.panel -->
<script>
function doconfirm()
{
   var job=confirm("Are you sure to delete permanently?");
    if(job!=true)
    {
        return false;
    }
}
</script>
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Yard Details</h4>
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
       
       $('#vessel').attr('disabled',true);
       $('#alloted_slot').attr('disabled',true);

        $("#vessel").autocomplete({
        source: function (request, response) {
        $.ajax({
            url: "<?php  echo base_url(); ?>/index.php/account/getVesselList",
            type: 'POST',
            dataType: "json",
            data:{ search : $('#tags').val() },
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
        //$("#selected-customer").val(ui.item.label);
    },
    focus: function(event, ui) {
        event.preventDefault();
        $("#vessel").val(ui.item.label);
    }
});

        /*********on yard select******/
        
       $('#yard_id').change(function () {
           var typeFeed=$(this).val();
           if(typeFeed != ''){
             $('#vessel').attr('disabled',false);
             $('#alloted_slot').attr('disabled',false);
           
           var url = "<?php echo site_url('yard_vessel/getYardSlot');?>";
           /*$.get(url,function(res){

              alert(res);
           });*/
             $.ajax({
                  url:url,
                  type: 'POST',
                  dataType: "json",
                  data:{ search : typeFeed },
                  success: function (data) {
                          $('#myModal').modal('show');
                          $('#total_slots').text(data.total_slot);
                            $('#alloted_slots').text(data.alloted_slot);
                            $('#remaining_slots').text(data.remaining_slot);
                            $('#test_hidden').text(data.remaining_slot);

                  }   
              });
           }else{
            $('#vessel').attr('disabled',true);
             $('#alloted_slot').attr('disabled',true);
           }
      });/*
       $('#alloted_slot').keydown(function () {
          var val = $("#test_hidden").text();
          alert(val);
       });*/
      $("#btn_add").click(function(e){
           
          var remains = $('#remaining_slots').text();
          var alloted = $("#alloted_slot").val();
          if(alloted > remains){
              alert(remains); 
            e.preventDefault();
          }else{
            $("yardform")[0].submit();
          }
      });
      $("#btn_cancel").click(function(){
        window.location.href = "<?php echo site_url('yard_vessel/index');?>";
      });

      $("#btn_slot").click(function(){
       
             $.ajax({
                  url:"<?php echo site_url('plaza/generateSlot');?>",
                  type: 'POST',
                  dataType: "json",
                  success: function (data) {
                        alert("hello");
                  }   
              });

      });
      
    });
    </script>

</body>

</html>
