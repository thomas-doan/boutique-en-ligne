<?php


namespace App\Controllers;


use App\Models\Articles;
use App\Models\Utilisateurs;
use App\Models\Adresses;


class LivraisonController extends Controller
{

    public function __construct()
    {


        $this->model = new Utilisateurs();
        $this->modelArticle = new Articles();
        $this->modelAdresses = new Adresses();
    }


    public function index()
    {
        $id = $_SESSION['id_utilisateur'];
        $info_user = $this->getUser($id);
        $title = "Livraison - Kawa";

        if ($this->adressCheck()) {
            $adress = $this->adressCheck();
            return $this->view('shop.livraison', compact('title', 'info_user', 'adress'));
        } else {
            return $this->view('shop.livraison', compact('title', 'info_user'));
        };
    }

    public function getUser($id)
    {
        $id_utilisateur = $id;

        $argument = ['id_utilisateur'];
        $resultat = $this->model->find($argument, compact('id_utilisateur'));


        return $resultat;
    }


    public function adressCheck()
    {

        $fk_id_utilisateur = $_SESSION['id_utilisateur'];
        $argument = ['fk_id_utilisateur'];
        $adresse = $this->modelAdresses->find($argument, compact('fk_id_utilisateur'));

        foreach ($adresse as $key => $value) {
            $resultat[$value['id_adresse']] = $value;
        }

        return $resultat;
    }

    public function getAdress()
    {

        if (isset($_POST['id_adresse'])) {
            $_SESSION['select_adress'] = $_POST['id_adresse'];

            header("location: ./livraison");
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

                $_SESSION['validate']['email'] = $email;
                $_SESSION['validate']['nom'] = $nom;
                $_SESSION['validate']['prenom'] = $prenom;
                $_SESSION['validate']['nom_adresse'] = $nom_adresse;
                $_SESSION['validate']['ville'] = $ville;
                $_SESSION['validate']['pays'] = $pays;
                $_SESSION['validate']['voie'] = $voie;
                $_SESSION['validate']['voie_sup'] = $voie_sup;
                $_SESSION['validate']['code_postal'] = $code_postal;
                $_SESSION['validate']['telephone'] = $telephone;

                header('location: ./paiement');
            } else {
                $_SESSION['flash']['erreur_insert_livraison'] = "remplir l'ensemble des champs livraison !";
                header('location: ./livraison');
            }
        }
    }
}
