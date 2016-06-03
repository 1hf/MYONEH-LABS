<!-- ################# Javascripts for ajax paging ################# -->
<script type="text/javascript"> jQuery.noConflict(); </script>
<?php
$_SESSION['searchPackageValue'] = "";
$_SESSION['searchPackagesubCatValue'] = "";
echo $this->Html->script('jquery-v1.8.3.js');
echo $this->Html->script('bootstrap.min.js');
echo $this->Html->css('style_ajax_paging.css');	
echo $this->Html->script('load-more-post.js');
echo $this->Html->script("jquery.json-2.2.min.js");
// this is for auto suggest text boxes..
echo $this->Html->script('jquery-ui.js');
echo $this->Html->css('jquery-ui.css');

echo $this->Html->script('backtop.js');
echo $this->Html->css('style_backtop.css');	

?>
<?php
if(isset($_GET['hcollection'])){
	$homeC = $_GET['hcollection'];
}else{
	$homeC = "";
}
?>
<script type="text/javascript">
    
     var medtest_root_path = "<?php echo $this->webroot;?>";
     
     $(document).on('click', '#callback_form_link', function(){
		$( "#modal_body" ).hide();
		$( "#modal_body_a" ).show();
                $('.btn-primary').show();
		$('#contact_name').val('');	
		$('#contact_email').val('');
		$('#contact_mobile').val('');
        $('#callbackformModal').modal({backdrop: 'static'}); 
    });
     
	 $(document).on('click', '#termsModalLink', function(){
		  $('#termsModal').modal({backdrop: 'static'}); 
	 });
$(document).ready(function() {
	<?php if($flagTest==2){ ?>
	 $('.tab-pane a[href="#panel2"]').tab('show');
	 <?php }else{ ?>
	  $('.tab-pane a[href="#panel1"]').tab('show');
	<?php } ?>
	$("input:checkbox[name=cbArea]:checked").each(function(){
     	//allVals.push('"'+$(this).val()+'"');	
		$(this).attr('checked', false); 
	});		
		
	if($("#cbHomeCollection").prop('checked') == true){
		// value=id;
		 $('#cbHomeCollection').attr('checked', false); 
	}		
	$("input:checkbox[name=cbClinic]:checked").each(function(){
     	//allValsClinic.push('"'+$(this).val()+'"');
		$(this).attr('checked', false);
			 
	});	
	var result ='<?php echo $jstring; ?>';
	
	var finalResult={"filterResults":[
			{"tests":result}
			]};			
	finalResult=JSON.stringify(finalResult);	
	//console.log(finalResult);
	//alert(finalResult);
	$('#loaded_data').html('');
	$('#loaded_data').vasplus_post_scroller({

		vpb_total_per_load  : 10, // Total number of posts per scroll to be loaded on the page
		vpb_start           : 0, // Default - loading start at 0 offset
		srchArrItms			: finalResult,
		vpb_no_more         : '<div class="loading_msg"><!--<span><img src="img/favicon.png" width="35" height="35"></span>--> NO MORE RESULTS.</div>', // This is the message shown to the user when the post is finished
		vpb_load_more       : '<div class="loading_msg"><span><img src="img/loader.GIF" width="35" height="35"></span> FINDING MORE RESULTS FOR YOU, BEAR WITH US</div>', // This is the message shown to the user when set auto scroll to false to load more data    
		vpb_delay           : 600, // Wait after this time when a user scrolls down to start again
		vpb_auto_load       : true, // Set to true for auto scroll and set to false to scroll manually
		vpb_page_identifier : 'laod-more-post', // Not really necessary unless you need it otherwise leave it alone
		vpb_url             : medtest_root_path+"listing/listing/", // This is the URL to the page that gets content from the database
		vpb_loading_div_id  : 'vpb_loading_box' // This is the ID of the div where the loaded contents will be displayed
		
	});
	
});

