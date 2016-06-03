<?php
echo $this->html->script("jquery-ui-1.8.16.custom.min.js");
echo $this->html->css("jquery-ui-1.8.16.custom.css");

?>

<style type="text/css">





</style>
<!--Details-box START -->
<div class="details-box">

	<div class="details-box-header">		
		<div class="details-box-left"></div>				
		<div class="details-box-mid">
			<div class="details-icon">
				<?php echo $this->Html->image('details-icon2.png', array('border' => '0')); ?>
			</div>
			<span>Upload Clinic Tests</span>
		</div>				
		<div class="details-box-right"></div>				
	</div>
	
	<div class="clear"></div>

	<?php
		$action = Configure::read('medtest_root_path').$this->request->url;
		echo $this->Form->create('UploadTest', array('id'=>'uploadTestForm','type'=>'file' ,'url'=>$action));
		
		
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
										<td valign="top">File <span class="red-mark">*</span></td>
										<td valign="top">
											<?php 
                                                                                        echo $this->Form->file('UploadTest.file_upload',array('id'=>'file_upload'));
                                                                                        ?>
                                                                                        <br />
											
											<span class="red-mark" id="error_file_upload" style="display:none;" ></span>
									  	</td>
									</tr>
									
									
								
									
									
									
									
                                                                        <tr>
										<td colspan="3" align="middle">
											<?php
											      echo $this->Form->submit('save_btn.png', array('class'=>'onhover', 'border' => '0', 'div' =>false, 'onclick' => 'return validate_upload();')); ?>
											<?php echo $this->Html->image('cancel_btn.png', array('class'=>'onhover', 'border' => '0', 'onclick'=>'do_cancel();' )); ?>
										</td>
									</tr>
								</tbody>
								</table>
								
							</td>
						</tr>
                                                <tr id="grid_data">
							<?php 
														
							echo $this->element('UploadTestPackage/test_upload_list');
														
							?>
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
<div id="dialog_duplicate_test" title="Test already existing!!!" style="display:none;height:200px !important;">
<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
    Test is already existing in the system. Please skip this test.</p>
</div>
<!--Details-box END -->

<script type="text/javascript" >
    
var root_path = "<?php echo Configure::read('medtest_root_path'); ?>";

$(document).ready(function () {
	
});

function create_test(test_array_index){
    
    var url = root_path+"upload_test/ajax_check_duplicate_test";
        show_loading();
        $.post(
		url,
		{test_array_index:test_array_index},
		function(responseText)
		{
                        hide_loading();
			if(responseText.response=="success"){
                            var url = root_path+"upload_test/ajax_create_test";
                            show_loading();
                            $.post(
                            url,
                                {test_array_index:test_array_index},
                                function(responseText)
                                {
                                if(responseText.response=="success"){
                                    alert('test added successfully.');
                                    var url = root_path+"upload_test/load_array";
                                    $.post(
						url,
						function(responseText)
						{
							$('#grid_data').html('');
							$('#grid_data').html(responseText);
                                                        hide_loading();
								
						}		
					);
			    
                                    }
                                    	
			
			
                        },"json"		
                        );
			    
			}
			else if(responseText.response=="duplicate"){
                                hide_loading();
				$('#dialog_duplicate_test').dialog({
                                                autoOpen: true,
                                                resizable: false,
                                                width: 600,
                                                //height:400,
                                                modal: true,
                                                buttons: {
                                                "Skip Test": function() {
                                                    
                                                    $(this).dialog("close");
                                                    var url = root_path+"upload_test/ajax_unset_test";
                                                    show_loading();
                                                    $.post(
                                                    url,
                                                    {test_array_index:test_array_index},
                                                    function(responseText)
                                                    {
                                                    if(responseText.response=="success"){
                                                       
                                                        
                                                        var url = root_path+"upload_test/load_array";
                                                        $.post(
                                                        url,
                                                        function(responseText)
                                                        {
							$('#grid_data').html('');
							$('#grid_data').html(responseText);
                                                        hide_loading();
								
                                                        }		
                                                    );
			    
                                                    }
                                                   
			
			
                                                    },"json"		
                                                    );  
                                                },
                                                "Cancel": function() {
                                                    $(this).dialog("close");
                                                    hide_loading();	
                                                    return false;
                                                    
                                                }
                                                }
                                                });

			}	
			
			
		},"json"		
	);
        
        
        
        
        
        return false;
    
}

												
function do_cancel()
{
	window.location = "<?php echo $this->webroot; ?>manage_test/list_tests";
}

function hide_errors()
{
	$("#error_file_upload").hide();
	
       
}


function validate_upload()
{
	//return true;
	hide_errors();
	
	
	var errMessage = new Array();
	var errMessageIndex = new Array();

	if ($('#file_upload').val()) {
            if ($('#file_upload').val().search(/^.*\.(xls|XLS|xlsx|XLSX)$/)!=-1) {
			//var ret_val = true;
		} else {
                    errMessage.push('Only .xls and .xlsx file type is allowed');
                    errMessageIndex.push('file_upload');
	    }
                
               
                
	} else {
		errMessage.push('Please upload file.');
		errMessageIndex.push('file_upload');
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
		$("#uploadTestForm").submit();
	}
		
}

</script>