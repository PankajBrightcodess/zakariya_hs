
<?php if(!empty($id)){ ?>
<div class="form-group product-item">
<label for="fullname" class="control-label col-lg-2"></label>
<div class="col-lg-3"><b><center>Book Name</center></b></div><div class="col-lg-2"><b><center>MRP</center></b></div> <div class="col-lg-2"><b><center>Discount(%)</center></b></div>
</div>
<?php } ?>

<div class="form-group product-item">
<label for="fullname" class="control-label col-lg-2"></label>
<input type="hidden" name="id" value="<?php echo $id ?>">
<div <?php if(!empty($id)){ ?> style="display:none;"  <?php } ?>class="col-lg-1"><input type="checkbox" name="book_index[]" class="form-control" /></div>

<div class="col-lg-3"><input type="text" <?php if(!empty($id)){ ?> name="book_name" <?php }else{ ?> name="book_name[]" <?php } ?> class="form-control" placeholder="BOOK NAME" value="<?php if(!empty($bk['book'])){ echo $bk['book']; } ?>" /></div>

<div class="col-lg-2"><input type="text" onKeyUp="checkPrice(this.value)" <?php if(!empty($id)){ ?> name="book_price" <?php }else{ ?> name="book_price[]" <?php } ?>class="form-control" placeholder="MRP."  value="<?php if(!empty($bk['mrp'])){ echo $bk['mrp']; } ?>" /></div>

<div class="col-lg-2"><input type="number" <?php if(!empty($id)){ ?> name="book_discount" <?php }else{ ?> name="book_discount[]" <?php } ?>class="form-control" placeholder="Discount(%) Example: 5" value="<?php if(!empty($bk['discount'])){ echo $bk['discount']; } ?>"  /></div>
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