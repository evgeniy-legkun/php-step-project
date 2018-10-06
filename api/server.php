<?php

if(!isset($_SESSION)){
    session_start();
}

if (!isset($_SESSION['count'])) {
    $_SESSION['count'] = 0;
} else {
    $_SESSION['count']++;
}

// global variables
define('ROOT', dirname(__FILE__));

// global files
include_once(ROOT . '/components/Autoload.php');
include_once (ROOT . '/config.php');

header('Content-Type: application/json');
if ($globalConfiguration['isProd'] === 'false') {
    header('Access-Control-Allow-Origin: http://localhost:8080');
    header('Access-Control-Allow-Headers: Content-Type');
}

$db = Connection::get();

include_once(ROOT . '/endpoints/get.php');
include_once (ROOT . '/endpoints/post.php');
include_once(ROOT . '/endpoints/put.php');
include_once(ROOT . '/endpoints/delete.php');