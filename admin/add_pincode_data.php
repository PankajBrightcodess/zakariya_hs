<?php 
session_start();
include_once "class/pincode.php";
if(isset($_POST['submit']))
{

$po=$_POST['po'];
$district=$_POST['district'];
$pincode=strip_tags($_POST['pincode']);
$state=$_POST['state'];

$Obj= new Pincode();

 $status=$Obj->add_pincode($pincode,$po,$district,$state);
 if($status==true){

 	  $msg="Pincode Added Successfully";
 	 $_SESSION['success']=$msg;
 	 header("Location:pincode_list.php");
 }
 else{
 	 $msg=$status;
 	 $_SESSION['err']=$msg;
 	 header("Location:pincode_list.php");
 } 
}

?>