<?php

namespace App\Controllers;

use App\Models\AnnoncesModel;

class AnnoncesController extends Controller
{
    public function index()
    {
        //On instancie le modele correspondant à la table 'annonces'
        $annoncesModel = new AnnoncesModel;

        // On va chercher les annonces selon la methode
        $annonces = $annoncesModel->findBy(['actif' => 1]);

        // On génére la vue
        $this->render('annonces/index', compact('annonces'));
    }

    public function lire(int $id)
    {
        // on inscancie le model
        $annoncesModel = new AnnoncesModel;

        // On va chercher une annonce
        $annonce = $annoncesModel->find($id);

        // On envoie à la vue
        $this->render('annonces/lire', compact('annonce'));
    }
}