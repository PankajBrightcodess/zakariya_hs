<?php 

include_once "class/config.php";
$query=$_GET['query'];
?>

                    
          <div class="table-responsive" style="width:100%">
          <table class="table table-hover table-stripped" >
			   <thead>
			     <th style="text-align:center">Order Id</th>
                 <th style="text-align:center">Order Date</th>
				 <th style="text-align:center">Student Name</th>
                 <th style="text-align:center">Name</th>
                 <th style="text-align:center"> Address</th>
                 <th style="text-align:center"> Total Amount</th>
                 <th style="text-align:center">Dispatch Date</th>
                 <th style="text-align:center">Delivery Date</th>
                 <th style="text-align:center">Status</th>
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
			
			$sql="select * from tbl_orders WHERE name LIKE '%".$query."%' or student_name LIKE '%".$query."%' or id='$query'  order by id desc limit $offset,$count";
			$sql1="select count(id) as count from tbl_orders WHERE name LIKE '%".$query."%' or student_name LIKE '%".$query."%' or id='$query'";
			
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
						 <td align="center"><?php echo $result['id'];?></td>
                         <td align="center"><?php echo date("d-M-Y",strtotime($result['date']));?></td>
						 <td align="center"><?php echo ucwords($result['student_name']);?></td>
                         <td align="center"><?php echo ucwords($result['name']);?></td>
                         <?php $address=$result['landmark'].", ".$result['address'].",<br>".$result['postoffice'].", ".$result['district']."-".$result['pincode'].", ".$result['state'].".";?>
                         <td align="center"><?php echo $address; ?></td> 
                        <td align="center"><?php echo toDecimal($result['total_amount']);?></td>
                        <td align="center">
						<?php 
						if($result['dispatch_date']!="0000-00-00"){
							echo date("d-M-Y",strtotime($result['dispatch_date']));
							}else{
								
								echo "-- --- ----";
							}
							?>
                        </td>
                        <td align="center">
						<?php
						if($result['delivered_date']!="0000-00-00")
						{
						 echo date("d-M-Y",strtotime($result['delivered_date']));
						}else{
							echo "-- --- ----";
						}
						 ?>
                        </td> 
                          <td align="center"><?php if($result['status']==0){ ?> <i class="fa fa-check text-primary"> Order Placed.</i>
						           <?php }elseif($result['status']==1){ ?>
									      
                                          <i class="fa fa-check text-info"> Order Dispatched.</i>
									   
                                      <?php
                                      }elseif($result['status']==3){
                                        ?>
                                         <i class="fa fa-times text-danger"> Order Cancelled.</i>
                                        <?php
                                        }else{?>
                                          <i class="fa fa-check text-success"> Order Delivered.</i>
                                        <?php } ?>
                         </td>
						 <td align="center">
						     <a href="view_order.php?id=<?php echo $result['id']; ?>" class="fa fa-eye"></a>&nbsp;&nbsp;&nbsp;&nbsp;
                             <a href="edit_order.php?id=<?php echo $result['id'];?>" class="fa fa-edit"></a>
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
    			<li><a href="order_list.php?page=<?php echo $page-1;?>">Prev</a></li>
          	</ul>
    <?php
			}
			for($i=1;$i<=$pages;$i++){
				if($i<4 || $i>$pages-3 || $i==$page || $i==$page-1 || $i==$page+1 || $i==$page-2 || $i==$page+2){
	?>	
    		<ul class="pagination pagination-sm">
    			<li <?php if($i==$page){echo "class='active'";} ?>>
                	<a href="order_list.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
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
    			<li><a href="order_list.php?&page=<?php echo $page+1;?>">Next</a></li>
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
