<?php
session_start();
if(isset($_SESSION['user'])){
	  $role=$_SESSION['role'];
	  $user=$_SESSION['user'];
	  
  }
include_once "class/user.php";
$userobj=new User();
$uid=$_GET['uid'];
if($uid!=""){
	$status=$userobj->del_user($uid);
	if($status==true){
		  $msg="Data Deleted Successfully";
		 $_SESSION['success']=$msg;
		 header("Location:user.php");
	 }
	 else{
		 $msg=$status;
		 $_SESSION['err']=$msg;
		 header("Location:user.php");
	 } 
	
}
?>