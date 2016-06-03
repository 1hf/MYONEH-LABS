<?php
class GeneralHelper extends AppHelper {
	
	//this function is for fetching star rating according to the clinic rating value coming from view.
	function fetchStarRating($value){
		$star_active='';$star_inactive='';
		for($i=0; $i<5; $i++){
			if($i<$value)
			$star_active.='<img src="img/rating_active.png" width="17" height="16">';
			else
			$star_inactive.='<img src="img/rating.png" width="17" height="16">';
		}		
		return $final_rating=$star_active.$star_inactive;
	} //function fetchStarRating() ends here
	
	//this function is for fetching star rating according to the clinic rating value coming from view.
	function fetchStarRatingInside($value){
		$star_active='';$star_inactive='';
		for($i=0; $i<5; $i++){
			if($i<$value)
			$star_active.='<img src="../../img/rating_active.png" width="17" height="16">';
			else
			$star_inactive.='<img src="../../img/rating.png" width="17" height="16">';
		}		
		return $final_rating=$star_active.$star_inactive;
	} //function fetchStarRating() ends here
        
    function enCrypt($string) {
		$level_one = base64_encode($string);
		$cipher = urlencode($level_one);
		return $cipher;
	}

	function deCrypt($string) {
		$level_one = urldecode($string);
		$plainText = base64_decode($level_one);

		return $plainText;
	}
}


?>