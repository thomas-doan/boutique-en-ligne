<?php

namespace App\Controllers;


use App\Models\Articles;


class shoppingCartController extends Controller
{

    public function index()
    {

        $model = new Articles($this->getDB());
        $articles = $model->findAll();
        $title = "panier";
        return $this->view('shop.panier', compact('articles', 'title'));
    }

    public function shoppingBag()
    {
        if (isset($_POST['add'])) {
            if (isset($_SESSION['test'])) {
                $id_article = $_POST['id_article'];
                $_SESSION['quantite']["$id_article"] = 1;
            } else {
                $_SESSION['quantite'] = [];
                $id_article = $_POST['id_article'];
                $_SESSION['quantite']["$id_article"] = 1;
            }
            header('location: ./panier');
        }
    }


    public function upValue()
    {
        if (isset($_POST['upQuantity'])) {

            $up = (int) $_POST['upQuantity'];

            $_SESSION['quantite'][$_POST['id_article']] = $_SESSION['quantite'][$_POST['id_article']] + $up;

            header('location: ./panier');
        }
    }

    public function downValue()
    {
        if (isset($_POST['downQuantity'])) {

            $down = (int) $_POST['downQuantity'];

            $_SESSION['quantite'][$_POST['id_article']] = $_SESSION['quantite'][$_POST['id_article']] - $down;

            header('location: ./panier');
        }
    }
}
