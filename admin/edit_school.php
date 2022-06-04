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

    <title>BMS | Edit School</title>

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
include "class/school.php";
$obj=new School();
$id=$_GET['id'];
$data=$obj->get_school_by_id($id);
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
					<h3 class="page-header"><i class="fa fa-files-o"></i> Edit School</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="icon_document_alt"></i>Schools</li>
						<li><i class="fa fa-files-o"></i>Edit School</li>
					</ol>
				</div>
			</div>
              <!-- Form validations -->              
           
              <div class="row">
              
    
                  <div class="col-lg-12">
                      <section class="panel">
                          <header class="panel-heading">
                            Edit School
                          </header>
                          <div class="panel-body">
                              <div class="form">
                                  <form class="form-validate form-horizontal " id="" method="post" action="update_school_data.php">
                                      <div class="form-group ">
                                         <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                                          <label for="fullname" class="control-label col-lg-2">School Name </label>
                                          <div class="col-lg-3">
                                              <input class=" form-control" id="fullname" name="fullname" type="text" value="<?php echo $data['name'] ?>" />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="Affiliation" class="control-label col-lg-2">Affiliation </label>
                                          <div class="col-lg-3">
                                              <input class=" form-control" id="board" name="board" type="text" value="<?php echo $data['board'] ?>" />
                                          </div>
                                      </div>
                                     <div class="form-group ">
                                          <label for="Affiliation" class="control-label col-lg-2">Session </label>
                                          <div class="col-lg-3">
                                              <input class=" form-control" id="session" name="session" type="text" value="<?php echo $data['session'] ?>" />
                                          </div>
                                      </div>
                                       <div class="form-group ">
                                          <label for="Affiliation" class="control-label col-lg-2">Class </label>
                                          <div class="col-lg-2">
                                            <select class="form-control" name="from" id="from">
                                                 <option value="">--Select--</option>
                                                 <?php 
												 $cls=explode("-",$data['class']);
												 $class=$obj->get_all_class();
												 foreach($class as $val):
												 ?>
                                                 <option value="<?php echo $val['class'] ?>" <?php if($val['class']==$cls[0]){ ?> selected  <?php } ?>><?php echo $val['class'] ?></option>
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
                                                  foreach($class as $val):
												 ?>
                                                 <option value="<?php echo $val['class'] ?>" <?php if($val['class']==$cls[1]){ ?> selected  <?php } ?>><?php echo $val['class'] ?></option>
                                                 <?php
												 endforeach;
												 ?>
                                            </select>
                                          </div>
                                      </div>
                                  
                                      <div class="form-group ">
                                          <label for="Email" class="control-label col-lg-2">Email </label>
                                          <div class="col-lg-3">
                                              <input class="form-control " id="email" name="email" type="email" value="<?php echo $data['email'] ?>" />
                                          </div>
                                      </div>
                                       <div class="form-group ">
                                          <label for="Website" class="control-label col-lg-2">Website </label>
                                          <div class="col-lg-3">
                                              <input class="form-control" id="website" name="website" type="text" value="<?php echo $data['website'] ?>" />
                                          </div>
                                      </div>
                                       <div class="form-group ">
                                          <label for="Phone" class="control-label col-lg-2">Phone </label>
                                          <div class="col-lg-3">
                                              <input class="form-control" id="phone" name="phone" type="text" value="<?php echo $data['phone'] ?>" />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="Address" class="control-label col-lg-2">Address </label>
                                          <div class="col-lg-3">
                                              <textarea name="address" class="form-control" style="resize:vertical;"><?php echo $data['address'] ?></textarea>
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
                                      <div class="form-group ">
                                          <label for="agree" class="control-label col-lg-2 col-sm-3">Agree to Our Policy <span class="required">*</span></label>
                                          <div class="col-lg-10 col-sm-9">
                                              <input  type="checkbox" style="width: 20px" class="checkbox form-control" id="agree" name="agree" />
                                          </div>
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
setTimeout(function(){$("#remove_msg").hide();},5000);
</script>

<script>
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
