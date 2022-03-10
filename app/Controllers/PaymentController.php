<?php

namespace App\Controllers;

use Exception;
use Throwable;

use Stripe\Stripe;
use App\Models\Articles;
use App\Models\Commandes;
use App\Models\Livraison;
use Stripe\PaymentIntent;
use Database\DBConnection;
use App\Models\NumCommande;
use App\Controllers\Security;
use App\Controllers\Controller;

class PaymentController extends Controller
{

    public function __construct()
    {
        $this->modelNumCommande = new NumCommande();
        $this->modelCommandes = new Commandes();
        $this->modelLivraison = new Livraison();
        $this->modelArticle = new Articles();
    }


    public function index()
    {

        $title = "Paiement - Kawa";

        $totalPrice = 600;
        // Nous appelons l'autoloader pour avoir accès à Stripe


        // Nous instancions Stripe en indiquand la clé privée, pour prouver que nous sommes bien à l'origine de cette demande
        \Stripe\Stripe::setApiKey('sk_test_51Kbk2DKiGV4T2BDFJHQjg1nW2gLVxPy5Renk8jdaZPIAvD31kIDLzrOmRiyxFEiszws6noml2hucPUeteSJfXnRp006gqmAwdp');

        // Nous créons l'intention de paiement et stockons la réponse dans la variable $intent
        $intent = \Stripe\PaymentIntent::create([
            'amount' => $totalPrice * 100, // Le prix doit être transmis en centimes
            'currency' => 'eur',
        ]);

        return $this->view('shop.payment', compact('title', 'intent'));
    }


    public function checkQuantity()
    {

        $checkQuantity = [];
        $_SESSION['quantityPayment'] = [];
        $_SESSION['halfQuantityPayment'] = [];
        $_SESSION['noStock'] = [];

        foreach ($_SESSION['quantite'] as $key => $value) {
            $id_article = $key;
            $argument = ['id_article'];
            $selection = ['sku', 'titre_article', 'prix_article'];
            $checkQuantity[$id_article] = $this->modelArticle->find($argument, compact('id_article'), $selection);

            if (($checkQuantity[$key][0]["sku"] - $value) >= 0) {

                $titre_article = $checkQuantity[$key][0]["titre_article"];

                $prix_article = $checkQuantity[$key][0]["prix_article"];
                $_SESSION['quantityPayment'][$id_article][0] = $value;
                $_SESSION['quantityPayment'][$id_article][1] = $titre_article;
                $_SESSION['quantityPayment'][$id_article][2] = $prix_article;
            }

            if (($checkQuantity[$key][0]["sku"] - $value) < 0) {

                $titre_article = $checkQuantity[$key][0]["titre_article"];
                $prix_article = $checkQuantity[$key][0]["prix_article"];

                $newCalcul = $value - $checkQuantity[$key][0]["sku"];
                $_SESSION['quantite'][$key] = $newCalcul;
                $_SESSION['halfQuantityPayment'][$id_article][0] = $newCalcul;
                $_SESSION['halfQuantityPayment'][$id_article][1] = $titre_article;
                $_SESSION['halfQuantityPayment'][$id_article][2] = $prix_article;
            }

            if ($checkQuantity[$key][0]["sku"] == 0) {
                $_SESSION['noStock'][$id_article][1] = $titre_article;

                unset($_SESSION['quantite'][$id_article]);
                unset($_SESSION['prix'][$id_article]);
            }
        }
    }

    public function updateQuantity($db)
    {
        foreach ($_SESSION['quantite'] as $key => $value) {

            $this->modelArticle->updateLock($db, $key, $value);
        }
    }


    public function insertLivraison($idNumC, $connexion)
    {
        $fk_id_num_commande = Security::control($idNumC);
        $email = Security::control($_SESSION['validate']['email']);
        $nom = Security::control($_SESSION['validate']['nom']);
        $prenom = Security::control($_SESSION['validate']['prenom']);
        $nom_adresse = Security::control($_SESSION['validate']['nom_adresse']);
        $ville =   Security::control($_SESSION['validate']['ville']);
        $pays = Security::control($_SESSION['validate']['pays']);
        $voie = Security::control($_SESSION['validate']['voie']);
        $voie_sup =  Security::control($_SESSION['validate']['voie_sup']);
        $code_postal =  Security::control($_SESSION['validate']['code_postal']);
        $telephone =   Security::control($_SESSION['validate']['telephone']);
        $etat_livraison = "en attente confirmation";

        $modelHydrate = $this->modelLivraison
            ->setFk_id_num_commande($fk_id_num_commande)
            ->setEmail($email)
            ->setNom($nom)
            ->setPrenom($prenom)
            ->setNom_adresse($nom_adresse)
            ->setVille($ville)
            ->setPays($pays)
            ->setVoie($voie)
            ->setVoie_sup($voie_sup)
            ->setCode_postal($code_postal)
            ->setTelephone($telephone)
            ->setEtat_livraison($etat_livraison);


        $this->modelLivraison->createTransaction($modelHydrate, compact('fk_id_num_commande', 'email', 'nom', 'prenom', 'nom_adresse', 'ville', 'pays', 'voie', 'voie_sup', 'code_postal', 'telephone', 'etat_livraison'), $connexion);
    }

