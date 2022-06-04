<?php 
session_start();
include_once "class/product.php";
if(isset($_POST['submit']))
{
	$id=$_POST['id'];
$pname=addslashes(strip_tags($_POST['pname']));
$price=strip_tags($_POST['price']);
$discount=strip_tags($_POST['discount']);
$category=strip_tags($_POST['category']);
$description=strip_tags($_POST['description']);
$feature=$_POST['feature'];
$value=$_POST['value'];
$photo=$_FILES['photo']['name'];
$temp=$_FILES['photo']['tmp_name'];
//print_r($feature);

$Obj= new Product();
$product="products/";
$thumb="thumbnails/";

$filename = $Obj->cwUpload($photo,$product,'product',true,$thumb,'300','180',$temp);

$pro=$product.$filename;
$thum=$thumb.$filename;

 $status=$Obj->add_product($id,$pname,$price,$discount,$category,$description,$feature,$value,$pro,$thum);
 if($status==true){
 	  $msg="Product Added Successfully";
 	 $_SESSION['success']=$msg;
 	 header("Location:add_product.php");
 }
 else{
 	 $msg=$status;
 	 $_SESSION['err']=$msg;
 	 header("Location:add_product.php");
 } 
}

?>