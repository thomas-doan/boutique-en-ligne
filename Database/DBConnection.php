<?php

namespace Database;

use PDO;

class DBConnection
{


    public  static function getPDO(): PDO
    {
        $pdo = new PDO('mysql:host=localhost;dbname=kawa;charset=utf8', 'root', 'azerty', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER SET UTF8'
        ]);
        return $pdo;
    }
}