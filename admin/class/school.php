<?php
include_once "config.php"; 
class School{

  private static $conn;

  function __construct(){
  	  $db=Database::getInstance();
  	  self::$conn=$db->getConnection();
  }

  function add_school($fullname,$board,$session,$class,$email,$phone,$website,$address,$published){

      $sql="INSERT INTO `tbl_school`(`name`, `board`, `session`, `class`, `email`, `website`, `phone`, `address`, `published`) VALUES ('$fullname','$board','$session','$class','$email','$website','$phone','$address','$published')";
	  
	 if(self::$conn->query($sql) ){
        return true;
      }
      else{
         return mysqli_error(self::$conn);
      }

  }
 

function get_school_by_id($id) 
{
	 
	 $sql="SELECT * FROM `tbl_school` WHERE id='$id'";
       $rs=self::$conn->query($sql);
	  
       if($rs->num_rows>0){
       	 $data=$rs->fetch_array();
          return $data;
        }
		  else{
			 return mysqli_error(self::$conn);
		  }
}


  function update_school($id,$fullname,$board,$session,$class,$email,$phone,$website,$address,$published){

      $sql="UPDATE `tbl_school` SET `name`='$fullname',`board`='$board',`session`='$session',`class`='$class',`email`='$email',`website`='$website',`phone`='$phone',`address`='$address',`published`='$published' WHERE id='$id'";
	
  if(self::$conn->query($sql)){
        return true;
      }
      else{
         return mysqli_error(self::$conn);
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
			 return mysqli_error(self::$conn);
		  }
	
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
			 return mysqli_error(self::$conn);
		  }
	
}

function sel_school_banner($id) 
{
	 
	 $sql="SELECT * FROM `tbl_images` WHERE school_id='$id'";
       $rs=self::$conn->query($sql);
	  
       if($rs->num_rows>0){
       	 $data=$rs->fetch_array();
          return $data;
        }
		  else{
			 return mysqli_error(self::$conn);
		  }
}


function add_images($id,$folder,$folder1)
{
	$check="select banner,logo from tbl_images where school_id='$id'";
	$rs=self::$conn->query($check);
	$data=$rs->fetch_array();
	$row=$rs->num_rows;
	//echo $row;
	if($row<1)
	{
	  $upload="INSERT INTO `tbl_images`(`logo`, `banner`, `featured`, `famous`, `school_id`) VALUES ('$folder1','$folder','0','0','$id')";
	}else if($row>0){
		unlink($data['banner']);
		unlink($data['logo']);
		$upload="UPDATE `tbl_images` SET `logo`='$folder1',`banner`='$folder' WHERE school_id='$id'";
	}
	if(self::$conn->query($upload)){
        return true;
      }
      else{
         return mysqli_error(self::$conn);
      }
	
}



function del_school($id){
       $sql="delete from tbl_school where id='$id'";
       if(self::$conn->query($sql)){
          return true;
       }
       else{
          return mysqli_error(self::$conn);
       }
  }
  
/*********Famous*********/ 

function add_featured($school_id,$featured)
{
	$row=count($school_id);
	//print_r($featured);
	for($i=0;$i<$row;$i++)
	{
		if(isset($featured[$i]) && $featured[$i]=='on'){
		   $value="1";
		}else{
		  $value="0";
		}
		
    $feat="UPDATE `tbl_images` SET `featured`='$value' WHERE school_id = '$school_id[$i]'";
	self::$conn->query($feat);
	$flag=true;
	}
	if($flag=='true'){
        return true;
      }
      else{
         return mysqli_error(self::$conn);
      } 
	
	
}
 
/********* End Famous*********/ 

 
/*********Featured*********/ 

function add_famous($school_id,$famous)
{
	$row=count($school_id);
	for($i=0;$i<$row;$i++)
	{
		if(isset($famous[$i]) && $famous[$i]=='on'){
		   $value="1";
		}else{
		  $value="0";
		}
		
    $fam="UPDATE `tbl_images` SET `famous`='$value' WHERE school_id = '$school_id[$i]'";
	self::$conn->query($fam);
	$flag=true;
	}
	if($flag=='true'){
        return true;
      }
      else{
         return mysqli_error(self::$conn);
      } 
	
}
 
/********* End Featured*********/  
  
  


}

?>