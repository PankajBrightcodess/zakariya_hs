<?php
session_start();
include('admin/class/config.php');
$obj=Database::getInstance();
if(isset($_POST['addReview'])){
	$product_id=$_POST['product_id'];
	$user_id=$_POST['user_id'];
	$rating=$_POST['rating'];
	$review=addslashes($_POST['review']);
	$table="`tbl_review`";
	$columns="(`product_id`, `user_id`, `review`, `rating`)";
	$values="('$product_id','$user_id','$review','$rating')";
	$run=$obj->insert($table,$columns,$values);
	$encid=md5($product_id);
	header("Location:productdetails.php?080f6d7f511a9128d45c370f50291f92=$encid");
}
else{
	header("Location:index.php");
}

?>