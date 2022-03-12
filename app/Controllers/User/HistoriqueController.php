<?php

namespace App\Controllers\User;

use App\Controllers\Controller;

use PDO;
use App\Models\NumCommande;

class HistoriqueController extends Controller
{


    public function index()
    {
        $title = "Historique de commande";
        $orders = $this->getOrder();

        return $this->view('profil.historiqueCommande', compact('title', 'orders'));
    }

    public function getOrder()
    {
        $model = new NumCommande();
        $argument = ['fk_id_utilisateur'];
        $fk_id_utilisateur = $_SESSION['user']['id_utilisateur'];
        $order = $model->getAllOrderbyIdUser($fk_id_utilisateur);
        return $order;
    }
}
