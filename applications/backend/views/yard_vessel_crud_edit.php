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

<body>
          <div class="container">
           <?php  
            $attributes = array("class" => "form-horizontal", "id" => "employeeform", "name" => "employeeform");
            echo form_open(site_url('yard_vessel/edit/'.$result[0]->id), $attributes);?>
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
                    echo form_dropdown('yard_id',$yard,set_value('yard_id',$result[0]->yard_id),$attributes);?>
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
                    <input id="vessel" name="vessel" placeholder="Vessel no" type="text" class="form-control" value="<?php echo $result[0]->vessel_name;?>" />
                    <input id="vessel_hidden" name="vessel_hidden" value="<?php echo $result[0]->vessel_id;?>" hidden/>
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
                    <input id="alloted_slot" name="alloted_slot" placeholder="Allot Slots" type="text" class="form-control" value="<?php echo $result[0]->alloted_slot;?>" />
                    <span class="text-danger"><?php echo form_error('alloted_slot'); ?></span>
                </div>
                </div>
                </div>

                <div class="form-group">
                <div class="col-sm-offset-2 col-lg-8 col-sm-8 text-left">
                    <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Save" />
                    <input id="btn_cancel" name="btn_cancel" type="reset" class="btn btn-danger" value="Cancel" />
                 
                </div>
                </div>

            </fieldset>
            <?php echo form_close(); ?>
            <?php echo $this->session->flashdata('msg'); ?>

        </div>        <!-- /.panel -->
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

    <!-- jQuery -->
        <script src="<?php echo base_url('assets/newjq/jquery-ui.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/metisMenu/dist/metisMenu.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/dist/js/sb-admin-2.js'); ?>"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
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


                  }   
              });

      });
      
      $("#btn_add").click(function(e){
           
          var remains = $('#remaining_slots').text();
          var alloted = $("#alloted_slot").val();
          if(alloted > remains){
            alert("text");
            e.preventDefault();
          }else{
            $("yardform")[0].submit();
          }
      });
      
      $("#btn_cancel").click(function(){
        window.location.href = "<?php echo site_url('yard_vessel/index');?>";
      });

    });
    </script>

</body>

</html>
