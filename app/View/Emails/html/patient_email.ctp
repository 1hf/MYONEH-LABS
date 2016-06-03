<?php
	$medtest_img_path = Configure::read('medtest_root_path')."app/webroot/img/";
	$logo_image = $medtest_img_path."logo.png";
	
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<body style="font-family: Arial;">
<!--<div style="width:700px; background-color:#cce3f2;box-shadow: 0 6px 10px gray; margin:0 auto;">-->
<div style="width:700px; background-color:#E81556;box-shadow: 0 6px 10px gray; margin:0 auto;">


 <div style="padding:15px;">
 <div style=" background-color: #FFFFFF;padding: 10px; border-radius:5px 5px 5px 5px; -moz-border-radius:5px 5px 5px 5px; -webkit-border-radius:5px 5px 5px 5px;">
 	
 	<p style="font-size:12px; color:#666666;   font-family: Arial; font-weight:normal;"><span>
 	<?php echo $email_content;?></span> </p>
    
     <p style="font-size:10px;color:#000">
         Disclaimer: This message may contain confidential or privileged information. If you are not the intended recipient, please let the sender know, and delete the email to help prevent any further unauthorized use. Email transmission can be lost, delayed, corrupted, intercepted or carry viruses that can harm your computer. One Health Solutions Pvt Ltd is not liable for any damage caused from the effects of email communication.
     </p>


   <div style="padding-top: 15px;">
	<!--<span align="right" style="float:left; margin-top:5px;color:#676767; font-size:14px; font-family:Arial, Helvetica, sans-serif">Adding Years to Life  </span>-->
   <img style="margin-left: 8px" src="<?php echo $logo_image; ?>" width="148" height="61" />
 	
 	</div>
 	
 </div>

</div>
</body>
</html>
