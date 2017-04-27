<?php

// simulate production environment
define('ENVIRONMENT', 'PRODUCTION');

// perform db connection into db utils
include('../includes/db.utils.php');

// if an error occurs in connection a die() is called into db.utils.php
// and next lines of code won't be performed
echo 'MySQL IS CONNECTED!';

echo '<br><br>Test query result: ' . $testQuery();
