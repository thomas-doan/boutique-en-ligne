<?php

namespace App\Models;

use App\Models\Model;
use Database\DBConnection;


class Categories extends Model
{
    protected $id = "id_categorie";
    protected $id_categorie;
    protected $nom_categorie;
    protected $section;

    public function __construct()
    {
        $this->table = 'categories';
        $this->db = DBConnection::getPDO();
    }

    /**
     * Renvoit un tableau avec les catégories principales
     * @param string Nom de la section sellectionner
     * @return array 
     */
    public function get_categorie(array $criteres, array $data, ?array $filters = null): array
    {

        $item = $this->find($criteres, compact('titre_article', 'prix_article'));

        return $item;
    }

    public function insertInterTableCategorieProduct($id_product, $id_cat_categorie, $id_cat_parent)
    {
        $req = "INSERT INTO `articles_categories_filtre`(`fk_id_article`, `fk_id_cat_categorie`, `id_parent`) VALUES (:fk_id_article,:fk_id_cat_categorie,:id_parent)";
        $fk_id_article = (int) $id_product;
        $fk_id_cat_categorie = (int) $id_cat_categorie;
        $id_parent = (int)$id_cat_parent;
        // On exécute la requête 
        return $this->requete($req, compact('fk_id_article', 'fk_id_cat_categorie', 'id_parent'));
    }

    /**
     * Get the value of id_categorie
     */
    public function getId_categorie()
    {
        return $this->id_categorie;
    }

    /**
     * Set the value of id_categorie
     *
     * @return  self
     */
    public function setId_categorie($id_categorie)
    {
        $this->id_categorie = $id_categorie;

        return $this;
    }

    /**
     * Get the value of nom_categorie
     */
    public function getNom_categorie()
    {
        return $this->nom_categorie;
    }

    /**
     * Set the value of nom_categorie
     *
     * @return  self
     */
    public function setNom_categorie($nom_categorie)
    {
        $this->nom_categorie = $nom_categorie;

        return $this;
    }

    /**
     * Get the value of section
     */
    public function getSection()
    {
        return $this->section;
    }

    /**
     * Set the value of section
     *
     * @return  self
     */
    public function setSection($section)
    {
        $this->section = $section;

        return $this;
    }
}
