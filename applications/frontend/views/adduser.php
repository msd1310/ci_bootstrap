
<!DOCTYPE html>

<?php include('headd.php'); ?>

<body>

    <div id="wrapper">

        <?php include('headerrs.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <!--h1 class="page-header">Participant Information Form</h1-->
                        <br/>
                    </div>
                     <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Participant Information Form
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="index.php?action=adduser" method="post" name='f' id='user-form'>
                                        <div class="form-group">

 <table width="100 %">
<p>
<fieldset>
<tr>

 <td valign="top">
 <label for="first_name">First Name</label>
</td><td>
  <input  type="hidden" id='idd' name="idd" maxlength="50" size="30" value="<?php echo $_GET['idd']?>">
  <input  type="text" name="first_name" maxlength="50" size="30"  value="<?php echo $fname;?>"required="required">
 </td>
</tr><tr>
  <td valign="top">
  <label for="middle_name">Middle Name</label>
  </td><td>
  <input  type="text" name="middle_name" maxlength="50" size="30"  value="<?php echo $mname;?>" required=false>
 </td>
</tr><tr>
 <td valign="top">
  <label for="last_name">Last Name</label>
  </td><td>
  <input  type="text" name="last_name" maxlength="50" size="30"  value="<?php echo $lname;?>" required="required">
 </td>
 <td>
 <p id="fullName-status"></p>
 </td>

 </fieldset>
</tr>
<tr></tr>
<tr>

 <td valign="top" width="30px">
  <label for="username">User Name*</label>
 </td>
 <td valign="top">
  <input  type="text" id="username" name="username" maxlength="30" size="30" autocomplete="off" value="<?php echo $username;?>" required="required">Username should more than 4 character
 </td>
 <td>
 <span id="user-result">

</span>
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="password1">Password*</label>
 </td>
  <td valign="top">
  <input  type="password" id="password1" name="password1" maxlength="30" size="30" value="<?php echo $password2;?>" required="required">
 </td>
</tr>

<tr>
 <td valign="top" width="70 %">
  <label for="password2" >Confirm Password*</label>
 </td>
 <td valign="top">
  <input type="password" name="password2" id="password2" maxlength="100"  maxlength="30" size="30" value="<?php echo $password2;?>" required="required">
 </td>
 <td>
 <p id="validate-status" style="margin-left:-30px;"></p>
 </td>
 </tr>
<tr>
 <td colspan="2" style="text-align:center">
  <input id=submit type="submit" value="Submit" name="submit" disabled="disabled" />
<input type="button" id = "cancel" value="Cancel" onClick="window.location='index.php?action=ulist'">
 </td>
</tr>
</p>
</table>

                                        </div>
             </form>
             </div>
             </div>
             </div>
             </div></div></div>

                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
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

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

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
