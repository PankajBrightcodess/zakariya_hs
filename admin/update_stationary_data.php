<?php 
session_start();
include_once "class/stationary.php";
if(isset($_POST['submit']))
{
//$school_id=strip_tags($_POST['school_id']);
//$class_id=strip_tags($_POST['class_id']);
$id=strip_tags($_POST['id']);
$particulars=addslashes(strip_tags($_POST['particulars']));
$quantity=strip_tags($_POST['quantity']);
$price=strip_tags($_POST['price']);
$discount=strip_tags($_POST['discount']);


$Obj= new Stationary();
 $status=$Obj->update_stationary($id,$particulars,$quantity,$price,$discount);
 if($status==true){
 	  $msg="Stationary Updated Successfully";
 	 $_SESSION['success']=$msg;
 	 header("Location:stationary_list.php");
 }
 else{
 	 $msg=$status;
 	 $_SESSION['err']=$msg;
 	 header("Location:stationary_list.php");
 } 
}

?>