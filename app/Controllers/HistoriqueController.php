<?php

namespace App\Controllers;

use PDO;
use App\Models\NumCommande;

class HistoriqueController extends Controller
{


    public function index()
    {
        $title = "Historique de commande";
        $orders = $this->getOrder();

        echo "<pre>";
        var_dump($orders);
        echo "</pre>";

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
