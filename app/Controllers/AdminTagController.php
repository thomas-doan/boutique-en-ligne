<?php

namespace App\Controllers;

use App\Models\Tag;

class AdminTagController extends Controller
{

    public function __construct()
    {
        $this->model = new Tag();
    }

    public function index()
    {
        $title = "Admin tag - Kawa";

        $tag = $this->model->findAll();

        $this->view('administrator/category/index', compact('title', 'tag'));
    }

    public function update()
    {
    }


    public function create()
    {
    }


    public function delete()
    {
    }
}
