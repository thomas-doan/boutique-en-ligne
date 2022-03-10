<?php


namespace App\Controllers;


use App\Models\Articles;


class shoppingCartController extends Controller
{

    public function __construct()
    {

        $this->modelArticle = new Articles();
    }

    public function index()
    {

        $articles = $this->getArticles();
        echo "<pre>";
        var_dump($articles);
        echo "</pre>";
        /*     die; */
        $title = "panier";
        return $this->view('shop.panier', compact('articles', 'title'));
    }


    public function getArticles()
    {
        /* $resultat = []; */
        $articles = $this->modelArticle->findAll();
        /*        $i = 0;
        foreach ($articles as $id1 => $article) {

            foreach ($_SESSION['panier'] as $id2 => $value) {

                if ($id2 == $id1) {
                    $resultat[$i++] = $article[$id1];
                }
            }
        } */

        return $articles;
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
