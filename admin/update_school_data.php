<?php 
session_start();
include_once "class/school.php";
if(isset($_POST['submit']))
{
$id=strip_tags($_POST['id']);	
	
/*  general info */	
$fullname=addslashes(strip_tags($_POST['fullname']));
$board=addslashes(strip_tags($_POST['board']));
$session=strip_tags($_POST['session']);
$from=strip_tags($_POST['from']);
$to=strip_tags($_POST['to']);
$class=$from."-".$to;
$email=strip_tags($_POST['email']);
$phone=strip_tags($_POST['phone']);
$website=strip_tags($_POST['website']);
$address=addslashes(strip_tags($_POST['address']));
/* end  */


$published=strip_tags($_POST['published']);
$Obj= new School();
 $status=$Obj->update_school($id,$fullname,$board,$session,$class,$email,$phone,$website,$address,$published);
 if($status==true){
 	  $msg="School Updated Successfully";
 	 $_SESSION['success']=$msg;
 	 header("Location:school_list.php");
 }
 else{
 	 $msg=$status;
 	 $_SESSION['err']=$msg;
 	 header("Location:school_list.php");
 } 
}

?>