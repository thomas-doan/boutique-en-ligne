<?php

namespace App\Controllers;

use App\Models\Search;
use Database\DBConnection;
use App\Controllers\Components\CardCompenent;
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
        $this->error;
    }

    /**
     * Methode d'affichage de la boutique
     * @param string Paramettre obligatoire :
     * -> Si All le paramettre de recherche prend tout les
     * -> Si dosette|moulu|grain alors affiche les resultat assigné à la catégorie principale
     */
    public function index(string $param)
    {
        /**
         * On redirige l'utilisateur si la valeur entrer dans l'url ne coresspond à aucun
         * élément attendue dans $param.
         */
        if($param == 'all'
        || $param == 'Dosette'
        || $param == 'Moulu'
        || $param == 'Grain')
        {
            $title = 'Boutique |'.$param;
        }
        else header('location: ./all');


        $result = $this->mergeCattoProduct();
        if($param !== 'all')
        {
            $result = $this->Product->selectArrayByValue($result,'cat parent', $param);
        }
        
        if(!empty($_POST['deletFilter']))
        {
            $deleteValue = explode('-',$_POST['deletFilter']);
            if(count($deleteValue)==3)
            {
                unset($_SESSION['filter'][$deleteValue[0]][$deleteValue[1]]);
            }
            else unset($_SESSION['filter'][$deleteValue[0]]);
        }
        if(!empty($_POST['filtre']))
        {
            $_SESSION['filter']=$_POST;
            unset($_SESSION['filter']['filtre']);
            $resultFilter = $_SESSION['filter'];
            $result = $this->gestionFilter($result);
        }
        elseif(!empty($_SESSION['filter']))
        {
            $resultFilter = $_SESSION['filter'];
            $result = $this->gestionFilter($result);
        }
        else $resultFilter = null;

        $card = new CardCompenent();

        
        $result_request = array(
            'principale'=>$this->Categories->chooseCategoriesBySection(['section'],'PRINCIPALE'),
            'variete' => $this->Categories->chooseCategoriesBySection(['section'],'VARIÉTÉ'),
            'specificite' => $this->Categories->chooseCategoriesBySection(['section'],'SPÉCIFICITÉ'),
            'flavor' => $this->Categories->chooseCategoriesBySection(['section'],'SAVEUR'),
            'strong' => $this->Categories->chooseCategoriesBySection(['section'],'FORCE'),
            'origin' => $this->Categories->chooseCategoriesBySection(['section'], 'PROVENENCE')
            );

            $erreur = $this->error;

        $compact = compact('title','result_request','resultFilter','erreur','result','card'); 
        $this->view('shop.boutique', $compact );
    }

     /**
     * Compte le nombre d'article disponnibles selon se filtre
     * @param string Nom de la categorie à rechercher
     */
    public function countSearch($nameCategories)
    {
        if(!empty($_GET['recherche'])){$result = $this->search->find_article($_GET['recherche']);} 
        else $result = $this->Product->getAllProductForCard();
        $result = count($this->Product->selectArrayByValue($result,'cat parent',$nameCategories));
        return $result;
    }

    public function mergeCattoProduct()
    {
        if(!empty($_GET['recherche'])){$result = $this->search->find_article($_GET['recherche']);} 
        else $result = $this->Product->getAllProductForCard();
        $i=0;
        while(isset($result[$i]))
        {
            $categories = $this->Categories->getSectionCatByIdProduct($result[$i]['id_article']);
            $k = 0;
            $j = 0;
            foreach($categories as $key => $value)
            {
                if($value['section']=='PROVENENCE')
                {
                    $result[$i]['PROVENENCE'] = $value['nom_categorie'];    
                }
                elseif($value['section']=='SPÉCIFICITÉ')
                {
                    $result[$i]['SPÉCIFICITÉ'][$j]= $value['nom_categorie'];
                    $j++;
                }
                elseif($value['section']=='FORCE')
                {
                    $result[$i]['FORCE'] = $value['nom_categorie'];
                }
                elseif($value['section']=='VARIÉTÉ')
                {
                    $result[$i]['VARIÉTÉ'] = $value['nom_categorie'];
                }
                elseif($value['section']=='SAVEUR')
                {
 
                        $result[$i]['SAVEUR'][$k] = $value['nom_categorie'];

                    $k++;
                }
            }

            $i++;
        }

        return($result);
    }

    public function gestionFilter(array $result)
    {
            var_dump($_SESSION['filter']);
            if(isset($_SESSION['filter']['VARIÉTÉ'])&& count($result)>=1)
            {
            $result = $this->Product->selectArrayByValue($result,'VARIÉTÉ', $_SESSION['filter']['VARIÉTÉ']);
            }
            if(isset($_SESSION['filter']['SPÉCIFICITÉ'])&& count($result)>=1)
            {
                foreach($_SESSION['filter']['SPÉCIFICITÉ'] as $value)
                {
                    if(count($result)<1)
                    {
                        return $result;
                    }
                    else
                    {
                        $return = $this->Product->selectArrayByValue($result,'SPÉCIFICITÉ', $value);
                        if(!empty($return))
                        {
                        $result = $return;
                        }
                        else
                        {
                            $this->error = "Le filtre de la spécificité ".$value." n'a pus aboutir à un resultat, nous vous proposons cependant les articles suivant :";
                            return $result;
                        }
                    }
                }
            }
            if(isset($_SESSION['filter']['SAVEUR'])&& count($result)>=1)
            {
                foreach($_SESSION['filter']['SAVEUR'] as $value)
                {
                    if(count($result)<1)
                    {
                        return $result;
                    }
                    else
                    {
                        $return = $this->Product->selectArrayByValue($result,'SAVEUR', $value);
                        if(!empty($return))
                        {
                        $result = $return;
                        }
                        else
                        {
                            $this->error = "Le filtre de la saveur ".$value." n'a pus aboutir à un resultat, nous vous proposons cependant les articles suivant :";
                            return $result;
                        }
                        
                    }
                }
            }
            if(isset($_SESSION['filter']['FORCE']) && count($result)>=1)
            {
                $return = $this->Product->selectArrayByValue($result,'FORCE', $_SESSION['filter']['FORCE']);
                if(!empty($return))
                {
                $result = $return;
                }
                else
                {
                    $this->error = "Le filtre de la force ".$_SESSION['filter']['FORCE']." n'a pus aboutir à un resultat, nous vous proposons cependant les articles suivant :";
                    return $result;
                }
            }
          
            if(isset($_SESSION['filter']['PROVENENCE'])&& count($result)>=1)
            {
                $return = $this->Product->selectArrayByValue($result,'PROVENENCE', $_SESSION['filter']['PROVENENCE']);
                if(!empty($return))
                {
                $result = $return;
                }
                else
                {
                    $this->error = "Le filtre de la provenence".$_SESSION['filter']['PROVENENCE']." n'a pus aboutir à un resultat, nous vous proposons cependant les articles suivant :";
                    return $result;
                }
            }

            return $result;
    }
}
