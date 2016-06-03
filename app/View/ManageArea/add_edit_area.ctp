
<!--Details-box START -->
<div class="details-box">

	<div class="details-box-header">		
		<div class="details-box-left"></div>				
		<div class="details-box-mid">
			<div class="details-icon">
				<?php echo $this->Html->image('details-icon2.png', array('border' => '0')); ?>
			</div>
			<span>Manage Area</span>
		</div>				
		<div class="details-box-right"></div>				
	</div>
	
	<div class="clear"></div>

	<?php
		$action = Configure::read('medtest_root_path').$this->request->url;
		echo $this->Form->create('Area', array('id'=>'addEditAreaForm', 'url'=>$action, 'type'=>'post'));
		
		echo $this->Form->input('id',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'hidden', 'id'=>'aow_id', 'value'=>$areaId));
		
		$addOrEditStr = 'Add New Area';
		if($areaId!=0){
			$addOrEditStr = 'Edit Area';
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
							<a  href="<?php echo $this->webroot;?>manage_area/list_areas">View / Edit Area </a>
						</li>
						<li id="accountDetails">
							<a  class="current" href="<?php echo $this->webroot;?>manage_area/add_edit_area"><?php echo $addOrEditStr;?></a>
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
										<td valign="top">Area Name <span class="red-mark">*</span></td>
										<td valign="top">
											<?php echo $this->Form->input('area_name',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'area_name', 'error'=>false));?><br />
											
											<span class="red-mark" id="error_area_name" style="display:none;" ></span>
									  	</td>
									</tr>
									
									<tr>
										<td valign="top"> City <span class="red-mark">*</span></td>
										<td valign="top">
											<?php
												
											
                                                                                        
                                                                                       
                                                                                        
                                                                                        echo $this->Form->input('city_id', array('options'=>$city_options,'selected'=>$selectedCity,'div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'select', 'id' =>'city_id', 'empty'=>'--Select--'));
											
												
											?><br />
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
										<td valign="top">Postcode</td>
										<td valign="top">
											<?php echo $this->Form->input('postcode',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'postcode', 'error'=>false));?><br />
											
											<span class="red-mark" id="error_postcode" style="display:none;" ></span>
									  	</td>
									</tr>
									
									
                                                                        <tr>
										<td colspan="3" align="right">
											<?php
												echo $this->Form->submit('save_btn.png', array('class'=>'onhover', 'border' => '0', 'div' =>false, 'onclick' => 'return validate_add_edit_area();')); ?>
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
	window.location = "<?php echo $this->webroot; ?>event_category/list_eventcategories";
}

function hide_errors()
{
	$("#error_area_name").hide();
	$("#error_city_id").hide();
        $("#error_latitude").hide();
        $("#error_longitude").hide();
}


function validate_add_edit_area()
{
	//return true;
	hide_errors();
	$("#area_name").val($("#area_name").val().trim());
        $("#latitude").val($("#latitude").val().trim());
        $("#longitude").val($("#longitude").val().trim());
	
	var errMessage = new Array();
	var errMessageIndex = new Array();

	//validate department name
	if( $("#area_name").val() == '' ) {
		errMessage.push('Please enter data for area name.');
		errMessageIndex.push('area_name');
	}

	if($("#city_id").val()==""){
		errMessage.push('Please select data for city.');
		errMessageIndex.push('city_id');
		
	}
	
        if($("#latitude").val()==""){
		errMessage.push('Please select data for latitude.');
		errMessageIndex.push('latitude');
		
	}
        
        if($("#longitude").val()==""){
		errMessage.push('Please select data for longitude.');
		errMessageIndex.push('longitude');
		
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
		$("#addEditAreaForm").submit();
	}
		
}

</script>