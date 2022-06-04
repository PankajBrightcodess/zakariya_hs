<?php 
session_start();
include_once "class/product.php";
if(isset($_POST['submit']))
{
$id=$_POST['id'];
$pname=addslashes(strip_tags($_POST['pname']));
$price=strip_tags($_POST['price']);
$discount=strip_tags($_POST['discount']);
//$category=strip_tags($_POST['category']);
$description=strip_tags($_POST['description']);
$feature=$_POST['feature'];
$value=$_POST['value'];
$photo=$_FILES['photo']['name'];
$temp=$_FILES['photo']['tmp_name'];
//print_r($feature);

$Obj= new Product();
if($photo!=''){
$img=$Obj->unlink_photo_by_id($id);
unlink($img['image']);
unlink($img['thumbnail']);

$product="products/";
$thumb="thumbnails/";

$filename = $Obj->cwUpload($photo,$product,'product',true,$thumb,'300','180',$temp);

$pro=$product.$filename;
$thum=$thumb.$filename;
}else{
	$pro=$_FILES['photo']['name'];
	$thum=$_FILES['photo']['name'];
}
 $status=$Obj->update_product($id,$pname,$price,$discount,$description,$feature,$value,$pro,$thum);
 if($status==true){
 	  $msg="Product Updated Successfully";
 	 $_SESSION['success']=$msg;
 	 header("Location:product_list.php");
 }
 else{
 	 $msg=$status;
 	 $_SESSION['err']=$msg;
 	 header("Location:product_list.php");
 } 
}

?>