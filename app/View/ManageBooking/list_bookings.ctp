<?php
	echo $this->Html->script("jquery.blockUI.js");
	echo $this->Html->script("jquery.json-2.2.min.js");
	echo $this->Html->script("jquery-ui-1.8.16.custom.min.js");
	//echo $this->Html->css("jquery-ui-1.8.16.custom.css");
        echo $this->Html->script("datepickr.js");
        echo $this->Html->css("datepickr.css");
        
        
	
?>


<!--Details-box2 Start -->
<div class="details-box">

	<div class="details-box-header">
		<div class="details-box-left"></div>
		<div class="details-box-mid">
			<div class="details-icon">
				<?php echo $this->Html->image('details-icon2.png', array('border' => '0')); ?>
			</div>
			<span>View Bookings</span>
		</div>
		<div class="details-box-right"></div>
	</div>

	<div class="clear"></div>

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
							<a class="current" href="<?php echo $this->webroot;?>manage_booking/list_bookings">View Booking Details </a>
						</li>
						
						
					</ul>
				</div>
				
				<div class="clear"></div>
					
				<div id="tab2" class="tab_content1">
					<?php
						echo $this->Form->create('searchClinicForm', array('id'=>'searchClinicForm', 'onsubmit' => 'javascript: return search_clinic();'));
					?>
					<table cellspacing="1" cellpadding="0" border="0" bgcolor="#ffffff" width="100%" style="border: 1px solid rgb(230, 229, 235);" class="formstyle">
					<tbody>
						<tr>
							<td>
								<table cellspacing="1" cellpadding="7" border="0" width="100%" class="tablestyle">
								<tbody>
									
                                                                        <tr>
                                                                                <td width="20%" class="text">Clinic</td>
										<td width="29%" class="textfield">
											<?php
												
												
												echo $this->Form->input('clinic_id', array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'select', 'id' =>'clinic_id','options'=>$clinic_options, 'empty'=>'--Select--'));
											?>
										</td>
                                                                                <td width="20%" class="text">Area</td>
										<td width="29%" class="textfield">
											<?php echo $this->Form->input('area_id', array('options'=>$area_options,'div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'select', 'id' =>'area_id', 'empty'=>'--Select--')); ?>
										</td>
                                                                        </tr>
                                                                        <tr>
										<td width="15%" class="text">Patient Name</td>
										<td width="25%" class="textfield">
											<?php echo $this->Form->input('patient_name',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'patient_name'));?>
										</td>
										<td width="13%" class="text">Patient Mobile</td>
										<td width="25%" class="textfield">
											<?php echo $this->Form->input('patient_mobile',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'patient_mobile'));?>
										</td>
																				
									</tr>
                                                                        <tr>
										<td width="15%" class="text">Patient Email</td>
										<td width="25%" class="textfield">
											<?php echo $this->Form->input('patient_email',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'patient_email'));?>
										</td>
										<td width="13%" class="text">Conact Person Name</td>
										<td width="25%" class="textfield">
											<?php echo $this->Form->input('contact_name',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'contact_name'));?>
										</td>
																				
									</tr>
                                                                        <tr>
										<td width="15%" class="text">Contact Mobile</td>
										<td width="25%" class="textfield">
											<?php echo $this->Form->input('contact_mobile',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'contact_mobile'));?>
										</td>
										<td width="13%" class="text">Contact Email</td>
										<td width="25%" class="textfield">
											<?php echo $this->Form->input('contact_email',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'contact_email'));?>
										</td>
																				
									</tr>
                                                                        <tr>
										<td width="15%" class="text">Voucher Id</td>
										<td width="25%" class="textfield">
											<?php echo $this->Form->input('voucher_unique_text',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'voucher_unique_text'));?>
										</td>
										<td width="13%" class="text">Test/Package</td>
										<td width="25%" class="textfield">
											<?php echo $this->Form->input('test_package',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'test_package'));?>
										</td>
																				
									</tr>
                                                                        <tr>
										<td width="15%" class="text">Booking Date From</td>
										<td width="25%" class="textfield">
											<?php echo $this->Form->input('booking_date_from',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'booking_date_from'));?>
										</td>
										<td width="13%" class="text">Booking Date To</td>
										<td width="25%" class="textfield">
											<?php echo $this->Form->input('booking_date_to',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'booking_date_to'));?>
										</td>
																				
									</tr>
                                                                        <tr>
                                                                               <td colspan="2" align="left">
                                                                                </td>   
                                                                                <td colspan="2" align="left">
											<?php
												echo $this->Form->submit('search_btn.png', array('id'=>'searchButton', 'border' => '0', 'div' =>false, 'onclick' => 'return search_booking();')); ?>
										</td>
                                                                            
                                                                        </tr>
                                                                        
								</tbody>
								</table>
							</td>
						</tr>
					</tbody>
					</table>
					<?php echo $this->Form->end(); ?>
				
					<div id="listContainer">
						<?php echo $this->Element('ManageBooking/list_booking_element'); ?>
					</div>
					
				</div>

			</td>
		</tr>
	</tbody>
	</table>
		
	<div class="clear"></div>
	<div class="details-box-btm"></div>
	<div id="confirmChangeStatus" title="Confirm Change Status" style="display:none;">
		<table width="100%" cellspacing="0" cellpadding="7" border="0" class="tble_head">
			<tr>
				<td valign="top" class="text">
					Are you sure you want to change the clinic status..?
				</td>				
			</tr>
		</table>
	</div>
	
	<div id="confirmDelete" title="Confirm Delete" style="display:none;">
		<table width="100%" cellspacing="0" cellpadding="7" border="0" class="tble_head">
			<tr>
				<td valign="top" class="text">
					Are you sure you want to delete this clinic..?
				</td>				
			</tr>
		</table>
	</div>
	
	<div id="show_error"></div>

	
	<div id="load_add_form">

	
	</div>



