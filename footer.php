	<a id="back-to-top" href="#" class="btn btn-primary btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="top"><span class="glyphicon glyphicon-chevron-up"></span></a>

 <section class="footer">
    <div class="container wow fadeInUp animated" data-wow-duration="1s" data-wow-delay="1s">
    
        <div class="col-md-3">
        	<h3>Shipping &amp; Policies</h3>
        	<ul>
                <li><a href="shippingpolicy.php">Shipping Policies</a></li>
                <li><a href="shippingpolicy.php">Payments </a></li>
                <li><a href="shippingpolicy.php">Exchange Policies</a></li>
                <li><a href="shippingpolicy.php">Privacy Policy</a></li>
                <li><a href="shippingpolicy.php">Terms &amp; Conditions</a></li>
                <li><a href="shippingpolicy.php">Feedback</a></li>
            </ul>
        </div>
        
        <div class="col-md-3">
        	<h3>Company Info</h3>
        	<ul>
                <li><a href="#">About Us</a></li>
                <li><a href="#">FAQs</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Become a Seller</a></li>
                <li><a href="#">Customer Cares</a></li>
                <li><a href="#">Blog</a></li>
            </ul>
        </div>
        <div class="col-md-3">
            <h3><a href="contact-us.php">Stay Connected </a></h3>
        	<ul>
				<li> <i class="fa fa-globe text-danger" style="font-size:21px;"></i>&nbsp; Near Sunday Market</li>
                <li style="padding-left:10%;">Shivaji Marg, Ratu</li>
                <li style="padding-left:10%;">Ranchi - 835222, Jharkhand, India</li>
                <li><a href="tel:+9170709 93636" title="+9170709 93636"> <i class="fa fa-mobile fa-2x"></i>&nbsp; Mob :  +91-8877177468</a></li>
                <li><a href="mailto:vips.ranchi@gmail.com"><i class="fa fa-envelope text-danger"></i> &nbsp;Email : suprit002@gmail.com</a></li>
            </ul>
        </div>

        <div class="col-md-3">
        	<h3><a href="#">Subscribe Now</a></h3>
        	<form action="subscribe.php" method="post">
            	<div class="input-group">
            	<input type="email" name="email" class="form-control" placeholder="your e-mail Id" required>
                <span class="input-group-addon addon-bg"><input type="submit" name="subscribe" class="subs-btn" value="Subscribe"></span>
                </div>
            </form>
            <h3><a href="#">Follow Us</a></h3>
            <div class="footer-social">
            	<a href="https://twitter.com/" target="_blank"><img src="images/twitter.png" alt="twitter"></a>
                <a href="https://www.facebook.com/" target="_blank"><img src="images/facebook.png" alt="facebook"></a>
                <a href="https://in.linkedin.com/" target="_blank"><img src="images/linkedin.png" alt="linkedin"></a>
                <a href="https://plus.google.com/" target="_blank"><img src="images/google-plus.png" alt="google-plus"></a>
                <a href="https://web.whatsapp.com/" target="_blank"><img src="images/whatsapp.png" alt="whatsapp"></a>
                <a href="https://www.instagram.com/" target="_blank"><img src="images/instagram.png" alt="instagram"></a>
            </div>
        </div>
        
    </div><!--end of container-->

 </section>
<!-------------------------End Footer ------------------------>

<div class="crights-block">
        <div class="container">
        
            <div class="col-sm-7">
            	<a href="index.php">
                <span style="float:left; padding-top:5px;">
                    Copyright &copy; 2017-2018 Book My Syllabus. All Rights Reserved.
                </span>
                </a>
            </div>
            
            <div class="col-sm-5">
                <span style="float:right;">
                	Powered By : 
                    <a href="https://brightcodess.com" target="_blank" class="wow bounceInUp animated" data-wow-duration="2" data-wow-delay="1.5s"><img src="images/bss-logo.png" alt="logo" style="width:100px; height:33px; margin-right:50px;"></a>
                </span>
            </div> 
                    
        </div>
</div><!-- cright-block -->



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
     $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
        // scroll body to 0px on click
        $('#back-to-top').click(function () {
            $('#back-to-top').tooltip('hide');
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
        
        $('#back-to-top').tooltip('show');

});
</script>