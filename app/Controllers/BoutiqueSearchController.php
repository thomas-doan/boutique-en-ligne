<?php

namespace App\Controllers;

use App\Models\Search;
use Database\DBConnection;
use App\Controllers\Components\ProductComponent;
use App\Controllers\Components\CategoriesComponent;

class BoutiqueSearchController extends Controller
{
    public $error = array();
    protected $Product;
    protected $Categories;
    protected $search;

    public function __construct()
    {
        $this->Product = new ProductComponent();
        $this->Categories = new CategoriesComponent();
        $this->search = new Search();
    }

    /**
     * Methode d'affichage de la boutique
     * @param string Paramettre obligatoire :
     * -> Si All le paramettre de recherche prend tout les
     * -> Si dosette|moulu|grain alors affiche les resultat assigné à la catégorie principale
     */
    public function index(string $param)
    {
        if($param == 'all'
        || $param == 'dosette'
        || $param == 'moulu'
        || $param == 'grain')
        {
            $title = 'Boutique |'.$param;
        }
        else header('location: ./all');

        if(!empty($_GET['recherche'])){$result = $this->search->find_article($_GET['recherche']);} 
        else $result = $this->Product->getAllProductForUpdate();
        var_dump($result);

        $compact = compact('title'); 
        $this->view('shop.boutique', $compact );
    }

     /**
     * Compte le nombre d'article disponnibles selon se filtre
     * @param string Nom de la categorie à rechercher
     */
    public function countSearch($nameCategories)
    {
        if(!empty($_GET['recherche'])){$result = $this->search->find_article($_GET['recherche']);} 
        else $result = $this->Product->getAllProductForUpdate();
        $result = count($this->Product->selectArrayByValue($result,'cat parent',$nameCategories));
        return $result;
    }

}
