<?php

namespace App\Controllers;

use App\Models\ExempleModel;

class ExempleController extends Controller
{


    public function index()
    {
        $titre_article = $_GET['recherche'];


        $model = new ExempleModel($this->getDB());

        $resultat = $model->find_article($titre_article);

        $title = "test vue 2";

        /*   $this->view('shop.recherche', compact('resultat')); */

        return $this->view('shop.exemple', compact('title', 'resultat'));
    }
}
