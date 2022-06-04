<?php
session_start();
include_once "class/config.php";
$obj=Database::getInstance();
if(isset($_GET['deletesubscriber']) && $_GET['deletesubscriber']=='deletesubscriber'){
	$id=$_GET['id'];
	$delete=$obj->delete("`tbl_subscriptions`","`id`='$id'");
	if($delete===true){
		$_SESSION['msg']="Successfully Deleted";	
	}else{
		$_SESSION['err']=$delete;
	}
}
header("Location:subscribers.php");

?>