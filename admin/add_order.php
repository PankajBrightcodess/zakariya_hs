<?php 
session_start();
if(isset($_SESSION['role']))
{
	$role=$_SESSION['role'];
}
include "class/order.php";
$obj=new Order();

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

    <title>BMS | Add Order</title>

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
					<h3 class="page-header"><i class="fa fa-files-o"></i> Add Order</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="icon_document_alt"></i>Order</li>
						<li><i class="fa fa-files-o"></i>Add Order</li>
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
                            Add Order
                          </header>
                          <div class="panel-body">
                              <div class="form">
                                  <form class="form-validate form-horizontal " id="" method="post" action="add_order_data.php">
                                  <div class="form-group ">
                                          <label for="fullname" class="control-label col-lg-2">Date<span class="required">*</span></label>
                                          <div class="col-lg-2">
                                              <input type="date" name="date" id="date" class="form-control" required>
                                          </div>
                                      </div>
                                   <div class="form-group ">
                                          <label for="fullname" class="control-label col-lg-2">Student Name <span class="required">*</span></label>
                                          <div class="col-lg-3">
                                              <input type="text" name="sname" id="sname" class="form-control" required placeholder="Student Name" pattern="[A-Za-z\s]+" title="letters only">
                                          </div>
                                      </div>
                                       <div class="form-group ">
                                          <label for="Phone" class="control-label col-lg-2">Name <span class="required">*</span></label>
                                          <div class="col-lg-3">
                                              <input type="text" name="name" id="name" class="form-control" required placeholder="Name" pattern="[A-Za-z\s]+" title="letters only">
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="Phone" class="control-label col-lg-2">Mobile <span class="required">*</span></label>
                                          <div class="col-lg-3">
                                              <input type="text" name="phone" id="phone" class="form-control" required placeholder="Mobile No." onKeyUp="checkMobile(this.value)" maxlength="10"  pattern="^\d{10}$" title="10 numeric characters only"  >
                                          </div>
                                      </div>
                                      <div class="form-group ">
                                          <label for="Phone" class="control-label col-lg-2">Email</label>
                                          <div class="col-lg-3">
                                              <input type="email" name="email" id="email" class="form-control" placeholder="Email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" title="xyz@something.com">
                                          </div>
                                      </div>
                                       <div class="form-group ">
                                          <label for="Address" class="control-label col-lg-2">Address <span class="required">*</span></label>
                                          <div class="col-lg-3">
                                             <textarea name="address" id="address" class="form-control" style="resize:vertical" placeholder="Address"></textarea>
                                          </div>
                                           <label for="Land Mark" class="control-label col-lg-2">Land Mark</label>
                                          <div class="col-lg-3">
                                              <input type="text" name="lmark" id="lmark" class="form-control" placeholder="Land Mark"  pattern="[A-Za-z\s]+" title="letters only">
                                          </div>
                                      </div>
                                       <div class="form-group ">
                                          <label for="Pin Code" class="control-label col-lg-2">Pin Code <span class="required">*</span></label>
                                          <div class="col-lg-3">
                                             <input type="text" name="pincode" id="pincode" class="form-control" placeholder="Pin Code" maxlength="6" required autocomplete="off"  pattern="^\d{6}$" title="6 numeric characters only" >
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
                                      <div class="form-group ">
                                          <label for="fullname" class="control-label col-lg-2">Select School </label>
                                          <div class="col-lg-3">
                                              <select name="school_id" id="school_id" class="form-control select2">
                                                 <option selected="selected">--Select One--</option>
                                                 <?php 
												 $obj=new Order();
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
                                              <select name="class_id" id="class_id" class="form-control select2" onChange="getPrice();">
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
                                      <div class="form-group">
                                      <label for="Product" class="control-label col-lg-2"></label>
                                         <label for="Book" class="control-label col-lg-1">Book<i id="bcost"></i></label>
                                          <div class="col-lg-1">
                                             <input type="checkbox" name="product[]" id="product" value="book" checked class="form-control">
                                          </div>
                                         <label for="Copy" class="control-label col-lg-1">Copy<i id="ccost"></i></label>
                                         <div class="col-lg-1">
                                             <input type="checkbox" name="product[]" id="product" value="copy" class="form-control">
                                          </div>
                                         <label for="Stationary" class="control-label col-lg-1">Stationary<i id="scost"></i></label>
                                         <div class="col-lg-1">
                                             <input type="checkbox" name="product[]" id="product" value="stationary" class="form-control">
                                          </div>
                                      </div>
                                 
                                      <div class="form-group">
                                          <div class="col-lg-offset-2 col-lg-10">
                                              <button class="btn btn-primary" type="submit" name="submit">Add Order</button>
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
function getPrice()
{
	  var school_id=$("#school_id").val();
	  var class_id=$("#class_id").val();
	$.ajax({
            type: 'POST',
            url: 'price_json.php',
            data: {
                school_id: school_id,
				class_id: class_id
            },
            dataType: 'json',
            success: function (data) //on recieve of reply
            {
				var bookcost=" ("+parseFloat(Math.round(data['bookcost'] * 100) / 100).toFixed(2)+")";
				var copycost=" ("+parseFloat(Math.round(data['copycost'] * 100) / 100).toFixed(2)+")";
				var stcost="("+parseFloat(Math.round(data['stcost'] * 100) / 100).toFixed(2)+")";
				//alert(bookcost);
               $("#bcost").html(bookcost);
			   $("#ccost").html(copycost);
			   $("#scost").html(stcost);
			   
            }
        });		
	
}


function cancel(data)
{
	var val=data;
	if(val=='cancel')
	{
		window.location='order_list.php';
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
