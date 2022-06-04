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
	$count=20;
	$offset=0;
	if(isset($_GET['page']) && trim($_GET['page'])!=''){$page=$_GET['page'];}
	else{$page=1;}
	$offset=($page-1)*$count;
	$table="`tbl_feature`";
	$where2="`name`='PUBLISHER' and `product_id` in(SELECT id from `tbl_products` where `category`='Book')";
	$publishers=$obj->get_rows($table,"distinct(`value`)",$where2,"`value`","$offset,$count");
	$details=$obj->get_details($table,"count(distinct(`value`)) as count",$where2);
	$rowcount=$details['count'];
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
    <link href="my-css/product-scroll.css" rel="stylesheet">
    <!-- ---------- font ---------------------- -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700|Roboto:400,500,700" rel="stylesheet">
    <!-- ---------- font awesome ---------------------- -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="admin/plugins/select2/select2.min.css">
  </head>
  <body>
  <?php include 'header-nav.php'; ?>
    <section class="cart-summary" style="margin-top:135px; padding:20px 0;">
    	<div class="container">
        	<div class="row">
                <div class="col-md-12">
            	<legend>Publications</legend>
                    <div class="row">
                        <div class="col-sm-4" style="padding:5px 20px;">                	
                            <?php
                                if(is_array($publishers)){$i=$offset;$x=0;
                                    foreach($publishers as $publisher){$i++;$x++;
                            ?>
                            <?php echo $i."."; ?>
                            <a href="products.php?category=Book&publisher=<?php echo $publisher['value']; ?>"><?php echo $publisher['value']; ?></a><br>
                            <?php
                                        if($i%30==0 && $i%90==0 && $x!=59){echo "</div></div><br><div class='row'><div class='col-sm-4'>";}
                                        elseif($i%30==0 && $i%90!=0 &&  $x!=59){echo "</div><div class='col-sm-4'>";}
                                    }
                                }
                            ?>
                        </div>
                    </div>
                    <?php
					if($pages>1){
							echo "<div class='text-center'>";
							if($page!=1){
					?>	
							<ul class="pagination pagination-sm">
								<li>
									<a href="publications.php?page=<?php echo $page-1;?>" >Prev</a>
								</li>
							</ul>
					<?php
							}
							for($i=1;$i<=$pages;$i++){
								if($i<3 || $i>$pages-2 || $i==$page || $i==$page-1 || $i==$page+1 || $i==$page-1 || $i==$page+1){
					?>	
							<ul class="pagination pagination-sm">
								<li <?php if($i==$page){echo "class='active'";} ?>>
									<a href="publications.php?<?php echo "page=".$i;?>" ><?php echo $i; ?></a>
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
									<a href="publications.php?page=<?php echo $page+1;?>" >Next</a>
								</li>
							</ul>
					<?php
							}
						echo "</div>";
					
						}
					?>
               	</div>
            </div>
        </div><!-- end of container -->
    </section>
        
<?php include 'footer.php'; ?>
 <script src="admin/plugins/select2/select2.full.min.js"></script>
	<script language="javascript">
		
    </script>

  </body>
</html>
