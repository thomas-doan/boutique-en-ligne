<?php

namespace Controllers;

use Models\Renderer;
use Controllers\Controllers;

class TestTest extends Controllers
{

    protected $modelName = \Models\Panier::class;

    public function try()
    {
        $thomas = "super test";

        Renderer::render('test', compact('thomas'));
    }
}
