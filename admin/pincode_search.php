<?php 

include_once "class/config.php";
$query=$_GET['query'];
?>

                    
          <div class="table-responsive" style="width:100%">
          <table class="table table-hover table-stripped" >
			   <thead>
			     <th style="text-align:center">Serial No.</th>
				 <th style="text-align:center">Pincode</th>
                 <th style="text-align:center">Post Office</th>
                 <th style="text-align:center">District</th>
                 <th style="text-align:center">State</th>
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
			
			$sql="select * from tbl_pincode where pincode LIKE '%".$query."%' order by id desc limit $offset,$count";
			
			$sql1="select count(id) as count from tbl_pincode where pincode LIKE '%".$query."%'";
			
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
						 <td align="center"><?php echo $result['pincode'];?></td>
                         <td align="center"><?php echo $result['po'];?></td>
                         <td align="center"><?php echo $result['district'];?></td>
                         <td align="center"><?php echo $result['state'];?></td>
						 <td align="center">
                             <a href="delete_pincode.php?id=<?php echo $result['id'];?>" class="fa fa-trash-o"></a>
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
    			<li><a href="pincode_list.php?page=<?php echo $page-1;?>&query=<?php echo $query;?>">Prev</a></li>
          	</ul>
    <?php
			}
			for($i=1;$i<=$pages;$i++){
				if($i<4 || $i>$pages-3 || $i==$page || $i==$page-1 || $i==$page+1 || $i==$page-2 || $i==$page+2){
	?>	
    		<ul class="pagination pagination-sm">
    			<li <?php if($i==$page){echo "class='active'";} ?>>
                	<a href="pincode_list.php?page=<?php echo $i; ?>&query=<?php echo $query;?>"><?php echo $i; ?></a>
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
    			<li><a href="pincode_list.php?&page=<?php echo $page+1;?>&query=<?php echo $query;?>">Next</a></li>
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
        <tr><td colspan="13" class="text-danger" style="text-align:center">No Records Found!</td></tr>
        <?php } ?>
</table>				  
</div>
 