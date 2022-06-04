<?php 
session_start();
if(isset($_SESSION['role']))
{
	$role=$_SESSION['role'];
}
include_once "class/search.php";
$obj=new Search();
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

    <title>BMS | Book Lists</title>

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
    
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
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
					<h3 class="page-header"><i class="fa fa-files-o"></i>Book Lists</h3>
                   
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
                    
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
						<li><i class="icon_document_alt"></i>Book</li>
						<li><i class="fa fa-files-o"></i>Book Lists</li>
					</ol>
				</div>
			</div>
              <!-- Form validations -->              
       <div class="row">
       <form action="" method="post">
         <div class="col-lg-1">Choose School</div>
           <div class="col-lg-3">
              <select class="form-control select2" id="school" onChange="searchResult();">
                 <option value="">--Select One--</option>
                  <?php 
				           $sch=$obj->get_all_school();
							foreach($sch as $val):
							?>
                            <option value="<?php echo $val['id']; ?>"><?php echo $val['name'] ?></option>
                 <?php endforeach; ?>
              </select>
           </div>
           <div class="col-lg-1">Select Class</div>
           <div class="col-lg-2">
              <select class="form-control select2" id="cls" onChange="searchResult();">
                 <option value="">--Select One--</option>
                  <?php 
				           $cls=$obj->get_all_class();
							foreach($cls as $val):
							?>
                            <option value="<?php echo $val['id']; ?>"><?php echo $val['class'] ?></option>
                 <?php endforeach; ?>
              </select>
           </div>
        </form>   
       </div>    
       <div class="row">
       <div class="col-lg-12" id="search-result">
                 
          <div class="table-responsive" style="width:100%">
          <table class="table table-hover table-stripped" >
			   <thead>
			     <th style="text-align:center">Serial No.</th>
                 <th style="text-align:center">School</th>
                 <th style="text-align:center">Class</th>
                 <th style="text-align:center">Subject Type</th>
				 <th style="text-align:center"> Book Name</th>
                 <th style="text-align:center">MRP</th>
                 <th style="text-align:center">Discount</th>
                 <th style="text-align:center">Cost</th>
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
			
			$sql="select t1.id as book_id,t1.name as book,t1.mrp,t1.discount,t1.cost,t2.name as subject,t3.class,t4.name as school from tbl_books t1,tbl_subject t2,tbl_class t3,tbl_school t4 where t1.subject_id=t2.id and t1.class_id=t3.id and t1.school_id=t4.id order by t1.id asc limit $offset,$count";
			$sql1="select count(id) as count from tbl_books";
			
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
						 <td align="center"><?php echo ++$sno;?></td>
                         <td align="center"><?php echo $result['school'];?></td>
                         <td align="center"><?php echo $result['class'];?></td>
                         <td align="center"><?php echo $result['subject'];?></td>
						 <td align="center"><?php echo $result['book'];?></td>
                         <td align="center"><?php echo "₹ ".$result['mrp'];?></td>
                         <td align="center"><?php echo $result['discount']."%";?></td>
                         <td align="center"><?php echo "₹ ".$result['cost'];?></td>
						 <td align="center">
                             <a href="edit_book.php?id=<?php echo $result['book_id']; ?>" class="fa fa-edit"></a>&nbsp;&nbsp;
                             <a href="delete_book.php?id=<?php echo $result['book_id'];?>" class="fa fa-trash-o" onClick="return confirmDelete();"></a>
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
    			<li><a href="book_list.php?page=<?php echo $page-1;?>">Prev</a></li>
          	</ul>
    <?php
			}
			for($i=1;$i<=$pages;$i++){
				if($i<4 || $i>$pages-3 || $i==$page || $i==$page-1 || $i==$page+1 || $i==$page-2 || $i==$page+2){
	?>	
    		<ul class="pagination pagination-sm">
    			<li <?php if($i==$page){echo "class='active'";} ?>>
                	<a href="book_list.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
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
    			<li><a href="book_list.php?&page=<?php echo $page+1;?>">Next</a></li>
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
  
<script src="plugins/select2/select2.full.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    
  });
</script>
<script>
setTimeout(function(){$("#remove_msg").hide();},1000);
</script>

<script>

function searchResult()
{
	var school=$('#school').val();
	var cls=$('#cls').val();
	var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
			if (xhttp.readyState == 4 && xhttp.status == 200) {
			 document.getElementById("search-result").innerHTML = xhttp.responseText;
			}
		  };
		  xhttp.open("GET", "book_search.php?school="+school+"&cls="+cls, true);
		  xhttp.send();
}



function confirmDelete(){
			if(confirm("Are you sure you want to delete this Book?")){
				return true;
			}else{return false;}
		}
</script>   

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
