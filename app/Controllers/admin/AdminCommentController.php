<?php

namespace App\Controllers\admin;

use App\Controllers\Controller;

use App\Models\Commentaires;
use App\Models\Articles;

class AdminCommentController extends Controller
{

    public function __construct()
    {
        $this->model = new Commentaires();
        $this->modelArticles = new Articles();
    }

    public function index()
    {
        $title = "Admin commentaire - Kawa";

        $comment = $this->model->selectCommentwithArticleUser();
        $articles = $this->modelArticles->findAll();

        $this->view('administrator/comment/index', compact('title', 'comment', 'articles'));
    }

    public function update()
    {
        if (isset($_POST['update_comment'])) {


            if (isset($_POST['comment'])) {

                if (empty($_POST['comment'])) {
                    $_SESSION['flash']['champsvides'] = "Le champ est vide !";
                    header('location: ./commentaire');
                    exit();
                }


                if (!empty($_POST['comment'])) {
                    $id_commentaire = $_POST['id_commentaire'];
                    $commentaire = $_POST['comment'];


                    $modelHydrate = $this->model
                        ->setCommentaire($commentaire);

                    $this->model->update($modelHydrate, compact('id_commentaire', 'commentaire'));
                    $_SESSION['flash']['sucess'] = "Le commentaire est modifié !";
                    header('location: ./commentaire');
                    exit();
                }
            }
        }
    }


    public function create()
    {
        if (isset($_POST['create_comment'])) {

            if (!empty($_POST['id_article']) && !empty($_POST['commentaire'])) {

                $commentaire = $_POST['commentaire'];
                $fk_id_article = $_POST['id_article'];
                $fk_id_utilisateur = $_SESSION['user']['id_utilisateur'];

                $modelHydrate = $this->model
                    ->setCommentaire($commentaire)
                    ->setFk_id_article($fk_id_article)
                    ->setFk_id_utilisateur($fk_id_utilisateur);
                $this->model->create($modelHydrate, compact('commentaire', 'fk_id_article', 'fk_id_utilisateur'));
                $_SESSION['flash']['sucess'] = "Le commentaire est créé !";

                header('location: ./commentaire');
                exit();
            }

            if (empty($_POST['id_article']) || empty($_POST['commentaire'])) {
                $_SESSION['flash']['champsvides'] = "Les champs sont vides !";
                header('location: ./commentaire');
                exit();
            }
        }
    }


    public function delete()
    {
        if (isset($_POST['delete_comment'])) {
            $id_commentaire = $_POST['id_commentaire'];
            $this->model->delete(compact('id_commentaire'));
            $_SESSION['flash']['delete'] = "Le commentaire est supprimé !";
            header('location: ./commentaire');
            exit();
        }
    }
}
