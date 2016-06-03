
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
		echo $this->Form->create('TestRelation', array('id'=>'addEditRelatedTestForm', 'url'=>$action, 'type'=>'post'));
		
		echo $this->Form->input('id',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'hidden', 'id'=>'aow_id', 'value'=>$testId));
		
		$addOrEditStr = 'Add New Test Relation';
		if($testId!=0){
			$addOrEditStr = 'Edit Test Relation';
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
							<a href="<?php echo $this->webroot;?>manage_test/list_tests">View / Edit Test </a>
						</li>
						<li id="accountDetails">
							<a  href="<?php echo $this->webroot;?>manage_test/add_edit_test">Add New Test</a>
						</li>
                                                <li id="accountDetails">
							<a  href="<?php echo $this->webroot;?>manage_test/list_test_category">View / Edit Test Category</a>
						</li>
                                                <li id="accountDetails">
							<a href="<?php echo $this->webroot;?>manage_test/add_edit_test_category">Add New Test Category</a>
						</li>
						<li id="accountDetails">
							<a  class="current" href="<?php echo $this->webroot;?>manage_test/related_tests"><?php echo $addOrEditStr;?></a>
						</li>
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
										<td valign="top">Test Name <span class="red-mark">*</span></td>
										<td valign="top">
											<?php 
                                                                                        echo $this->Form->input('test_id', array('options'=>$test_options,'selected'=>$selectedTest,'div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'select', 'id' =>'test_id', 'empty'=>'--Select--'));
                                                                                        ?>
                                                                                        <br />
											
											<span class="red-mark" id="error_test_id" style="display:none;" ></span>
									  	</td>
									</tr>
									
									<tr>
										<td valign="top"> Related Tests <span class="red-mark">*</span></td>
										<td valign="top">
											<?php
												
											
                                                                                        
                                                                                       
                                                                                        echo $this->Form->input('related_test_id', array('multiple'=>true,'options'=>$related_test_options,'selected'=>$relatedSelectedTest,'div'=>false, 'label'=>false, 'class'=>'inputfield','style'=>'height:200px;' ,'type'=>'select', 'id' =>'related_test_id', 'empty'=>'--Select--'));

												
											?><br />
											<span class="red-mark" id="error_related_test_id" style="display:none;" ></span>
									  	</td>
									</tr>
								
									
									
									
									
                                                                        <tr>
										<td colspan="3" align="right">
											<?php
												echo $this->Form->submit('save_btn.png', array('class'=>'onhover', 'border' => '0', 'div' =>false, 'onclick' => 'return validate_add_edit_test_relation();')); ?>
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
	window.location = "<?php echo $this->webroot; ?>manage_test/list_tests";
}

function hide_errors()
{
	$("#error_test_id").hide();
	$("#error_related_test_id").hide();
       
}


function validate_add_edit_test_relation()
{
	//return true;
	hide_errors();
	
	
	var errMessage = new Array();
	var errMessageIndex = new Array();

	//validate department name
	if( $("#test_id").val() == '' ) {
		errMessage.push('Please select data for test name.');
		errMessageIndex.push('test_id');
	}

       

	if($("#related_test_id").val()=="" || $("#related_test_id").val()==null){
		errMessage.push('Please select data for related test.');
		errMessageIndex.push('related_test_id');
		
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
		$("#addEditRelatedTestForm").submit();
	}
		
}

</script>