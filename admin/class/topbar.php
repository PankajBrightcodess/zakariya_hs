<?php
include_once "config.php"; 
class Topbar{

  private static $conn;

  function __construct(){
  	  $db=Database::getInstance();
  	  self::$conn=$db->getConnection();
  }

/*************topbar Section***************/ 


function get_topbar_by_id($id) 
{
	 
	 $sql="SELECT * FROM `tbl_topbar` WHERE id='$id'";
       $rs=self::$conn->query($sql);
	  
       if($rs->num_rows>0){
       	 $data=$rs->fetch_array();
          return $data;
        }
		  else{
			 return false;
		  }
}


 function update_topbar($id,$topbar,$published){

      $sql="UPDATE `tbl_topbar` SET `value`='$topbar',`published`='$published' WHERE id='$id'";
	
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