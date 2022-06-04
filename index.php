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
		$cookie_name = 'userdata';
		$cookie_value = $user_id.",".$role;
	if((isset($_SESSION['check']) && $_SESSION['check']==1) && !isset($_COOKIE[$cookie_name])){
		if(setcookie($cookie_name, $cookie_value, time() + (86400 * 30), '/')) // 86400 = 1 day
		{	
			unset($_SESSION['check']);
		}
	}
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
//$_SESSION['user_id']=1;
	include('admin/class/config.php');
	$obj=Database::getInstance();
	$featured=$obj->get_rows("`tbl_images`","`logo`,`school_id`","`featured`='1'");
	$famous=$obj->get_rows("`tbl_images`","`logo`,`school_id`","`famous`='1'");
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
    <section class="main-search">
    	<div class="container">
        <div class="row">
        <h2>One Stop for your all Books and Accessories</h2>
        	<div class="search-block">
				<form action="searchresult.php" method="get">
                	<div class="col-md-3">
                        <select name="class" class="form-control my-class" required >
                            <option value="">--- Select Class ---</option>
                            <?php
                                $classes=$obj->get_rows("`tbl_class`");
                                if(is_array($classes)){
                                    foreach($classes as $class){
                            ?>
                            <option value="<?php echo $class['id'] ?>"><?php echo $class['class'] ?></option>
                            <?php	
                                    }
                                }
                            ?>
                        </select>
                        <input type="hidden" id="select_flag" />
                        <input type="hidden" id="direction" value="down" />
                    	<input type="hidden" id="position" />
                    	<input type="hidden" id="school_id" name="school_id" />
                    </div>
                    <div class="col-md-9">
                        <div class="search-box-bg">
                            <input type="text" name="school" id="school" placeholder="Enter Your School Name" class="inputBox" required autocomplete="off">
                            <button type="submit" id="search" class="btn my-sbmit-btn"><i class="fa fa-search" aria-hidden="true"></i></button>
                        </div>
                        <div id="school-list" style="width:87%;position:absolute; z-index:1" ></div>
                    </div>
				</form>
			</div>
            <div class="col-md-12">
            	<p>You Can also Order your books By Calling , Messaging Or What's App  <span><a href="https://web.whatsapp.com/" target="_blank"><img src="images/whatsapp.png" alt="whatsapp"> +91-8877177468 </a></span> </p>
            </div>
            <div class="clearfix"></div>
		</div>
        </div>
    </section>
    <section class="banner-bottom">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-4">
                	<div class="panel panel-success panel-control">
                        <div class="panel-heading my-pan-head"><p>Featured Schools</p></div>
                        <div class="panel-body">
                            <div class="pbody-wrap">
                            	<?php 
									if(is_array($featured)){
										foreach($featured as $ftschool){
											$selftschool=$obj->get_details("`tbl_school`","`name`,`website`","`id`='".$ftschool['school_id']."'");
								?>
                                <div class="featured">
                                    <p>
                                    	<a href="<?php if(strpos($selftschool['website'],"http")===false){echo "http://";}echo $selftschool['website'];?>" target="_blank">
                                        <img src="<?php echo "admin/".$ftschool['logo']; ?>" alt="<?php echo $selftschool['name'];?>" class="img-responsive">
                                        	<span><?php echo $selftschool['name'];?></span>
                                       	</a>
                                    </p>
                                </div>
                               	<?php
										}
									}
								?>
                            </div>
                            
                        </div><!-- //panel body-->
                    </div>
                    
                    <div class="panel panel-success panel-control">
                        <div class="panel-heading my-pan-head"><p>News / Updates</p></div>
                        <div class="panel-body">
                            <div class="news-controler">
                                <marquee behavior="scroll" direction="up" scrollamount="3" onMouseOver="this.stop()" onMouseOut="this.start()">
                                	<?php
                                    	$news_list=$obj->get_rows("`tbl_news`","*","","`id` desc","10");
										if(is_array($news_list)){
											foreach($news_list as $news){
									?>
                                    <p>&nbsp;<u><?php echo $news['title']; ?></u> : <?php echo $news['description']; ?> <a href="<?php echo $news['link']; ?>"  target="_blank">More</a> </p>
                                    <?php	
											}
										}
									?>
                                </marquee>
                            </div>
                        </div><!-- //panel body-->
                        <div class="panel-footer"></div>
                    </div>
                    
                </div><!-- end of col-md-3 -->
                <div class="col-md-8">
                    <div class="right-products">
                        <div class="row">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>Books</h2>
                                    <p class="sub-head">NCERT, CBSE, ICSE &amp; OTHER</p>
                                </div>
                                <div class="pre-next-box">
									<a class="left fa fa-chevron-left btn btn-primary" href="#carousel-1" data-slide="prev"></a>
                                    <a class="dir-right fa fa-chevron-right btn btn-primary" href="#carousel-1" data-slide="next"></a>
                                </div>
                            </div><hr>
                            <div id="carousel-1" class="carousel slide" data-ride="carousel">
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                	<div class="item active" >
                                    	<div class="row">
											<?php
												$books=$obj->get_rows("`tbl_products`","*","`category`='book'","`id`","12");
												$bcount=$obj->get_count("`tbl_products`","`category`='book'");
												if($bcount>12){$bcount=12;}
                                                if(is_array($books)){$i=0;
                                                    foreach($books as $book){$i++;
                                            ?>
                                            <div class="col-sm-4">
                                                <div class="col-item">
                                                    <div class="photo">
                                                        <a href="productdetails.php?080f6d7f511a9128d45c370f50291f92=<?php echo md5($book['id']); ?>">
                                                        	<img src="<?php echo "admin/".$book['thumbnail'];  ?>" class="img-responsive" alt="<?php echo $book['name']; ?>" />
                                                        </a>
                                                    </div>
                                                    <div class="info">
                                                        <div class="row">
                                                         	<div class="prod-title"><a href="productdetails.php?080f6d7f511a9128d45c370f50291f92=<?php echo md5($book['id']); ?>"><?php echo $book['name']; ?></a></div>
                                                            <div class="price">
																<?php if($book['discount']!=0){ ?>
                                                                <a href="#"><del><i class="fa fa-inr"></i> <?php echo $book['price']; ?></del></a>
                                                                <?php } ?>
                                                                <span><a href="#" class="price-text-color"><i class="fa fa-inr"></i> <?php echo $book['cost']; ?></a></span>
                                                            </div>
                                                        </div>
                                                        <div class="product-btn-sec">
                                                            <form action="addtocart.php" method="post">
                                                                <input type="hidden" name="quantity" value="1">
                                                                <input type="hidden" name="price" value="<?php echo $book['cost']; ?>">
                                                                <input type="hidden" name="product_id" value="<?php echo $book['id']; ?>">
                                                                <input type="hidden" name="product" value="<?php echo $book['name']; ?>">
                                                            	<button type="submit" name="tocart" class="btn btn-sm btn-default"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>
                                                            </form>
                                                            <form action="#" method="post" id="book<?php echo $i; ?>">
                                                                <input type="hidden" name="product_id" value="<?php echo $book['id']; ?>">
                                                                <input type="hidden" name="product" value="<?php echo $book['name']; ?>">
                                                                <input type="hidden" name="towishlist">
                                                            	<button type="button" onClick="checkLogin('book<?php echo $i; ?>');" 
                                                                class="btn btn-sm <?php if(array_search($book['id'],$wishlistids) !==false){echo "btn-warning";}else{echo "btn-default";} ?>">
                                                                <i class="fa fa-heart" aria-hidden="true"></i></button>
                                                            </form>
                                                            <a href="productdetails.php?080f6d7f511a9128d45c370f50291f92=<?php echo md5($book['id']); ?>" class="btn btn-sm btn-default"><i class="fa fa-list"></i> More</a>
                                                        </div>
                                                        <div class="clearfix">
                                                        </div>
                                                    </div><!-- //info -->
                                                </div>
                                            </div>
                                          	<?php
										 				if($i%3==0 && $i!=$bcount){echo "</div></div><div class='item'><div class='row'>";}
													}
												}
											?>
                                        </div>
                                    </div><?php /*
                                    <div class="item">
                                    <!-- row 1-->
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="col-item">
                                                    <div class="photo">
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
                                                        <div class="clearfix">
                                                        </div>
                                                    </div><!-- //info -->
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="col-item">
                                                    <div class="photo">
                                                        <img src="images/copy2.jpg" class="img-responsive" alt="copy2" />
                                                    </div>
                                                    <div class="info">
                                                        <div class="row">
                                                         	<div class="prod-title"><a href="#">Drawing Copy</a></div>
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
                                                        <div class="clearfix">
                                                        </div>
                                                    </div><!-- //info -->
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="col-item">
                                                    <div class="photo">
                                                        <img src="images/copy3.jpg" class="img-responsive" alt="copy3" />
                                                    </div>
                                                    <div class="info">
                                                        <div class="row">
                                                         	<div class="prod-title"><a href="#">Register Copy</a></div>
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
                                                        <div class="clearfix">
                                                        </div>
                                                    </div><!-- //info -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- //row 1-->
                                    </div>
                                    
                                    <!-- ----------------- scroll top row ----------------- -->
                                    <div class="item">
                                    <!-- row 1-->
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="col-item">
                                                    <div class="photo">
                                                        <img src="images/eraser.jpg" class="img-responsive" alt="copy4" />
                                                    </div>
                                                   <div class="info">
                                                        <div class="row">
                                                         	<div class="prod-title"><a href="#">Eraser Set</a></div>
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
                                                        <div class="clearfix">
                                                        </div>
                                                    </div><!-- //info -->
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                               <div class="col-item">
                                                    <div class="photo">
                                                        <img src="images/Pencil-case.jpg" class="img-responsive" alt="copy4" />
                                                    </div>
                                                   <div class="info">
                                                        <div class="row">
                                                         	<div class="prod-title"><a href="#">Pencil Case</a></div>
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
                                                        <div class="clearfix">
                                                        </div>
                                                    </div><!-- //info -->
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="col-item">
                                                    <div class="photo">
                                                        <img src="images/Pens.jpg" class="img-responsive" alt="copy4" />
                                                    </div>
                                                   <div class="info">
                                                        <div class="row">
                                                         	<div class="prod-title"><a href="#">Pens</a></div>
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
                                                        <div class="clearfix">
                                                        </div>
                                                    </div><!-- //info -->
                                                </div>
                                            </div>
                                        </div>
                                    <!-- // row 1-->
                                    
                                    </div>
                                    <!-- ----------------- // scroll first row ----------------- -->
									*/?>
                                </div>
                            </div>
                        </div><!-- // Main row-1 -->
                        <hr>
                        <div class="row">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2>Copies</h2>
                                </div>
                                <div class="copy-pre-next-box">
									<a class="left fa fa-chevron-left btn btn-primary" href="#carousel-2" data-slide="prev"></a>
                                    <a class="dir-right fa fa-chevron-right btn btn-primary" href="#carousel-2" data-slide="next"></a>
                                </div>
                            </div><hr>
                            <div id="carousel-2" class="carousel slide" data-ride="carousel">
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                	<div class="item active" >
                                    	<div class="row">
											<?php
												$copies=$obj->get_rows("`tbl_products`","*","`category`='copy'","`id`","12");
												$ccount=$obj->get_count("`tbl_products`","`category`='copy'");
												if($ccount>12){$ccount=12;}
                                                if(is_array($copies)){$i=0;
                                                    foreach($copies as $copy){$i++;
                                            ?>
                                            <div class="col-sm-4">
                                                <div class="col-item">
                                                    <div class="photo">
                                                        <a href="productdetails.php?080f6d7f511a9128d45c370f50291f92=<?php echo md5($copy['id']); ?>">
                                                        	<img src="<?php echo "admin/".$copy['thumbnail'];  ?>" class="img-responsive" alt="<?php echo $copy['name']; ?>" />
                                                        </a>
                                                    </div>
                                                    <div class="info">
                                                        <div class="row">
                                                         	<div class="prod-title">
                                                                <a href="productdetails.php?080f6d7f511a9128d45c370f50291f92=<?php echo md5($copy['id']); ?>">
                                                                <?php echo $copy['name']; ?></a>
                                                            </div>
                                                            <div class="price">
																<?php if($copy['discount']!=0){ ?>
                                                                <a href="#"><del><i class="fa fa-inr"></i> <?php echo $copy['price']; ?></del></a>
                                                                <?php } ?>
                                                                <span><a href="#" class="price-text-color"><i class="fa fa-inr"></i> <?php echo $copy['cost']; ?></a></span>
                                                            </div>
                                                        </div>
                                                        <div class="product-btn-sec">
                                                            <form action="addtocart.php" method="post">
                                                                <input type="hidden" name="quantity" value="1">
                                                                <input type="hidden" name="price" value="<?php echo $copy['cost']; ?>">
                                                                <input type="hidden" name="product_id" value="<?php echo $copy['id']; ?>">
                                                                <input type="hidden" name="product" value="<?php echo $copy['name']; ?>">
                                                            	<button type="submit" name="tocart" class="btn btn-sm btn-default"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>
                                                            </form>
                                                            <form action="towishlist" method="post" id="copy<?php echo $i; ?>">
                                                                <input type="hidden" name="product_id" value="<?php echo $copy['id']; ?>">
                                                                <input type="hidden" name="product" value="<?php echo $copy['name']; ?>">
                                                                <input type="hidden" name="towishlist">
                                                            	<button type="button" onClick="checkLogin('copy<?php echo $i; ?>');" 
                                                                class="btn btn-sm <?php if(array_search($copy['id'],$wishlistids) !==false){echo "btn-warning";}else{echo "btn-default";} ?>">
                                                                <i class="fa fa-heart" aria-hidden="true"></i></button>
                                                            </form>
                                                            <a href="productdetails.php?080f6d7f511a9128d45c370f50291f92=<?php echo md5($copy['id']); ?>" class="btn btn-sm btn-default"><i class="fa fa-list"></i> More</a>
                                                        </div>
                                                        <div class="clearfix">
                                                        </div>
                                                    </div><!-- //info -->
                                                </div>
                                            </div>
                                          	<?php
										 				if($i%3==0 && $i!=$ccount){echo "</div></div><div class='item'><div class='row'>";}
													}
												}
											?>
                                        </div>
                                    </div>
                                    <?php /*
                                    <div class="item">
                                    <!-- row 1-->
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="col-item">
                                                    <div class="photo">
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
                                                        <div class="clearfix">
                                                        </div>
                                                    </div><!-- //info -->
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="col-item">
                                                    <div class="photo">
                                                        <img src="images/copy2.jpg" class="img-responsive" alt="copy2" />
                                                    </div>
                                                    <div class="info">
                                                        <div class="row">
                                                         	<div class="prod-title"><a href="#">Drawing Copy</a></div>
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
                                                        <div class="clearfix">
                                                        </div>
                                                    </div><!-- //info -->
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="col-item">
                                                    <div class="photo">
                                                        <img src="images/copy3.jpg" class="img-responsive" alt="copy3" />
                                                    </div>
                                                    <div class="info">
                                                        <div class="row">
                                                         	<div class="prod-title"><a href="#">Register Copy</a></div>
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
                                                        <div class="clearfix">
                                                        </div>
                                                    </div><!-- //info -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- //row 1-->
                                    </div>
                                    <!-- ----------------- scroll top row ----------------- -->
                                    <div class="item">
                                    <!-- row 1-->
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="col-item">
                                                    <div class="photo">
                                                        <img src="images/eraser.jpg" class="img-responsive" alt="copy4" />
                                                    </div>
                                                   <div class="info">
                                                        <div class="row">
                                                         	<div class="prod-title"><a href="#">Eraser Set</a></div>
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
                                                        <div class="clearfix">
                                                        </div>
                                                    </div><!-- //info -->
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                               <div class="col-item">
                                                    <div class="photo">
                                                        <img src="images/Pencil-case.jpg" class="img-responsive" alt="copy4" />
                                                    </div>
                                                   <div class="info">
                                                        <div class="row">
                                                         	<div class="prod-title"><a href="#">Pencil Case</a></div>
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
                                                        <div class="clearfix">
                                                        </div>
                                                    </div><!-- //info -->
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="col-item">
                                                    <div class="photo">
                                                        <img src="images/Pens.jpg" class="img-responsive" alt="copy4" />
                                                    </div>
                                                   <div class="info">
                                                        <div class="row">
                                                         	<div class="prod-title"><a href="#">Pens</a></div>
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
                                                        <div class="clearfix">
                                                        </div>
                                                    </div><!-- //info -->
                                                </div>
                                            </div>
                                        </div>
                                    <!-- // row 1-->
                                    
                                    </div>
                                    <!-- ----------------- // scroll first row ----------------- -->
									*/ ?>
                                    
                                </div>
                            </div>
                        </div><!-- // Main row-2 -->
                    </div><!-- // right-products -->
                </div><!-- end of col-md-8 -->
            	<div class="clearfix"></div>
            </div>
        </div><!-- end of container -->
    </section>
    <section class="stationeries">
    	<div class="container">
                        <div class="row">
                            <div class="row">
                            <div class="col-md-12">
                                <h2 class="mob-h2">Stationeries</h2>
                                <div class="pre-next-mob-view">
									<a class="left fa fa-chevron-left btn btn-primary" href="#carousel-3" data-slide="prev"></a>
                                    <a class="pull-right fa fa-chevron-right btn btn-primary" href="#carousel-3" data-slide="next"></a>
                                </div>
                                <div class="stationery-pre-next-box">
									<a class="mob-left fa fa-chevron-left btn btn-primary" href="#carousel-3" data-slide="prev"></a>
                                    <a class="mob-right dir-right fa fa-chevron-right btn btn-primary" href="#carousel-3" data-slide="next"></a>
                                </div>
                            </div>
                            </div><hr>
                            <div id="carousel-3" class="carousel slide" data-ride="carousel">
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner">
                                	<div class="item active">
                                    	<div class="row my-prduct-row">
											<?php
												$stationeries=$obj->get_rows("`tbl_products`","*","`category`='stationery'","`id`","16");
												$scount=$obj->get_count("`tbl_products`","`category`='stationery'");
												if($scount>16){$scount=16;}
                                                if(is_array($stationeries)){$i=0;
                                                    foreach($stationeries as $stationery){$i++;
                                            ?>
                                            <div class="col-sm-3">
                                                <div class="col-item">
                                                    <div class="st-photo">
                                                        <a href="productdetails.php?080f6d7f511a9128d45c370f50291f92=<?php echo md5($stationery['id']); ?>">
                                                        	<img src="<?php echo "admin/".$stationery['thumbnail'];  ?>" class="img-responsive" alt="<?php echo $stationery['name']; ?>" />
                                                        </a>
                                                    </div>
                                                    <div class="info">
                                                        <div class="row">
                                                         	<div class="prod-title"><a href="productdetails.php?080f6d7f511a9128d45c370f50291f92=<?php echo md5($stationery['id']); ?>"><?php echo $stationery['name']; ?></a></div>
                                                            <div class="price">
																<?php if($stationery['discount']!=0){ ?>
                                                                <a href="#"><del><i class="fa fa-inr"></i> <?php echo $stationery['price']; ?></del></a>
                                                                <?php } ?>
                                                                <span><a href="#" class="price-text-color"><i class="fa fa-inr"></i> <?php echo $stationery['cost']; ?></a></span>
                                                            </div>
                                                        </div>
                                                        <div class="product-btn-sec">
                                                            <form action="addtocart.php" method="post">
                                                                <input type="hidden" name="quantity" value="1">
                                                                <input type="hidden" name="price" value="<?php echo $stationery['cost']; ?>">
                                                                <input type="hidden" name="product_id" value="<?php echo $stationery['id']; ?>">
                                                                <input type="hidden" name="product" value="<?php echo $stationery['name']; ?>">
                                                            	<button type="submit" name="tocart" class="btn btn-sm btn-default"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>
                                                            </form>
                                                            <form action="#" method="post" id="stationery<?php echo $i; ?>">
                                                                <input type="hidden" name="product_id" value="<?php echo $stationery['id']; ?>">
                                                                <input type="hidden" name="product" value="<?php echo $stationery['name']; ?>">
                                                                <input type="hidden" name="towishlist">
                                                            	<button type="button" onClick="checkLogin('stationery<?php echo $i; ?>');" 
                                                                class="btn btn-sm <?php if(array_search($stationery['id'],$wishlistids) !==false){echo "btn-warning";}else{echo "btn-default";} ?>">
                                                                <i class="fa fa-heart" aria-hidden="true"></i></button>
                                                            </form>
                                                            <a href="productdetails.php?080f6d7f511a9128d45c370f50291f92=<?php echo md5($stationery['id']); ?>" class="btn btn-sm btn-default"><i class="fa fa-list"></i> More</a>
                                                        </div>
                                                        <div class="clearfix">
                                                        </div>
                                                    </div><!-- //info -->
                                                </div>
                                            </div>
                                        	<?php
										 				if($i%4==0 && $i!=$ccount){echo "</div></div><div class='item'><div class='row'>";}
													}
												}
											?>
                                        </div>
                                    </div>
                                    <?php /*
                                    <div class="item">
                                    <!-- row 1-->
                                        <div class="row my-prduct-row">
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
                                                        <div class="clearfix">
                                                        </div>
                                                    </div><!-- //info -->
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="col-item">
                                                    <div class="st-photo">
                                                        <img src="images/copy2.jpg" class="img-responsive" alt="copy2" />
                                                    </div>
                                                    <div class="info">
                                                        <div class="row">
                                                         	<div class="prod-title"><a href="#">Drawing Copy</a></div>
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
                                                        <div class="clearfix">
                                                        </div>
                                                    </div><!-- //info -->
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="col-item">
                                                    <div class="st-photo">
                                                        <img src="images/copy3.jpg" class="img-responsive" alt="copy3" />
                                                    </div>
                                                    <div class="info">
                                                        <div class="row">
                                                         	<div class="prod-title"><a href="#">Register Copy</a></div>
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
                                                        <div class="clearfix">
                                                        </div>
                                                    </div><!-- //info -->
                                                </div>
                                            </div>
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
                                                        <div class="clearfix">
                                                        </div>
                                                    </div><!-- //info -->
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <!-- //row 1-->
                                    </div>
                                    
                                    <!-- ----------------- scroll top row ----------------- -->
                                    <div class="item">
                                    <!-- row 1-->
                                        <div class="row my-prduct-row">
                                            <div class="col-sm-3">
                                                <div class="col-item">
                                                    <div class="st-photo">
                                                        <img src="images/eraser.jpg" class="img-responsive" alt="copy4" />
                                                    </div>
                                                   <div class="info">
                                                        <div class="row">
                                                         	<div class="prod-title"><a href="#">Eraser Set</a></div>
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
                                                        <div class="clearfix">
                                                        </div>
                                                    </div><!-- //info -->
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                               <div class="col-item">
                                                    <div class="st-photo">
                                                        <img src="images/Pencil-case.jpg" class="img-responsive" alt="copy4" />
                                                    </div>
                                                   <div class="info">
                                                        <div class="row">
                                                         	<div class="prod-title"><a href="#">Pencil Case</a></div>
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
                                                        <div class="clearfix">
                                                        </div>
                                                    </div><!-- //info -->
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="col-item">
                                                    <div class="st-photo">
                                                        <img src="images/Pens.jpg" class="img-responsive" alt="copy4" />
                                                    </div>
                                                   <div class="info">
                                                        <div class="row">
                                                         	<div class="prod-title"><a href="#">Pens</a></div>
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
                                                        <div class="clearfix">
                                                        </div>
                                                    </div><!-- //info -->
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="col-item">
                                                   <div class="st-photo"><img src="images/eraser.jpg" class="img-responsive" alt="copy4" /></div>
                                                   <div class="info">
                                                        <div class="row">
                                                         	<div class="prod-title"><a href="#">Eraser Set</a></div>
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
                                                        <div class="clearfix">
                                                        </div>
                                                    </div><!-- //info -->
                                                </div>
                                            </div>
                                            
                                        </div>
                                    <!-- // row 1-->
                                    
                                    </div>
                                    <!-- ----------------- // scroll first row ----------------- -->
									*/ ?>
                                    
                                </div>
                            </div>
                        </div><!-- // Main row-3 -->

        </div>
    </section>
    <section class="famous-schools">
    	<div class="container">
        	<div class="row">
                <div class="col-md-12">
                    <div class="flogo-box">
                    <h2 class="text-center">Famous Schools</h2>
                        <?php 
                            if(is_array($famous)){
                                foreach($famous as $fschool){
                                    $selfschool=$obj->get_details("`tbl_school`","`name`,`website`","`id`='".$fschool['school_id']."'");
                        ?>
                        <a href="<?php echo $selfschool['website'];?>" target="_blank"><img src="<?php echo "admin/".$fschool['logo']; ?>" alt="<?php echo $selfschool['name'];?>" class="img-responsive"></a>
                        <?php
                                }
                            }
                        ?>
                    </div><!-- // flogo-box -->
                </div>
            </div>
        </div>
    </section>