function sortFurther(id){	
	var allVals = [];var allValsClinic = [];
	var result ='';
/*	var data = $('.SearchFormInside').serialize();	
	var searchUrl = medtest_root_path+"listing/ajaxSearchFormatting/";		
	$.post(
		searchUrl,
		{jString:data},
		function(responseText)
		{
			if(responseText!='failed'){
				result =responseText;
			}else{
				result ='<?php echo $jstring; ?>';
			}*/
				result ='<?php echo $jstring; ?>';
				$("input:checkbox[name=cbArea]:checked").each(function(){
					allVals.push('"'+$(this).val()+'"');	 
				});	
				var value=0			
				if($("#cbHomeCollection").prop('checked') == true){
					 value=1;
				}	
				
				$("input:checkbox[name=cbClinic]:checked").each(function(){
					allValsClinic.push('"'+$(this).val()+'"');	 
				});		
			
				var stringAreaID=allVals.join(",");	
				var stringAreaIDFnl ='{"AreaIDS":['+stringAreaID+']}';
				var stringHomeColltn='{"HOmeCollection":["'+value+'"]}';	
				var stringClinicID=allValsClinic.join(",");	
				var stringClinicIDFnl ='{"ClinicIDS":['+stringClinicID+']}';
					
				var finalResult={"filterResults":[
						{"tests":result},
						{"AreaID":stringAreaIDFnl},
						{"HomeCollection":stringHomeColltn},
						{"ClinicID":stringClinicIDFnl},
						]};			
				finalResult=JSON.stringify(finalResult);	
				//console.log(finalResult);
				//alert(2);
				$(document).ready(function() {
					$('#loaded_data').html('');
					$('#loaded_data').vasplus_post_scroller({
				
						vpb_total_per_load  : 10, // Total number of posts per scroll to be loaded on the page
						vpb_start           : 0, // Default - loading start at 0 offset
						srchArrItms			: finalResult,
						vpb_no_more         : '<div class="loading_msg"><!--<span><img src="img/favicon.png" width="35" height="35"></span>--> NO MORE RESULTS.</div>', // This is the message shown to the user when the post is finished
						vpb_load_more       : '<div class="loading_msg"><span><img src="img/loader.GIF" width="35" height="35"></span> FINDING MORE RESULTS FOR YOU, BEAR WITH US</div>', // This is the message shown to the user when set auto scroll to false to load more data    
						vpb_delay           : 600, // Wait after this time when a user scrolls down to start again
						vpb_auto_load       : true, // Set to true for auto scroll and set to false to scroll manually
						vpb_page_identifier : 'laod-more-post', // Not really necessary unless you need it otherwise leave it alone
						vpb_url             : medtest_root_path+"listing/listing/", // This is the URL to the page that gets content from the database
						vpb_loading_div_id  : 'vpb_loading_box' // This is the ID of the div where the loaded contents will be displayed
						
					});
				});
	/*	}		
	);*/		
	
}

function sortFurtherHomeCollection(id){	 
	var allVals = [];var allValsClinic = [];
	var result ='';
	
				result ='<?php echo $jstring; ?>';
				
				var value=0			
				if($("#cbHomeCollection").prop('checked') == true){
					 value=1;
					 id = 1;
				}else{
					value=0;
					 id = 0;
				}
				$("input:checkbox[name=cbArea]:checked").each(function(){
					allVals.push('"'+$(this).val()+'"');	 
				});	
					
				
				$("input:checkbox[name=cbClinic]:checked").each(function(){
					allValsClinic.push('"'+$(this).val()+'"');	 
				});		
			
				var stringAreaID=allVals.join(",");	
				var stringAreaIDFnl ='{"AreaIDS":['+stringAreaID+']}';
				var stringHomeColltn='{"HOmeCollection":["'+value+'"]}';	
				var stringClinicID=allValsClinic.join(",");	
				var stringClinicIDFnl ='{"ClinicIDS":['+stringClinicID+']}';
					
				var finalResult={"filterResults":[
						{"tests":result},
						{"AreaID":stringAreaIDFnl},
						{"HomeCollection":stringHomeColltn},
						{"ClinicID":stringClinicIDFnl},
						]};			
				finalResult=JSON.stringify(finalResult);
			
				console.log(finalResult);
				if(value==0){
					
				}
				$(document).ready(function() {
					$('#loaded_data').html('');
					$('#loaded_data').vasplus_post_scroller({
				
						vpb_total_per_load  : 10, // Total number of posts per scroll to be loaded on the page
						vpb_start           : 0, // Default - loading start at 0 offset
						srchArrItms			: finalResult,
						vpb_no_more         : '<div class="loading_msg"><!--<span><img src="img/favicon.png" width="35" height="35"></span>--> NO MORE RESULTS.</div>', // This is the message shown to the user when the post is finished
						vpb_load_more       : '<div class="loading_msg"><span><img src="img/loader.GIF" width="35" height="35"></span> FINDING MORE RESULTS FOR YOU, BEAR WITH US</div>', // This is the message shown to the user when set auto scroll to false to load more data    
						vpb_delay           : 600, // Wait after this time when a user scrolls down to start again
						vpb_auto_load       : true, // Set to true for auto scroll and set to false to scroll manually
						vpb_page_identifier : 'laod-more-post', // Not really necessary unless you need it otherwise leave it alone
						vpb_url             : medtest_root_path+"listing/listing/", // This is the URL to the page that gets content from the database
						vpb_loading_div_id  : 'vpb_loading_box' // This is the ID of the div where the loaded contents will be displayed
						
					});
				});

}

