<?php
session_start();
$user_id='';
if(isset($_SESSION['user_id'])){
	$user_id=$_SESSION['user_id'];
	$role=$_SESSION['role'];
	$where="`user_id`='$user_id'";
}
else{
	header("Location:login.php");
}
if(isset($_GET['id'])){
	$id=$_GET['id'];
}
else{
	header("Location:addressbook.php");
}
	include('admin/class/config.php');
	$obj=Database::getInstance();
	$array=$obj->get_details("`tbl_member`","*","`id`='$user_id'");
	$address=$obj->get_details("`tbl_address`","*","`id`='$id'");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book My Syllabus</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="my-css/style.css" rel="stylesheet">
    <!-- ---------- font ---------------------- -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700|Roboto:400,500,700" rel="stylesheet">
    <!-- ---------- font awesome ---------------------- -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
  </head>
  <body>
  <?php include 'header-nav.php'; ?>
    <section class="cart-summary" style="margin-top:135px;">
    	<div class="container">
        	<div class="row">
                <div class="col-md-12" style="padding:10px;">
                	<legend>Welcome <?php echo ucwords($array['name']); ?></legend>
                	<div class="row">
                        <div class="col-md-3" style="padding:10px; border-right:1px solid #eee;">
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="profile.php">My Account</a></li>
                                <li><a href="editprofile.php">Edit Account</a></li>
                                <li class="active"><a href="addressbook.php">Address Book</a></li>
                                <li><a href="changepassword.php">Change Password</a></li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                        	<div class="row">
                            	<div class="col-md-12" id="addressform">
                                	<form method="post" action="updateprofile.php">
                                        <table class="table table-responsive table-condensed table-striped">
                                            <tr>
                                                <th>Mobile <sup class="text-danger">*</sup> :</th>
                                                <td>
                                                	<input type="text" name="mobile" id="mobile" class="form-control"  onKeyUp="checkMobile(this.value)" maxlength="10"
                                                    	value="<?php echo $address['mobile']; ?>" required />
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Address <sup class="text-danger">*</sup> :</th>
                                                <td>
                                                	<textarea name="address" id="address" required style="resize:vertical;" class="form-control"><?php echo $address['address']; ?></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Landmark <sup class="text-danger">*</sup> :</th>
                                                <td><input type="text" name="landmark" class="form-control" value="<?php echo $address['landmark']; ?>" required /></td>
                                            </tr>
                                            <tr>
                                                <th>Pincode <sup class="text-danger">*</sup> :</th>
                                                <td><input type="text" name="pincode" id="pincode" class="form-control" maxlength="6" 
                                                		value="<?php echo $address['pincode']; ?>" required autocomplete="off" /></td>
                                            </tr>
                                            <tr>
                                                <th>Post Office <sup class="text-danger">*</sup> :</th>
                                                <td>
                                                	<select name="postoffice" id="postoffice" class="form-control" required>
                                                    	<option><?php echo $address['postoffice']; ?></option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>District <sup class="text-danger">*</sup> :</th>
                                                <td><input type="text" name="district" id="district" class="form-control" value="<?php echo $address['district']; ?>" required /></td>
                                            </tr>
                                            <tr>
                                                <th>State <sup class="text-danger">*</sup> :</th>
                                                <td><input type="text" name="state" id="state" class="form-control" value="<?php echo $address['state']; ?>" required /></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <input type="hidden" name="id" value="<?php echo $id ;?>" />
                                                    <input type="submit" class="btn btn-success" name="updateAddress" value="Update Address">
                                                </td>
                                            </tr>
                                        </table>
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end of container -->
    </section>
<?php include 'footer.php'; ?>
	<script language="javascript">
		$(document).ready(function(e) {
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
						url:"https://api.data.gov.in/resource/04cbe4b1-2f2b-4c39-a1d5-1c2e28bc0e32?format=json",
						crossDomain:true,
						data:{'api-key':'579b464db66ec23bdd000001d4d6ee69112c41916c950f40fc0c1a6b','filters[pincode]':pincode,'fields':'officename,districtname,statename','limit':'50'},
						dataType:"json",
						success: function(data){
							var count=data['count'];
							for(var i=0;i<count;i++){
								option+="<option>"+data['records'][i]['officename']+"</option>";
							}
							$('#postoffice').html(option);
							$('#district').val(data['records'][0]['districtname']);
							$('#state').val(data['records'][0]['statename']);
						}	
					});	
				}else{
					$('#postoffice').html(option);
					$('#district').val('');
					$('#state').val('');
				}
			});
        });
		$( window ).on( "load", function() {
			var pincode=$('#pincode').val();
			var postoffice='<?php echo $address['postoffice']; ?>';
			var option="<option value=''>Select Post Office</option>";
			$.ajax({
				type:"GET",					
				url:"https://api.data.gov.in/resource/04cbe4b1-2f2b-4c39-a1d5-1c2e28bc0e32?format=json",
				crossDomain:true,
				data:{'api-key':'579b464db66ec23bdd000001d4d6ee69112c41916c950f40fc0c1a6b','filters[pincode]':pincode,'fields':'officename','limit':'50'},
				dataType:"json",
				success: function(data){
					var count=data['count'];
					for(var i=0;i<count;i++){
						option+="<option>"+data['records'][i]['officename']+"</option>";
					}
					$('#postoffice').html(option);
					$('#postoffice').val(postoffice);
					
				}	
			});
		});
	
		function checkMobile(str){
			var mobile=str;
			if(mobile!=''){mobile=parseInt(mobile);}
			if(isNaN(mobile)){mobile=''; alert("Enter Valid Mobile no!");}
			$('#mobile').val(mobile)
			
		}
    </script>

  </body>
</html>
