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

    <title>BMS | Uploaded Book List</title>

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

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <script src="js/lte-ie7.js"></script>
    <![endif]-->
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
					<h3 class="page-header"><i class="fa fa-files-o"></i>Uploaded Book List</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="icon_document_alt"></i>Uploaded Book</li>
						<li><i class="fa fa-files-o"></i>Uploaded Book List</li>
					</ol>
				</div>
			</div>
              <!-- Form validations -->              
        
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
			     <th style="text-align:center">Order Id</th>
                 <th style="text-align:center">Order Date</th>
				 <th style="text-align:center">Name</th>
                 <th style="text-align:center">School</th>
                 <th style="text-align:center">Class</th>
                 <th style="text-align:center"> Mobile</th>
                 <th style="text-align:center">Downloads</th>
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
			$booklists=$db->get_rows("`tbl_booklist` t1, `tbl_class` t2" ,"t1.*,t2.class","t1.class_id=t2.id and t1.`id` in(Select booklist_id from `tbl_orderlist`)","id desc","$offset,$count");
			$rowcount=$db->get_count("`tbl_booklist`","`id` in(Select booklist_id from `tbl_orderlist`)");
			$pages=ceil($rowcount/$count);
			if(is_array($booklists))
			{
			foreach($booklists as $booklist){
				$selname=$db->get_details("`tbl_orders`","*","id in (Select order_id from tbl_orderlist where booklist_id='".$booklist['id']."')");
			?>
			<tr title="Click to see more Details">
               <td align="center"><?php echo $selname['id'];?></td>
               <td align="center"><?php echo $selname['date'];?></td>
               <td align="center"><?php echo ucwords($selname['name']);?></td>
               <td align="center"><?php echo ucwords($booklist['school']);?></td>
               <td align="center"><?php echo $booklist['class'];?></td>
               <td align="center"><?php echo ucwords($selname['mobile']);?></td>
               <td align="center"><a href="<?php echo $booklist['path'];?>" target="_blank" class="fa fa-download" download></a></td>
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
    			<li><a href="uploaded_book_list.php?page=<?php echo $page-1;?>">Prev</a></li>
          	</ul>
    <?php
			}
			for($i=1;$i<=$pages;$i++){
				if($i<4 || $i>$pages-3 || $i==$page || $i==$page-1 || $i==$page+1 || $i==$page-2 || $i==$page+2){
	?>	
    		<ul class="pagination pagination-sm">
    			<li <?php if($i==$page){echo "class='active'";} ?>>
                	<a href="uploaded_book_list.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
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
    			<li><a href="uploaded_book_list.php?&page=<?php echo $page+1;?>">Next</a></li>
          	</ul>
    <?php
			}
	?>
    	</td>
    </tr>
    <?php
		}
}else{
   
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


  </body>
</html>
