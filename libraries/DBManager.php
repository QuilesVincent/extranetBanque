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
/*
if (!self::$pdo) {
    self::$pdo = new PDO('mysql:host=localhost;dbname=phpopcproject;charset=utf-8', 'root','', [
        PDO:: ATTR_DEFAULT_FETCH_MODE => PDO:: FETCH_ASSOC,
        PDO:: ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION
    ]);
}
return self::$pdo;

*/