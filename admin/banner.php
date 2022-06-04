<?php 
session_start();
if(isset($_SESSION['role']))
{
	$role=$_SESSION['role'];
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

    <title>BMS | Banner</title>

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

  <script>
  <!--------------------Banner upload------------->

function readURL(input) {
	 var fuData = document.getElementById('choose_photo_btn');
var FileUploadPath = fuData.value;

if (FileUploadPath == '') {
    alert("Please upload an image");

} else {
    var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();



    if (Extension == "jpg") {


            if (fuData.files && fuData.files[0]) {

                var size = fuData.files[0].size;

                if(size > 500000){
                    alert("Maximum file size exceeds");
					$("#submit").addClass('disabled');
                    //return;
                }else{
                    var reader = new FileReader();
                   
                    reader.onload = function(e) {
						
				   var img = new Image();
				   img.src=reader.result;
					img.onload = function() {
						var height=img.height;
						var width=img.width;
						
						if(width!=2000 && height!=500){
						   alert("Please Maintain Width & height of Banner!");
						  $("#submit").addClass('disabled');
						  return false;
					   }
					   else{
						  
                        $('#blah').attr('src', e.target.result)
						.width(600)
						.height(350); 
						  }
					}
						
                    }

                    reader.readAsDataURL(fuData.files[0]);
                }
            }

    } 


else {
        alert("Banner only allows file types of  JPG. ");
		$("#submit").addClass('disabled');
		
    }
}
        }
		
		<!--------------------End file upload------------->
		
function removeDisabled()
{
	$("#submit").removeClass('disabled');
}
		
  </script>
   <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
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
					<h3 class="page-header"><i class="fa fa-files-o"></i>Banner</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="icon_document_alt"></i>Banner</li>
						<li><i class="fa fa-files-o"></i>Home Banner</li>
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
                  <div class="panel-body">
                  <form action="add_banner_data.php" method="post" enctype="multipart/form-data">
                
                      <div class="row">
                      <br>
                          <div class="form-group">
                              <label for="InputFile" class="col-lg-2"><b>Home Banner</b></label>
                               <div class="col-lg-4">
                                 <input type="file"  name="photo" id="choose_photo_btn" onchange="readURL(this);" onClick="removeDisabled();" required>
                                  <p class="help-block">Dimension 2000×500 & file size must be less than 500KB.</p>
                              </div>
                             
                         </div>
                     </div>
                     
                     <div class="row">
                         <div class="col-lg-12 col-md-10 col-sm-8">
                          <img id="blah" style="height:350px; width:600px;" src="../images/banner.jpg" />
                          </div>
                     </div>
                          <br>
                     <div class="row">
                         <div class="form-group">
                            <div class="col-lg-offset-2 col-lg-10">
                                <button class="btn btn-primary" type="submit" name="submit" id="submit">Save</button>
                                <button class="btn btn-default" type="button" onClick="FunCancel('cancel');">Cancel</button>
                            </div>
                        </div>
                     </div>
                 </form> 
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
  
<script src="plugins/select2/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    
  });
</script>
  <script>
 
  function FunCancel(data)
  {
	  var val=data;
	  if(val=='cancel')
	  {
		  window.location='banner.php';
	  }
  }
  </script>
<script>
setTimeout(function(){$("#remove_msg").hide();},1500);
</script>
   
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
