<?php

namespace App\Controllers;

abstract class Controller
{
    public function render(string $fichier, array $donnees = [])
    {
        // On extrait le contenu de $donnees
        extract($donnees);

        ob_start();
        // require('public/templates/' . $path . '.php');
        require_once ROOT . '/Views/' . $fichier . '.php';
        $pageContent = ob_get_clean();
        // On créer le chemin vers la vue 
        
        require('../Views/template/layout.html.php');
    }

    public static function secureHTML($chaine)
    {
        //première protection  contre injection sql.
        $resultat  = strip_tags($chaine);
        $resultat = htmlentities($resultat);
        $resultat = htmlspecialchars($resultat);

        return $resultat;
    }

}
