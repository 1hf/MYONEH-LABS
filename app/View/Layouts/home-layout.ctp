<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My One Health - Adding Years to Life</title>

<meta name="description" content="MRI Scan, CT Scan, Ultrasound, Blood and Lab Tests. Select from top diagnostic centers in Bangalore. labs.myoneh.com">
<meta name="google-site-verification" content="Qo78EWqmU_OzTFUmXlCEM5Utca0bHdo_tIHeYYiBCbA" />

<?php
	//css files
	echo $this->Html->css('bootstrap.min.css');
	echo $this->Html->css('style.css');	
	echo $this->Html->css('jquery-ui.css');
        
	
	//js files
	echo $this->Html->script('jquery.min.js');
	echo $this->Html->script('bootstrap.min.js');
	
        echo $this->Html->script('scripts.js');
        
        echo $this->Html->script('bootstrap-select.js');
        
        echo $this->Html->css('bootstrap-select.css');
        
        echo $this->Html->script('jquery-ui.js');
        
      
	
		
		
	/**
	 * Display's the scripts which are initialised in the view files
	 */
	echo $this->fetch('script');
	echo $this->fetch('css');
	echo $scripts_for_layout;
?>


<link rel="shortcut icon" href="img/favicon.png">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-68707264-5', 'auto');
  ga('send', 'pageview');

</script>
</head>

<body>
<div class="top_bar">
  <div class="container">
    <div class="row clearfix">
      <div class="col-md-12 column">
        <div class="row clearfix">
          <div class="col-md-7 column">
            <select style="display: none;" class="selectpicker">
			
              <option>Location</option>
              <option selected="selected">BANGALORE</option> 
			
            </select>
            <!--<select style="display: none;" class="selectpicker">
              <option>Language</option>
              <option selected="selected">English</option>              
            </select>
            <ul class="link1">
              <li><a href="#">HOSPITALS/CLINICS</a> </li>
              <li><a href="#">PACKAGES</a></li>
            </ul>-->
          </div>
          <!--<div class="col-md-5 column">
            <ul class="link2">
              <li><a href="<?php echo Configure::read('medtest_root_path');?>">Home</a> </li>
              <li><a href="<?php echo Configure::read('medtest_root_path');?>pages/aboutus" >About Us</a></li>
              <li><a href="http://www.healthxblog.wordpress.com" target="_blank">Blog</a></li>
              <li><a href="<?php echo Configure::read('medtest_root_path');?>pages/contactus">Contact Us</a></li>
              <li><a href="#">FAQs</a></li>              
            </ul>
          </div>-->
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container header_wrapp header_wrapp_home">  <div class="row clearfix header">
    <div class="col-md-4 column">
        <!--<img src="img/logo.png" />-->
        <?php //echo $this->Html->link($this->Html->image('logo.png', array('alt' => 'logo', 'border' => '0','width'=>'35%')),Configure::read('medtest_root_path'),array('escape' => false));
		echo $this->Html->link($this->Html->image('OneHealthlogo-01.jpg', array('alt' => 'logo', 'border' => '0','width'=>'35%')),Configure::read('medtest_root_path'),array('escape' => false));
         ?>
    </div>
    <div class="col-md-5 mid_col">
     <!-- <h2 class="text1"> What is <span><a href="<?php echo Configure::read('medtest_root_path');?>pages/aboutus" style="text-decoration:none;">HealthX.in? </a></span></h2>-->
    </div>
    <div class="col-md-3 column" style="margin-top: 10px;">
		<div class="phone_num" style="width: 150px;text-align: center;height: 30px;padding-top: 6px;border-bottom: 1px solid #FFF;font-size: initial;"><a href="#" data-toggle="popover" title="Booking / Helpline" data-content="Call 1800-102-3915 to book your appointment or get your queries answered." data-placement="left">Booking / Helpline</a></div>
      <div class="phone_num" style="width: 150px;text-align: center;height: 30px;padding-top: 5px;"><a href="tel:18001023915" style="font-size: initial;" data-toggle="popover" title="Booking / Helpline" data-content="Call 1800-102-3915 to book your appointment or get your queries answered." data-placement="left">1800-102-3915</a> </div>
    </div>
  </div>
</div>
<!-- END HEADER -->
<?php print $this->Session->flash();?>
<?php print $content_for_layout;?>
                        <!-- BEGIN FOOTER 
  _____           _                
 |  ___|__   ___ | |_ ___ _ __   _ 
 | |_ / _ \ / _ \| __/ _ \ '__| (_)
 |  _| (_) | (_) | |_  __/ |     _ 
 |_|  \___/ \___/ \__\___|_|    (_)
                                   
      -->
<link href='http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css' rel='stylesheet'>
<script>
$(document).ready(function(){
    $('[data-toggle="popover"]').popover(); 
});
</script>
<style>
h3.popover-title{
	color:#000;
	font-size: 17px;
}
div.popover-content{
	color:#000;
	font-size: small;
}
</style>
</body>
</html>