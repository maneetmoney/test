<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'buoyance');    // DB username
define('DB_PASSWORD', 'K7y00bhx8V');    // DB password
define('DB_DATABASE', 'buoyance_lifematri');      // DB name
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die( "Unable to connect");
$database = mysql_select_db(DB_DATABASE) or die( "Unable to select database");
?>