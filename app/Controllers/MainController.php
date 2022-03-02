<?php

namespace App\Controllers;

use App\Models\Articles;


class MainController extends Controller
{

    public function index()
    {
        $title = "accueil - kawa";

        return $this->view('shop.index', compact('title'));
    }
}
