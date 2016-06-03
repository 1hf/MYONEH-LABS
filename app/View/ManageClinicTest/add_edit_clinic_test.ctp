
<!--Details-box START -->
<div class="details-box">

	<div class="details-box-header">		
		<div class="details-box-left"></div>				
		<div class="details-box-mid">
			<div class="details-icon">
				<?php echo $this->Html->image('details-icon2.png', array('border' => '0')); ?>
			</div>
			<span>Manage Clinic Test</span>
		</div>				
		<div class="details-box-right"></div>				
	</div>
	
	<div class="clear"></div>

	<?php
		$action = Configure::read('medtest_root_path').$this->request->url;
		echo $this->Form->create('ClinicTest', array('id'=>'addEditClinicTestForm', 'url'=>$action, 'type'=>'file'));
		
		echo $this->Form->input('id',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'hidden', 'id'=>'aow_id', 'value'=>$clinic_test_id));
		
		$addOrEditStr = 'Add New Clinic Test';
		if($clinic_test_id!=0){
			$addOrEditStr = 'Edit Clinic Test';
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
							<a class="current" href="<?php echo $this->webroot;?>manage_clinic_test/list_clinic_tests">View / Edit Clinic Test</a>
						</li>
						<li id="accountDetails">
						<a  href="<?php echo $this->webroot;?>manage_clinic_test/add_edit_clinic_test"><?php echo $addOrEditStr;?></a>
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
										<td valign="top">Clinic Name <span class="red-mark">*</span></td>
										<td valign="top">
											<?php  echo $this->Form->input('clinic_id', array('options'=>$clinic_options,'selected'=>$selectedClinic,'div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'select','style'=>'width:250px;','id' =>'clinic_id', 'empty'=>'--Select--')); ?><br />
											
											<span class="red-mark" id="error_clinic_id" style="display:none;" ></span>
									  	</td>
									</tr>
                                   <tr>
										<td valign="top"> Test Generic Name<span class="red-mark">*</span></td>
										<td valign="top">
											<?php  echo $this->Form->input('test_category_id', array('options'=>$test_category_options,'selected'=>$selectedTestCategory,'div'=>false, 'label'=>false, 'class'=>'inputfield','style'=>'width:250px;', 'type'=>'select', 'id' =>'test_category_id', 'empty'=>'--Select--','onchange'=>'loadSpecificTest(this.value);'));  ?><br />
											<span class="red-mark" id="error_test_category_id" style="display:none;" ></span>
									  	</td>
									</tr>                                     
                                    <tr>
										<td valign="top"> Test Specific Name<span class="red-mark">*</span></td>
										<td valign="top">
											<?php  echo $this->Form->input('test_id', array('selected'=>$selectedTest,'div'=>false, 'label'=>false, 'class'=>'inputfield','style'=>'width:250px;', 'type'=>'select', 'id' =>'test_id', 'empty'=>'--Select--'));  ?><br />
											<span class="red-mark" id="error_test_id" style="display:none;" ></span>
									  	</td>
									</tr>
                                    <tr>
										<td valign="top"> Price Actual <span class="red-mark">*</span></td>
										<td valign="top">
											<?php  echo $this->Form->input('price_actual',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'price_actual', 'error'=>false));  ?><br />
											<span class="red-mark" id="error_price_actual" style="display:none;" ></span>
									  	</td>
									</tr>
                                    <tr>
										<td valign="top">Price Offer<span class="red-mark">*</span></td>
										<td valign="top">
											<?php  echo $this->Form->input('price_offer',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'price_offer', 'error'=>false));  ?><br />
											<span class="red-mark" id="error_price_offer" style="display:none;" ></span>
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
										<td valign="top">Home Collection <span class="red-mark">*</span></td>
										<td valign="top">
											<?php 
											
											echo $this->Form->input('home_collection', array('options'=>array('1'=>'Yes','0'=>'No'),'div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'select', 'id' =>'home_collection', 'empty'=>'--Select--'));  ?><br />
											<span class="red-mark" id="error_home_collection" style="display:none;" ></span>
									  	</td>
									</tr>
                                                                        <tr>
										<td colspan="3" align="right">
											<?php
												echo $this->Form->submit('save_btn.png', array('class'=>'onhover', 'border' => '0', 'div' =>false, 'onclick' => 'return validate_add_edit_clinic_test();')); ?>
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
    var selected_category_id = '<?php echo $selectedTestCategory;?>';
    var selected_test_id = '<?php echo $selectedTest;?>';
    if(selected_category_id!=''){
        loadSpecificTest(selected_category_id,selected_test_id);
    }    
});

function loadSpecificTest(category_id,selected_test_id){
	if(category_id!=""){        
	var url = "<?php echo $this->webroot;?>manage_clinic_test/load_specific_test";
	
	
	$.post(
                url,
                {category_id:category_id},
		
		function(responseText)
		{ 
			$('#test_id').empty(); 
			$('#test_id').append($('<option/>').attr("value","").text("select"));
                        
			for (var i = 0, len = responseText.length; i < len; ++i) {
			     var item = responseText[i];
                             
                             if(selected_test_id!="" && selected_test_id==item.Test.id){   
                                  $('#test_id').append(
			    	        
			    	$('<option></option>').val(item.Test.id).html(item.Test.test_name).prop('selected', true)
                                );
                             }else{
                                 $('#test_id').append(
			    	        
			    	$('<option></option>').val(item.Test.id).html(item.Test.test_name)
                                );
                             }
			     
			 }


		},"json"			
	);
        }
	
}

												
function do_cancel()
{
	window.location = "<?php echo $this->webroot; ?>manage_clinic_test/list_clinic_tests";
}

function hide_errors()
{
	$("#error_clinic_id").hide();
	$("#error_test_id").hide();
        $("#error_price_actual").hide();
        $("#error_price_offer").hide();
        $("#error_home_collection").hide();

}

function validate_add_edit_clinic_test()
{
	//return true;
	hide_errors();
	$("#clinic_id").val($("#clinic_id").val().trim());
	
	var errMessage = new Array();
	var errMessageIndex = new Array();

	//validate department name
	if( $("#clinic_id").val() == '' ) {
		errMessage.push('Please enter data for Clinic name.');
		errMessageIndex.push('clinic_id');
	}
        
        if( $("#test_category_id").val() == '' ) {
		errMessage.push('Please select data for test generic name.');
		errMessageIndex.push('test_category_id');
	}
        
	if( $("#test_id").val() == '' ) {
		errMessage.push('Please select data for test specific name.');
		errMessageIndex.push('test_id');
	}
	
	if( $("#price_actual").val() == '' ) {
		errMessage.push('Please enter data for price actual.');
		errMessageIndex.push('price_actual');
	}
	if( $("#price_offer").val() == '' ) {
		errMessage.push('Please enter data for price offer.');
		errMessageIndex.push('price_offer');
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
		$("#addEditClinicTestForm").submit();
	}
		
}

</script>