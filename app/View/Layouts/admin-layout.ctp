<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>HealthX</title>
<?php

	echo $this->Html->css('style-admin.css');
	echo $this->Html->css('accord.css');
	//echo $this->Html->css('../js/fancybox/jquery.fancybox-1.3.1.css');
	echo $this->Html->script('jquery-1.6.4.js');
	echo $this->Html->script('ddaccordion.js');
	echo $this->Html->script('jquery.accordion.source.js');
       
        echo $this->Html->script('jquery.blockUI.js');
        echo $this->Html->script('common_functions.js');
	//echo $this->Html->script('fancybox/jquery.fancybox-1.3.1.js');
	/**
	 * Display's the scripts which are initialised in the view files
	 */
	echo $this->fetch('script');
	echo $this->fetch('css');
	echo $scripts_for_layout;
?>
<script type="text/javascript">
	// image path is to mention the path in global for this layout which is this contains url path before img folder
	var medtest_root_path = "<?php echo $this->webroot;?>";
	
	//Initialize Arrow Side Menu:
	ddaccordion.init({
		headerclass: "menuheaders", //Shared CSS class name of headers group
		contentclass: "menucontents", //Shared CSS class name of contents group
		revealtype: "clickgo", //Reveal content when user clicks or onmouseover the header? Valid value: "click", or "mouseover"
		mouseoverdelay: 200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
		collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
		defaultexpanded: [0], //index of content(s) open by default [index1, index2, etc]. [] denotes no content.
		onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
		animatedefault: false, //Should contents open by default be animated into view?
		persiststate: true, //persist state of opened contents within browser session?
		toggleclass: ["unselected", "selected"], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
		togglehtml: ["none", "", ""], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
		animatespeed: 500, //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
		oninit:function(expandedindices){ //custom code to run when headers have initalized
			//do nothing
		},
		onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
			//do nothing
		}
	});

	//Accordian Menu Satrt
	$(document).ready(function () {
		$('ul.accordion').accordion();
		$('ul.accordion li:first').addClass('active');
		$('ul.accordion li ul:first').css('display', '');
	});
	//Accordian Menu End
</script>
</head>

<body>
	<!--main-wrapper START -->
	<div id="main-wrapper">

		<!--container START -->
		<div id="container">

			<!--  Header START -->
			<div id="header">
				<div class="logo" style="font-size:40px; color:#C36; font-family:Tahoma, Geneva, sans-serif;">
					<?php echo $this->Html->image('logo.png', array('alt' => 'logo', 'border' => '0','width'=>'148','height'=>'61'));
                                    ?>
                    
				</div>
				<div class="right-link-wrapper">
					<div class="logged">
						Logged as: <span><?php echo $this->Session->read('Auth.User.firstname').' '.$this->Session->read('Auth.User.lastname'); ?></span>
					</div>
					<div class="logout-btn">
						<a href="index.html"> <?php echo $this->Html->image('logout-btn.png', array('border' => '0', 'url'=>array('controller'=>'users', 'action'=>'logout') )); ?>
						</a>
					</div>
				</div>
				<div class="clear"></div>
				<!--  <div class="top-nav">
					<ul>
						<li><a href="<?php echo $this->webroot;?>pages/dashboard" <?php if(!empty($HighLight) && $HighLight=='dashboard'){ ?> class="current" <?php } ?> >Home</a></li>
						<li><a href="<?php echo $this->webroot;?>pages/faq" <?php if(!empty($HighLight) && $HighLight=='faq'){ ?> class="current" <?php } ?> >FAQ</a></li>
						<li><a href="<?php echo $this->webroot;?>pages/contact_us" <?php if(!empty($HighLight) && $HighLight=='contact_us'){ ?> class="current" <?php } ?> >Contact Us</a></li>
						<li><a href="<?php echo $this->webroot;?>pages/help" <?php if(!empty($HighLight) && $HighLight=='help'){ ?> class="current" <?php } ?> >Help</a></li>
					</ul>
				</div>-->
			</div>
			<!--  Header END -->

			<!--content-area START -->
			<div class="content-aria">

				<!--left-column START -->
				<div class="left-column">
					<!--left menu  START -->
					<div class="left_nav_top"></div>
					<div class="left_nav_mid">
						<ul class="accordion">
							<li><a href="#"><span class="nav-icon1"></span>Menu</a>
								<ul>
									
									<li>
													<a href="<?php echo $this->Html->url(array('controller' => 'manage_area', 'action' => 'list_areas'));?>">
														Manage Areas
													</a>
									</li>
									
									<li>
													<a href="<?php echo $this->Html->url(array('controller' => 'manage_clinic', 'action' => 'list_clinics'));?>">
														 Manage Clinics
													</a>
									</li>
									
									<li>
													<a href="<?php echo $this->Html->url(array('controller' => 'manage_test', 'action' => 'list_tests'));?>">
														Manage Test Master
													</a>
									</li>
                                                                        <li>
													<a href="<?php echo $this->Html->url(array('controller' => 'manage_clinic_test', 'action' => 'list_clinic_tests'));?>">
														Manage Clinic Tests
													</a>
									</li>

                                    
									

                                                                        <li>
													<a href="<?php echo $this->Html->url(array('controller' => 'manage_test_package', 'action' => 'list_test_packages'));?>">
														Manage Test Packages
													</a>
									</li>
                                                                        
                                                                        <li>
													<a href="<?php echo $this->Html->url(array('controller' => 'manage_booking', 'action' => 'list_bookings'));?>">
														 Manage Bookings
													</a>
									</li>
                                                                        
                                                                        <li>
													<a href="<?php echo $this->Html->url(array('controller' => 'manage_test_price', 'action' => 'index'));?>">
														 Update Clinic Test Price
													</a>
									</li>
                                                    
                                                                        <li>
													<a href="<?php echo $this->Html->url(array('controller' => 'upload_test', 'action' => 'index'));?>">
														Upload Clinic Tests
													</a>
									</li>
                                                                        <li>
													<a href="<?php echo $this->Html->url(array('controller' => 'upload_test_package', 'action' => 'index'));?>">
														Upload Test Package
													</a>
									</li>
									<li>
													<a href="<?php echo $this->Html->url(array('controller' => 'contents', 'action' => 'viewcontents'));?>">
														Manage Contents
													</a>
									</li>                          
									<li>
													<a href="<?php echo $this->Html->url(array('controller' => 'settings', 'action' => 'index'));?>">
														General Settings
													</a>
									</li>
																	
								</ul>
							</li>
						</ul>
					</div>
					<div class="left_nav_btm"></div>
					<!--left menu  END -->
				</div>
				<!--left-column END -->
				<!--right-column START -->
				<div class="right-column">
					<div style="float: left; width: 100%;" class="wrap">
						<?php print $this->Session->flash();?>
						<?php print $content_for_layout;?>
					</div>
				</div>
				<!--right-column END -->
			</div>
			<!--content-area END -->
			<!--Footer END -->
			<div class="footer">
				<div class="footer-left"></div>
				<div class="footer-mid">
					<div class="copyright">
						Copyright © <?php echo date("Y"); ?> One Health Solutions Pvt Ltd.
					</div>
					<!--<div class="designedby">Powered by Capsten</div>-->
				</div>
				<div class="footer-right"></div>
			</div>
			<!--Footer END -->
		</div>
		<!--container END -->
	</div>
	<!--main-wrapper END -->
</body>
</html>
