<script type="text/javascript"> jQuery.noConflict(); </script>
<?php

echo $this->Html->script('jquery-v1.8.3.js');
echo $this->Html->script('bootstrap.min.js');
echo $this->Html->script("jquery.json-2.2.min.js");
?>
<script language="javascript">

var medtest_root_path = "<?php echo $this->webroot;?>";


$(document).ready(function(){
     

    $('#partner_form input[name="partner_type"]').on('change', function() {
        var radio_val = $("input:radio[name='partner_type']:checked").val();
        if(radio_val == "organization"){
            $('#organiation_det').show();
        }else{
         $('#organiation_det').hide();
        }
    });
    
});

function hide_error_msg(){
    
        $("#error_partner_type").hide();
        
        $("#error_parnter_name").hide();
        
        $("#error_parnter_email").hide();
        
        $("#error_parnter_mobile").hide();
        
        $("#error_parnter_organization").hide();
        
}

function validate_partner_with_us(){
    
        hide_error_msg();
    
        var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
    
        $("#parnter_name").val($("#parnter_name").val().trim());
        $("#parnter_email").val($("#parnter_email").val().trim());
        $("#parnter_mobile").val($("#parnter_mobile").val().trim());
	
        
        var radio_val = $("input:radio[name='partner_type']:checked").val();
        
        
	var errMessage = new Array();
	var errMessageIndex = new Array();
        
        if($('input[name=partner_type]:checked').length<=0)
        {
            errMessage.push('Please select one option.');
            errMessageIndex.push('partner_type');
        }
        
        if( $("#parnter_name").val() == '' ) {
		errMessage.push('Please enter data for name.');
		errMessageIndex.push('parnter_name');
	}
        
        if( $("#parnter_email").val() == '' ) {
		errMessage.push('Please enter data for email.');
		errMessageIndex.push('parnter_email');
	}else{
            if(!$("#parnter_email").val().match(emailExp)){
                errMessage.push('Please enter a valid email.');
                errMessageIndex.push('parnter_email');  
            }
        }
        
        if( $("#parnter_mobile").val() == '' ) {
		errMessage.push('Please enter data for mobile.');
		errMessageIndex.push('parnter_mobile');
	}
        
        if(radio_val=="organization"){
             
            if( $("#parnter_organization").val() == '' ) {
		errMessage.push('Please enter data for organization name.');
		errMessageIndex.push('parnter_organization');
            }
            
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
		request_partner_with_us();
                return false;
	}
    
}

function get_json_string_for_request_partner_with_us()
{
	var parnter_type = $('input[name=partner_type]:checked').val();	
	var parnter_name = $('#parnter_name').val();
	var parnter_email = $('#parnter_email').val();
	var parnter_mobile = $('#parnter_mobile').val();
        var parnter_organaization = '';
        if(parnter_type=='organization'){
           parnter_organaization = $('#parnter_organization').val();
        }
	var parnter_alter_number = $('#parnter_alter_number').val();	
	var parnter_proposition = $('#parnter_proposition').val();	
	var parnter_address = $('#parnter_address').val();	
	
	//alert(contact_name);
	parnter_name = parnter_name.replace(" ","_RemSp_");
	parnter_email = parnter_email.replace(" ","_RemSp_");
	parnter_mobile = parnter_mobile.replace(" ","_RemSp_");
	parnter_organaization = parnter_organaization.replace(" ","_RemSp_");
	parnter_alter_number = parnter_alter_number.replace(" ","_RemSp_");
	parnter_proposition = parnter_proposition.replace(" ","_RemSp_");
	parnter_address = parnter_address.replace(" ","_RemSp_");
	
	var filter = {parnter_type:parnter_type,
				parnter_name:parnter_name,
				parnter_email:parnter_email,
				parnter_mobile:parnter_mobile,
				parnter_organaization:parnter_organaization,
				parnter_alter_number:parnter_alter_number,
				parnter_proposition:parnter_proposition,
				parnter_address:parnter_address};
	jString = $.toJSON(filter);
	return jString;
}
function request_partner_with_us()
{
	
	var jString = get_json_string_for_request_partner_with_us();

	var searchUrl = medtest_root_path+"pages/save_partner_with_us/";	
	//show_loading();
	//alert('sdsas');
	$.post(
		searchUrl,
		{jString:jString},
		function(responseText)
		{
                        hide_error_msg();
			$('#parnter_name').val('');	
			$('#parnter_email').val('');
			$('#parnter_mobile').val('');
                        $('#parnter_organization').val('');
                        $('#parnter_alter_number').val('');
                        $('#parnter_website').val('');
                        $('#parnter_address').val('');
			$('#parnter_proposition').val('');
			$('#myModalPartnerUs').modal();  
			
		}		
	);
		
	return false;	
}	

