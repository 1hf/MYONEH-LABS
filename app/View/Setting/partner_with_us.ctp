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

function get_json_string_for_request_partner_with_us()
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
function request_partner_with_us()
{
	
	var jString = get_json_string_for_request_partner_with_us();

	var searchUrl = medtest_root_path+"setting/partner_with_us/";	
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
			$('#myModalPartnerUs').modal();  
			
		}		
	);
		
	return false;	
}	

</script>

<div class="container">
  <div class="row clearfix">
    <div class="col-md-12">
      <div class="breadcrumb">  <a href="index/index"> HealthX.in </a><span class="sep"></span>  Partner with us</div>
    </div>
  </div>
  <div class="row clearfix">
    <div class="col-md-8 inner_content">
      <div class="row clearfix title_block">
        <div class="col-md-12">
          <h3 class="title"><span>Partner</span> With Us</h3>
        </div>
      </div>
      <div class="row clearfix">
        <div class="col-md-12">
          <p class="text">MyHealthCheckup is an initiative that creates awareness about the latest health checkup packages being offered by diagnostic clinics and hospitals alike. This enterprise combines the ease of internet access with comprehensive descriptions of health packages and the ability to purchase them with the simple click of a button. </p>
        </div>
      </div>
      <div class="row clearfix">
        <div class="col-md-12 form_wrapp">
          <h4>Well need the following information</h4>
          <form role="form">
            <div class="form-group radio_wrapp">
             <span style="float:left;">I am</span> 
          <label class="radio-inline">
         
                 <input type="radio" name="optradio">
                An Individual</label>
              <label class="radio-inline">
                <input type="radio" name="optradio">
                Representing an Organization/Institution</label>
            </div>
            <div class="clearfix"></div>
            <div class="form-group ">
              <label for="InputName">Name</label>
              <input class="form-control" id="parnter_name" type="text" placeholder="Your Name" />
            </div>
            <div class="form-group">
              <label for="InputEmail">Email</label>
              <input class="form-control" id="parnter_email" type="email" placeholder="Your email address" />
            </div>
            <div class="form-group">
              <label for="InputMobile">Mobile</label>
              <input class="form-control" id="parnter_mobile" type="text" placeholder="Your mobile number" />
            </div>
            <div class="title_row">DETAILS ABOUT YOUR ORGANIZATION YOU REPRESENT</div>
            <div class="form-group">
              <label for="InputName">Name</label>
              <input class="form-control" id="parnter_organaization" type="text" placeholder="Organization Name" />
            </div>
            <div class="form-group">
              <label for="InputEmail">Phone</label>
              <input class="form-control" id="parnter_alter_number" type="email" placeholder="Alternative Contact Number" />
            </div>
            <div class="form-group">
              <label for="InputMobile">Website</label>
              <input class="form-control" id="parnter_website" type="text" placeholder="Organization website" />
            </div>
            <div class="form-group textarea_aria1">
              <label for="InputMobile">Address</label>
              <textarea class="form-control" rows="3" id="parnter_address" placeholder="Organization Address"></textarea>
            </div>
            <div class="title_row">WHAT ARE YOU PROPOSING?</div>
            <div class="form-group textarea_aria2">
              <label for="InputMobile">Proposition</label>
              <textarea class="form-control" rows="3" id="parnter_proposition" placeholder="Describe your proposal briefly"></textarea>
            </div>
            <div class="btn_wrapp">
                  <button type="submit" class="btn btn-default" onclick="javascript:return request_partner_with_us();">SUBMIT</button>
                </div>
          </form>
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


<div class="modal fade" id="myModalPartnerUs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>-->
        <h4 class="modal-title" id="myModalLabel"> Partner With US</h4>
      </div>
      <div class="modal-body">
        Thank you for writing to us. We will get back to you shortly!!! <br /> -Team HealthX.
        
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        <button type="button" class="btn btn-primary" >OK</button>
      </div>
    </div>
  </div>
</div>