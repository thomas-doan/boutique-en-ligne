<?php

namespace App\Controllers;

abstract class Controller
{
    public function render(string $fichier, array $donnees = [])
    {
        // On extrait le contenu de $donnees
        extract($donnees);

        // On créer le chemin vers la vue 
        require_once ROOT . '/Views/' . $fichier . '.php';
    }
}
