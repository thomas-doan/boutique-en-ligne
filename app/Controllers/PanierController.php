<?php

namespace App\Controllers;


use App\Models\Articles;


class PanierController extends Controller
{

    public function index()
    {

        $model = new Articles($this->getDB());
        $articles = $model->findAll();
        $title = "panier";
        return $this->view('shop.panier', compact('articles', 'title'));
    }


    public function augmenter()
    {

        if (isset($_POST['augmenter'])) {

            $augmenter = (int) $_POST['augmenter'];


            $_SESSION['quantite'][$_POST['id_article']] = $_SESSION['quantite'][$_POST['id_article']] + $_POST['augmenter'];

            header('location : ./panier');
        }
    }

    public function change_valeur()
    {

        if (isset($_POST['diminuer'])) {

            $diminuer = (int) $_POST['diminuer'];

            $_SESSION['quantite'][$_POST['id_article']] = $_SESSION['quantite'][$_POST['id_article']] - $diminuer;

            header('location: ./panier');
        }

        if (isset($_POST['augmenter'])) {

            $augmenter = (int) $_POST['augmenter'];


            $_SESSION['quantite'][$_POST['id_article']] = $_SESSION['quantite'][$_POST['id_article']] + $augmenter;

            header('location: ./panier');
        }
    }
}
