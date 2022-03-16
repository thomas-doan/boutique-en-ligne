<?php

namespace App\Controllers;

use App\Models\Utilisateurs;

class ConnexionController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new Utilisateurs();
    }
    public function index()
    {
        $title = "reset password";
        /*        $refererPath = explode('/', $_SERVER['HTTP_REFERER'])[4];
        if ($refererPath !== 'connexion' && $refererPath !== 'admin') {
            $_SESSION['reload'] = $_SERVER['HTTP_REFERER'];
        } */
        return $this->view('resetpassword.checkEmail', compact('title'));
    }

    public function Checklogin()
    {
        $model = new Utilisateurs();

        if (isset($_POST['submit'])) {
            $email = $_POST['emailVerify'];
            $mdp = $_POST['mdp'];

            if (empty($email)) {
                $_SESSION['flash']['erreur'] = "Oups ! Veuillez remplir tout les champs";
            } else {

                $argument = ['email'];
                $checkUser = $model->find($argument, compact('email'));
                if ($checkUser) {
                    $user = $model
                        ->setId_utilisateur((int)$checkUser[0]['id_utilisateur'])
                        ->setEmail($checkUser[0]['email'])
                        ->setQuestion_secrete($checkUser[0]['password']);

                    $_SESSION['check']['id_utilisateur'] = (int)$user->getId_utilisateur();
                    $_SESSION['check']['question'] = $user->getQuestion_secrete();
                    $_SESSION['check']['email'] = $user->getEmail();
                } else {
                    $_SESSION['flash']['erreur'] = "Oups ! l'email est incorrect";
                    header('Location: ./checkemail');
                }
            }
        }
    }
}
