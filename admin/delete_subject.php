<?php
session_start();
if(isset($_SESSION['user'])){
	  $role=$_SESSION['role'];
	  $user=$_SESSION['user'];
	  
  }
include_once "class/books.php";
$obj=new Books();
$id=$_GET['id'];
if($id!=""){
	$status=$obj->del_subject($id);
	if($status==true){
		  $msg="Data Deleted Successfully";
		 $_SESSION['success']=$msg;
		 header("Location:subject_list.php");
	 }
	 else{
		 $msg=$status;
		 $_SESSION['err']=$msg;
		 header("Location:subject_list.php");
	 } 
	
}
?>