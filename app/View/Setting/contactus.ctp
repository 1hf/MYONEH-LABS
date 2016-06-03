<script type="text/javascript"> jQuery.noConflict(); </script>
<?php

echo $this->Html->script('jquery-v1.8.3.js');
echo $this->Html->script('bootstrap.min.js');
echo $this->Html->script("jquery.json-2.2.min.js");
?>
<script language="javascript">

var medtest_root_path = "<?php echo $this->webroot;?>";
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
	//alert('sdsas');
	$.post(
		searchUrl,
		{jString:jString},
		function(responseText)
		{
			//alert('sdsas');
			$('#myModal').modal();  
			
		}		
	);
		
	return false;	
}	

function get_json_string_for_request_contactus()
{
	var contactus_name = $('#contactus_name').val();	
	var contactus_email = $('#contactus_email').val();
	var contactus_mobile = $('#contactus_mobile').val();
	var contactus_message = $('#contactus_message').val();	
	//alert(contact_name);
	contact_name = contact_name.replace(" ","_RemSp_");
	contact_email = contact_email.replace(" ","_RemSp_");
	contact_mobile = contact_mobile.replace(" ","_RemSp_");
	
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

	var searchUrl = medtest_root_path+"setting/request_contactus/";	
	//show_loading();
	//alert('sdsas');
	$.post(
		searchUrl,
		{jString:jString},
		function(responseText)
		{
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
      <div class="breadcrumb"> myhealthcheckup.in <span class="sep"></span> Contact Us</div>
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
              </div>        <br/>
              <div class="form-group">
                <input type="email" placeholder="Your Email Address" id="contactus_email" class="form-control">
              </div>        <br/>
              <div class="form-group">
                <input type="text" placeholder="Your Phone Number" id="contactus_mobile" class="form-control">
              </div>        <br/>
               <div class="form-group clearfix textarea">
              <textarea class="form-control" rows="2" id="contactus_message" placeholder="Your Query"></textarea>
            </div>
              <div class="btn_wrapp">
                <button type="submit" class="btn btn-default" onclick="javascript:return request_contact_us();">Submit Query</button>
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
        <p class="address">#729, 10th Main, 4th Block Jayanagar, <br/>
	Bangalore, Karnataka</p>
        <p class="phone">+91 80 4172 2689<br/>
	+91 953 808 0180</p>
        <p class="email"><a href="mailto:info@healthx.in">info@healthx.in</a></p>
        <p class="fb"><a href="#">Find us on facebook</a></p>
        <p class="twitter"><a href="#">Follow us on Twitter</a></p>
 
        
        </div>
        
         <div class="col-md-6 map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3888.5917598954093!2d77.58521504485547!3d12.93393953980103!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bae15bdf45620a9%3A0x97fb4f1e032feda2!2s10th+Main+Rd%2C+Raghavendra+Complex%2C+4th+Block%2C+Jaya+Nagar+East%2C+Jayanagar%2C+Bengaluru%2C+Karnataka+560041!5e0!3m2!1sen!2sin!4v1419078591892" width="100%" height="211" frameborder="0" style="border:0"></iframe>
        
        </div>
        
        
        
        </div>
          
          
          
        </div>
      </div>
    </div>
    <div class="col-md-4  ">
      <div class="accordion call_back_btn_wrapp" id="accordion2">
        <div class="accordion-group">
          <div class="accordion-heading"> <a class="accordion-toggle call_back_big" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne"> Request Call back </a> </div>
          <div id="collapseOne" class="accordion-body collapse in">
            <div class="accordion-inner">
              <form role="form" >
                <div class="form-group">
                  <input type="text" class="form-control" id="contact_name" placeholder="Name">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="contact_email" placeholder="Email">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="contact_mobile" placeholder="Mobile">
                </div>
                <div class="btn_wrapp"><button type="submit" class="btn btn-default" onclick="javascript:return request_call_back();">Submit</button></div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="ad"><img src="../../img/ad2.jpg" width="300" height="600"></div></div>
  </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>-->
        <h4 class="modal-title" id="myModalLabel"> Request Call back</h4>
      </div>
      <div class="modal-body">
        Thank you for contacting us. We will get back to you shortly!!! <br /> -Team HealthX.
        
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        <button type="button" class="btn btn-primary" >OK</button>
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
        Thank you for contacting us. We will get back to you shortly!!! <br /> -Team HealthX.
        
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        <button type="button" class="btn btn-primary" >OK</button>
      </div>
    </div>
  </div>
</div>