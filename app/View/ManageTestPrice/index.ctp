
<!--Details-box START -->
<div class="details-box">

	<div class="details-box-header">		
		<div class="details-box-left"></div>				
		<div class="details-box-mid">
			<div class="details-icon">
				<?php echo $this->Html->image('details-icon2.png', array('border' => '0')); ?>
			</div>
			<span>Update Clinic Test Price</span>
		</div>				
		<div class="details-box-right"></div>				
	</div>
	
	<div class="clear"></div>

	<?php
		$action = Configure::read('medtest_root_path').$this->request->url;
		echo $this->Form->create('ClinicTestPrice', array('id'=>'editClinicTestPriceForm', 'url'=>$action, 'type'=>'file'));
		
		
	?>
	
	<table width="100%" cellspacing="0" cellpadding="0" border="0" class="details-box-content">
	<tbody>
	
		<tr>
				<td height="5"></td>
		</tr>
			
		<tr valign="top">
			<td>
				
				<div class="mega-container grey">
					
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
										<td valign="top" width="30%">Clinic Name <span class="red-mark">*</span></td>
										<td valign="top" width="70%">
											<?php  echo $this->Form->input('clinic_id', array('options'=>$clinic_options,'selected'=>'','div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'select','style'=>'width:250px;','id' =>'clinic_id', 'empty'=>'--Select--')); ?><br />
											
											<span class="red-mark" id="error_clinic_id" style="display:none;" ></span>
									  	</td>
									</tr>
                                                                        <tr>
										<td valign="top"> Test Type</td>
										<td valign="top">
											<?php 
											
											echo $this->Form->input('type_id', array('options'=>array('1'=>'Lab','2'=>'Radiology'),'div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'select', 'id' =>'type_id', 'empty'=>'--Select--'));  ?><br />
											<span class="red-mark" id="error_type_id" style="display:none;" ></span>
									  	</td>
									</tr> 
                                                                                                            
                                                                        
                                                                        <tr>
										<td valign="top"> Price Actual Update<span class="red-mark">*</span></td>
										<td valign="top">
											<?php 
                                                                                        
                                                                                        echo $this->Form->input('price_actual_percentage_val', array('options'=>array('1'=>'Percentage','2'=>'Value'),'selected'=>'1','div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'select', 'id' =>'price_actual_percentage_val', 'empty'=>false)).'&nbsp;';
                                                                                        echo $this->Form->input('price_actual_update_type', array('options'=>array('1'=>'Increase','2'=>'Decrease'),'selected'=>'1','div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'select', 'id' =>'price_actual_update_type', 'empty'=>false)).'&nbsp;'; 
                                                                                        
                                                                                        echo $this->Form->input('price_actual_update',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'price_actual_update', 'error'=>false,'value'=>0));  ?>  ( Eg: 10 )<br />
											<span class="red-mark" id="error_price_actual_update" style="display:none;" ></span>
									  	</td>
									</tr>
                                                                        <tr>
										<td valign="top">Price Offer Update<span class="red-mark">*</span></td>
										<td valign="top">
											<?php
                                                                                        echo $this->Form->input('price_offer_percentage_val', array('options'=>array('1'=>'Percentage','2'=>'Value'),'selected'=>'1','div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'select', 'id' =>'price_offer_percentage_val', 'empty'=>false)).'&nbsp;';
                                                                                        echo $this->Form->input('price_offer_update_type', array('options'=>array('1'=>'Increase','2'=>'Decrease'),'selected'=>'1','div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'select', 'id' =>'price_offer_update_type', 'empty'=>false)).'&nbsp;';
                                                                                        
                                                                                        echo $this->Form->input('price_offer_update',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'price_offer_update', 'error'=>false,'value'=>0));  ?>  ( Eg : 10 )<br />
											<span class="red-mark" id="error_price_offer_update" style="display:none;" ></span>
									  	</td>
									</tr>
                                                                       
                                   
                                                                        <tr>
										<td colspan="2" align="">
                                                                               <span class="red-mark" style="font-size:15px;font-weight:bold">Note : Offer Price Percentage update is based on the value of actual price.<br/></span> 
                                                                                <span class="red-mark" style="font-size:15px;font-weight:bold">Please update prices carefully. It will update prices of all tests under a clinic.</span> 
                                                                                <span style="margin-left:380px">
											<?php
												echo $this->Form->submit('save_btn.png', array('class'=>'onhover', 'border' => '0', 'div' =>false, 'onclick' => 'return validate_add_edit_clinic_test();')); ?>
											<?php echo $this->Html->image('cancel_btn.png', array('class'=>'onhover', 'border' => '0', 'onclick'=>'do_cancel();' )); ?>
										</span>
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
	window.location = "<?php echo $this->webroot; ?>manage_test_price/index";
}

function hide_errors()
{
	$("#error_clinic_id").hide();
        $("#error_price_actual_update").hide();
        $("#error_price_offer_update").hide();
       

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
        
       
	
	if( $("#price_actual_update").val() == '' ) {
		errMessage.push('Please enter data for price actual update.');
		errMessageIndex.push('price_actual_update');
	}
	if( $("#price_offer_update").val() == '' ) {
		errMessage.push('Please enter data for price offer update.');
		errMessageIndex.push('price_offer_update');
	}
        
        if($("#price_actual_update").val() == '0' &&  $("#price_offer_update").val() == '0'){
            errMessage.push('Please enter valid data for update.It should be higher than 0.');
            errMessageIndex.push('price_offer_update');
        
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
               
                var c = confirm('Are you sure to update all test prices under selected clinic?');
            
                if(c){
                    $("#editClinicTestPriceForm").submit();
                }else{
                    do_cancel();
                }    
	}
		
}

</script>