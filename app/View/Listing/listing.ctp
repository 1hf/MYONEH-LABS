 <?php if(!empty($clinicTestList))
	{ 
function getlatlon($address){
	$address = str_replace(" ", "", $address);
	$url = "http://maps.googleapis.com/maps/api/geocode/json?address=$address&region=India";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$response = curl_exec($ch);
	curl_close($ch);
	$response_a = json_decode($response);
	$lat = $response_a->results[0]->geometry->location->lat;
	$long = $response_a->results[0]->geometry->location->lng;
	return $address.",".$lat.",".$long;
}
function driving($lat1,$long1,$lat2,$long2){
	$q = "http://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat2.",".$long2."&destinations=".$lat1.",".$long1."&mode=driving";
//$json = file_get_contents($q);
$ch1 = curl_init();
	curl_setopt($ch1, CURLOPT_URL, $q);
	curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch1, CURLOPT_PROXYPORT, 3128);
	curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, 0);
	$json = curl_exec($ch1);
	curl_close($ch1);
$details = json_decode($json, TRUE);
//$details = json_decode($json, TRUE);
return $details;
//echo $lat1." ".$long1." ".$lat2." ".$long2."<pre>"; print_r($details); echo "</pre>";
}

function haversineGreatCircleDistance(
  $lat1, $lon1, $lat2, $lon2, $unit)
{
  // convert from degrees to radians
 $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
      return number_format((float)($miles * 1.609344), 2, '.', '')." Km";
  } else if ($unit == "N") {
      return number_format((float)($miles * 0.8684), 2, '.', '');
  } else {
      return number_format((float)$miles, 2, '.', '');
  }
}
/* function walking($lat1,$long1,$lat2,$long2){
	$q1 = "http://maps.googleapis.com/maps/api/distancematrix/json?origins=".$lat1.",".$long1."&destinations=".$lat2.",".$long2."&mode=walking&sensor=false";
$json1 = file_get_contents($q1);
$details1 = json_decode($json1, TRUE);
return $details1;
//echo $lat1." ".$long1." ".$lat2." ".$long2."<pre>"; print_r($details); echo "</pre>";
} */





