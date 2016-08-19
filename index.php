
<?php

define('DS', DIRECTORY_SEPARATOR);


//ini_set('display errors', 1);
//error_reporting(E_ALL);

session_start();

define('ROOT', dirname(__FILE__));
require_once (ROOT.'/component/Autoload.php');


$router = new Router();
$router->run();




