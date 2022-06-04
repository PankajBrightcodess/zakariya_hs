<?php 
session_start();
include_once "class/stationary.php";
if(isset($_POST['submit']))
{
$school_id=strip_tags($_POST['school_id']);
$class_id=strip_tags($_POST['class_id']);
$particulars=$_POST['particulars'];
$quantity=$_POST['quantity'];
$price=$_POST['price'];
$discount=$_POST['discount'];


$Obj= new Stationary();
 $status=$Obj->add_stationary($school_id,$class_id,$particulars,$quantity,$price,$discount);
 if($status==true){
 	  $msg="Stationary Added Successfully";
 	 $_SESSION['success']=$msg;
 	 header("Location:add_stationary.php");
 }
 else{
 	 $msg=$status;
 	 $_SESSION['err']=$msg;
 	 header("Location:add_stationary.php");
 } 
}

?>