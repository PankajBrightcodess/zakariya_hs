<?php
session_start();
include("admin/class/config.php");
$obj=Database::getInstance();
if(isset($_POST['addtocart']) || (isset( $_POST['buypackage']) && $_POST['buypackage'])=='buypackage'){
	$school_id=$_POST['school_id'];
	$class_id=$_POST['class_id'];
	$order=implode(',',$_POST['order']);
	$total=$_POST['total'];
	$client_id=$_COOKIE['client_id'];
	$id=$_POST['id'];
	$table="`tbl_cart`";
	if($id==0){
		if(isset($_SESSION['user_id'])){
			$user_id=$_SESSION['user_id'];
			$columns="(`user_id`,";
			$val="('$user_id',";
			$update=$obj->update($table,"`user_id`='$user_id', `client_id`=''","`client_id`='$client_id'");
		}
		else{
			$columns="(`client_id`,";
			$val="('$client_id',";
		}
		$columns.=" `school_id`, `class_id`, `product`,`price`, `quantity`, `amount`)";
		$values=$val." '$school_id','$class_id','$order','$total','1','$total')";
		$run=$obj->insert($table,$columns,$values);
	}
	else{
		$col_values="`product`='$order',`amount`='$total',`price`='$total'";
		$run=$obj->update($table,$col_values,"`id`='$id'");
	}
	if($run===true){
		if(isset($_POST['buypackage']) && $_POST['buypackage']=='buypackage'){
			header("Location:selectaddress.php");
		}else{
			$_SESSION['msg']="Successfully Added to Cart!";
			header("Location:cart.php");
		}
	}
	else{
		$_SESSION['err']=$run;
		header("Location:cart.php");
	}
}
elseif(isset($_POST['tocart']) || (isset($_POST['buynow']) && $_POST['buynow']=='buynow')){
	$product_id=$_POST['product_id'];
	$product=$_POST['product'];
	$quantity=$_POST['quantity'];
	$price=$_POST['price'];
	$amount=$quantity*$price;
	$client_id=$_COOKIE['client_id'];
	$table="`tbl_cart`";
	if(isset($_SESSION['user_id'])){
		$user_id=$_SESSION['user_id'];
		$columns="(`user_id`,";
		$val="('$user_id',";
		$update=$obj->update($table,"`user_id`='$user_id', `client_id`=''","`client_id`='$client_id'");
		$where="`user_id`='$user_id'";
		$delete=$obj->delete("`tbl_wishlist`",$where." and `product_id`='$product_id'");
	}
	else{
		$columns="(`client_id`,";
		$val="('$client_id',";
		$where="`client_id`='$client_id'";
	}
	$count=$obj->get_count($table,$where." and `product_id`='$product_id'");
	if($count==0){
		$columns.=" `product_id`, `product`,`price`, `quantity`, `amount`)";
		$values=$val." '$product_id','$product','$price','$quantity','$amount')";
		$run=$obj->insert($table,$columns,$values);
	}
	else{
		$col_values="`quantity`=`quantity`+'$quantity', `amount`=`amount`+'$amount'";
		$run=$obj->update($table,$col_values,$where." and `product_id`='$product_id'");
	}
	if($run===true){
		if(isset($_POST['buynow']) && $_POST['buynow']=='buynow'){
			if(isset($_SESSION['user_id'])){
				header("Location:selectaddress.php");
			}else{
				header("Location:cart.php");
			}
		}else{
			$_SESSION['msg']="Successfully Added to Cart!";
			header("Location:cart.php");
		}
	}
	else{
		$_SESSION['err']=$run;
		header("Location:cart.php");
	}
}
elseif(isset($_POST['updateCart'])){
	$id=$_POST['id'];
	$quantity=$_POST['quantity'];
	$price=$_POST['price'];
	$amount=$quantity*$price;
	$table="`tbl_cart`";
	$col_values="`price`='$price',`quantity`='$quantity',`amount`='$amount'";
	$run=$obj->update($table,$col_values,"`id`='$id'");
	if($run===true){
		$_SESSION['msg']="Successfully Updated!";
		header("Location:cart.php");
	}
	else{
		$_SESSION['err']=$run;
		header("Location:cart.php");
	}
}
elseif(isset($_POST['upload'])){
	$user_id=$_SESSION['user_id'];
	$school_id=$_POST['school_id'];
	$school=addslashes($_POST['school']);
	$class_id=$_POST['class_id'];
	$table="`tbl_booklist`";
	//$ext=end(explode('.',$_FILES['booklist']['name']));
	$temp=$_FILES['booklist']['tmp_name'];
	$filename="booklist/".$_FILES['booklist']['name'];
	$columns="(`user_id`, `school_id`, `school`, `class_id`, `path`)";
	$values="('$user_id','$school_id','$school','$class_id','$filename')";
	$run=$obj->insert($table,$columns,$values);
	if($run===true){
		move_uploaded_file($temp,"admin/".$filename);
		$table2="`tbl_cart`";
		$selid=$obj->get_last_row($table,"`id`","`user_id`='$user_id'");
		$booklist_id=$selid['id'];
		$columns2="(`user_id`, `school_id`, `class_id`, `quantity`,`booklist_id`)";
		$values2="('$user_id','$school_id','$class_id','1','$booklist_id')";
		$run2=$obj->insert($table2,$columns2,$values2);	
		$_SESSION['msg']="Booklist Uploaded Successfully!";
		
	}
	else{
		$_SESSION['err']=$run;
	}
	header("Location:selectaddress.php");
}
?>