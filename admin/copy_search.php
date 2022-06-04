<?php 

include_once "class/config.php";
$school=$_GET['school'];
$cls=$_GET['cls'];

?>

          <div class="table-responsive" style="width:100%">
          <table class="table table-hover table-stripped" >
			   <thead>
			     <th style="text-align:center">Serial No.</th>
                 <th style="text-align:center">School</th>
                 <th style="text-align:center">Class</th>
				 <th style="text-align:center"> Copy Name</th>
                 <th style="text-align:center"> Pages</th>
                 <th style="text-align:center"> Quality</th>
                 <th style="text-align:center"> Quantity</th>
                  <th style="text-align:center">MRP</th>
                  <th style="text-align:center">Discount</th>
                  <th style="text-align:center">Cost</th>
				 <th style="text-align:center">Action</th>
			   </thead>
<?php 
            $db=Database::getInstance();
			$conn=$db->getConnection();

			$count=12;
			$offset=0;
			if(isset($_GET['page'])){
		          $page=$_GET['page'];
		     }
			 else{
					  $page=1;	
				  }
				  $offset=($page-1)*$count;
			
			$sql="select t1.id as copy_id,t1.name as copy_name,t1.pages,t1.quality,t1.quantity,t1.mrp,t1.discount,t1.cost,t3.class,t4.name as school from tbl_copy t1,tbl_class t3,tbl_school t4 where t1.class_id=t3.id and t1.school_id=t4.id ";
			if($school!=''){$sql.="and t1.school_id LIKE '%".$school."%'";}
			if($cls!=''){$sql.=" and t1.class_id ='$cls'";}
			 $sql.="order by t1.id asc limit $offset,$count";
			$sql1="select count(id) as count from tbl_copy";
			
				$rowcount=$conn->query($sql1);
				$data= $rowcount->fetch_assoc();
				$rownum= $data['count'];
				$pages= ceil($rownum/$count);

				     $rs=$conn->query($sql);
					 if($rs->num_rows>0){
						$sno=$offset;
					 while($result=$rs->fetch_array()){
						 ?>
						 <tr title="Click to see more Details">
						 <td align="center"><?php echo ++$sno;?></td>
                         <td align="center"><?php echo $result['school'];?></td>
                         <td align="center"><?php echo $result['class'];?></td>
						 <td align="center"><?php echo $result['copy_name'];?></td>
                         <td align="center"><?php echo $result['pages'];?></td>
                         <td align="center"><?php echo $result['quality'];?></td>
                         <td align="center"><?php echo $result['quantity'];?></td>
                         <td align="center"><?php echo "₹ ".$result['mrp'];?></td>
                         <td align="center"><?php echo $result['discount']."%";?></td>
                         <td align="center"><?php echo "₹ ".$result['cost'];?></td>
						 <td align="center">
                             <a href="edit_copy.php?id=<?php echo $result['copy_id']; ?>" class="fa fa-edit"></a>&nbsp;&nbsp;
                             <a href="delete_copy.php?id=<?php echo $result['copy_id'];?>" class="fa fa-trash-o"></a>
                         </td>    
						 </tr>
						 <?php
					   }
					  		if($pages>1){
	?>
    <tr>
    	<td colspan="13" align="center">
    <?php
			if($page!=1){
	?>	
    		<ul class="pagination pagination-sm">
    			<li><a href="copy_list.php?page=<?php echo $page-1;?>&school=<?php echo $school;?>&cls=<?php echo $cls;?>">Prev</a></li>
          	</ul>
    <?php
			}
			for($i=1;$i<=$pages;$i++){
				if($i<4 || $i>$pages-3 || $i==$page || $i==$page-1 || $i==$page+1 || $i==$page-2 || $i==$page+2){
	?>	
    		<ul class="pagination pagination-sm">
    			<li <?php if($i==$page){echo "class='active'";} ?>>
                	<a href="copy_list.php?page=<?php echo $i; ?>&school=<?php echo $school;?>&cls=<?php echo $cls;?>"><?php echo $i; ?></a>
                </li>
          	</ul>
    <?php		
				}
				elseif($pages>5 && ($i==4 || $i==$pages-3)){
	?>
			<ul class="pagination pagination-sm">
    			<li>
                	<a>...</a>
                </li>
          	</ul>
    <?php
				}
			}
			if($page!=$pages){
	?>
    		<ul class="pagination pagination-sm">
    			<li><a href="copy_list.php?&page=<?php echo $page+1;?>&school=<?php echo $school;?>&cls=<?php echo $cls;?>">Next</a></li>
          	</ul>
    <?php
			}
	?>
    	</td>
    </tr>
    <?php
		}
	} //if closed
	else{
		
		?>
        
        <tr><td colspan="13" align="center" class="text-danger">No Result Found!</td></tr>
        <?php
	}
					
   
		?>
</table>				  
</div>
                    
