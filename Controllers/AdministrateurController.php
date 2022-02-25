<?php

namespace App\Controllers;

use App\Models\ArticleModel;
use App\Controllers\ArticlesController;

class AdministrateurController extends Controller
{
    public $error = array();

    protected $article;
    protected $categories;
    public function __construct()
    {
        $this->article = New ArticlesController;
        $this->categories = new CategoriesController;
    }
    //METHODE D'APPEL ADMIN
    public function index()
    {
        $title = 'Admin';
        // On génére la vue
        $this->render('administrateur/index', compact('menu','title'));
    }

    /**
     * Methode destiné
     * @param string Nom de l'étape à laquel il faut se rendre
     */
    public function CreationArticles(string $param)
    {
        $error = $this->return_error();
        $title = 'Admin | Nouvel Article';
        $this->recover();
        var_dump($this->article->select_col_table('articles'));

        if($param == 'partie1')
        {
            $url_action = $this->call_step_one();
            $Admin_function = new AdministrateurController;
            $compact = compact('param','url_action','Admin_function','title','error');
        }
        elseif($param == 'partie2')
        {
            // $retour = $this->call_step_two();
            $this->categories->when_insert_categorie('ajouter_SAVEUR');
            $this->categories->when_insert_categorie('ajouter_PROVENENCE');
            $result_request = array(
            'variete' => $this->categories->get_categorie(['section'=>'VARIÉTÉ']),
            'specificite' => $this->categories->get_categorie(['section'=>'SPÉCIFICITÉ']),
            'flavor' => $this->categories->get_categorie(['section'=>'SAVEUR']),
            'strong' => $this->categories->get_categorie(['section'=>'FORCE']),
            'origin' => $this->categories->get_categorie(['section' => 'PROVENENCE'])
            );
            $compact = compact('param','result_request','title','error');
        }
        elseif($param == 'rendu')
        {
            $retour = $this->call_step_visibility();
        }
        elseif($param == 'upload')
        {
            $retour = 'Construire l\'envoie';
        }
        else $retour = 'Pas de paramettre à effectué';

    
        $this->render('administrateur/creationarticles', $compact);
    }


    //METHODE DE CONSTRUCTION
    
     /**
     * Récupère les données information et les traites
     * Envoie l'image dans le dossier associé
     * Affiche le résultat de l'image dans une vignette
     * @param string chemin vers l'image
     * @param string nom de l'image
     */
    public function upload_image(?string $chemin = '../../assets/images/', string $name_file)
    {
        $this->article->verify_upload($name_file);
        $this->article->stock_picture($chemin);
        if($this->article->verify_upload($name_file))
        {
        $_SESSION['nouvelarticle']['image_article'] = $this->article->image_article;
        }
        if(isset($_SESSION['nouvelarticle']['image_article']))
        {
        $this->article->screen_result('../../assets/images/', $_SESSION['nouvelarticle']['image_article']);
        }
        else $this->article->screen_result();
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
        }
        elseif(!empty($_POST['etape2']))
        {
            $_SESSION['nouvelarticle']['etape2'] = $_POST;
        }
        
    }

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
     * Retourne la valeur disponnible dans la variable de session dans l'input associé
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
     * @param array retour de la method POST
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
     * Redirige si toutes les information sont justes
     * @param array retour de la method POST
     */
    public function less_part()
    {
        if(!empty($_SESSION['nouvelarticle']['etape1']) && $this->verify_input($_SESSION['nouvelarticle']['etape1'])===true && !empty($_POST['etape1']))
        {
            header('location: http://localhost/Administrateur/CreationArticles/Partie2');
        }
        elseif(!empty($_SESSION['nouvelarticle']['etape1']) && !empty($_POST['etape2']))
        {
            header('location: http://localhost/Administrateur/CreationArticles/Rendu');
        }
    }

    /**
     * Affiche le formulaire si le GET correpsond à cette étape
     * 
     */
    public function call_step_one()
    {
            $url_action ="";

            if(!empty($_POST['etape1']))
            {
                if($this->verify_input($_POST)===false)
                {
                    $this->error = array('Etape 1' => 'Oups ! Tout les champs doivent être remplis');
                    $url_action ="";
                }
                else $url_action ="../../administrateur/creationarticles/partie2";
            }
            
        return $url_action;
    }

    /**
     * Appelle l'étape 2
     */
    public function call_step_two()
    {
            ?>
            <form action="http://localhost/Administrateur/CreationArticles/Partie2" method="post">
            <?php
                $this->categories->choose_primary_categories();
                $this->categories->choose_variety();
                $this->categories->choose_strong();
                $this->categories->choose_flavor();
                $this->categories->choose_provence();
                $this->categories->when_insert_categorie('ajouter_SAVEUR');
                $this->categories->when_insert_categorie('ajouter_PROVENENCE');
            ?>
                <input type="submit" name="etape2" value="Visualiser le résultat">
            </form>
            <?php
    }

    /**
     * Appel l'étape de visualisation
     */
    public function call_step_visibility()
    {
        if($_GET['nouvelarticle']== 'Rendu')
        {
        
        ?>
            <article>
                <div>
                    <h3><?=$_SESSION['nouvelarticle']['etape1']['titre_article']?></h3>
                    <p><?=$_SESSION['nouvelarticle']['etape1']['prix_article']?>€</p>
                </div>
                <div>
                    <img src="../../assets/images/<?=$_SESSION['nouvelarticle']['image_article']?>" alt="image de l'article">
                    <div>
                        <h4><?=$_SESSION['nouvelarticle']['etape1']['presentation_article']?></h4>
                        <p><?=$_SESSION['nouvelarticle']['etape1']['description_article']?></p>
                        <?=$this->categories->print_all_cat($_SESSION['nouvelarticle']['etape2'])?>
                    </div>
                </div>
            </article>
            <div>
                <a href="http://localhost/Administrateur/CreationArticles/Partie1">Modifier les informations principales</a>
                <a href="http://localhost/Administrateur/CreationArticles/Partie2">Modifier les attribues de catégories</a>
                <a href="http://localhost/Administrateur/CreationArticles/Upload">Mettre l'article en ligne</a>
            </div>
        <?php
        }
    }
}