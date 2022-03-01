<?php

namespace App\Controllers;



class MainController extends Controller
{

    public function index()
    {

        $title = "accueil du site kawa";


        return $this->view('shop.index', compact('title'));
    }
}
