<?php

namespace App\Controllers;

use App\Controllers\Components\Components;

class ExempleidController extends Controller
{

    public function index($id_article)
    {

        $test = $id_article;
        $resultat = Components::test($id_article);

        /*  $toto = test($id); */

        $heredoc = <<<php
        <p> <u>toto et {$resultat} </u></p>
        php;

        return $this->view('shop.exempleid', compact('test', 'heredoc'));
    }
}
