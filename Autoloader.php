<?php
// _CLASS_ contient la classe que l'on cherche à charger
//_NAMESPACE_ contient le namespace actuel

namespace App;

class Autoloader
{
    // Une Methode static est accessible sans avoir besoin d'instancier la classe
    static function register()
    {
        spl_autoload_register([
            // Constante _CLASS_  permet d'aller chercher la classe actuelle
            __CLASS__,
            'autoload'
        ]);
    }

    static function autoload($class)
    {
        // On récupère dans $class la totalité du namespace de la classe concernée (App\client/Compte.php).
        // On retire App\ (Client\Compte)
        $class = str_replace(__NAMESPACE__ . '\\', '', $class);

        // On remplace les \ par des /
        $class = str_replace('\\', '/', $class);

        // On vérifie si le fichier existe
        $fichier =  __DIR__ . '/' . $class . '.php';
        if (file_exists($fichier)) {

            // Si le fichier existe, on récupère le repertoire du fichier courant au quel on ajoute un /, la classe et .php
            require_once  __DIR__ . '/' . $class . '.php';
        }
    }
}
