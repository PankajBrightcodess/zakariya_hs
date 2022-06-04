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

    <title>BMS | Add Pincode</title>

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
					<h3 class="page-header"><i class="fa fa-files-o"></i> Add Pincode</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="icon_document_alt"></i>Pincode</li>
						<li><i class="fa fa-files-o"></i>Add Pincode</li>
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
                            Add Pincode
                          </header>
                          <div class="panel-body">
                              <div class="form">
                                  <form class="form-validate form-horizontal " id="" method="post" action="add_pincode_data.php">
                                 
                                       <div class="form-group ">
                                          <label for="Pin Code" class="control-label col-lg-2">Pin Code <span class="required">*</span></label>
                                          <div class="col-lg-3">
                                             <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Pin Code" maxlength="6" required autocomplete="off">
                                          </div>
                                         
                                           <label for="District" class="control-label col-lg-2">District<span class="required">*</span></label>
                                          <div class="col-lg-3">
                                              <input type="text" name="district" id="district" class="form-control" placeholder="District" required readonly>
                                          </div>
                                      </div>
                                       <div class="form-group ">
                                           <label for="Post Office" class="control-label col-lg-2">Post Office <span class="required">*</span></label>
                                          <div class="col-lg-3">
                                              <select name="po" id="po" class="form-control" required>
                                              </select>
                                          </div>
                                           <label for="State" class="control-label col-lg-2">State <span class="required">*</span></label>
                                          <div class="col-lg-3">
                                              <input type="text" name="state" id="state" class="form-control" placeholder="State" required readonly>
                                          </div>
                                      </div>
                                 
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="btn btn-primary" type="submit" name="submit">Add Pincode</button>
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
 <script src="plugins/select2/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    
  });
</script>
<script>

function cancel(data)
{
	var val=data;
	if(val=='cancel')
	{
		window.location='pincode_list.php';
	}
}

function checkMobile(str){
			var mobile=str;
			
			if(mobile!=''){mobile=parseInt(mobile);}
			if(isNaN(mobile)){mobile=''; alert("Enter Valid Mobile no!");}
			$('#mobile').val(mobile)
		}
</script>

<script>

$('#pincode').keyup(function(){
				var pincode=$(this).val();
				if(pincode!=''){pincode=parseInt(pincode);}
				if(isNaN(pincode)){pincode=''; alert("Enter Valid Pincode!");}
				$(this).val(pincode);
				var option="<option value=''>Select Post Office</option>";
				pincode=pincode.toString();
				if(pincode!='' && pincode.length==6){
					$.ajax({
						type:"GET",
						//url:"http://postalpincode.in/api/pincode/"+pincode,							
						url:"https://api.data.gov.in/resource/04cbe4b1-2f2b-4c39-a1d5-1c2e28bc0e32?format=json",
						crossDomain:true,
						data:{'api-key':'579b464db66ec23bdd000001d4d6ee69112c41916c950f40fc0c1a6b','filters[pincode]':pincode,'fields':'officename,districtname,statename','limit':'50'},
						dataType:"json",
						success: function(data){
							var count=data['count'];
							for(var i=0;i<count;i++){
								option+="<option>"+data['records'][i]['officename']+"</option>";
							}
							$('#po').html(option);
							$('#district').val(data['records'][0]['districtname']);
							$('#state').val(data['records'][0]['statename']);
						}	
					});	
				}else{
					$('#po').html(option);
					$('#district').val('');
					$('#state').val('');
				}
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
