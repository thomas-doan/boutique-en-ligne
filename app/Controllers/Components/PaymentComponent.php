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

            /*             if ($checkQuantity[$key][0]["sku"] == 0) {
                $_SESSION['noStock'][$id_article][1] = $titre_article;

                unset($_SESSION['quantite'][$id_article]);
                unset($_SESSION['prix'][$id_article]);
            } */
        }
    }

    public function updateQuantity($db)
    {
        foreach ($_SESSION['quantite'] as $key => $value) {

            $this->modelArticle->updateLock($db, $key, $value);
        }
    }


    public function fieldCheck()
    {
        if (isset($_POST['submit'])) {
            $email = Security::control($_POST['email']);
            $nom = Security::control($_POST['nom']);
            $prenom = Security::control($_POST['prenom']);
            $nom_adresse = Security::control($_POST['nom_adresse']);
            $ville = Security::control($_POST['ville']);
            $pays = Security::control($_POST['pays']);
            $voie = Security::control($_POST['voie']);
            $voie_sup = Security::control($_POST['voie_sup']);
            $code_postal = Security::control($_POST['code_postal']);
            $telephone = Security::control($_POST['telephone']);

            if (!empty($email) && !empty($nom) && !empty($prenom) && !empty($nom_adresse) && !empty($ville) && !empty($pays) && !empty($voie) && !empty($code_postal) && !empty($email)) {
                $validation = 1;
                return $validation;
            } else {
                $_SESSION['flash']['erreur_insert_livraison'] = "remplir l'ensemble des champs livraison !";
                header('location: ./commande');
            }
        }
    }

    public function insertLivraison($idNumC)
    {
        if (isset($_POST['submit'])) {
            $fk_id_num_commande = Security::control($idNumC);
            $email = Security::control($_POST['email']);
            $nom = Security::control($_POST['nom']);
            $prenom = Security::control($_POST['prenom']);
            $nom_adresse = Security::control($_POST['nom_adresse']);
            $ville = Security::control($_POST['ville']);
            $pays = Security::control($_POST['pays']);
            $voie = Security::control($_POST['voie']);
            $voie_sup = Security::control($_POST['voie_sup']);
            $code_postal = Security::control($_POST['code_postal']);
            $telephone = Security::control($_POST['telephone']);
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
                ->setTelephone($telephone);
            /*   ->setEtat_livraison($etat_livraison); */


            $this->modelLivraison->create($modelHydrate, compact('fk_id_num_commande', 'email', 'nom', 'prenom', 'nom_adresse', 'ville', 'pays', 'voie', 'voie_sup', 'code_postal', 'telephone'/* , 'etat_livraison' */));
        }
    }

    public function insertCommandes($idNumC)
    {

        foreach ($_SESSION['quantite'] as $key1 => $value1) {
            foreach ($_SESSION['prix'] as $key2 => $value2) {
                if ($key1 == $key2) {
                    $fk_id_num_commande = $idNumC;
                    $nb_article = $value1;
                    (float) $prix_article = $value2;
                    $fk_id_article = $key1;
                    (float) $prix_commande = $prix_article * $nb_article;
                    $modelHydrate = $this->modelCommandes
                        ->setFk_id_num_commande($fk_id_num_commande)
                        ->setFk_id_article($fk_id_article)
                        ->setNb_article($nb_article)
                        ->setPrix_article($prix_article)
                        ->setPrix_commande($prix_commande);
                    $this->modelCommandes->create($modelHydrate, compact('fk_id_num_commande', 'fk_id_article', 'nb_article', 'prix_article', 'prix_commande'));
                }
            }
        }
    }

    public function insertNumCommande($db)
    {
        (int) $secureIdUser = Security::control($_SESSION['id_utilisateur']);
        (int) $secureTotalProduit = Security::control($_SESSION['totalQuantity']);
        (float) $secureWithoutTvaPrice = Security::control($_SESSION['totalPrice']);

        // variable init envoyer dans le model Num Commande
        $fk_id_utilisateurs = $secureIdUser;
        $total_produit = $secureTotalProduit;
        $prix_sans_tva = $secureWithoutTvaPrice;
        $prix_avec_tva = $secureWithoutTvaPrice * 1.055;
        $resultat =  $this->modelNumCommande->orderInsert($db, compact('fk_id_utilisateurs', 'total_produit', 'prix_sans_tva', 'prix_avec_tva'));
        return $resultat;
    }


    public function payment()
    {
        if (isset($_POST['submit'])) {
            $db = DBConnection::getPDO();

            if ($this->fieldCheck() == 1) {
                try {

                    /*    $this->checkQuantity(); */
                    $db->beginTransaction();
                    $getIdNumCommande = $this->insertNumCommande($db);
                    $this->updateQuantity($db);
                    $this->insertCommandes($getIdNumCommande);
                    $this->insertLivraison($getIdNumCommande);
                    $db->commit();
                } catch (Exception $e) {
                    $db->rollBack();
                    echo "Failed: " . $e->getMessage();
                }
            }
        }
    }
}
