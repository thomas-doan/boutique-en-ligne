<?php

namespace App\Controllers;


use App\Models\Articles;


class PanierController extends Controller
{

    public function index()
    {

        $model = new Articles($this->getDB());
        $articles = $model->findAll();
        return $this->view('shop.panier', compact('articles'));
    }


    public function augmenter()
    {

        if (isset($_POST['augmenter'])) {

            $augmenter = (int) $_POST['augmenter'];


            $_SESSION['quantite'][$_POST['id_article']] = $_SESSION['quantite'][$_POST['id_article']] + $_POST['augmenter'];
        }
    }

    public function diminuer()
    {

        if (isset($_POST['diminuer'])) {

            $diminuer = (int) $_POST['diminuer'];

            var_dump($_POST['diminuer']);


            $_SESSION['quantite'][$_POST['id_article']] = $_SESSION['quantite'][$_POST['id_article']] - $_POST['diminuer'];
        }
    }
}
