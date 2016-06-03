<style type="text/css">
.multiselect {
    width:20em;
    height:15em;
    border:solid 1px #c0c0c0;
    overflow:auto;
}
 
.multiselect label {
    display:block;
}
 
.multiselect-on {
    color:#ffffff;
    background-color:#139cc9;
}
</style>
<?php
	echo $this->Html->script("jquery.blockUI.js");
	echo $this->Html->script("jquery.json-2.2.min.js");
	echo $this->Html->script("jquery-ui-1.8.16.custom.min.js");
	echo $this->Html->css("jquery-ui-1.8.16.custom.css");
	
?>
<script language="javascript">
jQuery.fn.multiselect = function() {
    $(this).each(function() {
        var checkboxes = $(this).find("input:checkbox");
        checkboxes.each(function() {
            var checkbox = $(this);
            // Highlight pre-selected checkboxes
            if (checkbox.prop("checked"))
                checkbox.parent().addClass("multiselect-on");
 
            // Highlight checkboxes that the user selects
            checkbox.click(function() {
                if (checkbox.prop("checked"))
                    checkbox.parent().addClass("multiselect-on");
                else
                    checkbox.parent().removeClass("multiselect-on");
            });
        });
    });
};
$(function() {
     $(".multiselect").multiselect();
});
</script>
<!--Details-box START -->
<div class="details-box">

	<div class="details-box-header">		
		<div class="details-box-left"></div>				
		<div class="details-box-mid">
			<div class="details-icon">
				<?php echo $this->Html->image('details-icon2.png', array('border' => '0')); ?>
			</div>
			<span>Manage Test Packages</span>
		</div>				
		<div class="details-box-right"></div>				
	</div>
	
	<div class="clear"></div>

	<?php
		$action = Configure::read('medtest_root_path').$this->request->url;
		echo $this->Form->create('TestPackage', array('id'=>'addEditTestPackageForm', 'url'=>$action, 'type'=>'post'));
		
		echo $this->Form->input('id',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'hidden', 'id'=>'aow_id', 'value'=>$packageId));
		
		$addOrEditStr = 'Add New Test Package';
		if($packageId!=0){
			$addOrEditStr = 'Edit Test Package';
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
							<a  href="<?php echo $this->webroot;?>manage_test_package/list_test_packages">View / Edit Test Packages </a>
						</li>
						<li id="accountDetails">
							<a  class="current" href="<?php echo $this->webroot;?>manage_test_package/add_edit_test_package"><?php echo $addOrEditStr;?></a>
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
										<td valign="top">Package Name <span class="red-mark">*</span></td>
										<td valign="top">
											<?php echo $this->Form->input('package_name',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'package_name', 'error'=>false));?><br />
											
											<span class="red-mark" id="error_package_name" style="display:none;" ></span>
									  	</td>
									</tr>
									<tr class="event_type">
										<td valign="top">Alternative Name</td>
										<td valign="top">
											<?php echo $this->Form->input('alternate_name',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'alternate_name', 'error'=>false));?><br />
											
											<span class="red-mark" id="error_alternate_name" style="display:none;" ></span>
									  	</td>
									</tr>
									<tr>
										<td valign="top"> Hospital <span class="red-mark">*</span></td>
										<td valign="top">
											<?php
												
											echo $this->Form->input('clinic_id', array('options'=>$clinic_options,'selected'=>$selectedClinic,'div'=>false, 'onchange'=>"", 'label'=>false, 'class'=>'inputfield', 'type'=>'select', 'id' =>'clinic_id', 'empty'=>'--Select--'));
											
												
											?><br />
											<span class="red-mark" id="error_clinic_id" style="display:none;" ></span>
									  	</td>
									</tr>
                                                                        <tr>
										<td valign="top"> Tests Included <span class="red-mark">*</span></td>
										<td valign="top">
											<?php
												
											echo $this->Form->input('tests_included', array('cols'=>40,'rows'=>10,'type'=>'textarea','div'=>false, 'label'=>false, 'class'=>'inputfield', 'id' =>'tests_included'));
											
												
											?><br />
											<span class="red-mark" id="error_tests_included" style="display:none;" ></span>
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
                                                                                <td valign="top"> Tests Category <span class="red-mark">*</span></td>
										<td valign="top"> <div id="listContainer">
												<?php echo $this->Element('ManageTestPackage/list_category_element'); ?>
											</div>
                                                                                    <span class="red-mark" id="error_category_ids" style="display:none;" ></span>
									  	</td>
									</tr>
								
									<tr class="event_type">
										<td valign="top">Actual Price <span class="red-mark">*</span></td>
										<td valign="top">
											<?php echo $this->Form->input('price_actual',array('type'=>'text','div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'price_actual', 'error'=>false));?><br />
											
											<span class="red-mark" id="error_price_actual" style="display:none;" ></span>
									  	</td>
									</tr>
									<tr class="event_type">
										<td valign="top">Offer Price<span class="red-mark">*</span></td>
										<td valign="top">
											<?php echo $this->Form->input('price_offer',array('type'=>'text','div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'price_offer', 'error'=>false));?><br />
											
											<span class="red-mark" id="error_price_offer" style="display:none;" ></span>
									  	</td>
									</tr>
                                                                        <tr>
										<td valign="top"> Tests Included <span class="red-mark">*</span></td>
										<td valign="top">
											<?php
												
											echo $this->Form->input('seo_tags', array('cols'=>30,'rows'=>10,'type'=>'textarea','div'=>false, 'label'=>false, 'class'=>'inputfield', 'id' =>'seo_tags'));
											
												
											?><br />
											<span class="red-mark" id="error_tests_included" style="display:none;" ></span>
									  	</td>
									</tr>
                                                                        <tr>
										<td valign="top"> Description <!--<span class="red-mark">*</span>--></td>
										<td valign="top">
											<?php    echo $this->Form->textarea('description', array('cols'=>23,'rows'=>5,'div'=>false, 'label'=>false, 'class'=>'inputfield', 'id' =>'description'));
											
												
											?><br />
											<span class="red-mark" id="error_description" style="display:none;" ></span>
									  	</td>
									</tr>
								
									<tr class="event_type">
										<td valign="top">Precautions <!--<span class="red-mark">*</span>--></td>
										<td valign="top">
                                                                                        <?php
                                                                                        echo $this->Form->textarea('precautions', array('cols'=>23,'rows'=>5,'div'=>false, 'label'=>false, 'class'=>'inputfield', 'id' =>'precautions'));
											?><br />
											<span class="red-mark" id="error_precautions" style="display:none;" ></span>
									  	</td>
									</tr>
									
									
									
                                                                        <tr>
										<td colspan="3" align="right">
											<?php
												echo $this->Form->submit('save_btn.png', array('class'=>'onhover', 'border' => '0', 'div' =>false, 'onclick' => 'return validate_add_edit_package();')); ?>
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
	//jString = get_json_string_for_fetchHospitalTests();	
});

function get_json_string_for_fetchHospitalTests()
{
	var clinic_id = $('#clinic_id').val();
	
	var filter = {clinic_id:clinic_id};
	jString = $.toJSON(filter);
	return jString;
}

function fetchHospitalTests()
{
	var jString = get_json_string_for_fetchHospitalTests();

	var searchUrl = medtest_root_path+"manage_test_package/fetch_hospital_tests/";
	
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
	window.location = "<?php echo $this->webroot; ?>manage_test_package/list_test_packages";
}

function hide_errors()
{
	$("#error_package_name").hide();
	$("#error_clinic_id").hide();
        $("#error_price_actual").hide();
        $("#error_price_offer").hide();
        $("#error_home_collection").hide();
        $("#error_tests_included").hide();
        $("#error_category_ids").hide();
}


function validate_add_edit_package()
{
	//return true;
	hide_errors();
	$("#package_name").val($("#package_name").val().trim());
        $("#alternate_name").val($("#alternate_name").val().trim());
        $("#price_actual").val($("#price_actual").val().trim());
	$("#price_offer").val($("#price_offer").val().trim());
        $("#tests_included").val($("#tests_included").val().trim());
        
	var errMessage = new Array();
	var errMessageIndex = new Array();

	//validate department name
	if( $("#package_name").val() == '' ) {
		errMessage.push('Please enter data for package name.');
		errMessageIndex.push('package_name');
	}

	if($("#clinic_id").val()==""){
		errMessage.push('Please select a clinic.');
		errMessageIndex.push('clinic_id');
		
	}
        
        if($("#home_collection").val()==""){
		errMessage.push('Please select data for home collection.');
		errMessageIndex.push('home_collection');
		
	}
        
        if($("#tests_included").val()==""){
		errMessage.push('Please enter data for tests included.');
		errMessageIndex.push('tests_included');
		
	}
        
        
        
        if($("input[name='category_ids[]']:checked").length == 0){
                errMessage.push('Please select data for category.');
		errMessageIndex.push('category_ids');
        }
        
	
        
        
        if($("#price_actual").val()==""){
		errMessage.push('Please select data for actual price.');
		errMessageIndex.push('price_actual');
		
	}
        
        if($("#price_offer").val()==""){
		errMessage.push('Please select data for offer price.');
		errMessageIndex.push('price_offer');
		
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
		$("#addEditTestPackageForm").submit();
	}
		
}

</script>