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
<div class="row">
    <div class="col-lg-4">
        <?php $plaza_capacity = (count($plaza_slots) * 10); ?>
        <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#605CA8;color:#fff;"> PLAZA CAPACITY : <?php echo $plaza_capacity; ?></div>
        <div class="table-responsive">
<table class="table hover">
    <tr><th>Yard Name</th><th>Capacity</th><th>Occupied Space</th><th>Available Space</th></tr>
  <?php 
  
    $i = 1;$slots_total = 0;
    foreach ($yard as $value) {
        $i;
        $id = $value->id;
        $yard_name =  $value->yard_name;

        $this->db->select('ys.*,s.name');
        $this->db->from('yard_slot as ys');
        $this->db->where('ys.yard_id',$id);
        $this->db->join('slot_master as s', 'ys.slot_id = s.id');
        $query = $this->db->get();
        $result = $query->result();

        $slots = count($result);
        $capacity = $slots * 10;
    ?>
    <tr><td><b><?php echo $value->yard_name;?></b></td>
        <td><?php echo $capacity; ?> </td>
        <td><?php echo $value->total ;?></td>
        <td><?php echo ( $capacity - $value->total ) ;?></td>
    </tr>
    <?php   $i = $i+1;
        $slots_total = $slots_total + $capacity;
    }

?></table></div>
    <div class="panel-heading" style="background-color:grey;color:#fff;"> AVAILABLE SPACE : <?php echo ( $plaza_capacity - $slots_total); ?>
         <a style="color:#000" href="<?php echo site_url('yard_slot');?>">&nbsp;Click Here To Assign</a>
    </div>
   </div>
            </div>
    <div class="col-lg-4">
                   <div class="panel panel-default">
        <div class="panel-heading" style="background-color:#605CA8;color:#fff;">VESSELS DETAILS</div>
        <div class="table-responsive">
               <table class="table hover">
    <tr><th>Vessel Name</th><th>Capacity</th><th>Occupied Space</th><th>Available Space</th></tr>
  <?php 
  
    $i = 1;$slots_total = 0;
    foreach ($vessel as $value) {
        $i;
        $id = $value->id;
       
        $this->db->select('yvm.*,s.name');
        $this->db->from('yard_vessel_master as yvm');
        $this->db->where('yvm.vessel_id',$id);
        $this->db->join('slot_master as s', 'yvm.slot_id = s.id');
        $query = $this->db->get();
        $result = $query->result();

        $slots = count($result);
        $capacity = $slots * 10;
    ?>
    <tr><td><b><?php echo $value->vessel_name;?></b></td>
        <td><?php echo $capacity; ?> </td>
        <td><?php echo $value->total ;?></td>
        <td><?php echo ( $capacity - $value->total ) ;?></td>
    </tr>
    <?php   $i = $i+1;
        $slots_total = $slots_total + $capacity;
    }

?></table></div>
    <div class="panel-heading" style="background-color:grey;color:#fff;"> Assign Yards to vessels :
         <a style="color:#000" href="<?php echo site_url('yard_slot/insertVessel');?>">&nbsp;Click Here</a>
    </div>
                        </div>    
</div>


<div class="col-lg-4">
<div class="panel panel-default" >
                 <div class="panel-heading" style="background-color:#605CA8;color:#fff;" id = "export-button">
                        Detailed Yard-Vessel Slots
                  </div>
           <?php
    $i = 1;
    foreach ($yard as $value) {
        $i;
        $id = $value->id;
        $yard_name =  $value->yard_name;

        $this->db->select('v.vessel_name,vm.*');
        $this->db->from('vessel as v');
        $this->db->join('yard_vessel_master as vm', 'vm.vessel_id = v.id');
        $this->db->where('vm.yard_id',$id);
        $this->db->group_by('v.id'); 
                        
        $query = $this->db->get();
        $result = $query->result();


$this->db->from('yard_slot');
$this->db->where('yard_id',$id);
$query = $this->db->get();
$rowcount = $query->num_rows();

        $idd = 'tree'.$i;
    echo " <ul id='".$idd."' class='t_tree'><li ><a href='#' id='f_a'>".$yard_name."</a>";
        if(count($result) > 0){
            $s_tcount = 0;
            foreach ($result as $key => $value) {
                echo "<ul><li><a id='s_a'>".$value->vessel_name."<a>";
                $vid = $value->vessel_id;

                $this->db->select('ys.*,s.name');
                $this->db->from('yard_vessel_master as ys');
                $this->db->where('ys.vessel_id',$vid);
                $this->db->join('slot_master as s', 'ys.slot_id = s.id');
                $query = $this->db->get();
                $result = $query->result();
                
                $s_count = count($result);

                foreach ($result as $key => $value) {
                    echo "<ul><li id='t_li'><a id='t_a'>".$value->name."</a></li></ul>";
                }
                $s_tcount = $s_tcount + $s_count;
                echo "</li></ul>";

            }                /*echo "<ul><li><a>Available Slots</a>
                                    <ul><li>".($rowcount - $s_tcount)
                                    ."</li></ul></li></ul>";*/
                                    echo "<ul><li><a id='s_a'>Available Slots :</a>
                                    ".($rowcount - $s_tcount)
                                    ."</li></ul>";

        }else{

            $this->db->select('ys.*,s.name');
            $this->db->from('yard_slot as ys');
            $this->db->where('ys.yard_id',$id);
            $this->db->join('slot_master as s', 'ys.slot_id = s.id');
            $query = $this->db->get();
            $result = $query->result();
                if(count($result)>0){
                    foreach ($result as $key => $value) {
                        echo "<ul><li><a id='t_a'>".$value->name."</a></li></ul>";
                    }
                }else{
                    echo "<ul><li><a id='t_li'>Slots Not Assigned</a></li></ul>";
                }
                echo "</li></ul>";
        }
        $i = $i+1;
        echo "</li></ul>";
     }
    ?><hr>

 <div class="panel-heading" style="background-color:#CBC9C9;color:#fff;"> 
   <ul class="list-inline">
   <li id="f_a"> Available Slots</li>
   <li id="s_a"> Booked Slots</li>
   <li id="t_a"> Booked Slots</li>
