<?php

use App\Autoloader;
use App\Core\Main;

// On définit une constante contenant la racine du projet
define('ROOT', dirname(__DIR__));

// On imoporte l'Autoloader
require_once ROOT . '/Autoloader.php';
Autoloader::register();

// On instancie notre router (Main = router)
$app = new Main();

// On démarre l'application
$app->start();
