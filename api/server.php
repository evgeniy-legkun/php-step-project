<?php

// global variables
define('ROOT', dirname(__FILE__));

// global files
require_once(ROOT . '/components/Autoload.php');
require_once (ROOT . '/config.php');

if ($globalConfiguration['isProd'] === 'false') {
    header('Access-Control-Allow-Origin: http://localhost:8080');
}

$db = Connection::get();

include_once(ROOT . '/endpoints/get.php');
include_once (ROOT . '/endpoints/post.php');
include_once(ROOT . '/endpoints/put.php');
include_once(ROOT . '/endpoints/delete.php');