    public function insertCommandes($idNumC, $connexion)
    {

        foreach ($_SESSION['quantite'] as $key1 => $value1) {
            foreach ($_SESSION['prix'] as $key2 => $value2) {
                if ($key1 == $key2) {
                    $fk_id_num_commande = $idNumC;
                    $nb_article = $value1;
                    (float) $prix_article = $value2;
                    $fk_id_article = $key1;
                    (float) $prix_commande = ($prix_article * $nb_article);
                    $modelHydrate = $this->modelCommandes
                        ->setFk_id_num_commande($fk_id_num_commande)
                        ->setFk_id_article($fk_id_article)
                        ->setNb_article($nb_article)
                        ->setPrix_article($prix_article)
                        ->setPrix_commande($prix_commande);
                    $this->modelCommandes->createTransaction($modelHydrate, compact('fk_id_num_commande', 'fk_id_article', 'nb_article', 'prix_article', 'prix_commande'), $connexion);
                }
            }
        }
    }

    public function totalPrice()
    {

        if (isset($_SESSION['quantite'])) {

            $result = 0;
            foreach ($_SESSION['quantite'] as $key1 => $value1) {
                foreach ($_SESSION['prix'] as $key2 => $value2) {
                    if ($key1 == $key2) {

                        $resultSinglePrice = $value1 * $value2;
                        $result += $resultSinglePrice;
                    }
                }
            }
        }
        return $result;
    }

    public function totalQuantity()
    {
        (float) $result = 0;
        foreach ($_SESSION['quantite'] as $quantite) {
            $result = $result + $quantite;
        }

        return $result;
    }

    public function insertNumCommande($db)
    {
        (int) $secureIdUser = Security::control($_SESSION['id_utilisateur']);
        (int) $secureTotalProduit = $this->totalQuantity();
        (float) $secureWithTvaPrice = $this->totalPrice();

        // variable init envoyer dans le model Num Commande
        $fk_id_utilisateurs = $secureIdUser;
        $total_produit = $secureTotalProduit;
        $prix_avec_tva = $secureWithTvaPrice;
        $prix_sans_tva = $secureWithTvaPrice * (94.5 / 100);
        $resultat =  $this->modelNumCommande->orderInsert($db, compact('fk_id_utilisateurs', 'total_produit', 'prix_sans_tva', 'prix_avec_tva'));
        return $resultat;
    }


    public function stripe($totalPrice)
    {
        $totalPrice = $totalPrice * 1.055;
        // Nous appelons l'autoloader pour avoir accès à Stripe
        require_once('vendor/autoload.php');

        // Nous instancions Stripe en indiquand la clé privée, pour prouver que nous sommes bien à l'origine de cette demande
        \Stripe\Stripe::setApiKey('sk_test_51KMXz2L8eUNbBHo6sgsAeEAIaLa7YN4KePAc6VyIzBD6vYPobi6nvhiIZc2i7IwDQ6mY7st3C9SGpQ8EqTeIa8tt00N7j8mWAF');

        // Nous créons l'intention de paiement et stockons la réponse dans la variable $intent
        $intent = \Stripe\PaymentIntent::create([
            'amount' => $totalPrice * 100, // Le prix doit être transmis en centimes
            'currency' => 'eur',
        ]);
    }

    public function payment()
    {           /*         $this->stripe($this->totalPrice()); */
        if (isset($_POST['submit'])) {
            $db = DBConnection::getPDO();

            try {
                $db->beginTransaction();
                $this->checkQuantity();
                $getIdNumCommande = $this->insertNumCommande($db);
                $this->updateQuantity($db);

                $this->insertLivraison($getIdNumCommande, $db);
                $this->insertCommandes($getIdNumCommande, $db);
                $db->commit();
            } catch (Exception $e) {
                $db->rollBack();
                echo "Failed: " . $e->getMessage();
            }
        }
    }
}
