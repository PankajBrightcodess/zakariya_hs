<?php 
session_start();
include_once "class/news.php";
if(isset($_POST['submit']))
{
/*  general info */	
$date=$_POST['date'];
$title=addslashes($_POST['title']);
$link=addslashes($_POST['link']);
$description=addslashes($_POST['description']);
/* end  */
$published=$_POST['published'];
$Obj= new News();
 $status=$Obj->add_news($date,$title,$link,$description,$published);
 if($status==true){
 	  $msg="News Added Successfully";
 	 $_SESSION['success']=$msg;
 	 header("Location:add_news.php");
 }
 else{
 	 $msg=$status;
 	 $_SESSION['err']=$msg;
 	 header("Location:add_news.php");
 } 
}

?>