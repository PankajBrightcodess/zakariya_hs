<?php
include_once "config.php"; 
class Footer{

  private static $conn;

  function __construct(){
  	  $db=Database::getInstance();
  	  self::$conn=$db->getConnection();
  }

/*************topbar Section***************/ 


function get_footer_by_id($id) 
{
	 
	 $sql="SELECT * FROM `tbl_footer` WHERE id='$id'";
       $rs=self::$conn->query($sql);
	  
       if($rs->num_rows>0){
       	 $data=$rs->fetch_array();
          return $data;
        }
		  else{
			 return false;
		  }
}


 function update_footer($id,$title,$value,$published){

      $sql="UPDATE `tbl_footer` SET `title`='$title',`value`='$value',`published`='$published' WHERE id='$id'";
	
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