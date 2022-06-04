<?php 
session_start();
if(isset($_SESSION['role']))
{
	$role=$_SESSION['role'];
}
else{
	header('location:index.php');
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
    <meta name="author" content="GeeksLabs">
    <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>BMS | View Order</title>

    <!-- Bootstrap CSS -->    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap theme -->
    <link href="css/bootstrap-theme.css" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="css/elegant-icons-style.css" rel="stylesheet" />
    <link href="css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

   
  </head>

  <body>
  <!-- container section start -->
  <section id="container" class="">
      <!--header start-->
      <?php include "header.php"; ?>      
      <!--header end-->

      <!--sidebar start-->
      <?php include "sidebar.php"; ?>
      <!--sidebar end-->

      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
		  <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-files-o"></i>Order Detail</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="icon_document_alt"></i>Order</li>
						<li><i class="fa fa-files-o"></i>Order Detail</li>
					</ol>
				</div>
			</div>
              <!-- Form validations -->              
           
              <div class="row">
                  <div class="col-lg-12">
                     <legend><h3>Order Details</h3></legend>
<div class="table-responsive">
    <table class="table table-bordered table-condensed table-hover">
        <thead>
            <th style="text-align:center;" width="10%">Sl. No.</th>
            <th style="text-align:center;">Product</th>
            <th style="text-align:center;">Price</th>
            <th style="text-align:center;">Quantity</th>
            <th style="text-align:center;">Amount</th>
        </thead>
       
      <?php
			include('class/config.php');
			$obj=Database::getInstance();
			$id=$_GET['id'];
			$where="`order_id`='$id'";
			$update=$obj->update("`tbl_orders`","`view`='1'","`id`='$id'");
            $array=$obj->get_rows("`tbl_orderlist`","*",$where);
            if(is_array($array)){$i=0;
                foreach($array as $product){$i++;
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
            <td align="center"><?php echo toDecimal($product['price']); ?></td>
            <td align="center">
                <?php echo $product['quantity']; ?>
            </td>
            <td align="center"><?php echo toDecimal($product['amount']); ?></td>
        </tr>
        <?php
                }
            }
        ?>
       
    </table>
    <button type="button" onClick="closeThis('cancel');" class="btn btn-danger btn-sm pull-right">Close</button>
</div>
                  </div>
              </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
      <?php include "footer.php"; ?>
  </section>
  <!-- container section end -->
<script>
setTimeout(function(){$("#remove_msg").hide();},1500);
</script>

<script>
function closeThis(data)
{
	var val=data;
	if(val=='cancel')
	{
		window.location='order_list.php';
	}
}
</script>
    <!-- javascripts -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
    <!-- jquery validate js -->
   <!-- <script type="text/javascript" src="js/jquery.validate.min.js"></script>-->

    <!-- custom form validation script for this page-->
   <!-- <script src="js/form-validation-script.js"></script>-->
    <!--custome script for all page-->
    <script src="js/scripts.js"></script>    


  </body>
</html>
