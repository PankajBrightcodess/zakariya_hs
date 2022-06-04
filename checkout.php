<?php
session_start();
if(isset($_SESSION['user_id'])){
	//header("Location:selectaddress.php");
	echo  1;
}
else{
	if(isset($_POST['page'])){$_SESSION['page']=$_POST['page'];}
	//header("Location:login.php");
	echo 0;
}

?>