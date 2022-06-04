<?php
include_once "config.php"; 
class Pincode{

  private static $conn;

  function __construct(){
  	  $db=Database::getInstance();
  	  self::$conn=$db->getConnection();
  }



function add_pincode($pincode,$po,$district,$state)
{
	
	 $sql ="INSERT INTO `tbl_pincode`(`pincode`, `po`, `district`, `state`) VALUES ('$pincode','$po','$district','$state')";
	 
	if(self::$conn->query($sql)){
        return true;
      }
      else{
         return false;
      }
}



function del_pincode($id){
	  
       $sql="delete from tbl_pincode where id='$id'";
	   
       if(self::$conn->query($sql)){
          return true;
       }
       else{
          return false;
       }
  }


}

?>