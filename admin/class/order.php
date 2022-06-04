<?php
include_once "config.php"; 
class Order{

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

function get_orderid($phone,$sname,$tot,$pincode) 
{
	 
	 $sql="SELECT id FROM `tbl_orders` where student_name='$sname' and mobile='$phone' and total_amount='$tot' and pincode='$pincode' order by id desc limit 1";
       $rs=self::$conn->query($sql);
	  
       if($rs->num_rows>0){
       	 $data=$rs->fetch_array();
          return $data;
        }
		  else{
			 return false;
		  }
}

function get_idamount($phone,$name,$sname,$pincode) 
{
	 
	 $sql="SELECT id,total_amount FROM `tbl_orders` where student_name='$sname' and mobile='$phone' and name='$name' and pincode='$pincode' order by id desc limit 1";
       $rs=self::$conn->query($sql);
	  
       if($rs->num_rows>0){
       	 $data=$rs->fetch_array();
          return $data;
        }
		  else{
			 return false;
		  }
}

function get_amount_by_products($school_id,$class_id) 
{
	   $sql="SELECT sum(t1.cost) as bookcost FROM tbl_books t1 where t1.school_id='$school_id' and t1.class_id='$class_id'";
       $bc=self::$conn->query($sql);
	   $sql1="SELECT sum(t2.cost) as copycost FROM tbl_copy t2 where t2.school_id='$school_id' and t2.class_id='$class_id'";
       $cc=self::$conn->query($sql1);
	   $sql2="SELECT sum(t3.cost) as stcost FROM tbl_stationary t3 where t3.school_id='$school_id' and t3.class_id='$class_id'";
       $sc=self::$conn->query($sql2);
	  
       if($bc->num_rows>0 && $cc->num_rows>0 && $sc->num_rows>0){
       	 $book=$bc->fetch_array();
		 $copy=$cc->fetch_array();
		 $data1=array_merge($book,$copy);
		 $stationary=$sc->fetch_array();
		 $data=array_merge($data1,$stationary);
          return $data;
        }
		  else{
			 return false;
		  }
}

function get_price_by_products($school_id,$class_id) 
{
	   $sql="SELECT sum(t1.cost) as bookcost FROM tbl_books t1 where t1.school_id='$school_id' and t1.class_id='$class_id'";
       $bc=self::$conn->query($sql);
	   $sql1="SELECT sum(t2.cost) as copycost FROM tbl_copy t2 where t2.school_id='$school_id' and t2.class_id='$class_id'";
       $cc=self::$conn->query($sql1);
	   $sql2="SELECT sum(t3.cost) as stcost FROM tbl_stationary t3 where t3.school_id='$school_id' and t3.class_id='$class_id'";
       $sc=self::$conn->query($sql2);
	  
       	 $book=$bc->fetch_array();
		 $copy=$cc->fetch_array();
		 $data1=array_merge($book,$copy);
		 $stationary=$sc->fetch_array();
		 $data=array_merge($data1,$stationary);
         return $data;
}


function add_order($date,$sname,$name,$phone,$email,$address,$lmark,$po,$district,$pincode,$state,$school_id,$class_id,$product,$amount){
      
	  if(array_search("book",$product)!==false && array_search("copy",$product)!==false && array_search("stationary",$product)!==false){
		  $tot=$amount['bookcost'] + $amount['copycost'] + $amount['stcost'];
		  $product="book,copy,stationary";
       }elseif(array_search("book",$product)!==false && array_search("copy",$product)!==false){
		   $tot=$amount['bookcost'] + $amount['copycost'];
		   $product="book,copy"; 
	   }elseif(array_search("book",$product)!==false && array_search("stationary",$product)!==false){
		   $tot=$amount['bookcost'] + $amount['stcost'];
		   $product="book,stationary";
	   }else{
		   $tot=$amount['bookcost'] ;
		   $product="book";
	   }
	   $tot=round($tot);
	   $pass=md5(rand(00,99));
	   $user="INSERT INTO `tbl_member`(`name`, `mobile`, `email`, `password`, `active`) VALUES ('$sname','$phone','$email','$pass','1')";
	   $usercreate=self::$conn->query($user);
	   if($usercreate)
	   {
		  $seluser="select id from tbl_member order by id desc limit 1";
		  $userquery=self::$conn->query($seluser);
		  $row=$userquery->num_rows;
		  $userdata=$userquery->fetch_array();
		  if($row>0)
		  {
	     $add="INSERT INTO `tbl_address`(`user_id`, `address`, `landmark`, `postoffice`, `district`, `mobile`, `pincode`, `state`) VALUES ('$userdata[id]','$address','$lmark','$po','$district','$phone','$pincode','$state')";
	   $newuseradd=self::$conn->query($add);
	      }
	   }
      $sql="INSERT INTO `tbl_orders`(`date`, `user_id`, `payment`, `student_name`, `name`, `address`, `landmark`, `postoffice`, `district`, `mobile`, `pincode`, `state`, `total_amount`, `status`) VALUES ('$date','$userdata[id]','cod','$sname','$name','$address','$lmark','$po','$district','$phone','$pincode','$state','$tot','0')";
	  $rs=self::$conn->query($sql);
	  
	  if($rs==1){
		  $obj=new Order();
       	 $data=$obj->get_orderid($phone,$sname,$tot,$pincode);
		 $id=$data['id'];
		 
		$sql1="INSERT INTO `tbl_orderlist`(`order_id`, `user_id`, `school_id`, `class_id`, `product`, `product_id`, `price`, `quantity`, `amount`) VALUES ('$id','','$school_id','$class_id','$product','0','$tot','1','$tot')";
        }
		
  if(self::$conn->query($sql1)){
        return true;
      }
      else{
         return mysqli_error(self::$conn);
      }

  }


function get_order_by_id($id) 
{
	 
	 $sql="SELECT * FROM `tbl_orders` WHERE id='$id'";
       $rs=self::$conn->query($sql);
	  
       if($rs->num_rows>0){
       	 $data=$rs->fetch_array();
          return $data;
        }
		  else{
			 return false;
		  }
}
/* function view_order_by_id($id) 
{
	 
	 $sql="SELECT t1.order_id,t1.product,t1.price,t1.amount,t1.quantity,t1.school_id,t1.class_id,t2.name as school,t3.class FROM tbl_orderlist t1,tbl_school t2,tbl_class t3 WHERE t1.school_id=t2.id and t1.class_id=t3.id and md5(t1.order_id)='$id'";
       $rs=self::$conn->query($sql);
	  
       if($rs->num_rows>0){
       	 $data=$rs->fetch_array();
          return $data;
        }
		  else{
			 return false;
		  }
}
*/

function update_order($id,$status,$dispatch="",$delivery="",$delivered=""){
      
	
      $sql="UPDATE `tbl_orders` SET";
	if($status==1)
	 { 
	 $sql.=" `status`='$status',`dispatch_date`='$dispatch',`delivered_date`='$delivery'";
	 }elseif($status==2){
		 $sql.=" `status`='$status',`delivered_date`='$delivered'";
	 }elseif($status==3){
		 $sql.=" `status`='$status'";
	 }
	 $sql.=" WHERE id='$id'";
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
  function getuserdata($id){
	  $sql=self::$conn->query("SELECT `email` from tbl_member where `id`='$id'");
	  $data=$sql->fetch_array();
	  return $data['email'];
	}


}

?>