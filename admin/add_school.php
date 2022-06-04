<?php 
session_start();
if(isset($_SESSION['role']))
{
	$role=$_SESSION['role'];
}
include "class/school.php";
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

    <title>BMS | Add School</title>

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
					<h3 class="page-header"><i class="fa fa-files-o"></i> Add School</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="icon_document_alt"></i>Schools</li>
						<li><i class="fa fa-files-o"></i>Add School</li>
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
                            Add School
                          </header>
                          <div class="panel-body">
                              <div class="form">
                                  <form class="form-validate form-horizontal " id="" method="post" action="add_school_data.php">
                                      <div class="form-group ">
                                          <label for="fullname" class="control-label col-lg-2">School Name <span class="required">*</span></label>
                                          <div class="col-lg-3">
                                             <input class=" form-control" id="fullname" name="fullname" type="text" pattern="[A-Za-z\s]+" title="letters only" required />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="Affiliation" class="control-label col-lg-2">Affiliation </label>
                                          <div class="col-lg-3">
                                              <input class=" form-control" id="board" name="board" type="text" pattern="[A-Za-z\s]+" title="letters only" required />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="Affiliation" class="control-label col-lg-2">Session </label>
                                          <div class="col-lg-3">
                                              <input class=" form-control" id="session" name="session" type="text" />
                                          </div>
                                      </div>
                                       <div class="form-group ">
                                          <label for="Affiliation" class="control-label col-lg-2">Class </label>
                                          <div class="col-lg-2">
                                            <select class="form-control" name="from" id="from">
                                                 <option value="">--Select--</option>
                                                 <?php 
												 $obj=new School();
												 $data=$obj->get_all_class();
												 foreach($data as $val):
												 ?>
                                                 <option value="<?php echo $val['class'] ?>"><?php echo $val['class'] ?></option>
                                                 <?php
												 endforeach;
												 ?>
                                            </select>
                                          </div>
                                          <div class="col-md-1"><span>To</span></div>
                                          <div class="col-lg-2">
                                             <select class="form-control" name="to" id="to">
                                                 <option value="">--Select--</option>
                                                 <?php
                                                  foreach($data as $val):
												 ?>
                                                 <option value="<?php echo $val['class'] ?>"><?php echo $val['class'] ?></option>
                                                 <?php
												 endforeach;
												 ?>
                                            </select>
                                          </div>
                                      </div>
                                  
                                      <div class="form-group ">
                                          <label for="Email" class="control-label col-lg-2">Email </label>
                                          <div class="col-lg-3">
                                              <input class="form-control " id="email" name="email" type="email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="xyz@something.com" />
                                          </div>
                                      </div>
                                       <div class="form-group ">
                                          <label for="Website" class="control-label col-lg-2">Website </label>
                                          <div class="col-lg-3">
                                              <input class="form-control" id="website" name="website" type="text"  pattern="https?://.+" required title="http://rsgss.bms.com" />
                                          </div>
                                      </div>
                                       <div class="form-group ">
                                          <label for="Phone" class="control-label col-lg-2">Phone </label>
                                          <div class="col-lg-3">
                                              <input class="form-control" id="phone" name="phone" type="text"  pattern="^\d{10}$" title="10 numeric characters only"  />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="Address" class="control-label col-lg-2">Address </label>
                                          <div class="col-lg-3">
                                              <textarea name="address" class="form-control" style="resize:vertical;"></textarea>
                                          </div>
                                          
                                      </div>
                                    
                                 
                                      <div class="form-group ">
                                          <label for="agree" class="control-label col-lg-2 col-sm-3">Agree to Our Policy <span class="required">*</span></label>
                                          <div class="col-lg-10 col-sm-9">
                                              <input  type="checkbox" style="width: 20px" class="checkbox form-control" id="agree" name="agree" />
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="btn btn-primary" type="submit" name="submit">Save</button>
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

function cancel(data)
{
	var val=data;
	if(val=='cancel')
	{
		window.location='school_list.php';
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
