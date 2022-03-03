<?php

namespace App\Controllers;

use App\Models\Adresses;
use App\Models\Utilisateurs;

class ModifierAdresseController extends Controller
{
    protected $model;

    public function index($id_adresse)
    {
        // $model = new Adresses();
        $title = "Modifier Adresse";
        $idAdresse = $id_adresse;
        $allInfoById = $this->getAdressebyId($idAdresse);
        return $this->view('profil/modifierAdresse', compact('title', 'idAdresse', 'allInfoById'));
    }

    public function getAdressebyId($id_adresse)
    {
        $model = new Adresses();
        $criteres = ['id_adresse'];
        $adress = $model->find($criteres, compact('id_adresse'));
        return $adress;
    }

    public function updateAdresse($id)
    {
        $model = new Adresses();
        $id_adresse = $id;


        if (isset($_POST['mod'])) {
            $nom_adresse = $_POST['nomAdresse'];
            $ville = $_POST['ville'];
            $voie = $_POST['libelle'];
            $voie_sup = $_POST['voieSup'];
            $code_postal = $_POST['codePostal'];
            $telephone = $_POST['telephone'];
            $pays = $_POST['pays'];

            $newAdresse = $model
                ->setNom_adresse($nom_adresse)
                ->setVille($ville)
                ->setVoie($voie)
                ->setVoie_sup($voie_sup)
                ->setCode_postal($code_postal)
                ->setTelephone($telephone)
                ->setPays($pays);

            $model->update($newAdresse, compact('id_adresse', 'nom_adresse', 'ville', 'voie', 'voie_sup', 'code_postal', 'telephone', 'pays'));
            header('location: /profil');
        }
    }
}
