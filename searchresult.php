<?php
session_start();
$user_id='';
$client_id='';
if(isset($_SESSION['user_id'])){
	$user_id=$_SESSION['user_id'];
	$role=$_SESSION['role'];
	$where="`user_id`='$user_id'";
}
elseif(isset($_COOKIE['client_id'])){
	$client_id=$_COOKIE['client_id'];
	$where="`client_id`='$client_id'";
}
	include('admin/class/config.php');
	$obj=Database::getInstance();
	if(isset($_GET['school_id']) && isset($_GET['class'])){
		$school=$_GET['school'];
		$class_id=$_GET['class'];
		$school_id=$_GET['school_id'];
		if($school_id!=''){
			$array=$obj->get_details("`tbl_school` t1, `tbl_images` t2","*","t1.`id`='$school_id' and t1.`id`=t2.`school_id`");	
		}
	}
	else{
		header("location:index.php");	
	}
	$where="`school_id`='$school_id' and `class_id`='$class_id'";
	$books=$obj->get_rows("`tbl_books`","*",$where);
	$copies=$obj->get_rows("`tbl_copy`","*",$where);
	$stationeries=$obj->get_rows("`tbl_stationary`","*",$where);
	$book_total=0;$copy_total=0;$stationery_total=0;$total=0;
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
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
    <section class="school-banner" style="margin-top:135px; padding:10px 0;">
    	<div class="container">
            <img src="<?php if($array['banner']!=''){echo "admin/".$array['banner'];} ?>" width="100%"   />
        </div>
    </section>
    <section class="search-result">
    	<div class="container">
        	<div class="school-details row">
            	<div class="col-md-12" style="padding:10px;">
                	<legend><h3><?php echo $school; ?></h3></legend>
                    <?php if($school_id!=''){ ?>
                    <div class="table-responsive">
                        <table class="table table-condensed table-striped">
                            <tr>
                                <th width="20%">Affiliation : </th>
                                <td width="30%"><?php echo $array['board']; ?></td>
                                <th width="20%">Phone : </th>
                                <td><?php echo $array['phone']; ?></td>
                            </tr>
                            <tr>
                                <th>Website : </th>
                                <td><a href="<?php echo $array['website']; ?>" target="_blank"><?php echo $array['website']; ?></a></td>
                                <th>Email : </th>
                                <td><a href="mailto:<?php echo $array['email']; ?>"><?php echo $array['email']; ?></a></td>
                            </tr>
                            <tr>
                                <th>Address : </th>
                                <td><?php echo $array['address']; ?></td>
                                <td colspan="2"></td>
                            </tr>
                        </table>
                    </div>
                    <?php } ?>
                </div>
            </div><!-- end of school-details -->
            <div class="book-details row">
            	<div class="col-md-12" style="padding:10px;">
                    <div class="row">
                        <div class="col-xs-6 col-sm-3"><h4>Book List of Class :</h4></div>
                        <div class="col-xs-5 col-sm-2">
                            <select name="class" id="class" class="form-control" required onChange="getThis(this.value)" >
                                <option value="">Class</option>
                                <?php
                                    $classes=$obj->get_rows("`tbl_class`");
                                    if(is_array($classes)){
                                        foreach($classes as $class){
                                ?>
                                <option value="<?php echo $class['id'] ?>" <?php if($class['id']==$class_id){echo "selected";} ?>><?php echo $class['class'] ?></option>
                                <?php	
                                        }
                                    }
                                ?>
                            </select>
                            <input type="hidden" id="school" value="<?php echo $school; ?>" >
                            <input type="hidden" id="school_id" value="<?php echo $school_id; ?>" >
                        </div>
                        <div class="col-xs-12 col-sm-5"><h4>Session : <?php echo date('Y')."-".date('Y',strtotime("+1 year")) ?></h4></div>
                    </div>
                    <?php if(is_array($books)){ ?>
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;" width="20%">Subject</th>
                                        <th style="text-align:center;" width="35%">Name of Books</th>
                                        <th style="text-align:center;" width="15%">MRP</th>
                                        <th style="text-align:center;" width="15%">Discount (%)</th>
                                        <th style="text-align:center;" width="15%">Cost</th>
                                    </tr>
                                </thead>
                                <?php
                                    $prevsub='';$book_total=0;
                                    if(is_array($books)){
                                        foreach($books as $book){
                                            $subject_id=$book['subject_id'];
                                            $selsub=$obj->get_details("`tbl_subject`","*","`id`='$subject_id'");
                                            $count=$obj->get_count("`tbl_books`",$where." and `subject_id`='$subject_id'");
                                ?>
                                <tr>
                                    <?php if($count>=1 && $subject_id!=$prevsub){?>
                                    <td align="center" rowspan='<?php echo $count; ?>' style="vertical-align:middle;"><?php echo $selsub['name']; ?></td>
                                    <?php } $prevsub=$subject_id; ?>
                                    <td align="center"><?php echo $book['name']; ?></td>
                                    <td align="center"><?php echo toDecimal($book['mrp']); ?></td>
                                    <td align="center"><?php echo $book['discount']."%"; ?></td>
                                    <td align="center"><?php echo toDecimal($book['cost']); ?></td>
                                </tr>
                                <?php
                                            $book_total+=$book['cost'];
                                        }
                                ?>
                                <tr>
                                    <th colspan="4" style="text-align:right" >Book Subtotal Cost : </th>
                                    <th style="text-align:center;"><?php echo toDecimal($book_total); ?></th>
                                </tr>
                                <?php
                                    }
                                    else{
                                        echo "<tr><td colspan='5' class='text-center text-danger'>No Result Found!</td></tr>";	
                                    }
                                ?>
                                
                            </table>
                        </div>
                    </div><br>
                    <?php }if(is_array($copies)){ ?>
                    <div class="row">
                        <div class="col-xs-12"><h4>Copy List </h4></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;" width="5%">Sl No.</th>
                                        <th style="text-align:center;" width="15%">Copy Type</th>
                                        <th style="text-align:center;" width="15%">No. of Pages</th>
                                        <th style="text-align:center;" width="15%">Quality</th>
                                        <th style="text-align:center;" width="10%">Quantity</th>
                                        <th style="text-align:center;" width="10%">MRP</th>
                                        <th style="text-align:center;" width="15%">Discount (%)</th>
                                        <th style="text-align:center;" width="15%">Cost</th>
                                    </tr>
                                </thead>
                                <?php
                                    $copy_total=0;
                                    if(is_array($copies)){$i=0;
                                        foreach($copies as $copy){$i++;
                                ?>
                                <tr>
                                    <td align="center"><?php echo $i; ?></td>
                                    <td align="center"><?php echo $copy['name']; ?></td>
                                    <td align="center"><?php echo $copy['pages']; ?></td>
                                    <td align="center"><?php echo $copy['quality']; ?></td>
                                    <td align="center"><?php echo $copy['quantity']; ?></td>
                                    <td align="center"><?php echo toDecimal($copy['mrp']); ?></td>
                                    <td align="center"><?php echo $copy['discount']."%"; ?></td>
                                    <td align="center"><?php echo toDecimal($copy['cost']); ?></td>
                                </tr>
                                <?php
                                            $copy_total+=$copy['cost'];
                                        }
                                ?>
                                <tr>
                                    <th colspan="7" style="text-align:right" >Copy Subtotal Cost : </th>
                                    <th style="text-align:center;"><?php echo toDecimal($copy_total); ?></th>
                                </tr>
                                <?php
                                    }
                                    else{
                                        echo "<tr><td colspan='8' class='text-center text-danger'>No Result Found!</td></tr>";	
                                    }
                                ?>
                                
                            </table>
                        </div>
                    </div><br>
                    <?php }if(is_array($stationeries)){ ?>
                    <div class="row">
                        <div class="col-xs-12"><h4>Stationery List </h4></div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <table class="table table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th style="text-align:center;" width="5%">Sl No.</th>
                                        <th style="text-align:center;" width="25%">Particulars</th>
                                        <th style="text-align:center;" width="25%">Quantity</th>
                                        <th style="text-align:center;" width="15%">MRP</th>
                                        <th style="text-align:center;" width="15%">Discount (%)</th>
                                        <th style="text-align:center;" width="15%">Cost</th>
                                    </tr>
                                </thead>
                                <?php
                                    $stationery_total=0;
                                    if(is_array($stationeries)){$i=0;
                                        foreach($stationeries as $stationery){$i++;
                                ?>
                                <tr>
                                    <td align="center"><?php echo $i; ?></td>
                                    <td align="center"><?php echo $stationery['particulars']; ?></td>
                                    <td align="center"><?php echo $stationery['quantity']; ?></td>
                                    <td align="center"><?php echo toDecimal($stationery['mrp']); ?></td>
                                    <td align="center"><?php echo $stationery['discount']."%"; ?></td>
                                    <td align="center"><?php echo toDecimal($stationery['cost']); ?></td>
                                </tr>
                                <?php
                                            $stationery_total+=$stationery['cost'];
                                        }
                                ?>
                                <tr>
                                    <th colspan="5" style="text-align:right" >Stationery Subtotal Cost : </th>
                                    <th style="text-align:center;"><?php echo toDecimal($stationery_total); ?></th>
                                </tr>
                                <?php
                                    }
                                    else{
                                        echo "<tr><td colspan='6' class='text-center text-danger'>No Result Found!</td></tr>";	
                                    }
                                    
                                ?>
                                
                            </table>
                        </div>
                    </div><br>
                    <?php 
						}
                       	$total=$book_total+$copy_total+$stationery_total; 
						if(!is_array($books) && isset($_SESSION['user_id'])){
					?>
                    <div class="row">
                        <p class="text-danger col-md-12">Upload your book list below in pdf, doc or jpg format. </p>
                        <form action="addtocart.php" class="form-horizontal" method="post" enctype="multipart/form-data" 
                        		style="margin-top:10px;" onSubmit="return validate();" id="uploadform">
                            <input type="hidden" name="school_id" value="<?php echo $school_id; ?>" />
                            <input type="hidden" name="school" value="<?php echo $school; ?>" />
                            <input type="hidden" name="class_id" value="<?php echo $class_id; ?>" />
                            <div class="form-group">
                        		<label class="control-label col-sm-2" for="email"><font size="+1">Upload Book List:</font></label>
                        		<div class="col-sm-10">
                            		<input type="file" name="booklist" id="booklist"  style="margin-top:10px;" required onChange="readURL(this)" />
                        		</div>
                      		</div><br>
                            <div><img id="preview" ></div><br>
                            <button type="submit"  name="upload" value="Place Order" class="btn btn-success pull-left" >Place Order <i class="fa fa-cart-arrow-down"></i></button>
                        </form>
                    </div>
                    <?php }elseif(!is_array($books) && !isset($_SESSION['user_id'])){
					?>
                    <div class="row">
                    	<div class="col-md-12">
                        	<p class="text-danger">Book List Not Available! You can upload your book list below.</p>
                    		<button type="button" onClick="checkLogin();" name="" class="btn btn-success pull-left" >Upload <i class="fa fa-upload"></i></button>
                        </div>
                    </div>
                    <?php }else{ ?>
                    <div class="row">
                        <div class="col-md-12"><p class="pull-right"><font size="+2">Total Cost : <?php echo toDecimal($total); ?></font></p></div>
                        <form action="placeorder.php" class="col-md-12" method="get">
                            <input type="hidden" name="school_id" value="<?php echo $school_id; ?>" />
                            <input type="hidden" name="class_id" value="<?php echo $class_id; ?>" />
                            <input type="hidden" name="book_total" value="<?php echo $book_total; ?>" />
                            <input type="hidden" name="copy_total" value="<?php echo $copy_total; ?>" />
                            <input type="hidden" name="stationery_total" value="<?php echo $stationery_total; ?>" />
                            <?php if($total!=0){?>
                            <button type="submit" name="placeorder" value="Place Order" class="btn btn-success pull-right" >Place Order <i class="fa fa-cart-arrow-down"></i></button>
                            <?php } ?>
                        </form>
                    </div>
                    <?php } ?>
            	</div>
            </div><!-- end of book-details -->
        </div><!-- end of container -->
    </section>
