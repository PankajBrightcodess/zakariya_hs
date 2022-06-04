<?php
session_start();
if(isset($_SESSION['user_id'])){
	$user_id=$_SESSION['user_id'];
}else{
	header("Location:index.php");
}
include('admin/class/config.php');
include('admin/class/getpost-lib.php');
$obj=Database::getInstance();
if(isset($_POST['submitAddress'])){
	$name=strip_tags($_POST['name']);
	$student_name=strip_tags($_POST['student_name']);
	$address=strip_tags($_POST['address']);
	$landmark=strip_tags($_POST['landmark']);
	$postoffice=strip_tags($_POST['postoffice']);
	$district=strip_tags($_POST['district']);
	$pincode=strip_tags($_POST['pincode']);
	$state=strip_tags($_POST['state']);
	$mobile=strip_tags($_POST['mobile']);
	$table="`tbl_tempadd`";
	$columns="(`user_id`,`name`, `student_name`, `address`,`landmark`, `postoffice`, `district`, `mobile`, `pincode`, `state`) ";
	$values="('$user_id','$name','$student_name','$address','$landmark','$postoffice','$district','$mobile','$pincode','$state')";
	$run=$obj->insert($table,$columns,$values);
	if($run===true){
		$_SESSION['msg']="Added Successfully";
		header("Location:orderconfirmation.php");
	}
	else{
		$_SESSION['err']=$run;
		header("Location:selectAddress.php");
	}
}
elseif(isset($_POST['submitOrder'])){
	$date=date('Y-m-d');
	$total_amount=$_POST['total_amount'];
	$name=$_POST['name'];
	$payment=$_POST['payment'];
	$user_id=$_POST['user_id'];
	$add=$obj->get_details("`tbl_tempadd`","*","`user_id`='$user_id'");
	$delete=$obj->delete("`tbl_tempadd`","`user_id`='$user_id'");
	$student_name=$add['student_name'];
	$address=$add['address'];
	$landmark=$add['landmark'];
	$postoffice=$add['postoffice'];
	$district=$add['district'];
	$mobile=$add['mobile'];
	$pincode=$add['pincode'];
	$state=$add['state'];
	$table="`tbl_orders`";
	$columns="(`date`,`user_id`, `payment`, `name`, `student_name`, `address`, `landmark`, `postoffice`, `district`, `mobile`, `pincode`, `state`, `total_amount`)";
	$values="('$date','$user_id','$payment','$name','$student_name','$address','$landmark','$postoffice','$district','$mobile','$pincode','$state','$total_amount')";
	$run=$obj->insert($table,$columns,$values);
	if($run===true){
		$table2="`tbl_orderlist`";
		$lastrow=$obj->get_last_row($table,"`id`","`user_id`='$user_id'");
		$order_id=$lastrow['id'];
		$order_list=$obj->get_rows("`tbl_cart`","*","`user_id`='$user_id'");
		$delete=$obj->delete("`tbl_cart`","`user_id`='$user_id'");
		$columns2="(`order_id`, `user_id`, `school_id`, `class_id`, `booklist_id`, `product`, `product_id`, `price`, `quantity`, `amount`)";
		foreach($order_list as $products){
			$school_id=$products['school_id'];$class_id=$products['class_id'];$product=$products['product'];
			$product_id=$products['product_id'];$price=$products['price'];$quantity=$products['quantity'];$booklist_id=$products['booklist_id'];
			$amount=$products['amount'];if($booklist_id!=0){$bklist_id=$booklist_id;}else{$bklist_id=0;}
			$values2="('$order_id','$user_id','$school_id','$class_id','$booklist_id','$product','$product_id','$price','$quantity','$amount')";
			$run=$obj->insert($table2,$columns2,$values2);
		}
		$details=$obj->get_details("`tbl_member`","`email`","`id`='$user_id'");
		$email_to=$details['email'];
		$email_from="order@bookmysyllabus.com";
		
		$msg="Welcome to Book My Syllabus, ";
		if($bklist_id==0){
			$msg.="Your Order is successfully placed. Your Order No is : $order_id and amount payable is Rs. $total_amount." ;
			$msg.="Your Order will be delivered within 5 Days. ";
		}
		else{
			$msg.="Your Booklist is uploaded successfully and your Order No is : $order_id. We will reply shortly regarding price and other details.";
		}
		$subject="Book My Syllabus : Orders";
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 
		// Create email headers
		$headers .= "From: Book My Syllabus <$email_from> \r\n".
			"Reply-To: Book My Syllabus <$email_from>\r\n" .
			'X-Mailer: PHP/' . phpversion();
		 
		// Compose a simple HTML email message
		$message = '<html><body>';
		$message .="<table><tr><td colspan='2'><img src='http://bookmysyllabus.com/images/logo.png' height='60'></td><td></td></tr>";
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
		$_SESSION['msg']="Order Placed Successfully!";
		header("Location:orderplaced.php");
	}
	else{
		$_SESSION['err']=$run;
		header("Location:cart.php");
	}
}
else{
	header("Location:index.php");
}
?>