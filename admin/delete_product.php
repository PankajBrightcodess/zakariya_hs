<?php
session_start();
if(isset($_SESSION['user'])){
	  $role=$_SESSION['role'];
	  $user=$_SESSION['user'];
	  
  }
include_once "class/product.php";
$obj=new Product();
$id=$_GET['id'];
if($id!=""){
	$status=$obj->del_product($id);
	if($status==true){
		  $msg="Product Deleted Successfully";
		 $_SESSION['success']=$msg;
		 header("Location:product_list.php");
	 }
	 else{
		 $msg=$status;
		 $_SESSION['err']=$msg;
		 header("Location:product_list.php");
	 } 
	
}
?>