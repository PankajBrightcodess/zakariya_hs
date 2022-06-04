<?php
session_start();

if(isset($_SESSION['user'])){
	  $role=$_SESSION['role'];
	  $user=$_SESSION['user'];
	  $id=$_POST['id'];
  }
		include_once "class/config.php"; 
		$db=Database::getInstance();
		$conn=$db->getConnection();
	  
   $sql="SELECT `id`, `username`, `password`, `role`, `active` FROM `users` WHERE  id='$id'";
   $rs=$conn->query($sql);
   $arr=$rs->fetch_array();
	
   echo json_encode($arr);

?>