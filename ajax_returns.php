<?php
include('admin/class/config.php');
$obj=Database::getInstance();
//sleep(10);
if(isset($_POST['get_schools'])) {
	$result=$obj->get_rows("`tbl_school`","*","`name` like '" . $_POST["keyword"] . "%'","`name`","8");
	$count=sizeof($result);
	if(!empty($result)) {
?>
	<input type="hidden" id="count" value="<?php echo $count; ?>" >
	<div class="btn-group-vertical" style="width:100%; ">
    <?php
		$i=0;
		foreach($result as $school) {$i++;
?>
		<button type="button" id="list<?php echo $i; ?>" class="btn btn-default btns" onClick="selectSchool('<?php echo $school["id"]; ?>','<?php echo addslashes($school["name"]); ?>');" 
        	style="text-align:left; border-radius:0; border:0;" ><?php echo $school["name"]; ?></button>
		
<?php 
		} 
?>
    	
  	</div>
<?php 
	} 
}
elseif($_POST['editcart']){
	$id=$_POST['id'];
	$array=$obj->get_details("`tbl_cart`","`id`,`price`,`quantity`,`product`","`id`='$id'");
	echo json_encode($array);
}
?>