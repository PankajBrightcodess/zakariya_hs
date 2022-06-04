<?php
session_start();
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
	include('admin/class/config.php');
	$obj=Database::getInstance();
	if(isset($_GET['placeorder']) || isset($_GET['editorder']) ){
		$class_id=$_GET['class_id'];
		$school_id=$_GET['school_id'];
		$book_total=$_GET['book_total'];
		$copy_total=$_GET['copy_total'];
		$stationery_total=$_GET['stationery_total'];
		$array=$obj->get_details("`tbl_school` t1, `tbl_images` t2","*","t1.`id`='$school_id' and t1.`id`=t2.`school_id`");	
		$book_count=$obj->get_count("`tbl_books`","`school_id`='$school_id' and `class_id`='$class_id'");
		$copies=$obj->get_details("`tbl_copy`","sum(`quantity`) as `count`","`school_id`='$school_id' and `class_id`='$class_id'");
		$copy_count=$copies['count'];
		$stationery_count=$obj->get_count("`tbl_stationary`","`school_id`='$school_id' and `class_id`='$class_id'");
		$total=$book_total+$copy_total+$stationery_total;
	}
	else{
		header("location:index.php");	
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
    <section class="order-summary" style="margin-top:135px;">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-12" style="padding:10px;">
                	<form action="addtocart.php" method="post" id="placeorder">
                        <legend>Order Summary</legend>
                        <span>Note : If you don't want to buy Copies or Stationery remove it from the list below.</span>
                        <div class="row" style="font-size:16px;">
                        	<input type="hidden" name="book_total" id="book_total" value="<?php echo $book_total; ?>" />
                        	<input type="hidden" name="copy_total" id="copy_total" value="<?php echo $copy_total; ?>" />
                        	<input type="hidden" name="stationery_total" id="stationery_total" value="<?php echo $stationery_total; ?>" />
                            <input type="hidden" name="school_id" value="<?php echo $school_id; ?>" />
                            <input type="hidden" name="class_id" value="<?php echo $class_id; ?>" />
                            <input type="hidden" name="id" value="<?php if(isset($_GET['id'])){echo $_GET['id'];}else{echo "0";} ?>" />
                            <div class="col-md-3">
                            	A. 
                                <div class="checkbox">
                              		<label>
                                        <input type="hidden" class="order" name="order[]" value="book" >
                                        <font size="+1">Books<br>
                                            Total No. of Books : <?php echo $book_count; ?><br>
                                            Sub Total Cost : <?php echo toDecimal($book_total); ?>
                                        </font>
                                    </label>
                            	</div>
                            </div>
                           	<?php if($copy_count!=0){ ?>
                            <div class="col-md-1"><font size="+6">+</font></div>
                            <div class="col-md-3">
                                B. 
                                <div class="checkbox">
                              		<label>
                                        <input type="checkbox" class="order" name="order[]" value="copy" checked>
                                        <font size="+1">Copies<br>
                                            Total No. of Copies : <?php echo $copy_count; ?><br>
                                            Sub Total Cost : <?php echo toDecimal($copy_total); ?>
                                        </font>
                                    </label>
                            	</div>
                            </div>
                           	<?php }if($stationery_count!=0){ ?>
                            <div class="col-md-1"><font size="+6">+</font></div>
                            <div class="col-md-3">
                            	C. 
                                <div class="checkbox">
                              		<label>
                                        <input type="checkbox" class="order" name="order[]" value="stationery" checked	>
                                        <font size="+1">Stationery<br>
                                            Total No. of Stationery : <?php echo $stationery_count; ?><br>
                                            Sub Total Cost : <?php echo toDecimal($stationery_total); ?>
                                        </font>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <br>
                        <div class="row">
                        	<div class="col-md-6 pull-right" style="margin:5px 0;">
                            	<div class="col-xs-7"><font size="+2">Payable Amount  </font></div>
                            	<div class="col-xs-5"><input type="text" name="total" id="total" class="form-control"  value="<?php echo $total; ?>" readonly></div>
                            </div>
                        	<div class="col-md-6" style="margin:5px 0;">
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
                        	<div class="col-md-3 pull-left">
                            	<a href="searchresult.php?<?php echo "class=".$class_id."&school_id=".$school_id;?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Review List</a>
                            </div>
                        	<div class="col-md-3 pull-right">
                            	<input type="hidden" name="buypackage" id="buypackage">
                            	<input type="hidden" name="addtocart" id="addtocart">
                            	<button type="submit" name="addtocart" value="addtocart" class="btn btn-success" >Add to Cart <i class="fa fa-cart-plus"></i></button>
                            	<button type="button" class="btn btn-danger" onClick="checkLogin('buypackage')">Buy Now </button>
                            </div>
                        </div>
					</form>
                </div>
            </div>
        </div><!-- end of container -->
    </section>
<?php include 'footer.php'; ?>
	<script language="javascript">
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
		
		function checkLogin(str){
			$.ajax({
				type:"POST",
				url:"checkout.php",
				data:{page:"address"}	,
				success: function(data){
					if(str=='addtocart'){
						$('#addtocart').val('addtocart');
						$('#link').val('cart.php');
					}
					else{
						$('#buypackage').val('buypackage');
						$('#link').val('selectaddress.php');
					}
					$.ajax({
					   type: "POST",
					   url: "addtocart.php",
					   data: $("#placeorder").serialize(), // serializes the form's elements.
					   success: function(data)
					   {
							$('#buypackage').val('');
							$('#addtocart').val('');
					   }
					});
					if(data==0){
						$('#myModal').modal('show');
					}else{
						if(str=='addtocart'){window.location="cart.php";	}
						else{window.location="selectaddress.php";	}
						
					}
				}
			});
		}
    </script>

  </body>
</html>
