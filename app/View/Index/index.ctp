<?php
//echo $this->Html->script("jquery.json-2.2.min.js");
echo $this->Html->script("https://cdnjs.cloudflare.com/ajax/libs/jquery-json/2.5.1/jquery.json.min.js");
?>

<script type="text/javascript">
    
    var medtest_root_path = "<?php echo $this->webroot;?>";
  	
    $(document).ready(function(){
            
    $(document).on('click', '#callback_form_link', function(){
		$( "#modal_body" ).hide();
		$( "#modal_body_a" ).show();
                $('.btn-primary').show();
		$('#contact_name').val('');	
		$('#contact_email').val('');
		$('#contact_mobile').val('');
        $('#callbackformModal').modal({backdrop: 'static'}); 
    });
     
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
		  $("#areaTextbox").keydown();
        return false;
      },
      select: function( event, ui ) {
        $( "#areaTextbox" ).val( ui.item.label ); 
        return false;
      }
    }).data("ui-autocomplete")._renderItem = function( ul, item ) {
      return $( "<li class='time'>" )
       //.append( "<a style='color: #0099cc;font-size:12px;margin-bottom:1px;'>" + item.label + "</a>" ) 
	   .append( "<a style='color: #E81556;font-size:12px;margin-bottom:1px;'>" + item.label + "</a>" )
        .appendTo( ul );
    };
	
      $(document).on("keydown#areaTextbox","#areaTextbox",function(e){ 
      $(this).autocomplete({
      minLength: 0,
      source: medtest_root_path+"Index/ajaxFetchArea",
      focus: function( event, ui ) {
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
		.append( "<a style='color: #E81556;font-size:12px;margin-bottom:1px;'>" + item.label +"</a>" )
        .appendTo( ul );
		
    };
  });
  
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
       
 
        return false;
      }
    }).data("ui-autocomplete")._renderItem = function( ul, item ) {
      return $( "<li class='time'>" )
        //.append( "<a style='color: #0099cc;font-size:12px;margin-bottom:1px;'>" + item.label + "</a>" )
		.append( "<a style='color: #E81556;font-size:12px;margin-bottom:1px;'>" + item.label + "</a>" )
        .appendTo( ul );
    };
    
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
       // .append( "<a style='color: #0099cc;font-size:12px;margin-bottom:1px;'>" + item.label + "</a>" )
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
	var count = 0;
	 $('.test-autocomplete').each(function(){
		if($(this).val()!=''){ count=count+1;
			flagTest=true;
			document.getElementById('errorMsg').style.display='none';		
			
		}else{
			//$(this).focus();
			$(this).addClass('errorClass');
			if(count==0){
				$(this).addClass('errorClass');
				document.getElementById('errorMsg').style.display='';
			} else {
				document.getElementById('errorMsg').style.display='none';	
			}
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
	 return flagTest;
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

<div class="container home_container">
<div class="row clearfix main_text">
    <div class="col-md-12" style="padding-bottom:20px;">
      <!-- <h2>Get Your Diagnostic Tests Done At Prices That Work For You!</h2> -->
	 
	  <div class="col-md-4"><img src="/img/tick-mark.svg" width="40" height="37" style="margin-top: -5px;" />&nbsp;&nbsp;<span style="font-size: 22px;color:#333;">Certified Labs</span></div>
	  <div class="col-md-4"><img src="/img/tick-mark.svg" width="40" height="37" style="margin-top: -5px;" />&nbsp;&nbsp;<span style="font-size: 22px;color:#333;">Home Collection</span></div>
	  <div class="col-md-4"><img src="/img/tick-mark.svg" width="40" height="37" style="margin-top: -5px;" />&nbsp;&nbsp;<span style="font-size: 22px;color:#333;">Lowest Price</span></div>
    </div>
  </div>
  <div class="row clearfix">
    <div class="col-md-12 column search_wrapp">
      <div class="tabbable" id="tabs-308916">
        <ul class="nav nav-tabs">
          <li class="tab-pane tab1 active"> <a href="#panel1" data-toggle="tab" id="testLink">&nbsp;TESTS&nbsp;</a> </li>
          <li class="tab-pane tab2" > <a href="#panel2" data-toggle="tab" id="packageLink" >PACKAGES</a> </li>
        </ul>
		
       <div class="call_back"><a class="fancybox" href="javascript:void(0)" id="callback_form_link">Request Call back</a></div>
        <div class="tab-content">
          <div class="tab-pane active tab-content1" id="panel1">
            <?php 
            echo $this->Form->create('searchTest', array('id'=>'searchTestForm', 'url'=>array('controller'=>'listing','action'=>'index'), 'type'=>'get','autocomplete'=>'off'));
            ?>  
             <div class="row clearfix">
                <div class="col-md-6 row1">
                  <div id="test_list">  
                  <div class="form-group search_field1">
                    <?php echo $this->Form->input('test_name',array('name'=>'testSearch[]','div'=>false, 'label'=>false, 'class'=>'form-control autocomplete test-autocomplete', 'id'=>'testSearch_1', 'error'=>false,'placeholder'=>'eg. Platelet Count or ECG or MRI etc', 'data-toggle'=>'tooltip', 'title'=>'Click & Choose your Lab test / Diagnostic Tests to book appointments.'));?>  
                   
                  </div>
                  <span id="errorMsg" style="display:none;color:#E81556;">Choose test to Search</span>
                  </div>    
                  <span class="add_textfield"><a href="javascript:void(0)" id="addTestLink">+ Add Another Test</a></span> 
                </div>
                <div class="col-md-4 row2" >
                  <div class="form-group search_field2"><!-- <div style="margin: 10px 10px -32px 267px;"><img src="img/downarrow.png" border="0" style="width: 22px;" /></div> -->
                     <?php echo $this->Form->input('area_name',array('name'=>'areaSearch','div'=>false, 'label'=>false, 'class'=>'form-control', 'id'=>'areaTextbox', 'error'=>false,'placeholder'=>'Choose by Location / Pincode', 'data-toggle'=>'tooltip', 'title'=>'Click and choose your preferred location or enter your area pincode'));?> 
					<!--<label style="margin-top: 0px;margin-left: 38px;color: #FFF;">Home Collection </label> --><input type="checkbox" name="hcollection" id="hcollection" value="home" class="form-control" style="height:20px;width:40px;color:#FFF;"><span style="color:#FFF;">Home Collection</span>
					
                  </div>
				  <span id="errorMsg1" style="display:none;color:#E81556;margin-left:15px;">Add area to Search</span>
                </div>
                <div class="col-md-2 row3" >
                  <?php //echo $this->Form->submit('save_btn.png', array('class'=>'onhover', 'border' => '0', 'div' =>false, 'onclick' => '')); ?>
                  <button type="submit" class="btn btn-default" onclick="javascript: return validateTest();">Search</button>
                </div>
              </div>
            <?php echo $this->Form->end(); ?>            
          </div>
          <div id="switcher" style="float:right"></div>
          <div class="tab-pane tab-content2" id="panel2" style="padding-bottom: 20px;">
              <?php echo $this->Form->create('searchTestPackage', array('id'=>'searchTestPackageForm', 'url'=>array('controller'=>'listing','action'=>'index'), 'type'=>'get','autocomplete'=>'off'));?>
              <div class="row clearfix">
                <div class="col-md-3 row1" >
                    
                  <div class="form-group search_field1">
                    <?php //echo $this->Form->input('package_name',array('name'=>'packageSearch','div'=>false, 'label'=>false, 'class'=>'form-control autocomplete package-autocomplete', 'id'=>'packageSearch', 'error'=>false,'placeholder'=>'Search by test package name'));?>  
                    <select name="packageSearch" class='form-control autocomplete package-autocomplete'  id='packageSearch' style="height: 41px;">
                       
                        <option value="All" selected="selected">All</option>
                         <option value="Men">Men</option>
                          <option value="Women">Women</option>
                          <option value="Senior Citizen">Senior Citizen</option>
                          <option value="Child">Child</option>
                      </select>
                   
                  </div>  
                  
                  </div>
				<div class="col-md-3 row2" >
                  <div class="form-group search_field2">
                     <?php //echo $this->Form->input('package_area_name',array('name'=>'areaSearch','div'=>false, 'label'=>false, 'class'=>'form-control', 'id'=>'packageAreaTextbox', 'error'=>false,'placeholder'=>'Choose by Location / Pincode'));?>  
                    <select name="package_subcat" id="package_subcat" class='form-control autocomplete package-autocomplete' style="height: 41px;">
						<option value="Full body">Full body</option>
                        <option value="Diabetes">Diabetes</option>
                        <option value="Arthritis">Arthritis</option>
                        <option value="Anaemia">Anaemia</option>
						<option value="Pregnancy">Pregnancy</option>
                        <option value="Pre - Operative">Pre - Operative</option>
					</select>
                  </div>
                </div>
                <div class="col-md-4 row2" >
                  <div class="form-group search_field2">
                     <?php echo $this->Form->input('package_area_name',array('name'=>'areaSearch','div'=>false, 'label'=>false, 'class'=>'form-control', 'id'=>'packageAreaTextbox', 'error'=>false,'placeholder'=>'Choose by Location / Pincode'));?>  
                    
                  </div>
                </div>
                <div class="col-md-2 row3" >
                  <button type="submit" class="btn btn-default">Search</button>
                </div>
              </div>
            <?php echo $this->Form->end(); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row clearfix steps" id="test_step">
    <div class="col-md-12">
      <div class="row clearfix">
        <div class="col-md-4"><img src="img/find_icon.png" width="42" height="39"><span>Step 1</span></br>
          Choose your test </div>
        <div class="col-md-3" style="padding:0px;"><img src="img/pick.png" width="42" height="39"><span>Step 2</span></br>
          Pick your lab </div>
        <div class="col-md-5"><img src="img/meet_icon.png" width="42" height="39"><span>Step 3</span></br>
          Home Collection / Visit center </div>
      </div>
    </div>
  </div>
  <div class="row clearfix steps" style="display:none;" id="package_step">
    <div class="col-md-12">
      <div class="row clearfix">
        <div class="col-md-4"><img src="img/find_icon.png" width="42" height="39"><span>Step 1</span></br>
          Select your category </div>
        <div class="col-md-3" style="padding:0px;"><img src="img/pick.png" width="42" height="39"><span>Step 2</span></br>
          Pick your center</div>
        <div class="col-md-5"><img src="img/meet_icon.png" width="42" height="39"><span>Step 3</span></br>
          Home Collection / Visit center </div>
      </div>
    </div>
  </div>
  <div class="row clearfix">
    <div class="col-md-8 column partners_wrapp">
      <div class="carousel slide" id="myCarousel">
        <!--<div class="carousel-inner partners">
          <div class="item">
            <div class="row">
              <div class="col-md-2"><a  href="#"> <img src="img/the_apollo_clinic.png" alt=""/></a> </div>
              <div class="col-md-2"><a  href="#"><img src="img/manipal_clinic.png" alt=""/></a> </div>
              <div class="col-md-2"><a  href="#"> <img src="img/apollo.png" alt=""/></a> </div>
              <div class="col-md-2"><a  href="#"> <img src="img/sh.png" alt=""/></a> </div>
              <div class="col-md-2"><a  href="#"> <img src="img/elbit.png" alt=""/></a> </div>
              <div class="col-md-2"><a  href="#"> <img src="img/vikram.png" alt=""/></a> </div>
            </div>
          </div>
          <div class="item">
            <div class="row">
              <div class="col-md-2"><a  href="#"> <img src="img/the_apollo_clinic.png" alt=""/></a> </div>
              <div class="col-md-2"><a  href="#"><img src="img/manipal_clinic.png" alt=""/></a> </div>
              <div class="col-md-2"><a  href="#"> <img src="img/apollo.png" alt=""/></a> </div>
              <div class="col-md-2"><a  href="#"> <img src="img/sh.png" alt=""/></a> </div>
              <div class="col-md-2"><a  href="#"> <img src="img/elbit.png" alt=""/></a> </div>
              <div class="col-md-2"><a  href="#"> <img src="img/vikram.png" alt=""/></a> </div>
            </div>
          </div>
          <div class="item active">
            <div class="row">
              <div class="col-md-2"><a  href="#"> <img src="img/the_apollo_clinic.png" alt=""/></a> </div>
              <div class="col-md-2"><a  href="#"><img src="img/manipal_clinic.png" alt=""/></a> </div>
              <div class="col-md-2"><a  href="#"> <img src="img/apollo.png" alt=""/></a> </div>
              <div class="col-md-2"><a  href="#"> <img src="img/sh.png" alt=""/></a> </div>
              <div class="col-md-2"><a  href="#"> <img src="img/elbit.png" alt=""/></a> </div>
              <div class="col-md-2"><a  href="#"> <img src="img/vikram.png" alt=""/></a> </div>
            </div>
          </div>
        </div>-->
        <a data-slide="prev" href="#myCarousel" class="left carousel-control"><i class="icon-prev"></i></a> <a data-slide="next" href="#myCarousel" class="right carousel-control"><i class="icon-next"></i></a>
        <ol class="carousel-indicators">
          <li class="" data-slide-to="0" data-target="#myCarousel"></li>
          <li data-slide-to="1" data-target="#myCarousel" class=""></li>
          <li data-slide-to="2" data-target="#myCarousel" class="active"></li>
        </ol>
      </div>
    </div>
  </div>
</div>

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
<script language="javascript">
 $('#packageLink').on('click', function(event){
	$('#test_step').hide();
	$('#package_step').show();
 });
  $('#testLink').on('click', function(event){
	$('#package_step').hide();
	$('#test_step').show();
 });
</script>
