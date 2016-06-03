<?php

class EncryptionComponent extends Component{

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
