<?php
session_start();
$user_id='';
if(isset($_SESSION['user_id'])){
	$user_id=$_SESSION['user_id'];
	$role=$_SESSION['role'];
	$where="`user_id`='$user_id'";
}
else{
	header("Location:index.php");
}
	include('admin/class/config.php');
	$obj=Database::getInstance();
	$count=20;
	$offset=0;
	if(isset($_GET['page']) and trim($_GET['page'])!=''){
		$page=$_GET['page'];	
	}
	else{$page=1;}
	$offset=($page-1)*$count;
	$orders=$obj->get_rows("`tbl_wishlist`","*",$where,"id desc","$offset,$count");
	$rowcount=$obj->get_count("`tbl_wishlist`",$where);
	$pages=ceil($rowcount/$count);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book My Syllabus</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="my-css/style.css" rel="stylesheet">
    <!-- ---------- font ---------------------- -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700|Roboto:400,500,700" rel="stylesheet">
    <!-- ---------- font awesome ---------------------- -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
  </head>
  <body>
  <?php include 'header-nav.php'; ?>
    <section class="cart-summary" style="margin-top:135px; padding:20px 0;">
    	<div class="container">
        	<div class="row">
            	<?php
                	if(isset($_SESSION['msg'])){echo "<h4 class='text-success text-center' id='success'>".$_SESSION['msg']."</h4>"; unset($_SESSION['msg']);}
                	if(isset($_SESSION['err'])){echo "<h4 class='text-danger text-center' id='error'>".$_SESSION['err']."</h4>"; unset($_SESSION['err']);}
				?>
            	<div class="col-md-12" id="orders">
                	<legend><h3>My Orders</h3></legend>
                    <div class="table-responsive">
                    	<table class="table table-striped table-condensed">
                        	<tr>
                            	<th style="text-align:center;">Sl.No</th>
                            	<th style="text-align:center;">Product</th>
                            	<th style="text-align:center;" width="30%">Action</th>
                            </tr>
                            <?php
                            	if(is_array($orders)){$i=0;
									foreach($orders as $order){$i++;
										$selcost=$obj->get_details("`tbl_products`","`cost`","`id`='".$order['product_id']."'");
							?>
                            <tr>
                            	<td align="center"><?php echo $i;  ?></td>
                            	<td align="center"><?php echo $order['product'];  ?></td>
                            	<td align="center">
                                	<form action="addtocart.php" method="post" class="col-md-12">
                                        <input type="hidden" name="price" value="<?php echo $selcost['cost']; ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="product_id" value="<?php echo $order['product_id']; ?>">
                                        <input type="hidden" name="product" value="<?php echo $order['product']; ?>">
                                        <button type="submit" name="tocart" class="btn btn-success btn-xs"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                        <button type="submit"  name="buynow"  value="buynow" class="btn btn-info btn-xs" onClick="checkLogin()">Buy Now</button>
                                		<a href="towishlist.php?080f6d7f511a9128d45c370f50291f92=<?php echo md5($order['id'])."&deleteProduct=deleteProduct"; ?>" 
                                    		class="btn btn-danger btn-xs" onClick="return confirmCancel()"><i class="fa fa-times"></i> Delete</a>
                                  	</form>
                                </td>
                            </tr>
                            <?php
									}
								}
								else{
									echo "<tr><td colspan='6' class='text-danger text-center'>No Orders Placed</td></tr>";	
								}if($pages>1){
							?>
							<tr>
								<td colspan="6" align="center">
							<?php
									if($page!=1){
							?>	
									<ul class="pagination pagination-sm">
										<li><a href="mywishlist.php?page=<?php echo $page-1; ?>">Prev</a></li>
									</ul>
							<?php
									}
									for($i=1;$i<=$pages;$i++){
										if($i<4 || $i>$pages-3 || $i==$page || $i==$page-1 || $i==$page+1 || $i==$page-2 || $i==$page+2){
							?>	
									<ul class="pagination pagination-sm">
										<li <?php if($i==$page){echo "class='active'";} ?>>
											<a href="mywishlist.php?page=<?php echo $i; ?>">
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
										<li><a href="mywishlist.php?page=<?php echo $page+1; ?>">
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
                    </div>
                </div>
                <div class="col-md-12" id="orderlist" style="display:none;">
                	
                </div>
            </div>
        </div><!-- end of container -->
    </section>
<?php include 'footer.php'; ?>
	<script language="javascript">
		$(document).ready(function() {
			var success=$('#success').html();
			var error=$('#error').html();
			setTimeout(function() {
				if(success){
					$('#success').hide();
				}
				if(error){
					$('#error').hide();
				}
			},3000);
		});
		function viewOrder(str){
			var id=str;
			$.ajax({
				type:"GET",
				url:"orderlist.php",
				data:{id:id},
				success: function(data){
					$('#orders').hide();
					$('#orderlist').html(data);
					$('#orderlist').show();
					
				}
			});
		}
		function closeThis(){
			$('#orders').show();
			$('#orderlist').hide();
		}
		
		function confirmCancel(){
			if(confirm("Are you sure you want to delete this product from wishlist?"))	{
				return true;
			}
			else{return false;}
		}
    </script>

  </body>
</html>