</script>

<div class="container">
  <div class="row clearfix">
    <div class="col-md-12">
      <div class="breadcrumb">  <a href="<?php echo Configure::read('medtest_root_path');?>"> HealthX.in </a><span class="sep"></span>  Partner with us</div>
    </div>
  </div>
  <div class="row clearfix">
    <div class="col-md-8 inner_content">
      <div class="row clearfix title_block">
        <div class="col-md-12">
          <h3 class="title"><span>Partner</span> With Us</h3>
        </div>
      </div>
      <!--<div class="row clearfix">
        <div class="col-md-12">
          <p class="text">MyHealthCheckup is an initiative that creates awareness about the latest health checkup packages being offered by diagnostic clinics and hospitals alike. This enterprise combines the ease of internet access with comprehensive descriptions of health packages and the ability to purchase them with the simple click of a button. </p>
        </div>
      </div>-->
      <div class="row clearfix">
        <div class="col-md-12 form_wrapp">
          <h4>Well need the following information</h4>
          <form role="form" name="partner_form" id="partner_form">
            <div class="form-group radio_wrapp">
             <span style="float:left;">I am</span> 
             <label class="radio-inline">
               <input type="radio" name="partner_type" id="parnter_ind" value="individual">
                An Individual</label>
              <label class="radio-inline">
                <input type="radio" name="partner_type" id="parnter_org" value="organization">
                Representing an Organization/Institution</label>
             
             <br/><span class="" id="error_partner_type" style="display:none;color:red;padding-left:55px;" ></span>
            </div>
            <div class="clearfix"></div>
            <div class="form-group ">
              <label for="parnter_name">Name</label>
              <input class="form-control" id="parnter_name" type="text" placeholder="Your Name" />
              <span class="" id="error_parnter_name" style="display:none;color:red;padding-left:" ></span>
            </div>
            <div class="form-group">
              <label for="parnter_email">Email</label>
              <input class="form-control" id="parnter_email" type="email" placeholder="Your email address" />
              <span class="" id="error_parnter_email" style="display:none;color:red;padding-left:" ></span>
            </div>
            <div class="form-group">
              <label for="parnter_mobile">Mobile</label>
              <input class="form-control" id="parnter_mobile" type="text" placeholder="Your mobile number" />
              <span class="" id="error_parnter_mobile" style="display:none;color:red;padding-left:" ></span>
            </div>
            <div id="organiation_det" style="display:none">
            <div class="title_row">DETAILS ABOUT YOUR ORGANIZATION YOU REPRESENT</div>
            <div class="form-group">
              <label for="InputName">Name</label>
              <input class="form-control" id="parnter_organization" type="text" placeholder="Organization Name" />
              <span class="" id="error_parnter_organization" style="display:none;color:red;padding-left:" ></span>
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
            </div>
            <div class="title_row">WHAT ARE YOU PROPOSING?</div>
            <div class="form-group textarea_aria2">
              <label for="InputMobile">Proposition</label>
              <textarea class="form-control" rows="3" id="parnter_proposition" placeholder="Describe your proposal briefly"></textarea>
            </div>
            <div class="btn_wrapp">
                  <button  class="btn btn-default" onclick="javascript:return validate_partner_with_us();">SUBMIT</button>
                </div>
          </form>
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

<div class="modal fade" id="myModalPartnerUs" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <!--<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>-->
        <h4 class="modal-title" id="myModalLabel"> Partner With US</h4>
      </div>
      <div class="modal-body">
        Thank you for writing to us. We will get back to you shortly!!! <br/><br/> -Team HealthX.
        
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>