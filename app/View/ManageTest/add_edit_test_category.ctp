
<!--Details-box START -->
<div class="details-box">

	<div class="details-box-header">		
		<div class="details-box-left"></div>				
		<div class="details-box-mid">
			<div class="details-icon">
				<?php echo $this->Html->image('details-icon2.png', array('border' => '0')); ?>
			</div>
			<span>Manage Test Master</span>
		</div>				
		<div class="details-box-right"></div>				
	</div>
	
	<div class="clear"></div>

	<?php
		$action = Configure::read('medtest_root_path').$this->request->url;
		echo $this->Form->create('TestCategory', array('id'=>'addEditTestCategoryForm', 'url'=>$action, 'type'=>'post'));
		
		echo $this->Form->input('id',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'hidden', 'id'=>'aow_id', 'value'=>$testCategoryId));
		
		$addOrEditStr = 'Add New Generic Test';
		if($testCategoryId!=0){
			$addOrEditStr = 'Edit Generic Test';
		}
	?>
	
	<table width="100%" cellspacing="0" cellpadding="0" border="0" class="details-box-content">
	<tbody>
	
		<tr>
				<td height="5"></td>
		</tr>
			
		<tr valign="top">
			<td>
				
				<div class="mega-container grey">
					<ul class="mega-menu" style="margin-left: 4px;">
						<li id="personalDetails">
							<a  href="<?php echo $this->webroot;?>manage_test/list_tests">View / Edit Specific Test </a>
						</li>
						<li id="accountDetails">
							<a  href="<?php echo $this->webroot;?>manage_test/add_edit_test">Add Specific Test</a>
						</li>
                                                <li id="accountDetails">
							<a  href="<?php echo $this->webroot;?>manage_test/list_test_category">View / Edit Generic Test</a>
						</li>
                                                <li id="accountDetails">
							<a  class="current" href="<?php echo $this->webroot;?>manage_test/add_edit_test_category"><?php echo $addOrEditStr; ?></a>
						</li>
						<!--<li id="accountDetails">
							<a  href="<?php echo $this->webroot;?>manage_test/related_tests">Related Tests</a>
						</li>-->
					</ul>
				</div>
				
				<div class="clear"></div>

				<div id="tab2" class="tab_content1">

					<table width="100%" cellspacing="1" cellpadding="0" border="0" bgcolor="#ffffff" class="formstyle" style="border: 1px solid rgb(230, 229, 235);">
					<tbody>
						<tr>
							<td>
								<table width="100%" cellspacing="1" cellpadding="7" border="0" class="tablestyle">
								<tbody>
									<tr class="event_type">
										<td valign="top">Generic Test Name <span class="red-mark">*</span></td>
										<td valign="top">
											<?php echo $this->Form->input('category_name',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'category_name', 'error'=>false));?><br />
											
											<span class="red-mark" id="error_category_name" style="display:none;" ></span>
									  	</td>
									</tr>
									
                                                                        <tr>
										<td valign="top">Test Type <span class="red-mark">*</span></td>
										<td valign="top">
											<?php 
											
											echo $this->Form->input('type_id', array('options'=>array('1'=>'General','2'=>'Radiology'),'div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'select', 'id' =>'type_id', 'empty'=>'--Select--'));  ?><br />
											<span class="red-mark" id="error_type_id" style="display:none;" ></span>
									  	</td>
									</tr>
                                                                        
                                                                        <tr>
										<td valign="top">Home Collection <span class="red-mark">*</span></td>
										<td valign="top">
											<?php 
											
											echo $this->Form->input('home_collection', array('options'=>array('1'=>'Yes','0'=>'No'),'div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'select', 'id' =>'home_collection', 'empty'=>'--Select--'));  ?><br />
											<span class="red-mark" id="error_home_collection" style="display:none;" ></span>
									  	</td>
									</tr>
									 <tr>
										<td valign="top">Seo Tags<span class="red-mark"></span></td>
										<td valign="top">
											<?php  echo $this->Form->input('seo_tags',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'seo_tags', 'error'=>false));  ?><br />
											<span class="red-mark" id="error_seo_tags" style="display:none;" ></span>
									  	</td>
									</tr>
									
									
									
                                                                        <tr>
										<td colspan="3" align="right">
											<?php
												echo $this->Form->submit('save_btn.png', array('class'=>'onhover', 'border' => '0', 'div' =>false, 'onclick' => 'return validate_add_edit_test_category();')); ?>
											<?php echo $this->Html->image('cancel_btn.png', array('class'=>'onhover', 'border' => '0', 'onclick'=>'do_cancel();' )); ?>
										</td>
									</tr>
								</tbody>
								</table>
								
							</td>
						</tr>
						
					</tbody>
					</table>
						
				</div>

			</td>
		</tr>
	</tbody>
	</table>
	<?php echo $this->Form->end(); ?>

	<div class="clear"></div>

	<div class="details-box-btm"></div>
	
	<div id="show_error"></div>
		
</div>
<!--Details-box END -->

<script type="text/javascript" >

$(document).ready(function () {
	
});



												
function do_cancel()
{
	window.location = "<?php echo $this->webroot; ?>event_category/list_eventcategories";
}

function hide_errors()
{
	$("#error_category_name").hide();
        $("#error_test_type").hide();
        $("#error_home_collection").hide();
	
}


function validate_add_edit_test_category()
{
	//return true;
	hide_errors();
	$("#category_name").val($("#category_name").val().trim());
        
	
	var errMessage = new Array();
	var errMessageIndex = new Array();

	//validate department name
	if( $("#category_name").val() == '' ) {
		errMessage.push('Please enter data for generic test name.');
		errMessageIndex.push('category_name');
	}
        
        if( $("#test_type").val() == '' ) {
		errMessage.push('Please select data for test type.');
		errMessageIndex.push('test_type');
	}
        
        if( $("#home_collection").val() == '' ) {
		errMessage.push('Please select data for home collection.');
		errMessageIndex.push('home_collection');
	}

	
        
      

	
	//Display message
	for(i=0; i<errMessageIndex.length; i++) {
		$("#error_"+errMessageIndex[i]).html(errMessage[i]);
		$("#error_"+errMessageIndex[i]).show();
	}

	if(errMessageIndex.length > 0) {
		for(i=0; i<errMessageIndex.length; i++) {
			$("#"+errMessageIndex[i]).focus();
			break;
		}
		return false;
	}
	else {
		$("#addEditTestCategoryForm").submit();
	}
		
}

</script>