<?php if(!empty($id)){ ?>
<div class="form-group product-item">
<label for="fullname" class="control-label col-lg-2"></label>
<div class="col-lg-2"><b><center>Copy Name</center></b></div><div class="col-lg-1"><b><center>Pages</center></b></div> <div class="col-lg-2"><b><center>Quality</center></b></div><div class="col-lg-1"><b><center>Quantity</center></b></div><div class="col-lg-1"><b><center>MRP</center></b></div><div class="col-lg-1"><b><center>Discount(%)</center></b></div>
</div>
<?php } ?>

<div class="form-group product-item">
<label for="fullname" class="control-label col-lg-2"></label>
<input type="hidden" name="id" value="<?php echo $id ?>">
<div <?php if(!empty($id)){ ?> style="display:none;"  <?php } ?> class="col-lg-1"><input type="checkbox" name="copy_index[]" class="form-control" /></div>
<div class="col-lg-2"><input type="text" <?php if(!empty($id)){ ?> name="copy_name" <?php }else{ ?> name="copy_name[]" <?php } ?>class="form-control" placeholder="Copy Name"  value="<?php if(!empty($cpy['copy_name'])){ echo $cpy['copy_name']; } ?>" /></div>

<div class="col-lg-1"><input type="text" <?php if(!empty($id)){ ?> name="pages" <?php }else{ ?> name="pages[]" <?php } ?> class="form-control" placeholder="Pages"   value="<?php if(!empty($cpy['pages'])){ echo $cpy['pages']; } ?>" /></div>

<div class="col-lg-2"><input type="text" <?php if(!empty($id)){ ?> name="quality" <?php }else{ ?> name="quality[]" <?php } ?> class="form-control" placeholder="Quality" value="<?php if(!empty($cpy['quality'])){ echo $cpy['quality']; } ?>" /></div>

<div class="col-lg-1"><input type="number" <?php if(!empty($id)){ ?> name="quantity" <?php }else{ ?> name="quantity[]" <?php } ?> class="form-control" placeholder="Quantity" value="<?php if(!empty($cpy['quantity'])){ echo $cpy['quantity']; } ?>" /></div>

<div class="col-lg-1"><input type="text" onKeyUp="checkPrice(this.value)" <?php if(!empty($id)){ ?> name="price" <?php }else{ ?> name="price[]" <?php } ?> class="form-control" placeholder="MRP."    value="<?php if(!empty($cpy['mrp'])){ echo $cpy['mrp']; } ?>" /></div>

<div class="col-lg-1"><input type="number" <?php if(!empty($id)){ ?> name="discount" <?php }else{ ?> name="discount[]" <?php } ?> class="form-control" placeholder="Discount%"  value="<?php if(!empty($cpy['discount'])){ echo $cpy['discount']; } ?>"  /></div>
</div>
<script>
function checkPrice(str){
			var mobile=str;
			var lastChar = mobile[mobile.length -1];
			if(lastChar=='.'){return false;}
			if(mobile!=''){mobile=parseFloat(mobile);}
			if(isNaN(mobile)){mobile=''; alert("Enter Valid Price!");}
			$(event.target).val(mobile)
		}
</script>