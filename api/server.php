<?php

require_once ('config.php');

if ($globalConfiguration['isProd'] === 'false') {
    header('Access-Control-Allow-Origin: http://localhost:8080');
}

include_once ('connect.php');

// TODO add connect to database via separated file

// TODO add get responses

// TODO add post responses

// TODO add put responses

// TODO add delete responses