<?php 

include_once "class/config.php";
$query=$_GET['query'];
?>
                    
          <div class="table-responsive" style="width:100%">
          <table class="table table-hover table-stripped" >
			   <thead>
			     <th style="text-align:center">Serial No.</th>
				 <th style="text-align:center">Name</th>
                 <th style="text-align:center">Mobile</th>
                 <th style="text-align:center">Login Type</th>
                 <th style="text-align:center">Address</th>
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
			
			$sql="select * from tbl_member WHERE name LIKE '%".$query."%' order by id asc limit $offset,$count";
			$sql1="select count(id) as count from tbl_member  WHERE name LIKE '%".$query."%'";
			
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
						 <td align="center"><?php echo ucwords($result['name']);?></td>
                         <td align="center"><?php echo $result['mobile'];?></td>
                         <td align="center"><?php if($result['login_type']!=''){echo $result['login_type'];}else{ echo "-------------";} ?></td>
                         <?php 
					  $check="SELECT  `address`, `landmark`, `postoffice`, `district`, `mobile`, `pincode`, `state` FROM `tbl_orders` WHERE user_id = $result[id] order by id desc limit 1";
					  $res=$conn->query($check);
						if($res)
						{
							$resset=$res->fetch_array();
							if($resset['pincode']=='' || $resset['district']=='')
							{
								$address="Not Available";
							}else{
							 $address = $resset['address'].", ".$resset['landmark'].", <br>".$resset['postoffice'].", ".$resset['district']."-".$resset['pincode'].",<br> ".$resset['state'].".";
							}
						}else{
							 $recheck="SELECT  `address`, `landmark`, `postoffice`, `district`, `mobile`, `pincode`, `state` FROM `tbl_address` WHERE user_id = $result[id] order by id asc limit 1";
							$res1=$conn->query($recheck);
							$resset1=$res1->fetch_array();
							if($resset1['pincode']=='' || $resset1['district']=='')
							{
								$address="Not Available";
							}else{
							 $address = $resset1['address'].", ".$resset1['landmark'].", <br>".$resset1['postoffice'].", ".$resset1['district']."-".$resset1['pincode'].",<br> ".$resset1['state'].".";
							}
						}
						
						 ?>
                        <td align="center"><?php echo $address;?></td>
                          <td align="center"><?php if(($result['active'])==1){ ?> <i class="fa fa-check text-success">Active</i><?php }
    
                                      else{
                                        ?>
                                         <i class="fa fa-times text-danger">Deactive</i>
                                        <?php
                                        }?>
                                          
    
                         </td>
						 <td align="center">
						     <a href="edit_member.php?id=<?php echo md5($result['id']); ?>" class="fa fa-edit"></a>&nbsp;&nbsp;
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
    			<li><a href="member_list.php?page=<?php echo $page-1;?>">Prev</a></li>
          	</ul>
    <?php
			}
			for($i=1;$i<=$pages;$i++){
				if($i<4 || $i>$pages-3 || $i==$page || $i==$page-1 || $i==$page+1 || $i==$page-2 || $i==$page+2){
	?>	
    		<ul class="pagination pagination-sm">
    			<li <?php if($i==$page){echo "class='active'";} ?>>
                	<a href="member_list.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
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
    			<li><a href="member_list.php?&page=<?php echo $page+1;?>">Next</a></li>
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
                    
