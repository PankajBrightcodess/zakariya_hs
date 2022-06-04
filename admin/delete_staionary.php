<?php
session_start();
if(isset($_SESSION['user'])){
	  $role=$_SESSION['role'];
	  $user=$_SESSION['user'];
	  
  }
include_once "class/stationary.php";
$obj=new Stationary();
$id=$_GET['id'];
if($id!=""){
	$status=$obj->del_stationary($id);
	if($status==true){
		  $msg="Statinary Deleted Successfully";
		 $_SESSION['success']=$msg;
		 header("Location:stationary_list.php");
	 }
	 else{
		 $msg=$status;
		 $_SESSION['err']=$msg;
		 header("Location:stationary_list.php");
	 } 
	
}
?>