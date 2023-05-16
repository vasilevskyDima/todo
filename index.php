<?php

use system\Start;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "./system/Start.php";

$start = new Start();
$start->loadClass();
$start->start();
