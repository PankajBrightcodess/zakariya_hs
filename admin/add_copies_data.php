<?php 
session_start();
include_once "class/copy.php";
if(isset($_POST['submit']))
{
$school_id=strip_tags($_POST['school_id']);
$class_id=strip_tags($_POST['class_id']);
$copy_name=$_POST['copy_name'];
$pages=$_POST['pages'];
$quality=$_POST['quality'];
$quantity=$_POST['quantity'];
$price=$_POST['price'];
$discount=$_POST['discount'];


$Obj= new Copies();
 $status=$Obj->add_copies($school_id,$class_id,$copy_name,$pages,$quality,$quantity,$price,$discount);
 if($status==true){
 	  $msg="Copies Added Successfully";
 	 $_SESSION['success']=$msg;
 	 header("Location:add_copy.php");
 }
 else{
 	 $msg=$status;
 	 $_SESSION['err']=$msg;
 	 header("Location:add_copy.php");
 } 
}

?>