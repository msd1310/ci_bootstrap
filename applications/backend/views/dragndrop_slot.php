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
<div id="container">
  <div id="list">

    <div id="response"> </div>
    <ul>
          <?php 
            foreach($yard->result_array() as $row){
               //echo $row['yard_name'];
               $id = stripslashes($row['id']);
               $text = stripslashes($row['yard_name']);

               ?><div id="yard"><?php echo $id?> <?php echo $text; ?>
               <?php 
               
                  $this->db->select('s.id,s.name');
                  $this->db->from('slot_master as s');
                  $this->db->join('yard_slot as y', 'y.slot_id = s.id');
                  $this->db->where('y.yard_id',$id);
                  $query = $this->db->get();

                   foreach($query->result_array() as $row){
                       $id = stripslashes($row['id']);
                       $text = stripslashes($row['name']);
               ?>
            <li id="arrayorder_<?php echo $id ?>"><?php echo $id?> <?php echo $text; ?>
            <div class="clear"></div>
            </li>
            <?php
                } echo "</div>";
            }
            //print_r($yard->result_array());
          ?>
      </ul>
      </div>
      </div>
    <!-- jQuery -->
        <script src="<?php echo base_url('assets/newjq/jquery-ui.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/metisMenu/dist/metisMenu.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/dist/js/sb-admin-2.js'); ?>"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function(){
function slideout(){

setTimeout(function(){
$("#response").slideUp("slow", function () {
});

}, 2000);}

$("#response").hide();
$(function() {
$("#list ul").sortable({ opacity: 0.8, cursor: 'move', update: function() {

var order = $(this).sortable("serialize") + '&update=update';
$.post("updateDragList", order, function(theResponse){
$("#response").html(theResponse);
$("#response").slideDown('slow');
slideout();
});
}
});
});
});
    </script>
<style>
ul {
  padding:0px;
  margin: 0px;
}
#response {
  padding:10px;
  background-color:#9F9;
  border:2px solid #396;
  margin-bottom:20px;
}
#list li {
  margin: 0 0 3px;
  padding:8px;
  background-color:#333;
  color:#fff;
  list-style: none;

}
#yard {
  background-color:skyblue;
  color:#fff;
}
</style>
</body>

</html>
