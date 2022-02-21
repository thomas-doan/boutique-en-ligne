<?php

namespace App\Core;

//Import PDO et PDOException
use PDO;
use PDOException;


class Db extends PDO
{
    // Instance unique de la classe
    private static $instance;

    // Information de connexion 
    private const DBHOST = 'localhost';
    private const DBUSER = 'root';
    private const DBPASS = '';
    private const DBNAME = 'kawa';

    // Design Pattern Singleton - Un constructeur privé que l'on ne peut instancier.
    private function __construct()
    {
        //DSN de connexion
        $dsn = 'mysql:dbname=' . self::DBNAME . ';host=' . self::DBHOST;

        try {
            // On appelle le constructeur de la classe PDO
            parent::__construct($dsn, self::DBUSER, self::DBPASS);

            // $this represente PDO
            $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    // Methode static qui permet de générer une instance si elle n'existe pas ou de réccupérer l'instance actuelle si il y en déjà une.
    public static function getInstance(): PDO
    {
        if (self::$instance == null) {
            self::$instance = new Db();
        }
        return self::$instance;
    }
}
