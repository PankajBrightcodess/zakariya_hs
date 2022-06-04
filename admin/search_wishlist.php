<?php 

include_once "class/config.php";
$query=$_GET['query'];
?>

         <div class="table-responsive" style="width:100%">
          <table class="table table-hover table-stripped" >
			   <thead>
                 <th style="text-align:center">Product Id</th>
			     <th style="text-align:center">Name</th>
                 <th style="text-align:center">Mobile</th>
				 <th style="text-align:center">Email</th>
                 <th style="text-align:center">Product</th>
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
			$wishlists=$db->get_rows("`tbl_wishlist` t1, `tbl_member` t2" ,"t1.*,t2.name,t2.mobile,t2.email","t1.user_id=t2.id and (t1.product LIKE '%".$query."%' OR t2.name LIKE '%".$query."%')","t1.id desc","$offset,$count");
			//print_r($wishlists);
			$rowcount=$db->get_count("`tbl_wishlist`","product LIKE '%$query%'");
			
			$pages=ceil($rowcount/$count);
		if(is_array($wishlists))	
		{
			foreach($wishlists as $wishlist){
				
			?>
			<tr title="Click to see more Details">
               <td align="center"><?php echo $wishlist['product_id'] ;?></td>
               <td align="center"><?php echo ucwords($wishlist['name']);?></td>
               <td align="center"><?php echo $wishlist['mobile'] ;?></td>
               <td align="center"><?php echo $wishlist['email'];?></td>
               <td align="center"><?php echo $wishlist['product'];?></td>
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
    			<li><a href="wish_list.php?page=<?php echo $page-1;?>">Prev</a></li>
          	</ul>
    <?php
			}
			for($i=1;$i<=$pages;$i++){
				if($i<4 || $i>$pages-3 || $i==$page || $i==$page-1 || $i==$page+1 || $i==$page-2 || $i==$page+2){
	?>	
    		<ul class="pagination pagination-sm">
    			<li <?php if($i==$page){echo "class='active'";} ?>>
                	<a href="wish_list.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
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
    			<li><a href="wish_list.php?&page=<?php echo $page+1;?>">Next</a></li>
          	</ul>
    <?php
			}
	?>
    	</td>
    </tr>
    <?php
		}
	}else{
  
		?>
        <tr><td colspan="7" class="text-center text-danger">No Record Founds!</td></tr>
        <?php } ?>
</table>				  
</div>                    
        