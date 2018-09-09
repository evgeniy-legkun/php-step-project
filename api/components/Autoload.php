<?php

spl_autoload_register(function ($className) {
    $arrayPaths = [
        '/'
    ];

    foreach ($arrayPaths as $path) {
        $currentPath = ROOT . $path . $className . '.php';

        if (is_file($currentPath)) {
            include $currentPath;
        }
    }
});