function sortFurtherClinic(id){	
	var allVals = [];var allValsClinic = [];
	var result ='';
/*	var data = $('.SearchFormInside').serialize();	
	var searchUrl = medtest_root_path+"listing/ajaxSearchFormatting/";		
	$.post(
		searchUrl,
		{jString:data},
		function(responseText)
		{
			if(responseText!='failed'){
				result =responseText;
			}else{
				result ='<?php echo $jstring; ?>';
			}*/
				result ='<?php echo $jstring; ?>';
				$("input:checkbox[name=cbArea]:checked").each(function(){
					allVals.push('"'+$(this).val()+'"');	 
				});	
				var value=0			
				if($("#cbHomeCollection").prop('checked') == true){
					 value=1;
				}	
				
				$("input:checkbox[name=cbClinic]:checked").each(function(){
					allValsClinic.push('"'+$(this).val()+'"');	 
				});		
			
				var stringAreaID=allVals.join(",");	
				var stringAreaIDFnl ='{"AreaIDS":['+stringAreaID+']}';
				var stringHomeColltn='{"HOmeCollection":["'+value+'"]}';	
				var stringClinicID=allValsClinic.join(",");	
				var stringClinicIDFnl ='{"ClinicIDS":['+stringClinicID+']}';
					
				var finalResult={"filterResults":[
						{"tests":result},
						{"AreaID":stringAreaIDFnl},
						{"HomeCollection":stringHomeColltn},
						{"ClinicID":stringClinicIDFnl},
						]};			
				finalResult=JSON.stringify(finalResult);	
				//console.log(finalResult);
				//alert(2);
				$(document).ready(function() {
					$('#loaded_data').html('');
					$('#loaded_data').vasplus_post_scroller({
				
						vpb_total_per_load  : 10, // Total number of posts per scroll to be loaded on the page
						vpb_start           : 0, // Default - loading start at 0 offset
						srchArrItms			: finalResult,
						vpb_no_more         : '<div class="loading_msg"><!--<span><img src="img/favicon.png" width="35" height="35"></span>--> NO MORE RESULTS.</div>', // This is the message shown to the user when the post is finished
						vpb_load_more       : '<div class="loading_msg"><span><img src="img/loader.GIF" width="35" height="35"></span> FINDING MORE RESULTS FOR YOU, BEAR WITH US</div>', // This is the message shown to the user when set auto scroll to false to load more data    
						vpb_delay           : 600, // Wait after this time when a user scrolls down to start again
						vpb_auto_load       : true, // Set to true for auto scroll and set to false to scroll manually
						vpb_page_identifier : 'laod-more-post', // Not really necessary unless you need it otherwise leave it alone
						vpb_url             : medtest_root_path+"listing/listing/", // This is the URL to the page that gets content from the database
						vpb_loading_div_id  : 'vpb_loading_box' // This is the ID of the div where the loaded contents will be displayed
						
					});
				});
	/*	}		
	);	*/	
	
}

function hide_errors(){
        $("#error_contact_name").hide();
        
        $("#error_contact_email").hide();
        
        $("#error_contact_mobile").hide();
    
}
function validate_callback(){
    
        hide_errors();
        
    
        var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    
        $("#contact_name").val($("#contact_name").val().trim());
        $("#contact_email").val($("#contact_email").val().trim());
        $("#contact_mobile").val($("#contact_mobile").val().trim());
	
	var errMessage = new Array();
	var errMessageIndex = new Array();
        
        if( $("#contact_name").val() == '' ) {
		errMessage.push('Please enter data for name.');
		errMessageIndex.push('contact_name');
	}
        
        if( $("#contact_email").val() == '' ) {
		errMessage.push('Please enter data for email.');
		errMessageIndex.push('contact_email');
	}else{
            if(!$("#contact_email").val().match(emailExp)){
                errMessage.push('Please enter a valid email.');
                errMessageIndex.push('contact_email');  
            }
        }
        
        if( $("#contact_mobile").val() == '' ) {
		errMessage.push('Please enter data for mobile.');
		errMessageIndex.push('contact_mobile');
	}
        
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
		request_call_back();
                return false;
	}
        
        
    
}
	 
function get_json_string_for_request_call_back()
{
	var contact_name = $('#contact_name').val();	
	var contact_email = $('#contact_email').val();
	var contact_mobile = $('#contact_mobile').val();	
	//alert(contact_name);
	contact_name = contact_name.replace(" ","_RemSp_");
	contact_email = contact_email.replace(" ","_RemSp_");
	contact_mobile = contact_mobile.replace(" ","_RemSp_");
	
	var filter = {contact_name:contact_name,
				contact_email:contact_email,
				contact_mobile:contact_mobile};
	jString = $.toJSON(filter);
	return jString;
}
function request_call_back()
{
	
	var jString = get_json_string_for_request_call_back();

	var searchUrl = medtest_root_path+"index/request_call_back/";	
	//show_loading();
	$.post(
		searchUrl,
		{jString:jString},
		function(responseText)
		{
			$( "#modal_body" ).show();
			$( "#modal_body_a" ).hide();
                        $('.btn-primary').hide();
			$("#modal_body").html('<span class="test"> Thank you for contacting us. We will get back to you shortly!!! <br /><br /> -Team HealthX</span>');
			//hide_loading();	
		}		
	);
		
	return false;	
}	

