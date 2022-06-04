<?php
include_once "config.php"; 
class Product{

  private static $conn;

  function __construct(){
  	  $db=Database::getInstance();
  	  self::$conn=$db->getConnection();
  }



function add_category($name,$feature)
{
	$feature=implode(',',$feature);
	 $sql ="INSERT INTO `tbl_category`(`feature`, `category`) VALUES ('$feature','$name')";
		
	if(self::$conn->query($sql)){
        return true;
      }
      else{
         return false;
      }
}


function get_category_by_id($id) 
{
	 
	 $sql="SELECT * FROM `tbl_category` WHERE id='$id'";
       $rs=self::$conn->query($sql);
	  
       if($rs->num_rows>0){
       	 $data=$rs->fetch_array();
          return $data;
        }
		  else{
			 return false;
		  }
}

function update_category($id,$feature){
      
      $sql="UPDATE `tbl_category` SET `feature`='$feature' WHERE id='$id'";
	
  if(self::$conn->query($sql)){
        return true;
      }
      else{
         return false;
      }

  }

function del_category($id){
	  
       $sql="delete from tbl_category where id='$id'";
       if(self::$conn->query($sql)){
          return true;
       }
       else{
          return false;
       }
  }
  
function get_all_category()
{
	$sql="select * FROM `tbl_category`";
	$rs=self::$conn->query($sql);
	$categories=array();
	if($rs->num_rows>0){
		while($row=$rs->fetch_array())
		{
       	  $categories[]=$row;
		}
          return $categories;
        }
		  else{
			 return false;
		  }
}

function get_feature_by_category($category) 
{
	 
	 $sql="SELECT feature FROM `tbl_category` WHERE category='$category'";
       $rs=self::$conn->query($sql);
	  
       if($rs->num_rows>0){
       	 $data=$rs->fetch_array();
          return $data;
        }
		  else{
			 return false;
		  }
}


function get_product_id() 
{
	 
	 $sql="SELECT id FROM `tbl_products` order by id desc limit 1";
       $rs=self::$conn->query($sql);
	  
       if($rs->num_rows>0){
       	 $data=$rs->fetch_array();
          return $data;
        }
		  else{
			 return false;
		  }
}

function add_product($id,$pname,$price,$discount,$category,$description,$feature,$value,$pro,$thum)
{
	
$cost = $price - ($price * ($discount/100));

	 $sql ="INSERT INTO `tbl_products`(`name`, `price`, `discount`, `cost`, `category`, `description`, `image`, `thumbnail`) VALUES ('$pname','$price','$discount','$cost','$category','$description','$pro','$thum')";
	 
	 $fetureCount = count($feature);
	
	$query = "INSERT INTO `tbl_feature`(`name`, `value`, `product_id`) VALUES ";
	$queryValue = "";
	for($i=0;$i<$fetureCount;$i++) {
		if(!empty($feature[$i]) || !empty($value[$i])) {
			
			if($queryValue!="") {
				$queryValue .= ",";
			}
			$queryValue .= "('" .$feature[$i]. "', '" .$value[$i]. "', '" .$id. "')";
			}
		}
	 $sql1 = $query.$queryValue;
		
	if(self::$conn->query($sql) && self::$conn->query($sql1)){
        return true;
      }
      else{
         return false;
      }
}


function cwUpload($field_name = '', $target_folder = '', $file_name = '', $thumb = FALSE, $thumb_folder = '', $thumb_width = '', $thumb_height = '',$loc){

    //folder path setup
    $target_path = $target_folder;
    $thumb_path = $thumb_folder;
    
    //file name setup
    $filename_err = explode(".",$field_name);
    $filename_err_count = count($filename_err);
    $file_ext = $filename_err[$filename_err_count-1];
    if($file_name != ''){
        $fileName = time()."-".$file_name.'.'.$file_ext;
    }else{
        $fileName = time()."-".$_FILES[$field_name]['name'];
    }
    
    //upload image path
    $upload_image = $target_path.basename($fileName);
    
    //upload image
    if(move_uploaded_file($loc,$upload_image))
    {
        //thumbnail creation
        if($thumb == TRUE)
        {
            $thumbnail = $thumb_path.$fileName;
            list($width,$height) = getimagesize($upload_image);
            $thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
            switch($file_ext){
                case 'jpg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;
                case 'jpeg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;

                case 'png':
                    $source = imagecreatefrompng($upload_image);
                    break;
                case 'gif':
                    $source = imagecreatefromgif($upload_image);
                    break;
                default:
                    $source = imagecreatefromjpeg($upload_image);
            }

            imagecopyresized($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
            switch($file_ext){
                case 'jpg' || 'jpeg':
                    imagejpeg($thumb_create,$thumbnail,100);
                    break;
                case 'png':
                    imagepng($thumb_create,$thumbnail,100);
                    break;

                case 'gif':
                    imagegif($thumb_create,$thumbnail,100);
                    break;
                default:
                    imagejpeg($thumb_create,$thumbnail,100);
            }

        }

        return $fileName;
    }
    else
    {
        return false;
    }
}

function get_product_by_id($id)
{
	$sql="select * from tbl_products where id='$id'";
	$rs=self::$conn->query($sql);
	
	if($rs->num_rows>0){
		$product=$rs->fetch_array();
          return $product;
        }
		  else{
			 return false;
		  }
}

function get_feature_by_id($id) 
{
	 
	$sql="select * FROM `tbl_feature` where product_id='$id'";
	$rs=self::$conn->query($sql);
	$features=array();
	if($rs->num_rows>0){
		while($row=$rs->fetch_array())
		{
       	  $features[]=$row;
		}
          return $features;
        }
		  else{
			 return false;
		  }
}

function unlink_photo_by_id($id)
{
	$sql="select image,thumbnail from tbl_products where id='$id'";
	$rs=self::$conn->query($sql);
	
	if($rs->num_rows>0){
		$data=$rs->fetch_array();
          return $data;
        }
		  else{
			 return false;
		  }
}

function update_product($id,$pname,$price,$discount,$description,$feature,$value,$pro,$thum)
{
	
$cost = $price - ($price * ($discount/100));

	 $sql ="UPDATE `tbl_products` SET `name`='$pname',`price`='$price',`discount`='$discount',`cost`='$cost',`description`='$description'";
	 if($pro!=''){$sql.=",`image`='$pro',`thumbnail`='$thum'";}
	 $sql.=" WHERE id='$id'";
	 
	 $fetureCount = count($feature);
	
	for($i=0;$i<$fetureCount;$i++) {
		if(!empty($feature[$i]) || !empty($value[$i])) {
			
			$sql1="UPDATE `tbl_feature` SET `value`='" .$value[$i]. "' WHERE product_id='$id' and name='" .$feature[$i]. "'";
			 self::$conn->query($sql1);
			}
			$flag=true;
		}
		
	if(self::$conn->query($sql) && $flag=='true'){
        return true;
      }
      else{
         return false;
      }
}


function del_product($id){
	  
       $sql="delete from tbl_products where id='$id'";
	   $sql1="delete from tbl_feature where product_id='$id'";
	   
       if(self::$conn->query($sql) && self::$conn->query($sql1)){
          return true;
       }
       else{
          return false;
       }
  }

function del_review($id){
	  
       $sql="delete from tbl_review where id='$id'";
	   
       if(self::$conn->query($sql)){
          return true;
       }
       else{
          return false;
       }
  }


}

?>