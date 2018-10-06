<?php

class Connection {
    public static function get ()
    {
        $dbParams = include (ROOT . '/config/db_config.php');

        $dsn = "mysql:host={$dbParams['host']};"
            ."port=3306;"
            ."dbname={$dbParams['dbname']}";

        try {
            $db = new PDO($dsn, $dbParams['user'], $dbParams['password']);
            $db->exec("set names utf8");
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        return $db;
    }
}