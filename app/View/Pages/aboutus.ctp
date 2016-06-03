<script type="text/javascript"> jQuery.noConflict(); </script>
<?php

echo $this->Html->script('jquery-v1.8.3.js');
echo $this->Html->script('bootstrap.min.js');
echo $this->Html->script("jquery.json-2.2.min.js");
?>


<div class="container">
  <div class="row clearfix">
    <div class="col-md-12">
      <div class="breadcrumb"> <a href="<?php echo Configure::read('medtest_root_path');?>"> HealthX.in </a> <span class="sep"></span> About US
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
          <p class="text">HealthX is an initiative that creates awareness about the latest health checkup packages being offered by diagnostic clinics and hospitals alike. This enterprise combines the ease of internet access with comprehensive descriptions of health packages and the ability to purchase them with the simple click of a button. </p>
        </div>
      </div>
      <div class="row clearfix">
        <div class="col-md-12">
          <div class="title_row"><b>Our Story</b></div>
          <p>Welcome to HealthX.in, your number one source for all medical related investigations.</p>
          <p>Founded in February 2014 , <strong>HealthX.in</strong> has come a 
            
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
          
           
            
          <div class="title_row"><b>WHAT WE DO?</b></div>
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
          
          
            <p>If you have any questions or comments, please don’t hesitate to contact us at <a href="mailto:info@healthx.in">info@healthx.in</a></p>
          
          
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