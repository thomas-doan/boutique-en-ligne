<?php

namespace App\Controllers;

use App\Models\ExempleModel;

class MainController extends Controller
{

    public function index()
    {

        $title = "super titre";

        $model = new ExempleModel($this->getDB());

        $id_article = "1";

        $criteres = ["id_article"];

        $find = $model->find($criteres, compact('id_article'));

        /*  return $this->view('shop.index', compact('title')); */
        return $this->view('shop.index', compact('title', 'find'));
    }
}
