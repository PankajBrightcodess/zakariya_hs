<?php
	$count=24;
	$offset=0;
	if(isset($_GET['page']) && trim($_GET['page'])!=''){$page=$_GET['page'];}
	else{$page=1;}
	$offset=($page-1)*$count;
	$table="`tbl_products`";
	$category="";
	$pagefilters="";
	if(isset($_GET['getFilters']) && $_GET['getFilters']=='getFilters'){
		include('admin/class/config.php');
		$obj=Database::getInstance();
		$wishlistids=array();
		if(isset($_SESSION['user_id'])){
			$selwishlistid=$obj->get_rows("`tbl_wishlist`","`product_id`",$where);
			foreach($selwishlistid as $wishlistid){
				if($wishlistid['product_id']!=0)
					$wishlistids[]=$wishlistid['product_id'];
			}
		}	
	}
	if(isset($_GET['category']) && trim($_GET['category'])!=''){ 
		$category=$_GET['category']; $where2="`category`='$category'";
		$pagefilters.="&category=".$category;
	}
	else{ $where2=""; }
	if(isset($_GET['subcategory']) && trim($_GET['subcategory'])!="''"){
		$where2.="and `id` in(SELECT product_id from `tbl_feature` where `name`='Sub-category' and `value` in (".$_GET['subcategory']."))";
		$pagefilters.="&subcategory=".$_GET['subcategory'];
	}
	if(isset($_GET['class']) && trim($_GET['class'])!="''"){
		$where2.="and `id` in(SELECT product_id from `tbl_feature` where `name`='Class' and `value` in (".$_GET['class']."))";
		$pagefilters.="&class=".$_GET['class'];
	}
	if(isset($_GET['subject']) && trim($_GET['subject'])!="''"){
		$where2.="and `id` in(SELECT product_id from `tbl_feature` where `name`='Subject' and `value` in (".$_GET['subject']."))";
		$pagefilters.="&subject=".$_GET['subject'];
	}
	if(isset($_GET['language']) && trim($_GET['language'])!="''"){
		$where2.="and `id` in(SELECT product_id from `tbl_feature` where `name`='Language' and `value` in (".$_GET['language']."))";
		$pagefilters.="&language=".$_GET['language'];
	}
	if(isset($_GET['publisher']) && trim($_GET['publisher'])!="''"){
		$where2.="and `id` in(SELECT product_id from `tbl_feature` where `name`='Publisher' and `value`  in (".$_GET['publisher']."))";
		$pagefilters.="&publisher=".$_GET['publisher'];
	}
	if(isset($_GET['author']) && trim($_GET['author'])!="''"){
		$where2.="and `id` in(SELECT product_id from `tbl_feature` where `name`='Author' and `value` in (".$_GET['author']."))";
		$pagefilters.="&author=".$_GET['author'];
	}
	if(isset($_GET['exam']) && trim($_GET['exam'])!="''"){
		$where2.="and `id` in(SELECT product_id from `tbl_feature` where `name`='Exam' and `value` in (".$_GET['exam']."))";
		$pagefilters.="&exam=".$_GET['exam'];
	}
	if(isset($_GET['discount']) && trim($_GET['discount'])!=""){
		$disc=explode(',',$_GET['discount']);
		$discount="";
		foreach($disc as $val){
			$discount.=" (discount between ".$val.") or";
		}
		$discount=rtrim($discount,"or");
		if($where2!=''){$where2.=" and ";}
		$where2.=" ($discount)";
		$pagefilters.="&discount=".$_GET['discount'];
	}
	if(isset($_GET['order']) && trim($_GET['order'])!=''){ 
		$sort=$_GET['order'];
		if($sort=='high'){
			$order="cost desc";
		}elseif($sort=='low'){
			$order="cost asc";
		}
		$pagefilters.="&order=".$_GET['order'];
	}
	else{ $order="id desc"; }
	//echo $where2;
	$limit=" $offset,$count";
	$array=$obj->get_rows($table,"*",$where2,$order,$limit);
	$rowcount=$obj->get_count($table,$where2);
	$pages=ceil($rowcount/$count);
	
