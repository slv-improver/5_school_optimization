<?php

require '../config/dev.php';
require '../vendor/autoload.php';

session_start();

$router = new \App\src\Router();
// check $_GET['route]
$router->run();
