<?php 
session_start();
include_once "class/news.php";
if(isset($_POST['submit']))
{
/*  general info */	
$id=strip_tags($_POST['id']);
$date=$_POST['date'];
$title=addslashes($_POST['title']);
$link=addslashes($_POST['link']);
$description=addslashes($_POST['description']);
/* end  */
$published=$_POST['published'];
$Obj= new News();
 $status=$Obj->update_news($id,$date,$title,$link,$description,$published);
 if($status==true){
 	  $msg="News Updated Successfully";
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