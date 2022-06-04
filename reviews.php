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
            	<div class="col-md-12">
            		<legend style="font-size:18px;">Reviews</legend>
					<?php 
                        $reviews=$obj->get_rows("`tbl_review` t1,`tbl_member` t2","t1.*,t2.`name`","t1.`product_id`='$id' and t1.`user_id`=t2.`id`","`added_on` desc");	
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
                        }else{
                            echo "No Reviews";	
                        }
                    ?>
                </div>
            </div><!-- end of main-row -->
        </div><!-- end of container -->
    </section>
        
<?php include 'footer.php'; ?>
	<script language="javascript">
    </script>

  </body>
</html>
