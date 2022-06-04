<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BMS | Registration Page</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="my-css/My.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="my-css/blue.css">

  

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <meta name="google-signin-client_id" content="464943508902-1hs2vndke373umoc8v9frphmjj968089.apps.googleusercontent.com">
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
        //'into this app.';
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
                 
                         
                $.ajax({
			   type: "POST",
			   url: "addgoogle_login.php",
			   data: {name:name,id:id,email:email,googleLogin:'googleLogin'}, // serializes the form's elements.
			   success: function(data)
			   {
                                  
				 window.location="http://bookmysyllabus.com/";
			   }
		  });	  
                
                //$('.userContent').html(profileHTML);
                //$('#gSignIn').slideUp('slow'); 
                 //$('#status').html(JSON.stringify(resp));
               //window.location='http://bookmysyllabus.com/';
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
   /* function signOut() {
        var auth2 = gapi.auth2.getAuthInstance();
        auth2.signOut().then(function () {
            $('.userContent').html('');
            $('#gSignIn').slideDown('slow');
        });
    } */
</script>
</head>
<body class="hold-transition register-page">
<div class="register-box">
 
  <div class="register-box-body">
    <p class="login-box-msg">Register a new membership</p>

    <form action="add_member_data.php" method="post" onSubmit=" return checkPasswrd();">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Full name" name="name"pattern="[a-zA-Z\s]+" required title="Enter Only Alphabets">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Mobile" name="mobile" id="mobile" onKeyUp="checkMobile(this.value)" required>
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" id="password" 
        	pattern="(?=.*\d)(?=.*[a-z]).{8,}" title="Must contain at least one number and one letter, and at least 8 or more characters" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Retype password" name="repassword" id="repassword" required>
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
       <div class="row">
          <div class="col-xs-8" id="chekpassmsg"></div>
        <!-- /.col -->
        <div class="col-xs-4"></div>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" required> I agree to the <a href="#">terms</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat" name="submit">Register</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

     <div class="social-auth-links text-center">
      <p id="status">- OR -</p>
<fb:login-button scope="public_profile,email" onlogin="checkLoginState();"><i class="fa fa-facebook"></i> Sign in using
        Facebook
</fb:login-button>
      <!--<button type="button" class="btn btn-block btn-social btn-facebook btn-flat" onlogin="checkLoginState();"><i class="fa fa-facebook"></i> Sign in using
        Facebook</button>-->
<br><br>
      <div style="margin:0px 0px 0px 80px;" id="gSignIn"></div>
      <div class="userContent"></div>
      <!--<a href="#" class="btn btn-block btn-social btn-google btn-flat userContent"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>-->
    </div>
    <!-- /.social-auth-links -->

    <a href="login.php" class="text-center">I already have a membership</a>
    <a href="index.php" class="text-center pull-right">Skip Register</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3.1.1 -->
<script src="bootstrap/js/jquery-3.1.1.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="bootstrap/js/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
<script>

		function checkMobile(str){
			var mobile=str;
			if(mobile!=''){mobile=parseInt(mobile);}
			if(isNaN(mobile)){mobile=''; alert("Enter Valid Mobile no!");}
			$('#mobile').val(mobile)
			
		}
function checkPasswrd()
{
	var pass=$('#password').val();
	var repass=$('#repassword').val();
	if(pass!=repass)
	{
		document.getElementById('chekpassmsg').style.color="red";
		document.getElementById('chekpassmsg').innerHTML="Password Doesn't Match!";
		return false;
	}
	else{return true;}
}
</script>
</body>
</html>
