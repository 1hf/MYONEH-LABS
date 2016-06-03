
<!--Details-box START -->
<div class="details-box">

	<div class="details-box-header">		
		<div class="details-box-left"></div>				
		<div class="details-box-mid">
			<div class="details-icon">
				<?php echo $this->Html->image('details-icon2.png', array('border' => '0')); ?>
			</div>
			<span>Manage Clinic</span>
		</div>				
		<div class="details-box-right"></div>				
	</div>
	
	<div class="clear"></div>

	<?php
		$action = Configure::read('medtest_root_path').$this->request->url;
		echo $this->Form->create('Clinic', array('id'=>'addEditClinicForm', 'url'=>$action, 'type'=>'file'));
		
		echo $this->Form->input('id',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'hidden', 'id'=>'aow_id', 'value'=>$clinic_id));
		
		$addOrEditStr = 'Add New Clinic';
		if($clinic_id!=0){
			$addOrEditStr = 'Edit Clinic';
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
							<a  href="<?php echo $this->webroot;?>manage_clinic/list_clinics">View / Edit Clinic </a>
						</li>
						<li id="accountDetails">
						<a  class="current" href="<?php echo $this->webroot;?>manage_clinic/add_edit_clinic"><?php echo $addOrEditStr;?></a>
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
											<?php echo $this->Form->input('clinic_name',array('div'=>false, 'label'=>false, 'class'=>'inputfield','style'=>'width:250px;', 'id'=>'clinic_name', 'error'=>false));?><br />
											
											<span class="red-mark" id="error_clinic_name" style="display:none;" ></span>
									  	</td>
									</tr>
                                    <tr>
										<td valign="top"> Email <span class="red-mark">*</span></td>
										<td valign="top">
											<?php  echo $this->Form->input('email_add',array('div'=>false,'maxlength'=>'800', 'label'=>false, 'class'=>'inputfield','style'=>'width:250px;', 'id'=>'email', 'error'=>false));  ?> (Separated By Comma)<br />
											<span class="red-mark" id="error_email" style="display:none;" ></span>
									  	</td>
									</tr>
                                                                        <tr>
										<td valign="top"> Website</td>
										<td valign="top">
											<?php  echo $this->Form->input('website',array('div'=>false, 'label'=>false, 'class'=>'inputfield','style'=>'width:250px;','id'=>'website', 'error'=>false));  ?> (Eg : www.google.com)<br />
											<span class="red-mark" id="error_website" style="display:none;" ></span>
									  	</td>
									</tr>
                                                                         <tr>
										<td valign="top"> Rating <span class="red-mark">*</span></td>
										<td valign="top">
											<?php  echo $this->Form->input('rating',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'rating', 'error'=>false));  ?> (value between 1 and 5)<br />
											<span class="red-mark" id="error_rating" style="display:none;" ></span>
									  	</td>
									</tr>
                                    <tr>
										<td valign="top"> Landline 1 <span class="red-mark">*</span></td>
										<td valign="top">
											<?php  echo $this->Form->input('tel_landline1',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'tel_landline1', 'error'=>false));  ?><br />
											<span class="red-mark" id="error_tel_landline1" style="display:none;" ></span>
									  	</td>
									</tr>
                                    <tr>
										<td valign="top"> Landline 2 <span class="red-mark"></span></td>
										<td valign="top">
											<?php  echo $this->Form->input('tel_landline2',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'tel_landline2', 'error'=>false));  ?><br />
											<span class="red-mark" id="error_tel_landline2" style="display:none;" ></span>
									  	</td>
									</tr>
                                     <tr>
										<td valign="top"> Mobile <span class="red-mark"></span></td>
										<td valign="top">
											<?php  echo $this->Form->input('tel_mobile',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'tel_mobile', 'error'=>false));  ?><br />
											<span class="red-mark" id="error_tel_mobile" style="display:none;" ></span>
									  	</td>
									</tr>
                                    <tr>
										<td valign="top"> Logo <span class="red-mark">*</span></td>
										<td valign="top">
                                        <?php
										if ($this->request->data['Clinic']['logo']!=''){
											$logo_file=$filePath = "upload/clinics/".$this->request->data['Clinic']['id']."/".$this->request->data['Clinic']['logo']; 
										}
										  echo $this->Form->input('logo_file',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'logo_file', 'error'=>false, 'type' => 'file'));  ?> -- 
										  <?php if($this->request->data['Clinic']['logo']!=''){ ?>
       										 <img src="<?php echo $this->webroot.$logo_file;?>" width="77" height="77" >
       									 <?php } ?> <br />
											<span class="red-mark" id="error_logo" style="display:none;" ></span>
									  	</td>
									</tr>
                                    <tr>
										<td valign="top"> Working Hours(Mon- Friday)<span class="red-mark">*</span></td>
										<td valign="top">
											<?php  echo $this->Form->input('mon_fri',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'mon_fri', 'error'=>false));  ?>(eg: 9AM-11AM,1PM-7PM )<br />
											<span class="red-mark" id="error_working_hours" style="display:none;" ></span>
									  	</td>
									</tr>
                                     <tr>
										<td valign="top"> Saturdays <span class="red-mark">*</span></td>
										<td valign="top">
											<?php  echo $this->Form->input('saturday',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'saturday', 'error'=>false));  ?>(eg: 9AM-11AM,2PM-7PM )<br />
											<span class="red-mark" id="error_saturday" style="display:none;" ></span>
									  	</td>
									</tr>
                                    <tr>
										<td valign="top"> Sundays <span class="red-mark">*</span></td>
										<td valign="top">
											<?php  echo $this->Form->input('holidays',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'holidays', 'error'=>false));  ?> (eg: Sunday,Wenesday )<br />
											<span class="red-mark" id="error_holidays" style="display:none;" ></span>
									  	</td>
									</tr>
                                     <tr>
										<td valign="top"> Description </td>
										<td valign="top">
											<?php  echo $this->Form->input('description',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'description', 'error'=>false));  ?><br />
											<span class="red-mark" id="error_description" style="display:none;" ></span>
									  	</td>
									</tr>
                                     <tr>
										<td valign="top"> Reviews <span class="red-mark"></span>  </td>
										<td valign="top">
											<?php  echo $this->Form->input('admin_reviews',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'admin_reviews', 'error'=>false));  ?> <br />(eg: Samrudh: Happy with healthx.in and test.  
                                        	$$ Pooja Sax: Happy with healthx.in and test done.)
											<span class="red-mark" id="error_admin_reviews" style="display:none;" ></span>
									  	</td>
									</tr>
                                     <tr>
										<td valign="top"> Parking Availability</td>
										<td valign="top">
											<?php  											
											echo $this->Form->input('parking', array('options'=>array('1'=>'yes','0'=>'no'),'selected'=>@$this->request->data['Clinic']['parking'],'div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'select', 'id' =>'parking', 'empty'=>'--Select--')); ?><br />
											<span class="red-mark" id="error_parking" style="display:none;" ></span>
									  	</td>
									</tr>
                                    <tr>
										<td valign="top">Home Collection </td>
										<td valign="top">
											<?php 
											
											echo $this->Form->input('home_collection', array('options'=>array('1'=>'yes','0'=>'no'),'selected'=>@$this->request->data['Clinic']['home_collection'],'div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'select', 'id' =>'home_collection', 'empty'=>'--Select--'));  ?><br />
											<span class="red-mark" id="error_home_collection" style="display:none;" ></span>
									  	</td>
									</tr>
                                    <tr>
										<td valign="top"> Home Collection Radius <span class="red-mark"></span></td>
										<td valign="top">
											<?php  echo $this->Form->input('home_collection_radius',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'home_collection_radius', 'error'=>false));  ?> (eg:2 Km)<br />
											<span class="red-mark" id="error_home_collection_radius" style="display:none;" ></span>
									  	</td>
									</tr>
                                      <tr>
										<td valign="top"> Accept Credit Card </td>
										<td valign="top">
											<?php 
											echo $this->Form->input('credit_card', array('options'=>array('1'=>'yes','0'=>'no'),'selected'=>@$this->request->data['Clinic']['credit_card'],'div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'select', 'id' =>'credit_card', 'empty'=>'--Select--'));  ?><br />
											<span class="red-mark" id="error_credit_card" style="display:none;" ></span>
									  	</td>
									</tr>
                                    <tr>
										<td valign="top"> Area <span class="red-mark">*</span></td>
										<td valign="top">
											<?php echo $this->Form->input('area_id', array('options'=>$area_options,'selected'=>$selectedArea,'div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'select', 'id' =>'area_id', 'empty'=>'--Select--')); ?><br />
											<span class="red-mark" id="error_area_id" style="display:none;" ></span>
									  	</td>
									</tr>
                                    <tr>
										<td valign="top"> Address Line 1 <span class="red-mark">*</span></td>
										<td valign="top">
											<?php  echo $this->Form->input('address_line1',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'address_line1', 'error'=>false)); ?><br /> 
											<span class="red-mark" id="error_address_line1" style="display:none;" ></span>
									  	</td>
									</tr>
									<tr>
										<td valign="top"> Address Line 2 <span class="red-mark">*</span></td>
										<td valign="top">
											<?php  echo $this->Form->input('address_line2',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'address_line2', 'error'=>false)); ?><br />
											<span class="red-mark" id="error_address_line2" style="display:none;" ></span>
									  	</td>
									</tr>
                                    <tr>
										<td valign="top"> Address Line 3 <span class="red-mark"></span></td>
										<td valign="top">
											<?php  echo $this->Form->input('address_line3',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'address_line3', 'error'=>false)); ?><br />
											<span class="red-mark" id="error_address_line3" style="display:none;" ></span>
									  	</td>
									</tr>
                                    
									<tr>
										<td valign="top"> City <span class="red-mark">*</span></td>
										<td valign="top">
											<?php echo $this->Form->input('city_id', array('options'=>$city_options,'selected'=>$selectedCity,'div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'select', 'id' =>'city_id', 'empty'=>'--Select--')); ?><br />
											<span class="red-mark" id="error_city_id" style="display:none;" ></span>
									  	</td>
									</tr>
								
									<tr class="event_type">
										<td valign="top">Latitude <span class="red-mark">*</span></td>
										<td valign="top">
											<?php echo $this->Form->input('latitude',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'latitude', 'error'=>false));?><br />
											
											<span class="red-mark" id="error_latitude" style="display:none;" ></span>
									  	</td>
									</tr>
									<tr class="event_type">
										<td valign="top">Longitude <span class="red-mark">*</span></td>
										<td valign="top">
											<?php echo $this->Form->input('longitude',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'longitude', 'error'=>false));?><br />
											
											<span class="red-mark" id="error_longitude" style="display:none;" ></span>
									  	</td>
									</tr>
									<tr class="event_type">
										<td valign="top">Postcode <span class="red-mark">*</span></td>
										<td valign="top">
											<?php echo $this->Form->input('postcode',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'postcode', 'error'=>false));?><br />											
                                            
											<span class="red-mark" id="error_postcode" style="display:none;" ></span>
									  	</td>
									</tr>
									
									
                                                                        <tr>
										<td colspan="3" align="right">
											<?php
												echo $this->Form->submit('save_btn.png', array('class'=>'onhover', 'border' => '0', 'div' =>false, 'onclick' => 'return validate_add_edit_Clinic();')); ?>
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

function loadEventCategory(overall_cat){
	
	var getUseraddressurl = "<?php echo $this->webroot;?>event_category_design/load_parent_category";
	
	
	$.post(
			getUseraddressurl,
			{ event_type:overall_cat},
		
		function(responseText)
		{ 
			$('#parent_id').empty(); 
			$('#parent_id').append($('<option/>').attr("value","").text("select"));
			for (var i = 0, len = responseText.length; i < len; ++i) {
			     var item = responseText[i];
			     $('#parent_id').append(
			    	        
			    	$('<option></option>').val(item.EventCategory.id).html(item.EventCategory.category_name)
			    );
			 }


		},"json"			
	);
	
}

												
function do_cancel()
{
	window.location = "<?php echo $this->webroot; ?>manage_clinic/list_clinics";
}

function hide_errors()
{
	$("#error_clinic_name").hide();
	$("#error_email").hide();
    $("#error_tel_landline1").hide();
    $("#error_working_hours").hide();
	$("#error_holidays").hide();
	$("#error_description").hide();
    $("#error_area_id").hide();
    $("#error_address_line1").hide();
	$("#error_address_line2").hide();
	$("#error_city_id").hide();
    $("#error_latitude").hide();
    $("#error_longitude").hide();
	$("#error_postcode").hide();

}

function validate_add_edit_Clinic()
{
	//return true;
	hide_errors();
	$("#clinic_name").val($("#clinic_name").val().trim());
	
	var errMessage = new Array();
	var errMessageIndex = new Array();

	//validate department name
	if( $("#clinic_name").val() == '' ) {
		errMessage.push('Please enter data for Clinic name.');
		errMessageIndex.push('clinic_name');
	}
	if( $("#email").val() == '' ) {
		errMessage.push('Please enter data for email.');
		errMessageIndex.push('error_email');
	}
	
	if( $("#tel_landline1").val() == '' ) {
		errMessage.push('Please enter data for telephone number.');
		errMessageIndex.push('tel_landline1');
	}
	if( $("#working_hours").val() == '' ) {
		errMessage.push('Please enter data for working hours.');
		errMessageIndex.push('working_hours');
	}	
	if( $("#holidays").val() == '' ) {
		errMessage.push('Please enter data for holidays.');
		errMessageIndex.push('holidays');
	}	
	/*if( $("#description").val() == '' ) {
		errMessage.push('Please enter data for description.');
		errMessageIndex.push('description');
	}*/
	if( $("#address_line1").val() == '' ) {
		errMessage.push('Please enter data for address line 1.');
		errMessageIndex.push('address_line1');
	}
	if( $("#address_line2").val() == '' ) {
		errMessage.push('Please enter data for address line 2.');
		errMessageIndex.push('address_line2');
	}
	if( $("#latitude").val() == '' ) {
		errMessage.push('Please enter data for latitude.');
		errMessageIndex.push('latitude');
	}
	if( $("#longitude").val() == '' ) {
		errMessage.push('Please enter data for longitude.');
		errMessageIndex.push('longitude');
	}
	if($("#area_id").val()==""){
		errMessage.push('Please select area.');
		errMessageIndex.push('area_id');		
	}
	if($("#city_id").val()==""){
		errMessage.push('Please select city.');
		errMessageIndex.push('city_id');		
	}
	if($("#postcode").val()==""){
		errMessage.push('Please select data for postcode.');
		errMessageIndex.push('postcode');
		
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
		$("#addEditClinicForm").submit();
	}
		
}

</script>