?>			

            	<legend><?php if(isset($_GET['category']) && trim($_GET['category'])!=''){echo $category;}else{echo "Products";} ?></legend>
                <div class="row">
                	<div class="col-md-12">
                		<?php 
							if(isset($_GET['subcategory']) && trim($_GET['subcategory'])!="''"){echo str_replace("'","",$_GET['subcategory'])." ";} 
							if(isset($_GET['class']) && trim($_GET['class'])!="''"){echo str_replace("'","",$_GET['class'])." ";} 
							if(isset($_GET['subject']) && trim($_GET['subject'])!="''"){echo str_replace("'","",$_GET['subject'])." ";} 
							if(isset($_GET['language']) && trim($_GET['language'])!="''"){echo str_replace("'","",$_GET['language'])." ";} 
							if(isset($_GET['publisher']) && trim($_GET['publisher'])!="''"){echo str_replace("'","",$_GET['publisher'])." ";} 
							if(isset($_GET['author']) && trim($_GET['author'])!="''"){echo str_replace("'","",$_GET['author'])." ";} 
							if(isset($_GET['exam']) && trim($_GET['exam'])!="''"){echo str_replace("'","",$_GET['exam'])." ";} 
							if(isset($_GET['discount']) && trim($_GET['discount'])!="''"){ 
								$d=str_replace("'","",$_GET['discount']);
								
							
							} 
						?>
                    </div>
                </div>
                <div class="row my-prduct-row">
                   	<?php
                        if(is_array($array)){$i=0;
                            foreach($array as $product){$i++;
                    ?>
					 <div class="col-sm-3" style="margin:15px  0;">
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
                                    <form action="#" method="post" id="book<?php echo $i; ?>">
                                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                        <input type="hidden" name="product" value="<?php echo $product['name']; ?>">
                                        <input type="hidden" name="towishlist">
                                        <button type="button" onClick="checkLogin('book<?php echo $i; ?>');" 
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
								if($i!=0 && $i%4==0){echo "</div><div class='row my-prduct-row'>";}
							}
						}
						else{
							echo "<div class='col-xs-12 text-center text-danger'><font size='+1'>No Products Found! Return to <a href='index.php'>Homepage.</a></font></div>";
						}
					?>
				</div>
                <div class="row text-center">
					<?php
						if($pages>1){
							if($page!=1){
					?>	
							<ul class="pagination pagination-sm">
								<li>
                                	<a href="products.php?page=<?php echo $page-1;echo $pagefilters;
										if(isset($_GET['order']) && trim($_GET['order'])!=''){ echo "&order=".$_GET['order'] ;}
									?>" >Prev</a>
                               	</li>
							</ul>
					<?php
							}
							for($i=1;$i<=$pages;$i++){
								if($i<3 || $i>$pages-2 || $i==$page || $i==$page-1 || $i==$page+1 || $i==$page-1 || $i==$page+1){
					?>	
							<ul class="pagination pagination-sm">
								<li <?php if($i==$page){echo "class='active'";} ?>>
                                	<a href="products.php?<?php echo "page=".$i;echo $pagefilters;
										if(isset($_GET['order']) && trim($_GET['order'])!=''){ echo "&order=".$_GET['order'] ;}
									?>" ><?php echo $i; ?></a>
								</li>
							</ul>
					<?php		
								}
								elseif($pages>3 && ($i==3 || $i==$pages-2)){
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
								<li>
                                	<a href="products.php?page=<?php echo $page+1;echo $pagefilters;
										if(isset($_GET['order']) && trim($_GET['order'])!=''){ echo "&order=". $_GET['order'] ;}
									?>" >Next</a>
                                </li>
							</ul>
					<?php
							}
					?>
					<?php
						}
					?>
                </div>