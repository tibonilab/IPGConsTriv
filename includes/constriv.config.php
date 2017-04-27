<?php

define('HOST', 'http://localhost');

// automagic method to set SANDBOX or PRODUCTION environment in base of path request
if(strpos(pathinfo( $_SERVER['REQUEST_URI'], PATHINFO_DIRNAME ), 'sandbox') !== false) {
    define('ENVIRONMENT', 'SANDBOX');
} else {
    define('ENVIRONMENT', 'PRODUCTION');
}

// default gateway params
define('DEFAULT_ACTION', '4');
define('DEFAULT_CURRENCY_CODE', '978');
define('DEFAULT_LANG_ID', 'USA');

if(ENVIRONMENT === 'SANDBOX') {
    // SANDBOX TEST ENVIRONMENT GATEWAY PARAMS
    define('TRANPORTAL_ID', '89023333');
    define('TRANPORTAL_PWD', 'test');
    define('SERVICE_URL', 'https://ipg-test4.constriv.com/IPGWeb/servlet/PaymentInitHTTPServlet');
    define('INIT_URL_BACK_SUCCESS', HOST . '/sandbox/catcher.php');
    define('INIT_URL_BACK_ERROR', HOST . '/tests/response-failed.php');
    define('RECEIPT_URL_BACK_SUCCESS', HOST . '/tests/response-success.php');
    define('RECEIPT_URL_BACK_ERROR', INIT_URL_BACK_ERROR);

} else {
    // PRODUCTION ENVIRONMENT GATEWAY PARAMS
    require_once(__DIR__ . '/../config.php'); //
    define('SERVICE_URL', 'https://ipg.constriv.com/IPGWeb/servlet/PaymentInitHTTPServlet');
    define('INIT_URL_BACK_SUCCESS', HOST . '/gateway/catcher.php');
    define('INIT_URL_BACK_ERROR', HOST . '/ko/');
    define('RECEIPT_URL_BACK_SUCCESS', HOST . '/thank-you-for-your-purchase/');
    define('RECEIPT_URL_BACK_ERROR', INIT_URL_BACK_ERROR);

}
