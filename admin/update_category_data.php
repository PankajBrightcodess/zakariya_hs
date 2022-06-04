<?php 
session_start();
include_once "class/product.php";
if(isset($_POST['submit']))
{
$id=strip_tags($_POST['id']);
$feature=addslashes(strip_tags($_POST['feature']));

$Obj= new Product();
 $status=$Obj->update_category($id,$feature);
 if($status==true){
 	  $msg="Category Updated Successfully";
 	 $_SESSION['success']=$msg;
 	 header("Location:category_list.php");
 }
 else{
 	 $msg=$status;
 	 $_SESSION['err']=$msg;
 	 header("Location:category_list.php");
 } 
}

?>