<?php
session_start();
include('admin/class/config.php');
$obj=Database::getInstance();
if(isset($_POST['updateProfile'])){
	$id=$_POST['id'];
	$name=strip_tags($_POST['name']);
	$email=strip_tags($_POST['email']);
	$mobile=strip_tags($_POST['mobile']);
	$table="`tbl_member`";
	$col_values="`name`='$name', `email`='$email', `mobile`='$mobile'";
	$where="`id`='$id'";
	$run=$obj->update($table,$col_values,$where);
	if($run===true){
		$_SESSION['msg']="Successfully Updated";
		header("Location:profile.php");
	}
	else{
		$_SESSION['err']=$run;
		header("Location:profile.php");
	}
}
elseif(isset($_POST['updatePassword'])){
	$id=$_POST['id'];
	$old=strip_tags($_POST['old']);
	$password=strip_tags($_POST['password']);
	$wh=" and `password`";
	if($old!=''){
		$old=md5($old);
		$wh.="='$old'";
	}
	else{
		$wh.=" IS NULL";
	}
	$password=md5($password);
	$table="`tbl_member`";
	$count=$obj->get_count($table,"`id`='$id' $wh");
	if($old!=$password){
		if($count==1){
			$col_values="`password`='$password'";
			$where="`id`='$id'";
			$run=$obj->update($table,$col_values,$where);
			if($run===true){
				$_SESSION['msg']="Password Updated Successfully";
			}
			else{
				$_SESSION['err']=$run;
			}
		}
		else{
			$_SESSION['err']="Old Password Doesn't Match!";
		}
	}
	else{
		$_SESSION['err']="New Password is same as Old Password!";
	}
	header("Location:changepassword.php");
}
elseif(isset($_POST['addAddress'])){
	$id=$_POST['id'];
	$address=strip_tags($_POST['address']);
	$landmark=strip_tags($_POST['landmark']);
	$postoffice=strip_tags($_POST['postoffice']);
	$district=strip_tags($_POST['district']);
	$pincode=strip_tags($_POST['pincode']);
	$state=strip_tags($_POST['state']);
	$mobile=strip_tags($_POST['mobile']);
	$table="`tbl_address`";
	$columns="(`user_id`, `address`,`landmark`, `postoffice`, `district`, `mobile`, `pincode`, `state`) ";
	$values="('$id','$address','$landmark','$postoffice','$district','$mobile','$pincode','$state')";
	$run=$obj->insert($table,$columns,$values);
	if($run===true){
		$_SESSION['msg']="Added Successfully";
	}
	else{
		$_SESSION['err']=$run;
	}
	if(isset($_POST['page'])){
		header("Location:selectaddress.php");
	}else{
		header("Location:addressbook.php");
	}
}
elseif(isset($_POST['updateAddress'])){
	$id=$_POST['id'];
	$address=strip_tags($_POST['address']);
	$landmark=strip_tags($_POST['landmark']);
	$postoffice=strip_tags($_POST['postoffice']);
	$district=strip_tags($_POST['district']);
	$pincode=strip_tags($_POST['pincode']);
	$state=strip_tags($_POST['state']);
	$mobile=strip_tags($_POST['mobile']);
	$table="`tbl_address`";
	$col_values="`address`='$address',`landmark`='$landmark', `postoffice`='$postoffice', `district`='$district', `mobile`='$mobile', `pincode`='$pincode', `state`='$state' ";
	$where="`id`='$id'";
	$run=$obj->update($table,$col_values,$where);
	if($run===true){
		$_SESSION['msg']="Updated Successfully";
		header("Location:addressbook.php");
	}
	else{
		$_SESSION['err']=$run;
		header("Location:addressbook.php");
	}
}
elseif(isset($_GET['deleteAddress']) && $_GET['deleteAddress']=='deleteAddress'){
	$id=$_GET['id'];
	$table="`tbl_address`";
	$run=$obj->delete($table,"`id`='$id'");
	if($run===true){
		$_SESSION['msg']="Deleted Successfully";
		header("Location:addressbook.php");
	}
	else{
		$_SESSION['err']=$run;
		header("Location:addressbook.php");
	}
}
else{
	header("Location:index.php");
}
?>