<?php


namespace App\Controllers\Components;


use App\Models\NumCommande;
use App\Models\Commandes;
use App\Models\Livraison;
use App\Models\Articles;
use Database\DBConnection;

use App\Controllers\Controller;
use App\Controllers\Security;
use Exception;
use Throwable;

class PaymentComponent extends Controller
{

    public function __construct()
    {
        $this->modelNumCommande = new NumCommande();
        $this->modelCommandes = new Commandes();
        $this->modelLivraison = new Livraison();
        $this->modelArticle = new Articles();
    }

    public function checkQuantity()
    {

        $checkQuantity = [];
        $productAvailable = [];

        foreach ($_SESSION['quantite'] as $key => $value) {
            $id_article = $key;
            $argument = ['id_article'];
            $selection = ['sku'];
            $checkQuantity[$id_article] = $this->modelArticle->find($argument, compact('id_article'), $selection);

            if (($checkQuantity[$key][0]["sku"] - $value) >= 0) {
                $productAvailable[$key] = "available";
            } else {
                $productAvailable[$key] = "unavailable";
            }
        }

        return $productAvailable;
    }

    public function updateQuantity($db)
    {
        foreach ($_SESSION['quantite'] as $key => $value) {

            $this->modelArticle->updateLock($db, $key, $value);
        }
    }


    public function payment()
    {
        if (isset($_POST['submit'])) {
            //secure info
            (int) $secureIdUser = Security::control($_SESSION['id_utilisateur']);
            (int) $secureTotalProduit = Security::control($_SESSION['totalQuantity']);
            (float) $secureWithoutTvaPrice = Security::control($_SESSION['totalPrice']);

            // variable init envoyer dans le model Num Commande
            $fk_id_utilisateurs = $secureIdUser;
            $total_produit = $secureTotalProduit;
            $prix_sans_tva = $secureWithoutTvaPrice;
            $prix_avec_tva = $secureWithoutTvaPrice * 1.055;


            $db = DBConnection::getPDO();

            try {
                $db->beginTransaction();
                if (!in_array("unavailable", $this->checkQuantity())) {
                    $this->modelNumCommande->orderInsert($db, compact('fk_id_utilisateurs', 'total_produit', 'prix_sans_tva', 'prix_avec_tva'));
                    $this->updateQuantity($db);
                    $db->commit();
                } else {
                    $test = "dead";
                    var_dump($test);
                    die();
                }
            } catch (Exception $e) {
                $db->rollBack();
                echo "Failed: " . $e->getMessage();
            }
        }
    }
}
