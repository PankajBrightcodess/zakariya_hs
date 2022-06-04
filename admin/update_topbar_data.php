<?php 
session_start();
include_once "class/topbar.php";
if(isset($_POST['submit']))
{
$id=strip_tags($_POST['id']);	
	
/*  general info */	
$topbar=addslashes(strip_tags($_POST['topbar']));

/* end  */


$published=strip_tags($_POST['published']);
$Obj= new Topbar();
 $status=$Obj->update_topbar($id,$topbar,$published);
 if($status==true){
 	  $msg="Topbar Updated Successfully";
 	 $_SESSION['success']=$msg;
 	 header("Location:topbar.php");
 }
 else{
 	 $msg=$status;
 	 $_SESSION['err']=$msg;
 	 header("Location:topbar.php");
 } 
}

?>