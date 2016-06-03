<?php if(!empty($package_categories)){ ?>

<div class="multiselect">
   <?php foreach($package_categories as $category){
	   //debug($category);
	   //debug($pkgCategoriesSelected);
	   ?>
    <label><input type="checkbox" <?php if(in_array($category,$pkgCategoriesSelected)) echo 'checked="checked"'; else echo ''; ?>  name="category_ids[]" value="<?php echo $category;?>" /><?php echo $category;?></label>
    
   <?php } ?>
</div>
<?php } ?>


