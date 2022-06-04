<?php
session_start();
if(!isset($_COOKIE['client_id'])){
	$cookie_value=md5(uniqid(rand(), true));
	setcookie('client_id', $cookie_value, time() + (86400 * 30), '/');
}
if(isset($_COOKIE['client_id'])){
	$client_id=$_COOKIE['client_id'];
}
else{
	$client_id=$cookie_value;
}
include "admin/class/config.php";
$obj=Database::getInstance();
if(isset($_POST['socialLogin']) && $_POST['socialLogin']!=''){
	$id=$_POST['id'];
	$name=$_POST['name'];
	$table="`tbl_member`";
	$columns="(`name`, `login_id`, `login_type`, `active`)";
	$values="('$name','$id','facebook','1')";
	$where="login_id='$id'";
	$data=$obj->get_count($table,$where);
	if($data==0)
	{
		$obj->insert($table,$columns,$values);
		$user=$obj->get_details($table,"`id`",$where);
		$_SESSION['user_id']=$user['id'];
	}else{
		$user=$obj->get_details($table,"`id`",$where);
		$_SESSION['user_id']=$user['id'];
	}
				$user_id=$user['id'];
				$update=$obj->update("`tbl_cart`","`user_id`='$user_id', `client_id`=''","`client_id`='$client_id'");
				$update=$obj->update("`tbl_wishlist`","`user_id`='$user_id', `client_id`=''","`client_id`='$client_id'");
				$products=$obj->get_rows("`tbl_cart`","*","`user_id`='$user_id'");
				$delete=$obj->delete("`tbl_cart`","`user_id`='$user_id'");
				$columns="(`user_id`, `school_id`, `class_id`, `product`, `product_id`, `price`, `quantity`, `amount`)";
				if(is_array($products)){
					foreach($products as $product){
						$school_id=$product['school_id']; $class_id=$product['class_id']; $pro=$product['product']; $product_id=$product['product_id'];
						$price=$product['price']; $quantity=$product['quantity']; $amount=$product['amount'];
						if($product_id!=0){
							$count=$obj->get_count("`tbl_cart`","`user_id`='$user_id' and `product_id`='$product_id'");
							if($count==0){
								$values="('$user_id','$school_id','$class_id','$pro','$product_id','$price','$quantity','$amount')";
								$insert=$obj->insert("`tbl_cart`",$columns,$values);
							}
							else{
								$col_values="`quantity`=`quantity`+'$quantity',`amount`=`amount`+'$amount'";
								$update=$obj->update("`tbl_cart`",$col_values,"`user_id`='$user_id' and `product_id`='$product_id'");
							}
						}
						else{
							$count=$obj->get_count("`tbl_cart`","`user_id`='$user_id' and `school_id`='$school_id' and `class_id`='$class_id'");
							if($count==0){
								$values="('$user_id','$school_id','$class_id','$pro','$product_id','$price','$quantity','$amount')";
								$insert=$obj->insert("`tbl_cart`",$columns,$values);
							}
							else{
								//$col_values="`quantity`=`quantity`+'$quantity',`amount`=`amount`+'$amount'";
								//$update=$obj->update("`tbl_cart`",$col_values,"`user_id`='$user_id' and `school_id`='$school_id' and `class_id`='$class_id'");
							}
						}
					}
				}
				if($link!=''){$location=$link;}
				unset($_SESSION['page']);
$_SESSION['social']=1;
echo $_SESSION['social'];
}
?>