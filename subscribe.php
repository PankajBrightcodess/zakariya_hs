<?php
include('admin/class/config.php');
$obj=Database::getInstance();
if(isset($_POST['subscribe'])){
	$email=strip_tags($_POST['email']);
	$table="`tbl_subscriptions`";
	$columns="(`email`,`active`)";
	$values="('$email','1')";
	$run=$obj->insert($table,$columns,$values);
	if($run===true){
		$email_from="subscribe@bookmysyllabus.com";
		
		$msg="Welcome to Book My Syllabus, <br>";
		$msg.="Thank you for subscribing to Book My Syllabus. You will receive email notification regarding products and offers.";
		$subject="Book My Syllabus : Subscription";
		
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		 
		// Create email headers
		$headers .= "From: Book My Syllabus <$email_from> \r\n".
			"Reply-To: Book My Syllabus <$email_from>\r\n" .
			'X-Mailer: PHP/' . phpversion();
		 
		// Compose a simple HTML email message
		$message = '<html><body>';
		$message .="<table><tr><td colspan='2'><img src='http://bookmysyllabus.com/images/logo.png' height='60'></td><td></td></tr>";
		$message .="<tr><td width='10%'></td><td><h3>$msg</h3></td><td width='10%'></td></tr>";
		$message .="<tr><td colspan='2'><h3>Regards,</h3>Book My Syllabus Team</td></tr>";
		$message .= '</table></body></html>';
		 
		// Sending email
		if(mail($email, $subject, $message, $headers)){
			//echo 'Your mail has been sent successfully.';
		} else{
			//echo 'Unable to send email. Please try again.';
		}
	}
	header("Location:index.php");
}
elseif(isset($_POST['checkPincode'])){
	$pincode=$_POST['pincode'];
	$count=$obj->get_count("`tbl_pincode`","`pincode`='$pincode'");
	if($count>0){
		echo "1";
	}
	else{
		echo "0";
	}
}
else{
	header("Location:index.php");
}
?>