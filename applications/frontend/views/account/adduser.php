
<?php $_POST = array();
$id = $_GET['idd'];
//echo $id;
?>

<!DOCTYPE html>

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

<body>

    <div id="wrapper">


        <!-- Page Content -->
        <!-- /#page-wrapper -->
<div class="container">
  <?php include('headers.php'); ?>
    <div class="row">

        <div class="col-sm-offset-3 col-lg-6 col-sm-6 well">
        <legend>Add Parking Details</legend>
        <?php
        $attributes = array("class" => "form-horizontal", "id" => "employeeform", "name" => "employeeform");
        echo form_open("account/insertdata", $attributes);?>
        <fieldset>

            <div class="form-group">
            <div class="row colbox">

            <div class="col-lg-4 col-sm-4">
                <label for="id" class="control-label">ID</label>
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
                <label for="noplate" class="control-label">No. Plate</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="noplate" name="noplate" placeholder="noplate" type="text" class="form-control"  value="<?php echo set_value('noplate'); ?>" />
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
                $attributes = 'class = "form-control" id = "parktype"';
                echo form_dropdown('parktype',$parktype,set_value('parktype'),$attributes);?>
                <span class="text-danger"><?php echo form_error('parktype'); ?></span>
            </div>
            </div>
            </div>

            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="intime" class="control-label">Intime</label>
            </div>
            <div class="col-lg-8 col-sm-8">
                <input id="intime" readonly name="intime" placeholder="" type="text" class="form-control"  value="<?php echo date('Y-m-d H:i:s',time()); ?>" />
                <span class="text-danger"><?php echo form_error('intime'); ?></span>
            </div>
            </div>
            </div>

            <div class="form-group">
            <div class="row colbox">
            <div class="col-lg-4 col-sm-4">
                <label for="outtime" class="control-label">Outtime</label>
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
                <input id="btn_add" name="btn_add" type="submit" class="btn btn-primary" value="Insert" />
                <input id="btn_cancel" name="btn_cancel" type="reset" class="btn btn-danger" value="Cancel" />
            </div>
            </div>
        </fieldset>
        <?php echo form_close(); ?>
        <?php echo $this->session->flashdata('msg'); ?>
        </div>
    </div>
</div>
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="assets/data/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="assets/data/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="assets/data/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="assets/data/dist/js/sb-admin-2.js"></script>

</body>

<?php include('footer.php'); ?>


</html>
  <script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {

	var getId = '<?php echo $_GET['idd'];?>';
	if(getId.length > 0){
		validate();
	}
 $.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || value == value.match(/^[a-zA-Z\s]+$/);
 });

 $("#user-form").validate({
    
        // Specify the validation rules
        rules: {
	 'first_name' : {
                alpha: true
            },
         'middle_name' : {
                alpha: true,
                required:false
            },
         'last_name' : {
                alpha: true
            }
        },
        
        messages: {
            'first_name' : {
                alpha: 'Alphabets Only'
            },
            'middle_name' : {
                alpha: 'Alphabets Only',
		required:'Please Enter Middle Name'
            },
            'last_name' : {
                alpha: 'Alphabets Only'
            },
        },
        
       /* submitHandler: function(form) {
            form.submit();
        }*/
    });

        $("#username").keyup(function (e) {
        
                //removes spaces from username
                $(this).val($(this).val().replace(/\s/g, ''));
                
                var username = $(this).val();
                var userId = $('#idd').val();
                if(username.length < 4){$("#user-result").html('');return;}
                
                if(username.length >= 4){
                        $("#user-result").html('<img src="imgs/ajax-loader.gif" />');
                        $.post('modules/test.php', {'username':username,'userId':userId}, function(data) {
                          $("#user-result").html(data);
//				alert(data);
				var you = document.getElementById("hidetext").value;
					if(you==1) {
				    $('#submit').attr('disabled', 'disabled');
					}
					else {
					  $('#submit').removeAttr('disabled');
					}	
                        });
                }
        });    

        $("#password2").keyup(validate);
         
});
function isPasswordValid() {
	  return $password1.val().length > 8;
	}

	function arePasswordsMatching() {
	  return $password1.val() === $password2.val();
	}

	function canSubmit() {
	  return isPasswordValid() && arePasswordsMatching();
	}

function validate() {
	var password1 = $("#password1").val();
	var password2 = $("#password2").val();

	if(password1 == password2 && password1!=null && password2!=null && password1.length >= '6') {
			$("#validate-status").text("Valid Password");
			 $('#validate-status').css('color','#004700');
			$('#submit').removeAttr('disabled')
	}
	else{
	  	 $("#validate-status").text("Invalid Password");
		 $('#validate-status').css('color','#db0f00');
		 $('#submit').attr('disabled', 'disabled');
		}
}
</script>
<style type="text/css">
.error{
width: 100%;
}
td, th {
padding: 4px 20px 10px 25px;
}
label {
width: 130px;
}
#submit{
background-color: rgb(152, 152, 152);
-moz-border-radius: 6px;
-webkit-border-radius: 6px;
border: 1px solid #535353;
padding: 3px;
width: 20%;}
#cancel{
background-color: rgb(225, 225, 225);
-moz-border-radius: 6px;
-webkit-border-radius: 6px;
border: 1px solid #959595;
padding: 3px;
width: 20%;}

</style>
