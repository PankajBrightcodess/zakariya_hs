<?php
session_start();
if(isset($_SESSION['user'])){
	  $role=$_SESSION['role'];
	  $user=$_SESSION['user'];
	  
  }
include_once "class/news.php";
$obj=new News();
$id=$_GET['id'];
if($id!=""){
	$status=$obj->del_news($id);
	if($status==true){
		  $msg="News Deleted Successfully";
		 $_SESSION['success']=$msg;
		 header("Location:news_list.php");
	 }
	 else{
		 $msg=$status;
		 $_SESSION['err']=$msg;
		 header("Location:news_list.php");
	 } 
	
}
?>