</script>

 
<!-- ################# Javascripts for ajax paging ################# -->
<script type="text/javascript">
    
    var medtest_root_path = "<?php echo $this->webroot;?>";
  
    $(document).ready(function(){
        
    $('#addTestLink').show();   
       
    $(document).on('click', '#addTestLink', function(){
        var testDiv = $('#test_list');
        var divCount = $('#test_list div').size() + 1;
       
        if(divCount>5){
           $('#addTestLink').hide(); 
        }
        
        if(divCount<=6){
        var newDiv = '<div class="form-group search_field1 additional">'+
                        '<input type="text" class="form-control autocomplete test-autocomplete" name="testSearch[]" id="testSearch_'+divCount+'" placeholder="eg. Platelet Count"></div>';
                
        $('#test_list').append(newDiv);
        divCount++;
        
        }else{
            $('#addTestLink').hide();
        }    
        return false;

        });
    
	
	$(".test-autocomplete").autocomplete({
        source: medtest_root_path+"Index/ajaxFetchTests",
		minLength:0
    })
	.on('focus', function() {
		//$(this).keydown();
		 if (this.value == "")
                {
                    $(this).autocomplete("search");
                }
		})
	.on('click', function() {
		$(this).keydown(); 
		});
    
      $(document).on("keydown.test-autocomplete",".test-autocomplete",function(e){
      $(this).autocomplete({
      minLength: 0,
      source: medtest_root_path+"Index/ajaxFetchTests",
      focus: function( event, ui ) {
      //$('#testSearch_1').val( ui.item.label);
        return false;
      },
	  
	  mousedown: function( event, ui ) { 
		//$('#testSearch_1').val( ui.item.label);
        return true;
      },
      select: function( event, ui ) {
        $(this).val( ui.item.label );
 
        return false;
      }
    })
    .data("ui-autocomplete")._renderItem = function( ul, item ) {
		var stringAlso=" ";
		var desc=(item.desc.toUpperCase()).trim();
		var label=item.label.trim();
		if(label!=desc)
		  stringAlso="<br><p class='inner_content text' style='color: #999999; margin:1px; font-size:9px;'>also known as" + item.desc + "</p>";
      return $( "<li class='time'>" )
        //.append( "<a style='color: #0099cc;font-size:12px;margin-bottom:1px;'>" + item.label +stringAlso +"</a>" )
		.append( "<a style='color: #E81556;font-size:12px;margin-bottom:1px;'>" + item.label +stringAlso +"</a>" )
        .appendTo( ul );
    };
  });
    
    
	 $("#areaTextbox").autocomplete({
        source: medtest_root_path+"Index/ajaxFetchArea",
		minLength:0
    })
	.on('focus', function() {
		//$(this).keydown();
		 if (this.value == "")
                {
                    $(this).autocomplete("search");
                }
		})
	.on('click', function() {
		$(this).keydown(); 
		});
	
    $( "#areaTextbox" ).autocomplete({
      minLength: 0,
      source: medtest_root_path+"Index/ajaxFetchArea",
      focus: function( event, ui ) {
      //  $( "#areaTextbox" ).val( ui.item.label );
        return false;
      },
      select: function( event, ui ) {
        $( "#areaTextbox" ).val( ui.item.label );
        //$( "#testSearch_1-id" ).val( ui.item.value );
        //$( "#testSearch_1-description" ).html( ui.item.desc );
        //$( "#project-icon" ).attr( "src", "images/" + ui.item.icon );
 
        return false;
      }
    }).data("ui-autocomplete")._renderItem = function( ul, item ) {
      return $( "<li class='time'>" )
        //.append( "<a style='color: #0099cc;font-size:12px;margin-bottom:1px;'>" + item.label + "</a>" )
		.append( "<a style='color: #E81556;font-size:12px;margin-bottom:1px;'>" + item.label + "</a>" )
        .appendTo( ul );
    };
    
    
     $(document).on("keydown.package-autocomplete",".package-autocomplete",function(e){
      $(this).autocomplete({
      minLength: 0,
      source: medtest_root_path+"index/ajaxFetchPackages",
      focus: function( event, ui ) {
        $(this).val( ui.item.label );
        return false;
      },
      select: function( event, ui ) {
        $(this).val( ui.item.label );
        //$(this).val( ui.item.value );
        //$(this).html( ui.item.desc );
       
 
        return false;
      }
    });
    
  });
    
    
    /* $( "#packageAreaTextbox" ).autocomplete({
      minLength: 0,
      source: medtest_root_path+"index/ajaxFetchArea",
      focus: function( event, ui ) {
        $( "#packageAreaTextbox" ).val( ui.item.label );
        return false;
      },
      select: function( event, ui ) {
        $( "#packageAreaTextbox" ).val( ui.item.label );
        //$( "#testSearch_1-id" ).val( ui.item.value );
        //$( "#testSearch_1-description" ).html( ui.item.desc );
        //$( "#project-icon" ).attr( "src", "images/" + ui.item.icon );
 
        return false;
      }
    }).data("ui-autocomplete")._renderItem = function( ul, item ) {
      return $( "<li class='time'>" )
        //.append( "<a style='color: #0099cc;font-size:12px;margin-bottom:1px;'>" + item.label + "</a>" )
		.append( "<a style='color: #E81556;font-size:12px;margin-bottom:1px;'>" + item.label + "</a>" )
        .appendTo( ul );
    }; */
    $("#packageAreaTextbox").autocomplete({
        source: medtest_root_path+"Index/ajaxFetchArea",
		minLength:0
    })
	.on('focus', function() { 
		//$(this).keydown();
		 if (this.value == "")
                {
                    $(this).autocomplete("search");
                }
		})
	.on('click', function() {
		$(this).keydown(); 
	});
    $( "#packageAreaTextbox" ).autocomplete({
      minLength: 0,
      source: medtest_root_path+"Index/ajaxFetchArea",
      focus: function( event, ui ) {
		  $("#packageAreaTextbox").keydown();
        return false;
      },
      select: function( event, ui ) {
        $( "#packageAreaTextbox" ).val( ui.item.label ); 
        return false;
      }
    }).data("ui-autocomplete")._renderItem = function( ul, item ) {
      return $( "<li class='time'>" )
       //.append( "<a style='color: #0099cc;font-size:12px;margin-bottom:1px;'>" + item.label + "</a>" ) 
	   .append( "<a style='color: #E81556;font-size:12px;margin-bottom:1px;'>" + item.label + "</a>" )
        .appendTo( ul );
    };
    
    
     });
	 
