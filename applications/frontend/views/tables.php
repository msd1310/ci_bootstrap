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

    <!-- Custom CSS -->
<link href="<?php echo base_url('assets/data/dist/css/sb-admin-2.css'); ?>" rel="stylesheet">
<link href="<?php echo base_url('assets/data/bower_components/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
    <!-- Custom Fonts -->
<link href="<?php echo base_url('assets/newjq/jquery-ui.min.css'); ?>" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<?php
	    require_once 'Paginator.class.php';

	    $conn       = new mysqli( '127.0.0.1', 'root', 'MahitNahi', 'ci_bootstrap' );

	    $limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 1;
	    $page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
	    $links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;
    	    $query = "SELECT pid,noplate,intime,outtime,hours,charges,status,typeid,id,confirm,status from park where status = 0 order by id asc";

	    $Paginator  = new Paginator( $conn, $query );

	    $results    = $Paginator->getData( $page, $limit );

	?>
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
                <a class="navbar-brand" href="#">Shree Sai Samartha Enterprises Pay and Park</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
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
            <!-- /.row -->
            <div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading" id = "export-button">
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="dataTable_wrapper"><?php echo $this->session->flashdata('msg'); ?>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
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
<script>
AddButton = document.createElement("input");
AddButton.type = "button";
AddButton.value = "Add";
AddButton.setAttribute("onclick","location.href='insertdata'");// = alert("Export");
AddButton.setAttribute("class","btn btn-primary btn-md");
placeHolder = document.getElementById("export-button");
placeHolder.appendChild(AddButton);

</script>

<script language="javascript" type="text/javascript">
function deletedata(data) {
var da = data;
$.ajax({
type: "POST",
url: 'views/userUpdate.php',
data:{ss:da},
success:function(html) {
top.location.href="index.php?action=ulist";
}

});
}
</script>

            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
        <script src="<?php echo base_url('assets/data/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/metisMenu/dist/metisMenu.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/data/dist/js/sb-admin-2.js'); ?>"></script>
		<script src="<?php echo base_url('assets/newjq/fnReloadAjax.js'); ?>"></script>
        

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        var table = $('#dataTables-example').DataTable({
                responsive: true
        });
//	var table = $('#dataTables-example').DataTable( { ajax: "<?php echo site_url();?>/account/getjsondata" } ); setInterval( function () { table.ajax.reload(); }, 30000 );

/*var mytable = $('#dataTables-example').DataTable({
    serverSide:true,
    ajax:{
        url:'getjsondata',
        type:'GET'
    },
});
setInterval(function() {
    mytable.ajax.reload();
}, 30000);*/
    });
    </script>

</body><?php include('footer.php'); ?>

</html>
