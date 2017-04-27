<?php

echo 'TRANSACTION SUCCEEDED!<br><br>';

if(count($_GET)) {
    echo '<b>Response data<br></b>';

    foreach($_GET as $key => $value) {
        echo $key . ': ' . urldecode($value) . '<br>';
    }
}
