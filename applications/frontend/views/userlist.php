
<?php
  
// Turn off all error reporting
error_reporting(0);

	    require_once 'Paginator.class.php';
	 
	    $conn       = new mysqli( '127.0.0.1', 'root', 'password', 'isha' );
	 
	    $limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 1;
	    $page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
	    $links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;
	 
	$query = "SELECT tbl_users.user_id,tbl_users.user_name,tbl_users.status,tbl_trainer.fname,tbl_trainer.lname from tbl_users inner join tbl_trainer on tbl_users.user_id = tbl_trainer.userid order by tbl_trainer.fname";
	
	    $Paginator  = new Paginator( $conn, $query );
	 
	    $results    = $Paginator->getData( $page, $limit );
 	
	?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>
    <!-- Bootstrap Core CSS -->
<link href="<?php echo base_url('assets/data/bower_components/bootstrap/dist/css/bootstrap.min.css'); ?>" rel="stylesheet">
    <!-- MetisMenu CSS -->
<link href="<?php echo base_url('assets/data/bower_components/metisMenu/dist/metisMenu.min.cs'); ?>" rel="stylesheet">


    <!-- DataTables CSS -->
<link href="<?php echo base_url('assets/data/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css'); ?>" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
<link href="<?php echo base_url('assets/data/bower_components/datatables-responsive/css/dataTables.responsive.css'); ?>" rel="stylesheet">

    <!-- Custom CSS -->
<link href="<?php echo base_url('assets/data/dist/css/sb-admin-2.css'); ?>" rel="stylesheet">

    <!-- Custom Fonts -->
<link href="<?php echo base_url('assets/data/bower_components/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>


<body>

    <div id="wrapper">

        <?php include('headers.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header">USER LIST</h3>
                    
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading" id = "export-button">
                            
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
									
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Edit</th>
						<?php if($_SESSION['role_id']==1) { ?>
                                            <th>Delete</th>
						<?php }?>
                                            
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php for( $i = 0; $i < count( $results->data ); $i++ ) : ?>
                   
                                        <tr class="odd gradeX">
                                            <td><?php echo $results->data[$i]['user_name']; ?></td>
                                            <td><?php echo $results->data[$i]['fname']; ?></td>
                                            <td><?php echo $results->data[$i]['lname']; ?></td>
                                            <td><a href=index.php?action=adduser&idd=<?php echo $results->data[$i]['user_id']; ?>>
                                                                             EDIT          
                                            
                                            
                                            </td>
                                            
                                            
                                             <?php 
                                             $value = ($results->data[$i]['status'] == 1 ? 'Disable' : 'Enable');
                                             
                                             if($_SESSION['role_id']==1) { ?><td>
												 
												 <input type="button" class="btn btn-primary btn-md" onclick="deletedata(<?php echo $results->data[$i]['user_id']; ?>)" value="<?php  echo $value;?>" >
												 
												 </td> <?php }?>
                                            
                                        </tr>
                                        <?php endfor; ?>
                                   
                                    </tbody>
                                </table>
                               
                            </div>
                            <!-- /.table-responsive -->
                                                 </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
       
    </script>
    
<script>
AddButton = document.createElement("input");
AddButton.type = "button";
AddButton.value = "Add";
AddButton.setAttribute("onclick","location.href='index.php?action=adduser'");// = alert("Export");
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

</body>




</html>
