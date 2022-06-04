<?php
session_start();
$user_id="";$client_id="";
include("admin/class/config.php");
$db=Database::getInstance();
if(isset($_SESSION['user_id'])){
	$user_id=$_SESSION['user_id'];
	$where="`user_id`='$user_id'";
}
elseif(isset($_COOKIE['client_id'])){
	$client_id=$_COOKIE['client_id'];
	$where="`client_id`='$client_id'";
}
if(isset($_POST['towishlist'])){
	$product_id=$_POST['product_id'];
	$product=$_POST['product'];
	$table="`tbl_wishlist`";
	$count=$db->get_count($table,$where." and `product_id`='$product_id'");
	if($count==0){
		$columns="(`user_id`, `client_id`, `product_id`, `product`)";
		$values="('$user_id','$client_id','$product_id','$product')";
		$run=$db->insert($table,$columns,$values);
	}
}

if(isset($_GET['deleteProduct']) && $_GET['deleteProduct']=='deleteProduct'){
	$temp_id=$_GET['080f6d7f511a9128d45c370f50291f92'];
	$array=$db->get_rows("`tbl_wishlist`","`id`");
	$id="";
	foreach($array as $ids){
		if($temp_id==md5($ids['id'])){
			$id=$ids['id'];
			break;
		}
	}
	if($id!=''){
		$run=$db->delete("`tbl_wishlist`","`id`='$id'");
		if($run===true){
			$_SESSION['msg']="Product Deleted Successfully !";
			header("Location:mywishlist.php");
		}
		else{
			$_SESSION['err']=$run;
			header("Location:mywishlist.php");
		}
	}
	else{
		header("Location:mywishlist.php");
	}
}
?>