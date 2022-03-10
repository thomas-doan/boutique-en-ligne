<?php

namespace App\Controllers;

use App\Models\Categories;
use App\Models\Product;
use App\Models\Commentaires;
use App\Models\Like;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->Comments = new Commentaires;
        $this->Product = New Product;
        $this->Categories = New Categories;
        $this->Like = new Like;
    }

    public function index($id_article)
    {
        $title = "Produit";
        $comments = $this->Comments->getCommentbyId($id_article);
        $numberOfComment = $this->NumberComment($id_article);
        $product = $this->getProductById($id_article);
        $likes = $this->getLike($id_article);
        $CatOfProduct = array(
            'variete' => $this->Categories->getSectionCatByIdProduct($id_article,'VARIÉTÉ'),
            'specificite' => $this->Categories->getSectionCatByIdProduct($id_article,'SPÉCIFICITÉ'),
            'flavor' => $this->Categories->getSectionCatByIdProduct($id_article,'SAVEUR'),
            'strong' => $this->Categories->getSectionCatByIdProduct($id_article,'FORCE'),
            'origin' => $this->Categories->getSectionCatByIdProduct($id_article, 'PROVENENCE')
            );
        $this->addComment($id_article);

        return $this->view('shop.produit', compact('title', 'comments', 'product', 'CatOfProduct', 'likes', 'numberOfComment'));
    }

    public function getProductById($id_article){
        $result = $this->Product->find(['id_article'], compact('id_article'));
        return $result;
    }

    public function getCatByIdProduct($id_article){
        $result = $this->Categories->getSectionCatByIdProduct($id_article);
        return $result;
    }

    public function addComment($id_article){
        if(isset($_POST['submit'])){
            $author= $_SESSION['id_utilisateur'];
            $content= $_POST['com'];
            if (!$content) {
                $_SESSION['flash']['sucess'] = "Il faut écrire du contenu pour laisser un commentaire :)";
                header("Refresh:0");
                exit();
            } else {
                $this->Comments->insertComment($content, $author,$id_article);
                header("Refresh:0");
                exit();
            }
        }
    }

    public function NumberComment($id_article){
        $result = $this->Comments->getNumberOfComment($id_article);
        return $result;
    }

    public function getLike($id_article)
    {
        $result = $this->Like->getLikeByArticle($id_article);
        return $result;
    }

    public function Like($id_article)
    {
        $argument = ['id_utilisateur'];
        $fk_id_utilisateur = $_SESSION['id_utilisateur'];
        $fk_id_article = $id_article;
        $checkLike = $this->Like->getLike($fk_id_utilisateur);
        
        if(isset($_POST['like']))
        {
            if($checkLike == false)
            {
                $this->Like->insertLike($id_article, $fk_id_utilisateur);
                header("Refresh:0");
            } else {
                $this->Like->deleteLike($id_article, $fk_id_utilisateur);
                header("Refresh:0");   
            }
        }
    }

}