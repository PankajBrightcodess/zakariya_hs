<?php 
session_start();
include_once "class/books.php";
if(isset($_POST['submit']))
{
$school_id=strip_tags($_POST['school_id']);
$class_id=strip_tags($_POST['class_id']);
$subject_id=strip_tags($_POST['subject_id']);
$book_name=$_POST['book_name'];
$book_price=$_POST['book_price'];
$book_discount=$_POST['book_discount'];


$Obj= new Books();
 $status=$Obj->add_books($school_id,$class_id,$subject_id,$book_name,$book_price,$book_discount);
 if($status==true){
 	  $msg="Books Added Successfully";
 	 $_SESSION['success']=$msg;
 	 header("Location:add_book.php");
 }
 else{
 	 $msg=$status;
 	 $_SESSION['err']=$msg;
 	 header("Location:add_book.php");
 } 
}

?>