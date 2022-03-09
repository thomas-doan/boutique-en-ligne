<?php


namespace App\Controllers\Components;


use App\Models\Articles;
use App\Models\Utilisateurs;
use App\Models\Adresses;

use App\Controllers\Controller;


class PaymentComponent extends Controller
{

    public function __construct()
    {
        $this->model = new Utilisateurs();
        $this->modelArticle = new Articles();
        $this->modelAdresses = new Adresses();
    }

    public function getPaymentInfo()
    {
    }
}
