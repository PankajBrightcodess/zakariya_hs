<?php
include "class/school.php";
$id=$_POST['id'];
$obj=new School();
$status=$obj->sel_school_banner($id);
	if(is_array($status)){
		echo json_encode($status);
	}

?>