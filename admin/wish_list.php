<?php 
session_start();
if(isset($_SESSION['role']))
{
	$role=$_SESSION['role'];
}
include_once "class/config.php";
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

    <title>BMS | WishList</title>

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
					<h3 class="page-header"><i class="fa fa-files-o"></i>Wish List</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="icon_document_alt"></i>WishList</li>
						<li><i class="fa fa-files-o"></i>Wish List</li>
					</ol>
				</div>
			</div>
              <!-- Form validations -->              
         <div class="row">
        <div class="nav search-row" id="top_menu">
                <!--  search form start -->
                <ul class="nav top-menu">                    
                    <li>
                        <form class="navbar-form">
                            <input class="form-control" name="search" id="search" placeholder="Search" type="text" onKeyUp="searchResult(this.value);">
                        </form>
                    </li>                    
                </ul>
                <!--  search form end -->                
            </div>
        
       </div>       
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
                    
       <div class="col-lg-12" id="search-result">
                    
          <div class="table-responsive" style="width:100%">
          <table class="table table-hover table-stripped" >
			   <thead>
                 <th style="text-align:center">Product Id</th>
			     <th style="text-align:center">Name</th>
                 <th style="text-align:center">Mobile</th>
				 <th style="text-align:center">Email</th>
                 <th style="text-align:center">Product</th>
			   </thead>
<?php 
            $db=Database::getInstance();
			$conn=$db->getConnection();

			$count=12;
			$offset=0;
			if(isset($_GET['page'])){
		          $page=$_GET['page'];
		     }
			 else{
					  $page=1;	
				  }
				  $offset=($page-1)*$count;
			$wishlists=$db->get_rows("`tbl_wishlist` t1, `tbl_member` t2" ,"t1.*,t2.name,t2.mobile,t2.email","t1.user_id=t2.id","t1.id desc","$offset,$count");
			//print_r($wishlists);
			$rowcount=$db->get_count("`tbl_wishlist`","");
			
			$pages=ceil($rowcount/$count);
			if(is_array($wishlists))
			{
			foreach($wishlists as $wishlist){
				
			?>
			<tr title="Click to see more Details">
               <td align="center"><?php echo $wishlist['product_id'] ;?></td>
               <td align="center"><?php echo ucwords($wishlist['name']);?></td>
               <td align="center"><?php echo $wishlist['mobile'] ;?></td>
               <td align="center"><?php echo $wishlist['email'];?></td>
               <td align="center"><?php echo $wishlist['product'];?></td>
			</tr>
			<?php	
			}
		
		if($pages>1){
	?>
    <tr>
    	<td colspan="13" align="center">
    <?php
			if($page!=1){
	?>	
    		<ul class="pagination pagination-sm">
    			<li><a href="wish_list.php?page=<?php echo $page-1;?>">Prev</a></li>
          	</ul>
    <?php
			}
			for($i=1;$i<=$pages;$i++){
				if($i<4 || $i>$pages-3 || $i==$page || $i==$page-1 || $i==$page+1 || $i==$page-2 || $i==$page+2){
	?>	
    		<ul class="pagination pagination-sm">
    			<li <?php if($i==$page){echo "class='active'";} ?>>
                	<a href="wish_list.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
          	</ul>
    <?php		
				}
				elseif($pages>5 && ($i==4 || $i==$pages-3)){
	?>
			<ul class="pagination pagination-sm">
    			<li>
                	<a>...</a>
                </li>
          	</ul>
    <?php
				}
			}
			if($page!=$pages){
	?>
    		<ul class="pagination pagination-sm">
    			<li><a href="wish_list.php?&page=<?php echo $page+1;?>">Next</a></li>
          	</ul>
    <?php
			}
	?>
    	</td>
    </tr>
    <?php
		}
	}
   else{
   
		?>
        <tr><td colspan="7" class="text-center text-danger">No Record Founds!</td></tr>
        <?php } ?>
</table>				  
</div>
                    
                     
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

<script>
function searchResult(data)
{
	var query=data;
	var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
			 document.getElementById("search-result").innerHTML = xhttp.responseText;
			}
		  };
		  xhttp.open("GET", "search_wishlist.php?query="+query, true);
		  xhttp.send();
}


</script>
  </body>
</html>
