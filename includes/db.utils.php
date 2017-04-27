<?php

$link = false;

if(ENVIRONMENT === 'PRODUCTION') {

    define('DB_HOST', 'host');
    define('DB_USER', 'user');
    define('DB_PASS', 'pass');
    define('DB_DATABASE', 'database');

    if(function_exists('mysql_connect')) { // PHP 5.6 or lower
        // connect to MySQL
        $con = mysql_connect(DB_HOST, DB_USER, DB_PASS);
        if (!$con) die('Could not connect: ' . mysql_error());

        // select DB_DATABASE
        $link = mysql_select_DB_DATABASE(DB_DATABASE, $con);
        if (!$link) die ('Can\'t select DB_DATABASE "'.DB_DATABASE.'": ' . mysql_error());
    } else { // PHP 7.0 or higher
        // connect to MySQL and select DB_DATABASE
        $link = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_DATABASE);
        if (!$link) die('OUCH! Unable to connect to MySQL.<br><br>errno: ' . mysqli_connect_errno() . '<br> error: ' . mysqli_connect_error());
    }

}

$performQuery = function($query) use ($link) {
    if(function_exists('mysql_connect')) { // PHP 5.6 or lower
        $result = mysql_fetch_assoc(mysql_query($query));
    } else { // PHP 7.0 or higher
        $result = mysqli_fetch_assoc(mysqli_query($link, $query));
    }
    return $result;
};
