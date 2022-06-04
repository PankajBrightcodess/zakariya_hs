<?php 
session_start();
if(isset($_SESSION['role']))
{
	$role=$_SESSION['role'];
}
include_once "class/school.php";

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

    <title>BMS | Uploads</title>

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



    if (Extension == "gif" || Extension == "png" || Extension == "bmp"
                || Extension == "jpeg" || Extension == "jpg") {


            if (fuData.files && fuData.files[0]) {

                var size = fuData.files[0].size;

                if(size > 1024000){
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
						
						if(width!=1170 && height!=500){
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
        alert("Banner only allows file types of GIF, PNG, JPG, JPEG and BMP. ");
		$("#submit").addClass('disabled');
		
    }
}
        }
		
		<!--------------------End file upload------------->
		
		 <!--------------------LOGO upload------------->

function checkLogo(input) {
	 var fuData = document.getElementById('choose_logo_btn');
var FileUploadPath = fuData.value;


if (FileUploadPath == '') {
    alert("Please upload an image");

} else {
    var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();



    if (Extension == "gif" || Extension == "png" || Extension == "bmp"
                || Extension == "jpeg" || Extension == "jpg") {


            if (fuData.files && fuData.files[0]) {

                var size = fuData.files[0].size;

                if(size > 100000){
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
						
						if(width!=150 && height!=80){
						   alert("Please Maintain Width & height of Logo!");
						  $("#submit").addClass('disabled');
						  return false;
					   }
					   else{
						  
                        $('#logo').attr('src', e.target.result)
						.width(150)
						.height(80); 
						  }
					}
						
                    }


                    reader.readAsDataURL(fuData.files[0]);
                }
            }

    } 


else {
        alert("Logo only allows file types of GIF, PNG, JPG, JPEG and BMP. ");
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
					<h3 class="page-header"><i class="fa fa-files-o"></i>Uploads</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="icon_document_alt"></i>Uploads</li>
						<li><i class="fa fa-files-o"></i>Upload Image</li>
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
                    
                 <div class="col-md-12">
                  <div class="panel-body">
                  <form action="add_upload_data.php" method="post" enctype="multipart/form-data">
                 <div class="row">
                    <div class="form-group">
                      <label class="control-label col-md-2"><b>Select School</b></label>
                      <div class="col-md-4">                               
                          <select class="form-control select2" id="school" name="school_id" onChange="DisplayUpload(this.value);">
                            <option value="">- Choose School -</option>
                            <?php 
							$obj=new School();
							$data=$obj->get_all_school();
							foreach($data as $val)
							{
							?>
                            <option value="<?php echo $val['id']; ?>"><?php echo $val['name'] ?></option>
                            <?php } ?>
                          </select>  
                      </div>
                    </div>
                  </div>
                  <div class="row" style="display:none;" id="upl">
                      <div class="row">
                      <br>
                          <div class="form-group">
                              <label for="InputFile" class="col-md-2"><b>Upload Banner</b></label>
                               <div class="col-md-4">
                                 <input type="file"  name="photo" id="choose_photo_btn" onchange="readURL(this);" onClick="removeDisabled();" required>
                                  <p class="help-block">Dimension 1170×500 & file size must be less than 1MB.</p>
                              </div>
                             
                         </div>
                     </div>
                      <div class="row">
                      <br>
                          <div class="form-group">
                              <label for="InputFile" class="col-md-2"><b>Upload Logo</b></label>
                               <div class="col-md-4">
                                 <input type="file"  name="logo" id="choose_logo_btn" onchange="checkLogo(this);" onClick="removeDisabled();" required>
                                  <p class="help-block">Dimension 150×80 & file size must be less than 100KB.</p>
                              </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-6">
                         <img id="logo" style="height:50px; width:180px;" />
                         </div>
                         <div class="col-md-6">
                          <img id="blah" style="height:350px; width:600px;" />
                          </div>
                     </div>
                     <div class="row">
                         <div class="form-group">
                            <div class="col-md-offset-2 col-md-10">
                                <button class="btn btn-primary" type="submit" name="submit" id="submit">Save</button>
                                <button class="btn btn-default" type="button" onClick="FunCancel('cancel');">Cancel</button>
                            </div>
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
  function DisplayUpload(data)
  {
	  var id=data;
	  //alert(id);
	  if(id!=''){
		  $("#upl").show();
		  $.ajax({
			url: "school_banner_json.php",
            type: "POST",
            data: {id: id},
            dataType: "json",
			   success: function(data)
			   {
				   var banner=data['banner'];
				    var logo=data['logo'];
				   $("#logo").prop('src',logo);
				    $("#blah").prop('src',banner);
			   }
			 });	
	  
	  }else{
		  $("#upl").hide();
		 
	  }
	  
  }
  function FunCancel(data)
  {
	  var val=data;
	  if(val=='cancel')
	  {
		  window.location='uploads.php';
	  }
  }
  </script>
<script>
setTimeout(function(){$("#remove_msg").hide();},5000);
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
