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

    <title>BMS | Edit Footer</title>

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
include "class/footer.php";
$obj=new Footer();
$id=$_GET['id'];
$footer=$_GET['footer'];
$data=$obj->get_footer_by_id($id);
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
					<h3 class="page-header"><i class="fa fa-files-o"></i> Edit Footer</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="icon_document_alt"></i>Footer</li>
						<li><i class="fa fa-files-o"></i>Edit Footer</li>
					</ol>
				</div>
			</div>
              <!-- Form validations -->              
           
              <div class="row">
              
    
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            Edit Footer
                          </header>
                          <div class="panel-body">
                              <div class="form">
                                  <form class="form-validate form-horizontal " id="" method="post" action="update_footer_data.php">
                                      
                                      <div class="form-group ">
                                           <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                                          <label for="Title" class="control-label col-lg-2">Title <span class="required">*</span></label>
                                          <div class="col-lg-3">
                                              <input class=" form-control" id="title" name="title" type="text" value="<?php echo $data['title'] ?>" readonly/>
                                          </div>
                                      </div>
                                       <div class="form-group ">
                                         <label for="Content" class="control-label col-lg-2">Content</label>
                                          <div class="col-lg-3">
                                           <textarea name="value" id="value" class="form-control" style="resize:vertical;"><?php echo $data['value'] ?></textarea>  
                                          </div>
                                      </div>
                                  
                                       <div class="form-group ">
                                        <label for="Active" class="control-label col-lg-2 col-sm-3">Active</label>
                                          <div class="col-lg-1 col-sm-5">
                                              <input  type="radio" style="width: 20px" class="checkbox form-control" id="published" name="published" value="1" <?php if($data['published']=='1'){?> checked="checked" <?php } ?>/>
                                          </div>
                                          <label for="Inactive" class="control-label col-lg-2 col-sm-3">Inactive</label>
                                          <div class="col-lg-1 col-sm-5">
                                             <input  type="radio" style="width: 20px" class="checkbox form-control" id="published" name="published" value="0" <?php if($data['published']=='0'){?> checked="checked" <?php } ?> />
                                          </div>
                                      </div>
                                    
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <input type="hidden" name="footer" id="footer" value="<?php echo $footer ?>">
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
setTimeout(function(){$("#remove_msg").hide();},5000);
</script>

<script>
function cancel(data)
{
	var val=data;
	if(val=='cancel')
	{
		var footer=$('#footer').val();
		//alert(footer)
		if(footer==1)
		{
		window.location='footer1.php';
		}else if(footer==2){
			window.location='footer2.php';
		}else if(footer==3){
			window.location='footer3.php';
		}else if(footer==4){
			window.location='footer4.php';
		}
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
