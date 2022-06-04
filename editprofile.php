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
                <div class="col-md-12" style="padding:10px;">
                	<legend>Welcome <?php echo ucwords($array['name']); ?></legend>
                	<div class="row">
                        <div class="col-md-3" style="padding:10px; border-right:1px solid #eee;">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="profile.php">My Account</a></li>
                                <li class="active"><a href="editprofile.php">Edit Account</a></li>
                                <li><a href="addressbook.php">Address Book</a></li>
                                <li><a href="changepassword.php">Change Password</a></li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <form method="post" action="updateprofile.php">
                                <table class="table table-responsive table-condensed table-striped">
                                	<tr>
                                    	<td colspan="2" align="right">
                                        	<sup class="text-danger">*</sup>All Fields as Compulsory. E-mail or Mobile can be used for Login.
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Name <sup class="text-danger">*</sup> :</th>
                                        <td><input type="text" name="name" value="<?php echo $array['name']; ?>" class="form-control" required /></td>
                                    </tr>
                                    <tr>
                                        <th>E-mail <sup class="text-danger">*</sup> :</th>
                                        <td><input type="email" name="email" value="<?php echo $array['email']; ?>" class="form-control" required /></td>
                                    </tr>
                                    <tr>
                                        <th>Mobile <sup class="text-danger">*</sup> :</th>
                                        <td><input type="text" name="mobile" id="mobile" value="<?php echo $array['mobile']; ?>" class="form-control" 
                                        		onKeyUp="checkMobile(this.value)" maxlength="10" required /></td>
                                    </tr>
                                    <tr>
                                    	<td colspan="2">
                                           	<input type="hidden" name="id" value="<?php echo $user_id ;?>" />
                                        	<input type="submit" class="btn btn-success" name="updateProfile" value="Update">
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
		
		function checkMobile(str){
			var mobile=str;
			if(mobile!=''){mobile=parseInt(mobile);}
			if(isNaN(mobile)){mobile=''; alert("Enter Valid Mobile no!");}
			$('#mobile').val(mobile)
			
		}
    </script>

  </body>
</html>
