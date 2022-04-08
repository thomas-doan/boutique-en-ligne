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
        $argument = ['fk_id_utilisateurs'];
        $fk_id_utilisateurs = $_SESSION['user']['id_utilisateur'];
        $order = $model->find($argument, compact('fk_id_utilisateurs'));
        return $order;
    }
}
