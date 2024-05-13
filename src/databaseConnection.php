<?php

class databaseConnection
{
    private static $instance = null;
    private static $connection;

    public static function getInstance() {
        if (is_null(self::$instance)){
            self::$instance = new DatabaseConnection();
        }

        return self::$instance;
    }

    public static function connect($host,$port, $dbName, $user, $password)
    {
        self::$connection = new PDO("mysql:dbname=$dbName;host=$host;port:$port", $user, $password);
    }


    public static function getConnection() {
        return self::$connection;
    }

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}