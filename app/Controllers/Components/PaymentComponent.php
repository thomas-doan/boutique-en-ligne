<?php


namespace App\Controllers\Components;


use App\Models\NumCommande;
use App\Models\Commandes;
use App\Models\Livraison;

use App\Controllers\Controller;


class PaymentComponent extends Controller
{

    public function __construct()
    {
        $this->modelNumCommande = new NumCommande();
        $this->modelCommandes = new Commandes();
        $this->modelLivraison = new Livraison();
    }

    public function getPaymentInfo()
    {
    }
}
