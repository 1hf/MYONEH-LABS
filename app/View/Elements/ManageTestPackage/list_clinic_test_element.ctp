<?php if(!empty($clinicTestLists)){ ?>

<div class="multiselect">
   <?php foreach($clinicTestLists as $tests){
	   //debug($pkgTestIds);
	    $test_id=$tests['tests']['id'];
	   ?>
    <label><input type="checkbox" <?php if(in_array($test_id,$pkgTestIds)) echo 'checked="checked"'; else echo ''; ?>  name="test_id[]" value="<?php echo $tests['tests']['id'];?>" /><?php echo $tests['tests']['test_name'];?></label>
    
   <?php } ?>
</div>
<?php } ?>


