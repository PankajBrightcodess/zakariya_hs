<?php if(!empty($id)){ ?>
<div class="form-group product-item">
<label for="fullname" class="control-label col-lg-2"></label>
<div class="col-lg-2"><b><center>Feature</center></b></div>
</div>
<?php } ?>

<div class="form-group product-item">
<label for="fullname" class="control-label col-lg-2"></label>
<input type="hidden" name="id" value="<?php echo $id ?>">
<div <?php if(!empty($id)){ ?> style="display:none;"  <?php } ?> class="col-lg-1"><input type="checkbox" name="category_index[]" class="form-control" /></div>
<div class="col-lg-2"><input type="text" <?php if(!empty($id)){ ?> name="feature" <?php }else{ ?> name="feature[]" <?php } ?>class="form-control" placeholder="Feature"  value="<?php if(!empty($data['feature'])){ echo $data['feature']; } ?>" /></div>

</div>
