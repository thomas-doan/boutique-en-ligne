<?php

namespace App\Controllers;

use App\Models\ExempleModel;

class MainController extends Controller
{

    public function index()
    {

        $title = "super titre";

        $model = new ExempleModel($this->getDB());


        $find = $model->findId();

        /*  return $this->view('shop.index', compact('title')); */
        return $this->view('shop.index', compact('title', 'find'));
    }
}
