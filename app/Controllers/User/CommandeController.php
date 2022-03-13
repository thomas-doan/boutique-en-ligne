<?php

namespace App\Controllers\User;

use App\Controllers\Controller;

use App\Models\Commandes;

class CommandeController extends Controller
{
    protected $model;

    public function index($id_commande)
    {
        $title = "Commande";
        $idCommande = $id_commande;
        $order = $this->getOrderInfo($idCommande);

        var_dump($_SESSION);
        if($order['fk_id_utilisateurs']!==$_SESSION['user']['id_utilisateur'])
        {
            $_SESSION['flash']='Ce numero de commande ne correspond à aucune de vos commandes';
            $order = null;
        }
        var_dump($order);


        // $allInfoById = $this->getCommandeById($idCommande);
        return $this->view('profil.commande', compact('title', 'order'));
    }

    public function getOrderInfo($id_commande)
    {
        $model = new Commandes();
        $commande = $model->getInfoCommande($id_commande);
        return $commande;
    }

    // public function getCommandeById($id_commande)
    // {
    //     $model = new Commandes();
    //     $criteres = ['id_commande'];
    //     $adress = $model->find($criteres, compact('id_commande'));
    //     return $adress;
    // }
}
