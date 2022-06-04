<?php if(!empty($id)){ ?>
<div class="form-group product-item">
<label for="fullname" class="control-label col-lg-2"></label>
<div class="col-lg-2"><b><center>Particulars</center></b></div><div class="col-lg-2"><b><center>Quantity</center></b></div><div class="col-lg-1"><b><center>MRP</center></b></div><div class="col-lg-1"><b><center>Discount(%)</center></b></div>
</div>
<?php } ?>

<div class="form-group product-item">
<label for="fullname" class="control-label col-lg-2"></label>
<input type="hidden" name="id" value="<?php if(!empty($id)){echo $id; } ?>">
<div <?php if(!empty($id)){ ?> style="display:none;"  <?php } ?> class="col-lg-1"><input type="checkbox" name="stationary_index[]" class="form-control" /></div>

<div class="col-lg-2"><input type="text" <?php if(!empty($id)){ ?> name="particulars" <?php }else{ ?> name="particulars[]" <?php } ?> class="form-control" placeholder="Particulars"  value="<?php if(!empty($stationary['particulars'])){ echo $stationary['particulars']; } ?>" /></div>

<div class="col-lg-2"><input type="text" <?php if(!empty($id)){ ?> name="quantity" <?php }else{ ?> name="quantity[]" <?php } ?> class="form-control" placeholder="Quantity"  value="<?php if(!empty($stationary['quantity'])){ echo $stationary['quantity']; } ?>" /></div>

<div class="col-lg-1"><input type="text"  onKeyUp="checkPrice(this.value)" <?php if(!empty($id)){ ?> name="price" <?php }else{ ?> name="price[]" <?php } ?> class="form-control" placeholder="MRP."  value="<?php if(!empty($stationary['mrp'])){ echo $stationary['mrp']; } ?>" /></div>

<div class="col-lg-1"><input type="number" <?php if(!empty($id)){ ?> name="discount" <?php }else{ ?> name="discount[]" <?php } ?> class="form-control" placeholder="Discount%"  value="<?php if(!empty($stationary['discount'])){ echo $stationary['discount']; } ?>"  /></div>
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