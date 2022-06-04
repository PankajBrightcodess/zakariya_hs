<?php 
session_start();
if(isset($_SESSION['role']))
{
	$role=$_SESSION['role'];
}
include_once "class/config.php";
include "class/user.php";
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

    <title>BMS | Users</title>

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
	
	function addUser(){
		$("#add_user").show();	
		$("#update_user").hide();
	}
	function closeUser(){
		
		$("#add_user").hide();	
	}
	function closeUpUser(){
		
		$("#update_user").hide();	
	}
	
	
	function editUser(data){
		var id=data;
		//alert(id);
		$("#add_user").hide();
		$("#update_user").show();	
		$.ajax({
            type: 'POST',
            url: 'user_json.php',
            data: {
                id: id
            },
            dataType: 'json',
            success: function (data) //on recieve of reply
            {
				//alert('hello');
				var uid=data['id'];
                var username=data['username']; 
				var password=data['password'];
                var role=data['role']; 
                var active=data['active']; 
               
				//alert(name);
                $('#uid').val(uid);
                $('#up_username').val(username);
				$('#up_password').val(password);
                $('#up_role').val(role);
                $('#up_active').val(active);
					
            }
        });		
	}
	
	function deleteUser(data){
		var uid=data;
		//alert(uid)
		var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
				location.reload();
			}
		  };
		  xhttp.open("GET", "delete_user.php?uid="+uid, true);
		  xhttp.send();
	}
	
