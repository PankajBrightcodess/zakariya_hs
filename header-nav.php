 <meta name="google-signin-client_id" content="464943508902-1hs2vndke373umoc8v9frphmjj968089.apps.googleusercontent.com">
  <script src="bootstrap/js/jquery.min.js"></script>
<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else {
      // The person is not logged into your app or we are unable to tell.
     // document.getElementById('status').innerHTML = 'Please log ' +
       // 'into this app.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
     statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '1476444119100586',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.8' // use graph api version 2.8
  });

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  FB.getLoginStatus(function(response) {
    //statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    document.getElementById('status').innerHTML ='Welcome!  Fetching your information.... ';
     FB.api('/me', function(response) {
      console.log('Successful login for: ' + response.name);
      var name=response.name;
      var id=response.id;
      loginUser(id,name);
      document.getElementById('status').innerHTML =
        'Thanks for logging in, ' + response.name + '!';
     
    });
  }

</script>

<script src="https://apis.google.com/js/client:platform.js?onload=renderButton" async defer></script>
<script>
    function onSuccess(googleUser) {
        var profile = googleUser.getBasicProfile();
        gapi.client.load('plus', 'v1', function () {
            var request = gapi.client.plus.people.get({
                'userId': 'me'
            });
            //Display the user details
            request.execute(function (resp) {
                var name= resp.displayName;
			 var id= resp.id;
			 var email= resp.emails[0].value;
                 var social='<?php echo $_SESSION['social']; ?>';
                 var link=$('#link').val();
                 if(link==''){link="http://bookmysyllabus.com/";}
                         
                $.ajax({
			   type: "POST",
			   url: "addgoogle_login.php",
			   data: {name:name,id:id,email:email,googleLogin:'googleLogin'}, // serializes the form's elements.
			   success: function(data)
			   {
                                  
				  if(data==1 && social==''){
			          window.location=link;
		        }
			   }
		  });	  
            });
        });
    }
    function onFailure(error) {
        alert(error);
    }
    function renderButton() {
        gapi.signin2.render('gSignIn', {
            'scope': 'profile email',
            'width': 157,
            'height': 23,
           'longtitle': true,
            'theme': 'dark',
            'onsuccess': onSuccess,
            'onfailure': onFailure
        });
    }
    function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
            //$('.userContent').html('');
            //$('#gSignIn').slideDown('slow');
            window.location='http://bookmysyllabus.com/';
        });
    } 
</script>


<nav class="my-header navbar navbar-fixed-top">
        <div class="top-strip">
            <div class="container">	
            	<div class="pull-left">
                	<div class="space-top">
                    	<a href="tel:+918877177468" ><i class="fa fa-phone"></i>  +91-8877177468 </a>
                       	<a href="mailto:bookmysyllabus@gmail.com" class='top-strip-space'><i class="fa fa-envelope"></i> bookmysyllabus@gmail.com</a>
                    	<?php
                        	/*$topbar_left=$obj->get_rows("`tbl_topbar`","*","`side`='left'");
							$i=0;
							foreach($topbar_left as $item){$i++;
						?>
                        <a href="#" <?php if($i==2){echo "class='top-strip-space'";} ?>><i class="<?php echo $item['class'] ?>"></i> <?php echo $item['value'] ?></a>
                       	<?php }*/ ?>
                    </div>
                </div>
                <div class="pull-right">
                    <div class="social">
                    	<a href="https://twitter.com/" target="_blank"><img src="images/twitter.png" alt="twitter"></a>
                        <a href="https://www.facebook.com/" target="_blank"><img src="images/facebook.png" alt="facebook"></a>
                        <a href="https://in.linkedin.com/" target="_blank"><img src="images/linkedin.png" alt="linkedin"></a>
                        <a href="https://plus.google.com/" target="_blank"><img src="images/google-plus.png" alt="google-plus"></a>
                        <a href="https://web.whatsapp.com/" target="_blank"><img src="images/whatsapp.png" alt="whatsapp"></a>
                        <a href="https://www.instagram.com/" target="_blank"><img src="images/instagram.png" alt="instagram"></a>
                    </div>
                </div>
            </div><!-- end of container -->
        </div><!-- end of top-strip -->

  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span>Menu</span>
      </button>
      <a class="navbar-brand" href="index.php"><img src="images/logo2.png" alt="logo" class="img-responsive"></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right my-nav-ul">
        <li class="active"><a href="index.php">Home <span class="sr-only"></span></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Products <span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-menu-left">
          	<?php
                 if(isset($_SESSION['social']) && $_SESSION['social']==1){$_SESSION['social']=0;}
            	$products=$obj->get_rows("`tbl_category`","`category`");
				foreach($products as $product){
			?>
            <li><a href="products.php?category=<?php echo $product['category'] ?>"><?php echo $product['category'] ?></a></li>
            <?php	
				}
			?>
          </ul>
        </li>
		<li><a href="publications.php">Publications</a></li>
        <li>
        	<a href="cart.php">Cart <img src="images/cart.png" alt="cart" class="cart"><sup class="badge" style="margin:-10px 0 0 -3px;"><?php $items=$obj->get_count("`tbl_cart`",$where); echo $items; ?></sup>
            </a>
        </li>
        <?php if(isset($_SESSION['user_id'])){ 
          $userdetails=$obj->get_details("`tbl_member`","`name`","`id`='$user_id'");
          $fname=array_shift(explode(' ',$userdetails['name']));
        ?>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $fname; ?> <img src="images/user.png" alt="user" class="user"><span class="caret"></span></a>
          <ul class="dropdown-menu dropdown-menu-left">
            <li><a href="profile.php">Profile</a></li>
            <li><a href="myorders.php">My Order</a></li>
            <li><a href="mywishlist.php">Wishlist</a></li>
            <li><a href="logout.php" onClick="signOut();">Logout</a></li>
          </ul>
        </li>
        <?php }else{ ?>
		<li><a href="#" data-toggle="modal" data-target="#myModal">Login<img src="images/user.png" alt="user" class="user"></a></li>
        <?php } ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container -->
