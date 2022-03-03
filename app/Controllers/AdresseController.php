<?php

namespace App\Controllers;

use App\Models\Adresses;
use App\Models\Utilisateurs;

class AdresseController extends Controller
{
    protected $model;

    public function index()
    {
        $model = new Adresses();
        $title = "Adresse de livraison";
        $userAdresse = $this->getAdresse();

        if (isset($_POST['submit'])) {
            $nom_adresse = $_POST['nomAdresse'];
            $ville = $_POST['ville'];
            $voie = $_POST['libelle'];
            $voie_sup = $_POST['voieSup'];
            $code_postal = $_POST['codePostal'];
            $telephone = $_POST['telephone'];
            $pays = $_POST['pays'];
            $fk_id_utilisateur = $_SESSION['id_utilisateur'];

            $adresse = $model
                ->setNom_adresse($nom_adresse)
                ->setVille($ville)
                ->setVoie($voie)
                ->setVoie_sup($voie_sup)
                ->setCode_postal($code_postal)
                ->setTelephone($telephone)
                ->setPays($pays)
                ->setFk_id_utilisateur($_SESSION['id_utilisateur']);
            $model->create($adresse, compact('nom_adresse', 'ville', 'voie', 'voie_sup', 'code_postal', 'telephone', 'pays', 'fk_id_utilisateur'));
            // var_dump($adresse);  
            header('Location: ./adresse');
        }
        return $this->view('profil.Adresse', compact('title', 'userAdresse'));
    }

    public function getAdresse()
    {
        $model = new Adresses();
        $criteres = ['fk_id_utilisateur'];
        $fk_id_utilisateur = $_SESSION['id_utilisateur'];
        $userAdress = $model->find($criteres, compact('fk_id_utilisateur'));
        return $userAdress;
    }
}
