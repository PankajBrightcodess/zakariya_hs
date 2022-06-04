<?php 
session_start();
include_once "class/school.php";
if(isset($_POST['submit']))
{
/*  general info */	
$id=strip_tags($_POST['school_id']);
$banner=strip_tags($_FILES['photo']['name']);
$bannerpath=time().rand(00,99).$banner;
$temp=strip_tags($_FILES['photo']['tmp_name']);
$folder="banners/".$bannerpath;

$logo=strip_tags($_FILES['logo']['name']);
$logopath=time().rand(00,99).$logo;
$temp1=strip_tags($_FILES['logo']['tmp_name']);
$folder1="logo/".$logopath;

$Obj= new School();
 $status=$Obj->add_images($id,$folder,$folder1);
 if($status==true){
	 move_uploaded_file($temp,$folder);
	 move_uploaded_file($temp1,$folder1);
 	  $msg="Image Uploaded!";
 	 $_SESSION['success']=$msg;
 	 header("Location:uploads.php");
 }
 else{
 	 $msg=$status;
 	 $_SESSION['err']=$msg;
 	 header("Location:uploads.php");
 } 
}

?>