<div class="row">
	<div class="col-md-12 table-responsive">
    	<table class="table table-bordered table-condensed">
        	<thead>
            	<tr>
                	<th style="text-align:center;" width="20%">Subject</th>
                	<th style="text-align:center;" width="35%">Name of Books</th>
                	<th style="text-align:center;" width="15%">MRP</th>
                	<th style="text-align:center;" width="15%">Discount (%)</th>
                	<th style="text-align:center;" width="15%">Cost</th>
                </tr>
            </thead>
            <?php
				$where="`school_id`='$school_id' and `class_id`='$class_id'";
            	$books=$obj->get_rows("`tbl_books`","*",$where);
				$prevsub='';$book_total=0;
				if(is_array($books)){
					foreach($books as $book){
						$subject_id=$book['subject_id'];
						$selsub=$obj->get_details("`tbl_subject`","*","`id`='$subject_id'");
						$count=$obj->get_count("`tbl_books`",$where." and `subject_id`='$subject_id'");
			?>
            <tr>
            	<?php if($count>=1 && $subject_id!=$prevsub){?>
                <td align="center" rowspan='<?php echo $count; ?>' style="vertical-align:middle;"><?php echo $selsub['name']; ?></td>
				<?php } $prevsub=$subject_id; ?>
            	<td align="center"><?php echo $book['name']; ?></td>
            	<td align="center"><?php echo $book['mrp']; ?></td>
            	<td align="center"><?php echo $book['discount']."%"; ?></td>
            	<td align="center"><?php echo $book['cost']; ?></td>
            </tr>
            <?php
						$book_total+=$book['cost'];
					}
			?>
            <tr>
            	<th colspan="4" style="text-align:right" >Book Subtotal Cost : </th>
                <th style="text-align:center;"><?php echo $book_total; ?></th>
            </tr>
            <?php
				}
				else{
					echo "<tr><td colspan='5' class='text-center text-danger'>No Result Found!</td></tr>";	
				}
			?>
            
        </table>
    </div>
</div><br>
<div class="row">
	<div class="col-xs-12"><h4>Copy List </h4></div>
</div>
<div class="row">
	<div class="col-md-12 table-responsive">
    	<table class="table table-bordered table-condensed">
        	<thead>
            	<tr>
                	<th style="text-align:center;" width="5%">Sl No.</th>
                	<th style="text-align:center;" width="15%">Copy Type</th>
                	<th style="text-align:center;" width="20%">No. of Pages</th>
                	<th style="text-align:center;" width="15%">Quality</th>
                	<th style="text-align:center;" width="15%">MRP</th>
                	<th style="text-align:center;" width="15%">Discount (%)</th>
                	<th style="text-align:center;" width="15%">Cost</th>
                </tr>
            </thead>
            <?php
				$where="`school_id`='$school_id' and `class_id`='$class_id'";
            	$copies=$obj->get_rows("`tbl_copy`","*",$where);
				$copy_total=0;
				if(is_array($copies)){$i=0;
					foreach($copies as $copy){$i++;
			?>
            <tr>
                <td align="center"><?php echo $i; ?></td>
            	<td align="center"><?php echo $copy['name']; ?></td>
            	<td align="center"><?php echo $copy['pages']; ?></td>
            	<td align="center"><?php echo $copy['quality']; ?></td>
            	<td align="center"><?php echo $copy['mrp']; ?></td>
            	<td align="center"><?php echo $copy['discount']."%"; ?></td>
            	<td align="center"><?php echo $copy['cost']; ?></td>
            </tr>
            <?php
						$copy_total+=$copy['cost'];
					}
			?>
            <tr>
            	<th colspan="6" style="text-align:right" >Copy Subtotal Cost : </th>
                <th style="text-align:center;"><?php echo $copy_total; ?></th>
            </tr>
            <?php
				}
				else{
					echo "<tr><td colspan='7' class='text-center text-danger'>No Result Found!</td></tr>";	
				}
			?>
            
        </table>
    </div>
</div><br>
<div class="row">
	<div class="col-xs-12"><h4>Stationery List </h4></div>
</div>
<div class="row">
	<div class="col-md-12 table-responsive">
    	<table class="table table-bordered table-condensed">
        	<thead>
            	<tr>
                	<th style="text-align:center;" width="5%">Sl No.</th>
                	<th style="text-align:center;" width="25%">Particulars</th>
                	<th style="text-align:center;" width="25%">Quantity</th>
                	<th style="text-align:center;" width="15%">MRP</th>
                	<th style="text-align:center;" width="15%">Discount (%)</th>
                	<th style="text-align:center;" width="15%">Cost</th>
                </tr>
            </thead>
            <?php
				$where="`school_id`='$school_id' and `class_id`='$class_id'";
            	$stationeries=$obj->get_rows("`tbl_stationary`","*",$where);
				$stationery_total=0;
				if(is_array($stationeries)){$i=0;
					foreach($stationeries as $stationery){$i++;
			?>
            <tr>
                <td align="center"><?php echo $i; ?></td>
            	<td align="center"><?php echo $stationery['particulars']; ?></td>
            	<td align="center"><?php echo $stationery['quantity']; ?></td>
            	<td align="center"><?php echo $stationery['mrp']; ?></td>
            	<td align="center"><?php echo $stationery['discount']."%"; ?></td>
            	<td align="center"><?php echo $stationery['cost']; ?></td>
            </tr>
            <?php
						$stationery_total+=$stationery['cost'];
					}
			?>
            <tr>
            	<th colspan="5" style="text-align:right" >Stationery Subtotal Cost : </th>
                <th style="text-align:center;"><?php echo $stationery_total; ?></th>
            </tr>
            <?php
				}
				else{
					echo "<tr><td colspan='6' class='text-center text-danger'>No Result Found!</td></tr>";	
				}
			?>
            
        </table>
    </div>
</div><br>
