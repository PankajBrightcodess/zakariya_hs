<?php
include_once "config.php"; 
class Member{

  private static $conn;

  function __construct(){
  	  $db=Database::getInstance();
  	  self::$conn=$db->getConnection();
  }

/*************topbar Section***************/ 


function get_member_by_id($id) 
{
	 
	 $sql="SELECT * FROM `tbl_member` WHERE md5(id)='$id'";
       $rs=self::$conn->query($sql);
	  
       if($rs->num_rows>0){
       	 $data=$rs->fetch_array();
          return $data;
        }
		  else{
			 return false;
		  }
}


 function update_member($id,$status){

      $sql="UPDATE `tbl_member` SET `active`='$status' WHERE md5(id)='$id'";
	
  if(self::$conn->query($sql)){
        return true;
      }
      else{
         return false;
      }

  }
  
  



/************* End topbar Section***************/ 


}

?>