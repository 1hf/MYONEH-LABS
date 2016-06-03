<script type="text/javascript"> jQuery.noConflict(); </script>

<?php

echo $this->Html->script('jquery-v1.8.3.js');
echo $this->Html->script('bootstrap.min.js');
echo $this->Html->script("jquery.json-2.2.min.js");
?>


<script>
$(document).ready(function(){
  $('#maps_te').click(function() {
	 // alert('am getting ready babe...');
    $('#map_canvas').delay('700').fadeIn();
    setTimeout(initialise,1000);
  }); 
});
 $(document).on('click', '#termsModalLink', function(){
		  $('#termsModal').modal({backdrop: 'static'}); 
	 });


var medtest_root_path = "<?php echo $this->webroot;?>";
//alert(medtest_root_path);
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
      <div class="breadcrumb"> <a href="<?php echo Configure::read('medtest_root_path');?>"> HealthX </a><span class="sep"></span> <a href="javascript:window.history.back();"> Packages</a> <span class="sep"></span> <?php if($selected_package_name!=""){ ?> <span class="active"><?php echo ucfirst($selected_package_name);?></span>
      
      <?php } ?>
      </div>
    </div>
  </div>
  <div class="row clearfix">
    <div class="col-md-8  ">
      <div class="row clearfix">
        <div class="col-md-12 review_wrapp">
          <p> <?php echo $this->General->fetchStarRatingInside($packageDetails['Clinic']['rating']); ?> <!--<a href="#">Read Reviews</a> | 12 Reviews <span class="user_review"><a href="#">USER REVIEWS & FEEDBACK</a></span>--></p>
        </div>
      </div><?php 
	  
	  $logo_file=$filePath = "upload/clinics/".$packageDetails['Clinic']['id']."/".$packageDetails['Clinic']['logo']; 
	  ?>
      <div class="row clearfix title_block">
        <div class="col-md-2 logo_sml">        
         <?php if($packageDetails['Clinic']['logo']!=''){ ?>
         <?php echo $this->Html->image($this->webroot.$logo_file, array('alt' => 'logo', 'border' => '0','width'=>'77','height'=>'77')); ?>   
        
        <?php }else {
        
		 echo $this->Html->image('default_clinic.png', array('alt' => 'Clinic', 'border' => '0','width'=>'77','height'=>'77'));     
            }?>
         </div>
        <div class="col-md-10 reset_left_padding">
          <h3><?php  echo $packageDetails['Clinic']['clinic_name']."-".$packageDetails['Area']['area_name']; ?></h3>
          <p class="address"><?php  echo $packageDetails['Clinic']['address_line1']; ?>, <?php  echo $packageDetails['Clinic']['address_line2']; ?>, <?php  echo $packageDetails['Clinic']['address_line3']; ?>, <?php  echo $packageDetails['Clinic']['address_line3']; ?>, Bangalore - <?php  echo $packageDetails['Clinic']['postcode']; ?></p>
        </div>
      </div>
      <div class="row clearfix">
        <div class="col-md-12 tab_wrapp">
          <div role="tabpanel">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Package Details</a></li>
             <!-- <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Photos</a></li>-->
              <li role="presentation"><a href="#map" id="maps_te" aria-controls="map" role="tab" data-toggle="tab">View Map</a></li>
              <li role="presentation"><a href="#precaution" aria-controls="settings" role="tab" data-toggle="tab">Precautions & Preparations</a></li>
             <!-- <li role="presentation"><a href="#terms" aria-controls="terms" role="tab" data-toggle="tab">Terms & Conditions</a></li>-->
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="home">
              <!--  <div class="title_row">Details</div>
                <p><?php // echo $packageDetails['Clinic']['description']; ?>.</p>-->
                <div class="title_row">Investigations Included</div>
                 <ul class="service_list">
                <?php $tests_inculed_arr =explode('###',$packageDetails['TestPackage']['tests_included']);
				//debug($tests_inculed_arr);	
					foreach($tests_inculed_arr as $itms){	
					 if($itms!=''){
						$itmPcs =explode(':',$itms);	
						//debug($itmPcs);
						if(count($itmPcs)>1){
							$itms="<strong>".$itmPcs[0].": </strong>".$itmPcs[1];
						}
					 }
				?>
                
                  <li><?php echo $itms; ?></li>
                  <?php  } ?>
                
                </ul>
                
             
                <div class="title_row">WORKING HOURS</div>
                <ul class="time">
                  <li><span>MON - FRI</span>: <?php  echo $packageDetails['TestPackage']['mon_fri']; ?></li>
                  <li><span>SATURDAY </span>:<?php  echo $packageDetails['TestPackage']['saturday']; ?></li>
                  <li><span>SUNDAY</span>: <?php  echo $packageDetails['TestPackage']['holidays']; ?></li>
                </ul>
                <?php 
                      $total_actual_price=0;$total_offer_price=0; $offer_percent=0; $clinic_test_id_vals= array();
					  $total_actual_price=$total_actual_price+$packageDetails['TestPackage']['price_actual'];
					  $total_offer_price=$total_offer_price+$packageDetails['TestPackage']['price_offer'];
					  $offer_percent=(($total_actual_price-$total_offer_price)/$total_actual_price)*100;
					  
				?>
                
              </div>
              <div role="tabpanel" class="tab-pane" id="map"> 
              <div id="map-canvas" style="height:400px; width:640px;"></div>
                </div>
            
             <div role="tabpanel" class="tab-pane" id="precaution">
             <ul class="service_list">
             <li>12 hours complete fasting required for Health Checkups.</li>
             <li>Do not consume anything except plain water in the morning.</li>
             <li>Please carry all previous medical records, if any. </li>
             <li>Diabetic patients should not consume any anti-diabetic drug in the morning before the check-up. You may carry the drug/insulin to be taken after breakfast.</li>
              <li>Those advised USG of the abdomen/pelvis should be fasting for at least 6 hours and should have a full bladder at the time of scan.</li>
             <li>Please be informed that pregnant women are advised against X-Rays. </li>
             <li>Kindly bring a sample of urine and stool in a clean container or a sterilized container. It can be collected from the hospital or any nearby pharmacy. </li>
                   
             
             </ul>
             
              </div>
              
            </div>
          </div>
        </div>
      </div>
      <div class="row clearfix">
      	<div class="price_terms_wrapp">
          <div class="price_block">PRICE: Rs.<?php echo $total_actual_price; ?>  <span class="off"><?php echo ceil($offer_percent) ;?>% OFF</span>  YOU PAY: <span class="rupee">Rs.</span> <span class="amount"><?php echo $total_offer_price; ?>  </span></div>
           <p class="terms">Please read the <a  class="fancybox" href="javascript:void(0)" id="termsModalLink" >Terms & Conditions</a> carefully.</p>
               <div class="quickbook_btn">
                <form action="<?php echo Configure::read('medtest_root_path');?>booking/index" method="post" >
                      <input type="hidden" value="<?php echo $packageDetails['TestPackage']['id'];?>" name="pacakge_id" />
                      <a href="javascript:void(0)" onclick="javascript:submitform(this);" >Select</a>                      
               </form> 
              </div>
          </div>
      </div>
      <div class="row clearfix">
        <div class="col-md-12 related_service">
          <h3>Related Services & Packages</h3>
        </div>
      </div>
      <?php foreach($rltd_package_details as $rltd_package) {
		   $logo_file_inner=$filePath = "upload/clinics/".$rltd_package['Clinic']['id']."/".$rltd_package['Clinic']['logo']; 
		   $total_actual_price=0;$total_offer_price=0; $offer_percent=0; $clinic_test_id_vals= array();
					  $total_actual_price=$total_actual_price+$rltd_package['TestPackage']['price_actual'];
					  $total_offer_price=$total_offer_price+$rltd_package['TestPackage']['price_offer'];
					  $offer_percent=(($total_actual_price-$total_offer_price)/$total_actual_price)*100;
		  ?>
      <div class="row clearfix related_service_row">
        <div class="col-md-2"> <?php if($rltd_package['Clinic']['logo']!=''){ ?>
         <?php echo $this->Html->image($this->webroot.$logo_file_inner, array('alt' => 'logo', 'border' => '0','width'=>'77','height'=>'77')); ?>      
        
        <?php }else {
        
		 echo $this->Html->image('default_clinic.png', array('alt' => 'Clinic', 'border' => '0','width'=>'77','height'=>'77'));     
            }?></div>
        <div class="col-md-10 reset_left_padding">
          <h4><a href="<?php echo Configure::read('medtest_root_path');?>detail/index/<?php echo $this->General->enCrypt($rltd_package['TestPackage']['id']); ?>" ><?php  echo $rltd_package['Clinic']['clinic_name']."-".$rltd_package['Area']['area_name'].":".$rltd_package['TestPackage']['package_name']; ?></a></h4>
          <p><?php  echo $rltd_package['Clinic']['description']; ?></p>
          <p class="price">PRICE: <span>Rs.<?php echo $total_actual_price; ?></span> <span class="offer_price">Rs.<?php echo $total_offer_price; ?></span></p>
        </div>
      </div>
      
      <?php } ?>
      
    </div>
    <div class="col-md-4  ">
      <?php echo $this->Element('Common/side_call_back'); ?>
      <div class="ad"><?php //echo $this->Html->image('ad2.jpg', array('alt' => 'ad', 'border' => '0','width'=>'300','height'=>'600')); ?></div></div>
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

 <!-- ################### Terms & Condtions########################### --> 
 
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
  
  <script language="javascript">
	
	function submitform( id){		
		var formid=$(id).closest("form");
		formid.submit();
	}
