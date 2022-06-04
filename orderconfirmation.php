<?php
session_start();
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
	$array=$obj->get_rows("`tbl_cart`","*",$where);
	$address=$obj->get_details("`tbl_tempadd`","*",$where);
	if(!is_array($array)){
		header("Location:cart.php");
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
    <!-- ---------- font ---------------------- -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700|Roboto:400,500,700" rel="stylesheet">
    <!-- ---------- font awesome ---------------------- -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
  </head>
  <body>
  <?php include 'header-nav.php'; ?>
    <section class="cart-summary" style="margin-top:135px; padding:50px 0">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-12">
                	<legend><h3>Confirm Order</h3></legend>
                    <div class="table-responsive">
                    	<h4>Order Details</h4>
                    	<table class="table table-bordered table-condensed table-hover">
                        	<thead>
                            	<th style="text-align:center;" width="10%">Sl No</th>
                            	<th style="text-align:center;">Product</th>
                            	<th style="text-align:center;">Price</th>
                            	<th style="text-align:center;">Quantity</th>
                            	<th style="text-align:center;">Amount</th>
                            </thead>
                            <?php
								$total=0;
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
										else{ echo $product['product']; }
									?>
                                </td>
                            	<td align="center"><?php echo toDecimal($product['price']); ?></td>
                            	<td align="center">
									<?php echo $product['quantity']; ?>
                                </td>
                            	<td align="center"><?php echo toDecimal($product['amount']); ?></td>
                            </tr>
                            <?php
										$total+=$product['amount'];
									}
								}
								$total=round($total);
							?>
                            <tr height="40" style="font-size:18px; background-color:#eee">
                            	<th style="text-align:right; padding-right:20px;" colspan="4">Total Amount</th>
                            	<td align="center"><?php echo toDecimal($total); ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="row">
                        <div class="table-responsive col-md-6">
                        	<h4>Address Details</h4>
                            <table class="table">
                                <tr>
                                    <th>Name</th>
                                    <td><?php echo $address['name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Student's Name</th>
                                    <td><?php echo $address['student_name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Mobile</th>
                                    <td><?php echo $address['mobile']; ?></td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td><?php echo $address['address']; ?></td>
                                </tr>
                                <tr>
                                    <th>Landmark</th>
                                    <td><?php echo $address['landmark']; ?></td>
                                </tr>
                                <tr>
                                    <th>Pincode</th>
                                    <td><?php echo $address['pincode']; ?></td>
                                </tr>
                                <tr>
                                    <th>Post Office</th>
                                    <td><?php echo $address['postoffice']; ?></td>
                                </tr>
                                <tr>
                                    <th>District</th>
                                    <td><?php echo $address['district']; ?></td>
                                </tr>
                                <tr>
                                    <th>State</th>
                                    <td><?php echo $address['state']; ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                        	<h4 style="border-bottom:1px solid #ddd; padding-bottom:10px;">Payment Details</h4>
                            <form method="post" action="submitorder.php">
                                <table class="table" style="font-size:18px;">
                                    <tr>
                                        <th width="40%">Total Amount</th>
                                        <td><input type="text" name="total_amount" value="<?php echo $total; ?>" class="form-control" readonly /></td>
                                    </tr>
                                    <tr>
                                    	<th>Payment Mode</th>
                                        <td>
                                        	<label class="radio-inline"><input type="radio" name="payment" value="cod" required>Cash On Delivery</label>
                                        </td>
                                    </tr>
                                    <tr>
                                    	<td colspan="2">
                                        	<a href="cart.php" class="btn btn-danger btn-sm">Edit Order</a>
                                        	<a href="selectaddress.php" class="btn btn-danger btn-sm">Edit Address</a>
                                            <input type="hidden" name="name" value="<?php echo $address['name']; ?>">
                                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                            <input type="submit" name="submitOrder" value="Submit Order" class="btn btn-success btn-sm">
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
<?php include 'footer.php'; ?>
	<script language="javascript">
		$(document).ready(function() {
			
		});
		
    </script>

  </body>
</html>
