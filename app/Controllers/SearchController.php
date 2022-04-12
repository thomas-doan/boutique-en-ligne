<?php

namespace App\Controllers;

use App\Models\Search;

class SearchController extends Controller
{


    public function index()
    {

        $titre_article = $_GET['recherche'];


        $model = new Search($this->getDB());

        $resultat = $model->find_article($titre_article);

        $title = "Kawa - Search";

        /*   $this->view('shop.recherche', compact('resultat')); */

        return $this->view('shop.search', compact('title', 'resultat'));
    }
}
