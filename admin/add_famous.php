<?php 
session_start();
include_once "class/school.php";
if(isset($_POST['submit']))
{
/*  general info */	
$school_id=$_POST['school_id'];
if(isset($_POST['famous'])){
$famous=$_POST['famous'];
}
else{
$famous=array();
}

/* end  */
$Obj= new School();

 $status=$Obj->add_famous($school_id,$famous);
 if($status==true){
 	  $msg="Famous Added Successfully";
 	 $_SESSION['success']=$msg;
 	 header("Location:famous.php");
 }
 else{
 	 $msg=$status;
 	 $_SESSION['err']=$msg;
 	 header("Location:famous.php");
 } 
}

?>