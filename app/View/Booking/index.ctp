<?php
@set_magic_quotes_runtime(false);
ini_set('magic_quotes_runtime', 0);
?>
<script type="text/javascript">
    
    var medtest_root_path = "<?php echo $this->webroot;?>";
  
  
    function removeTestorPackage(test_package_id,test_type){
        
        var status_url = medtest_root_path+'booking/unset_test_data/';
	var redirect_url = medtest_root_path+'booking/index/';
        var data = {test_package_id : test_package_id,test_type:test_type};	
        
        if(test_package_id!=""){
                                    $.ajax
					({
						type	: 'post',
						url     : status_url,
						data	: data,
						async	: false,
						success : function(response)
						{
							if(response.length != 0){
								
								if (response != '') {
									//alert(alert_msg);
									window.location.href=redirect_url;
								}
								
							}
							
						},
						error:function(XMLHttpRequest, textStatus, errorThrown)
						{
							alert(textStatus+' '+errorThrown);
						}
					});
                        }
        
    }
    
    
  
    $(document).ready(function(){
        
        
        
       
        $('#home_collection_div').hide();
        
        $(document).on('click', '#editTestLink', function(){    
           $('.remove_test_link').show();
        });
        
       
       //var inner_link_three = $('#headingThree').find("a");
                
       //$(inner_link_three).attr('data-toggle', '');
       
       
       $(document).on('click', '#headingOne', function(){
         
            //console.log('headingOne');
           
            
            $('#collapseOne').show();
    
            $('#collapseTwo').hide();
            
            $('#collapseThree').hide();
			$('#collapseFour').hide();
            
            var inner_link_one = $('#headingOne').find("a");
                
            $(inner_link_one).removeClass("collapsed");
            
            var inner_link_two = $('#headingTwo').find("a");
                
            $(inner_link_two).addClass("collapsed");
         
            var inner_link_three = $('#headingThree').find("a");
                
            $(inner_link_three).addClass("collapsed");
			
			var inner_link_four = $('#headingFour').find("a");
                
            $(inner_link_four).addClass("collapsed");
            
            
     
        });
        
        $(document).on('click', '#headingTwo', function(){
            
            $('#collapseOne').hide();
    
            $('#collapseTwo').show();
            
            $('#collapseThree').hide();
			
			$('#collapseFour').hide();
            
            var inner_link_one = $('#headingOne').find("a");
                
            $(inner_link_one).addClass("collapsed");
            
            var inner_link_two = $('#headingTwo').find("a");
                
            $(inner_link_two).removeClass("collapsed");
         
            var inner_link_three = $('#headingThree').find("a");
                
            $(inner_link_three).addClass("collapsed");
			
			var inner_link_four = $('#headingFour').find("a");
                
            $(inner_link_four).addClass("collapsed");
            
            
     
        });
        
        /*$(document).on('click', '#headingThree', function(){
         
            console.log('headingThree');
            
            $('#collapseOne').collapse('hide');
    
            if(validate_booking_form()){
                
                $('#collapseTwo').collapse('hide');
            
                $('#collapseThree').collapse('show');
                
                //var inner_link = $(this).find("a");
                
                //$(inner_link).addClass("collapsed");
            
            }else{
                
                $('#collapseThree').collapse('hide');
                $('#collapseTwo').collapse('show');
                //$('#collapseTwo').removeClass("collapse");
                //$('#collapseTwo').addClass("in");
                //console.log( $(this).find("a"));
                
                var inner_link_two = $('#headingTwo').find("a");
                
                $(inner_link_two).removeClass("collapsed");
                
                var inner_link_three = $('#headingThree').find("a");
                
                $(inner_link_three).addClass("collapsed");
            }
     
        });*/
        
        $(document).on('click', '#headingThree', function(){
         
            //console.log('headingThree');
            
         
            
            
            if(validate_booking_form()){
            
                $('#booking_form_error').html('');
                $('#booking_form_error').hide();
                
                $('#contact_name_span').html(': '+$('#contact_name').val());
                $('#contact_email_span').html(': '+$('#contact_email').val());
                $('#contact_mobile_span').html(': '+$('#contact_mobile').val());
            
                $('#patient_name_span').html(': '+$('#patient_name').val());
                $('#patient_mobile_span').html(': '+$('#patient_mobile').val());
                $('#patient_email_span').html(': '+$('#patient_email').val());
                
                var gender_val = $("input[name=gender]:checked").val();
                
                $('#patient_gender_span').html(': '+gender_val);
                
                $('#collapseOne').hide();
    
                $('#collapseTwo').hide();
            
                $('#collapseThree').show();
				
				$('#collapseFour').hide();
            
                var inner_link_one = $('#headingOne').find("a");
                
                $(inner_link_one).addClass("collapsed");
            
                var inner_link_two = $('#headingTwo').find("a");
                
                $(inner_link_two).addClass("collapsed");
         
                var inner_link_three = $('#headingThree').find("a");
                
                $(inner_link_three).removeClass("collapsed");
				
				var inner_link_four = $('#headingFour').find("a");
                
                $(inner_link_four).addClass("collapsed");
            
            }else{
                
                $('#collapseOne').hide();
    
                $('#collapseTwo').show();
            
                $('#collapseThree').hide();
				$('#collapseFour').hide();
            
                var inner_link_one = $('#headingOne').find("a");
                
                $(inner_link_one).addClass("collapsed");
            
                var inner_link_two = $('#headingTwo').find("a");
                
                $(inner_link_two).removeClass("collapsed");
         
                var inner_link_three = $('#headingThree').find("a");
                
                $(inner_link_three).addClass("collapsed");
				
				var inner_link_four = $('#headingFour').find("a");
                
                $(inner_link_four).addClass("collapsed");
                
            }
     
        });
		
		
		$(document).on('click', '#headingFour', function(){
            if(validate_booking_form()){
            
                $('#booking_form_error').html('');
                $('#booking_form_error').hide();
                
                $('#contact_name_span').html(': '+$('#contact_name').val());
                $('#contact_email_span').html(': '+$('#contact_email').val());
                $('#contact_mobile_span').html(': '+$('#contact_mobile').val());
            
                $('#patient_name_span').html(': '+$('#patient_name').val());
                $('#patient_mobile_span').html(': '+$('#patient_mobile').val());
                $('#patient_email_span').html(': '+$('#patient_email').val());
                
                var gender_val = $("input[name=gender]:checked").val();
                
                $('#patient_gender_span').html(': '+gender_val);
                
                $('#collapseOne').hide();
    
                $('#collapseTwo').hide();
            
                $('#collapseThree').hide();
				
				$('#collapseFour').show();
            
                var inner_link_one = $('#headingOne').find("a");
                
                $(inner_link_one).addClass("collapsed");
            
                var inner_link_two = $('#headingTwo').find("a");
                
                $(inner_link_two).addClass("collapsed");
         
                var inner_link_three = $('#headingThree').find("a");
                
                $(inner_link_three).addClass("collapsed");
				
				var inner_link_four = $('#headingFour').find("a");
                
                $(inner_link_four).removeClass("collapsed");
            
            }else{
                
                $('#collapseOne').hide();
    
                $('#collapseTwo').show();
            
                $('#collapseThree').hide();
				$('#collapseFour').hide();
            
                var inner_link_one = $('#headingOne').find("a");
                
                $(inner_link_one).addClass("collapsed");
            
                var inner_link_two = $('#headingTwo').find("a");
                
                $(inner_link_two).removeClass("collapsed");
         
                var inner_link_three = $('#headingThree').find("a");
                
                $(inner_link_three).addClass("collapsed");
				
				var inner_link_four = $('#headingFour').find("a");
                
                $(inner_link_four).addClass("collapsed");
                
            }
     
        });
       
        
        $(document).on('click', '#testContinueBookingOne', function(){
         
            //console.log('testContinueBookingOne');
            
            $('#collapseOne').hide();
    
            $('#collapseTwo').show();
            
            $('#collapseThree').hide();
			$('#collapseFour').hide();
            
            var inner_link_one = $('#headingOne').find("a");
                
            $(inner_link_one).addClass("collapsed");
            
            var inner_link_two = $('#headingTwo').find("a");
                
            $(inner_link_two).removeClass("collapsed");
         
            var inner_link_three = $('#headingThree').find("a");
                
            $(inner_link_three).addClass("collapsed");
			
			var inner_link_four = $('#headingFour').find("a");
                
            $(inner_link_four).addClass("collapsed");
    
           
     
        });
        
       
        $(document).on('click', '#viewBookingFormLink', function(){
         
            //console.log('viewBookingFormLink');
         
            $('#collapseOne').hide();
    
            $('#collapseTwo').show();
            
            $('#collapseThree').hide();
			
			$('#collapseFour').hide();
            
            var inner_link_one = $('#headingOne').find("a");
                
            $(inner_link_one).addClass("collapsed");
            
            var inner_link_two = $('#headingTwo').find("a");
                
            $(inner_link_two).removeClass("collapsed");
         
            var inner_link_three = $('#headingThree').find("a");
                
            $(inner_link_three).addClass("collapsed");
			
			var inner_link_four = $('#headingFour').find("a");
                
            $(inner_link_four).addClass("collapsed");
     
        });
        
        $(document).on('click', '#termsModalLink', function(){
		  $('#termsModal').modal({backdrop: 'static'}); 
	});
         
        $(document).on('click', '#testContinueBookingTwo', function(){
         
            //console.log('testContinueBookingTwo');
            
            if(validate_booking_form()){
            
                $('#booking_form_error').html('');
                $('#booking_form_error').hide();
                
                $('#contact_name_span').html(': '+$('#contact_name').val());
                $('#contact_email_span').html(': '+$('#contact_email').val());
                $('#contact_mobile_span').html(': '+$('#contact_mobile').val());
            
                $('#patient_name_span').html(': '+$('#patient_name').val());
                $('#patient_mobile_span').html(': '+$('#patient_mobile').val());
                $('#patient_email_span').html(': '+$('#patient_email').val());
                
                var gender_val = $("input[name=gender]:checked").val();
                
                $('#patient_gender_span').html(': '+gender_val);
                
                $('#collapseOne').hide();
    
                $('#collapseTwo').hide();
            
                $('#collapseThree').show();
				$('#collapseFour').hide();
            
                var inner_link_one = $('#headingOne').find("a");
                
                $(inner_link_one).addClass("collapsed");
            
                var inner_link_two = $('#headingTwo').find("a");
                
                $(inner_link_two).addClass("collapsed");
         
                var inner_link_three = $('#headingThree').find("a");
                
                $(inner_link_three).removeClass("collapsed");
				var inner_link_four = $('#headingFour').find("a");
                
                $(inner_link_four).addClass("collapsed");
            
            }else{
                
                $('#collapseOne').hide();
    
                $('#collapseTwo').show();
            
                $('#collapseThree').hide();
				$('#collapseFour').hide();
            
                var inner_link_one = $('#headingOne').find("a");
                
                $(inner_link_one).addClass("collapsed");
            
                var inner_link_two = $('#headingTwo').find("a");
                
                $(inner_link_two).removeClass("collapsed");
         
                var inner_link_three = $('#headingThree').find("a");
                
                $(inner_link_three).addClass("collapsed");
				var inner_link_four = $('#headingThree').find("a");
                
                $(inner_link_four).addClass("collapsed");
            }
     
        });
        
        
        
      
        $(document).on('click', '#homecollection_checkbox', function(){
            var homecollection_checked = $('#homecollection_checkbox').prop('checked');
            if(homecollection_checked){
                $('#home_collection_div').show();
				document.getElementById('home_collection_div_details').style.display='';
				var i;
				var selectbox = document.getElementById('home_collection_time');
				var time = ["07:00 - 07:30","07:30 - 08:00","08:00 - 08:30","08:30 - 09:00","09:00 - 09:30","09:30 - 10:00","10:00 - 10:30","10:30 - 11:00","11:00 - 11:30","11:30 - 12:00","12:00 - 12:30","12:30 - 13:00",
				"13:00 - 13:30","13:30 - 14:00","14:00 - 14:30","14:30 - 15:00","15:00 - 15:30","15:30 - 16:00","16:00 - 16:30","16:30 - 17:00",
				"17:00 - 17:30","17:30 - 18:00","18:00 - 18:30","18:30 - 19:00"];
				for(i=0; i<time.length; i++){
					var opt = document.createElement('option');
					opt.value = time[i];
					opt.text = time[i];
					document.getElementById('home_collection_time').options.add(opt);
				}				
				
            }else{
                 $('#home_collection_div').hide();
				 document.getElementById('home_collection_div_details').style.display='none';
            }
        });
      
        
        $(document).on('click', '#testContinueBookingThree', function(){
            
            if(validate_booking_form()){
            
                //$('#bookingTestForm').submit();
				$('#collapseOne').hide();
    
                $('#collapseTwo').hide();
            
                $('#collapseThree').hide();
				$('#collapseFour').show();
            
                var inner_link_one = $('#headingOne').find("a");
                
                $(inner_link_one).addClass("collapsed");
            
                var inner_link_two = $('#headingTwo').find("a");
                
                $(inner_link_two).addClass("collapsed");
				var inner_link_three = $('#headingThree').find("a");
                
                $(inner_link_three).addClass("collapsed");
         
                var inner_link_four = $('#headingFour').find("a");
                
                $(inner_link_four).removeClass("collapsed");
            
            }
			
     
        });
		
		$(document).on('click', '#testContinueBookingFour', function(){
            var payment = $("input[name='payment_type']:checked").val();
			if(payment=='' || payment==undefined) {alert('Choose a payment type.'); return false;}

            if(validate_booking_form()){
				
					$('#bookingTestForm').submit();

            }
        });
        
        
        $('#contact_name').keyup(function () { 
            var self_test_checked = $('#self_test_checkbox').prop('checked');
            if(self_test_checked){
                $('#patient_name').val($(this).val());
            }
            
            $('#contact_name_span').html($('#contact_name').val());
            
        });
        $('#home_collection_address').keyup(function () { 
           $('#home_address_span').html(': '+$('#home_collection_address').val());
        });
		$('#home_collection_address2').keyup(function () { 
           $('#home_address2_span').html(': '+$('#home_collection_address2').val());
        });
		$('#home_collection_state').keyup(function () { 
           $('#home_state_span').html(': '+$('#home_collection_state').val());
        });
		$('#home_collection_city').keyup(function () { 
           $('#home_city_span').html(': '+$('#home_collection_city').val());
        });
		$('#home_collection_state').change(function () { 
           $('#home_state_span').html(': '+$('#home_collection_state').val());
        });
		$('#home_collection_city').change(function () { 
           $('#home_city_span').html(': '+$('#home_collection_city').val());
        });
		$('#home_collection_pincode').keyup(function () { 
           $('#home_pincode_span').html(': '+$('#home_collection_pincode').val());
        });
		
		 $('#home_collection_date').change(function () { 
				$('#home_date_span').html(': '+$('#home_collection_date').val());
        });
		$('#home_collection_time').change(function () { 
				$('#home_time_span').html(': '+$('#home_collection_time').val());
        });
		
		
        /*$('#patient_name').keyup(function () { 
            var self_test_checked = $('#self_test_checkbox').prop('checked');
            if(self_test_checked){
                $('#contact_name').val($(this).val());
            }    
        });*/
        
        $('#contact_email').keyup(function () { 
            var self_test_checked = $('#self_test_checkbox').prop('checked');
            if(self_test_checked){
                $('#patient_email').val($(this).val());
            }    
        });
        
        /*$('#patient_email').keyup(function () { 
            var self_test_checked = $('#self_test_checkbox').prop('checked');
            if(self_test_checked){
                $('#contact_email').val($(this).val());
            }    
        });*/
        
        $('#contact_mobile').keyup(function () { 
            var self_test_checked = $('#self_test_checkbox').prop('checked');
            if(self_test_checked){
                $('#patient_mobile').val($(this).val());
            }    
        });
        
        /*$('#patient_mobile').keyup(function () { 
            var self_test_checked = $('#self_test_checkbox').prop('checked');
            if(self_test_checked){
                $('#contact_mobile').val($(this).val());
            }    
        });*/
            
        
      
        
        $(document).on('click', '#self_test_checkbox', function(){
            var contact_name = $('#contact_name').val();
            if(contact_name!=""){
                $('#patient_name').val(contact_name);
            }else{
                $('#patient_name').val('');
            }
            
            var contact_email = $('#contact_email').val();
            if(contact_email!=""){
                $('#patient_email').val(contact_email);
            }else{
                $('#patient_email').val('');
            }
            
            var contact_mobile = $('#contact_mobile').val();
            if(contact_mobile!=""){
                $('#patient_mobile').val(contact_mobile);
            }else{
                $('#patient_mobile').val('');
            }
           
            var self_test_checked = $('#self_test_checkbox').prop('checked');
            if(self_test_checked==false){
                $('#patient_name').val('');
                $('#patient_email').val('');
                $('#patient_mobile').val('');
            }
     
        });
        
        
        
        
        
    });
    
