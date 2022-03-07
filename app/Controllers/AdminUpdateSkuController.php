<?php

namespace App\Controllers;

use Database\DBConnection;
use App\Controllers\Components\ProductComponent;
use App\Controllers\Components\CategoriesComponent;

class AdminUpdateSkuController extends Controller
{
    public $error = array();
    protected $Product;
    protected $Categories;

    public function __construct()
    {
        $this->Product = new ProductComponent();
        $this->Categories = new CategoriesComponent();
    }

    public function index()
    {

    }
}