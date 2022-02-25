<?php

namespace App\Controllers;


class ExempleidController extends Controller
{

    public function index($id)
    {

        $test = $id;


        /*  $toto = test($id); */

        $heredoc = <<<php
        <p> <u>toto et {$this->test(4)} </u></p>
        php;

        return $this->view('shop.exempleid', compact('test', 'heredoc'));
    }


    public function test($arg)
    {
        $resultat = 3 + $arg;

        return $resultat;
    }
}
