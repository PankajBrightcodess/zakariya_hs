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
                                <li class="active"><a href="profile.php">My Account</a></li>
                                <li><a href="editprofile.php">Edit Account</a></li>
                                <li><a href="addressbook.php">Address Book</a></li>
                                <li><a href="changepassword.php">Change Password</a></li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                        	<table class="table table-responsive table-condensed table-striped">
                            	<tr>
                                	<th>Name</th>
                                    <td><?php echo $array['name']; ?></td>
                              	</tr>
                                <tr>
                                	<th>E-mail</th>
                                    <td><?php echo $array['email']; ?></td>
                              	</tr>
                                <tr>
                                	<th>Mobile</th>
                                    <td><?php echo $array['mobile']; ?></td>
                                </tr>
                            </table>
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
			
			$('.order').click(function(){
				var total=parseFloat($('#book_total').val());
				$.each($("input[name='order[]']:checked"), function() {
					if($(this).val()=='copy'){
						total+=parseFloat($('#copy_total').val());
					}
					if($(this).val()=='stationery'){
						total+=parseFloat($('#stationery_total').val());
					}
				});	
				total=total.toFixed(2);
				$('#total').val(total);
			});
		});
		
		function confirmDelete(str){
			var id=str;
			if(confirm("Are you sure you want to delete this Item?")){
				window.location="deletecart.php?removeItem=removeItem&080f6d7f511a9128d45c370f50291f92="+id;
			}
		}
    </script>

  </body>
</html>
