<?php
session_start();
$user_id='';
$client_id='';
if(isset($_SESSION['user_id'])){
	$user_id=$_SESSION['user_id'];
	$where="`user_id`='$user_id'";
}
elseif(isset($_COOKIE['client_id'])){
	$client_id=$_COOKIE['client_id'];
	$where="`client_id`='$client_id'";
}
else{
	header("Location:cart.php");
}
include('admin/class/config.php');
include('admin/class/getpost-lib.php');
$obj=Database::getInstance();
if(isset($_GET['removeItem']) && $_GET['removeItem']=='removeItem'){
	$temp_id=$_GET['080f6d7f511a9128d45c370f50291f92'];
	$array=$obj->get_rows("`tbl_cart`","`id`",$where);
	$id="";
	foreach($array as $ids){
		if($temp_id==md5($ids['id'])){
			$id=$ids['id'];
			break;
		}
	}
	if($id!=''){
		$arr=$obj->get_details("`tbl_cart`","`booklist_id`","`id`='$id'");
		$booklist_id=$arr['booklist_id'];
		if($booklist_id!=0){
			$arr1=$obj->get_details("`tbl_booklist`","`path`","`id`='$booklist_id'");
			unlink("admin/".$arr1['path']);
			$run2=$obj->delete("`tbl_booklist`","`id`='$booklist_id'");
		}
		$run=$obj->delete("`tbl_cart`","`id`='$id'");
		if($run===true){
			if(isset($_GET['wishlist']) && $_GET['wishlist']=='wishlist'){
				$_SESSION['msg']="Item Added to Wishlist !";
			}else{
				$_SESSION['msg']="Item Deleted Successfully !";
			}
			header("Location:cart.php");
		}
		else{
			$_SESSION['err']=$run;
			header("Location:cart.php");
		}
	}
	else{
		header("Location:cart.php");
	}
}
elseif(isset($_GET['cancelOrder']) && $_GET['cancelOrder']=='cancelOrder'){
	$temp_id=$_GET['080f6d7f511a9128d45c370f50291f92'];
	$array=$obj->get_rows("`tbl_orders`","`id`",$where);
	foreach($array as $ids){
		if($temp_id==md5($ids['id'])){
			$id=$ids['id'];
			break;
		}
	}if($id!=''){
		$run=$obj->update("`tbl_orders`","`status`='3'","`id`='$id'");
		if($run===true){
			$seluser=$obj->get_details("`tbl_orders`","`name`,`user_id`,`mobile`","`id`='$id'");
			$name=$seluser['name'];
			$user_id=$seluser['user_id'];
			$mobile=$seluser['mobile'];
			$details=$obj->get_details("`tbl_member`","`email`","`id`='$user_id'");
			$email_to=$details['email'];
			$email_from="bookmysyllabus@gmail.com";
			
			$msg="Your Order $id is Cancelled. Thank you for consulting Book My Syllabus.";
			
			$subject="Book My Syllabus : Orders";
			
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			 
			// Create email headers
			$headers .= "From: $email_from \r\n".
				'Reply-To: '.$email_from."\r\n" .
				'X-Mailer: PHP/' . phpversion();
			 
			// Compose a simple HTML email message
			$message = '<html><body>';
			$message .="<table><tr><td colspan='2'><img src='http://rsgss.in:8888/bms/images/logo.png' height='60'></td><td></td></tr>";
			$message .="<tr><td colspan='3'><h2>Hello $name,</h2></td></tr>";
			$message .="<tr><td width='10%'></td><td><h3>$msg</h3></td><td width='10%'></td></tr>";
			$message .="<tr><td colspan='2'><h3>Regards,</h3>Book My Syllabus Team</td></tr>";
			$message .= '</table></body></html>';
			 
			// Sending email
			if(mail($email_to, $subject, $message, $headers)){
				//echo 'Your mail has been sent successfully.';
			} else{
				//echo 'Unable to send email. Please try again.';
			}
			sendsmsGET($mobile,$senderId,$route,$msg,$serverUrl,$authKey);
			$_SESSION['msg']="Order Cancelled !";
		}
		else{
			$_SESSION['err']=$run;
		}
		header("Location:myorders.php");
	}
	else{
		header("Location:myorders.php");
	}
}
else{
	header("Location:index.php");
}
?>