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
	$status=$obj->del_book($id);
	if($status==true){
		  $msg="Book Deleted Successfully";
		 $_SESSION['success']=$msg;
		 header("Location:book_list.php");
	 }
	 else{
		 $msg=$status;
		 $_SESSION['err']=$msg;
		 header("Location:book_list.php");
	 } 
	
}
?>