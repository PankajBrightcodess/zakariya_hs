<?php

	$school_id=$_POST['school_id'];
	$class_id=$_POST['class_id'];
	include_once "class/order.php";	
	$obj=new Order();
	$arr=$obj->get_price_by_products($school_id,$class_id);
	//print_r($arr);
	if(is_array($arr))
   echo json_encode($arr);

?>