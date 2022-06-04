<?php

session_start();
if(isset($_SESSION['user'])){
	  $role=$_SESSION['role'];
	  $user=$_SESSION['user'];
	  
  }
//include_once "class/config.php";
include_once "class/user.php";	
$userobj=new User();
if(isset($_POST['adduser'])){
	
	
	$username=$_POST['username'];
	$password=$_POST['password'];
	$role=$_POST['role'];
	$active=$_POST['active'];
	$status=$userobj->create_user($username,$password,$role,$active);
	 if($status==true){
		  $msg="Data Added Successfully";
		 $_SESSION['success']=$msg;
		 header("Location:user.php");
	 }
	 else{
		 $msg=$status;
		 $_SESSION['err']=$msg;
		 header("Location:user.php");
	 } 
}

if(isset($_POST['up_user'])){
	
	$id=$_POST['uid'];
	$username=$_POST['up_username'];
	$password=$_POST['up_password'];
	$role=$_POST['up_role'];
	$active=$_POST['up_active'];
	$status=$userobj->update_meta_user($id,$username,$password,$role,$active);
	 if($status==true){
		  $msg="Data Updated Successfully";
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