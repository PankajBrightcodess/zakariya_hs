<?php 
session_start();
if(isset($_POST['submit']))
{
/*  general info */	
$temp=strip_tags($_FILES['photo']['tmp_name']);
$folder="../images/banner.jpg";

 if(move_uploaded_file($temp,$folder)){
 	  $msg="Banner Uploaded!";
 	 $_SESSION['success']=$msg;
 	 header("Location:banner.php");
 }
 else{
 	 $msg=$status;
 	 $_SESSION['err']=$msg;
 	 header("Location:banner.php");
 } 
}

?>