<?php
session_start();
if(!isset($_COOKIE['client_id'])){
	$cookie_value=md5(uniqid(rand(), true));
	setcookie('client_id', $cookie_value, time() + (86400 * 30), '/');
}
$user_id='';
$client_id='';
if(isset($_SESSION['user_id'])){
	$user_id=$_SESSION['user_id'];
	$role=$_SESSION['role'];
	$where="`user_id`='$user_id'";
}
elseif(isset($_COOKIE['client_id'])){
	$client_id=$_COOKIE['client_id'];
	$where="`client_id`='$client_id'";
}
else{
	$client_id=$cookie_value;
	$where="`client_id`='$client_id'";
}
	include('admin/class/config.php');
	$obj=Database::getInstance();
	$wishlistids=array();
	if($user_id!=''){
		$selwishlistid=$obj->get_rows("`tbl_wishlist`","`product_id`",$where);
		foreach($selwishlistid as $wishlistid){
			if($wishlistid['product_id']!=0)
				$wishlistids[]=$wishlistid['product_id'];
		}
	}
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
    <link href="my-css/product-scroll.css" rel="stylesheet">
    <!-- ---------- font ---------------------- -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700|Roboto:400,500,700" rel="stylesheet">
    <!-- ---------- font awesome ---------------------- -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
  </head>
  <body>
  <?php include 'header-nav.php'; ?>
    <section class="cart-summary" style="margin-top:135px;">
    	<div class="container">
        	<div class="row">
            	<?php
                	if(isset($_SESSION['msg'])){echo "<h4 class='text-success text-center' id='success'>".$_SESSION['msg']."</h4>"; unset($_SESSION['msg']);}
                	if(isset($_SESSION['err'])){echo "<h4 class='text-danger text-center' id='error'>".$_SESSION['err']."</h4>"; unset($_SESSION['err']);}
				?>
            	<div class="col-md-12" style="padding:10px;">
                	<legend><h3>Cart</h3></legend>
                    <div class="table-responsive">
                    	<table class="table table-bordered table-condensed table-hover">
                        	<thead>
                            	<th style="text-align:center;" width="10%">Sl No</th>
                            	<th style="text-align:center;">Product</th>
                            	<th style="text-align:center;">Price</th>
                            	<th style="text-align:center;">Quantity</th>
                            	<th style="text-align:center;">Amount</th>
                            	<th style="text-align:center;" width="10%">Action</th>
                            </thead>
                            <?php
                            	$array=$obj->get_rows("`tbl_cart`","*",$where);
								$category=array();$pid=array();
								if(is_array($array)){$i=0;$k=10;
									foreach($array as $product){$i++;$k++;
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
										else{
											echo $product['product'];
											$selcat=$obj->get_details("`tbl_products`","`category`","`id`='".$product['product_id']."'");
											$category[]="'".$selcat['category']."'";
											$pid[]="'".$product['product_id']."'";
										}
									?>
                                </td>
                            	<td align="center"><?php echo $product['price']; ?></td>
                            	<td align="center">
									<?php echo $product['quantity']; ?>
                                </td>
                            	<td align="center"><?php echo $product['amount']; ?></td>
                                <td align="center">
                                	<?php if($product['product_id']==0 && $product['product']!=''){
										$where="`school_id`='$school_id' and `class_id`='$class_id'";
										$bookcost=$obj->get_details("`tbl_books`","round(sum(`cost`),2) as bookcost",$where);
										$book_total=$bookcost['bookcost'];
										$copycost=$obj->get_details("`tbl_copy`","round(sum(`cost`),2) as copycost",$where);
										$copy_total=$copycost['copycost'];
										$stcost=$obj->get_details("`tbl_stationary`","round(sum(`cost`),2) as stcost",$where);
										$stationery_total=$stcost['stcost'];
									?>
                                    <form action="placeorder.php" class="col-md-12" method="get">
                                        <input type="hidden" name="school_id" value="<?php echo $school_id; ?>" />
                                        <input type="hidden" name="class_id" value="<?php echo $class_id; ?>" />
                                        <input type="hidden" name="book_total" value="<?php echo $book_total; ?>" />
                                        <input type="hidden" name="copy_total" value="<?php echo $copy_total; ?>" />
                                        <input type="hidden" name="stationery_total" value="<?php echo $stationery_total; ?>" />
                                        <input type="hidden" name="id" value="<?php echo $product['id']; ?>" />
                                        <button type="submit" name="editorder" value="editorder" 
                                        	class="btn btn-info btn-xs" title="edit" ><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-xs" title="Delete" onClick="confirmDelete('<?php echo md5($product['id']); ?>');">
                                            <i class="fa fa-trash"></i>
                                    </button>
                                    </form>
                                    <?php }elseif($product['product_id']==0 && $product['product']==''){
									?>
                                	<button type="button" class="btn btn-danger btn-xs" title="Delete" onClick="confirmDelete('<?php echo md5($product['id']); ?>');">
                                    	<i class="fa fa-trash"></i>
                                    <?php }else{ ?>
									<form action="#" method="post" id="product<?php echo $k; ?>">
                                        <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
                                        <input type="hidden" name="product" value="<?php echo $product['product']; ?>">
                                        <input type="hidden" name="towishlist">
                                        <button type="button" onClick="toWishlist('product<?php echo $k; ?>','<?php echo md5($product['id']); ?>');" 
                                        class="btn btn-xs <?php if(array_search($product['product_id'],$wishlistids) !==false){echo "btn-warning";}else{echo "btn-default";} ?>">
                                        <i class="fa fa-heart" aria-hidden="true"></i></button>
                                        <button type="button" class="btn btn-info btn-xs" title="Edit" onClick="editThis('<?php echo $product['id']; ?>')"
                                                data-toggle="modal" data-target="#editModal"><i class="fa fa-edit"></i></button>
                                        <button type="button" class="btn btn-danger btn-xs" title="Delete" onClick="confirmDelete('<?php echo md5($product['id']); ?>');">
                                            <i class="fa fa-trash"></i>
                                        </button>
									</form>
                                    
                                    <?php }?>
                                </td>
                            </tr>
                            <?php
									}
								}
								else{
									echo "<tr><td colspan='6' class='text-danger text-center'>No Item Added to Cart! </td></tr>";
								}
							?>
                        </table>
                    </div>
                    <?php if(is_array($array)){ ?> 
                    <div class="row">
                        <div class="col-md-12">
                            <table>
                                <tr>
                                    <td>
                                    	<input type="text" name="pincode" id="pincode" class="form-control" placeholder="Enter Pincode" style="border-radius:0;">
                                       	<img src="loading.gif" id="loader" style="height: 25px; position: absolute; margin-top: -30px; margin-left: 140px; display:none;">
                                    </td>
                                    <td><button type="button" class="btn btn-warning" style="border-radius:0;" onClick="checkPincode();">Check Pincode</button></td>
                                </tr>
                                <tr>
                                    <td colspan="2" id="result"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <button class="btn btn-warning pull-right" onClick="checkLogin()">Checkout</button>
					<?php } ?>
                    <a href="index.php" class="btn btn-primary pull-right" style="margin-right:10px;">Continue Shopping</a>
                </div>
            </div>
            <div class="modal fade" id="editModal" role="dialog">
                <div class="modal-dialog modal-md">
                  	<div class="modal-content">
                    	<div class="modal-body">
                        	<form action="addtocart.php" method="post">
                            	<table class="table">
                                	<tr>
                                    	<th>Product</th>
                                        <td><input type="text" class="form-control" id="name" readonly ></td>
                                    </tr>
                                	<tr>
                                    	<th>Price</th>
                                        <td><input type="text" class="form-control" id="price" name="price" readonly ></td>
                                    </tr>
                                	<tr>
                                    	<th>Quantity</th>
                                        <td><input type="number" class="form-control" id="quantity" name="quantity" min="1" ></td>
                                    </tr>
                                    <tr>
                                    	<td colspan="2">
                                        	<input type="hidden" name="id" id="id">
                                        	<input type="submit" name="updateCart" value="Update" class="btn btn-success">
                      						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </td>
                                    </tr>
                                </table>
                            </form>
                    	</div>
                  	</div>
             	</div>
          	</div>
        </div><!-- end of container -->
    </section>
    
    
    
