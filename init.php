<?php
require_once(__DIR__ . '/includes/constriv.config.php');
require_once(__DIR__ . '/includes/db.utils.php');
require_once(__DIR__ . '/includes/helpers.php');

// set params for the request
$params = [
    // auth gateway params
    'id' 			=> TRANPORTAL_ID,
    'password' 		=> TRANPORTAL_PWD,

    // default config params
    'action' 		=> DEFAULT_ACTION,
    'currencycode' 	=> DEFAULT_CURRENCY_CODE,
    'langid' 		=> DEFAULT_LANG_ID,
    'responseURL' 	=> INIT_URL_BACK_SUCCESS,
    'errorURL' 		=> INIT_URL_BACK_ERROR,

    // query params
    'amt' 			=> fetchQueryParam('amt'),
    'trackid' 		=> fetchQueryParam('trackid'),
    'udf2'          => fetchQueryParam('lan'),
    'udf3'          => fetchQueryParam('email')
];

// build http query by request params
$query = http_build_query($params);

// open cURL connection to the service
$request = curl_init(SERVICE_URL);

// set header and cURL options
curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($request, CURLOPT_POST, 1);
curl_setopt($request, CURLOPT_POSTFIELDS, $query);
curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);

// execute cURL request to the service
$response = curl_exec($request);

// close cURL connection
curl_close($request);

// fetch response params or catch error
$redirect = function ($response) use ($query) {
    // catch for errors
    if (strpos($response, '!ERROR!') !== FALSE) {
        throw new Exception("WOOPS! Something went wrong.<br><br>RECEIVED: <b>$response</b> <br><br>REQUEST<br><b>URL</b><br>". SERVICE_URL ."<br><b>data</b><br> $query");
    }

    // get data from cURL response
    $segments    = explode(':', $response);
    $paymentID   = $segments[0];
    $url         = implode(':', array_slice($segments,1));

    // generate redirect URL
    $redirect = "$url?PaymentID=$paymentID";

    // perform the redirect to the payment page
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=$redirect\">";
};

// perform redirect or throw the response error
try {
    $redirect($response);
} catch(Exception $e) {
    echo $e->getMessage();
}
