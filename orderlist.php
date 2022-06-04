<legend><h3>Order Details</h3></legend>
<div class="table-responsive">
    <table class="table table-bordered table-condensed table-hover">
        <thead>
            <th style="text-align:center;" width="10%">Sl No</th>
            <th style="text-align:center;">Product</th>
            <th style="text-align:center;">Price</th>
            <th style="text-align:center;">Quantity</th>
            <th style="text-align:center;">Amount</th>
        </thead>
        <?php
			include('admin/class/config.php');
			$obj=Database::getInstance();
			$id=$_GET['id'];
			$where="`order_id`='$id'";
            $array=$obj->get_rows("`tbl_orderlist`","*",$where);
            if(is_array($array)){$i=0;
                foreach($array as $product){$i++;
        ?>
        <tr>
            <td align="center"><?php echo $i; ?></td>
            <td align="left">
                <?php 
					if($product['school_id']!=0 && $product['class_id']!=0){
						$school_id=$product['school_id'];
						$class_id=$product['class_id'];
						$sel_details=$obj->get_details("`tbl_school` t1, `tbl_class` t2","t1.*,t2.*","t1.`id`='$school_id' and t2.`id`='$class_id'");
						echo "School : ".$sel_details['name']."<br>Class : ".$sel_details['class']."<br>";
						if($product['product']!=''){
							$pro=explode(',',$product['product']);
							$pros='';
							foreach($pro as $val){ $pros.=ucfirst($val).", ";}
							$pros=rtrim($pros,', ');
							echo "Contents : ".$pros;
						}else{echo "Booklist Uploaded.";}
					}
					elseif($product['school_id']==0 && $product['class_id']!=0){
						//$school=$product['school'];
						$selschool=$obj->get_details("`tbl_booklist`","`school`","`id`='".$product['booklist_id']."'");
						$school=$selschool['school'];
						$class_id=$product['class_id'];
						$sel_details=$obj->get_details("`tbl_class`","*","`id`='$class_id'");
						echo "School : ".$school."<br>Class : ".$sel_details['class']."<br>";
						echo "Booklist Uploaded.";
					}
					else{ echo $product['product']; }
                ?>
            </td>
            <td align="center"><?php echo toDecimal($product['price']); ?></td>
            <td align="center">
                <?php echo $product['quantity']; ?>
            </td>
            <td align="center"><?php echo toDecimal($product['amount']); ?></td>
        </tr>
        <?php
                }
            }
        ?>
    </table>
    <button type="button" onClick="closeThis();" class="btn btn-danger btn-sm">Close</button>
</div>