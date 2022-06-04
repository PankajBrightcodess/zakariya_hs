<?php
/*
* Mysql database class - only one connection allowed
*/
class Database {
	private $_connection;
	private static $_instance; //The single instance
	private $_host = "localhost";
	private $_username = "root";
	private $_password = "root";
	private $_database = "db_bookmysyllabus";
	/*
	Get an instance of the Database
	@return Instance
	*/
	public static function getInstance() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	// Constructor
	private function __construct() {
		$this->_connection = new mysqli($this->_host, $this->_username, 
			$this->_password, $this->_database);
	
		// Error handling
		if(mysqli_connect_error()) {
			trigger_error("Failed to conencto to MySQL: " . mysqli_connect_error(),
				 E_USER_ERROR);
		}
	}
	// Magic method clone is empty to prevent duplication of connection
	private function __clone() { }
	// Get mysqli connection
	public function getConnection() {
		return $this->_connection;
	}
	
	function insert($table,$columns,$values){
		$query="INSERT INTO ";
		$query.=$table;$query.=$columns;$query.=" VALUES ".$values;
		
		if($this->_connection->query($query)){ return true; }
		else{ return mysqli_error($this->_connection);}
	}
	
	function update($table,$col_values,$where){
		$query="UPDATE ".$table." set ";
		$query.=$col_values." where ".$where;
		
		if($this->_connection->query($query)){ return true; }
		else{ return mysqli_error($this->_connection);}
	}
	
	function delete($table,$where=''){
		$query="DELETE from".$table;
		$query.=" where ".$where;
		if($this->_connection->query($query)){ return true; }
		else{ return mysqli_error($this->_connection);}
	}
	
	function get_details($table,$column='',$where=''){
		$query="SELECT ";
		if($column!=''){ $query.=$column." from "; }else{ $query.="* from "; }
		$query.=$table;
		if($where!=''){ $query.=" where ".$where; }else{ $query.=" "; }
		//echo $query;
		$run=$this->_connection->query($query);
		if($run){
			if($run->num_rows==1){
				return $run->fetch_assoc();
			}
			else{
				return false;	
			}
		}
		else{ return mysqli_error($this->_connection);}	
	}
	
	function get_count($table,$where=''){
		$query="SELECT count(id) as count from ".$table;
		if($where!=''){ $query.=" where ".$where; }//echo $query;
		$run=$this->_connection->query($query);
		if($run){
			$array=$run->fetch_assoc();
			return $array['count'];
		}
		else{ return mysqli_error($this->_connection);}
	}
	
	function get_rows($table,$column='',$where='',$order='',$limit=''){
		$query="SELECT ";
		if($column!=''){ $query.=$column." from "; }else{ $query.="* from "; }
		$query.=$table;
		if($where!=''){ $query.=" where ".$where; }else{ $query.=" "; }
		if($order!=''){ $query.=" order by ".$order; }else{ $query.=" "; }
		if($limit!=''){ $query.=" limit ".$limit; }else{ $query.=" "; }
		//echo $query;
		$run=$this->_connection->query($query);
		$result=array();
		if($run){
			if($run->num_rows>0){
				while($rows=$run->fetch_assoc()){
					$result[]=$rows;
				}
				return $result;
			}
			else{
				return false;	
			}
		}
		else{ return mysqli_error($this->_connection);}	
	}
	
	function login($table,$username,$password){			
		$query="SELECT * from ";
		$query.=$table." where "; 
		$query.="`username`='".$username."' and `password`='".$password."' and `active`='1'";
		//$query.="(`username` = '".$username."' or `email` = '".$username."') and `password` = '".md5($password)."' and `active` = '1'";
		$run=$this->_connection->query($query);
		if($run){
			if($run->num_rows==1){
				$array=$run->fetch_assoc();
				return $array;
			}
			else{
				return "Username or Password wrong!!";
			}
		}
		else{
			return mysqli_error($this->_connection);
		}	
	}
	
	function get_last_row($table,$column='',$where=''){
		$query="SELECT ";
		if($column!=''){ $query.=$column." from "; }else{ $query.="* from "; }
		$query.=$table."order by id desc limit 1";
		$run=$this->_connection->query($query);
		if($run){
			return $array=$run->fetch_assoc();
		}
		else{ return mysqli_error($this->_connection);}
	}
}

	function toDecimal($number){
		$amount=number_format((float)$number,2,'.','');
		$array=explode('.',$amount);
		$arr=str_split($array[0],1);
		$length=sizeof($arr);
		$amt="";
		if($length>3 && $arr[0]!='-'){
			switch($length){
				case 4:	for($i=0;$i<$length;$i++){
							$amt.=$arr[$i];
							if($i==0){
							$amt.=",";
							}
						}
				break;
				case 5:	for($i=0;$i<$length;$i++){
							$amt.=$arr[$i];
							if($i==1){
							$amt.=",";
							}
						}
				break;
				case 6:	for($i=0;$i<$length;$i++){
							$amt.=$arr[$i];
							if($i==0 || $i==2){
							$amt.=",";
							}
						}	
				break;
				case 7:	for($i=0;$i<$length;$i++){
							$amt.=$arr[$i];
							if($i==1 || $i==3){
							$amt.=",";
							}
						}
				break;
				case 8:	for($i=0;$i<$length;$i++){
							$amt.=$arr[$i];
							if($i==0 || $i==2 || $i==4){
							$amt.=",";
							}
						}
				break;
				case 9:	for($i=0;$i<$length;$i++){
							$amt.=$arr[$i];
							if($i==1 || $i==3 || $i==5){
							$amt.=",";
							}
						}
				break;
			}
		}
		else{
			$amt=$array[0];	
		}
		return $amt.'.'.$array[1];
	}
?>