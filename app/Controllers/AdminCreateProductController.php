<?php

namespace App\Controllers;

use App\Controllers\Components\ProductComponent;
use App\Controllers\Components\CategoriesComponent;

class AdminCreateProductController extends Controller
{
    public $error = array();
    protected $Product;
    protected $Categories;

    public function __construct()
    {
        $this->Product = New ProductComponent;
        $this->Categories = new CategoriesComponent;
    }

    //METHODE D'APPEL ADMIN
    public function index()
    {
        $title = 'Admin';
        // On génére la vue
        $this->view('administrator/index', compact('menu','title'));
    }

    /**
     * Methode destiné
     * @param string Nom de l'étape à laquel il faut se rendre
     */
    public function CreatProduct(string $param)
    {
        //$param et défini selon la redirection du formulaire
        $error = $this->return_error();
        $title = 'Admin | Nouvel Article';
        $this->recover(); //Enregistre les valeurs du formulaire en variable de section
        $this->less_part();//Passe à l'étape suivante selon les conditions d'acceptations

        if($param == 'partie1')//Première partie du formulaire ___ Information dédier à la Table Article
        {
            $Admin_function = new AdminCreateProductController;
            $compact = compact('param','Admin_function','title','error');
        }
        elseif($param == 'partie2')
        {
            $this->Categories->wheneInsertCategories('ajouter_SAVEUR');
            $this->Categories->wheneInsertCategories('ajouter_PROVENENCE');
            $result_request = array(
            'principale'=>$this->Categories->chooseCategoriesBySection(['section'],'PRINCIPALE'),
            'variete' => $this->Categories->chooseCategoriesBySection(['section'],'VARIÉTÉ'),
            'specificite' => $this->Categories->chooseCategoriesBySection(['section'],'SPÉCIFICITÉ'),
            'flavor' => $this->Categories->chooseCategoriesBySection(['section'],'SAVEUR'),
            'strong' => $this->Categories->chooseCategoriesBySection(['section'],'FORCE'),
            'origin' => $this->Categories->chooseCategoriesBySection(['section'], 'PROVENENCE')
            );
            $compact = compact('param','result_request','title','error');
        }
        elseif($param == 'rendu')
        {
            $compact = compact('param','title','error');
        }
        elseif($param == 'upload')
        {   if(
            isset($_SESSION['nouvelarticle']['etape1'])
            && ($this->verify_input($_SESSION['nouvelarticle']['etape1'])===true)
            && !empty($_SESSION['nouvelarticle']['etape2']['PRINCIPALE'])
            && !empty($_SESSION['nouvelarticle']['etape2']['VARIÉTÉ'])
            && !empty($_SESSION['nouvelarticle']['etape2']['FORCE'])
            && !empty($_SESSION['nouvelarticle']['etape2']['PROVENENCE'])
            && !empty($_SESSION['nouvelarticle']['etape2']['SAVEUR'])
            )
            {
                $this->Product->createProduct($_SESSION['nouvelarticle']);
                $this->Categories->insertAllCat(
                    $_SESSION['nouvelarticle']['etape2'],
                    $this->Product->useLastId(),
                    $_SESSION['nouvelarticle']['etape2']['PRINCIPALE'],
                );
                unset($_SESSION['nouvelarticle']);
                $message = 'Félicitation ! Votre article est à présent en ligne';
            }
            $message = 'Félicitation ! Votre article est à présent en ligne';
            $compact = compact('param','message','title','error');
        }
        else $retour = 'Pas de paramettre à effectué';

    
        $this->view('administrator.creerarticle', $compact);
    }

    //METHODE DE CONSTRUCTION
    
     /**
     * Récupère les données information et les traites
     * Envoie l'image dans le dossier associé
     * Affiche le résultat de l'image dans une vignette
     * @param string chemin vers l'image
     * @param string nom de l'image
     */
    public function upload_image(string $name_file, string $chemin = '/boutique-en-ligne/public/assets/pictures/pictures_product/')
    {
        $this->Product->verify_upload($name_file);
        $this->Product->stock_picture($chemin);
        if($this->Product->verify_upload($name_file))
        {
        $_SESSION['nouvelarticle']['image_article'] = $this->Product->image_article;
        }
        if(isset($_SESSION['nouvelarticle']['image_article']))
        {
        $this->Product->screen_result($_SESSION['nouvelarticle']['image_article'],'/boutique-en-ligne/public/assets/pictures/pictures_product/');
        }
        else $this->Product->screen_result();
    }

    /**
     * Enregistrer les information du formulaire dans un variable de session
     */
    public function recover()
    {
        if(!empty($_FILES['image_article']['tpm_name'])&&($_FILES['image_article']['error']==0))
        {
            $_SESSION['nouvelarticle']['image_article'] = $this->image_article;
            
        }
        if(!empty(@$_POST['etape1'] || @$_POST['titre_article']))
        {
            $_SESSION['nouvelarticle']['etape1'] = $_POST;
            unset($_SESSION['nouvelarticle']['etape1']['etape1']);
        }
        elseif(!empty($_POST['etape2']))
        {
            $_SESSION['nouvelarticle']['etape2'] = $_POST;
            unset($_SESSION['nouvelarticle']['etape2']['etape2']);
            unset($_SESSION['nouvelarticle']['etape2']['nom_PROVENENCE']);
            unset($_SESSION['nouvelarticle']['etape2']['nom_SAVEUR']);
        }
        
    }

    /**
     * En Attente d'implementation
     * Permet de renvoyer un message d'erreur à l'utilisateur
     */
    public function return_error()
    {
        if(!empty($this->error))
        {
            foreach($this->error as $catch)
            {
                if($catch != null)
                {
                    return $catch;
                }
            }
            return null;
        }
    }
    /**
     * Retourne les valeurs enregistrer dans la variable de session à selon l'emplacement des value input
     */
    public function coverup_form(string $name)
    {
        if(isset($_SESSION['nouvelarticle']['etape1'][$name])){
            return $_SESSION['nouvelarticle']['etape1'][$name];
        }
        else return null;
    }

    /**
     * Verfie si toute les information son renseigner dans le champs
     * @param array retour de la methode POST|SECTION
     */
    public function verify_input($array)
    {
        foreach($array as $value)
        {
            if($value == null){
                return false;
            }
        }

        return true;
    }
    /**
     * Redirige l'utilisateur si toutes les conditions sont respecté
     * @param array retour de la method POST
     */
    public function less_part()
    {
        if(!empty($_SESSION['nouvelarticle']['etape1']) && $this->verify_input($_SESSION['nouvelarticle']['etape1'])===true && !empty($_POST['etape1']))
        {
            header('location: ./partie2');
        }
        elseif(isset($_SESSION['nouvelarticle']) && ($this->verify_input($_SESSION['nouvelarticle']['etape1'])===true)
        && !empty($_SESSION['nouvelarticle']['etape2']['PRINCIPALE'])
        && !empty($_SESSION['nouvelarticle']['etape2']['VARIÉTÉ'])
        && !empty($_SESSION['nouvelarticle']['etape2']['FORCE'])
        && !empty($_SESSION['nouvelarticle']['etape2']['PROVENENCE'])
        && !empty($_SESSION['nouvelarticle']['etape2']['SAVEUR'])
        && !empty($_POST['etape2']))
        {
            header('location: ./rendu');
        }
    }

}