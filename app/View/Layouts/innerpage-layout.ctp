<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="google-site-verification" content="Qo78EWqmU_OzTFUmXlCEM5Utca0bHdo_tIHeYYiBCbA" />    
<meta name="title" content="<?php echo @$meta_title; ?> in Bangalore"/>
<meta name="description" content="<?php echo @$seo_tags; ?>">
<meta name="author" content="">
<title>My One Health- <?php echo @$meta_title; ?></title>
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?sensor=false"></script>
<?php
	//css files
	echo $this->Html->css('bootstrap.min.css');
	echo $this->Html->css('style.css');	
	echo $this->Html->css('bootstrap-select.css');
			
	
	//js files
        
	echo $this->Html->script('jquery.min.js'); 
	echo $this->Html->script('bootstrap-select.js');	
	echo $this->Html->script('scripts.js');

	/**
	 * Display's the scripts which are initialised in the view files
	 */
	echo $this->fetch('script');
	echo $this->fetch('css');
	echo $scripts_for_layout;
?>
<style type="text/css">
      html, body, #map_test { height: 100%; margin: 0; padding: 0;}
 </style>

<script type="text/javascript">
//$('#carousel-example-generic').carousel({wrap:true});

</script>
<link rel="shortcut icon" href="img/favicon.png">
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
              <option>Hindi</option>
            </select>-->
            <!--<ul class="link1">
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
              
            </ul>
          </div>-->
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container header_wrapp">
  <div class="row clearfix header">
    <div class="col-md-4 column"> 
        <!--<img src="img/logo.png" />--> 
        <?php //echo $this->Html->link($this->Html->image('logo.png', array('alt' => 'logo', 'border' => '0','width'=>'35%')),Configure::read('medtest_root_path'),array('escape' => false));
		echo $this->Html->link($this->Html->image('OneHealthlogo-01.jpg', array('alt' => 'logo', 'border' => '0','width'=>'35%')),Configure::read('medtest_root_path'),array('escape' => false));
         ?>
    </div>
    <div class="col-md-5 mid_col">
      <!--<h2 class="text1"> What is <span><a href="<?php echo Configure::read('medtest_root_path');?>pages/aboutus" style="text-decoration:none;">HealthX.in? </a></span></h2>-->
    </div>
    <!--<div class="col-md-3 column">
      <div class="phone_num"><a href="tel:18001023915">Call 1800-102-3915</a> </div>
    </div>-->
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
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-58353132-1', 'auto');
  ga('send', 'pageview');

</script>
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