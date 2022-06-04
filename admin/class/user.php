<?php
include_once "config.php"; 
class User{
 
  private $role;
  private $username;
  private $password;
  private static $conn;
  
  function __construct(){

  	  $db=Database::getInstance();
  	  self::$conn=$db->getConnection();
  }



    function get_login_credentials($username,$password){
          $sql="select * from users where username='$username' and password='$password' and active='1'"; 
          $rs=self::$conn->query($sql);
          //$users=null;
          $user_data=array();
          if($rs->num_rows>0){
			    $users=$rs->fetch_array();
			   return $users;
          	   
          }   
          else{
          	return false;
          }
      }	
	
	
	

    function create_user($username,$password,$role,$active){

      $sql="INSERT INTO `users`(`username`, `password`, `role`, `active`) VALUES ('$username','$password','$role','$active')";
      if(self::$conn->query($sql)){
         return true;
      }
      else{
         return "Please Try Different Username".mysqli_error(self::$conn);
      }


    }
	
	 function update_meta_user($id,$username,$password,$role,$active){
         
        $sql="UPDATE `users` SET `username`='$username',`password`='$password',`role`='$role',`active`='$active' WHERE id='$id'";
      if(self::$conn->query($sql)){
        return true;
      }
      else{
         return false;
      }

  }

    function get_users(){
       $sql="select * from users order by id";
       $rs= self::$conn->query($sql);
       $users=array();
       if($rs->num_rows>0){
          while($rows=$rs->fetch_array()){
            $users[]=$rows;
          }
          return $users;
       }
       else{
          return false;
       }

  }

  function del_user($id){
       $sql="delete from users where id='$id'";
       if(self::$conn->query($sql)){
          return true;
       }
       else{
          return false;
       }
  }

  
}

?>