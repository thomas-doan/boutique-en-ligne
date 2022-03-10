<?php

namespace App\Controllers;

use App\Models\Utilisateurs;

class ConnexionController extends Controller
{
    protected $model;

    public function index()
    {
        $title = "Connexion";

        return $this->view('profil.connexion', compact('title'));
    }

    public function login()
    {
        $model = new Utilisateurs();

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $mdp = $_POST['mdp'];

            if (empty($email) || empty($mdp)) {
                $_SESSION['flash']['erreur'] = "Oups ! Veuillez remplir tout les champs";
            } else {

                $argument = ['email'];
                $checkUser = $model->find($argument, compact('email'));
                if (password_verify(@$mdp, @$checkUser[0]['password'])) {
                    $user = $model
                        ->setId_utilisateur((int)$checkUser[0]['id_utilisateur'])
                        ->setPrenom($checkUser[0]['prenom'])
                        ->setNom($checkUser[0]['nom'])
                        ->setEmail($checkUser[0]['email'])
                        ->setPassword($checkUser[0]['password'])
                        ->setRole($checkUser[0]['role']);

                    $_SESSION['user']['id_utilisateur'] = (int)$user->getId_utilisateur();
                    $_SESSION['user']['prenom'] = $user->getPrenom();
                    $_SESSION['user']['nom'] = $user->getNom();
                    $_SESSION['user']['email'] = $user->getEmail();
                    $_SESSION['user']['password'] = $user->getPassword();
                    $_SESSION['user']['role'] = $user->getRole();
                    // var_dump($user);
                    header('Location: ./profil');
                    exit();
                } else {

                    $_SESSION['flash']['erreur'] = "Oups ! Le mot de passe ou l'email est inccorecte";
                    header('Location: ./connexion');
                }
            }
        }
    }
}
