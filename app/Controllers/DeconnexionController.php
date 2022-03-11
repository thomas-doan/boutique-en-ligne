<?php
namespace App\Controllers;

class DeconnexionController extends Controller
{
    public function index()
    {
    $title = "deconnexion";
    $this->view('profil.deconnexion', compact('title'));
    }
}
?>