function validateTest(){
	//alert( $('.test-autocomplete').val());
	var flagTest=false;
	 $('.test-autocomplete').each(function(){
		if($(this).val()!=''){
			//flagTest=true;
			
			$(this).focus();
		}
	 });
	 if($('#areaTextbox').val()!=''){
		 document.getElementById('errorMsg1').style.display='none';
		flagTest=true; 
	 }else{ 
		$('#areaTextbox').addClass('errorClass');
				document.getElementById('errorMsg1').style.display='';
				flagTest=false;
	 }
	 search_test()
	 return flagTest;
}	 

function is_value_set(){
	var data = $('#searchTestForm').serialize();	
	var searchUrl = medtest_root_path+"listing/ajaxSearchFormatting/";		
	$.post(
		searchUrl,
		{jString:data},
		function(responseText)
		{
			//alert(responseText);	
			var lt=responseText;		
			return lt;
		}		
	);	
}
// creating new test string
function search_test()
{
	//var jString = get_json_string_search_test_package();
	var data = $('#searchTestForm').serialize();	
	var searchUrl = medtest_root_path+"listing/ajaxSearchFormatting/";		
	$.post(
		searchUrl,
		{jString:data},
		function(responseText)
		{
			//alert(responseText);			
			sortTestinside(responseText);
		}		
	);
		
	return false;	
}
function search_package()
{
	//var jString = get_json_string_search_test_package();
	var data = $('#searchTestPackageForm').serialize();	
	var searchUrl = medtest_root_path+"listing/ajaxSearchFormatting/";	
	//show_loading();
	//alert(data);
	$.post(
		searchUrl,
		{jString:data},
		function(responseText)
		{
			//alert(responseText);			
			sortTestinside(responseText);
		}		
	);
		
	return false;	
}

function sortTestinside(jstring){	
	var allVals = [];var allValsClinic = [];
	var data = $('#searchTestForm').serialize();
	
	var result =jstring;
	//alert(result);
	$("input:checkbox[name=cbArea]:checked").each(function(){
     	//allVals.push('"'+$(this).val()+'"');	
		$(this).attr('checked', false); 
	});	
	var value=0	
		
	if($("#cbHomeCollection").prop('checked') == true){
		// value=id;
		 $('#cbHomeCollection').attr('checked', false); 
	}	
	
	$("input:checkbox[name=cbClinic]:checked").each(function(){
     	//allValsClinic.push('"'+$(this).val()+'"');
		$(this).attr('checked', false);
			 
	});	
	
	var value=0;			
	if($("#cbHomeCollection").prop('checked') == true){
		 value=id;
	}	
	var stringAreaID=allVals.join(",");	
	var stringAreaIDFnl ='{"AreaIDS":['+stringAreaID+']}';
	var stringHomeColltn='{"HOmeCollection":["'+value+'"]}';	
	var stringClinicID=allValsClinic.join(",");	
	var stringClinicIDFnl ='{"ClinicIDS":['+stringClinicID+']}';
	
		
	var finalResult={"filterResults":[
			{"tests":result},
			{"AreaID":stringAreaIDFnl},
			{"HomeCollection":stringHomeColltn},
			{"ClinicID":stringClinicIDFnl},
			]};			
	finalResult=JSON.stringify(finalResult);	
	//console.log(finalResult);
	$(document).ready(function() {
		$('#loaded_data').html('');
		$('#loaded_data').vasplus_post_scroller({
	
			vpb_total_per_load  : 10, // Total number of posts per scroll to be loaded on the page
			vpb_start           : 0, // Default - loading start at 0 offset
			srchArrItms			: finalResult,
			vpb_no_more         : '<div class="loading_msg"><!--<span><img src="img/logo.png" width="35" height="35"></span>--> NO MORE RESULTS.</div>', // This is the message shown to the user when the post is finished
			vpb_load_more       : '<div class="loading_msg"><span><img src="img/loader.GIF" width="35" height="35"></span> FINDING MORE RESULTS FOR YOU, BEAR WITH US</div>', // This is the message shown to the user when set auto scroll to false to load more data    
			vpb_delay           : 600, // Wait after this time when a user scrolls down to start again
			vpb_auto_load       : true, // Set to true for auto scroll and set to false to scroll manually
			vpb_page_identifier : 'laod-more-post', // Not really necessary unless you need it otherwise leave it alone
			vpb_url             : medtest_root_path+"listing/listing/", // This is the URL to the page that gets content from the database
			vpb_loading_div_id  : 'vpb_loading_box' // This is the ID of the div where the loaded contents will be displayed
			
		});
	});
}

