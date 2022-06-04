<?php 
session_start();
include_once "class/footer.php";
if(isset($_POST['submit']))
{
$id=strip_tags($_POST['id']);	
$footer=strip_tags($_POST['footer']);	
/*  general info */	
$title=addslashes(strip_tags($_POST['title']));
$value=addslashes(strip_tags($_POST['value']));

/* end  */


$published=strip_tags($_POST['published']);
$Obj= new Footer();
 $status=$Obj->update_footer($id,$title,$value,$published);
 if($status==true){
 	  $msg="Footer Updated Successfully";
 	 $_SESSION['success']=$msg;
	 if($footer==1){header("Location:footer1.php");}
 	 if($footer==2){header("Location:footer2.php");}
	 if($footer==3){header("Location:footer3.php");}
	 if($footer==4){header("Location:footer4.php");}
 }
 else{
 	 $msg=$status;
 	 $_SESSION['err']=$msg;
 	if($footer==1){header("Location:footer1.php");}
 	 if($footer==2){header("Location:footer2.php");}
	 if($footer==3){header("Location:footer3.php");}
	 if($footer==4){header("Location:footer4.php");}
 } 
}

?>