</ul>
  </div>

</div>
<style type="text/css">

th {
    background-color: #4B4747;
    color: white;
} 
table {
        width: 100%;
    }

thead, tbody, tr, td{ display: block; }

tr:after {
    content: ' ';
    display: block;
    visibility: hidden;
    clear: both;
}

thead th {
    height: 30px;
}

tbody {
    height: 230px;
    overflow-y: auto;
}

thead {
    /* fallback */
}


tbody td, thead th {
    width: 25%;
    float: left;
}
***/

table {
    table-layout:fixed;
    }

.div-table-content {
  height:350px;
  overflow-y:auto;
  font-size: 22px;
}
  thead th {

      font-size: 18px;
      position: sticky;
      text-align:center;
  }
  tbody tr td {

  }
  table>thead:first-child>tr:first-child>th {
    padding-bottom: 1%;
  }
/***************/

        #f_a{
            color: blue;
        }
        #s_a{
            color: red;
        }
        #t_a{
            color: green;
        }
.tree, .tree ul {
    margin:0;
    padding:0;
    list-style:none
}
.tree ul {
    margin-left:1em;
    position:relative
}
.tree ul ul {
    margin-left:.5em
}
.tree ul:before {
    content:"";
    display:block;
    width:0;
    position:absolute;
    top:0;
    bottom:0;
    left:0;
    border-left:1px solid
}
.tree li {
    margin:0;
    padding:0 1em;
    line-height:2em;
    color:#369;
    font-weight:700;
    position:relative
}
.tree ul li:before {
    content:"";
    display:block;
    width:10px;
    height:0;
    border-top:1px solid;
    margin-top:-1px;
    position:absolute;
    top:1em;
    left:0
}
.tree ul li:last-child:before {
    background:#fff;
    height:auto;
    top:1em;
    bottom:0
}
.indicator {
    margin-right:5px;
}
.tree li a {
    text-decoration: none;
    color:#369;
}
.tree li button, .tree li button:active, .tree li button:focus {
    text-decoration: none;
    color:#369;
    border:none;
    background:transparent;
    margin:0px 0px 0px 0px;
    padding:0px 0px 0px 0px;
    outline: 0;
}
</style><script type="text/javascript">
$.fn.extend({
    treed: function (o) {
      
      var openedClass = 'glyphicon-minus-sign';
      var closedClass = 'glyphicon-plus-sign';
      
      if (typeof o != 'undefined'){
        if (typeof o.openedClass != 'undefined'){
        openedClass = o.openedClass;
        }
        if (typeof o.closedClass != 'undefined'){
        closedClass = o.closedClass;
        }
      };
      
        //initialize each of the top levels
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this); //li with children ul
            branch.prepend("<i class='indicator glyphicon " + closedClass + "'></i>");
            branch.addClass('branch');
            branch.on('click', function (e) {
                if (this == e.target) {
                    var icon = $(this).children('i:first');
                    icon.toggleClass(openedClass + " " + closedClass);
                    $(this).children().children().toggle();
                }
            })
            branch.children().children().toggle();
        });
        //fire event from the dynamically added icon
      tree.find('.branch .indicator').each(function(){
        $(this).on('click', function () {
            $(this).closest('li').click();
        });
      });
        //fire event to open branch if the li contains an anchor instead of text
        tree.find('.branch>a').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
        //fire event to open branch if the li contains a button instead of text
        tree.find('.branch>button').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
    }
});

//Initialization of treeviews
$('.t_tree').each(function(){
    $(this).treed();
});

/*$('#tree1').treed();

$('#tree2').treed({openedClass:'glyphicon-folder-open', closedClass:'glyphicon-folder-close'});

$('#tree3').treed({openedClass:'glyphicon-chevron-right', closedClass:'glyphicon-chevron-down'});*/

</script>
</div>
</div>
<style type="text/css">

     #flip_header
      {

         background:#605CA8;
         padding:10px;
          width:30%;
          text-align:justify;
          color:#fff;
          font-size: large;
          border: 1px solid #fff;

        }
    #leave_flip
      {

         background:steelblue;
         /*background:#104E8B;*/
          padding:10px;
          width:30%;
          text-align:justify;
          color:#fff;
          border: 1px solid #fff;

        }
         #leave_flip:hover{

                  background:#009ACD;
                 color:#fff;

        }

    </style>
    <script type="text/javascript">
    $(document).ready(function() {

    /*$( '.tree li' ).each( function() {
        if( $( this ).children( 'ul' ).length > 0 ) {
            $( this ).addClass( 'parent' );     
        }
    });

    $( '.tree li.parent > a' ).click( function( ) {
        $( this ).parent().toggleClass( 'active' );
        $( this ).parent().children( 'ul' ).slideToggle( 'fast' );
    });
*/
        $('.toggle').toggle();

    jQuery('.showSingle').click(function(){
              jQuery('.targetDiv').hide();
              jQuery('#leave_panel'+$(this).attr('target')).toggle();
        });
});
    </script>
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
   <script type="text/javascript">
   
</script>
    </body>

</html>