<section class="stationeries">
	<div class="container">
		<div class="row">
			<?php 
                $categories=implode(',',$category);$ids=implode(',',$pid);
                $similar=$obj->get_rows("`tbl_products`","*","`category` in($categories) and `id` not in ($ids) ","id","4");
                if(is_array($similar)){$header="Similar Products : ";}
                if(!is_array($similar)){
                    $similar=$obj->get_rows("`tbl_products`","*","`id` not in ($ids) group by `category`","id","4");
                    $header = "You Can Also See : ";
                }
                if(!is_array($similar)){
                    $similar=$obj->get_rows("`tbl_products`","*","`id`!='0' group by `category`","id","4");
                    $header = "You Can See : ";
                }
            ?>
			<h2><?php echo $header; ?></h2><hr>
            	<div class="row my-prduct-row">
                   	<?php
                        if(is_array($similar)){$i=0;
                            foreach($similar as $product){$i++;
                    ?>
					 <div class="col-sm-3">
						<div class="col-item">
							<div class="st-photo">
								<a href="productdetails.php?080f6d7f511a9128d45c370f50291f92=<?php echo md5($product['id']); ?>">
                                	<img src="<?php echo "admin/".$product['thumbnail'];  ?>" class="img-responsive" alt="<?php echo $product['name']; ?>" />
                                </a>
							</div>
							<div class="info">
								<div class="row">
									<div class="prod-title">
                                    	<a href="productdetails.php?080f6d7f511a9128d45c370f50291f92=<?php echo md5($product['id']); ?>"><?php echo $product['name']; ?></a>
                                    </div>
									<div class="price">
                                    	<?php if($product['discount']!=0){ ?>
										<a href="#"><del><i class="fa fa-inr"></i> <?php echo $product['price']; ?></del></a>
                                        <?php } ?>
										<span><a href="#" class="price-text-color"><i class="fa fa-inr"></i> <?php echo $product['cost']; ?></a></span>
									</div>
								</div>
								<div class="product-btn-sec">
                                    <form action="addtocart.php" method="post">
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="price" value="<?php echo $product['cost']; ?>">
                                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                        <input type="hidden" name="product" value="<?php echo $product['name']; ?>">
										<button type="submit" name="tocart" class="btn btn-sm btn-default"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>
									</form>
									<form action="#" method="post" id="product<?php echo $i; ?>">
                                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                        <input type="hidden" name="product" value="<?php echo $product['name']; ?>">
                                        <input type="hidden" name="towishlist">
                                        <button type="button" onClick="toWishlist('product<?php echo $i; ?>','dont');" 
                                        class="btn btn-sm <?php if(array_search($product['id'],$wishlistids) !==false){echo "btn-warning";}else{echo "btn-default";} ?>">
                                        <i class="fa fa-heart" aria-hidden="true"></i></button>
									</form>
									<a href="productdetails.php?080f6d7f511a9128d45c370f50291f92=<?php echo md5($product['id']); ?>" class="btn btn-sm btn-default"><i class="fa fa-list"></i> More</a>
								</div>
								<div class="clearfix"></div>
							</div><!-- //info -->
						</div>
					</div>
                    <?php
							}
						}/*
					?>
					 <div class="col-sm-3">
						<div class="col-item">
							<div class="st-photo">
								<a href="#"><img src="images/copy1.jpg" class="img-responsive" alt="copy1" /></a>
							</div>
							<div class="info">
								<div class="row">
									<div class="prod-title"><a href="#">School Copy</a></div>
									<div class="price">
										<a href="#"><del><i class="fa fa-inr"></i> 100</del></a>
										<span><a href="#" class="price-text-color"><i class="fa fa-inr"></i> 85</a></span>
									</div>
								</div>
								<div class="product-btn-sec">
									<form action="#" method="post">
										<button type="submit" class="btn btn-sm btn-default"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>
									</form>
									<form action="#" method="post">
										<button type="submit" class="btn btn-sm btn-default"><i class="fa fa-heart" aria-hidden="true"></i></button>
									</form>
									<a href="#" class="btn btn-sm btn-default"><i class="fa fa-list"></i> More</a>
								</div>
								<div class="clearfix"></div>
							</div><!-- //info -->
						</div>
					</div>
					 <div class="col-sm-3">
						<div class="col-item">
							<div class="st-photo">
								<a href="#"><img src="images/copy2.jpg" class="img-responsive" alt="copy1" /></a>
							</div>
							<div class="info">
								<div class="row">
									<div class="prod-title"><a href="#">School Copy</a></div>
									<div class="price">
										<a href="#"><del><i class="fa fa-inr"></i> 100</del></a>
										<span><a href="#" class="price-text-color"><i class="fa fa-inr"></i> 85</a></span>
									</div>
								</div>
								<div class="product-btn-sec">
									<form action="#" method="post">
										<button type="submit" class="btn btn-sm btn-default"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>
									</form>
									<form action="#" method="post">
										<button type="submit" class="btn btn-sm btn-default"><i class="fa fa-heart" aria-hidden="true"></i></button>
									</form>
									<a href="#" class="btn btn-sm btn-default"><i class="fa fa-list"></i> More</a>
								</div>
								<div class="clearfix"></div>
							</div><!-- //info -->
						</div>
					</div>
					 <div class="col-sm-3">
						<div class="col-item">
							<div class="st-photo">
								<a href="#"><img src="images/copy3.jpg" class="img-responsive" alt="copy1" /></a>
							</div>
							<div class="info">
								<div class="row">
									<div class="prod-title"><a href="#">School Copy</a></div>
									<div class="price">
										<a href="#"><del><i class="fa fa-inr"></i> 100</del></a>
										<span><a href="#" class="price-text-color"><i class="fa fa-inr"></i> 85</a></span>
									</div>
								</div>
								<div class="product-btn-sec">
									<form action="#" method="post">
										<button type="submit" class="btn btn-sm btn-default"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>
									</form>
									<form action="#" method="post">
										<button type="submit" class="btn btn-sm btn-default"><i class="fa fa-heart" aria-hidden="true"></i></button>
									</form>
									<a href="#" class="btn btn-sm btn-default"><i class="fa fa-list"></i> More</a>
								</div>
								<div class="clearfix"></div>
							</div><!-- //info -->
						</div>
					</div>
					 <div class="col-sm-3">
						<div class="col-item">
							<div class="st-photo">
								<a href="#"><img src="images/copy4.jpg" class="img-responsive" alt="copy1" /></a>
							</div>
							<div class="info">
								<div class="row">
									<div class="prod-title"><a href="#">School Copy</a></div>
									<div class="price">
										<a href="#"><del><i class="fa fa-inr"></i> 100</del></a>
										<span><a href="#" class="price-text-color"><i class="fa fa-inr"></i> 85</a></span>
									</div>
								</div>
								<div class="product-btn-sec">
									<form action="#" method="post">
										<button type="submit" class="btn btn-sm btn-default"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>
									</form>
									<form action="#" method="post">
										<button type="submit" class="btn btn-sm btn-default"><i class="fa fa-heart" aria-hidden="true"></i></button>
									</form>
									<a href="#" class="btn btn-sm btn-default"><i class="fa fa-list"></i> More</a>
								</div>
								<div class="clearfix"></div>
							</div><!-- //info -->
						</div>
					</div>
					*/ ?>
				</div>
			</div><!-- //row -->
        </div>
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
			
			$('.order').click(function(){
				var total=parseFloat($('#book_total').val());
				$.each($("input[name='order[]']:checked"), function() {
					if($(this).val()=='copy'){
						total+=parseFloat($('#copy_total').val());
					}
					if($(this).val()=='stationery'){
						total+=parseFloat($('#stationery_total').val());
					}
				});	
				total=total.toFixed(2);
				$('#total').val(total);
			});
		});
		
		function checkPincode(){
			var pincode=$('#pincode').val();
			$('#result').html('');
			$.ajax({
				type:"POST",
				url:"subscribe.php",
				data:{pincode:pincode,checkPincode:'checkPincode'},
				beforeSend: function(){
					$('#loader').show();
				},
				success: function(data){
					$('#loader').hide();
					if(data==0){
						$('#result').addClass("text-danger");
						$('#result').removeClass("text-success");
						$('#result').html('Delivery Not Available! ');
					}else{
						$('#result').addClass("text-success");
						$('#result').removeClass("text-danger");
						$('#result').html('Delivery Available! ');
					}
					setTimeout(function() {
						$('#result').html('');
					},5000);
				}	
			});
		}
		
		function editThis(str){
			var id=str;
			$.ajax({
				type:"POST",
				url:"ajax_returns.php",
				data:{id:id,editcart:"editcart"}	,
				dataType:"json",
				success: function(data){
					$('#name').val(data['product']);
					$('#price').val(data['price']);
					$('#quantity').val(data['quantity']);
					$('#id').val(data['id']);
				}
			});
		}
		
		function confirmDelete(str){
			var id=str;
			if(confirm("Are you sure you want to delete this Item?")){
				window.location="deletecart.php?removeItem=removeItem&080f6d7f511a9128d45c370f50291f92="+id;
			}
		}
		
		function checkLogin(){
			$.ajax({
				type:"POST",
				url:"checkout.php",
				data:{page:'cart'}	,
				success: function(data){
					if(data==0){
						$('#myModal').modal('show');
					}else{
						window.location="selectaddress.php";	
					}
				}
			});
		}
		function toWishlist(str,str2){
			var id="#"+str;
			//alert(id)
			$.ajax({
				type:"POST",
				url:"checkout.php",
				success: function(data){
					$.ajax({
					   type: "POST",
					   url: "towishlist.php",
					   data: $(id).serialize(), // serializes the form's elements.
					   success: function(data)
					   {
					   }
					});
					if(data==0){
						$('#myModal').modal('show');
					}
					else{
						var bid=id+" button:first";
						$(bid).removeClass("btn-default");
						$(bid).addClass("btn-warning");
						alert("Added to Wishlist!");
						if(str2!='dont'){
							$.ajax({
							   type: "get",
							   url: "deletecart.php",
							   data: {'removeItem':'removeItem','wishlist':'wishlist','080f6d7f511a9128d45c370f50291f92':str2}, // serializes the form's elements.
							   success: function(data)
							   {
								   //alert(data);
								   window.location="cart.php";
							   }
							});
						}	
					}
				}
			});
		}
    </script>

  </body>
</html>