?>
   <div class="row clearfix ">
        <div class="col-md-8 column ">
        <?php  foreach($selected_tests_arr as $key=>$test){ ?>
         <!-- <div class="filter_text"><?php //echo $test;?><span>X</span></div>-->
        <?php } ?>
        </div>
        <div class="col-md-4 column ">
          <!--<div class="sort_by">Sort by
            <select>
              <option value="one">Relevance</option>
              <option value="two">Two</option>
              <option value="three">Three</option>
              <option value="four">Four</option>
              <option value="five">Five</option>
            </select>
          </div>-->
        </div>
      </div>     
   <?php
	}else {
		echo "vpb_is_finished";
	}
	if(!empty($clinicTestList))
	{
		//echo "<pre>"; print_r($clinicTestList);
//FIND OUT THE LATITUDE OF THE USER LOCATION OR ZIPCODE
if($_SESSION['areaName']!=""){ 
if(isset($searchedAreaLatitude) ? $searchedAreaLatitude : ''){
	$userLatitue = $searchedAreaLatitude;
	$userLongitude = $searchedAreaLongitude;
	
}else{
	$latLon = getlatlon($_SESSION['areaName']);
	$latLon1 = explode(",", $latLon); 
	//echo $latLon1[0];
	$userLatitue = $latLon1[1];
	$userLongitude = $latLon1[2];
}
	
}


		$i=0;
		foreach($clinicTestList as $clinicTest)
		{
/* echo "<pre>";
print_r($clinicTest); */
$clinicLatitude = $clinicTest['clinics']['latitude'];
$clinicLongitude = $clinicTest['clinics']['longitude'];
$clinicPostcode = $clinicTest['clinics']['postcode'];
if($_SESSION['areaName']!=""){	
	//$earthRadius = 6371000;
//$drivingDetails = driving($userLatitue, $userLongitude, $clinicLatitude, $clinicLongitude);
//$drivingDistance = $drivingDetails['rows'][0]['elements'][0]['distance']['text'];

$drivingDistance = haversineGreatCircleDistance($userLatitue, $userLongitude, $clinicLatitude, $clinicLongitude, "K");


/* $walkingDetails = walking($userLatitue, $userLongitude, $clinicLatitude, $clinicLongitude);
$walkingDistance = $walkingDetails['rows'][0]['elements'][0]['distance']['text'];
 *///echo $drivingDistance;
/* echo "<pre>";
print_r($drivingDetails); */
}		
			//debug($clinicTest);
			$logo_file=$filePath = "upload/clinics/".$clinicTest['clinics']['id']."/".$clinicTest['clinics']['logo'];
				?>
      <!--  Search result Block row start --> 
        <div class="row clearfix ">
        <div class="col-md-12 column "><?php
			if(isset($clinicTest['TestResult'])){
				foreach($clinicTest['TestResult']  as $testDetail){
					$actualPrice = $testDetail['clinic_tests']['price_actual'];
				}
				if($actualPrice>0) {
				?>
          <div class="row clearfix search_result_block">
		  
            <div class="col-md-2 left_col ">
              <?php if($clinicTest['clinics']['logo']!=''){ ?>
        <img src="<?php echo $logo_file;?>" width="77" height="77" alt="<?php  echo $clinicTest['clinics']['clinic_name']." - ".$clinicTest['areas']['area_name']; ?>">
        <?php }else {?>
         <img src="img/default_clinic.png" width="77" height="77">
         <?php }?>
             <!-- <div class="photos"><a href="#">PHOTOS</a></div>-->
            </div>
            <div class="col-md-10 right_col">
			
              <div class="row clearfix ">
                <div class="col-md-10 reset_left_padding">
                  <h2><?php  echo $clinicTest['clinics']['clinic_name']." - ".$clinicTest['areas']['area_name']; ?></h2>
                  <p class="address"><?php  echo $clinicTest['clinics']['address_line1']; ?>, <?php  echo $clinicTest['clinics']['address_line2']; ?>, <?php  echo $clinicTest['clinics']['address_line3']; ?>, Bangalore - <?php  echo $clinicTest['clinics']['postcode']; ?>
                  
                   <br /><a href="http://maps.google.com/?q=<?php echo $clinicTest['clinics']['latitude'];?>,<?php echo $clinicTest['clinics']['longitude'];?>" target="_blank" ><img src='img/distanceimg.png' width='12px' style='margin-top: -9px;' />&nbsp;<?php echo $drivingDistance; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View Map</a>
                  </p>
                </div>
                <div class="col-md-2 review">
                <p><!--<img src="img/rating_active.png" width="17" height="16"> <img src="img/rating_active.png" width="17" height="16"> <img src="img/rating_active.png" width="17" height="16"><img src="img/rating.png" width="17" height="16"> <img src="img/rating.png" width="17" height="16">-->
                <?php echo $this->General->fetchStarRating($clinicTest['clinics']['rating']); ?>
                </p>
                 <?php if(!empty($clinicTest['clinics']['admin_reviews'])){ ?>   
                 <?php  $review_main= explode("$$",$clinicTest['clinics']['admin_reviews']);
				 $string_review="";	
				 	foreach($review_main as $string_rvw){	
					 	$review= explode(":",$string_rvw);			 
				  		$name=ucfirst($review[0]); $text=$review[1];
				 		$string_review.="<b><i>".$name."</i></b> :".$text."<br/>";
					}
				  ?>              
                  <p><a href="javascript:writeReviewContent('<?php echo $string_review;?>');" class="link_Review">READ REVIEWS</a></p>                  
                                     
                  <?php } ?>
                </div>
              </div>
                <div class="row clearfix ">
                <div class="col-md-12  reset_left_padding">
                <?php if(!empty($clinicTest['TestResult'])){ ?>
                  <h5>SELECTED TESTS</h5>
                  <ul class="test">
                  <?php 
				  $total_actual_price=0;$total_offer_price=0; $offer_percent=0; $clinic_test_id_vals= array();				  
				  foreach($clinicTest['TestResult']  as $testDetail){
					  if(is_array($testDetail)){						
					    $clinic_test_id_vals[]=$testDetail['clinic_tests']['id'];					   
					  ?>
                 	   
                 <?php if(count($clinicTest['TestResult'])>1){ 
				 if($testDetail['clinic_tests']['price_actual']>0) {
					?><li><span><?php  echo $testDetail['tests']['test_name']; ?></span>
                  <div class="price_block_small">Actual Price: Rs. <?php  echo $testDetail['clinic_tests']['price_actual']; ?> - Offer Price: Rs. <?php  echo $testDetail['clinic_tests']['price_offer']; ?> </div> </li>
				 <?php } ?>
				 <?php  } else { ?><li><span><?php  echo $testDetail['tests']['test_name']; ?></span></li><?php } ?>                  
                 <?php
							$total_actual_price=$total_actual_price+$testDetail['clinic_tests']['price_actual'];  
							$total_offer_price=$total_offer_price+$testDetail['clinic_tests']['price_offer'];							 
				 //echo $total_actual_price."  ".$total_offer_price;
							if($total_actual_price!=0 && $total_offer_price!=0) 
							{
								$offer_percent=(($total_actual_price-$total_offer_price)/$total_actual_price)*100;
							}
							else
							{
								$offer_percent=0;
							}
						} 
				     }
					 $clinic_test_id_vals_strng = implode("_",$clinic_test_id_vals);
					 ?>
                  </ul>
                   <?php }
				  
				   ?>
                  <?php if(!empty($clinicTest['test_packages'])){ ?>
                      <h5>PACKAGE DETAILS</h5>
                      <ul class="test">
                      <?php
                      $total_actual_price=0;$total_offer_price=0; $offer_percent=0; $clinic_test_id_vals= array();
					  
							$total_actual_price=$total_actual_price+$clinicTest['test_packages']['price_actual'];
							$total_offer_price=$total_offer_price+$clinicTest['test_packages']['price_offer'];
							$offer_percent=(($total_actual_price-$total_offer_price)/$total_actual_price)*100;
					  
					   ?>	
					   <li> <span><?php  echo $clinicTest['test_packages']['package_name']; ?></span>
					 
					  </ul>
                  <?php }?>
                 <h5 class="border_top">WORKING HOURS</h5>  
                  <ul class="time"> 
                  <?php if(!empty($clinicTest['test_packages'])){ ?>
                  <li><span>MON - FRI</span>: <?php  echo $clinicTest['test_packages']['mon_fri']; ?></li>
                   <li><span>SATURDAY </span>: <?php  echo $clinicTest['test_packages']['saturday']; ?></li>
                   <li><span>SUNDAY</span>: <?php  echo $clinicTest['test_packages']['holidays']; ?></li>
                    <?php }else {?>
                     <li><span>MON - FRI</span>: <?php  echo $clinicTest['clinics']['mon_fri']; ?></li>
                   <li><span>SATURDAY </span>: <?php  echo $clinicTest['clinics']['saturday']; ?></li>
                   <li><span>SUNDAY</span>: <?php  echo $clinicTest['clinics']['holidays']; ?></li>
                  <?php }?>                   
                  
                  </ul>
                  <?php if(!empty($clinicTest['clinics']['home_collection_radius'])){ ?>
                   <div class="address"><span><font color="#FF0000">*</font>HOME COLLECTION RADIUS</span>: <?php  echo $clinicTest['clinics']['home_collection_radius']; ?> </div>

                 <?php } ?>
                  <div class="price_block">PRICE: Rs.<?php echo $total_actual_price; ?>  
				  <?php 
				 
				  if($total_offer_price < $total_actual_price){  ?>
				  <span class="off"><?php echo ceil($offer_percent) ;?>% OFF</span>  YOU PAY: <span class="rupee">Rs.</span>
				  <span class="amount"><?php echo $total_offer_price; ?>  </span>
				  <?php  } ?>
				  </div>
                  <!--<h5 class="border_top">CLINIC DETAILS</h5>  
                   <ul class="time"> 
                   <li><span>Home Collection</span>: <?php// if($clinicTest['clinics']['home_collection']==1) echo "YES"; else echo "NO"; ?></li>
                   <li><span>Credit Card</span>: <?php// if($clinicTest['clinics']['credit_card']==1) echo "YES"; else echo "NO"; ?></li>
                   <li><span>Parking</span>: <?php// if($clinicTest['clinics']['parking']==1) echo "YES"; else echo "NO"; ?></li>
                  
                  </ul>-->
                 
                  <p class="terms">Please read the <a  class="fancybox" href="javascript:void(0)" id="termsModalLink" >Terms & Conditions</a> carefully.</p>
                  <div class="quickbook_btn">
                   <?php if(!empty($clinicTest['test_packages'])){ ?>
                   <form action="booking/index" method="post" >
                      <input type="hidden" value="<?php echo $clinicTest['test_packages']['id'];?>" name="pacakge_id" />
                      <a href="javascript:void(0)" onclick="javascript:submitform(this);" >Select</a>                      
                     </form> 
                     
                     <?php }else {?>
                  <form action="booking/index" method="post" >
                  <input type="hidden" value="<?php echo $clinic_test_id_vals_strng;?>" name="clinic_test_id_vals" />
                  <a href="javascript:void(0)" onclick="javascript:submitform(this);" >Select</a>
                  
                  </form>   <?php }?>                
                  </div>
                  <?php if(!empty($clinicTest['test_packages'])){ ?>
                   <div class="quickbook_btn_view">
                  		<a href="detail/index/<?php echo $this->General->enCrypt($clinicTest['test_packages']['id']); ?>" >View Details</a>
                   </div>
                   <?php }?>
                </div>
                </div>
            </div>
          </div>
				<?php } else {
					
					
				}
				} else{
					//PACKAGE 
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
					
				//echo "<pre>"; print_r($clinicTest);
				//foreach($clinicTest['test_packages']  as $testDetail){
					//$actualPrice = $testDetail['clinic_tests']['price_actual'];
					$actualPrice = $clinicTest['test_packages']['price_actual']; 
					//echo $actualPrice;
				//}
				if($actualPrice>0) {
				?>
          <div class="row clearfix search_result_block">
		  
            <div class="col-md-2 left_col ">
              <?php if($clinicTest['clinics']['logo']!=''){ ?>
        <img src="<?php echo $logo_file;?>" width="77" height="77" alt="<?php  echo $clinicTest['clinics']['clinic_name']." - ".$clinicTest['areas']['area_name']; ?>">
        <?php }else {?>
         <img src="img/default_clinic.png" width="77" height="77">
         <?php }?>
             <!-- <div class="photos"><a href="#">PHOTOS</a></div>-->
            </div>
            <div class="col-md-10 right_col">
			
              <div class="row clearfix ">
                <div class="col-md-10 reset_left_padding">
                  <h2><?php  echo $clinicTest['clinics']['clinic_name']." - ".$clinicTest['areas']['area_name']; ?></h2>
                  <p class="address"><?php  echo $clinicTest['clinics']['address_line1']; ?>, <?php  echo $clinicTest['clinics']['address_line2']; ?>, <?php  echo $clinicTest['clinics']['address_line3']; ?>, Bangalore - <?php  echo $clinicTest['clinics']['postcode']; ?>
                  
                   <br /><a href="http://maps.google.com/?q=<?php echo $clinicTest['clinics']['latitude'];?>,<?php echo $clinicTest['clinics']['longitude'];?>" target="_blank" ><img src='img/distanceimg.png' width='12px' style='margin-top: -9px;' />&nbsp;<?php echo $drivingDistance; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View Map</a>
                  </p>
                </div>
                <div class="col-md-2 review">
                <p><!--<img src="img/rating_active.png" width="17" height="16"> <img src="img/rating_active.png" width="17" height="16"> <img src="img/rating_active.png" width="17" height="16"><img src="img/rating.png" width="17" height="16"> <img src="img/rating.png" width="17" height="16">-->
                <?php echo $this->General->fetchStarRating($clinicTest['clinics']['rating']); ?>
                </p>
                 <?php if(!empty($clinicTest['clinics']['admin_reviews'])){ ?>   
                 <?php  $review_main= explode("$$",$clinicTest['clinics']['admin_reviews']);
				 $string_review="";	
				 	foreach($review_main as $string_rvw){	
					 	$review= explode(":",$string_rvw);			 
				  		$name=ucfirst($review[0]); $text=$review[1];
				 		$string_review.="<b><i>".$name."</i></b> :".$text."<br/>";
					}
				  ?>              
                  <p><a href="javascript:writeReviewContent('<?php echo $string_review;?>');" class="link_Review">READ REVIEWS</a></p>                  
                                     
                  <?php } ?>
                </div>
              </div>
                <div class="row clearfix ">
                <div class="col-md-12  reset_left_padding">
                
                  <?php if(!empty($clinicTest['test_packages'])){ ?>
                      <h5>PACKAGE DETAILS</h5>
                      <ul class="test">
                      <?php 
                      $total_actual_price=0;$total_offer_price=0; $offer_percent=0; $clinic_test_id_vals= array();
					  
							$total_actual_price=$total_actual_price+$clinicTest['test_packages']['price_actual'];
							$total_offer_price=$total_offer_price+$clinicTest['test_packages']['price_offer'];
							$offer_percent=(($total_actual_price-$total_offer_price)/$total_actual_price)*100;
					  
					   ?>	
					   <li> <span><?php  echo $clinicTest['test_packages']['package_name']; ?></span><?php echo "<strong>Tests</strong> : ".$clinicTest['test_packages']['tests_included']; ?>
					 
					  </ul>
                  <?php }?>
                 <h5 class="border_top">WORKING HOURS</h5>  
                  <ul class="time"> 
                  <?php if(!empty($clinicTest['test_packages'])){ ?>
                  <li><span>MON - FRI</span>: <?php  echo $clinicTest['test_packages']['mon_fri']; ?></li>
                   <li><span>SATURDAY </span>: <?php  echo $clinicTest['test_packages']['saturday']; ?></li>
                   <li><span>SUNDAY</span>: <?php  echo $clinicTest['test_packages']['holidays']; ?></li>
                    <?php }else {?>
                     <li><span>MON - FRI</span>: <?php  echo $clinicTest['clinics']['mon_fri']; ?></li>
                   <li><span>SATURDAY </span>: <?php  echo $clinicTest['clinics']['saturday']; ?></li>
                   <li><span>SUNDAY</span>: <?php  echo $clinicTest['clinics']['holidays']; ?></li>
                  <?php }?>                   
                  
                  </ul>
                  <?php if(!empty($clinicTest['clinics']['home_collection_radius'])){ ?>
                   <div class="address"><span><font color="#FF0000">*</font>HOME COLLECTION RADIUS</span>: <?php  echo $clinicTest['clinics']['home_collection_radius']; ?> </div>

                 <?php } ?>
                  <div class="price_block">PRICE: Rs.<?php echo $total_actual_price; ?>  
				  <?php 
				 
				  if($total_offer_price < $total_actual_price){  ?>
				  <span class="off"><?php echo ceil($offer_percent) ;?>% OFF</span>  YOU PAY: <span class="rupee">Rs.</span>
				  <span class="amount"><?php echo $total_offer_price; ?>  </span>
				  <?php  } ?>
				  </div>
                  <p class="terms">Please read the <a  class="fancybox" href="javascript:void(0)" id="termsModalLink" >Terms & Conditions</a> carefully.</p>
                  <div class="quickbook_btn">
                   <?php if(!empty($clinicTest['test_packages'])){ ?>
                   <form action="booking/index" method="post" >
                      <input type="hidden" value="<?php echo $clinicTest['test_packages']['id'];?>" name="pacakge_id" />
                      <a href="javascript:void(0)" onclick="javascript:submitform(this);" >Select</a>                      
                     </form> 
                     
                     <?php }else {?>
                  <form action="booking/index" method="post" >
                  <input type="hidden" value="<?php echo $clinic_test_id_vals_strng;?>" name="clinic_test_id_vals" />
                  <a href="javascript:void(0)" onclick="javascript:submitform(this);" >Select</a>
                  
                  </form>   <?php }?>                
                  </div>
                  <?php if(!empty($clinicTest['test_packages'])){ ?>
                   <div class="quickbook_btn_view">
                  		<a href="detail/index/<?php echo $this->General->enCrypt($clinicTest['test_packages']['id']); ?>" >View Details</a>
                   </div>
                   <?php }?>
                </div>
                </div>
            </div>
          </div>
				<?php } else {
					
					
				}
				
					
					
				} ?>
        </div>
      </div>     
      
      <!--  Search result Block row end --> 
<script language="javascript">
	
	function submitform( id){		
		var formid=$(id).closest("form");
		formid.submit();
	}
	

</script>
<?php
		}
	
}else{
	
	echo "vpb_is_finished";
}
	  ?>

      