<?php



namespace App\Controllers\pathToOrder;

use Exception;

use App\Controllers\Controller;

class PaymentResumeController extends Controller
{

    public function __construct()
    {
    }


    public function index()
    {
        $title = " Confirmation paiement - Kawa";
        return $this->view('shop.resumePayment', compact('title'));
    }
}
