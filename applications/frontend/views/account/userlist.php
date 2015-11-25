<?php
	    require_once 'Paginator.class.php';

	    $conn       = new mysqli( '127.0.0.1', 'root', 'password', 'ci_bootstrap' );

	    $limit      = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 1;
	    $page       = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1;
	    $links      = ( isset( $_GET['links'] ) ) ? $_GET['links'] : 7;
$query = "SELECT noplate,charges from park";
	//$query = "SELECT tbl_users.user_id,tbl_users.user_name,tbl_users.status,tbl_trainer.fname,tbl_trainer.lname from tbl_users inner join tbl_trainer on tbl_users.user_id = tbl_trainer.userid order by tbl_trainer.fname";

	    $Paginator  = new Paginator( $conn, $query );

	    $results    = $Paginator->getData( $page, $limit );

	?>



<body>

    <div id="wrapper">



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
																						<th>First Name</th>

                                        </tr>
                                    </thead>

                                    <tbody>
                                    <?php for( $i = 0; $i < count( $results->data ); $i++ ) : ?>

                                        <tr class="odd gradeX">
                                            <td><?php echo $results->data[$i]['noplate']; ?></td>
                                            <td><?php echo $results->data[$i]['charges']; ?></td>

                                            <td><a href=updateEmployee/<?php echo $results->data[$i]['pid']; ?>>
                                                                             EDIT


                                            </td>
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
