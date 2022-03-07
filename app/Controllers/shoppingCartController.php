<?php


namespace App\Controllers;


use App\Models\Articles;


class ShoppingCartController extends Controller
{

    public function index()
    {

        $model = new Articles();
        $articles = $model->findAll();
        $title = "panier";
        return $this->view('shop.panier', compact('articles', 'title'));
    }

    public function shoppingBag()
    {

        if (isset($_POST['add'])) {
            if (isset($_SESSION['quantite'])) {
                // assignation valeur
                $id_article =  (int) $_POST['id_article'];
                $prix_article =  (float) $_POST['prix_article'];

                $_SESSION['quantite'][$id_article] = 1;
                $_SESSION['prix'][$id_article] = $prix_article;
            } else {
                //init session
                $_SESSION['quantite'] = [];
                $_SESSION['prix'] = [];

                // assignation valeur

                $prix_article =  (float) $_POST['prix_article'];
                $id_article =  (int) $_POST['id_article'];
                $_SESSION['quantite'][$id_article] = 1;
                $_SESSION['prix'][$id_article] = $prix_article;
            }
            header('location: ./panier');
        }
    }


    public function upValue()
    {
        if (isset($_POST['upQuantity'])) {

            $up =  $_POST['upQuantity'];
            $id_article =  (int) $_POST['id_article'];

            $_SESSION['quantite'][$id_article] = $_SESSION['quantite'][$id_article] + $up;

            header('location: ./panier');
        }
    }

    public function downValue()
    {
        var_dump($_SESSION);
        if (isset($_POST['downQuantity'])) {

            $down =  $_POST['downQuantity'];
            $id_article =  (int) $_POST['id_article'];

            $_SESSION['quantite'][$id_article] = $_SESSION['quantite'][$id_article] - $down;

            header('location: ./panier');
        }
    }

    public function deleteProduct()
    {
        if (isset($_POST['deleteProduct'])) {
            unset($_SESSION['quantite'][(int) $_POST['id_article']]);
            unset($_SESSION['prix'][(int) $_POST['id_article']]);
            header('location: ./panier');
        }
    }


    public function singlePrice()
    {

        if (isset($_SESSION['quantite'])) {
            $_SESSION['singlePrice'] = [];

            $result = 0;
            foreach ($_SESSION['quantite'] as $key1 => $value1) {
                foreach ($_SESSION['prix'] as $key2 => $value2) {
                    if ($key1 == $key2) {

                        $result = $value1 * $value2;


                        $_SESSION['singlePrice'][$key1]  = $result;
                    }
                }
            }
        }
    }



    public function totalPrice()
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
    }
}
