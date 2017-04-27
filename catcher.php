<?php
require_once(__DIR__ . '/includes/constriv.config.php');
require_once(__DIR__ . '/includes/helpers.php');

// response POST keys
$postKeys = [
    'paymentid',
    'tranid',
    'result',
    'auth',
    'postdate',
    'trackid',
    'udf1',
    'udf2',
    'udf3',
    'udf4',
    'udf5',
    'ref',
    'cardtype',
    'payinst',
    'liability',
    'responsecode',
    'cardcountry',
    'ipcountry',
    'error',
    'errorText',
];

// hydrate response data
$responseData = [];
foreach($postKeys as $postKey) {
    if(isset($_POST[$postKey])) {
        $responseData[$postKey] = $_POST[$postKey];
    }
}

// respond in base of response data
if(isset($responseData['result']) && $responseData['result'] === 'APPROVED') {
    echo "REDIRECT=" . RECEIPT_URL_BACK_SUCCESS . "?" . http_build_query($responseData);
} else {
    echo "REDIRECT=" . RECEIPT_URL_BACK_ERROR;
}
