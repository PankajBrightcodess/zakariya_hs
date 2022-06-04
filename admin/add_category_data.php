<?php 
session_start();
include_once "class/product.php";
if(isset($_POST['submit']))
{
$name=strip_tags($_POST['name']);
$feature=$_POST['feature'];

$Obj= new Product();
 $status=$Obj->add_category($name,$feature);
 if($status==true){
 	  $msg="Category Added Successfully";
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