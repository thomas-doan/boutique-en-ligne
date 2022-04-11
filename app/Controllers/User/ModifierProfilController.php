<?php

namespace App\Controllers\User;

use App\Controllers\Controller;
use App\Controllers\User\AdresseController;
use App\Models\Utilisateurs;

class ModifierProfilController extends Controller
{

    protected $model;

    public function __construct()
    {
        $this->adresse = new AdresseController();
    }

    public function index()
    {
        $title = "Modifier Profil";
        if ($this->adresse->getAdress() == null) {
            $notifAdresse = "Vous n'avez pas encore renseigné d'adresses, cela pourrait vous facilité votre utilisation";
        } else $notifAdresse = null;

        return $this->view('profil.modifierProfil', compact('title', 'notifAdresse'));
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
            $id_utilisateur =  $_SESSION['user']['id_utilisateur'];

            if (empty($email) && empty($nom) && empty($prenom)) {
                $_SESSION['flash']['erreur'] = "Oups ! Il faut renseigner des nouvelles informations !";
                echo "<SCRIPT LANGUAGE=\"JavaScript\"> document.location.href=\"./modifierProfil\" </SCRIPT>"; //force la direction

            }
            if (empty($email)) {
                $user->setEmail($_SESSION['user']['email']);
            } else {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $_SESSION['flash']['erreur'] = "Mauvais format d'email.";
                    echo "<SCRIPT LANGUAGE=\"JavaScript\"> document.location.href=\"./modifierProfil\" </SCRIPT>"; //force la direction
                    exit();
                }
                $argument = ['email'];
                $checkEmail = $model->find($argument, compact('email'));
                if ($checkEmail == TRUE) {
                    $_SESSION['flash']['erreur'] = "Oups ! L'email n'est pas disponible";
                    $user->setEmail($_SESSION['user']['email']);
                    echo "<SCRIPT LANGUAGE=\"JavaScript\"> document.location.href=\"./modifierProfil\" </SCRIPT>"; //force la direction
                } else {
                    $user->setEmail($email);
                    echo "<SCRIPT LANGUAGE=\"JavaScript\"> document.location.href=\"./modifierProfil\" </SCRIPT>"; //force la direction
                }
            }

            if (empty($nom)) {
                $user->setNom($_SESSION['user']['nom']);
                echo "<SCRIPT LANGUAGE=\"JavaScript\"> document.location.href=\"./modifierProfil\" </SCRIPT>"; //force la direction
            } else {
                $user->setNom($nom);
                echo "<SCRIPT LANGUAGE=\"JavaScript\"> document.location.href=\"./modifierProfil\" </SCRIPT>"; //force la direction
            }
            if (empty($prenom)) {
                $user->setPrenom($_SESSION['user']['prenom']);
                echo "<SCRIPT LANGUAGE=\"JavaScript\"> document.location.href=\"./modifierProfil\" </SCRIPT>"; //force la direction
            } else {
                $user->setPrenom($prenom);
                echo "<SCRIPT LANGUAGE=\"JavaScript\"> document.location.href=\"./modifierProfil\" </SCRIPT>"; //force la direction
            }

            // $model->updateProfil($_SESSION['user']['id_utilisateur'], $user);

            $model->update($user, compact('email', 'nom', 'prenom', 'id_utilisateur'));
            $_SESSION['user']['email'] = $user->getEmail();
            $_SESSION['user']['prenom'] = $user->getPrenom();
            $_SESSION['user']['nom'] = $user->getNom();
            $_SESSION['flash']['sucess'] = "Bravo votre changement a bien été effectué";
            echo "<SCRIPT LANGUAGE=\"JavaScript\"> document.location.href=\"./profil\" </SCRIPT>"; //force la direction

            // var_dump($user);
        }
    }
}
