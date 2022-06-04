<?php 
session_start();
if(isset($_SESSION['role']) && $_SESSION['role']=='admin')
{
	$role=$_SESSION['role'];
}else{
	header("Location:logout.php");
}
include_once "class/config.php";
$db=Database::getInstance();
$temp_id=$_GET['080f6d7f511a9128d45c370f50291f92'];
$array=$db->get_rows("`tbl_orders`","`id`");
$id='';
foreach($array as $ids){
	if($temp_id==md5($ids['id'])){
		$id=$ids['id'];
		break;
	}
}
if($id==''){header("Location:order_list.php");}
$array=$db->get_details("`tbl_orders`","*","`id`='$id'");
$orderlist=$db->get_rows("`tbl_orderlist`","*","`order_id`='$id'");
//print_r($orderlist);

foreach($orderlist as $key=>$order){
	$product=explode(',',$order['product']);
	if(array_search("book",$product)!==false){
		$school_id=$order['school_id'];
		$class_id=$order['class_id'];
		$where="`school_id`='$school_id' and `class_id`='$class_id'";
		$books=$db->get_rows("`tbl_books`","`name` as `product`,`mrp` as `mrp`,`discount` as `discount`,`cost` as `price`,`cost` as `amount`",$where);
		$copies='';$stationeries='';
		if(array_search("copy",$product)!==false){
			$copies=$db->get_rows("`tbl_copy`","`name` as `product`,`quantity`,`mrp` as `mrp`,`discount` as `discount`,`cost`/`quantity` as `price`,`cost` as `amount`",$where);
		}
		if(array_search("stationery",$product)!==false){
			$stationeries=$db->get_rows("`tbl_stationary`","`name` as `product`,`cost` as `price`,`cost` as `amount`",$where);
		}
		unset($orderlist[$key]);
		foreach($books as $book){
			$orderlist[]=$book;
		}
		if(is_array($copies)){
			foreach($copies as $copy){
				$orderlist[]=$copy;
			}
		}
		if(is_array($stationeries)){
			foreach($stationeries as $stationery){
				$orderlist[]=$stationery;
			}
		}
		//$orderlist=array_merge($orderlist,$books);
		//if(is_array($copies))$orderlist=array_merge($orderlist,$copies);
		//if(is_array($stationeries))$orderlist=array_merge($orderlist,$stationeries);
		
	}
}
//print_r($orderlist);
?>
<!DOCTYPE html>
<html lang="en" moznomarginboxes mozdisallowselectionprint>
  <head>
    <meta charset="utf-8">
    <title>BookMySyllabus | Print</title>  
	<style type="text/css" media="print">
			@page {
					margin:0 10px;
					/*size:8.27in 11.69in ;
					/*height:3508 px;
					width:2480 px;
					/*size: auto;   auto is the initial value */
					/*margin:0;   this affects the margin in the printer settings 
			  		-webkit-print-color-adjust:exact;*/
			}
			@media print{
				table { page-break-inside:auto }
				tr    { page-break-inside:avoid; page-break-after:auto }
  				td    { page-break-inside:avoid; page-break-after:auto }
				#buttons{
						display:none;
				}
				#invoice{
					margin-top:20px;
  				}
			}
		</style>
  </head>
  <body>
  	<div id="invoice" style="width:1000px;page-break-before: always;page-break-inside: avoid;">
    	<table border="1" cellpadding="0" cellspacing="0" width="95%" height="1102" align="center" id="table">
        	<tr height="100">
            	<td colspan="7" style="padding:10px; font-size:18px">
                	<div style="width:48%; float:left; position:relative; text-align:center;"><img src="../images/logo.png"></div>
                    <div style="border:1px solid #eeeeee;width:48%; float:left; position:relative; padding:20px 10px;">
                        Near Sunday Market<br>
                        Shivaji Marg, Ratu<br>
                        Ranchi - 835222, Jharkhand, India
                    </div>
				</td>
            </tr>
            <tr height="35"><td align="center" colspan="7" style="font-size:24px;">INVOICE</td></tr>
            <tr height="30">
            	<td colspan="2" rowspan="4" style="padding:5px 20px;">
                	To,<br>
                    <?php echo ucwords($array['name'])."<br>".$array['address'].", ".$array['landmark']."<br>"; ?>
                    <?php echo "P.O. - ".$array['postoffice']."<br>";?>
                    <?php echo $array['district'].", ".$array['state']." - ".$array['pincode'];?>
                </td>
                <td colspan="2" style="padding-left: 10px;">Invoice</td>
            	<td colspan="3" align="center"><?php echo "BMS".$array['id']; ?></td>
            </tr>
            <tr height="30">
            	<td colspan="2" style="padding-left: 10px;">Date</td>
            	<td colspan="3" align="center"><?php echo date('d-m-Y',strtotime($array['date'])); ?></td>
            </tr>
            <tr height="30">
            	<td colspan="2" style="padding-left:10px;">Sales Person</td>
            	<td colspan="3" align="center">Book My Syllabus</td>
            </tr>
            <tr height="30">
            	<td colspan="2" style="padding-left:10px;">Mobile</td>
            	<td colspan="3" align="center"><?php echo $array['mobile']; ?></td>
            </tr>
        	<tr height="30">
            	<th align="center" width="6%">Sl. No.</th>
            	<th align="center">Particulars</th>
            	<th align="center" width="8%">M.R.P</th>
            	<th align="center" width="8%">Discount</th>
            	<th align="center" width="8%">Price</th>
            	<th align="center" width="8%">Qty</th>
            	<th align="center" width="13%">Amount</th>
            </tr>
            <?php
				$total=0;
            	if(is_array($orderlist)){$i=0;
					foreach($orderlist as $order){$i++;
						if(isset($order['product_id']) && $order['product_id']!=0){
							$selpro=$db->get_details("`tbl_products`","`price`,`discount`","`id`='".$order['product_id']."'");
							$mrp=$selpro['price'];	$discount=$selpro['discount'];	
						}else{
							$mrp=$order['mrp'];$discount=$order['discount'];	
						}
			?>
            <tr height="30">
            	<td align="center"><?php echo $i;?></td>
            	<td style="padding-left:10px;"><?php echo $order['product'];?></td>
            	<td align="center"><?php echo toDecimal($mrp);?></td>
            	<td align="center"><?php echo $discount."%";?></td>
            	<td align="center"><?php echo toDecimal($order['price']);?></td>
            	<td align="center"><?php if(isset($order['quantity'])){echo $order['quantity'];}else{ echo 1;}?></td>
            	<td align="center"><?php echo toDecimal($order['amount']);?></td>
            </tr>
            <?php
						$total+=$order['amount'];
					}
					$total=round($total);
				}
			?>
            <tr>
            	<td></td><td></td><td></td><td></td>
                <td></td><td></td><td></td>
            </tr>
            <tr height="40">
            	<th colspan="6" align="right" style="padding-right:15px;"><font size="+1">TOTAL</font></th>
            	<th align="center"><font size="+1"><?php echo toDecimal($total);?></font></th>
            </tr>
        </table>
        <div id="buttons">
            <center>
                <button type="button" class="btn btn-danger" onclick="window.print();" 
                    style="background-color:#F70004; height:30px; width:70px; border-radius:5px; color:#FFFFFF; font-size:14px;" >Print</button>
                <button type="button" onclick="closeThis();" class="btn btn-default"
                    style="background-color:#F70004; height:30px; width:70px; border-radius:5px; color:#FFFFFF; font-size:14px;">Close</button>
            </center>
        </div>
    </div>
        <script language="javascript">
        	function closeThis(str){
				window.location="order_list.php";
			}
        </script>
  </body>
</html>