</script>
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
					<h3 class="page-header"><i class="fa fa-files-o"></i>Users</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="icon_document_alt"></i>Users</li>
						<li><i class="fa fa-files-o"></i>Users</li>
					</ol>
				</div>
			</div>
              <!-- Form validations --> 
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
           
       <div class="row">
      <div id="users" class="tab-pane fade in active">
                            <div class="row">
                            	<div class="col-lg-1 col-md-1" ></div>
                            	<div class="table-responsive col-lg-10 col-md-10 col-sm-12 col-xs-12">
                                    <table id="users_table" class="table table-striped">
                                    	<thead>
                                        	<th style="text-align:center">ID</th>
                                        	<th style="text-align:center">Users</th>
                                        	<th style="text-align:center">Role</th>
                                        	<th style="text-align:center">Action</th>
                                        </thead>
                                        
                                        <?php
										
											$userobj=new User();
											$res=$userobj->get_users();
											foreach($res as $userdata){
												
										?>
                                        <tr>
                                        	<td align="center"><?php echo $userdata['id']; ?></td>
                                        	<td align="center"><?php echo ucfirst($userdata['username']); ?></td>
                                        	<td align="center"><?php echo ucfirst($userdata['role']); ?></td>
                                        	<td align="center">
                                             <?php if($_SESSION['role']=='admin'){ ?> 
                                                <button type="button" class="btn btn-info" onclick="editUser('<?php echo $userdata['id']; ?>')"><i class="fa fa-edit"></i></button>
                                                <?php if($userdata['id']!=1){ ?>
                                                <button type="button" class="btn btn-danger" onclick="deleteUser('<?php echo $userdata['id']; ?>')"><i class="fa fa-trash-o"></i></button>
                                              <?php } } ?>
                                            </td>
                                        </tr>
                                        <?php
											}
										?>
                                    </table><!--end of users table -->
                                    <?php  if($_SESSION['role']=='admin'){ ?>
                                         <button type="button" class="btn btn-success" onclick="addUser();">Add User</button>
                                    <?php } ?>
                                </div>
                            	<div class="col-lg-1 col-md-1" ></div>
                            </div><!--end of row-->
                            <br />
                            <div class="row" id="add_user" style="display:none">
                            	<div class="col-lg-1 col-md-1" ></div>
                            	<form action="add_user.php" method="post" class="col-lg-10 col-md-10 col-sm-12 col-xs-12" >
                                	<legend>Add User</legend>
                                    <div class="row">
                                    	<div class="col-lg-1 col-md-1"></div>
                                    	<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4"><b>Username:</b></div>
                                    	<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        	<input type="text" name="username" class="form-control" required="true" />
                                        </div>
                                        <div class="col-lg-5 col-md-5"></div>
                                    </div><!--end of form row 1-->
                                    <br />
                                    <div class="row">
                                    	<div class="col-lg-1 col-md-1"></div>
                                    	<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4"><b>Password:</b></div>
                                    	<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        	<input type="password" name="password" class="form-control" required="true" />
                                        </div>
                                        <div class="col-lg-5 col-md-5"></div>
                                    </div><!--end of form row 2-->
                                    <br />
                                    <div class="row">
                                    	<div class="col-lg-1 col-md-1"></div>
                                    	<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4"><b>Role:</b></div>
                                    	<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        	<select name="role" class="form-control" required>
                                            	<option value="">Select</option>
                                            	<option value="admin">Admin</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-5 col-md-5"></div>
                                    </div><!--end of form row 3-->
                                    <br />
                                
                                    <div class="row">
                                    	<div class="col-lg-1 col-md-1"></div>
                                    	<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4"><b>Active:</b></div>
                                    	<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        	<select name="active" class="form-control" required>
                                            	<option value="1">Yes</option>
                                            	<option value="0">No</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-5 col-md-5"></div>
                                    </div><!--end of form row 4-->
                                    <br />
                                    <div class="row">
                                    	<div class="col-lg-1 col-md-1"></div>
                                    	<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4"></div>
                                    	<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                        	<input type="submit" name="adduser" value="Add" class="btn btn-success" />
                                        </div>
                                    	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        	<button type="button" class="btn btn-danger" onclick="closeUser()">Cancel</button>
                                        </div>
                                        <div class="col-lg-3 col-md-3"></div>
                                    </div><!--end of form row 5-->
                                </form><!--end of add user form -->
                            	<div class="col-lg-1 col-md-1" ></div>
                            </div><!--end of row-->
                            <div class="row" id="update_user" style="display:none">
                            	<div class="col-lg-1 col-md-1" ></div>
                            	<form action="add_user.php" method="post"  class="col-lg-10 col-md-10 col-sm-12 col-xs-12" >
                                	<legend>Update User</legend>
                                    <div class="row">
                                    	<div class="col-lg-1 col-md-1"></div>
                                    	<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4"><b>ID:</b></div>
                                    	<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        	<input type="text" name="uid" id="uid" class="form-control" readonly/>
                                        </div>
                                        <div class="col-lg-5 col-md-5"></div>
                                    </div><!--end of form row 1-->
                                    <br />
                                    <div class="row">
                                    	<div class="col-lg-1 col-md-1"></div>
                                    	<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4"><b>Username:</b></div>
                                    	<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        	<input type="text" name="up_username" id="up_username" class="form-control" />
                                        </div>
                                        <div class="col-lg-5 col-md-5"></div>
                                    </div><!--end of form row 1-->
                                    <br />
                                    <div class="row">
                                    	<div class="col-lg-1 col-md-1"></div>
                                    	<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4"><b>Password:</b></div>
                                    	<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        	<input type="password" name="up_password" id="up_password" class="form-control" />
                                        </div>
                                        <div class="col-lg-5 col-md-5"></div>
                                    </div><!--end of form row 2-->
                                    <br />
                                    <div class="row">
                                    	<div class="col-lg-1 col-md-1"></div>
                                    	<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4"><b>Role:</b></div>
                                    	<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        	<select name="up_role" id="up_role" class="form-control">
                                            	<option value="">Select</option>
                                            	<option value="admin">Admin</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-5 col-md-5"></div>
                                    </div><!--end of form row 3-->
                                    <br />
                                  
                                    <div class="row">
                                    	<div class="col-lg-1 col-md-1"></div>
                                    	<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4"><b>Active:</b></div>
                                    	<div class="col-lg-4 col-md-4 col-sm-8 col-xs-8">
                                        	<select name="up_active" id="up_active" class="form-control">
                                            	<option value="1">Yes</option>
                                            	<option value="0">No</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-5 col-md-5"></div>
                                    </div><!--end of form row 4-->
                                    <br />
                                    <div class="row">
                                    	<div class="col-lg-1 col-md-1"></div>
                                    	<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4"></div>
                                    	<div class="col-lg-2 col-md-2 col-sm-4 col-xs-4">
                                        	<input type="submit" name="up_user" value="Update" class="btn btn-success" />
                                        </div>
                                    	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        	<button type="button" class="btn btn-danger" onclick="closeUpUser()">Cancel</button>
                                        </div>
                                        <div class="col-lg-3 col-md-3"></div>
                                    </div><!--end of form row 5-->
                                </form><!--end of add user form -->
                            	<div class="col-lg-1 col-md-1" ></div>
                            </div><!--end of row-->
                        </div><!--end of users div-->
              </div>
              <!-- page end-->
          </section>
      </section>
      <!--main content end-->
      <?php include "footer.php"; ?>
  </section>
  <!-- container section end -->
<script>
setTimeout(function(){$("#remove_msg").hide();},5000);
</script>
    <!-- javascripts -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
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
