<?php
define('BASE_DIR', __DIR__);

session_start();

require BASE_DIR.'/config/autoload.php';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

$factory = new Perseos();
$factory->run();
$factory->write();
