<?php
include_once "class/config.php";
$obj=Database::getInstance();
$count=20;
$offset=0;
if(isset($_GET['page']) && trim($_GET['page'])!=''){
	$page=$_GET['page'];
}
else{
	$page=1;
}
$offset=($page-1)*$count;
$table="`tbl_subscriptions`";
$columns="*";
$where="1";
$order="id desc";
$limit="$offset,$count";
$array=$obj->get_rows($table,$columns,$where,$order,$limit);
$rowcount=$obj->get_count($table,$where);
$pages=ceil($rowcount/$count);
?>
<table class="table table-hover">
	<tr>
    	<th style="text-align:center;">Sl. No.</th>
    	<th style="text-align:center;">E-mail</th>
    	<th style="text-align:center;">Action</th>
    </tr>
	<?php
    if(is_array($array)){$i=$offset;
        foreach($array as $subscribers){$i++;
    ?>
   	<tr>
    	<td align="center"><?php echo $i; ?></td>
    	<td align="center"><?php echo $subscribers['email']; ?></td>
        <td align="center"><a href="deletesubscription.php?id=<?php echo $subscribers['id']; ?>&deletesubscriber=deletesubscriber" class="fa fa-trash-o" onClick="return confirmDelete();"></a></td>
    </tr>
    <?php
        }
    }
	else{
		echo "<tr><td colspan='3' class='text-center text-danger'>No Record Found!</td></tr>";	
	}
		if($pages>1){
	?>
    <tr>
    	<td colspan="3" align="center">
    <?php
			if($page!=1){
	?>	
    		<ul class="pagination pagination-sm">
    			<li><a href="subscribers.php?page=<?php echo $page-1;if(isset($_GET['query'])){echo "&query=".$_GET['query'];} ?>" 
                	onClick="navigate('<?php if(isset($_GET['query'])){echo $_GET['query'];}else{echo "";} ?>','<?php echo $page-1; ?>')">Prev</a></li>
          	</ul>
    <?php
			}
			for($i=1;$i<=$pages;$i++){
				if($i<4 || $i>$pages-3 || $i==$page || $i==$page-1 || $i==$page+1 || $i==$page-2 || $i==$page+2){
	?>	
    		<ul class="pagination pagination-sm">
    			<li <?php if($i==$page){echo "class='active'";} ?>>
                	<a href="subscribers.php?page=<?php echo $i;if(isset($_GET['query'])){echo "&query=".$_GET['query'];} ?>" >
					<?php echo $i; ?></a>
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
    			<li><a href="subscribers.php?page=<?php echo $page+1;if(isset($_GET['query'])){echo "&query=".$_GET['query'];} ?>" >
                Next</a></li>
          	</ul>
    <?php
			}
	?>
    	</td>
    </tr>
    <?php
		}
	?>
</table>