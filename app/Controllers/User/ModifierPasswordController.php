<?php

namespace App\Controllers\User;

use App\Controllers\Controller;

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
            $id_utilisateur =  $_SESSION['user']['id_utilisateur'];

            $argument = ['id_utilisateur'];
            $checkUser = $model->find($argument, compact('id_utilisateur'));

            if (empty($ancienMdp) || empty($nouveauMdp) || empty($confirmMdp)) {
                $_SESSION['flash']['erreur'] = "Oups ! Veuillez renseigner tout les champs !";
                echo "<SCRIPT LANGUAGE=\"JavaScript\"> document.location.href=\"./modifierMotdePasse\" </SCRIPT>"; //force la direction


            } elseif (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%.]{6,12}$/', $confirmMdp) || !preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%.]{6,12}$/', $nouveauMdp)) {
                $_SESSION['flash']['erreur'] =
                    "Peut contenir des lettres et des nombres,
                    Doit contenir au moins 1 chiffre et 1 lettre,
                    Peut contenir l'un de ces caractères: !@#$%.,
                    Doit être de 6 à 12 caractères";
                echo "<SCRIPT LANGUAGE=\"JavaScript\"> document.location.href=\"./modifierMotdePasse\" </SCRIPT>"; //force la direction

            } elseif (!password_verify(@$ancienMdp, @$checkUser[0]['password'])) {
                $_SESSION['flash']['erreur'] = "Oups ! Veuillez renseigner votre mdp actuel !";
                echo "<SCRIPT LANGUAGE=\"JavaScript\"> document.location.href=\"./modifierMotdePasse\" </SCRIPT>"; //force la direction

            } elseif ($nouveauMdp !== $confirmMdp) {
                $_SESSION['flash']['erreur'] = "Oups ! Les mdp ne match pas !";
                echo "<SCRIPT LANGUAGE=\"JavaScript\"> document.location.href=\"./modifierMotdePasse\" </SCRIPT>"; //force la direction

            } else {

                // $updateMdp = $model;
                // $updateMdp->setPassword(password_hash($nouveauMdp, PASSWORD_DEFAULT));
                // $model->updateProfil($_SESSION['user']['id_utilisateur'], $updateMdp);
                // $_SESSION['user']['password'] = $model->getPassword();
                // $_SESSION['flash']['sucess'] = "Bravo votre changement a bien été effectué";
                // header('Location: ../profil');
                // exit();

                $passwordHash = password_hash($nouveauMdp, PASSWORD_DEFAULT);
                $password = $passwordHash;
                $updateMdp = $model
                    ->setPassword($passwordHash);
                $model->update($updateMdp, compact('password', 'id_utilisateur'));

                $_SESSION['user']['password'] = $model->getPassword();
                $_SESSION['flash']['sucess'] = "Bravo votre changement a bien été effectué";
                echo "<SCRIPT LANGUAGE=\"JavaScript\"> document.location.href=\"../profil\" </SCRIPT>"; //force la direction

                exit();
            }
        }
    }
}
