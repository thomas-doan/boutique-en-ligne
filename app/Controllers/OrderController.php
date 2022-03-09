<?php


namespace App\Controllers;


use App\Models\Articles;
use App\Models\Utilisateurs;
use App\Models\Adresses;


class OrderController extends Controller
{

    public function __construct()
    {


        $this->model = new Utilisateurs();
        $this->modelArticle = new Articles();
        $this->modelAdresses = new Adresses();
    }


    public function index()
    {
        $id = $_SESSION['id_utilisateur'];
        $info_user = $this->getUser($id);
        $orderCheck = $this->orderResume();
        $title = "Commande - Kawa";

        if ($this->adressCheck()) {
            $adress = $this->adressCheck();
            return $this->view('shop.order', compact('title', 'info_user', 'orderCheck', 'adress'));
        } else {
            return $this->view('shop.order', compact('title', 'info_user', 'orderCheck'));
        };
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


    public function adressCheck()
    {

        $fk_id_utilisateur = $_SESSION['id_utilisateur'];
        $argument = ['fk_id_utilisateur'];
        $adresse = $this->modelAdresses->find($argument, compact('fk_id_utilisateur'));
        /* 
        echo "<pre>";
        var_dump($adresse);
        echo "</pre>";

        die(); */
        foreach ($adresse as $key => $value) {
            $resultat[$value['id_adresse']] = $value;
        }

        return $resultat;
    }

    public function getAdress()
    {

        if (isset($_POST['id_adresse'])) {
            $_SESSION['select_adress'] = $_POST['id_adresse'];

            header("location: ./");
        }
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
