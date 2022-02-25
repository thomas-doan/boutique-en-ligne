<?php

namespace App\Models;

use App\Models\Model;

Class ArticlesModel extends Model
{
    protected $id_article;
    protected $titre_article;
    protected $presentation_article;
    protected $description_article;
    protected $prix_article;
    protected $image_article;
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

    public function return_col($table)
    {
        return $this->show_column($table);
    }
}
?>