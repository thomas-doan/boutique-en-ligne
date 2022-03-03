<?php

namespace App\Controllers;

class ProfilController extends Controller
{
    protected $model;

    public function index()
    {
        $title = "Profil";

        return $this->view('profil.index', compact('title'));
    }
}
