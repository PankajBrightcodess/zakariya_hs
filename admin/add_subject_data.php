<?php 
session_start();
include_once "class/books.php";
if(isset($_POST['submit']))
{
/*  general info */	
$fullname=addslashes(strip_tags($_POST['fullname']));

/* end  */
$published=0;
$Obj= new Books();
 $status=$Obj->add_subject($fullname,$published);
 if($status==true){
 	  $msg="Subject Added Successfully";
 	 $_SESSION['success']=$msg;
 	 header("Location:add_subject.php");
 }
 else{
 	 $msg=$status;
 	 $_SESSION['err']=$msg;
 	 header("Location:add_subject.php");
 } 
}

?>