<?php

namespace App\Controllers;

use App\Models\Utilisateurs;

class InscriptionController extends Controller
{
    protected $model;

    public function index()
    {
        $title = "Inscription";

        return $this->view('profil.inscription', compact('title'));
    }

    public function SignUp()
    {
        $model = new Utilisateurs();

        if (isset($_POST['submit'])) {
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $question_secrete = $_POST['question_secrete'];
            $reponse = $_POST['reponse'];
            $password = $_POST['mdp'];
            $mdpConfirm = $_POST['mdpConfirm'];

            $requis = array(
                'prenom',
                'nom',
                'email',
                'question_secrete',
                'reponse',
                'mdp',
                'mdpConfirm'
            );

            $erreur = false;
            foreach ($requis as $champs) {
                if (empty($_POST[$champs])) {
                    $erreur = true;
                }
            }
            $argument = ['email'];
            $checkEmail = $model->find($argument, compact('email'));

            if ($checkEmail == TRUE) {
                $_SESSION['flash']['erreur'] = "Oups ! L'email n'est pas disponible";
                header('location: ./inscription');
                $erreur = true;
            } elseif ($erreur) {
                $_SESSION['flash']['erreur'] = "Oups ! Vous devez remplir tout les champs !";
                header('location: ./inscription');
            } elseif ($password != $mdpConfirm) {
                $_SESSION['flash']['erreur'] = "Oups ! Vos mots de passe doivent être similaires !";
                header('location: ./inscription');
            } else {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $reponse = password_hash($reponse, PASSWORD_DEFAULT);
                $role = "Utilisateurs";
                $user = $model
                    ->setEmail($email)
                    ->setPrenom($prenom)
                    ->setNom($nom)
                    ->setPassword($password)
                    ->setQuestion_secrete($question_secrete)
                    ->setReponse($reponse)
                    ->setRole($role);
                $model->create($user, compact('email', 'prenom', 'nom', 'password', 'question_secrete', 'reponse', 'role'));


                $_SESSION['flash']['sucess'] = "Bravo vous êtes à présent inscrit, vous pouvez maintenant vous connectez";
                // header('Location: ./connexion');
                echo "<SCRIPT LANGUAGE=\"JavaScript\"> document.location.href=\"./connexion\" </SCRIPT>"; //force la direction
                exit();
            }
        }
    }
}