function validateTest(){
	//alert( $('.test-autocomplete').val());
	var flagTest=false;var count = 0;
	 $('.test-autocomplete').each(function(){
		if($(this).val()!=''){
		
			flagTest=true;		
			document.getElementById('errorMsg').style.display='none';
		}else{
			//$(this).focus();
			
			if(count==0){
				$(this).addClass('errorClass');
				document.getElementById('errorMsg').style.display='';
			} else {
				document.getElementById('errorMsg').style.display='none';	
			}
		}
	 });
	 return flagTest;
}

function writeReviewContent(string){
	
	$('#modal_review_content').html(string);
		// $(document).on('click', '#termsModalLink', function(){
		  $('#ReviewModal').modal({backdrop: 'static'}); 
	 //});
		
	}
</script>
<style>
    #termsModal .modal-dialog  {width:75%;padding-top:3% !important;}
    #termsModal .modal-body {
        max-height: 400px !important;
        overflow-y: auto !important;
    }
</style>
<div class="container">
  <div class="row clearfix">
    <div class="col-md-12">
      <div class="breadcrumb"> <a href="<?php echo Configure::read('medtest_root_path');?>"> One Health </a><span class="sep"></span> Tests/Packages  <?php if($slctdArea!=""){ ?><span class="sep"></span> <span class="active"><?php echo ucfirst($slctdArea);?></span>
      
      <?php } ?>
      </div>
    </div>
  </div>
  <div class="row clearfix">
    <div class="col-md-3 column ">
      <div class="search_filter">
        
        <div class="accordion-container"> <a href="#" class="accordion-toggle open">
          <h4>Additional Filters <span >&nbsp;</span></h4>
          </i></span></a>
          <div class="accordion-content" style="display: block;">

            <div id="homeCheckbox" class="checkbox">
              <label>
                <input type="checkbox" id="cbHomeCollection" name="cbHomeCollection"  onclick="javascript:sortFurtherHomeCollection();"  value="home" >
                Home Collection</label>
            </div>
          
          </div>
          <!--/.accordion-content-->
        </div>  
          
        <div class="accordion-container"> 
        	<h4>Nearby Areas </h4>
            
        	<?php
			
				$l=1;
			 foreach($areaList as $key=>$listItem){ if($l<4){  ?>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="cbArea"  onclick="javascript:sortFurther(<?php echo $key;?>);"  value="<?php echo $key;?>" <?php if(@$slctdArea ==$listItem){ echo 'checked="checked"';} ?>  >
                <?php echo $listItem;?></label>
            </div> 
             <?php } if($l==4){   ?>
        <a href="#" class="accordion-toggle"> &nbsp; <span >&nbsp;</span></a>
          <div class="accordion-content"  >
          <?php } if($l>4){  ?>
            <div class="checkbox">
              <label>
                <input type="checkbox" name="cbArea"  onclick="javascript:sortFurther(<?php echo $key;?>);"  value="<?php echo $key;?>" <?php if(@$slctdArea ==$listItem){ echo 'checked="checked"';} ?>  >
                <?php echo $listItem;?></label>
            </div> 
            <?php
			
			 }
			 $l++;
			 }?> 
          </div>
          <!--/.accordion-content-->
        </div>
     
        
        
        
        <div class="accordion-container"> 
          <!--/.accordion-content-->
          
          <h4>Nearby Clinics</h4>
            
        	<?php
		//echo '<pre>';
                //print_r($clinicList);
                
		$l=1;
                foreach($clinicList as $key=>$listItem){ 
                             
                if($l<4){  ?>
                <div class="checkbox">
                <label>
                <input type="checkbox" name="cbClinic"  onclick="javascript:sortFurtherClinic(<?php echo $listItem['Clinic']['id'];?>);"  value="<?php echo $listItem['Clinic']['id'];?>" <?php if(@$slctdArea ==$listItem){ echo 'checked="checked"';} ?>  >
                <?php echo ucwords($listItem['Clinic']['clinic_name']." - ".$listItem['Area']['area_name']);?></label>
                </div> 
                <?php }
                    $l++;
                }
                ?>
                
                <?php if(count($clinicList)>3){ ?>
                <a href="#" class="accordion-toggle" id=""> &nbsp; <span >&nbsp;</span></a>
                <div class="accordion-content">     
                <?php
                $j=1;
                
                foreach($clinicList as $key=>$listItem){     
                        if($j>3){  ?>
                      
                <div class="checkbox">
                <label>
                <input type="checkbox" name="cbClinic"  onclick="javascript:sortFurtherClinic(<?php echo $listItem['Clinic']['id'];?>);"  value="<?php echo $listItem['Clinic']['id'];?>" <?php if(@$slctdArea ==$listItem){ echo 'checked="checked"';} ?>  >
                <?php echo ucwords($listItem['Clinic']['clinic_name']." - ".$listItem['Area']['area_name']);?></label>
                </div> 
                     
                <?php  }
			 $j++;
                }
                ?> 
                </div>
                
                <?php } ?>
          
        </div>
        
        
       
        <div class="row clearfix">
          <!--<div class="col-md-12 ad_block"> <img src="img/ad.jpg" width="160" height="600" alt="ad"></div>-->
        </div>
      </div>
    </div>
    <div class="col-md-9 column search_wrapp search_wrapp_inner">
      <div class="tabbable" id="tabs-308916">
        <ul class="nav nav-tabs">
          <li class="tab-pane tab1 active"> <a href="#panel1" data-toggle="tab">&nbsp;TESTS&nbsp;</a> </li>
          <li class="tab-pane tab2"> <a href="#panel2" data-toggle="tab">PACKAGES</a> </li>
        </ul>
        <!--<div class="call_back"><a class="fancybox" href="javascript:void(0)" id="callback_form_link">Request Call back</a></div>-->
        <div class="tab-content">
          <div class="tab-pane active tab-content1" id="panel1">
            <?php 
            echo $this->Form->create('searchTest', array('id'=>'searchTestForm','class'=>'SearchFormInside','type'=>'get','url'=>array('controller'=>'listing','action'=>'index'),'autocomplete'=>'off'));
			//
            ?>  
             <div class="row clearfix">
                <div class="col-md-6 row1">
                  <div id="test_list">  
                  <div class="form-group search_field1">
                    <?php echo $this->Form->input('test_name',array('name'=>'testSearch[]','div'=>false, 'label'=>false, 'class'=>'form-control autocomplete test-autocomplete', 'id'=>'testSearch_1', 'error'=>false,'placeholder'=>'eg. Platelet Count or ECG or MRI etc'));?>  
                   
                  </div>
                  <span id="errorMsg" style="display:none;color:#E81556;">Choose test to Search</span>
                  </div>    
                  <span class="add_textfield"><a href="javascript:void(0)" id="addTestLink">+ Add Another Test</a></span> 
                </div>
                <div class="col-md-4 row2" >
                  <div class="form-group search_field2">
                     <?php echo $this->Form->input('area_name',array('name'=>'areaSearch','div'=>false, 'label'=>false, 'class'=>'form-control', 'id'=>'areaTextbox', 'error'=>false,'placeholder'=>'Choose by Location / Pincode', 'value'=>$_SESSION['areaName']));?>  
                    
                  </div>
                </div>
                <div class="col-md-2 row3" >
                  <?php //echo $this->Form->submit('save_btn.png', array('class'=>'onhover', 'border' => '0', 'div' =>false, 'onclick' => '')); ?>
                  <button type="submit" class="btn btn-default" onclick="javascript: return validateTest();">Search</button> 
                  <!--onclick="javascript: return validateTest();"-->
                </div>
              </div>
            <?php echo $this->Form->end(); ?>         
          </div>
          <div class="tab-pane tab-content2" id="panel2" style="padding-bottom: 20px;">
             <?php
			 //
			  echo $this->Form->create('searchTestPackage', array('id'=>'searchTestPackageForm','class'=>'SearchFormInside',  'type'=>'get','url'=>array('controller'=>'listing','action'=>'index'),'autocomplete'=>'off'));?>
              <div class="row clearfix">
                <div class="col-md-3 row1" >
                    
                  <div class="form-group search_field1">
                   <?php if($_SESSION['searchPackageValue']=="undefined"){ $_SESSION['searchPackageValue'] = "All"; } ?>
                    <select name="packageSearch" class='form-control autocomplete package-autocomplete'  id='packageSearch' style="height: 41px;" >
                        <option value="All"<?php if($_SESSION['searchPackageValue']=="All"){ ?> selected="selected"<?php } ?>>All</option>
                         <option value="Men"<?php if($_SESSION['searchPackageValue']=="Men"){ ?> selected="selected"<?php } ?>>Men</option>
                          <option value="Women"<?php if($_SESSION['searchPackageValue']=="Women"){ ?> selected="selected"<?php } ?>>Women</option>
                          <option value="Senior Citizen"<?php if($_SESSION['searchPackageValue']=="Senior Citizen"){ ?> selected="selected"<?php } ?>>Senior Citizen</option>
                          <option value="Child"<?php if($_SESSION['searchPackageValue']=="Child"){ ?> selected="selected"<?php } ?>>Child</option>
                      </select>
                   
                  </div>  
                  
                  </div>
				  <div class="col-md-3 row2" >
                  <div class="form-group search_field2">
				  <?php if($_SESSION['searchPackagesubCatValue']=="undefined"){ $_SESSION['searchPackagesubCatValue'] = "Full body"; } ?>
                    <select name="package_subcat" id="package_subcat" class='form-control autocomplete package-autocomplete' style="height: 41px;">
						<option value="Full body"<?php if($_SESSION['searchPackagesubCatValue']=="Full body"){ ?> selected="selected"<?php } ?>>Full body</option>
                        <option value="Diabetes"<?php if($_SESSION['searchPackagesubCatValue']=="Diabetes"){ ?> selected="selected"<?php } ?>>Diabetes</option>
                        <option value="Arthritis"<?php if($_SESSION['searchPackagesubCatValue']=="Arthritis"){ ?> selected="selected"<?php } ?>>Arthritis</option>
                        <option value="Anaemia"<?php if($_SESSION['searchPackagesubCatValue']=="Anaemia"){ ?> selected="selected"<?php } ?>>Anaemia</option>
						<option value="Pregnancy"<?php if($_SESSION['searchPackagesubCatValue']=="Pregnancy"){ ?> selected="selected"<?php } ?>>Pregnancy</option>
                        <option value="Pre - Operative"<?php if($_SESSION['searchPackagesubCatValue']=="Pre - Operative"){ ?> selected="selected"<?php } ?>>Pre - Operative</option>
					</select>
                  </div>
                </div>
                <div class="col-md-4 row2" >
                  <div class="form-group search_field2">
                     <?php echo $this->Form->input('package_area_name',array('name'=>'areaSearch','div'=>false, 'label'=>false, 'class'=>'form-control', 'id'=>'packageAreaTextbox', 'error'=>false,'placeholder'=>'eg. Indiranagar','value'=>$_SESSION['areaName']));?>  
                    
                  </div>
                </div>
                <div class="col-md-2 row3" >
                  <button type="submit" class="btn btn-default">Search</button>
                   <!--onclick="javascript: return search_package();"-->
                </div>
              </div>
            <?php echo $this->Form->end(); ?> 
            <!--<form role="form">
              <div class="row clearfix">
                <div class="col-md-6 row1" >
                  <div class="form-group search_field1">
                    <input type="text" class="form-control" id="Inputtext1" placeholder="Precautions & Preparations">
                  </div>
                  <div class="form-group search_field1 additional">
                    <input type="text" class="form-control" id="Inputtext2" placeholder="Additional Search">
                  </div>
                  <span class="add_textfield"><a href="#">+ Add Another Test</a></span> </div>
                <div class="col-md-4 row2" >
                  <div class="form-group search_field2">
                    <input type="text" class="form-control" id="Inputtext3" placeholder="Area">
                  </div>
                </div>
                <div class="col-md-2 row3" >
                  <button type="submit" class="btn btn-default">Search</button>
                </div>
              </div>
            </form>-->
          </div>
        </div>
      </div>
      <div class="row clearfix ">
        <div class="col-md-12 column ">
          <div class="result_text" style="font-size:14px;">Showing results for <span>
          '<span class="text_blue" style="font-size:14px;">
		  <?php $k=1;
		    foreach($meta_title_arr as $key=>$test){
				if($k>1 ) echo '<font color="#000000">,</font>';			  
		  	echo "".$test; 
			$k++;
		  }
		   ?></span>'
       </span><?php if(isset($_REQUEST['packageSearch'])) echo 'Packages'; else echo 'Test(s)'; ?> <?php if($_REQUEST['areaSearch']!="") echo 'in';  ?> '<span style="font-size:14px;"><?php if($_REQUEST['areaSearch']!="") echo $_REQUEST['areaSearch']; ?></span>'.</div>
        </div>
      </div>
      
      
      
