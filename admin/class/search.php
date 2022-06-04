<?php
include_once "config.php"; 
class Search{

  private static $conn;

  function __construct(){
  	  $db=Database::getInstance();
  	  self::$conn=$db->getConnection();
  }

function get_all_school()
{
	$sql="select * FROM `tbl_school`";
	$rs=self::$conn->query($sql);
	$schools=array();
	if($rs->num_rows>0){
		while($row=$rs->fetch_array())
		{
       	  $schools[]=$row;
		}
          return $schools;
        }
		  else{
			 return false;
		  }
	
}

function get_all_class()
{
	$sql="select * FROM `tbl_class`";
	$rs=self::$conn->query($sql);
	$cls=array();
	if($rs->num_rows>0){
		while($row=$rs->fetch_array())
		{
       	  $cls[]=$row;
		}
          return $cls;
        }
		  else{
			 return false;
		  }
	
}



}

?>