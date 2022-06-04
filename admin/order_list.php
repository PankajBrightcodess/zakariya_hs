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

    <title>BMS | Order List</title>

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
					<h3 class="page-header"><i class="fa fa-files-o"></i>Order List</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="icon_document_alt"></i>Orders</li>
						<li><i class="fa fa-files-o"></i>Order List</li>
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
        <a href="exportorder.php" class="btn btn-primary btn-sm" style="margin:15px">Export To Excel</a>
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
			     <th style="text-align:center">Order Id</th>
                 <th style="text-align:center">Order Date</th>
				 <th style="text-align:center">Student Name</th>
                 <th style="text-align:center">Name</th>
                 <th style="text-align:center">Mobile</th>
                 <th style="text-align:center"> Address</th>
                 <th style="text-align:center"> Total Amount</th>
                 <th style="text-align:center">Dispatch Date</th>
                 <th style="text-align:center">Delivery Date</th>
                 <th style="text-align:center">Status</th>
				 <th style="text-align:center">Action</th>
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
			
			$sql="select * from tbl_orders order by id desc limit $offset,$count";
			$sql1="select count(id) as count from tbl_orders";
			
				$rowcount=$conn->query($sql1);
				$data= $rowcount->fetch_assoc();
				$rownum= $data['count'];
				$pages= ceil($rownum/$count);

				     $rs=$conn->query($sql);
					 if($rs->num_rows>0){
						$sno=$offset;
					 while($result=$rs->fetch_array()){
						 ?>
						 <tr title="Click to see more Details">
						 <td align="center"><?php echo $result['id'];?></td>
                         <td align="center"><?php echo date("d-M-Y",strtotime($result['date']));?></td>
						 <td align="center"><?php echo ucwords($result['student_name']);?></td>
                         <td align="center"><?php echo ucwords($result['name']);?></td>
                         <td align="center"><?php echo $result['mobile'];?></td>
                         <?php $address=$result['landmark'].", ".$result['address'].",<br>".$result['postoffice'].", ".$result['district']."-".$result['pincode'].", ".$result['state'].".";?>
                         <td align="center"><?php echo $address; ?></td> 
                        <td align="center"><?php echo toDecimal($result['total_amount']);?></td>
                        <td align="center">
						<?php 
						if($result['dispatch_date']!="0000-00-00"){
							echo date("d-M-Y",strtotime($result['dispatch_date']));
							}else{
								
								echo "-- --- ----";
							}
							?>
                        </td>
                        <td align="center">
						<?php
						if($result['delivered_date']!="0000-00-00")
						{
						 echo date("d-M-Y",strtotime($result['delivered_date']));
						}else{
							echo "-- --- ----";
						}
						 ?>
                        </td> 
                          <td align="center"><?php if($result['status']==0){ ?> <i class="fa fa-check text-primary"> Order Placed.</i>
						           <?php }elseif($result['status']==1){ ?>
									      
                                          <i class="fa fa-check text-info"> Order Dispatched.</i>
									   
                                      <?php
                                      }elseif($result['status']==3){
                                        ?>
                                         <i class="fa fa-times text-danger"> Order Cancelled.</i>
                                        <?php
                                        }else{?>
                                          <i class="fa fa-check text-success"> Order Delivered.</i>
                                        <?php } ?>
                         </td>
						 <td align="center">
                         	
						     <a href="view_order.php?id=<?php echo $result['id']; ?>" class="fa fa-eye <?php if($result['view']==0){echo "text-danger";} ?>"></a>&nbsp;&nbsp;
                             <a href="edit_order.php?id=<?php echo $result['id'];?>" class="fa fa-edit"></a>&nbsp;&nbsp;
                             <a href="print_invoice.php?080f6d7f511a9128d45c370f50291f92=<?php echo md5($result['id']);?>" class="fa fa-print"></a>
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
    			<li><a href="order_list.php?page=<?php echo $page-1;?>">Prev</a></li>
          	</ul>
    <?php
			}
			for($i=1;$i<=$pages;$i++){
				if($i<4 || $i>$pages-3 || $i==$page || $i==$page-1 || $i==$page+1 || $i==$page-2 || $i==$page+2){
	?>	
    		<ul class="pagination pagination-sm">
    			<li <?php if($i==$page){echo "class='active'";} ?>>
                	<a href="order_list.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
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
    			<li><a href="order_list.php?&page=<?php echo $page+1;?>">Next</a></li>
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

function confirmDelete(){
			if(confirm("Are you sure you want to delete this Subject?")){
				return true;
			}else{return false;}
		}
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
		  xhttp.open("GET", "search_orders.php?query="+query, true);
		  xhttp.send();
}


</script>

  </body>
</html>
