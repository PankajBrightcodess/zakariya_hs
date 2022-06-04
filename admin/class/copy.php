<?php
include_once "config.php"; 
class Copies{

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

function add_copies($school_id,$class_id,$copy_name,$pages,$quality,$quantity,$price,$discount)
{
	
	$copyCount = count($copy_name);
	
	$query = "INSERT INTO `tbl_copy`(`name`, `pages`, `quality`, `quantity`, `mrp`, `discount`, `cost`, `class_id`, `school_id`) VALUES ";
	$queryValue = "";
	for($i=0;$i<$copyCount;$i++) {
		if(!empty($copy_name[$i]) || !empty($pages[$i]) || !empty($quality[$i]) || !empty($quantity[$i]) || !empty($price[$i]) || !empty($discount[$i])) {
			$cost[$i]=$price[$i]-($price[$i]*($discount[$i]/100));
			$cost[$i]*=$quantity[$i];
			if($queryValue!="") {
				$queryValue .= ",";
			}
			$queryValue .= "('" .$copy_name[$i]. "', '" .$pages[$i]. "', '" .$quality[$i]. "', '" .$quantity[$i]. "',  '" .$price[$i]. "',  '" .$discount[$i]. "',  '" .$cost[$i]. "',  '" .$class_id. "',  '" .$school_id. "')";
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


function get_copy_by_id($id) 
{
	 
	 $sql="select t1.name as copy_name,t1.pages,t1.quality,t1.quantity,t1.mrp,t1.discount,t3.class,t4.name as school from tbl_copy t1,tbl_class t3,tbl_school t4 where t1.class_id=t3.id and t1.school_id=t4.id and t1.id='$id'";
       $rs=self::$conn->query($sql);
	  
       if($rs->num_rows>0){
       	 $data=$rs->fetch_array();
          return $data;
        }
		  else{
			 return false;
		  }
}

function update_copies($id,$copy_name,$pages,$quality,$quantity,$price,$discount){
      
	  $cost=$price-($price*($discount/100));
	  $cost*=$quantity;
      $sql="UPDATE `tbl_copy` SET `name`='$copy_name',`pages`='$pages',`quality`='$quality',`quantity`='$quantity',`mrp`='$price',`discount`='$discount',`cost`='$cost' WHERE id='$id'";
	
  if(self::$conn->query($sql)){
        return true;
      }
      else{
         return false;
      }

  }

function del_copy($id){
	  
       $sql="delete from tbl_copy where id='$id'";
       if(self::$conn->query($sql)){
          return true;
       }
       else{
          return false;
       }
  }


}

?>