<?php include 'footer.php'; ?>
	<script language="javascript">
		
		function getThis(str){
			var class_id=str;
			var school=$('#school').val();
			var school_id=$('#school_id').val();
			window.location="searchresult.php?class="+class_id+"&school_id="+school_id+"&school="+school;
		}
		
		function validate(){
			var ext = $('#booklist').val().split(".").pop().toLowerCase();
			if($.inArray(ext, ["doc","pdf",'docx','jpg','jpeg']) == -1) {
				alert("Booklist must be in doc, docx, pdf, jpg or jpeg format !");
				return false;
				
			}
			else{
				return true;	
			}
			//var form= new FormData($("#uploadform")[0]);
		}
		
		function checkLogin(){
			var url='<?php echo $url; ?>';
			$('#link').val(url);
			$.ajax({
				type:"POST",
				url:"checkout.php",
				data:{page:"address"},
				success: function(data){
					if(data==0){
						$('#myModal').modal('show');
					}else{
						window.location=url;	
					}
				}
			});
		}
		function readURL(input) {
			$("#preview").show();
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				var ext = input.files[0].name.split('.').pop().toLowerCase();
				if(ext=='jpg' || ext=='jpeg'){
					reader.onload = function (e) {
						$('#preview')
							.attr('src', e.target.result)
							.width(500)
							.height(650);
					};
	
					reader.readAsDataURL(input.files[0]);
				}
				else if(ext=='pdf' || ext=='doc' || ext=='docx'){
					$("#preview").hide();
				}else{
					alert("Booklist must be in doc, docx, pdf, jpg or jpeg format !");
					$("#preview").hide();
				}
			}
		}
    </script>

  </body>
</html>
