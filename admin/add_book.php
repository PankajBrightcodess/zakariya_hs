<?php 
session_start();
if(isset($_SESSION['role']))
{
	$role=$_SESSION['role'];
}
include "class/books.php";
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

    <title>BMS | Add Books</title>

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

     <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <SCRIPT>
function addMore() {
	$("<DIV>").load("input.php", function() {
			$("#product").append($(this).html());
	});	
}
function deleteRow() {
	$('div.product-item').each(function(index, item){
		jQuery(':checkbox', this).each(function () {
            if ($(this).is(':checked')) {
				$(item).remove();
            }
        });
	});
}
</SCRIPT>
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
					<h3 class="page-header"><i class="fa fa-files-o"></i> Add Books</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="icon_document_alt"></i>Books</li>
						<li><i class="fa fa-files-o"></i>Add Books</li>
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
                            Add Books
                          </header>
                          <div class="panel-body">
                              <div class="form">
                                  <form class="form-validate form-horizontal " id="" method="post" action="add_books_data.php">
                                      <div class="form-group ">
                                          <label for="fullname" class="control-label col-lg-2">Select School </label>
                                          <div class="col-lg-3">
                                              <select name="school_id" id="school_id" class="form-control select2">
                                                 <option selected="selected">--Select One--</option>
                                                 <?php 
												 $obj=new Books();
												 $data=$obj->get_all_school();
												 foreach($data as $school):
												 ?>
                                                 <option value="<?php echo $school['id'] ?>"><?php echo $school['name'] ?></option>
                                                 <?php endforeach; ?>
                                              </select>
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="fullname" class="control-label col-lg-2">Select Class </label>
                                          <div class="col-lg-3">
                                              <select name="class_id" id="class_id" class="form-control">
                                                 <option value="">--Select One--</option>
                                                 <?php
                                                 $val=$obj->get_all_class();
												 foreach($val as $cls):
												 ?>
                                                 <option value="<?php echo $cls['id'] ?>"><?php echo $cls['class'] ?></option>
                                                 <?php endforeach; ?>
                                              </select>
                                          </div>
                                      </div>
                                       <div class="form-group ">
                                          <label for="fullname" class="control-label col-lg-2">Select Subject </label>
                                          <div class="col-lg-3">
                                              <select name="subject_id" id="subject_id" class="form-control">
                                                 <option value="">--Select One--</option>
                                                 <?php
                                                 $val=$obj->get_all_subject();
												 foreach($val as $sub):
												 ?>
                                                 <option value="<?php echo $sub['id'] ?>"><?php echo $sub['name'] ?></option>
                                                 <?php endforeach; ?>
                                              </select>
                                          </div>
                                      </div>
                                     <div id="product">
                                      
                                          <?php require_once("input.php") ?>
                                          
                                      </div>
                                       <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                             <input class="btn btn-info" type="button" name="add_item" value="Add More" onClick="addMore();" />
                                             <input class="btn btn-danger" type="button" name="del_item" value="Delete" onClick="deleteRow();" />
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="btn btn-primary" type="submit" name="submit">Add Books</button>
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
		window.location='book_list.php';
	}
}
</script>
 <script src="plugins/select2/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    
  });
</script>
    <!-- javascripts -->
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