</nav>
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <!--<div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <p class="modal-title" style="text-align:center">Sign in / Sign Up to start your session</p>
      </div>-->
      
      <div class="modal-body">
        <div id="loginbox" class="mainbox main-box-control">  
        	<p class="modal-title" style="text-align:center">Sign in / Sign Up to start your session</p>                  
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Sign In</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-17px"><a href="forgotpassword.php">Forgot password?</a></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >
                        <form action="login.php" method="post" id="loginform" class="form-horizontal" role="form">
                            <div style="margin-bottom: 25px" class="input-group">
                            	<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
								<input type="text" class="form-control" name="username" id="login-username"  value="" placeholder="Email or Mobile" required>
                            </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                            	<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                <input type="password" class="form-control" name="password" id="login-password"  placeholder="password" required>
                                <input type="hidden"  name="link" id="link" >
                            </div>
                            
                            <div class="input-group">
                            	<div class="col-md-10 checkbox">
                                	<label><input id="login-remember" type="checkbox" name="remember" >Remember me</label>
                                </div>
                                <div class="col-md-2 mob-mod"><button type="submit" name="login" class="btn btn-success">Sign In</button></div>
                            </div>
                            <p class="or" id="status">- - - OR - - -</p>
                          
							<div class="form-group">
                                <div class="controls">
                                   <div class="col-md-6" style="margin-bottom:10px;"><fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
Sign In with Facebook</fb:login-button></div>
                                   <!--<div class="col-md-6"><a href="#" class="btn btn-danger">Sign In with Google +</a></div>-->
                                   <div class="col-md-6" id="gSignIn"></div>
                                </div>
                            </div>
                            <div class="form-group">
                            	<div class="col-md-12 control">
                            		<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >Don't have an account! 
                                    	<a href="register.php" class="btn btn-info btn-sm">Sign Up Here</a>
									</div>
                                </div>
                            </div>    
						</form>     
					</div>                     
				</div>  
        </div>

      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div>

  </div>
</div>
<script language="javascript">
 function loginUser(id,name){
        var social='<?php echo $_SESSION['social']; ?>';
        var link=$('#link').val();
        if(link==''){link="http://bookmysyllabus.com/";}
	$.ajax({
		   type: "POST",
		   url: "addsocial_login.php",
		   data: {name:name,id:id,socialLogin:'socialLogin'}, // serializes the form's elements.
		   success: function(data)
		   {
                         if(data==1 && social==''){
			  window.location=link;
		        }
                    }
		 });	  
	}
</script>
    <?php /*
<div class="modal fade" id="myModal" role="dialog">
 	<div class="modal-dialog modal-sm">

    
      	<!-- Modal content-->
      	<div class="modal-content" >
        	<div class="modal-body">
          		
                <div class="login-box">
                  <!-- /.login-logo -->
                  <div class="login-box-body">
                    <p class="login-box-msg">Sign in to start your session</p>
                
                    <form action="login.php" method="post">
                      <div class="form-group has-feedback">
                        <input type="text" name="username" class="form-control" placeholder="Email OR Mobile">
                        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                      </div>
                      <div class="form-group has-feedback">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        <input type="hidden" name="link" id="link">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                      </div>
                      <div class="row">
                        <div class="col-xs-8">
                          <div class="checkbox icheck">
                            <label>
                              <input type="checkbox" name="remember"> Remember Me
                            </label>
                          </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                          <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                        <!-- /.col -->
                      </div>
                    </form>
                
                    <div class="social-auth-links text-center">
                      <p>- OR -</p>
<!--<fb:login-button scope="public_profile,email" onlogin="checkLoginState();">
</fb:login-button><br>-->
                      <button type="button" class="btn btn-block btn-social btn-facebook btn-flat" scope="public_profile,email" onlogin="checkLoginState();"><i class="fa fa-facebook"></i> Sign in using
                        Facebook</button>
                      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                        Google+</a>
                    </div>
                    <!-- /.social-auth-links -->
                
                    <a href="forgotpassword.php">I forgot my password</a><br>
                    <a href="register.php" class="text-center">Register a new membership</a>
                
                  </div>
                  <!-- /.login-box-body -->
                </div>
        	</div>
      	</div>
      
    </div>
</div>
*/?>