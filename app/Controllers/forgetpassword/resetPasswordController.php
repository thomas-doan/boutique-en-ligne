<?php

namespace App\Controllers\forgetpassword;

use App\Controllers\Controller;

use App\Models\Utilisateurs;

class resetPasswordController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new Utilisateurs();
    }
    public function index()
    {
        $title = "reset password";

        return $this->view('resetpassword.resetPassword', compact('title'));
    }

    public function resetPassword()
    {
        if (isset($_POST['submit'])) {
            $reponse = $_POST['reponse'];
            $mdp = $_POST['mdp'];
            $mdpConfirm = $_POST['mdpConfirm'];

            if (empty($reponse) || empty($mdp)) {
                $_SESSION['flash']['remplir'] = "Oups ! Veuillez remplir tout les champs";
            } elseif ($mdp != $mdpConfirm) {
                $_SESSION['flash']['mdp'] = "Oups ! Vos mots de passe doivent être similaires !";
            } else {
                $email = $_SESSION['reset']['email'];
                $argument = ['email'];
                $checkUser = $this->model->find($argument, compact('email'));
                if (password_verify(@$reponse, @$checkUser[0]['reponse'])) {
                    $password = password_hash($mdp, PASSWORD_DEFAULT);

                    $user = $this->model
                        ->setId_utilisateur((int)$checkUser[0]['id_utilisateur'])
                        ->setPassword($password);
                    $id_utilisateur = (int)$checkUser[0]['id_utilisateur'];
                    $this->model->update($user, compact('id_utilisateur', 'password'));
                    header('Location: ./connexion');
                    exit();
                } else {

                    $_SESSION['flash']['erreur'] = "Oups ! La réponse est fausse !";
                }
            }
            header('Location: ./resetpassword');
            exit();
        }
    }
}
