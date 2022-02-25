<?php

namespace App\Controllers;


class ExempleidController extends Controller
{

    public function index($id)
    {

        $test = $id;

        return $this->view('shop.exempleid', compact('test'));
    }
}
