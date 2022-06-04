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
	include('admin/class/config.php');
	$obj=Database::getInstance();
	$array=$obj->get_details("`tbl_member`","*","`id`='$user_id'");
	$address=$obj->get_rows("`tbl_address`","*","`user_id`='$user_id'");
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
            	<?php
                	if(isset($_SESSION['msg'])){echo "<h4 class='text-success text-center' id='success'>".$_SESSION['msg']."</h4>"; unset($_SESSION['msg']);}
                	if(isset($_SESSION['err'])){echo "<h4 class='text-danger text-center' id='error'>".$_SESSION['err']."</h4>"; unset($_SESSION['err']);}
				?>
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
                            	<div class="col-md-12" id="addressbook">
                                	<button type="button" class="btn btn-warning" onClick="viewThis('addressform','addressbook');" 
                                    		style="margin:5px;">Add Address <i class="fa fa-plus"></i></button>
                                    <div class="row">
                                    	<?php
                                        	if(is_array($address)){
												foreach($address as $add){
										?>
                                        <div class="col-md-6">
                                            <table class="table table-responsive table-condensed">
                                                <tr>
                                                    <th>Mobile</th>
                                                    <td><?php echo $add['mobile']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Address</th>
                                                    <td><?php echo $add['address']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Landmark</th>
                                                    <td><?php echo $add['landmark']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Post Office</th>
                                                    <td><?php echo $add['postoffice']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>District</th>
                                                    <td><?php echo $add['district']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Pincode</th>
                                                    <td><?php echo $add['pincode']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>State</th>
                                                    <td><?php echo $add['state']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                    	<a href="editaddress.php?id=<?php echo $add['id']; ?>">Edit Address <i class="fa fa-edit"></i></a>&nbsp; 
                                                    	<a href="updateprofile.php?deleteAddress=deleteAddress&id=<?php echo $add['id']; ?>" onClick="return validate()"
                                                        	class="text-danger">Delete Address <i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                        <?php
												}
											}
										?>
                                    </div>
                                </div>
                            </div>
                        	<div class="row">
                            	<div class="col-md-12" id="addressform" style="display:none;">
                                	<button type="button" class="btn btn-primary" onClick="viewThis('addressbook','addressform');" 
                                    		style="margin:5px;">View Address <i class="fa fa-address-book"></i></button>
                                	<form method="post" action="updateprofile.php">
                                        <table class="table table-responsive table-condensed table-striped">
                                            <tr>
                                                <th>Mobile <sup class="text-danger">*</sup> :</th>
                                                <td><input type="text" name="mobile" id="mobile" class="form-control" required onKeyUp="checkMobile(this.value)" maxlength="10" /></td>
                                            </tr>
                                            <tr>
                                                <th>Address <sup class="text-danger">*</sup> :</th>
                                                <td>
                                                	<textarea name="address" id="address" required style="resize:vertical;" class="form-control"></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Landmark <sup class="text-danger">*</sup> :</th>
                                                <td><input type="text" name="landmark" class="form-control" required /></td>
                                            </tr>
                                            <tr>
                                                <th>Pincode <sup class="text-danger">*</sup> :</th>
                                                <td><input type="text" name="pincode" id="pincode" class="form-control" required autocomplete="off" maxlength="6" /></td>
                                            </tr>
                                            <tr>
                                                <th>Post Office <sup class="text-danger">*</sup> :</th>
                                                <td>
                                                	<select name="postoffice" id="postoffice" class="form-control" required>
                                                    	<option value="">Select Post Office</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>District <sup class="text-danger">*</sup> :</th>
                                                <td><input type="text" name="district" id="district" class="form-control" required /></td>
                                            </tr>
                                            <tr>
                                                <th>State <sup class="text-danger">*</sup> :</th>
                                                <td><input type="text" name="state" id="state" class="form-control" required /></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">
                                                    <input type="hidden" name="id" value="<?php echo $user_id ;?>" />
                                                    <input type="submit" class="btn btn-success" name="addAddress" value="Save Address">
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
		$(document).ready(function() {
			var success=$('#success').html();
			var error=$('#error').html();
			setTimeout(function() {
			 	if(success){
					$('#success').hide();
				}
				if(error){
					$('#error').hide();
				}
			},3000);
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
		function viewThis(str,str2){
			var show="#"+str;
			var hide="#"+str2;
			$(show).show();		
			$(hide).hide();
		}
		
		function checkMobile(str){
			var mobile=str;
			if(mobile!=''){mobile=parseInt(mobile);}
			if(isNaN(mobile)){mobile=''; alert("Enter Valid Mobile no!");}
			$('#mobile').val(mobile)
			
		}
		
		function validate(){
			if(confirm("Are you sure you want to delete this address?")){
				return true;
			}
			else{
				return false;	
			}	
		}
    </script>

  </body>
</html>
