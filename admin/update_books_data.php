<?php 
session_start();
include_once "class/books.php";
if(isset($_POST['submit']))
{
$id=strip_tags($_POST['id']);
//$school_id=strip_tags($_POST['school_id']);
//$class_id=strip_tags($_POST['class_id']);
//$subject_id=strip_tags($_POST['subject_id']);
$book_name=addslashes(strip_tags($_POST['book_name']));
$book_price=strip_tags($_POST['book_price']);
$book_discount=strip_tags($_POST['book_discount']);


$Obj= new Books();
 $status=$Obj->update_books($id,$book_name,$book_price,$book_discount);
 if($status==true){
 	  $msg="Books Updated Successfully";
 	 $_SESSION['success']=$msg;
 	 header("Location:book_list.php");
 }
 else{
 	 $msg=$status;
 	 $_SESSION['err']=$msg;
 	 header("Location:book_list.php");
 } 
}

?>