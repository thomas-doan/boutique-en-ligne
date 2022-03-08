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


    public function index($id)
    {

        $info_user = $this->getUser($id);
        $orderCheck = $this->orderResume();

        echo "<pre>";
        var_dump($orderCheck);
        echo "</pre>";
        $title = "Commande - Kawa";
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


    /*    public function totalPrice()
    {

        if (isset($_SESSION['quantite'])) {
            $_SESSION['totalPrice'] = [];

            $result = 0;
            foreach ($_SESSION['quantite'] as $key1 => $value1) {
                foreach ($_SESSION['prix'] as $key2 => $value2) {
                    if ($key1 == $key2) {

                        $resultSinglePrice = $value1 * $value2;
                        $result += $resultSinglePrice;

                        $_SESSION['totalPrice'] = $result;
                    }
                }
            }
        }
    } */
}
