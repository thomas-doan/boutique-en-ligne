<?php

namespace App\Controllers;

use PDO;
use App\Models\Commandes;

class HistoriqueController extends Controller
{
    protected $model;

    public function index()
    {
        $title = "Historique de commande";
        $orders = $this->getOrder();
        return $this->view('profil.historiqueCommande', compact('title', 'orders'));
    }

    public function getOrder()
    {
        $model = new Commandes();
        $argument = ['fk_id_utilisateur'];
        $fk_id_utilisateur = $_SESSION['id_utilisateur'];
        $order = $model->find($argument, compact('fk_id_utilisateur'));
        return $order;
    }
}
