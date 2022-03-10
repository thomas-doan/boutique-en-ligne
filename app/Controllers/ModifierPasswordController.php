<?php

namespace App\Controllers;

use App\Models\Utilisateurs;

class ModifierPasswordController extends Controller
{
    protected $model;

    public function index()
    {
        $title = "Modifier mot de passe";

        return $this->view('profil.modifierMotdePasse', compact('title'));
    }

    public function updatePassword()
    {
        $model = new Utilisateurs();

        if (isset($_POST['submit'])) {
            $ancienMdp = $_POST['ancienMdp'];
            $nouveauMdp = $_POST['nouveauMdp'];
            $confirmMdp = $_POST['confirmMdp'];
            $id_utilisateur =  $_SESSION[['user']['id_utilisateur'];

            $argument = ['id_utilisateur'];
            $checkUser = $model->find($argument, compact('id_utilisateur'));

            if (empty($ancienMdp) || empty($nouveauMdp) || empty($confirmMdp)) {
                $_SESSION['flash']['erreur'] = "Oups ! Veuillez renseigner tout les champs !";
                header('location: ./modifierMotdePasse');
            } elseif (!password_verify(@$ancienMdp, @$checkUser[0]['password'])) {
                $_SESSION['flash']['erreur'] = "Oups ! Veuillez renseigner votre mdp actuel !";
                header('location: ./modifierMotdePasse');
            } elseif ($nouveauMdp !== $confirmMdp) {
                $_SESSION['flash']['erreur'] = "Oups ! Les mdp ne match pas !";
                header('location: ./modifierMotdePasse');
            } else {

                // $updateMdp = $model;
                // $updateMdp->setPassword(password_hash($nouveauMdp, PASSWORD_DEFAULT));
                // $model->updateProfil($_SESSION[['user']['id_utilisateur'], $updateMdp);
                // $_SESSION[['user']['password'] = $model->getPassword();
                // $_SESSION['flash']['sucess'] = "Bravo votre changement a bien été effectué";
                // header('Location: ../profil');
                // exit();

                $passwordHash = password_hash($nouveauMdp, PASSWORD_DEFAULT);
                $password = $passwordHash;
                $updateMdp = $model
                    ->setPassword($passwordHash);
                $model->update($updateMdp, compact('password', 'id_utilisateur'));

                $_SESSION[['user']['password'] = $model->getPassword();
                $_SESSION['flash']['sucess'] = "Bravo votre changement a bien été effectué";
                header('Location: ../profil');
                exit();
            }
        }
    }
}
