<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends Controller
{
    protected $model;

    public function index()
    {
        $title = "Profil";
        $model = new UserModel($this->getDB());

        return $this->view('profil.index', compact('title'));
    }

    public function inscription()
    {
        $title = "Inscription";
        return $this->view('profil.inscription', compact('title'));
    }

    public function inscriptionPost()
    {
        $title = "Inscription";
        $model = new UserModel($this->getDB());

        if (isset($_POST['submit'])) {
            $prenom = $_POST['prenom'];
            $nom = $_POST['nom'];
            $email = $_POST['email'];
            $mdp = $_POST['mdp'];
            $mdpConfirm = $_POST['mdpConfirm'];

            $requis = array(
                'prenom',
                'nom',
                'email',
                'mdp',
                'mdpConfirm'
            );

            $erreur = false;
            foreach ($requis as $champs) {
                if (empty($_POST[$champs])) {
                    $erreur = true;
                }
            }

            $checkEmail = $model->findby(['email' => $email]);

            if ($checkEmail == TRUE) {
                $_SESSION['flash']['erreur'] = "Oups ! L'email n'est pas disponible";
                $erreur = true;
            } elseif ($erreur) {
                $_SESSION['flash']['erreur'] = "Oups ! Vous devez remplir tout les champs !";
            } elseif ($mdp != $mdpConfirm) {
                $_SESSION['flash']['erreur'] = "Oups ! Vos mots de passe doivent être similaires !";
            } else {
                $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);

                $user = $model
                    ->setPrenom($prenom)
                    ->setNom($nom)
                    ->setEmail($email)
                    ->setPassword($mdpHash)
                    ->setRole("user");
                $model->create($user);
                var_dump($user);

                $_SESSION['flash']['sucess'] = "Bravo vous êtes à présent inscrit, vous pouvez maintenant vous connectez";
                header('Location: ./connexion');
                exit();
            }
        }

        return $this->view('profil.inscription', compact('title'));
    }

    public function connexion()
    {
        $title = "Connexion";
        return $this->view('profil.connexion', compact('title'));
    }

    public function connexionPost()
    {
        $title = "Connexion";
        $model = new UserModel($this->getDB());

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $mdp = $_POST['mdp'];

            if (empty($email) || empty($mdp)) {
                $_SESSION['flash']['erreur'] = "Oups ! Veuillez remplir tout les champs";
            } else {

                $checkUser = $model->findby(['email' => $email]);
                if (password_verify(@$mdp, @$checkUser[0]['password'])) {
                    $user = $model
                        ->setId_utilisateur((int)$checkUser[0]['id_utilisateur'])
                        ->setPrenom($checkUser[0]['prenom'])
                        ->setNom($checkUser[0]['nom'])
                        ->setEmail($checkUser[0]['email'])
                        ->setPassword($checkUser[0]['password'])
                        ->setRole($checkUser[0]['role']);

                    $_SESSION['id_utilisateur'] = (int)$user->getId_utilisateur();
                    $_SESSION['prenom'] = $user->getPrenom();
                    $_SESSION['nom'] = $user->getNom();
                    $_SESSION['email'] = $user->getEmail();
                    $_SESSION['password'] = $user->getPassword();
                    $_SESSION['role'] = $user->getRole();
                    // var_dump($user);
                    header('Location: ./profil');
                    exit();
                } else {

                    $_SESSION['flash']['erreur'] = "Oups ! Le mot de passe ou l'email est inccorecte";
                }
            }
        }
        return $this->view('profil.connexion', compact('title'));
    }

    public function modifierProfil()
    {
        $title = "Modifier Profil";
        $model = new UserModel($this->getDB());

        return $this->view('profil.modifierProfil', compact('title'));
    }

    public function modifierProfilPost()
    {
        $title = "Modifier Profil";
        $model = new UserModel($this->getDB());

        if (isset($_POST['submit'])) {
            $email = $_POST['email'];
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $user = $model;
            if (empty($email) && empty($nom) && empty($prenom)) {
                $_SESSION['flash']['erreur'] = "Oups ! Il faut renseigner des nouvelles informations !";
            }
            if (empty($email)) {
                $user->setEmail($_SESSION['email']);
            } else {
                $checkEmail = $model->findby(['email' => $email]);
                if ($checkEmail == TRUE) {
                    $_SESSION['flash']['erreur'] = "Oups ! L'email n'est pas disponible";
                    $user->setEmail($_SESSION['email']);
                } else {
                    $user->setEmail($email);
                }
            }

            if (empty($nom)) {
                $user->setNom($_SESSION['nom']);
            } else {
                $user->setNom($nom);
            }
            if (empty($prenom)) {
                $user->setPrenom($_SESSION['prenom']);
            } else {
                $user->setPrenom($prenom);
            }

            $model->updateProfil($_SESSION['id_utilisateur'], $user);
            $_SESSION['prenom'] = $user->getPrenom();
            $_SESSION['nom'] = $user->getNom();
            $_SESSION['email'] = $user->getEmail();
        }
        return $this->view('profil.modifierProfil', compact('title'));
    }

    public function modifierMotdePasse()
    {
        $title = "Modifier mot de Passe";
        $model = new UserModel($this->getDB());

        return $this->view('profil.modifierMotdePasse', compact('title'));
    }

    public function modifierMotdePassePost()
    {
        $title = "Modifier mot de Passe";
        $model = new UserModel($this->getDB());

        if (isset($_POST['submit'])) {
            $ancienMdp = $_POST['ancienMdp'];
            $nouveauMdp = $_POST['nouveauMdp'];
            $confirmMdp = $_POST['confirmMdp'];

            $checkUser = $model->findBy(['id_utilisateur' => $_SESSION['id_utilisateur']]);

            if (empty($ancienMdp) || empty($nouveauMdp) || empty($confirmMdp)) {
                $_SESSION['flash']['erreur'] = "Oups ! Veuillez renseigner tout les champs !";
            } elseif (!password_verify(@$ancienMdp, @$checkUser[0]['password'])) {
                $_SESSION['flash']['erreur'] = "Oups ! Veuillez renseigner votre mdp actuel !";
            } elseif ($nouveauMdp !== $confirmMdp) {
                $_SESSION['flash']['erreur'] = "Oups ! Les mdp ne match pas !";
            } else {
                $updateMdp = $model;
                $updateMdp->setPassword(password_hash($nouveauMdp, PASSWORD_DEFAULT));
                $model->updateProfil($_SESSION['id_utilisateur'], $updateMdp);
                $_SESSION['password'] = $model->getPassword();
                $_SESSION['flash']['sucess'] = "Bravo votre changement a bien été effectué";
                header('Location: ../profil');
                exit();
            }
        }
        return $this->view('profil.modifierMotdePasse', compact('title'));
    }

    public function deconnexion()
    {
        session_destroy();

        return header('Location: /');
    }

    public function adresse()
    {
        $title = "Adresse de livraison";
        return $this->view('profil.adresse', compact('title'));
    }

    public function adressePost(){
        $title = "Modifier mot de Passe";
        $model = new UserModel($this->getDB());
    }

    public function historique()
    {
        $title = "Historique de commande";
        return $this->view('profil.historique', compact('title'));
    }
}
