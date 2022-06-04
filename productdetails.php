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
	$temp_id=$_GET['080f6d7f511a9128d45c370f50291f92'];
	$array=$obj->get_rows("`tbl_products`","`id`");
	$id='';
	foreach($array as $ids){
		if($temp_id==md5($ids['id'])){
			$id=$ids['id'];
			break;
		}
	}
	if($id!=''){
		$array=$obj->get_details("`tbl_products`","*","`id`='$id'");
	}
	else{
		header("Location:index.php");
	}
	$wishlistids=array();
	if($user_id!=''){
		$selwishlistid=$obj->get_rows("`tbl_wishlist`","`product_id`",$where);
		foreach($selwishlistid as $wishlistid){
			if($wishlistid['product_id']!=0)
				$wishlistids[]=$wishlistid['product_id'];
		}
	}
	$ratings=$obj->get_details("`tbl_review`","avg(rating) as rating, count(id) as count","`product_id`='$id'");
	$prating=($ratings['rating']*100)/5;
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
    <section class="cart-summary" style="margin-top:135px; padding:20px 0;">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-12" style="padding:10px;">
                    <div class="row">
                    	<div class="col-md-6">
                        	<div class="photo">
                                <img src="<?php echo "admin/".$array['image'];  ?>" class="img-responsive" alt="<?php echo $array['name']; ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                        	<div class="row">
                                <div class="col-md-12">
                					<legend><h3><?php echo $array['name']; ?></h3></legend>
                                    <div class="row" style="padding:0 15px;">
                                    	<div style="background: url('images/starbg.png'); background-size:<?php echo $prating; ?>% 100%; padding:0; width:128px; background-repeat:no-repeat;">
                                        	<img src="images/stars2.png" class="img-responsive" height="40">
                                        </div>
                                        <?php if($ratings['count']==0){echo "No reviews";}else{echo $ratings['count']." reviews";} ?>
                                    </div>
                                    <div class="row">
                                    	<div class="col-xs-3 col-md-2"><font size="+2">Price : </font></div>
                                        <div class="col-xs-9 col-md-10">
                                        	<?php if($array['discount']!=0){ ?>
                                            <span style="font-weight:100; padding-right:5px; text-decoration:line-through;" class="text-danger"><font size="+1"><i class="fa fa-inr"></i> <?php echo $array['price']; ?></font></span>
                                            <?php } ?>
                                            <span style="font-size:16px;" class="text-info"><font size="+2"><i class="fa fa-inr"></i> <?php echo $array['cost']; ?></font></span>
                                        </div>
                                    </div><br>
                                    <h4>Details</h4>
                                    <table class="table table-condensed">
                                        <?php
                                            $features=$obj->get_rows("`tbl_feature`","*","`product_id`='$id'");
                                            if(is_array($features)){
                                                foreach($features as $feature){
                                        ?>
                                        <tr>
                                            <th><?php echo $feature['name']; ?></th>
                                            <td><?php echo $feature['value']; ?></td>
                                        </tr>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </table>
                                </div>
                            </div>
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
                            </div><br>
                            <div class="row">
                            	<form action="addtocart.php" method="post" class="col-md-12" id="placeorder">
                                	<div class="row">
                                        <div class="col-xs-3 col-sm-2"><strong style="font-size:16px">Quantity</strong></div>
                                        <div class="col-xs-3 col-sm-2"><input type="number" name="quantity" class="form-control" min="1" required value="1"></div>
                                    </div><br>
                                    <div class="row">
                                    	<div class="col-md-12">
                                        	<input type="hidden" name="price" value="<?php echo $array['cost']; ?>">
                                        	<input type="hidden" name="product_id" value="<?php echo $id; ?>">
                                        	<input type="hidden" name="product" value="<?php echo $array['name']; ?>">
                                        	<input type="hidden" name="buynow" id="buynow" >
                                            <button type="submit" name="tocart" class="btn btn-danger btn-sm"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
                                            <button type="button"  class="btn btn-warning btn-sm" onClick="checkLogin()">Buy Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div><!-- end of details -->
                    <div class="row" style="border-bottom:1px solid #bbb">
                     	<div class="col-md-12"><h4>Description:</h4> <p><?php echo $array['description']; ?></p></div>
                    </div><!-- end of description --><br>
                    <div class="row">
                    	<?php if(isset($_SESSION['user_id'])){ ?>
                    	<form action="addreview.php" method="post" onSubmit="return validate()" class="col-sm-6">
                        	<legend style="font-size:18px;">Add a Review</legend>
                            <div class="row" style="padding:0 15px;" onMouseOut="colorThis(0);">
                                    <div style="background: url('images/starbg.png'); background-size:10% 10%;  padding:0; width:125px; background-repeat:no-repeat; height:25px" id="ratingDiv">
                                        <img src="images/star.png" class="img-responsive" id="star1" style="position:relative; float:left; height:25px;" 
                                        		onMouseOver="colorThis(1)" onClick="setThis(1)">
                                        <img src="images/star.png" class="img-responsive" id="star2" style="position:relative; float:left; height:25px;" 
                                        		onMouseOver="colorThis(2)" onClick="setThis(2)">
                                        <img src="images/star.png" class="img-responsive" id="star3" style="position:relative; float:left; height:25px;" 
                                        		onMouseOver="colorThis(3)" onClick="setThis(3)">
                                        <img src="images/star.png" class="img-responsive" id="star4" style="position:relative; float:left; height:25px;" 
                                        		onMouseOver="colorThis(4)" onClick="setThis(4)">
                                        <img src="images/star.png" class="img-responsive" id="star5" style="position:relative; float:left; height:25px;" 
                                        		onMouseOver="colorThis(5)" onClick="setThis(5)">
                                    </div>
                            </div><br>
                            <div class="col-sm-12">
                            	<input type="hidden" name="rating" id="rating" value="0">
                            	<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                            	<input type="hidden" name="product_id" value="<?php echo $id; ?>">
                            	<div class="form-group">
                                  	<label for="review">Review:</label>
                                  	<textarea class="form-control" rows="5" id="review" name="review" placeholder="Write a Review!"></textarea>
                                </div>
                                <input type="submit" name="addReview" value="Save Review" class="btn btn-success">
                            </div>
                        </form>
                    	<?php } ?>
                        <div class="col-sm-6">
                        	<legend style="font-size:18px;">Reviews</legend>
                        	<?php 
								$reviews=$obj->get_rows("`tbl_review` t1,`tbl_member` t2","t1.*,t2.`name`","t1.`product_id`='$id' and t1.`user_id`=t2.`id`","`added_on` desc","5");	
								if(is_array($reviews)){$r=0;
									foreach($reviews as $review){$r++;
										echo $review['name']." (".date('d-M-Y',strtotime($review['added_on'])).")<br>";
										$rpercent=($review['rating']*100)/5;
							?>
                            <div style="background: url('images/starbg.png'); background-size:<?php echo $rpercent; ?>%  100%; padding:0; width:80px; background-repeat:no-repeat;">
                                <img src="images/stars2.png" class="img-responsive" height="40">
                            </div>
                            <?php
										echo $review['review']."<hr>";
									}
									if($ratings['count']>5){echo "<a href='reviews.php?080f6d7f511a9128d45c370f50291f92=$temp_id'>View More</a>";}
								}else{
									echo "No Reviews";	
								}
							?>
                        </div>
                    </div><!-- end of review -->
                </div><!-- end of col-md-12 -->
            </div><!-- end of main-row -->
        </div><!-- end of container -->
    </section>
        
<section class="stationeries">
	<div class="container">
		<div class="row">
			<h2>Similar Products</h2><hr>
            	<div class="row my-prduct-row">
                   	<?php
						$similar=$obj->get_rows("`tbl_products`","*","`category`='".$array['category']."' and id!='$id'","id","4");
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
                                        <button type="button" onClick="toWishlist('product<?php echo $i; ?>');" 
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
						}
					?>
				</div>
			</div><!-- //row -->
        </div>
    </section>
<?php include 'footer.php'; ?>
	<script language="javascript">
		
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
		
		function colorThis(str){
			var value="0% 0%";
			var rating=$('#rating').val();
			if(str==0 && rating!=0){
				rating=parseInt(rating);
				switch(rating){
					case 1:value="20% 100%";
					break;
					case 2:value="40% 100%";
					break;
					case 3:value="60% 100%";
					break;
					case 4:value="80% 100%";
					break;
					case 5:value="100% 100%";
					break;
					default:value="0% 0%";
				}
			}
			else{
				switch(str){
					case 1:value="20% 100%";
					break;
					case 2:value="40% 100%";
					break;
					case 3:value="60% 100%";
					break;
					case 4:value="80% 100%";
					break;
					case 5:value="100% 100%";
					break;
					default:value="0% 0%";
				}
			}
			$('#ratingDiv').css("background-size",value);
		}
		function setThis(str){
			switch(str){
				case 1:value="20% 100%";
				break;
				case 2:value="40% 100%";
				break;
				case 3:value="60% 100%";
				break;
				case 4:value="80% 100%";
				break;
				case 5:value="100% 100%";
				break;
				default:value="0% 0%";
			}
			$('#ratingDiv').css("background-size",value);
			$('#rating').val(str)
		}
		function checkLogin(){
			$.ajax({
				type:"POST",
				url:"checkout.php",
				data:{page:"address"}	,
				success: function(data){
					$('#buynow').val('buynow');
					$.ajax({
					   type: "POST",
					   url: "addtocart.php",
					   data: $("#placeorder").serialize(), // serializes the form's elements.
					   success: function(data)
					   {
							$('#buynow').val('');
					   }
					});
					if(data==0){
						$('#myModal').modal('show');
					}else{
						window.location="selectaddress.php";	
					}
				}
			});
		}
		function toWishlist(str){
			var id="#"+str;
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
						var bid=id+" button:last";
						$(bid).removeClass("btn-default");
						$(bid).addClass("btn-warning");
						alert("Added to Wishlist!");	
					}
				}
			});
		}
		
		function validate(){
			var rating=$('#rating').val();
			if(rating==0){
				alert("Please Give Rating!");	
				return false;
			}	
		}
    </script>

  </body>
</html>
