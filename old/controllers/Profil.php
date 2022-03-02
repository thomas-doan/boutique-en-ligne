<?php

namespace Controllers;


use Models\Renderer;
use Controllers\Controllers;

class Profil extends Controllers
{

    protected $modelName = \Models\Panier::class;

    public function index()
    {
        $test = "super toto";

        Renderer::render('profil', compact('test'));
    }
}
