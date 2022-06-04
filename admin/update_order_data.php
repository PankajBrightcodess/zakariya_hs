<?php 
session_start();
include_once "class/order.php";
include_once "class/getpost-lib.php";
if(isset($_POST['submit']))
{
$id=strip_tags($_POST['id']);	
	
/*  general info */	
$user_id=strip_tags($_POST['user_id']);
$mobile=strip_tags($_POST['mobile']);
$status=strip_tags($_POST['status']);
$dispatch=strip_tags($_POST['dispatch']);
$delivery=strip_tags($_POST['delivery']);
$delivered=strip_tags($_POST['delivered']);
$name=$_POST['name'];
$total_amount=$_POST['total_amount'];

/* end  */

$Obj= new Order();
$email_to=$Obj->getuserdata($user_id);
 $run=$Obj->update_order($id,$status,$dispatch,$delivery,$delivered);
	$email_from="order@bookmysyllabus.com";
	
	$msg="";
	if($status==1){
		$msg.="Your Order No $id is dispatched today. Expected Delivery date of your order is ".date('d-m-Y',strtotime($delivery)).". The amount payable is Rs. $total_amount." ;
	}
	elseif($status==2){
		$msg.="Your Order No $id is Delivered on ".date('d-m-Y',strtotime($delivered)).". Thank you for consulting Book My Syllabus." ;
	}
	elseif($status==3){
		$msg.="Your Order No $id is Cancelled. Thank you for consulting Book My Syllabus." ;
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
	//echo $senderId;
	sendsmsGET($mobile,$senderId,$route,$msg,$serverUrl,$authKey);
 if($run==true){
 	  $msg="Order Updated Successfully";
 	 $_SESSION['success']=$msg;
 	 header("Location:order_list.php");
 }
 else{
 	 $msg=$run;
 	 $_SESSION['err']=$msg;
 	 header("Location:order_list.php");
 } 
}

?>