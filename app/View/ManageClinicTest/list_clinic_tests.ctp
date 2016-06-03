<?php
	echo $this->Html->script("jquery.blockUI.js");
	echo $this->Html->script("jquery.json-2.2.min.js");
	echo $this->Html->script("jquery-ui-1.8.16.custom.min.js");
	echo $this->Html->css("jquery-ui-1.8.16.custom.css");
	
?>

<!--Details-box2 Start -->
<div class="details-box">

	<div class="details-box-header">
		<div class="details-box-left"></div>
		<div class="details-box-mid">
			<div class="details-icon">
				<?php echo $this->Html->image('details-icon2.png', array('border' => '0')); ?>
			</div>
			<span>Manage Clinic Tests</span>
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
							<a class="current" href="<?php echo $this->webroot;?>manage_clinic_test/list_clinic_tests">View / Edit Clinic Tests </a>
						</li>
						<li id="accountDetails">
							<a  href="<?php echo $this->webroot;?>manage_clinic_test/add_edit_clinic_test">Add New Clinic Tests</a>
						</li>
						
					</ul>
				</div>
				
				<div class="clear"></div>
					
				<div id="tab2" class="tab_content1">
					<?php
						echo $this->Form->create('searchClinicForm', array('id'=>'searchClinicForm', 'onsubmit' => 'javascript: return search_clinic_test();'));
					?>
					<table cellspacing="1" cellpadding="0" border="0" bgcolor="#ffffff" width="100%" style="border: 1px solid rgb(230, 229, 235);" class="formstyle">
					<tbody>
						<tr>
							<td>
								<table cellspacing="1" cellpadding="7" border="0" width="100%" class="tablestyle">
								<tbody>
									<tr>
										<td width="15%" class="text">Clinic Name</td>
										<td width="25%" class="textfield">
											<?php echo $this->Form->input('clinic_id', array('options'=>$clinic_options,'selected'=>$selectedClinic,'div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'select', 'id' =>'clinic_id', 'empty'=>'--Select--')); ?><br />
										</td>
                                       
										<td width="13%" class="text">Generic Test Name</td>
										<td width="25%" class="textfield">
											<?php 
                                                                                        echo $this->Form->input('category_id', array('options'=>$category_options,'div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'select', 'id' =>'category_id', 'empty'=>'--Select--'));
                                                                                        ?>
										</td>
                                                                                <td width="15%" class="text">Generic Test Name</td>
										<td width="25%" class="textfield">
											<?php echo $this->Form->input('category_name',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'category_name'));?><br />
										</td>
																			
									</tr>
                                                                        <tr>
                                                                            <td width="13%" class="text">Specific Test Name</td>
										<td width="25%" class="textfield">
											<?php 
                                                                                        echo $this->Form->input('test_id', array('options'=>$test_options,'div'=>false, 'label'=>false, 'class'=>'inputfield', 'type'=>'select', 'id' =>'test_id', 'empty'=>'--Select--'));
                                                                                        ?>
										</td>
                                                                                <td width="15%" class="text">Specific Test Name</td>
										<td width="25%" class="textfield">
											<?php echo $this->Form->input('test_name',array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'id'=>'test_name'));?><br />
										</td>
                                                                                <td width="15%" class="text">Home Collection</td>
                                                                                <td width="25%" class="textfield">
                                                                                    <?php
                                                                                    echo $this->Form->input('home_collection', array(
                                                                                    'type'=>'checkbox',
                                                                                    'label'=>false,
                                                                                     'div'=>false,     
                                                                                     'id'=>'home_collection',
                                                                                     
  ) );                                                                              ?>
                                                                                </td>
                                                                        </tr>
                                                                         <tr>
                                                                            <td width="13%" class="text">Status</td>
										<td width="25%" class="textfield">
											<?php 
                                                                                        
                                                                                        $statuses = array(
                                                                                            Configure::read('Active_id') => Configure::read('Active_val'),
                                                                                            Configure::read('Inactive_id') => Configure::read('Inactive_val')
                                                                                        );
                                                                                        
                                                                                        echo $this->Form->input('active_status_id', array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'style'=>'width:80px;', 'type'=>'select', 'id' =>'active_status_id','options'=>$statuses, 'empty'=>'Select'));
                                                                                        
                                                                                        ?>
										</td>
                                                                                <td width="15%" class="text">Test Type</td>
										<td width="25%" class="textfield">
											<?php 
                                                                                        
                                                                                        $test_type = array(
                                                                                           '1'=>'Lab',
                                                                                           '2'=>'Radiology',
                                                                                        );
                                                                                        
                                                                                        echo $this->Form->input('test_type_id', array('div'=>false, 'label'=>false, 'class'=>'inputfield', 'style'=>'width:80px;', 'type'=>'select', 'id' =>'test_type_id','options'=>$test_type, 'empty'=>'Select'));
                                                                                        
                                                                                        ?>
										</td>
                                                                                <td width="15%" class="text"></td>
                                                                                <td>
                                                                                </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="6" align="right">
											<?php
												echo $this->Form->submit('search_btn.png', array('id'=>'searchButton', 'border' => '0', 'div' =>false, 'onclick' => 'return search_clinic_test();')); ?>
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
						<?php echo $this->Element('ManageClinicTest/list_clinic_test_element'); ?>
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
        
        <div id="confirmHomeCollectionStatus" title="Confirm Change Status" style="display:none;">
		<table width="100%" cellspacing="0" cellpadding="7" border="0" class="tble_head">
			<tr>
				<td valign="top" class="text">
					Are you sure you want to change the home collection status..?
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
var url = 'manage_clinic_test/list_clinic_test_element/';

$(document).ready(function(){
	jString = get_json_string_for_searchClinicTest();	
});

function do_cancel(){
	$('#load_add_form').hide();
}


function get_json_string_for_searchClinicTest()
{
        var home_collection = $('#home_collection').prop('checked');
        if(home_collection){
            home_collection_val = 1;
        }else{
            home_collection_val = 0;
        }
    
	var clinic_id = $('#clinic_id').val();	
	var category_id = $('#category_id').val();
        var test_id = $('#test_id').val();
        var category_name = $('#category_name').val();	
	var test_name = $('#test_name').val();
        var home_collection = home_collection_val;
        var active_status_id = $('#active_status_id').val();
        var test_type_id = $('#test_type_id').val();
        
        category_name = category_name.replace(" ","_RemSp_");
	test_name = test_name.replace(" ","_RemSp_");
	
	var filter = {clinic_id:clinic_id,
				category_id:category_id,
                                test_id:test_id,
                                category_name:category_name,
				test_name:test_name,
                            home_collection:home_collection,
                            active_status_id : active_status_id,
                            test_type_id : test_type_id
                        };
	jString = $.toJSON(filter);
	return jString;
}

function search_clinic_test()
{
	
	var jString = get_json_string_for_searchClinicTest();

	var searchUrl = medtest_root_path+"manage_clinic_test/list_clinic_test_element/";	
	show_loading();
	$.post(
		searchUrl,
		{jString:jString},
		function(responseText)
		{
			//alert('tes');
			$("#listContainer").html(responseText);
			hide_loading();	
		}		
	);
		
	return false;	
}


function get_json_string(action, clinic_test_id, currentStatus, statusIndex)
{
	changeStatusTo = 0;
	if(action == "ChangeStatus"){
		changeStatusTo = $("#status_id_"+statusIndex).val();
	}	
	
	var filter = {
				 action:action,
				 clinic_test_id:clinic_test_id,
				 changeStatusTo:changeStatusTo};
	jString = $.toJSON(filter);
	
	return jString;
}

function perform_operation_clinic_test_status(action, clinic_test_id,currentStatus,statusIndex)
{
	var jString = get_json_string(action, clinic_test_id, currentStatus,0);

	var status_url = medtest_root_path+'manage_clinic_test/perform_operation_clinic_test_status/';
	var redirect_url = medtest_root_path+'manage_clinic_test/list_clinic_tests/';
	var data = {clinic_test_id : clinic_test_id,currentStatus:currentStatus};	
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
		window.location = medtest_root_path+"manage_clinic_test/list_clinic_tests/?jString="+jString;
	}
	
	
	return false;	
}

function perform_home_collection_status(action, clinic_test_id,home_collection,statusIndex)
{
	

	var status_url = medtest_root_path+'manage_clinic_test/perform_operation_test_home_collection/';
	var redirect_url = medtest_root_path+'manage_clinic_test/list_clinic_tests/';

	var data = {clinic_test_id : clinic_test_id,home_collection:home_collection};

	
	if(action == "ChangeStatus")
	{
		$('#confirmHomeCollectionStatus').dialog({
		//autoOpen: true,
		modal: true,
		width: 600,
		buttons: {
				"Yes": function(){
					$.ajax
					({
						type	: 'post',
						url	: status_url,
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
					$("#home_coll_id_"+statusIndex).val(home_collection);
					$(this).dialog("close");
				} 
			}
		});
	}


	else
	{
		window.location = medtest_root_path+"manage_clinic_test/list_clinic_tests/?jString="+jString;
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
