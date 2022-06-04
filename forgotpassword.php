<?php
session_start();
if(isset($_SESSION['msg'])){
	$msg=$_SESSION['msg']."<br><br>";
	unset($_SESSION['msg']);
}else{
	$msg="";
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BMS | Forgot Password</title>
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
 
  <div class="register-box-body">
    <p class="login-box-msg">Forgot Password</p>

    <form action="add_member_data.php" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Enter Registered Email or Mobile" name="userid" required>
      </div>
       <div class="row">
          <div class="col-xs-12 text-danger text-center"><?php echo $msg; ?></div>
        <!-- /.col -->
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-6 pull-right">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="checkid">Reset Password</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3.1.1 -->
<script src="bootstrap/js/jquery-3.1.1.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="bootstrap/js/icheck.min.js"></script>
<script>
</script>
<script>
</script>
</body>
</html>