</script>

<script>
	function initialise() {
		
		var myLatlng = new google.maps.LatLng(<?php  echo $packageDetails['Clinic']['latitude']; ?>,<?php  echo $packageDetails['Clinic']['longitude']; ?>); // Add the coordinates
		var mapOptions = {
			zoom: 16, // The initial zoom level when your map loads (0-20)
			minZoom: 6, // Minimum zoom level allowed (0-20)
			maxZoom: 17, // Maximum soom level allowed (0-20)
			zoomControl:true, // Set to true if using zoomControlOptions below, or false to remove all zoom controls.
			zoomControlOptions: {
  				style:google.maps.ZoomControlStyle.DEFAULT // Change to SMALL to force just the + and - buttons.
			},
			center: myLatlng, // Centre the Map to our coordinates variable
			mapTypeId: google.maps.MapTypeId.ROADMAP, // Set the type of Map
			scrollwheel: false, // Disable Mouse Scroll zooming (Essential for responsive sites!)
			// All of the below are set to true by default, so simply remove if set to true:
			panControl:false, // Set to false to disable
			mapTypeControl:false, // Disable Map/Satellite switch
			scaleControl:false, // Set to false to hide scale
			streetViewControl:false, // Set to disable to hide street view
			overviewMapControl:false, // Set to false to remove overview control
			rotateControl:false // Set to false to disable rotate control
	  	}
		var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions); // Render our map within the empty div
		
		var image = new google.maps.MarkerImage(medtest_root_path+"app/webroot/img/map_marker.png", null, null, null, new google.maps.Size(35,55)); // Create a variable for our marker image.
			
		var marker = new google.maps.Marker({ // Set the marker
			position: myLatlng, // Position marker to coordinates
			icon:image, //use our image as the marker
			map: map, // assign the marker to our map variable
			title: '<?php  echo $packageDetails['Clinic']['clinic_name']; ?>:  Contact HealthX if you finding difficulty.' // Marker ALT Text
		});
		
		// 	google.maps.event.addListener(marker, 'click', function() { // Add a Click Listener to our marker 
		//		window.location='http://www.snowdonrailway.co.uk/shop_and_cafe.php'; // URL to Link Marker to (i.e Google Places Listing)
		// 	});
		
		var infowindow = new google.maps.InfoWindow({ // Create a new InfoWindow
  			content:"<h5><?php  echo $packageDetails['Clinic']['clinic_name']; ?></h5> &nbsp; <p class='address'><?php  echo $packageDetails['Clinic']['address_line1']; ?>, <?php  echo $packageDetails['Clinic']['address_line2']; ?>,<?php  echo $packageDetails['Clinic']['address_line3']; ?>, <br>  <?php  echo $packageDetails['Clinic']['address_line3']; ?>, Bangalore - <?php  echo $packageDetails['Clinic']['postcode']; ?></p>" // HTML contents of the InfoWindow
  		});

		google.maps.event.addListener(marker, 'click', function() { // Add a Click Listener to our marker
  			infowindow.open(map,marker); // Open our InfoWindow
  		});
		
		google.maps.event.addDomListener(window, 'resize', function() { map.setCenter(myLatlng); }); // Keeps the Pin Central when resizing the browser on responsive sites
		google.maps.event.trigger(map, 'resize');
		
	}
	google.maps.event.addDomListener(window, 'load', initialise); // Execute our 'initialise' function once the page has loaded. 
	google.maps.event.trigger(map, 'resize');
</script>