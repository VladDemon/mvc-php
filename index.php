<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include $_SERVER['DOCUMENT_ROOT']. "/config.php";
require __DIR__ . '/vendor/autoload.php';
require __DIR__ .'/router/routes.php';
