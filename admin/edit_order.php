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

    <title>BMS | Edit Order</title>

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

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
    <![endif]-->
  </head>
<?php 
include "class/order.php";
$obj=new Order();
$id=$_GET['id'];
$data=$obj->get_order_by_id($id);
//print_r($data);
?>
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
					<h3 class="page-header"><i class="fa fa-files-o"></i> Edit Order</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="icon_document_alt"></i>Order</li>
						<li><i class="fa fa-files-o"></i>Edit Order</li>
					</ol>
				</div>
			</div>
              <!-- Form validations -->              
           
              <div class="row">
              
    
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            Edit Order
                          </header>
                          <div class="panel-body">
                              <div class="form">
                                  <form class="form-validate form-horizontal " id="" method="post" action="update_order_data.php">
                                      
                                      <div class="form-group ">
                                           <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                                           <input type="hidden" name="user_id" id="user_id" value="<?php echo $data['user_id']; ?>">
                                           <input type="hidden" name="mobile" id="mobile" value="<?php echo $data['mobile']; ?>">
                                           <input type="hidden" name="name" id="name" value="<?php echo $data['name']; ?>">
                                           <input type="hidden" name="total_amount" id="total_amount" value="<?php echo $data['total_amount']; ?>">
                                          <label for="Status" class="control-label col-lg-2">Status <span class="required">*</span></label>
                                          <div class="col-lg-3">
                                              <select name="status" id="status" class="form-control" onChange="OpenToEnterDate(this.value);" required>
                                                <?php if($data['status']=='0'){ ?>
                                                <option value="" <?php if($data['status']=='0'){ ?> selected <?php } ?>>Order Placed</option>  
                                                <option value="1" <?php if($data['status']=='1'){ ?> selected <?php } ?>>Order Dispatch</option>
                                                <option value="2" <?php if($data['status']=='2'){ ?> selected <?php } ?>>Order Delivered</option>
                                                <option value="3" <?php if($data['status']=='3'){ ?> selected <?php } ?>>Order Cancelled</option>
                                                <?php } ?>
                                                <?php if($data['status']=='1'){ ?> 
                                                <option value="" <?php if($data['status']=='1'){ ?> selected <?php } ?>>Order Dispatch</option> 
                                                <option value="2" <?php if($data['status']=='2'){ ?> selected <?php } ?>>Order Delivered</option>
                                                <option value="3" <?php if($data['status']=='3'){ ?> selected <?php } ?>>Order Cancelled</option>
                                                <?php } ?>
                                                 <?php if($data['status']=='2'){ ?>
                                                 <option value="" <?php if($data['status']=='2'){ ?> selected <?php } ?>>Order Delivered</option>  
                                                  <option value="3" <?php if($data['status']=='3'){ ?> selected <?php } ?>>Order Cancelled</option>
                                                <?php } ?>
                                                <?php if($data['status']=='3'){ ?>
                                                  <option value="" <?php if($data['status']=='3'){ ?> selected <?php } ?>>Order Cancelled</option>
                                                <?php } ?>
                                              </select>
                                          </div>
                                      </div>
                                      <div id="OrderDispatch" style="display:none;">
                                      <div class="form-group ">
                                          <label for="Dispatch" class="control-label col-lg-2">Dispatch</label>
                                          <div class="col-lg-2">
                                             <input type="date" name="dispatch" id="dispatch" class="form-control" value="">
                                          </div>
                                      </div>
                                       <div class="form-group ">
                                          <label for="Delivery Date" class="control-label col-lg-2">Delivery Date(Exp)</label>
                                          <div class="col-lg-2">
                                              <input type="date" name="delivery" id="delivery" class="form-control">
                                          </div>
                                      </div><br>
                                     </div>
                                      <div id="OrderDelivered" style="display:none;">
                                      <div class="form-group ">
                                          <label for="Dispatch" class="control-label col-lg-2">Delivered Date</label>
                                          <div class="col-lg-2">
                                             <input type="date" name="delivered" id="delivered" class="form-control" value="<?php echo $data['delivered_date'] ?>">
                                          </div>
                                      </div><br>
                                     </div>
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="btn btn-primary" type="submit" name="submit">Update</button>
                                              <button class="btn btn-default" type="button" onClick="cancel('cancel')">Cancel</button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </section>
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
function cancel(data)
{
	var val=data;
	if(val=='cancel')
	{
		window.location='order_list.php';
	}
}

function OpenToEnterDate(data){
	
	var val=data;
	if(val==1){
		$("#OrderDispatch").show();
		$("#OrderDelivered").hide();
	}
	if(val==2){
		$("#OrderDelivered").show();
		$("#OrderDispatch").hide();
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
