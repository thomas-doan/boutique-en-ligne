<?php

namespace App\Controllers;

use App\Models\ExempleModel;

class ExemplecreateController extends Controller
{

    public function index()
    {

        $exemple = "test creer";


        return $this->view('shop.exemplecreate', compact('exemple'));
    }

    public function createArticle()
    {

        if (isset($_POST['submit'])) {
            $titre_article = "super test";
            $presentation_article = "super test";
            $description_article = "super test";
            $prix_article = 3;
            $image_article = "super test";
            $sku = "super test";
            $fournisseur = "super test";
            $conditionnement = "super test";


            $model = new ExempleModel($this->getDB());
            $model_Article = $model
                ->setTitre_article($titre_article)
                ->setPresentation_article($presentation_article)
                ->setDescription_article($description_article)
                ->setPrix_article($prix_article)
                ->setImage_article($image_article)
                ->setSku($sku)
                ->setFournisseur($fournisseur)
                ->setConditionnement($conditionnement);



            $execute = $model->create($model_Article, compact('titre_article', 'presentation_article', 'description_article', 'prix_article', 'image_article', 'sku', 'fournisseur', 'conditionnement'));
        }
    }
}
