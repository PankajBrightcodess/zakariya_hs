<?php 
include "class/product.php";
$category=$_GET['category'];
$obj=new Product();
$data=$obj->get_feature_by_category($category);
$fet=explode(",",$data['feature']);
//print_r($fet);
$cnt=count($fet);
for($i=0;$i<$cnt;$i++)
{
?>
<div class="form-group">
<label for="fullname" class="control-label col-lg-2">Feature</label>

<div class="col-lg-2"><input type="text"  name="feature[]" class="form-control" placeholder="Description Name"  value="<?php echo $fet[$i]; ?>" readonly /></div>

<div class="col-lg-2"><input type="text"  name="value[]"  class="form-control" placeholder="Value" value="" /></div>

</div>
<?php } ?>