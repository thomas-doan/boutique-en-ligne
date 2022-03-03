<?php

namespace App\Controllers;

use App\Models\Utilisateurs;

class ModifierProfilController extends Controller
{
    protected $model;

    public function index()
    {
        $title = "Modifier Profil";

        return $this->view('profil.modifierProfil', compact('title'));
    }

    public function updateProfil()
    {
        $title = "Modifier Profil";
        $model = new Utilisateurs();

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $user = $model;
            $id_utilisateur =  $_SESSION['id_utilisateur'];

            if (empty($email) && empty($nom) && empty($prenom)) {
                $_SESSION['flash']['erreur'] = "Oups ! Il faut renseigner des nouvelles informations !";
                header('location: ./modifierProfil');
            }
            if (empty($email)) {
                $user->setEmail($_SESSION['email']);
            } else {
                $criteres = ['email'];
                $checkEmail = $model->find($criteres, compact('email'));
                if ($checkEmail == TRUE) {
                    $_SESSION['flash']['erreur'] = "Oups ! L'email n'est pas disponible";
                    $user->setEmail($_SESSION['email']);
                    header('location: ./modifierProfil');
                } else {
                    $user->setEmail($email);
                    header('location: ./modifierProfil');
                }
            }

            if (empty($nom)) {
                $user->setNom($_SESSION['nom']);
                header('location: ./modifierProfil');
            } else {
                $user->setNom($nom);
                header('location: ./modifierProfil');
            }
            if (empty($prenom)) {
                $user->setPrenom($_SESSION['prenom']);
                header('location: ./modifierProfil');
            } else {
                $user->setPrenom($prenom);
                header('location: ./modifierProfil');
            }

            // $model->updateProfil($_SESSION['id_utilisateur'], $user);

            $model->update($user, compact('email', 'nom', 'prenom', 'id_utilisateur'));
            $_SESSION['email'] = $user->getEmail();
            $_SESSION['prenom'] = $user->getPrenom();
            $_SESSION['nom'] = $user->getNom();
            $_SESSION['flash']['sucess'] = "Bravo votre changement a bien été effectué";
            header('Location: ../profil');
            exit();
            // var_dump($user);
        }
    }
}
