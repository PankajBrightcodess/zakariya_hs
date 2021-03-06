<?php 
session_start();
if(isset($_SESSION['role']))
{
	$role=$_SESSION['role'];
}
include "class/product.php";
$obj=new Product();
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

    <title>BMS | Add Product</title>

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
				
                if(size > 153600){
                    alert("Maximum file size exceeds");
					$("#submit").addClass('disabled');
                    return false;
                }
				else{
                    var reader = new FileReader();
                   
                    reader.onload = function(e) {
						
				   var img = new Image();
				   img.src=reader.result;
					img.onload = function() {
						var height=img.height;
						var width=img.width;
						
						if(width!=500 && height!=300){
						   alert("Please Maintain Width & height of image!");
						  $("#submit").addClass('disabled');
						  return false;
					   }
					   else{
						  
                        $('#blah').attr('src', e.target.result)
						.width(300)
						.height(180); 
						  }
					}
						
                    }

                    reader.readAsDataURL(fuData.files[0]);
                }
            }

    } 


else {
        alert("Image only allows file types of GIF, PNG, JPG, JPEG and BMP. ");
		$("#submit").addClass('disabled');
		
    }
}
        }
		
		<!--------------------End file upload------------->
		
function removeDisabled()
{
	$("#submit").removeClass('disabled');
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
					<h3 class="page-header"><i class="fa fa-files-o"></i> Add Product</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="icon_document_alt"></i>Product</li>
						<li><i class="fa fa-files-o"></i>Add Product</li>
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
                            Add Product
                          </header>
                          <div class="panel-body">
                              <div class="form">
                                  <form class="form-validate form-horizontal " id="" method="post" action="add_product_data.php" enctype="multipart/form-data">
                                     <div class="form-group ">
                                         <?php
										 $data=$obj->get_product_id();
										 $id=$data['id']+1;
										  ?>
                                          <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                                          <label for="Product Name" class="control-label col-lg-2">Product Name <span class="required">*</span></label>
                                          <div class="col-lg-3">
                                              <input class=" form-control" id="pname" name="pname" type="text" placeholder="Product Name" required />
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="Product Price" class="control-label col-lg-2">Product Price <span class="required">*</span></label>
                                          <div class="col-lg-3">
                                              <input class="form-control" id="price" name="price" type="text"  onKeyUp="checkPrice(this.value)" placeholder="Product Price" required  />
                                          </div>
                                      </div>
                                       <div class="form-group ">
                                          <label for="Product Price" class="control-label col-lg-2"> Discount(%)</label>
                                          <div class="col-lg-3">
                                              <input class=" form-control" id="discount" name="discount" type="number" placeholder="example: 5" />
                                          </div>
                                      </div>
                                     <div class="form-group ">
                                          <label for="Product Price" class="control-label col-lg-2">Select Category <span class="required">*</span></label>
                                          <div class="col-lg-3">
                                              <select name="category" id="category" class="form-control" onChange="addFeature(this.value);" required>
                                                 <option value="">--Select One--</option>
                                                 <?php 
												 $data=$obj->get_all_category();
												 foreach($data as $val):
												 ?>
                                                 <option value="<?php echo $val['category'] ?>"><?php echo $val['category'] ?></option>
                                                 <?php endforeach; ?>
                                              </select>
                                          </div>
                                      </div>
                                     <div id="feature">
                                      
                                      </div>
                                      <br>
                                       <div class="form-group ">
                                          <label for="Description" class="control-label col-lg-2"> Description</label>
                                          <div class="col-lg-3">
                                          <textarea name="description" class="form-control" placeholder="Product Description" style="resize:vertical"></textarea>
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="Description" class="control-label col-lg-2">Upload Product Image</label>
                                          <div class="col-lg-3">
                                          <input type="file"  name="photo" id="choose_photo_btn" onChange="readURL(this);" onClick="removeDisabled();">
                                          <p class="help-block">Dimension 500??300 & file size less than 150KB.</p>
                                          </div>
                                           <div class="col-lg-5">
                                               <img id="blah" style="height:180px; width:300px;" />
                                           </div>
                                      </div>
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="btn btn-primary" type="submit" name="submit" id="submit">Add Product</button>
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
 <script src="plugins/select2/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    
  });
</script>
<script>

function addFeature(data)
{
	var category=data;
	var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
			 document.getElementById("feature").innerHTML = xhttp.responseText;
			}
		  };
		  xhttp.open("GET", "feature.php?category="+category, true);
		  xhttp.send();
}


function cancel(data)
{
	var val=data;
	if(val=='cancel')
	{
		window.location='product_list.php';
	}
}

function checkPrice(str){
			var mobile=str;
			var lastChar = mobile[mobile.length -1];
			if(lastChar=='.'){return false;}
			if(mobile!=''){mobile=parseFloat(mobile);}
			if(isNaN(mobile)){mobile=''; alert("Enter Valid Price!");}
			$(event.target).val(mobile)
		}
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
