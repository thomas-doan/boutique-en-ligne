<?php

namespace App\Models;

use App\Models\Model;

class CategoriesModel extends Model
{
    protected $id_categorie;
    protected $nom_categorie;
    protected $section;

    public function __construct()
    {
        $this->table = 'categories';
    }

    /**
     * Renvoit un tableau avec les catégories principales
     * @param string Nom de la section sellectionner
     * @return array 
     */
    public function get_categorie(array $criteres): array
    {
        $item = $this->findBy($criteres);
        // $query = $this->model->pdo->prepare("SELECT * FROM `categories` WHERE `section`='$section'");
        // $query->execute();
        // $item = $query->fetchAll(\PDO::FETCH_ASSOC);
        return $item;
    }

    protected function insert_categorie(string $section,string $value)
    {
        $New_cat = new CategoriesModel;
        $New_cat->section = $section;
        $New_cat->nom_categorie = $value;
         $item = $this->create($New_cat);
        // $query = $this->pdo->prepare("INSERT INTO `categories`(`nom_categorie`, `section`) VALUES ('$value','$section')");
        // $query->execute();
        return $item;
    }

    /**
     * Selection la catégorie correspondant à l'idée
     */
    protected function get_name_by_id($id)
    {
        $item = $this->findById(`nom_categorie`,$id);
        // $query = $this->model->pdo->prepare("SELECT `nom_categorie` FROM `categories` WHERE `id_categorie`='$id'");
        // $query->execute();
        // $item = $query->fetch();
        return $item->nom_categorie;
    }
}
?>