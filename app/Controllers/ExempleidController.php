<?php

namespace App\Controllers;

use App\Controllers\Components\Components;

class ExempleidController extends Controller
{

    public function index($id)
    {

        $test = $id;
        $resultat = Components::test($id);

        /*  $toto = test($id); */

        $heredoc = <<<php
        <p> <u>toto et {$resultat} </u></p>
        php;

        return $this->view('shop.exempleid', compact('test', 'heredoc'));
    }
}