<?php include 'footer.php'; ?>
	<script language="javascript">
	
		$('#school').bind('keyup', function(e) {
			$('#school_id').val('');
			if(e.keyCode==40 || e.keyCode==38){}
			else if($(this).val()!=''){
				$('#position').val('1');
				$('#select_flag').val('1');
				$('#direction').val('down');
				$.ajax({
					type: "POST",
					url: "ajax_returns.php",
					data:{keyword:$(this).val(),get_schools:'get_schools'},
					beforeSend: function(){
						$("#school").css("background","url('LoaderIcon.gif') right no-repeat rgb(255, 255, 255)");
					},
					success: function(data){
						$("#school-list").show();
						$("#school-list").html(data);
						$("#school").css("background","#FFF");
					}
				});		
			}
			else{
				$("#school-list").html('');
				$('#position').val('1');
				$('#select_flag').val('0');
				$('#direction').val('down');
			}
		});
		$('body').bind('keyup', function(e) {
			var position=$('#position').val();
			var flag=$('#select_flag').val();
			var direction= $('#direction').val();
			var count=$('#count').val();
			if(flag==1 && position>0 ){
				if(e.keyCode==40){
					if(direction=='up'){position++;$('#direction').val('down');}
					var id="#list"+position;
					$('.btns').removeClass("active");
					$(id).focus().addClass("active");
					if(position<count){ position++; }
					$('#position').val(position);
				}
				else if(e.keyCode==38){
					if(count==position){position--; $('#direction').val('up');}
					else if(direction=='down'){position--;position--; $('#direction').val('up');}
					else{position--;}
					if(position==0){$('.btns').removeClass("active"); position++; $('#school').focus(); $('#direction').val('down');}
					else{
						var id="#list"+position;
						$('.btns').removeClass("active");
						$(id).focus().addClass("active");
					}
					if(position<0){position=1;}
					$('#position').val(position);
				}
			}
		});
		
		function selectSchool(id,name){
			$('#school_id').val(id);
			$('#school').val(name);
			$('#position').val('1');
			$('#select_flag').val('0');
			$('#direction').val('down');
			$("#school-list").html('');
			$('#search').focus();
		}
		function checkLogin(str){
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


  
    </script>

  </body>
</html>
