<?php
include_once "config.php"; 
class Books{

  private static $conn;

  function __construct(){
  	  $db=Database::getInstance();
  	  self::$conn=$db->getConnection();
  }

/*************Subject Section***************/ 

function add_subject($fullname,$published)
{
	
	$sql="INSERT INTO `tbl_subject`(`name`, `published`) VALUES ('$fullname','$published')";
	
	if(self::$conn->query($sql)){
        return true;
      }
      else{
         return false;
      }
	
}

function get_subject_by_id($id) 
{
	 
	 $sql="SELECT * FROM `tbl_subject` WHERE id='$id'";
       $rs=self::$conn->query($sql);
	  
       if($rs->num_rows>0){
       	 $data=$rs->fetch_array();
          return $data;
        }
		  else{
			 return false;
		  }
}


 function update_subject($id,$fullname,$published){

      $sql="UPDATE `tbl_subject` SET `name`='$fullname',`published`='$published' WHERE id='$id'";
	
  if(self::$conn->query($sql)){
        return true;
      }
      else{
         return false;
      }

  }
  
  

function del_subject($id){
	  
       $sql="delete from tbl_subject where id='$id'";
       if(self::$conn->query($sql)){
          return true;
       }
       else{
          return false;
       }
  }

/************* End Subject Section***************/ 

/******************* Book Section***************/ 

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

function get_all_subject()
{
	$sql="select * FROM `tbl_subject`";
	$rs=self::$conn->query($sql);
	$subjects=array();
	if($rs->num_rows>0){
		while($row=$rs->fetch_array())
		{
       	  $subjects[]=$row;
		}
          return $subjects;
        }
		  else{
			 return false;
		  }
	
}

function get_all_class()
{
	$sql="select * FROM `tbl_class`";
	$rs=self::$conn->query($sql);
	$class=array();
	if($rs->num_rows>0){
		while($row=$rs->fetch_array())
		{
       	  $class[]=$row;
		}
          return $class;
        }
		  else{
			 return false;
		  }
	
}

function add_books($school_id,$class_id,$subject_id,$book_name,$book_price,$book_discount)
{
	
	$bookCount = count($book_name);
	
	$query = "INSERT INTO `tbl_books`(`name`, `mrp`, `discount`, `cost`, `subject_id`, `class_id`, `school_id`) VALUES ";
	$queryValue = "";
	for($i=0;$i<$bookCount;$i++) {
		if(!empty($book_name[$i]) || !empty($book_price[$i]) || !empty($book_discount[$i])) {
			$cost[$i]=$book_price[$i]-($book_price[$i] *($book_discount[$i]/100));
			if($queryValue!="") {
				$queryValue .= ",";
			}
			$queryValue .= "('" .$book_name[$i]. "', '" .$book_price[$i]. "', '" .$book_discount[$i]. "', '" .$cost[$i]. "',  '" .$subject_id. "',  '" .$class_id. "',  '" .$school_id. "')";
			}
		}
	 $sql = $query.$queryValue;
		
	if(self::$conn->query($sql)){
        return true;
      }
      else{
         return false;
      }
	
}

function get_book_by_id($id) 
{
	 
	 $sql="SELECT t1.name as book,t1.mrp,t1.discount,t2.name as subject,t3.class,t4.name as school from tbl_books t1,tbl_subject t2,tbl_class t3,tbl_school t4 where t1.subject_id=t2.id and t1.class_id=t3.id and t1.school_id=t4.id and t1.id='$id'";
       $rs=self::$conn->query($sql);
	  
       if($rs->num_rows>0){
       	 $data=$rs->fetch_array();
          return $data;
        }
		  else{
			 return false;
		  }
}


function update_books($id,$book_name,$book_price,$book_discount){
	  
       $cost=$book_price-($book_price * ($book_discount/100));
      $sql="UPDATE `tbl_books` SET `name`='$book_name',`mrp`='$book_price',`discount`='$book_discount',`cost`='$cost' WHERE id='$id'";
	
  if(self::$conn->query($sql)){
        return true;
      }
      else{
         return false;
      }

  }
  

function del_book($id){
	  
       $sql="delete from tbl_books where id='$id'";
       if(self::$conn->query($sql)){
          return true;
       }
       else{
          return false;
       }
  }


/*******************End Book Section***************/



}

?>