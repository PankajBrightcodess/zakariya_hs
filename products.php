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
    <section class="cart-summary" style="margin-top:135px; padding:20px 0;">
    	<div class="container-fluid">
        	<div class="row">
            	<div class="col-md-2">
                	<div class="panel-group" id="accordion1">
  						<div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion1" href="#collapse1">Shop By</a>
                                </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                	<ul class="list-group" style="height:200px; overflow:auto;">
                                    	<input type="hidden" id="category" value="<?php if(isset($_GET['category']))echo $_GET['category']; ?>">
									<?php
                                        foreach($products as $product){
											$pcount=$obj->get_count("`tbl_products`","`category`='".$product['category']."'");
                                    ?>
  										<li style="padding:7px 15px; <?php if((isset($_GET['category']) && trim($_GET['category'])!='') && $_GET['category']==$product['category'])
												echo 'background-color:#f0f8ff;'; ?>" class="list-group-item" >
										<a href="products.php?category=<?php echo $product['category'] ?>"><?php echo $product['category'] ?> <span class="badge"><?php echo $pcount ?></span></a>
                                        </li>
                                    <?php	
                                        }
                                    ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                   	</div>
                    <?php if(isset($_GET['category']) && $_GET['category']=="Book"){ ?>
                	<div class="panel-group" id="accordion2">
  						<div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion2" href="#collapse2">Category</a>
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse in <?php if(isset($_GET['subcategory'])){echo "in";} ?>">
                                <div class="panel-body">
                                	<div style="height:150px; overflow:auto">
									<?php
										$subcats=$obj->get_rows("`tbl_feature`","distinct(`value`)","`name`='Sub-category' and `product_id` in(SELECT id from `tbl_products` where `category`='Book')");
										if(is_array($subcats)){
											foreach($subcats as $subcategory){
											$subcount=$obj->get_count("`tbl_feature`","`value`='".$subcategory['value']."' and `name`='Sub-category' ");
                                    ?>
                                    
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="subcategory[]" value="<?php echo $subcategory['value'] ?>" <?php if(isset($_GET['subcategory']) && strpos($_GET['subcategory'],$subcategory['value'])!==false )echo "checked"; ?>>
											<?php echo $subcategory['value'] ?> <span class="badge"><?php echo $subcount ?></span></label>
                                        </div>
                                    <?php	
											}
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                   	</div>
                	<div class="panel-group" id="accordion3">
  						<div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion3" href="#collapse3">Class</a>
                                </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse <?php if(isset($_GET['class'])){echo "in";} ?>">
                                <div class="panel-body">
                                	<div style="height:150px; overflow:auto">
									<?php
										$classes=$obj->get_rows("`tbl_feature`","distinct(`value`)","`name`='Class' and `product_id` in(SELECT id from `tbl_products` where `category`='Book')");
										if(is_array($classes)){
                                        	foreach($classes as $class){
											$classcount=$obj->get_count("`tbl_feature`","`value`='".$class['value']."' and `name`='Class' ");
                                    ?>
                                    
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="class[]" value="<?php echo $class['value'] ?>" <?php if(isset($_GET['class']) && strpos($_GET['class'],$class['value'])!==false )echo "checked"; ?>>
											<?php echo $class['value'] ?> <span class="badge"><?php echo $classcount ?></span></label>
                                        </div>
                                    <?php	
											}
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
                	<div class="panel-group" id="accordion4">
  						<div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion4" href="#collapse4">Subject</a>
                                </h4>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse <?php if(isset($_GET['subject'])){echo "in";} ?>">
                                <div class="panel-body">
                                	<div style="height:150px; overflow:auto">
									<?php
										$subjects=$obj->get_rows("`tbl_feature`","distinct(`value`)","`name`='Subject' and `product_id` in(SELECT id from `tbl_products` where `category`='Book')");
										if(is_array($subjects)){
                                        	foreach($subjects as $subject){
											$subjectcount=$obj->get_count("`tbl_feature`","`value`='".$subject['value']."' and `name`='Subject' ");
                                    ?>
                                    
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="subject[]" value="<?php echo $subject['value'] ?>" <?php if(isset($_GET['subject']) && strpos($_GET['subject'],$subject['value'])!==false )echo "checked"; ?>>
											<?php echo $subject['value'] ?> <span class="badge"><?php echo $subjectcount ?></span></label>
                                        </div>
                                    <?php	
											}
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
                	<div class="panel-group" id="accordion5">
  						<div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion5" href="#collapse5">Language</a>
                                </h4>
                            </div>
                            <div id="collapse5" class="panel-collapse collapse <?php if(isset($_GET['language'])){echo "in";} ?>">
                                <div class="panel-body">
                                	<div style="height:150px; overflow:auto">
									<?php
										$languages=$obj->get_rows("`tbl_feature`","distinct(`value`)","`name`='Language' and `product_id` in(SELECT id from `tbl_products` where `category`='Book')");
										if(is_array($languages)){
                                        	foreach($languages as $language){
											$langcount=$obj->get_count("`tbl_feature`","`value`='".$language['value']."' and `name`='Language' ");
                                    ?>
                                    
                                        <div class="checkbox">
                                            <label>
                                            	<input type="checkbox" name="language[]" value="<?php echo $language['value'] ?>" <?php if(isset($_GET['language']) && strpos($_GET['language'],$language['value'])!==false )echo "checked"; ?>>
												<?php echo $language['value'] ?> <span class="badge"><?php echo $langcount; ?></span>
                                            </label>
                                        </div>
                                    <?php	
											}
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
                	<div class="panel-group" id="accordion6">
  						<div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion6" href="#collapse6">Publisher</a>
                                </h4>
                            </div>
                            <div id="collapse6" class="panel-collapse collapse <?php if(isset($_GET['publisher'])){echo "in";} ?>">
                                <div class="panel-body">
                                	<div style="height:150px; overflow:auto">
									<?php
										$publishers=$obj->get_rows("`tbl_feature`","distinct(`value`)","`name`='Publisher' and `product_id` in(SELECT id from `tbl_products` where `category`='Book')");
										if(is_array($publishers)){
                                        	foreach($publishers as $publisher){
											$pubcount=$obj->get_count("`tbl_feature`","`value`='".$publisher['value']."' and `name`='Publisher' ");
                                    ?>
                                    
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="publisher[]" value="<?php echo $publisher['value'] ?>" <?php if(isset($_GET['publisher']) && strpos($_GET['publisher'],$publisher['value'])!==false )echo "checked"; ?>>
											<?php echo $publisher['value'] ?> <span class="badge"><?php echo $pubcount ?></span></label>
                                        </div>
                                    <?php	
											}
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
                	<div class="panel-group" id="accordion7">
  						<div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion7" href="#collapse7">Author</a>
                                </h4>
                            </div>
                            <div id="collapse7" class="panel-collapse collapse <?php if(isset($_GET['author'])){echo "in";} ?>">
                                <div class="panel-body">
                                	<div style="height:150px; overflow:auto">
									<?php
										$authors=$obj->get_rows("`tbl_feature`","distinct(`value`)","`name`='Author' and `product_id` in(SELECT id from `tbl_products` where `category`='Book')");
										if(is_array($authors)){
                                        	foreach($authors as $author){
											$acount=$obj->get_count("`tbl_feature`","`value`='".$author['value']."' and `name`='Author' ");
                                    ?>
                                    
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="author[]" value="<?php echo $author['value'] ?>" <?php if(isset($_GET['author']) && strpos($_GET['author'],$author['value'])!==false )echo "checked"; ?>>
											<?php echo $author['value'] ?> <span class="badge"><?php echo $acount ?></span></label>
                                        </div>
                                    <?php	
											}
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
                	<div class="panel-group" id="accordion8">
  						<div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion8" href="#collapse8">Exam</a>
                                </h4>
                            </div>
                            <div id="collapse8" class="panel-collapse collapse <?php if(isset($_GET['exam'])){echo "in";} ?>">
                                <div class="panel-body">
                                	<div style="height:150px; overflow:auto">
									<?php
										$exams=$obj->get_rows("`tbl_feature`","distinct(`value`)","`name`='Exam' and `product_id` in(SELECT id from `tbl_products` where `category`='Book')");
										if(is_array($exams)){
                                        	foreach($exams as $exam){
											$ecount=$obj->get_count("`tbl_feature`","`value`='".$exam['value']."' and `name`='Exam' ");
                                    ?>
                                    
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="exam[]" value="<?php echo $exam['value'] ?>" <?php if(isset($_GET['exam']) && strpos($_GET['exam'],$exam['value'])!==false )echo "checked"; ?>>
											<?php echo $exam['value'] ?> <span class="badge"><?php echo $ecount ?></span></label>
                                        </div>
                                    <?php	
											}
                                        }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
                    <?php } ?>
                	<div class="panel-group" id="accordion9">
  						<div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion9" href="#collapse9">Discount</a>
                                </h4>
                            </div>
                            <div id="collapse9" class="panel-collapse collapse <?php if(isset($_GET['discount'])){echo "in";} ?>">
                                <div class="panel-body">
                                	<div style="height:150px; overflow:auto">
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="discount[]" value="0 and 10" <?php if(isset($_GET['discount']) && strpos($_GET['discount'],'0 and 10')!==false )echo "checked"; ?>>0-10% <span class="badge"></span></label>
                                       	</div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="discount[]" value="10 and 20" <?php if(isset($_GET['discount']) && strpos($_GET['discount'],'10 and 20')!==false )echo "checked"; ?>>10%-20% <span class="badge"></span></label>
                                       	</div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="discount[]" value="20 and 30" <?php if(isset($_GET['discount']) && strpos($_GET['discount'],'20 and 30')!==false )echo "checked"; ?>>20%-30% <span class="badge"></span></label>
                                       	</div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="discount[]" value="30 and 40" <?php if(isset($_GET['discount']) && strpos($_GET['discount'],'30 and 40')!==false )echo "checked"; ?>>30%-40% <span class="badge"></span></label>
                                       	</div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="discount[]" value="40 and 50" <?php if(isset($_GET['discount']) && strpos($_GET['discount'],'40 and 50')!==false )echo "checked"; ?>>40%-50% <span class="badge"></span></label>
                                       	</div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="discount[]" value="50 and 60" <?php if(isset($_GET['discount']) && strpos($_GET['discount'],'50 and 60')!==false )echo "checked"; ?>>50%-60% <span class="badge"></span></label>
                                       	</div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="discount[]" value="60 and 70" <?php if(isset($_GET['discount']) && strpos($_GET['discount'],'60 and 70')!==false )echo "checked"; ?>>60%-70% <span class="badge"></span></label>
                                       	</div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="discount[]" value="70 and 80" <?php if(isset($_GET['discount']) && strpos($_GET['discount'],'70 and 80')!==false )echo "checked"; ?>>70%-80% <span class="badge"></span></label>
                                       	</div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" name="discount[]" value="80 and 90" <?php if(isset($_GET['discount']) && strpos($_GET['discount'],'80 and 90')!==false )echo "checked"; ?>>80%-90% <span class="badge"></span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
                </div>
                <div class="col-md-10" style="padding-left:5px;" id="result">
                	
        			<?php include('productlist.php'); ?>
                </div>
            </div>
        </div><!-- end of container -->
    </section>
        
<?php include 'footer.php'; ?>
	<script language="javascript">
		
		$(document).ready(function(e) {
            $("input[type='checkbox']").change(function() {
				check();
				//var name=this.name;
			});
        });
		function check(){
			var category=$('#category').val();
			var subcat=new Array(); var classes=new Array(); var subjects=new Array();
			var lang=new Array(); var publishers=new Array(); var authors=new Array();
			var exams=new Array(); var disc=new Array();
			$("input:checkbox[name='subcategory[]']:checked").each(function() {
		  		subcat.push($(this).val());
			});	
			$("input:checkbox[name='class[]']:checked").each(function() {
		  		classes.push($(this).val());
			});	
			$("input:checkbox[name='subject[]']:checked").each(function() {
		  		subjects.push($(this).val());
			});	
			$("input:checkbox[name='language[]']:checked").each(function() {
		  		lang.push($(this).val());
			});	
			$("input:checkbox[name='publisher[]']:checked").each(function() {
		  		publishers.push($(this).val());
			});	
			$("input:checkbox[name='author[]']:checked").each(function() {
		  		authors.push($(this).val());
			});	
			$("input:checkbox[name='exam[]']:checked").each(function() {
		  		exams.push($(this).val());
			});	
			$("input:checkbox[name='discount[]']:checked").each(function() {
		  		disc.push($(this).val());
			});	
			var subcategory="'"+subcat.join("','")+"'"; var classs="'"+classes.join("','")+"'"; var subject="'"+subjects.join("','")+"'";
			var language="'"+lang.join("','")+"'"; var publisher="'"+publishers.join("','")+"'"; var author="'"+authors.join("','")+"'";
			var exam="'"+exams.join("','")+"'"; var discount=disc.join(","); 
			$.ajax({
				type:"GET",
				url:"productlist.php",
				data:{
					category:category,subcategory:subcategory,class:classs,subject:subject,
					language:language,publisher:publisher,author:author,
					exam:exam,discount:discount,getFilters:'getFilters'
				},
				success: function(data){
					$('#result').html(data);
				}	
			});
		}
		function getFilter(){
			var category=$('#category').val();
			var sorting=$('#sort').val();
			if(category=='Book'){
				var publisher=$('#publisher').val();
			}else{var publisher='';}
			$.ajax({
				type:"GET",
				url:"productlist.php",
				data:{category:category,order:sorting,publisher:publisher,getFilters:'getFilters'},
				success: function(data){
					$('#result').html(data);
				}	
			});
			//window.location="products.php?category="+category+"&order="+sorting;
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
