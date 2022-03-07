<?php

namespace App\Controllers;

use App\Controllers\Components\ProductComponent;
use App\Controllers\Components\CategoriesComponent;

class AdminUpdateProductComponent extends Controller
{
    public $error = array();
    protected $Product;
    protected $Categories;

    public function __construct()
    {
        $this->Product = New ProductComponent;
        $this->Categories = new CategoriesComponent;
    }

    
}