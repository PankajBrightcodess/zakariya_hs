<?php 
session_start();
include_once "class/school.php";
if(isset($_POST['submit']))
{
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


$published=0;
$Obj= new School();
 $status=$Obj->add_school($fullname,$board,$session,$class,$email,$phone,$website,$address,$published);
 if($status==true){
 	  $msg="School Added Successfully";
 	 $_SESSION['success']=$msg;
 	 header("Location:add_school.php");
 }
 else{
 	 $msg=$status;
 	 $_SESSION['err']=$msg;
 	 header("Location:add_school.php");
 } 
}

?>