</div>

<script type="text/javascript">
var url = 'manage_booking/list_booking_element/';

$(document).ready(function(){
    
    
    datepickr('#booking_date_from', { dateFormat: 'd-m-Y'});
    
    datepickr('#booking_date_to', { dateFormat: 'd-m-Y'});
    
    
    jString = get_json_string_for_searchBooking();	
});


function get_json_string_for_searchBooking()
{
	var clinic_id = $('#clinic_id').val();
	var area_id = $('#area_id').val();
	var patient_name = $('#patient_name').val();	
	patient_name = patient_name.replace(" ","_RemSp_");
	var patient_email = $('#patient_email').val();	
	patient_email = patient_email.replace(" ","_RemSp_");
	var patient_mobile = $('#patient_mobile').val();	
	patient_mobile = patient_mobile.replace(" ","_RemSp_");
	var contact_name = $('#contact_name').val();	
	contact_name = contact_name.replace(" ","_RemSp_");
	var contact_email = $('#contact_email').val();	
	contact_email = contact_email.replace(" ","_RemSp_");
	var contact_mobile = $('#contact_mobile').val();	
	contact_mobile = contact_mobile.replace(" ","_RemSp_");
	var voucher_unique_id = $('#voucher_unique_text').val();	
	voucher_unique_id = voucher_unique_id.replace(" ","_RemSp_");
	var booking_date_from = $('#booking_date_from').val();	
	booking_date_from = booking_date_from.replace(" ","_RemSp_");
	var booking_date_to = $('#booking_date_to').val();	
	booking_date_to = booking_date_to.replace(" ","_RemSp_");
	var test_package = $('#test_package').val();	
	test_package = test_package.replace(" ","_RemSp_");
	
	var filter = {
					clinic_id:clinic_id,
					area_id:area_id,
					patient_name:patient_name,
					patient_email:patient_email,
					patient_mobile:patient_mobile,
					contact_name:contact_name,
					contact_email:contact_email,
					contact_mobile:contact_mobile,
					voucher_unique_id:voucher_unique_id,
					booking_date_from:booking_date_from,
					booking_date_to:booking_date_to,
					test_package:test_package	
					
					};
	jString = $.toJSON(filter);
	return jString;
}

