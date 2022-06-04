<?php 
session_start();
include_once "class/order.php";
include('class/getpost-lib.php');
if(isset($_POST['submit']))
{
$date=$_POST['date'];
$sname=strip_tags($_POST['sname']);
$name=strip_tags($_POST['name']);
$phone=strip_tags($_POST['phone']);
$email=strip_tags($_POST['email']);
$address=addslashes($_POST['address']);
$lmark=$_POST['lmark'];
$po=$_POST['po'];
$district=$_POST['district'];
$pincode=strip_tags($_POST['pincode']);
$state=$_POST['state'];

$school_id=strip_tags($_POST['school_id']);
$class_id=strip_tags($_POST['class_id']);
$product=$_POST['product'];

$Obj= new Order();
$amount=$Obj->get_amount_by_products($school_id,$class_id);

 $status=$Obj->add_order($date,$sname,$name,$phone,$email,$address,$lmark,$po,$district,$pincode,$state,$school_id,$class_id,$product,$amount);
 if($status==true){
	 
	 $data=$Obj->get_idamount($phone,$name,$sname,$pincode);
	 $order_id=$data['id'];
	 $total_amount=$data['total_amount'];
	 
	$email_from="order@bookmysyllabus.com";	
	$msg="Welcome to Book My Syllabus, ";
	$msg.="Your Order is successfully placed. Your Order No is : $order_id and amount payable is Rs. $total_amount." ;
	$msg.="Your Order will be delivered within 5 Days. ";
	
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
	if(mail($email, $subject, $message, $headers)){
		//echo 'Your mail has been sent successfully.';
	} else{
		//echo 'Unable to send email. Please try again.';
	}
	sendsmsGET($phone,$senderId,$route,$msg,$serverUrl,$authKey);
 	  $msg="Order Added Successfully";
 	 $_SESSION['success']=$msg;
 	 header("Location:order_list.php");
 }
 else{
 	 $msg=$status;
 	 $_SESSION['err']=$msg;
 	 header("Location:order_list.php");
 } 
}

?>