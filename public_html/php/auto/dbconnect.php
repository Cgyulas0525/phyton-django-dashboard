<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

define('DB_SERVER', 'localhost');
define('DB_USER', 'priestag_gyula');
define('DB_PASS', 'L0lk4B0lk4');
define('DB_NAME', 'priestag_pauto');
$conn = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);


?>