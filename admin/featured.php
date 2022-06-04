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

    <title>BMS | Featured List</title>

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
 
  <!-- iCheck -->
   <link rel="stylesheet" href="../my-css/My.min.css">
  <link rel="stylesheet" href="../my-css/blue.css">
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
					<h3 class="page-header"><i class="fa fa-files-o"></i>Featured List</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="icon_document_alt"></i>Featured</li>
						<li><i class="fa fa-files-o"></i>Featured List</li>
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
                    
       <div class="col-lg-12">
                    
          <div class="row table-responsive" style="width:100%">
        <form action="add_featured.php" method="post" onSubmit=" checkThis();">
          <table class="table table-hover table-stripped" >
			   <thead>
			     <th style="text-align:center">Serial No.</th>
				 <th style="text-align:center">Name</th>
				 <th style="text-align:center">Session</th>
				 <th style="text-align:center">Class</th>
				 <th style="text-align:center">Email</th>
				 <th style="text-align:center">Website</th>
                 <th style="text-align:center">Phone</th>
                  <th style="text-align:center">Published</th>
				 <th style="text-align:center">Set Featured</th>
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
			
			$sql="select * from tbl_school order by id asc limit $offset,$count";
			$sql1="select count(id) as count from tbl_school";
			
				$rowcount=$conn->query($sql1);
				$data= $rowcount->fetch_assoc();
				$rownum= $data['count'];
				$pages= ceil($rownum/$count);

				     $rs=$conn->query($sql);
					 if($rs->num_rows>0){
						$sno=$offset;$i=0;
					 while($result=$rs->fetch_array()){$i++;
						 ?>
						 <tr title="Click to see more Details">
						 <td align="center"><?php echo ++$sno;?></td>
						  <td align="center"><?php echo $result['name'];?></td>
                         <td align="center"><?php echo $result['session'];?></td>
                         <td align="center"><?php echo $result['class'];?></td>
						 <td align="center"><?php echo $result['email'];?></td>
						 <td align="center"><?php echo $result['website'];?></td>
						 <td align="center"><?php echo $result['phone'];?></td>
                          <td align="center"><?php if(($result['published'])==1){ ?> <i class="fa fa-check text-success"></i><?php }
    
                                      else{
                                        ?>
                                         <i class="fa fa-times text-danger"></i>
                                        <?php
                                        }?>
                                          
    
                         </td>
						 <td align="center" class="checkbox icheck">
                         <?php
						    $fea = "SELECT  `featured` FROM `tbl_images` WHERE school_id='$result[id]'";
							$q=$conn->query($fea);
							$data=$q->fetch_array();
						  ?>
                              <input type="hidden" name="school_id[]" value="<?php echo $result['id'] ?>">
                              <input type="hidden" name="featured[]" id="featured<?php echo $i; ?>" >
                              <input type="checkbox" name="checkfeatured[]" id="checkfeatured<?php echo $i; ?>" <?php if($data['featured']==1){ ?> checked <?php } ?> >
                         </td>    
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
    			<li><a href="featured.php?page=<?php echo $page-1;?>">Prev</a></li>
          	</ul>
    <?php
			}
			for($i=1;$i<=$pages;$i++){
				if($i<4 || $i>$pages-3 || $i==$page || $i==$page-1 || $i==$page+1 || $i==$page-2 || $i==$page+2){
	?>	
    		<ul class="pagination pagination-sm">
    			<li <?php if($i==$page){echo "class='active'";} ?>>
                	<a href="featured.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
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
    			<li><a href="featured.php?&page=<?php echo $page+1;?>">Next</a></li>
          	</ul>
    <?php
			}
	?>
    	</td>
    </tr>
    <?php
		}
	} //if closed
					
   
		?>
</table>
   </div>
   <div class="row">
      <div class="col-lg-8">	
       <div class="form-group">
          <div class="col-lg-offset-2 col-lg-10">
              <input type="hidden" id="count" value="<?php echo $i; ?>">
              <button class="btn btn-primary" type="submit" name="submit">Add Featured</button>
          </div>
      </div>
     </div>
   </div> 
  </form>	                    
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
setTimeout(function(){$("#remove_msg").hide();},2000);
</script>
    <!-- javascripts -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- nice scroll -->
    <script src="js/jquery.scrollTo.min.js"></script>
    <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
   
    <script src="js/scripts.js"></script>
    <script src="../bootstrap/js/icheck.min.js"></script> 
    <script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
  
  function checkThis(){
	  var count=$('#count').val();
	  for( var i=1;i<=count;i++){ 
		var check="#checkfeatured"+i;
		var featured="#featured"+i;
		
	    if($(check).is(':checked')){
		  $(featured).val('on');
		 }else{ $(featured).val('off');}
	  }
  }
</script>   


  </body>
</html>
