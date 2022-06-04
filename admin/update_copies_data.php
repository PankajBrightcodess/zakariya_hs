<?php 
session_start();
include_once "class/copy.php";
if(isset($_POST['submit']))
{
//$school_id=strip_tags($_POST['school_id']);
//$class_id=strip_tags($_POST['class_id']);
$id=strip_tags($_POST['id']);
$copy_name=addslashes(strip_tags($_POST['copy_name']));
$pages=strip_tags($_POST['pages']);
$quality=addslashes(strip_tags($_POST['quality']));
$quantity=strip_tags($_POST['quantity']);
$price=strip_tags($_POST['price']);
$discount=strip_tags($_POST['discount']);


$Obj= new Copies();
 $status=$Obj->update_copies($id,$copy_name,$pages,$quality,$quantity,$price,$discount);
 if($status==true){
 	  $msg="Copy Updated Successfully";
 	 $_SESSION['success']=$msg;
 	 header("Location:copy_list.php");
 }
 else{
 	 $msg=$status;
 	 $_SESSION['err']=$msg;
 	 header("Location:copy_list.php");
 } 
}

?>