<!--  Search result Block row start AJAX PAGING COMES HERE --> 

<div id="loaded_data"></div>

<!--  Search result Block row start --> 

    </div>
  </div>
</div>
 <a href="javascript:void(0)" class="cd-top">Top</a>
<!-- ###################  contact form ########################### --> 
<div class="modal fade" id="callbackformModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Request Call Back</h4>
      </div>
       <div class="modal-body" id="modal_body" style="display:none;">
       </div>
      <div class="modal-body" id="modal_body_a">
      
        <form role="form">
          <div class="form-group">
            <label for="contact-name" class="control-label">Name:</label>
            <input type="text" class="form-control" id="contact_name">
            <span class="" id="error_contact_name" style="display:none;color:red" ></span>
          </div>
          <div class="form-group">
            <label for="contact-email" class="control-label">Email:</label>
            <input type="text" class="form-control" id="contact_email">
            <span class="" id="error_contact_email" style="display:none;color:red" ></span>
          </div>
            <div class="form-group">
            <label for="contact-mobile" class="control-label">Mobile:</label>
            <input type="text" class="form-control" id="contact_mobile">
            <span class="" id="error_contact_mobile" style="display:none;color:red" ></span>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="javascript:validate_callback();">Submit</button>
      </div>
    </div>
  </div>
</div>
          
 <!-- ###################  contact form ########################### --> 

 <!-- ################### Terms & Condtions########################### --> 
 
 <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="exampleModalLabel"></h4>
      </div>
       <div class="modal-body" id="modal_body" style="display:none;">
       </div>
      <div class="modal-body" id="modal_body_a">
      
        <?php echo $this->Element('Common/terms_and_condition'); ?>


        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>        
      </div>
    </div>
  </div>
</div>

  <!-- ################### Terms & Condtions########################### --> 
  
   <!-- ################### Reviews ########################### --> 
 
 <div class="modal fade" id="ReviewModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="exampleModalLabel"> Customer Review(s)</h4>
      </div>
       <div class="modal-body" id="modal_body" style="display:none;">
       </div>
      <div class="modal-body" id="modal_review_content">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>        
      </div>
    </div>
  </div>
</div>
  <!-- ################### Reviews########################### --> 
 
