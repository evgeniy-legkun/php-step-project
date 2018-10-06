<?php

spl_autoload_register(function ($className) {
    $arrayPaths = [
        '/',
        '/components/'
    ];

    foreach ($arrayPaths as $path) {
        $currentPath = ROOT . $path . $className . '.php';

        if (is_file($currentPath)) {
            include $currentPath;
        }
    }
});