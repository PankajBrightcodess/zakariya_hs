<?php
session_start();

  if(isset($_SESSION['role'])){
	  header("Location:home.php");
  } 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>BookMySyllabus  | Login</title>

    <!-- Bootstrap CSS -->    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-img3-body">

    <div class="container">

      <form class="login-form" action="" method="post">        
        <div class="login-wrap">
            <p class="login-img"><i class="icon_lock_alt"></i></p>
            <div class="input-group">
              <span class="input-group-addon"><i class="icon_profile"></i></span>
              <input type="text" class="form-control" placeholder="Username" name="username" autofocus>
            </div>
            <div class="input-group">
                <span class="input-group-addon"><i class="icon_key_alt"></i></span>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
          
            <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">Login</button>
           
            <div id="logstatus" style="visibility:none" class="text-danger">
	      
	        </div>
            
        </div>
      </form>
    <?php include "footer.php"; ?>
    </div>


  </body>
<?php include_once "class/config.php";?>
<?php include_once "class/user.php";?>
<?php
    if (isset($_POST['submit'])){

	     $username=$_POST['username'];
	     $password=$_POST['password'];
		
	 	  //$sql="select * from users where username='$user' and password='$pass' and active='1' ";
			$userobj=new User(); 
          if(($users=$userobj->get_login_credentials($username,$password))!=false){
          		
              $_SESSION['user']=$users['username'];
              $_SESSION['role']=$users['role'];
              header("Location:home.php");
			  echo "<script>window.location='home.php';</script>";
          }
	       else{
			  
			  ?>
			     <script>
			     document.getElementById("logstatus").innerHTML="<center>Wrong username or password!!</center>";
			   </script>
			  <?php
		   }	  
	} 
?>
</html>
