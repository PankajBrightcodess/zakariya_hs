<?php
session_start();
if(isset($_SESSION['user'])){
	  $role=$_SESSION['role'];
	  $user=$_SESSION['user'];
	  
  }
include_once "class/product.php";
$obj=new Product();
$id=strip_tags($_GET['id']);
if($id!=""){
	$status=$obj->del_review($id);
	if($status==true){
		  $msg="Review Deleted Successfully";
		 $_SESSION['success']=$msg;
		 header("Location:product_review.php");
	 }
	 else{
		 $msg=$status;
		 $_SESSION['err']=$msg;
		 header("Location:product_review.php");
	 } 
	
}
?>