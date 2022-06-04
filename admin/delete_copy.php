<?php
session_start();
if(isset($_SESSION['user'])){
	  $role=$_SESSION['role'];
	  $user=$_SESSION['user'];
	  
  }
include_once "class/copy.php";
$obj=new Copies();
$id=$_GET['id'];
if($id!=""){
	$status=$obj->del_copy($id);
	if($status==true){
		  $msg="Copy Deleted Successfully";
		 $_SESSION['success']=$msg;
		 header("Location:copy_list.php");
	 }
	 else{
		 $msg=$status;
		 $_SESSION['err']=$msg;
		 header("Location:copy_list.php");
	 } 
	
}
?>