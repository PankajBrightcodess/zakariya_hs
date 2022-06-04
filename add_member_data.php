<?php 
session_start();
include_once "admin/class/config.php";
include('admin/class/getpost-lib.php');
$obj=Database::getInstance();
if(isset($_POST['submit']))
{
$name=strip_tags($_POST['name']);
$mobile=strip_tags($_POST['mobile']);
$email=strip_tags($_POST['email']);
$password=strip_tags($_POST['password']);
$password=md5($password);
$table="tbl_member";
$columns="(`name`, `mobile`, `email`, `password`,`active`)";
$values="('$name','$mobile','$email','$password','1')";

$status=$obj->insert($table,$columns,$values);
 if($status==true){
	if($mobile!=''){
		$msg="Welcome $name, You have successfully registered for Book My Syllabus.";
		sendsmsGET($mobile,$senderId,$route,$msg,$serverUrl,$authKey);	 
	}
	 
 	  $msg="Member Added Successfully";
 	 $_SESSION['success']=$msg;
 	 header("Location:login.php");
 }
 else{
 	 $msg=$status;
 	 $_SESSION['err']=$msg;
 	 header("Location:login.php");
 } 
}
elseif(isset($_POST['checkid'])){
	$username=$_POST['userid'];
	$user=md5($username);
	$table="`tbl_member`";
	$where="`email`='$username' or `mobile`='$username'";
	$count=$obj->get_count($table,$where);
	if($count==1){
		$otp=rand(000000,999999);
		$encotp=md5($otp);
		$encuser=md5($username);
		//echo md5('user');
		$run=$obj->update($table,"`otp`='$encotp',`updated_on`=NOW()",$where);
		$sub="Reset Password";
		$message="Use the Link given below to Reset Password. ";
		$message.="http://bookmysyllabus.com/reset.php?resetpassword=true&d2270e7120a93c8b0a6a34760e654c7d=$encotp&ee11cbb19052e40b07aac0ca060c23ee=$encuser";
		$message.=" Or use this OTP to Reset Password ".$otp;
		$message.=". This Link and OTP is valid for 1 hour and can be used only once!";
		//echo $message;
		if(strpos($username,"@")===false){
			sendsmsGET($username,$senderId,$route,$message,$serverUrl,$authKey);
		}
		else{
			mail($username,$sub,$message);
		}
		header("Location:enterotp.php?ee11cbb19052e40b07aac0ca060c23ee=$user");	
		
	}else{
		if(strpos($username,"@")===false){$msg="Mobile not registered!";}
		else{$msg="Email not registered!";}
		$_SESSION['msg']=$msg;
		header('Location:forgotpassword.php');
	}
}
elseif(isset($_POST['resetpassword'])){
	$user=$_POST['userid']; 
	$otp=$_POST['otp']; 
	$password=strip_tags($_POST['password']);
	$password=md5($password);
	$table="`tbl_member`";
	$where="(md5(`email`)='$user' or md5(`mobile`)='$user') and `otp`='$otp'";
	$run=$obj->update($table,"`password`='$password',`otp`=''",$where);
	header("Location:success.php");
}

?>