function statechange(sid,cid){
	if(sid!=$('#home_collection_state').val()){
		$('#booking_form_error').html('');
		$('#booking_form_error').html('Entered state is not serviceable by this lab. Change to '+sid+'.');
		$('#booking_form_error').show();		
		//document.getElementById('home_collection_state').value=sid;
		$("#home_collection_state").focus();
		return false;
	}else{
		$('#booking_form_error').html('');
		$('#booking_form_error').hide();
	}
	if(cid!=$('#home_collection_city').val()){
		$('#booking_form_error').html('');
		$('#booking_form_error').html('Entered city is not serviceable by this lab. Change to '+cid+'.');
		$('#booking_form_error').show();		
		//document.getElementById('home_collection_city').value=sid;
		$("#home_collection_city").focus();
		return false;
	}else{
		$('#booking_form_error').html('');
		$('#booking_form_error').hide();
	}
}    
 

function validate_booking_form()
{
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,9}$/;
        var mobileExp = /^[1-9]{1}[0-9]{9}$/;
		var pincodeExp = /^[1-9]{1}[0-9]{5}$/;
	
        var contact_name = $("#contact_name").val().trim();
        var contact_email = $("#contact_email").val().trim();
        var contact_mobile = $("#contact_mobile").val().trim();
        var patient_name = $("#patient_name").val().trim();
        var patient_email = $("#patient_email").val().trim();
        var patient_mobile = $("#patient_mobile").val().trim();
        
        var gender_checked = true;
        if($('input[name=gender]:checked').length<=0){
            gender_checked= false;
        }
        
        var  homecollection_checkbox_flag = false;
      
        homecollection_checkbox_flag = $('#homecollection_checkbox').prop('checked');

        var home_collection_address = '';
		var home_collection_address2 = '';
		var home_collection_state = '';
		var home_collection_city = '';
		var home_collection_pincode = '';
		var home_collection_date = '';
		var home_collection_time = '';
        if(homecollection_checkbox_flag){
            home_collection_address = $("#home_collection_address").val().trim();
			home_collection_address2 = $("#home_collection_address2").val().trim();
			home_collection_state = $("#home_collection_state").val().trim();
			home_collection_city = $("#home_collection_city").val().trim();
			home_collection_pincode = $("#home_collection_pincode").val().trim();
			home_collection_date = $("#home_collection_date").val().trim();
			home_collection_time = $("#home_collection_time").val().trim();
        }
        
        
        var terms_checkbox_flag = $('#terms_condition_checkbox').prop('checked');
        
        var return_flag = true;
        
        if(contact_name=="" || contact_email=="" || contact_mobile=="" || patient_name=="" || patient_email=="" || patient_mobile==""){
            $('#booking_form_error').html('');
            $('#booking_form_error').html('Please fill all mandatory fields');
            $('#booking_form_error').show();
            if(contact_name==""){
                $("#contact_name").focus();
            }else if(contact_email==""){
                $("#contact_email").focus();
            }
            else if(contact_mobile==""){
                $("#contact_mobile").focus();
            }
            else if(patient_name==""){
                $("#patient_name").focus();
            }
            else if(patient_email==""){
                $("#patient_email").focus();
            }
            else if(patient_mobile==""){
                $("#patient_mobile").focus();
            }
            
            return_flag = false;
        }
        else if(!contact_email.match(emailExp)){
            $('#booking_form_error').html('');
            $('#booking_form_error').html('Please enter valid contact email.');
            $('#booking_form_error').show();
            $("#contact_email").focus();
            return_flag = false;
        }
        else if(!contact_mobile.match(mobileExp)){
            $('#booking_form_error').html('');
            $('#booking_form_error').html('Please enter valid mobile number.');
            $('#booking_form_error').show();
            $("#contact_mobile").focus();
            return_flag = false;
        }else if(gender_checked==false){
            $('#booking_form_error').html('');
            $('#booking_form_error').html('Please select gender.');
            $('#booking_form_error').show();
            $("#female_gender").focus();
            return_flag = false;
        }
        else if(!patient_email.match(emailExp)){
            $('#booking_form_error').html('');
            $('#booking_form_error').html('Please enter valid patient email.');
            $('#booking_form_error').show();
            $("#patient_email").focus();
            return_flag = false;
        }
        else if(!patient_mobile.match(mobileExp)){
            $('#booking_form_error').html('');
            $('#booking_form_error').html('Please enter valid patient mobile number.');
            $('#booking_form_error').show();
            $("#patient_mobile").focus();
            return_flag = false;
        }else if(homecollection_checkbox_flag==true && home_collection_address==''){
            $('#booking_form_error').html('');
            $('#booking_form_error').html('Please enter home collection address.');
            $('#booking_form_error').show();
            $("#home_collection_address").focus();
            return_flag = false;
            
        }else if(homecollection_checkbox_flag==true && home_collection_date==''){
            $('#booking_form_error').html('');
            $('#booking_form_error').html('Please enter home collection date and time.');
            $('#booking_form_error').show();
            $("#home_collection_date").focus();
            return_flag = false;
            
        }else if(homecollection_checkbox_flag==true && home_collection_time==''){
            $('#booking_form_error').html('');
            $('#booking_form_error').html('Please enter home collection time.');
            $('#booking_form_error').show();
            $("#home_collection_time").focus();
            return_flag = false;
            
        }else if(homecollection_checkbox_flag==true && home_collection_state==''){
			$('#booking_form_error').html('');
			$('#booking_form_error').html('Please enter home collection State.');
			$('#booking_form_error').show();
			$("#home_collection_state").focus();
			return_flag = false;
		}else if(homecollection_checkbox_flag==true && home_collection_city==''){
			$('#booking_form_error').html('');
			$('#booking_form_error').html('Please enter home collection City.');
			$('#booking_form_error').show();
			$("#home_collection_city").focus();
			return_flag = false;
		}else if((homecollection_checkbox_flag==true && home_collection_pincode=='') || (homecollection_checkbox_flag==true && !home_collection_pincode.match(pincodeExp))){
            $('#booking_form_error').html('');
            $('#booking_form_error').html('Please enter home collection Pincode.');
            $('#booking_form_error').show();
            $("#home_collection_pincode").focus();
            return_flag = false;
        }else if(terms_checkbox_flag==false){
            $('#booking_form_error').html('');
            $('#booking_form_error').html('Please accept terms and conditions.');
            $('#booking_form_error').show();
            $("#terms_condition_checkbox").focus();
            return_flag = false;
            
        }
		if(homecollection_checkbox_flag==true && home_collection_date!=''){ 
			var ndate = new Date();
			if(home_collection_time!=''){
				var ntime = home_collection_time.substring(0,5);
				var newDate = home_collection_date+"T"+ntime;
				var collectionDate = new Date(newDate);	
				var timeZoneFromDB2 = +0.00; 					
				var tzDifference = timeZoneFromDB2 * 60 + collectionDate.getTimezoneOffset();
				var offsetTime = new Date(collectionDate.getTime() + tzDifference * 60 * 1000);			
				if(offsetTime<=ndate){ 
					$('#booking_form_error').html('');
					$('#booking_form_error').html('Please enter home collection date and time greater than current time.');
					$('#booking_form_error').show();
					$("#home_collection_date").focus();
					return_flag = false;
				}
			}else{
				$('#booking_form_error').html('');
				$('#booking_form_error').html('Please enter home collection date and time greater than current time.');
				$('#booking_form_error').show();
				$("#home_collection_time").focus();
				return_flag = false;
			}
			
			          
            
        }
        if(return_flag == false){
                return false;
	}
	else {
		return true;
	}
		
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
      <div class=" "> <a href="<?php echo Configure::read('medtest_root_path');?>"> One Health </a> <span class="sep"></span><span class="active"> Checkout</span></div>
    </div>
  </div>
  <div class="row clearfix">
    <div class="col-md-12 accord_block">
      <h2>Just a few more steps and we'll be done,</h2>
      <div class="panel-group accord_wrapp" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
          <div class="panel-heading" role="tab" id="headingOne">
            <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="javascript:void(0)" aria-expanded="true" aria-controls="collapseOne"> 
                <?php
                if($test_type=='clinic_test'){
                    echo $clinic_details['Clinic']['clinic_name'].', '.$clinic_details['Area']['area_name']; 
                }
                if($test_type=='test_package'){
                    echo $package_details['Clinic']['clinic_name'].', '.$package_details['Area']['area_name']; 
                }
                ?>
                <span>INR 
                <?php
                if($test_type=='clinic_test'){
                   
                    echo $clinic_details['total_amount_offer'];
                }
                if($test_type=='test_package'){
                    echo $package_details['TestPackage']['price_actual']; 
                }
                ?></span> </a> </h4>
          </div>
          <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
            <div class="panel-body">
              <p class="edit"><a href="javascript:void(0)" id="editTestLink">CLICK TO EDIT</a></p>
              <p class="address"><?php
              if($test_type=='clinic_test'){
                    echo ucwords($clinic_details['Clinic']['address_line1']).', '.ucwords($clinic_details['Clinic']['address_line2']).', '.ucwords($clinic_details['Clinic']['address_line3']).', '.ucwords($clinic_details['Area']['area_name']).', '.ucwords($clinic_details['City']['city_name']).' - '.$clinic_details['Area']['postcode'];
              }
              if($test_type=='test_package'){
                   echo ucwords($package_details['Clinic']['address_line1']).', '.ucwords($package_details['Clinic']['address_line2']).', '.ucwords($package_details['Clinic']['address_line3']).', '.ucwords($package_details['Area']['area_name']).', '.ucwords($package_details['City']['city_name']).' - '.$package_details['Area']['postcode'];
 
              }
              ?>
              </p>
              <div class="row clearfix">
                <div class="col-md-12">
                  <div class="row clearfix">
                    <div class="col-md-8">
                      <div class="title_row">TEST NAME <span>COST</span> </div>
                      <div class="item_wrapp">
                        <?php 
                        if($test_type=='clinic_test'){
                            foreach($clinic_details['TestDetails'] as $test_details){
                                //debug($test_details);
                            ?>
                            <div class="item">
                                
                                <a style="display:none;cursor:pointer" class="remove_test_link" onclick="javascript:removeTestorPackage(<?php echo $test_details['ClinicTest']['id']?>,'test')"><?php echo $this->Html->image('cross.png');?></a>
                                <?php echo $test_details['Test']['test_name'];?><span>
                                <?php echo $test_details['ClinicTest']['price_actual']; ?></span> 
                                </div>
                            <?php  
                            }
                        }
                        if($test_type=='test_package'){
                        ?>
                          <div class="item">
                              <a style="display:none;cursor:pointer" class="remove_test_link" onclick="javascript:removeTestorPackage(<?php echo $package_details['TestPackage']['id']?>,'package')"><?php echo $this->Html->image('cross.png');?></a>
                              <?php echo $package_details['TestPackage']['package_name'];?><span><?php echo $package_details['TestPackage']['price_actual']; ?></span>
                          
                          </div>
                        
                        <?php } ?>  
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="title_row">TOTAL BILLING</div>
                      <div class="item_wrapp">
                        <div class="item">List Price <span>
                        <?php 
                        if($test_type=='clinic_test'){
                            echo $clinic_details['total_amount_actual'];
                        }
                        if($test_type=='test_package'){
                            echo $package_details['TestPackage']['price_actual'];
                        }
                        ?>
                        </span> </div>
                        <div class="item">Discount @ 
                            <?php
                            if($test_type=='clinic_test'){
                                echo $clinic_details['total_discount_percentage'];
                            }
                            if($test_type=='test_package'){
                                echo $package_details['TestPackage']['total_discount_percentage'];
                            }
                            ?>
                            % <span>(-) 
                            <?php
                            if($test_type=='clinic_test'){
                                echo $clinic_details['total_discount_price'];
                            }
                             if($test_type=='test_package'){
                                echo $package_details['TestPackage']['total_discount_price'];
                            }
                            ?>
                            </span> </div>
                      </div>
                      <div class="total">FINAL PRICE <span> 
                          <?php 
                          if($test_type=='clinic_test'){
                            echo $clinic_details['total_amount_offer'];
                          }
                          if($test_type=='test_package'){
                              echo $package_details['TestPackage']['price_offer'];
                          }
                          ?></span> </div>
                      <div class="continue_btn"><a href="javascript:void(0)" id="testContinueBookingOne">Continue Booking</a></div >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="panel panel-default contact_info">
          <div class="panel-heading" role="tab" id="headingTwo">
            <h4 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="javascript:void(0)" aria-expanded="false" aria-controls="collapseTwo"> Contact Information & Patient Details </a> </h4>
          </div>
          <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
            <div class="panel-body">
              <div class="alert alert-danger" role="alert" id="booking_form_error" style="display:none"></div>  
              <div class="title_row">Your Information</div>
              
              
              <?php 
               /*  echo $this->Form->create('bookingTest', array('id'=>'bookingTestForm', 'url'=>array('controller'=>'booking','action'=>'confirmbooking'), 'type'=>'post','autocomplete'=>'off')); */
			    echo $this->Form->create('bookingTest', array('id'=>'bookingTestForm', 'url'=>array('controller'=>'booking','action'=>'paymentProcess'), 'type'=>'post','autocomplete'=>'off'));
                ?> 
                <?php 
                if($test_type=='clinic_test'){
                    foreach($clinic_test_ids as $clinic_test_id){
                      echo $this->Form->hidden('clinic_test_id',array('name'=>'clinic_test_id[]','value'=>$clinic_test_id));
                    } 
                }
                if($test_type=='test_package'){
                     
                     echo $this->Form->hidden('package_id',array('name'=>'package_id','value'=>$package_id));
                }
                
                echo $this->Form->hidden('test_type',array('name'=>'test_type','value'=>$test_type));
                
                ?>
                <div class="form-group">
                  <label for="InputfName">First Name <span class="red-mark-star">*</span></label>
				  
                  <?php 
				  echo $this->Form->hidden('clinic_test_id',array('name'=>'total_amount_offer','value'=>$clinic_details['total_amount_offer']));
				  echo $this->Form->input('contact_name',array('name'=>'contact_name','div'=>false, 'label'=>false, 'class'=>'form-control', 'id'=>'contact_name', 'error'=>false,'value'=>$_SESSION['contact_name'], 'placeholder'=>'Your First Name'));?> 
                  
				  <label for="InputlName" style="margin-left: 50px;">Last Name <span class="red-mark-star">*</span></label>
				  
                  <?php 
				  echo $this->Form->input('contact_lname',array('name'=>'contact_lname','div'=>false, 'label'=>false, 'class'=>'form-control', 'id'=>'contact_lname', 'error'=>false,'value'=>$_SESSION['contact_lname'], 'placeholder'=>'Your Last Name'));?> 
				  
                </div>
                
                <div class="form-group">
                  <label for="InputEmail">Email <span class="red-mark-star">*</span></label>
                  <?php echo $this->Form->input('contact_email',array('name'=>'contact_email','div'=>false, 'label'=>false, 'class'=>'form-control', 'id'=>'contact_email', 'error'=>false, 'value'=>$_SESSION['contact_email'], 'placeholder'=>'Your email address'));?> 
                  
                  <span class="input_mob">
                  <label for="InputMobile">Mobile <span class="red-mark-star">*</span> &nbsp;91-</label>
                   <?php echo $this->Form->input('contact_mobile',array('name'=>'contact_mobile','div'=>false, 'label'=>false, 'class'=>'form-control', 'id'=>'contact_mobile', 'error'=>false, 'value'=>$_SESSION['contact_mobile'], 'placeholder'=>'Your mobile number'));?> 
                  
                  </span> 
				  
				  </div>
              
              
                <?php 
                
                
                if(($clinic_home_collection=='1') && (($test_type=='clinic_test' && $test_home_collection==1) || ($test_type=='test_package' && $package_home_collection==1))){ ?>
                <div class="checkbox">
                  <label>
				  
                    <input type="checkbox" id="homecollection_checkbox" name="homecollection_checkbox" value="1"/>
                    Select this for Home Collection</label>
                </div>
                <div class="form-group textarea_aria2" id="home_collection_div">
                  <label for="home_collection_address">Address <span class="red-mark-star">* </span></label>
                   <?php echo $this->Form->input('home_collection_address',array('type'=>'textarea','name'=>'home_collection_address','div'=>false, 'label'=>false,'rows'=>'2','cols'=>'10' ,'class'=>'form-control address-text', 'id'=>'home_collection_address', 'error'=>false,'placeholder'=>'Your Address Line One'));?> 
                  
                  <br/><span class="red-mark" id="error_home_collection_address" style="display:none;color:red" ></span>
				  <label for="home_collection_address2">&nbsp;</label>
                   <?php echo $this->Form->input('home_collection_address2',array('type'=>'textarea','name'=>'home_collection_address2','div'=>false, 'label'=>false,'rows'=>'2','cols'=>'10' ,'class'=>'form-control address-text', 'id'=>'home_collection_address2', 'error'=>false,'placeholder'=>'Your Address Line Two'));?>
				  <div class="col-md-12" style="padding-left: 0px;">
					<div class="col-md-4" style="padding-left: 0px;"><label for="home_collection_state">State<span class="red-mark-star">*</span></label>
					<?php //echo $this->Form->input('home_collection_state',array('name'=>'home_collection_state','div'=>false, 'label'=>false, 'class'=>'form-control', 'id'=>'home_collection_state', 'error'=>false, 'placeholder'=>'Enter State', 'value'=>$clinic_details['City']['state'])); ?>
					<input type="text" name="home_collection_state" id="home_collection_state" value="<?php echo $clinic_details['City']['state']; ?>" class="form-control" placeholder="Enter State" onchange="statechange('<?php echo $clinic_details['City']['state']; ?>','<?php echo $clinic_details['City']['city_name']; ?>');" />
					
					
					
					<br /><span class="red-mark" id="error_home_collection_state" style="display:none;color:red" ></span></div>
					<div class="col-md-4" style="padding-left: 0px;"><label for="home_collection_city">City <span class="red-mark-star">*</span></label>
					<?php //echo $this->Form->input('home_collection_city',array('name'=>'home_collection_city','div'=>false, 'label'=>false, 'class'=>'form-control', 'id'=>'home_collection_city', 'error'=>false, 'placeholder'=>'Enter City', 'value'=>$clinic_details['City']['city_name'])); ?>
					<input type="text" name="home_collection_city" id="home_collection_city" value="<?php echo $clinic_details['City']['city_name']; ?>" class="form-control" placeholder="Enter City" onchange="statechange('<?php echo $clinic_details['City']['state']; ?>','<?php echo $clinic_details['City']['city_name']; ?>');" />
					
					
				  
					<br /><span class="red-mark" id="error_home_collection_city" style="display:none;color:red" ></span></div>
					<div class="col-md-4" style="padding-left: 0px;"><label for="home_collection_pincode">Pincode <span class="red-mark-star">*</span></label>
					<?php echo $this->Form->input('home_collection_pincode',array('name'=>'home_collection_pincode','div'=>false, 'label'=>false, 'class'=>'form-control', 'id'=>'home_collection_pincode', 'error'=>false, 'placeholder'=>'Enter Pincode'));?>
				  
                  <br /><span class="red-mark" id="error_home_collection_pincode" style="display:none;color:red" ></span></div>
				</div>
				  <div class="col-md-12" style="padding-left: 0px;">
					<div class="col-md-4" style="padding-left: 0px;"><label for="home_collection_date">Date<span class="red-mark-star">*</span></label>
                   <?php /* echo $this->Form->input('home_collection_date',array('type'=>'datetime-local','name'=>'home_collection_date','div'=>false, 'label'=>false, 'class'=>'form-control', 'id'=>'home_collection_date', 'error'=>false,'placeholder'=>'Date & Time')); */ ?> 
                  <input type="date" id="home_collection_date" name="home_collection_date" placeholder="Date" class="form-control" />
                  <br /><span class="red-mark" id="error_home_collection_date" style="display:none;color:red" ></span></div>
					<div class="col-md-4" style="padding-left: 0px;"><label for="home_collection_time">Time <span class="red-mark-star">*</span></label>
                  <select name="home_collection_time" id="home_collection_time" class="form-control">
					<option value="">-Choose Time-</option>
				  </select>
                  <br /><span class="red-mark" id="error_home_collection_time" style="display:none;color:red" ></span></div>
				 
				</div>

                </div>
				
                <?php } ?>
             
                <div class="checkbox">
                  <label>
                    <input type="checkbox" id="self_test_checkbox"/>
                    The test is for me.</label>
                </div>
                <div class="title_row">PATIENT Information </div>
                <div class="form-group">
                  <label for="InputName">Name <span class="red-mark-star">*</span></label>
                  
                  <?php echo $this->Form->input('patient_name',array('name'=>'patient_name','div'=>false, 'label'=>false, 'class'=>'form-control', 'id'=>'patient_name', 'error'=>false, 'placeholder'=>'Patients Name'));?> 
                 
                </div>
                <div class="form-group radio_wrapp">
                  <label>Gender <span class="red-mark-star">*</span></label>
                  <label class="radio-inline">
                    <input type="radio" name="gender" value="Female" id="female_gender">
                    Female</label>
                  <label class="radio-inline">
                    <input type="radio" name="gender" value="Male" id="male_gender">
                    Male</label>
                  
                </div>
                <div class="form-group">
                  <label for="InputEmail">Email <span class="red-mark-star">*</span></label>
                  
                  <?php echo $this->Form->input('patient_email',array('name'=>'patient_email','div'=>false, 'label'=>false, 'class'=>'form-control', 'id'=>'patient_email', 'error'=>false, 'placeholder'=>'Patients email address'));?> 
                  
                </div>
                <div class="form-group">
                  <label for="InputMobile2">Mobile <span class="red-mark-star">*</span> &nbsp;91-</label>
                  
                  <?php echo $this->Form->input('patient_mobile',array('name'=>'patient_mobile','div'=>false, 'label'=>false, 'class'=>'form-control', 'id'=>'patient_mobile', 'error'=>false, 'placeholder'=>'Patients Mobile number'));?> 
                  
                </div>
                <div class="checkbox">
                    <label>
                    <input type="checkbox" id="terms_condition_checkbox"/>
                    I agree to all the</label><label>  <a id="termsModalLink"> Terms and Conditions</a></label>
                </div>
                <div class="continue_btn"><a href="javascript:void(0)" id="testContinueBookingTwo">Continue Booking</a></div >
              
                <?php //echo $this->Form->end(); ?>
            </div>
          </div>
        </div>
		
		
        <div class="panel panel-default order_review">
          <div class="panel-heading" role="tab" id="headingThree">
            <h4 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="javascript:void(0)" aria-expanded="false" aria-controls="collapseThree"> Order Review </a> </h4>
          </div>
          <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
            <div class="panel-body">
              <p class="edit"><a href="javascript:void(0)" id="viewBookingFormLink">CLICK TO EDIT</a></p>
              <div class="title_row">TEST CENTRE</div>
              <h5><?php
              if($test_type=='clinic_test'){
                echo $clinic_details['Clinic']['clinic_name'].', '.$clinic_details['Area']['area_name']; 
              }
              if($test_type=='test_package'){
                 echo $package_details['Clinic']['clinic_name'].', '.$package_details['Area']['area_name'];  
              }
              ?></h5>
              <p class="address"><?php
              if($test_type=='clinic_test'){
                echo ucwords($clinic_details['Clinic']['address_line1']).', '.ucwords($clinic_details['Clinic']['address_line2']).','.ucwords($clinic_details['Area']['area_name']).', '.ucwords($clinic_details['City']['city_name']).' - '.$clinic_details['Area']['postcode'];
              }
              if($test_type=='test_package'){
                echo ucwords($package_details['Clinic']['address_line1']).', '.ucwords($package_details['Clinic']['address_line2']).', '.ucwords($package_details['Area']['area_name']).', '.ucwords($package_details['City']['city_name']).' - '.$package_details['Area']['postcode'];  
              }
              ?></p>
              <div class="row">
			   <div class="col-md-6">
			  <div class="title_row">TESTS TO BE CONDUCTED</div>
              <ul class="list_test">
                <?php 
                if($test_type=='clinic_test'){
                    foreach($clinic_details['TestDetails'] as $test_details){ 
                    echo "<li>".$test_details['Test']['test_name']."</li>";
                    }
                }
                if($test_type=='test_package'){
                    
                    echo "<li>".$package_details['TestPackage']['package_name']."</li>";        
                }
                ?>
              </ul>
			  </div>
			  <div id="home_collection_div_details" style="display:none;" class="col-md-4">
			  <div class="title_row">HOME COLLECTION DETAILS</div>
				<div class="item_wrapp">
					<div class="item"><span class="item_details">Address One</span> <span style="float:left;" id="home_address_span"></span> </div>
					<div class="item"> <span class="item_details">Address Two </span> <span style="float:left;" id="home_address2_span"></span> </div>
					<div class="item"> <span class="item_details">State </span> <span style="float:left;" id="home_state_span"><?php echo ': '.$clinic_details['City']['state']; ?></span> </div>
					<div class="item"> <span class="item_details">City </span> <span style="float:left;" id="home_city_span"><?php echo ': '.$clinic_details['City']['city_name']; ?></span> </div>
					<div class="item"> <span class="item_details">Pincode </span> <span style="float:left;" id="home_pincode_span"></span> </div>
					<div class="item"> <span class="item_details">Date</span> <span style="float:left;" id="home_date_span"></span></div>
					<div class="item"> <span class="item_details">Time </span> <span style="float:left;" id="home_time_span"></span> </div>
				 </div>
			  </div>
			  </div>
              <div class="row clearfix">
                <div class="col-md-12">
                  <div class="row clearfix">
                    <div class="col-md-4">
                      <div class="title_row">PATIENT DETAILS</div>
                      <div class="item_wrapp">
                        <div class="item"><span class="item_details">Name</span> <span id="patient_name_span"></span> </div>
                        <div class="item"> <span class="item_details">Email</span> <span id="patient_email_span"></span></div>
                        <div class="item"> <span class="item_details">Mobile </span> <span id="patient_mobile_span"></span> </div>
                        <div class="item"> <span class="item_details">Gender </span> <span id="patient_gender_span"></span> </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="title_row">CONTACT INFORMATION </div>
                      <div class="item_wrapp">
                          <div class="item"><span class="item_details">Name</span> <span id="contact_name_span"></span> </div>
                        <div class="item"> <span class="item_details">Email</span> <span id="contact_email_span"></span></div>
                        <div class="item"> <span class="item_details">Mobile </span> <span id="contact_mobile_span"></span> </div>
                    
                        
                      </div>
                    </div>
                    
                    <div class="col-md-4 price_wrapp">
                      <div class="title_row">TOTAL BILLING</div>
                      <div class="item_wrapp">
                        <div class="item">List Price <span><?php
                        if($test_type=='clinic_test'){
                            echo $clinic_details['total_amount_actual'];
                        }
                        if($test_type=='test_package'){
                            echo $package_details['TestPackage']['price_actual'];
                        }
                        ?></span> </div>
                        <div class="item">Discount @ <?php
                        if($test_type=='clinic_test'){
                            echo $clinic_details['total_discount_percentage'];
                        }
                        if($test_type=='test_package'){
                            echo $package_details['TestPackage']['total_discount_percentage'];
                        }
                        ?>% <span>(-) <?php 
                        if($test_type=='clinic_test'){
                            echo $clinic_details['total_discount_price'];
                        }
                        if($test_type=='test_package'){
                            echo $package_details['TestPackage']['total_discount_price'];
                        }
                        ?></span> </div>
                      </div>
                      <div class="total">FINAL PRICE <span> <?php 
                       if($test_type=='clinic_test'){
                            echo $clinic_details['total_amount_offer'];
                       }
                       if($test_type=='test_package'){
                           echo $package_details['TestPackage']['price_offer'];
                       }
                      ?></span> </div>
                      <div class="continue_btn"><a href="javascript:void(0)" id="testContinueBookingThree">Continue Booking</a></div >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
		  
		  
        </div>
		
		<div class="panel panel-default payment_review">
			<div class="panel-heading" role="tab" id="headingFour">
				<h4 class="panel-title"> <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="javascript:void(0)" aria-expanded="false" aria-controls="collapseFour"> Choose Payment </a> </h4>
			</div>
			
			<div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
				<div class="panel-body">
					<div class="item_wrapp">
						<label class="radio-inline" style="text-align:center;font-weight:bold;">
                    <input type="radio" name="payment_type" value="online" id="paytm_type">
                   PAY ONLINE<br />Rs. <?php if($test_type=='clinic_test'){
                            echo $clinic_details['total_amount_offer'];
                       }
                       if($test_type=='test_package'){
                           echo $package_details['TestPackage']['price_offer'];
                       } ?></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				   <label class="radio-inline" style="text-align:center;margin-left: -15px;margin-right: 15px;"><img src="/img/paytm-seal.png" width="60" height="60" /></label>
                  <label class="radio-inline" style="text-align:center;font-weight:bold;">
                    <input type="radio" name="payment_type" value="centre" id="centre_type">
                    PAY AT <?php echo strtoupper($clinic_details['Clinic']['clinic_name']); ?><br />Rs. <?php if($test_type=='clinic_test'){
                            echo $clinic_details['total_amount_offer'];
                       }
                       if($test_type=='test_package'){
                           echo $package_details['TestPackage']['price_offer'];
                       } ?></label>
					</div>
					<div class="continue_btn"><a href="javascript:void(0)" id="testContinueBookingFour">Continue Payment</a></div >
				</div>
			</div>
		</div>
		<?php echo $this->Form->end(); ?>
		

		
		
		
      </div>
    </div>
  </div>
</div>


  <!-- ################### Terms & Condtions ########################### --> 
 
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