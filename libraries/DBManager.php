<?php

class DBManager
{
    //function pour se connecter à sql

    public static $pdo;
    public static function dbConnect()
    {
        if (!self::$pdo) {
            self::$pdo = new PDO('mysql:host=localhost;dbname=phpopcproject;charset=utf8', 'root', '');
        }
        return self::$pdo;
    }
}
