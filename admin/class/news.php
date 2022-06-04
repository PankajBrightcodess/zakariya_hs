<?php
include_once "config.php"; 
class News{

  private static $conn;

  function __construct(){
  	  $db=Database::getInstance();
  	  self::$conn=$db->getConnection();
  }


function add_news($date,$title,$link,$description,$published)
{
	
	$sql = "INSERT INTO `tbl_news`(`date`, `title`, `link`, `description`, `published`) VALUES ('$date','$title','$link','$description','$published')";
	
	if(self::$conn->query($sql)){
        return true;
      }
      else{
         return false;
      }
}


function get_news_by_id($id) 
{
	 
	 $sql="SELECT * FROM `tbl_news` WHERE id='$id'";
       $rs=self::$conn->query($sql);
	  
       if($rs->num_rows>0){
       	 $data=$rs->fetch_array();
          return $data;
        }
		  else{
			 return false;
		  }
}

function update_news($id,$date,$title,$link,$description,$published){
      
	
      $sql="UPDATE `tbl_news` SET `date`='$date',`title`='$title',`link`='$link',`description`='$description',`published`='$published' WHERE id='$id'";
	
  if(self::$conn->query($sql)){
        return true;
      }
      else{
         return false;
      }

  }

function del_news($id){
	  
       $sql="delete from tbl_news where id='$id'";
       if(self::$conn->query($sql)){
          return true;
       }
       else{
          return false;
       }
  }


}

?>