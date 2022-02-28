<?php

namespace App\Controllers;

use App\Models\ExempleModel;

class MainController extends Controller
{

    public function index()
    {

        $title = "super titre";

        $model = new ExempleModel($this->getDB());

        $titre_article = "toto";
        $prix_article = "2";
        $criteres = ["titre_article", "prix_article"];
        $find = $model->find($criteres, compact('titre_article', 'prix_article'));

        /*  return $this->view('shop.index', compact('title')); */
        return $this->view('shop.index', compact('title', 'find'));
    }
}
