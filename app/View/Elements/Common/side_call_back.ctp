<script language="javascript">

var medtest_root_path = "<?php echo $this->webroot;?>";


function validate_callback(){
    
        $("#error_contact_name").hide();
        
        $("#error_contact_email").hide();
        
        $("#error_contact_mobile").hide();
    
        var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    
        $("#contact_name").val($("#contact_name").val().trim());
        $("#contact_email").val($("#contact_email").val().trim());
        $("#contact_mobile").val($("#contact_mobile").val().trim());
	
	var errMessage = new Array();
	var errMessageIndex = new Array();
        
        if( $("#contact_name").val() == '' ) {
		errMessage.push('Please enter data for contact name.');
		errMessageIndex.push('contact_name');
	}
        
        if( $("#contact_email").val() == '' ) {
		errMessage.push('Please enter data for contact email.');
		errMessageIndex.push('contact_email');
	}else{
            if(!$("#contact_email").val().match(emailExp)){
                errMessage.push('Please enter a valid contact email.');
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
//alert("hai")

	var contact_name = $('#contact_name').val();	
	var contact_email = $('#contact_email').val();
	var contact_mobile = $('#contact_mobile').val();	
	
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
	
	$.post(
		searchUrl,
		{jString:jString},
		function(responseText)
		{
                    
                    $('#contact_name').val('');	
                    $('#contact_email').val('');
                    $('#contact_mobile').val('');
                    $('#myModalRequestCallBack').modal(); 
			
		}		
	);
		
	return false;	
}
</script>	
<div class="accordion call_back_btn_wrapp" id="accordion2">
        <div class="accordion-group">
          <div class="accordion-heading"> <a class="accordion-toggle call_back_big" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne"> Request Call back </a> </div>
          <div id="collapseOne" class="accordion-body collapse">
            <div class="accordion-inner">
              <form role="form" name="request_call_back" id="request_call_back">
                <div class="form-group">
                  <input type="text" class="form-control" id="contact_name" placeholder="Name">
                  <span class="" id="error_contact_name" style="display:none;color:#fff" ></span>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="contact_email" placeholder="Email">
                  <span class="" id="error_contact_email" style="display:none;color:#fff" ></span>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="contact_mobile" placeholder="Mobile">
                  <span class="" id="error_contact_mobile" style="display:none;color:#fff" ></span>
                </div>
                <div class="btn_wrapp"><button  class="btn btn-default" onclick="javascript:return validate_callback();">Submit</button></div>
              </form>
            </div>
          </div>
        </div>
      </div>