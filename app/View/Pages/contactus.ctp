<script type="text/javascript"> jQuery.noConflict(); </script>
<?php

echo $this->Html->script('jquery-v1.8.3.js');
echo $this->Html->script('bootstrap.min.js');
echo $this->Html->script("jquery.json-2.2.min.js");
?>
<script language="javascript">

var medtest_root_path = "<?php echo $this->webroot;?>";



function hide_error_msg(){
    

        $("#error_contactus_name").hide();

        
        $("#error_contactus_email").hide();
        
        $("#error_contactus_mobile").hide();
        
        $("#error_contactus_message").hide();
   
    }

function validate_contact_us(){
    
        hide_error_msg();
    
        var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    
        $("#contactus_name").val($("#contactus_name").val().trim());
        $("#contactus_email").val($("#contactus_email").val().trim());
        $("#contactus_mobile").val($("#contactus_mobile").val().trim());
	$("#contactus_message").val($("#contactus_message").val().trim());
        
        
	var errMessage = new Array();
	var errMessageIndex = new Array();
        
        if( $("#contactus_name").val() == '' ) {
		errMessage.push('Please enter data for contact name.');
		errMessageIndex.push('contactus_name');
	}
        
        if( $("#contactus_email").val() == '' ) {
		errMessage.push('Please enter data for contact email.');
		errMessageIndex.push('contactus_email');
	}else{
            if(!$("#contactus_email").val().match(emailExp)){
                errMessage.push('Please enter a valid contact email.');
                errMessageIndex.push('contactus_email');  
            }
        }
        
        if( $("#contactus_mobile").val() == '' ) {
		errMessage.push('Please enter data for phone number.');
		errMessageIndex.push('contactus_mobile');
	}
        
        if( $("#contactus_message").val() == '' ) {
		errMessage.push('Please enter data for query.');
		errMessageIndex.push('contactus_message');
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
		request_contact_us();
                return false;
	}
    
}	

function get_json_string_for_request_contactus()
{
	var contactus_name = $('#contactus_name').val();	
	var contactus_email = $('#contactus_email').val();
	var contactus_mobile = $('#contactus_mobile').val();
	var contactus_message = $('#contactus_message').val();	
	//alert(contact_name);
	contactus_name = contactus_name.replace(" ","_RemSp_");
	contactus_email = contactus_email.replace(" ","_RemSp_");
	contactus_mobile = contactus_mobile.replace(" ","_RemSp_");
	contactus_message = contactus_message.replace(" ","_RemSp_");
	
	var filter = {contactus_name:contactus_name,
				contactus_email:contactus_email,
				contactus_mobile:contactus_mobile,
				contactus_message:contactus_message};
	jString = $.toJSON(filter);
	return jString;
}
function request_contact_us()
{
	
	var jString = get_json_string_for_request_contactus();

	var searchUrl = medtest_root_path+"pages/request_contactus/";	
	//show_loading();
	//alert('sdsas');
	$.post(
		searchUrl,
		{jString:jString},
		function(responseText)
		{
			hide_error_msg();
                        $('#contactus_name').val('');	
			$('#contactus_email').val('');
			$('#contactus_mobile').val('');
			$('#contactus_message').val('');
			$('#myModalContactus').modal();  
			
		}		
	);
		
	return false;	
}	

</script>

<div class="container">
  <div class="row clearfix">
    <div class="col-md-12">
      <div class="breadcrumb"> <a href="<?php echo Configure::read('medtest_root_path');?>"> HealthX.in </a> <span class="sep"></span> Contact Us</div>
    </div>
  </div>
  <div class="row clearfix">
    <div class="col-md-8 inner_content text_style text_style2">
      <div class="row clearfix title_block">
        <div class="col-md-12">
          <h3 class="title">Contact Us <span>Get in touch</span></h3>
        </div>
      </div>
      <div class="row clearfix">
        <div class="col-md-12">
          <div class="form_inner">
            <h3>Have something to tell us?</h3>
            <p class="sub_text">Any queries, questions or clarifications you might have with our services, you can share with us here</p>
            <form role="form" class="form-inline">
             
      
              <div class="form-group">
                <input type="text" placeholder="Your Name" id="contactus_name" class="form-control">
                <br/><span class="" id="error_contactus_name" style="display:none;color:red" ></span>
              </div> <br/>
              <div class="form-group">
                <input type="email" placeholder="Your Email Address" id="contactus_email" class="form-control">
                <br/><span class="" id="error_contactus_email" style="display:none;color:red" ></span>
              </div>        <br/>
              <div class="form-group">
                <input type="text" placeholder="Your Phone Number" id="contactus_mobile" class="form-control">
                <br/><span class="" id="error_contactus_mobile" style="display:none;color:red" ></span>
              </div>        <br/>
               <div class="form-group clearfix textarea">
              <textarea class="form-control" rows="2" id="contactus_message" placeholder="Your Query"></textarea>
              <br/><span class="" id="error_contactus_message" style="display:none;color:red" ></span>
            </div>
              <div class="btn_wrapp">
                <button  class="btn btn-default" onclick="javascript:return validate_contact_us();">Submit Query</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="row clearfix">
        <div class="col-md-12">
         
          
           <div class="row clearfix">
        <div class="col-md-6 address_wrapper">
        <div class="title_row">YOU CAN FIND US HERE</div>
        <!--<p class="address">#729, 10th Main, 4th Block Jayanagar, <br/>
	Bangalore, Karnataka</p>-->
        <p class="phone">+91 953 80 80 180</p>
        <p class="email"><a href="mailto:info@healthx.in">info@healthx.in</a></p>
        <p class="fb"><a target="_blank" href="https://www.facebook.com/healthx.in">Find us on facebook</a></p>
        <p class="twitter"><a target="_blank" href="https://www.twitter.com/healthx.in">Follow us on Twitter</a></p>
 
        
        </div>
        
        <div class="col-md-6 map">
        <!--    
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.5917598954093!2d77.58521504485547!3d12.93393953980103!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae15bdf45620a9%3A0x97fb4f1e032feda2!2s10th+Main+Rd%2C+Raghavendra+Complex%2C+4th+Block%2C+Jaya+Nagar+East%2C+Jayanagar%2C+Bengaluru%2C+Karnataka+560041!5e0!3m2!1sen!2sin!4v1419078591892" width="100%" height="211" frameborder="0" style="border:0"></iframe>
        -->
        </div>
        
        
        
        </div>
          
          
          
        </div>
      </div>
    </div>
    <div class="col-md-4  ">
      <?php echo $this->Element('Common/side_call_back'); ?>
      <div class="ad">
          <?php //echo $this->Html->image('ad2.jpg', array('alt' => 'ad', 'border' => '0','width'=>'300','height'=>'600')); ?>
          
      </div></div>
  </div>
</div>

<div class="modal fade" id="myModalRequestCallBack" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>-->
        <h4 class="modal-title" id="myModalLabel"> Request Call Back</h4>
      </div>
      <div class="modal-body">
        Thank you for contacting us. We will get back to you shortly!!! <br /><br /> -Team HealthX.
        
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="myModalContactus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>-->
        <h4 class="modal-title" id="myModalLabel"> Contact US</h4>
      </div>
      <div class="modal-body">
        Thank you for contacting us. We will get back to you shortly!!! <br /><br /> -Team HealthX.
        
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>