function search_booking()
{
	var jString = get_json_string_for_searchBooking();

	var searchUrl = medtest_root_path+"manage_booking/list_booking_element/";	
	show_loading();
	$.post(
		searchUrl,
		{jString:jString},
		function(responseText)
		{
			$("#listContainer").html(responseText);
			hide_loading();	
		}		
	);
		
	return false;	
}


function get_json_string(action, clinic_id, currentStatus, statusIndex)
{
	changeStatusTo = 0;
	if(action == "ChangeStatus"){
		changeStatusTo = $("#status_id_"+statusIndex).val();
	}	
	
	var filter = {
				 action:action,
				 clinic_id:clinic_id,
				 changeStatusTo:changeStatusTo};
	jString = $.toJSON(filter);
	
	return jString;
}

function perform_operation_clinic_status(action, clinic_id,currentStatus,statusIndex)
{
	var jString = get_json_string(action, clinic_id, currentStatus,0);

	var status_url = medtest_root_path+'manage_clinic/perform_operation_clinic_status/';
	var redirect_url = medtest_root_path+'manage_clinic/list_clinics/';
	var data = {clinicId : clinic_id,currentStatus:currentStatus};	
	if(action == "ChangeStatus")
	{
		$('#confirmChangeStatus').dialog({
		//autoOpen: true,
		modal: true,
		width: 600,
		buttons: {
				"Yes": function(){
					$.ajax
					({
						type	: 'post',
						url		: status_url,
						data	: data,
						async	: false,
						success : function(response)
						{
							if(response.length != 0){
								//alert(response);
								if (response != '') {
									//alert(alert_msg);
									window.location.href=redirect_url;
								}
								//$('#delete_response').html(response);
							}
							// this is for unblocking tat preloader 
							//hide_loading(); 
						},
						error:function(XMLHttpRequest, textStatus, errorThrown)
						{
							alert(textStatus+' '+errorThrown);
						}
					});
				}, 
				"No": function(){
					$("#status_id_"+statusIndex).val(currentStatus);
					$(this).dialog("close");
				} 
			}
		});
	}


	else
	{
		window.location = medtest_root_path+"manage_clinic/list_clinics/?jString="+jString;
	}
	
	
	return false;	
}

function perform_delete(categoryId)
{
	//var jString = get_json_string(action, categoryId, currentStatus,0);

	var status_url = medtest_root_path+'event_category/delete_event_category/';
	var redirect_url = medtest_root_path+'event_category/list_eventcategories/';

	var data = {categoryId : categoryId};

	
	if(categoryId != "")
	{
		$('#confirmDelete').dialog({
		//autoOpen: true,
		modal: true,
		width: 600,
		buttons: {
				"Yes": function(){
					$.ajax
					({
						type	: 'post',
						url		: status_url,
						data	: data,
						async	: false,
						success : function(response)
						{
							if(response.length != 0){
								//alert(response);
								if (response != '') {
									//alert(alert_msg);
									window.location.href=redirect_url;
								}
								//$('#delete_response').html(response);
							}
							// this is for unblocking tat preloader 
							//hide_loading(); 
						},
						error:function(XMLHttpRequest, textStatus, errorThrown)
						{
							alert(textStatus+' '+errorThrown);
						}
					});
				}, 
				"No": function(){
					//$("#status_id_"+statusIndex).val(currentStatus);
					$(this).dialog("close");
				} 
			}
		});
	}


	else
	{
		//window.location = medtest_root_path+"event_category/list_eventcategories/?jString="+jString;
	}
	
	
	return false;	
}

</script>
