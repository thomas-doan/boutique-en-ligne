<?php

namespace Controllers;


use Models\Http;
use Models\Renderer;
use Controllers\Controllers;

class Panier extends Controllers
{

    protected $modelName = \Models\Panier::class;

    public function index()
    {
        $articles = $this->model->findArticle();
        $supertest = "lol";


        Renderer::render('index', compact('articles', 'supertest'));
    }


    public function augmenter()
    {

        if (isset($_POST['augmenter'])) {

            $augmenter = (int) $_POST['augmenter'];


            $_SESSION['quantite'][$_POST['id']] = $_SESSION['quantite'][$_POST['id']] + $_POST['augmenter'];

            Http::redirect("index");


            /*   $modif = $this->model->augmenterValeur($id, $augmenter);
            Http::redirect("profil"); */
        }
    }

    public function diminuer()
    {

        if (isset($_POST['diminuer'])) {

            $diminuer = (int) $_POST['diminuer'];

            $_SESSION['quantite'][$_POST['id']] = $_SESSION['quantite'][$_POST['id']] - $_POST['diminuer'];

            Http::redirect("index");
        }
    }
}
