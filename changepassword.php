<?php
session_start();
$user_id='';
if(isset($_SESSION['user_id'])){
	$user_id=$_SESSION['user_id'];
	$role=$_SESSION['role'];
	$where="`user_id`='$user_id'";
}
else{
	header("Location:login.php");
}
	include('admin/class/config.php');
	$obj=Database::getInstance();
	$array=$obj->get_details("`tbl_member`","*","`id`='$user_id'");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book My Syllabus</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="my-css/style.css" rel="stylesheet">
    <!-- ---------- font ---------------------- -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700|Roboto:400,500,700" rel="stylesheet">
    <!-- ---------- font awesome ---------------------- -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
  </head>
  <body>
  <?php include 'header-nav.php'; ?>
    <section class="cart-summary" style="margin-top:135px;">
    	<div class="container">
        	<div class="row">
            	<?php
                	if(isset($_SESSION['msg'])){echo "<h4 class='text-success text-center' id='success'>".$_SESSION['msg']."</h4>"; unset($_SESSION['msg']);}
                	if(isset($_SESSION['err'])){echo "<h4 class='text-danger text-center' id='error'>".$_SESSION['err']."</h4>"; unset($_SESSION['err']);}
				?>
                <div class="col-md-12" style="padding:10px;">
                	<legend>Welcome <?php echo ucwords($array['name']); ?></legend>
                	<div class="row">
                        <div class="col-md-3" style="padding:10px; border-right:1px solid #eee;">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="profile.php">My Account</a></li>
                                <li><a href="editprofile.php">Edit Account</a></li>
                                <li><a href="addressbook.php">Address Book</a></li>
                                <li class="active"><a href="changepassword.php">Change Password</a></li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <form method="post" action="updateprofile.php" onSubmit="return checkPasswrd();">
                                <table class="table table-responsive table-condensed table-striped">
                                    <tr <?php if($array['password']==''){echo "style='display:none;'";} ?>>
                                        <th>Old Password <sup class="text-danger">*</sup> :</th>
                                        <td><input type="password" name="old" id="old" class="form-control" <?php if($array['password']!=''){echo "required";} ?> onKeyUp="resetThis();"  /></td>
                                    </tr>
                                    <tr>
                                        <th>New Password <sup class="text-danger">*</sup> :</th>
                                        <td><input type="password" name="password" id="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z]).{8,}" 
                                        		title="Must contain at least one number and one letter, and at least 8 or more characters" required onKeyUp="resetThis();" /></td>
                                    </tr>
                                    <tr>
                                        <th>Retype-Password <sup class="text-danger">*</sup> :</th>
                                        <td><input type="password" name="retype" id="retype" class="form-control" required onKeyUp="resetThis();"  /></td>
                                    </tr>
                                    <tr>
                                    	<td colspan="2">
                                        	<span id="checkpassmsg" class="text-danger"></span><br>
                                           	<input type="hidden" name="id" value="<?php echo $user_id ;?>" />
                                        	<input type="submit" class="btn btn-warning" name="updatePassword" value="Change Password">
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end of container -->
    </section>
<?php include 'footer.php'; ?>
	<script language="javascript">
		$(document).ready(function() {
			var success=$('#success').html();
			var error=$('#error').html();
			setTimeout(function() {
			 	if(success){
					$('#success').hide();
				}
				if(error){
					$('#error').hide();
				}
			},3000);
		});
		function checkPasswrd()
		{
			var pass=$('#password').val();
			var repass=$('#retype').val();
			if(pass!=repass)
			{
				document.getElementById('checkpassmsg').innerHTML="Password Doesn't Match!";
				return false;
			}
			else{
				return true;
			}
		}
		
		function resetThis(){
			document.getElementById('checkpassmsg').innerHTML="";
		}
    </script>

  </body>
</html>
