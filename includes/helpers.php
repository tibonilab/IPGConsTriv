<?php

/**
 * Returns SANDBOX constant values or real ones from $_GET if in PRODUCTION mode
 */
function fetchQueryParam($field) {
    // get data from request in PRODUCTION mode
    if(ENVIRONMENT === 'PRODUCTION') {
        return isset($_GET[$field]) ? $_GET[$field] : '';
    }

    // return dummy data or get data for SANDBOX mode purpose
    switch($field) {
        case 'amt':
        return isset($_GET['amt']) ? $_GET['amt'] : '100.00';

        case 'trackid':
        return isset($_GET['trackid']) ? $_GET['trackid'] :  'TEST_TRACK_ID';

        case 'lan':
        return isset($_GET['lan']) ? $_GET['lan'] :  'ITA';
    }
}
