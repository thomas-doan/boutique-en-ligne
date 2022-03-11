<?php


namespace App\Controllers;


use App\Models\Articles;
use App\Models\Utilisateurs;


class OrderController extends Controller
{

    public function __construct()
    {
        $this->model = new Utilisateurs();
        $this->modelArticle = new Articles();
    }


    public function index()
    {
        $id = $_SESSION['id_utilisateur'];
        $info_user = $this->getUser($id);
        $orderCheck = $this->orderResume();
        $title = "Commande resumé - Kawa";

        return $this->view('shop.order', compact('title', 'info_user', 'orderCheck'));
    }

    public function getUser($id)
    {
        $id_utilisateur = $id;

        $argument = ['id_utilisateur'];
        $resultat = $this->model->find($argument, compact('id_utilisateur'));


        return $resultat;
    }


    public function orderResume()
    {
        $checkQuantity = [];

        $argument = ['id_article'];
        foreach ($_SESSION['quantite'] as $id_article => $value) {
            $checkQuantity[$id_article] = $this->modelArticle->find($argument, compact('id_article'));
            /*        foreach ($_SESSION['quantite'] as $key2 => $value2) {
            } */
        }

        return $checkQuantity;
    }


    public function validate()
    {
        if (isset($_POST['submit'])) {
            header('location: ./livraison');
        }
    }
}
