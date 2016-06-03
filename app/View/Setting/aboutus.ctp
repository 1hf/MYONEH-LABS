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


</script>

<div class="container">
  <div class="row clearfix">
    <div class="col-md-12">
      <div class="breadcrumb"> <a href="index/index"> HealthX.in </a> <span class="sep"></span> About US
      </div>
    </div>
  </div>
  <div class="row clearfix">
    <div class="col-md-8 inner_content text_style">
      <div class="row clearfix title_block">
        <div class="col-md-12">
          <h3 class="title">About <span>HealthX.in</span></h3>
        </div>
      </div>
      <div class="row clearfix">
        <div class="col-md-12">
          <p class="text">MyHealthCheckup is an initiative that creates awareness about the latest health checkup packages being offered by diagnostic clinics and hospitals alike. This enterprise combines the ease of internet access with comprehensive descriptions of health packages and the ability to purchase them with the simple click of a button. </p>
        </div>
      </div>
      <div class="row clearfix">
        <div class="col-md-12">
          <div class="title_row">WHAT WE DO?</div>
          <p>Today, given our drastic requirement to make ends meet, we tend to overlook what keeps us alive and 
            
            kicking – a healthy and balanced lifestyle. Periodic health checkups detect possible deformities, both 
            
            internally and externally, that our bodies face - early diagnosis subsequently reducing the time as well as 
            
            money spent on preventing our anatomy from facing further damage. We understand that the task of 
            
            hunting for diagnostic clinics or hospitals in your area would possibly take days if you plan. We know the 
            
            internet is freely available to you through a variety of channels, and see this as an opportunity to help 
            
            you live better. And, most importantly, a couple of quick sequences with your mouse can mean a few 
            
            more decades spent with your loved ones.</p>
          <p>We at <strong>HealthX</strong> help you choose your hospital/diagnostic center/ clinic based on YOUR convenience and
            
            affordability. We are constantly working at providing our customers with the most competitive rates on 
            
            all the medical investigations that are conducted at hospitals and diagnostic centers.</p>
          <p>To enhance your center experience, we visit each of our partner centers and conduct our own quality 
            
            checks and thereby partnering with only the most reputed centers across the city and assuring quality 
            
            healthcare at affordable prices.</p>
          <p>What’s more, is that we’ve now expanded our services to make your HealthX experience more complete 
            
            and customer-centric. HealthX’s partners now offer specific home collection services, which means that  
            
            all we need from you is a blood sample that will be acquired by medical professionals in the comfort of 
            
            your home. These samples can be used for any diagnostic tests you would subsequently require. That’s 
            
            right, we have evolved to treating you without having you groan at the thought of getting out of bed on 
            
            a holiday. At HealthX, YOU are the centre of our world. YOU define our everything, and we are 
            
            constantly thinking of how to make your experience a wholesome one.</p>
          <div class="title_row">Our Story</div>
          <p>Welcome to HealthX.in, your number one source for all medical related investigations.</p>
          <p>Founded in February 2014 , <strong>HealthX.in</strong> ( previously known as www.myhealthcheckup.in) has come a 
            
            long way from its beginnings which catered only to preventive health checkup packages. When we first 
            
            started out, our passion centered around giving you easy, convenient and affordable access to our 
            
            existing healthcare systems and most importantly to maximize transparency. This drove us to conduct 
            
            an in-depth survey of patient needs and the basic problems we as a part of society face when we 
            
            approach a hospital. Understanding and analyzing these scenarios gave us the impetus to turn hard 
            
            work and inspiration into to a one stop shop for all your medical investigations. We now cater to 
            
            individual laboratory and radiology tests, preventive health checkups and home collection services of 
            
            blood samples. We have brought together the best and most reputed hospitals and diagnostic centers 
            
            the city has to offer and offer these investigations at rates that are much lower than those offered at 
            
            hospital helpdesks. We hope you utilize our portal to the maximum extent and reap the benefits of all 
            
            we have to offer you, helping us “<strong> Add Years to Life</strong> “.</p>
          <p>If you have any questions or comments, please don’t hesitate to contact us at <a href="mailto:info@healthx.in">info@healthx.in</a></p>
         
          
          
          
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