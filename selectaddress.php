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
	$delete=$obj->delete("`tbl_tempadd`","`user_id`='$user_id'");
	$cart=$obj->get_count("`tbl_cart`","`user_id`='$user_id'");
	if($cart==0){header("Location:cart.php");}
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
    <section class="cart-summary" style="margin-top:135px; padding:50px 0">
    	<div class="container">
        	<div class="row">
            	<?php
                	if(isset($_SESSION['msg'])){echo "<h4 class='text-success text-center' id='success'>".$_SESSION['msg']."</h4>"; unset($_SESSION['msg']);}
                	if(isset($_SESSION['err'])){echo "<h4 class='text-danger text-center' id='error'>".$_SESSION['err']."</h4>"; unset($_SESSION['err']);}
				?>
                <div class="col-md-12">
                	<div class="row">
                        <div class="col-md-12">
                        	<legend>Select Address</legend>
                        	<div class="row">
                            	<div class="col-md-12" id="addressbook">
                                	<button type="button" class="btn btn-warning" onClick="viewThis('addressform','addressbook');" 
                                    		style="margin:5px;">Add Address <i class="fa fa-plus"></i></button>
                                    <div class="row">
                                    	<?php
                                        	if(is_array($address)){$i=0;
												foreach($address as $add){$i++;
										?>
                                        <div class="col-md-4">
                                            <table class="table table-responsive table-condensed">
                                                <tr>
                                                    <th>Name</th>
                                                    <td><?php echo $array['name']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Mobile</th>
                                                    <td><?php echo $add['mobile']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Address</th>
                                                    <td><?php echo $add['address']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Pincode</th>
                                                    <td><?php echo $add['pincode']; ?></td>
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
                                                    <th>State</th>
                                                    <td><?php echo $add['state']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2">
                                                    	<button type="button"  class="btn btn-primary btn-sm" 
                                                        	onClick="selectAddress('<?php echo $i; ?>')">
                                                        Select Address <i class="fa fa-check"></i></a>
                                                    </td>
                                                </tr>
                                            </table>
                                            <form method="post" action="submitorder.php" >
                                                <table class="table table-responsive table-condensed table-striped viewtable" id="<?php echo "add".$i; ?>" style="display:none;">
                                                    <tr>
                                                        <th>Name <sup class="text-danger">*</sup> :</th>
                                                        <td>
                                                        	<input type="text" name="name" value="<?php echo $array['name']; ?>" class="form-control" required>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Student's Name <sup class="text-danger">*</sup> :</th>
                                                        <td>
                                                        	<input type="text" name="student_name" id="student<?php echo $i; ?>" value="" class="form-control" required>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Mobile <sup class="text-danger">*</sup> :</th>
                                                        <td>
                                                        	<input type="text" name="mobile" id="mobile<?php echo $i; ?>" class="form-control" value="<?php echo $add['mobile']; ?>" 
                                                            	onKeyUp="checkMobile(this.value,'<?php echo $i; ?>')" maxlength="10" required />
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Address <sup class="text-danger">*</sup> :</th>
                                                        <td>
                                                            <textarea name="address" id="address" required style="resize:vertical;" class="form-control"><?php echo $add['address']; ?></textarea>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Landmark <sup class="text-danger">*</sup> :</th>
                                                        <td><input type="text" name="landmark" class="form-control" value="<?php echo $add['landmark']; ?>" required /></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Pincode <sup class="text-danger">*</sup> :</th>
                                                        <td><input type="text" name="pincode" id="pincode<?php echo $i; ?>" class="form-control" autocomplete="off" 
                                                        			value="<?php echo $add['pincode']; ?>" required onKeyUp="getPindata(this.value,'<?php echo $i; ?>')" /></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Post Office <sup class="text-danger">*</sup> :</th>
                                                        <td>
                                                        	<input type="hidden" id="hidpo<?php echo $i; ?>" value="<?php echo $add['postoffice']; ?>">
                                                            <select name="postoffice" id="postoffice<?php echo $i; ?>" class="form-control" required>
                                                            </select>
                                                    	</td>
                                                    </tr>
                                                    <tr>
                                                        <th>District <sup class="text-danger">*</sup> :</th>
                                                        <td><input type="text" name="district" id="district<?php echo $i; ?>" class="form-control" 
                                                        			value="<?php echo $add['district']; ?>" required /></td>
                                                    </tr>
                                                    <tr>
                                                        <th>State <sup class="text-danger">*</sup> :</th>
                                                        <td><input type="text" name="state" id="state<?php echo $i; ?>" class="form-control" 
                                                        			value="<?php echo $add['state']; ?>" required /></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <input type="submit" class="btn btn-success btn-sm" name="submitAddress" value="Submit Address">
                                                            <button type="button" class="btn btn-danger btn-sm" onClick="closeAll();">Cancel</button>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </form>
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
                                    		style="margin:5px;">Select Address <i class="fa fa-address-book"></i></button>
                                	<form method="post" action="updateprofile.php">
                                        <table class="table table-responsive table-condensed table-striped">
                                            <tr>
                                                <th>Mobile <sup class="text-danger">*</sup> :</th>
                                                <td><input type="text" name="mobile" id="mobile0" class="form-control" required 
                                                		onKeyUp="checkMobile(this.value,0)" maxlength="10" /></td>
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
                                                    <input type="hidden" name="page" value="select" />
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
		function selectAddress(str){
			var div="#add"+str;
			var input ="#student"+str;
			var pin="#pincode"+str;
			var po="#postoffice"+str;
			var hidpo="#hidpo"+str;
			$('.viewtable').hide();
			var pincode=$(pin).val();
			var postoffice=$(hidpo).val();
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
					$(po).html(option);
					$(po).val(postoffice);
					
				}	
			});
			$(div).show();
			$(input).focus();
			
		}
		
		function getPindata(str,str2){
			var pincode=str;
			var po="#postoffice"+str2;
			var dist="#district"+str2;
			var state="#state"+str2;
			var pin="#pincode"+str2;
			if(pincode!=''){pincode=parseInt(pincode);}
			if(isNaN(pincode)){pincode=''; alert("Enter Valid Pincode!");}
			$(pin).val(pincode);
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
						$(po).html(option);
						$(dist).val(data['records'][0]['districtname']);
						$(state).val(data['records'][0]['statename']);
					}	
				});	
			}else{
				$(po).html(option);
				$(dist).val('');
				$(state).val('');
			}
		}
		
		function checkMobile(str,str2){
			var mobile=str;
			var id="#mobile"+str2;
			if(mobile!=''){mobile=parseInt(mobile);}
			if(isNaN(mobile)){mobile=''; alert("Enter Valid Mobile no!");}
			$(id).val(mobile)
			
		}
		function closeAll(){
			$('.viewtable').hide();
		}
    </script>

  </body>
</html>
