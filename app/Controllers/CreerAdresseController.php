<?php

namespace App\Controllers;

use App\Models\Adresses;

class CreerAdresseController extends Controller
{
    protected $model;

    public function index()
    {
        $title = "Créer Adresse";
        return $this->view('profil.creerAdresse', compact('title'));
    }

    public function createAdresse()
    {
        $model = new Adresses();

        if (isset($_POST['submit'])) {
            $nom_adresse = $_POST['nomAdresse'];
            $ville = $_POST['ville'];
            $voie = $_POST['libelle'];
            $voie_sup = $_POST['voieSup'];
            $code_postal = $_POST['codePostal'];
            $telephone = $_POST['telephone'];
            $pays = $_POST['pays'];
            $fk_id_utilisateur = $_SESSION[['user']['id_utilisateur'];
            if (empty($nom_adresse) || empty($ville) || empty($voie) || empty($code_postal) || empty($telephone) || empty($pays)) {
                $_SESSION['flash']['erreur'] = "Oups ! Vous devez remplir tout les champs !";
                header('Location: ./adresse');
                exit();
            } else {
                $adress = $model
                    ->setNom_adresse($nom_adresse)
                    ->setVille($ville)
                    ->setVoie($voie)
                    ->setVoie_sup($voie_sup)
                    ->setCode_postal($code_postal)
                    ->setTelephone($telephone)
                    ->setPays($pays)
                    ->setFk_id_utilisateur($_SESSION[['user']['id_utilisateur']);
                $model->create($adress, compact('nom_adresse', 'ville', 'voie', 'voie_sup', 'code_postal', 'telephone', 'pays', 'fk_id_utilisateur'));
                header('Location: ./adresse');
            }
        }
    }
}
