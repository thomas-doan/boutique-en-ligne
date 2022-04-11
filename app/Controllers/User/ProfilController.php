<?php

namespace App\Controllers\User;

use App\Models\Utilisateurs;

use App\Controllers\Controller;
use App\Controllers\User\AdresseController;

class ProfilController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->adresse = new AdresseController();
    }

    public function index()
    {
        $title = "Profil";
        if ($this->adresse->getAdress() == null) {
            $notifAdresse = "Vous n'avez pas encore renseigné d'adresses, cela pourrait vous facilité votre utilisation";
        } else $notifAdresse = null;
        return $this->view('profil.index', compact('title', 'notifAdresse'));
    }
}
