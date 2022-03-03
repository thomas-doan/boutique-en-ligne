<?php

namespace App\Controllers;

use App\Models\Articles;


class MainController extends Controller
{

    public function index()
    {
        $title = "accueil - kawa";

        $model = new Articles();
        $articles = $model->findAll();


        $titre_article = "toto";
        $prix_article = "2";
        $criteres = ["titre_article", "prix_article"];
        $specifique = ["titre_article", "presentation_article"];
        $jojo = $model->find($criteres, compact('titre_article', 'prix_article'), $specifique);



        return $this->view('shop.index', compact('title', 'articles', 'jojo'));
    }
}
