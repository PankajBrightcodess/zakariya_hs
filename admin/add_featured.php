<?php 
session_start();
include_once "class/school.php";
if(isset($_POST['submit']))
{
/*  general info */	
$school_id=$_POST['school_id'];
if(isset($_POST['featured'])){
$featured=$_POST['featured'];
}
else{
$featured=array();
}

/* end  */
$Obj= new School();
 $status=$Obj->add_featured($school_id,$featured);
 if($status==true){
 	  $msg="Featured Added Successfully";
 	 $_SESSION['success']=$msg;
 	 header("Location:featured.php");
 }
 else{
 	 $msg=$status;
 	 $_SESSION['err']=$msg;
 	 header("Location:featured.php");
 } 
}

?>