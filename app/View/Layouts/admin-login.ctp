<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>HealthX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">


    
    <?php
    

    echo $this->Html->css('style-admin-login.css');

    echo $this->Html->css('bootstrap/bootstrap.css');
    echo $this->Html->css('bootstrap/bootstrap-responsive.css');

    echo $this->Html->css('chosen.css');
    echo $this->Html->css('jquery-ui.css');    
        
    echo $this->Html->script('jquery.js');
    echo $this->Html->script('jquery-ui.js');
    echo $this->Html->script('chosen.jquery.js');
    echo $this->Html->script('bootstrap/bootstrap-transition.js');
    echo $this->Html->script('bootstrap/bootstrap-collapse.js');
    echo $this->Html->script('bootstrap/bootstrap-tab.js');
    echo $this->Html->script('bootstrap/bootstrap-typeahead.js');
	
    ?>
	
	<script type="text/javascript">
	// image path is to mention the path in global for this layout which is this contains url path before img folder
	var medtest_root_path = "<?php echo $this->webroot;?>";

	</script>
   

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
     <script src="bootstrapp/js/html5shiv.js"></script>
    <![endif]-->

    <!-- Fav and touch icons -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="bootstrapp/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="bootstrapp/ico/apple-touch-icon-114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="bootstrapp/ico/apple-touch-icon-72-precomposed.png">
                    <link rel="apple-touch-icon-precomposed" href="bootstrapp/ico/apple-touch-icon-57-precomposed.png">
                                   <link rel="shortcut icon" href="bootstrapp/ico/favicon.png">
  </head>

  <body class="loading admin">

   
      
 

    
    
 

     
     
     <div class="container wrapper">
     <div class="navbar navbar-inverse">
    <div class="navbar-inner">
        <div class="container header">
        <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
           <div class="span3 logo" style="margin-top:50px;margin-bottom:30px;font-size:40px; color:#C36; font-family:Tahoma, Geneva, sans-serif;">
          
            <a href="#"> 
           <?php echo $this->Html->image('logo.png', array('alt' => 'logo', 'border' => '0','width'=>'148','height'=>'61'));
            ?>
            
           </a>
          </div>
          
         
          <!--<div class="nav-collapse collapse">
            <p class="navbar-text pull-right">
              Logged in as <a href="#" class="navbar-link">Username</a>
            </p>
            <ul class="nav top_nav">
              <li><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div>--><!--/.nav-collapse -->
        </div>
      </div>
         </div>
         
     <?php echo $this->Session->flash(); ?>
	<?php echo $this->fetch('content'); ?>
     
     
     
       <footer>
        <ul>
            <li> Copyright © <?php echo date("Y"); ?> One Health Solutions Pvt Ltd.</li>
            <!--<li><a href="<?php echo $this->webroot;?>contents/terms_conditions"> Terms of Service</a> </li>
            <li> | </li>
            <li><a href="<?php echo $this->webroot;?>contents/privacy_policy">Privacy Policy </a></li>
            <li> | </li>
            <li><a href="<?php echo $this->webroot;?>contents/about_us">About</a> </li>
            <li> | </li>
            <li><a href="#">Contact</a> </li>
            <li> | </li>
            <li><a href="#">Blog </a></li>-->
        </ul>
      </footer>

    </div><!--/.fluid-container-->
    

   

  </body>
</html>
