<?php

namespace Controllers;


use Models\Renderer;
use Controllers\Controllers;

class Recherche extends Controllers
{

    protected $modelName = \Models\Panier::class;

    public function index()
    {
        $info = $_GET['recherche'];
        $test = $this->model->findProduit($info);


        Renderer::render('recherche', compact('test'));
    }
}
