<?php 
session_start();
include_once "class/books.php";
if(isset($_POST['submit']))
{
$id=strip_tags($_POST['id']);	
	
/*  general info */	
$fullname=addslashes(strip_tags($_POST['fullname']));

/* end  */


$published=strip_tags($_POST['published']);
$Obj= new Books();
 $status=$Obj->update_subject($id,$fullname,$published);
 if($status==true){
 	  $msg="Subject Updated Successfully";
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