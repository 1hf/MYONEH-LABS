<?php
/*

- Use PAYTM_ENVIRONMENT as 'PROD' if you wanted to do transaction in production environment else 'TEST' for doing transaction in testing environment.
- Change the value of PAYTM_MERCHANT_KEY constant with details received from Paytm.
- Change the value of PAYTM_MERCHANT_MID constant with details received from Paytm.
- Change the value of PAYTM_MERCHANT_WEBSITE constant with details received from Paytm.
- Above details will be different for testing and production environment.

*/
/* define('PAYTM_ENVIRONMENT', 'PROD'); // PROD
define('PAYTM_MERCHANT_KEY', '@X3Osl75y9X5puwj'); //Change this constant's value with Merchant key downloaded from portal
define('PAYTM_MERCHANT_MID', '1healt14190787954280'); //Change this constant's value with MID (Merchant ID) received from Paytm
define('PAYTM_MERCHANT_WEBSITE', 'OneHealthweb'); //Change this constant's value with Website name received from Paytm
define('CALLBACK_URL', '/booking/index'); //Change this constant's value with Website Callback URL */
define('PAYTM_ENVIRONMENT', 'TEST'); // PROD
define('PAYTM_MERCHANT_KEY', 'b#I1xVOKNlegj0DO'); //Change this constant's value with Merchant key downloaded from portal
define('PAYTM_MERCHANT_MID', 'QLSwqt44412599045603'); //Change this constant's value with MID (Merchant ID) received from Paytm
define('PAYTM_MERCHANT_WEBSITE', 'onehealth'); //Change this constant's value with Website name received from Paytm
define('CALLBACK_URL', 'http://localhost:90/paytmPHP/Paytm_Web_Sample_Kit_PHP/PaytmKit/pgResponse.php'); //Change this constant's value with Website Callback URL
$PAYTM_DOMAIN = "pguat.paytm.com";
if (PAYTM_ENVIRONMENT == 'PROD') {
	$PAYTM_DOMAIN = 'secure.paytm.in';
}

define('PAYTM_REFUND_URL', 'https://'.$PAYTM_DOMAIN.'/oltp/HANDLER_INTERNAL/REFUND');
define('PAYTM_STATUS_QUERY_URL', 'https://'.$PAYTM_DOMAIN.'/oltp/HANDLER_INTERNAL/TXNSTATUS');
define('PAYTM_TXN_URL', 'https://'.$PAYTM_DOMAIN.'/oltp-web/processTransaction');

?>