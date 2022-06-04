<?php
session_start();
include_once "admin/class/config.php";
$obj=Database::getInstance();
if(isset($_GET['resetpassword'])){
	$otp=$_GET['d2270e7120a93c8b0a6a34760e654c7d'];
	$user=$_GET['ee11cbb19052e40b07aac0ca060c23ee'];
	$table="`tbl_member`";
	$where="(md5(`email`)='$user' or md5(`mobile`)='$user') and `otp`='$otp'";
	$count=$obj->get_count($table,$where." and `updated_on` >= DATE_SUB(NOW(),INTERVAL 1 HOUR) ");
	if($count==1){
		$status=true;	
	}
	else{
		$status=false;	
	}
}
elseif(isset($_POST['enterotp'])){
	$user=$_POST['user'];
	$otp=md5($_POST['otp']);
	$table="`tbl_member`";
	$where="(md5(`email`)='$user' or md5(`mobile`)='$user') and `otp`='$otp'";
	$count=$obj->get_count($table,$where);
	if($count==1){
		$count2=$obj->get_count($table,$where." and `updated_on` >= DATE_SUB(NOW(),INTERVAL 1 HOUR) ");
		if($count2==1){
			$status=true;	
		}
		else{
			$status=false;	
		}
	}
	else{
		$_SESSION['msg']="Wrong OTP";
		header("Location:enterotp.php?ee11cbb19052e40b07aac0ca060c23ee=$user");	
	}
}
else{
	header("Location:forgotpassword.php");
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BMS | Reset Password</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="my-css/My.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="my-css/blue.css">

  

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
 <?php if($status===true){?>
  <div class="register-box-body">
    <p class="login-box-msg">Create New Password</p>

    <form action="add_member_data.php" method="post" onSubmit=" return checkPasswrd();">
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Enter New Password" name="password" id="password" 
        	pattern="(?=.*\d)(?=.*[a-z]).{8,}" title="Must contain at least one number and one letter, and at least 8 or more characters" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Retype Password" name="repassword" id="repassword" required>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
       <div class="row">
          <div class="col-xs-12 text-danger text-center" id="chekpassmsg"></div>
        <!-- /.col -->
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-6 pull-right">
        	<input type="hidden" name="userid" value="<?php echo $user; ?>">
        	<input type="hidden" name="otp" value="<?php echo $otp; ?>">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="resetpassword">Reset Password</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.form-box -->
  <?php } else{?>
  <div class="register-box-body">
    	<p class="login-box-msg">Forgot Password</p>
  		<p>Reset Link Expired. <a href="forgotpassword.php">Try Again</a></p>
  </div>
  <?php } ?>
</div>
<!-- /.register-box -->

<!-- jQuery 3.1.1 -->
<script src="bootstrap/js/jquery-3.1.1.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="bootstrap/js/icheck.min.js"></script>
<script>
function checkPasswrd()
{
	var pass=$('#password').val();
	var repass=$('#repassword').val();
	if(pass!=repass)
	{
		document.getElementById('chekpassmsg').style.color="red";
		document.getElementById('chekpassmsg').innerHTML="Password Doesn't Match!";
		return false;
	}
	else{return true;}
}
</script>
<script>
</script>
</body>
</html>
