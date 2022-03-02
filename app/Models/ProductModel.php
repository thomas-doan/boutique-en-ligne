<?php

namespace App\Models;

use App\Models\Model;
use Database\DBConnection;
use Models\Database;

Class ProductModel extends Model
{
    public $image_article;
    protected $id_article;
    protected $titre_article;
    protected $presentation_article;
    protected $description_article;
    protected $prix_article;
    protected $sku;
    protected $fournisseur;
    protected $conditionnement;

    public function __construct()
    {
        // Spécifie la table à utiliser pour la class Model
        $this->table = 'articles';
        
    }

    /**
     * Renvoit un tableau avec tout les articles 
     * @return array 
     */
    public function get_all_art(): array
    {
        $return = $this->findAll();
        return $return;
    }

    // public function return_col($table)
    // {
    //     return $this->show_column($table);
    // }

    public function insertInterTableCategorieProduct($id_article,$id_cat_categorie,$id_cat_parent )
    {
        $this->bd = Database::getPDO();
        $req = "INSERT INTO `articles_categories_filtre`(`fk_id_article`, `fk_id_cat_categorie`, `id_parent`) VALUES (:fk_id_article,'fk_id_cat_categorie','id_parent')";
        $fk_id_article = int($id_article);
        $fk_id_cat_categorie = int($id_cat_categorie);
        $id_parent = int($id_cat_parent);
        // On exécute la requête 
        return $this->requete($req, compact('fk_id_article','$fk_id_cat_categorie','id_parent'));

    }
}

?>