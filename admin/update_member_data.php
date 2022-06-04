<?php 
session_start();
include_once "class/member.php";
if(isset($_POST['submit']))
{
$id=strip_tags($_POST['id']);	
	
$status=strip_tags($_POST['status']);


$Obj= new Member();
 $status=$Obj->update_member($id,$status);
 if($status==true){
 	  $msg="Member Updated Successfully";
 	 $_SESSION['success']=$msg;
 	 header("Location:member_list.php");
 }
 else{
 	 $msg=$status;
 	 $_SESSION['err']=$msg;
 	 header("Location:member_list.php");
 } 
}

?>