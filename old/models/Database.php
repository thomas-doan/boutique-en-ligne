<?php

namespace Models;



use PDO;

class Database
{

    public  static function getPdo(): PDO
    {
        $pdo = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', 'azerty', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        return $pdo;
    }
}
