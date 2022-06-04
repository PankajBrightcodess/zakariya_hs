<?php
session_start();
if(!isset($_COOKIE['client_id'])){
	$cookie_value=md5(uniqid(rand(), true));
	setcookie('client_id', $cookie_value, time() + (86400 * 30), '/');
}
$user_id='';
$client_id='';
if(isset($_SESSION['user_id'])){
	$user_id=$_SESSION['user_id'];
	$role=$_SESSION['role'];
	$where="`user_id`='$user_id'";
}
else{
	header("Location:index.php");
}
	include('admin/class/config.php');
	$obj=Database::getInstance();
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
    <section class="cart-summary" style="margin-top:135px; padding:100px 0;">
    	<div class="container">
        	<div class="row">
            	<?php
                	if(isset($_SESSION['msg'])){echo "<h3 class='text-success text-center' id='success'><i class='fa fa-check'></i> ".$_SESSION['msg']."</h3>"; unset($_SESSION['msg']);}
				?>
            </div>
        </div><!-- end of container -->
    </section>
<?php include 'footer.php'; ?>
	<script language="javascript">
    </script>

  </body>
</html>
