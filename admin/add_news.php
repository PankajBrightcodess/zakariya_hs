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

    <title>BMS | Add News</title>

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
					<h3 class="page-header"><i class="fa fa-files-o"></i> Add News</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="icon_document_alt"></i>News</li>
						<li><i class="fa fa-files-o"></i>Add News</li>
					</ol>
				</div>
			</div>
              <!-- Form validations -->              
           
              <div class="row">
      <div class="col-md-12">
      <div class="row" style="height: 20px;" id="remove_msg">
						<?php if(isset($_SESSION['success'])){
                            ?>
                          <div class="col-md-12 text-center text-success">
                               <i class="fa fa-check "></i><?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
                               
                            </div>
                            <?php
                          }
                          else if(isset($_SESSION['err'])){
                              ?>
                                 <div class="col-md-12 text-danger text-center">
                                     <i class="fa fa-times"></i><?php echo $_SESSION['err']; unset($_SESSION['err']); ?>
                                    
                                  </div>
                              <?php 
                          }
                        ?>
      
    	</div><!-- end of row for message--> 
        </div><!-- end of row for message -->
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            Add News
                          </header>
                          <div class="panel-body">
                              <div class="form">
                                  <form class="form-validate form-horizontal " id="" method="post" action="add_news_data.php">
                                       <div class="form-group ">
                                          <label for="Date" class="control-label col-lg-2">Date </label>
                                          <div class="col-lg-2">
                                              <input class=" form-control" id="date" name="date" type="date" value="" />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="Title" class="control-label col-lg-2">Title <span class="required">*</span></label>
                                          <div class="col-lg-3">
                                              <input class=" form-control" id="title" name="title" type="text" value="" placeholder="Title" required />
                                          </div>
                                      </div>
                                       <div class="form-group ">
                                          <label for="Link" class="control-label col-lg-2">Link <span class="required">*</span></label>
                                          <div class="col-lg-3">
                                              <input class=" form-control" id="link" name="link" type="text" value="" placeholder="Link" required />
                                          </div>
                                      </div>
                                       <div class="form-group ">
                                         <label for="news" class="control-label col-lg-2">Description</label>
                                          <div class="col-lg-3">
                                           <textarea name="description" id="description" class="form-control" style="resize:vertical;" placeholder="Description"></textarea>  
                                          </div>
                                      </div>
                                  
                                       <div class="form-group ">
                                        <label for="Active" class="control-label col-lg-2 col-sm-3">Active</label>
                                          <div class="col-lg-1 col-sm-5">
                                              <input  type="radio" style="width: 20px" class="checkbox form-control" id="published" name="published" value="1" />
                                          </div>
                                          <label for="Inactive" class="control-label col-lg-2 col-sm-3">Inactive</label>
                                          <div class="col-lg-1 col-sm-5">
                                             <input  type="radio" style="width: 20px" class="checkbox form-control" id="published" name="published" value="0" />
                                          </div>
                                      </div>
                                    
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="btn btn-primary" type="submit" name="submit">Add News</button>
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
setTimeout(function(){$("#remove_msg").hide();},2000);
</script>

<script>
function cancel(data)
{
	var val=data;
	if(val=='cancel')
	{
		window.location='news_list.php';
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
