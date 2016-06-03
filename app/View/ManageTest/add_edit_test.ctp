
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
		echo $this->Form->create('Test', array('id'=>'addEditTestForm', 'url'=>$action, 'type'=>'post'));
		
		echo $this->Form->input('id',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'hidden', 'id'=>'aow_id', 'value'=>$testId));
		
		$addOrEditStr = 'Add New Specific Test';
		if($testId!=0){
			$addOrEditStr = 'Edit Specific Test';
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
							<a  class="current" href="<?php echo $this->webroot;?>manage_test/add_edit_test"><?php echo $addOrEditStr;?></a>
						</li>
                                                <li id="accountDetails">
							<a  href="<?php echo $this->webroot;?>manage_test/list_test_category">View / Edit Generic Test</a>
						</li>
                                                <li id="accountDetails">
							<a  href="<?php echo $this->webroot;?>manage_test/add_edit_test_category">Add New  Generic Test</a>
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
										<td valign="top">Specific Test Name <span class="red-mark">*</span></td>
										<td valign="top">
											<?php echo $this->Form->input('test_name',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'test_name', 'error'=>false));?><br />
											
											<span class="red-mark" id="error_test_name" style="display:none;" ></span>
									  	</td>
									</tr>
                                                                        
                                                                        <tr class="event_type">
										<td valign="top">Generic Test Name<span class="red-mark">*</span></td>
										<td valign="top">
											<?php 
                                                                                        
                                                                                        echo $this->Form->input('category_id', array('options'=>$category_options,'selected'=>$selectedCategory,'div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'select', 'id' =>'category_id', 'empty'=>'--Select--'));

											?><br/>
											<span class="red-mark" id="error_category_id" style="display:none;" ></span>
									  	</td>
									</tr>
									
									<tr>
										<td valign="top"> Description <span class="red-mark">*</span></td>
										<td valign="top">
											<?php
												
											
                                                                                        
                                                                                       
                                                                                        
                                                                                        echo $this->Form->textarea('description', array('cols'=>23,'rows'=>5,'div'=>false, 'label'=>false, 'class'=>'inputfield', 'id' =>'description'));
											
												
											?><br />
											<span class="red-mark" id="error_description" style="display:none;" ></span>
									  	</td>
									</tr>
								
									<tr class="event_type">
										<td valign="top">Precautions <span class="red-mark">*</span></td>
										<td valign="top">
                                                                                        <?php
                                                                                        echo $this->Form->textarea('precautions', array('cols'=>23,'rows'=>5,'div'=>false, 'label'=>false, 'class'=>'inputfield', 'id' =>'precautions'));
											?><br />
											<span class="red-mark" id="error_precautions" style="display:none;" ></span>
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
												echo $this->Form->submit('save_btn.png', array('class'=>'onhover', 'border' => '0', 'div' =>false, 'onclick' => 'return validate_add_edit_test();')); ?>
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
	$("#error_test_name").hide();
        $("#error_category_id").hide();
        
	$("#error_description").hide();
        $("#error_precautions").hide();
}


function validate_add_edit_test()
{
	//return true;
	hide_errors();
	$("#test_name").val($("#test_name").val().trim());
        $("#description").val($("#description").val().trim());
        $("#precautions").val($("#precautions").val().trim());
	
	var errMessage = new Array();
	var errMessageIndex = new Array();

	//validate department name
	if( $("#test_name").val() == '' ) {
		errMessage.push('Please enter data for specific test name.');
		errMessageIndex.push('test_name');
	}
        
        if($("#category_id").val()==""){
		errMessage.push('Please select data for generic test name.');
		errMessageIndex.push('category_id');
		
	}
	if($("#description").val()==""){
		errMessage.push('Please enter data for description.');
		errMessageIndex.push('description');
		
	}
	
        if($("#precautions").val()==""){
		errMessage.push('Please enter data for precautions.');
		errMessageIndex.push('precautions');
		
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
		$("#addEditTestForm").submit();
	}
		
}

</script>