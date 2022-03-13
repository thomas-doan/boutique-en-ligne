<?php session_start();

//Control d'accée à l'url
$urlControlUser=$_SERVER['REQUEST_URI'];
$pathControl = explode('/',$urlControlUser);
if($pathControl[2]=='admin' && $_SESSION['user']['role']!=='Admin')
{
    if(isset($_SESSION['user']))
    {
    // echo 'redirection';
        echo '<SCRIPT LANGUAGE="JavaScript"> document.location.href="'.$pathControl[0].'/'.$pathControl[1].'/profil" </SCRIPT>'; //force la direction
    exit();
    }
    else{
        echo '<SCRIPT LANGUAGE="JavaScript"> document.location.href="'.$pathControl[0].'/'.$pathControl[1].'/connexion" </SCRIPT>'; //force la direction 
    }
}
if($pathControl[2]=='profil' && empty($_SESSION['user']))
{
    echo '<SCRIPT LANGUAGE="JavaScript"> document.location.href="'.$pathControl[0].'/'.$pathControl[1].'/connexion" </SCRIPT>'; //force la direction 
}

use App\Controllers\Security;
use Exceptions\NotFoundException;

require_once 'app/Controllers/Security.php';
//Sécurité de tout les formulaire Get|POST
$securityAll = new Security();
if(isset($_GET))
{
    $securityAll->controlAll($_GET);
}
if(isset($_POST))
{
    $securityAll->controlAll($_POST);
}

require('vendor/autoload.php');



$router = new AltoRouter();
$router->setBasePath('/boutique-en-ligne');
$router->map('GET|POST', '/', function () {
    $controller = new App\Controllers\MainController();
    $controller->index();
}, 'home');


/* ---------------------------- INTERFACE USER ------------------------
---------------------------- INTERFACE USER ------------------------ */

$router->map(
    'GET|POST',
    '/inscription',
    function () {
        $controller = new App\Controllers\InscriptionController();
        $controller->index();
        $controller->SignUp();
    },
);

$router->map(
    'GET|POST',
    '/connexion',
    function () {
        $controller = new App\Controllers\ConnexionController();
        $controller->index();
        $controller->login();
    },
);

$router->map(
    'GET|POST',
    '/profil',
    function () {
        $controller = new App\Controllers\User\ProfilController();
        $controller->index();
    },
);

$router->map(
    'GET|POST',
    '/profil/modifierMotdePasse',
    function () {
        $controller = new App\Controllers\User\ModifierPasswordController();
        $controller->index();
        $controller->updatePassword();
    },
);

$router->map(
    'GET|POST',
    '/profil/modifierProfil',
    function () {
        $controller = new App\Controllers\User\ModifierProfilController();
        $controller->index();
        $controller->updateProfil();
    },
);

$router->map(
    'GET|POST',
    '/profil/adresse',
    function () {
        $controller = new App\Controllers\User\AdresseController();
        $controller->index();
        $controller->getAdress();
    },
);

$router->map(
    'GET|POST',
    '/profil/adresse/modifierAdresse/[i:id_adresse]',
    function ($id_adresse) {
        $controller = new App\Controllers\User\ModifierAdresseController();
        $controller->index($id_adresse);
        $controller->updateAdresse($id_adresse);
        $controller->getAdressebyId($id_adresse);
        $controller->deleteAdresse($id_adresse);
    },
);

$router->map(
    'GET|POST',
    '/profil/adresse/creerAdresse',
    function () {
        $controller = new App\Controllers\User\CreerAdresseController();
        $controller->index();
        $controller->createAdresse();
    },
);

$router->map(
    'GET|POST',
    '/profil/historiqueCommande',
    function () {
        $controller = new App\Controllers\User\HistoriqueController();
        $controller->index();
        // $controller->getCommande();
    },
);

$router->map(
    'GET|POST',
    '/profil/historiqueCommande/commande/[i:id_num_commande]',
    function ($id_num_commande) {
        $controller = new App\Controllers\User\CommandeController();
        $controller->index($id_num_commande);

        // $controller->getCommandebyId($id_commande);
    },
);

/* -----------------------------------------SEARCH BAR--------------------------------------------------------- */





$router->map(
    'GET',
    '/search',
    function () {
        $controller = new App\Controllers\SearchController();
        $controller->index();
    },
    'search'
);

$router->map(
    'GET|POST',
    '/profil/deconnexion',
    function () {
        $controller = new App\Controllers\DeconnexionController();
        $controller->index();
    },
    'deconnexion'
);



/* ----------------------------- PARCOURS ADMIN -----------------------------
----------------------------- PARCOURS ADMIN -----------------------------
----------------------------- PARCOURS ADMIN ----------------------------- */


$router->map(
    'GET|POST',
    '/admin/creerArticle/[*:param]',
    function ($param) {
        $controller = new App\Controllers\admin\AdminCreateProductController();
        $controller->CreatProduct($param);
    },
    'creat product'
);

$router->map(
    'GET|POST',
    '/admin',
    function () {
        $controller = new App\Controllers\admin\AdminCreateProductController();
        $controller->index();
    },
    'Admin index'
);

$router->map(
    'GET|POST',
    '/admin/modifierArticle/[*:id_article]',
    function ($id_article) {
        $controller = new App\Controllers\admin\AdminUpdateProductController();
        $controller->index($id_article);
    },
    'update product'
);

$router->map(
    'GET|POST',
    '/admin/gestiondestock',
    function () {
        $controller = new App\Controllers\admin\AdminUpdateSkuController();
        $controller->index();
    },
    'gestion de stock'
);

$router->map(
    'GET|POST',
    '/admin/gestionUtilisateur/[*:param]',
    function ($param) {
        $controller = new App\Controllers\admin\AdminUpdateUserController();
        $controller->index($param);
        $controller->getUser($param);
        $controller->deleteUser($param);
        $controller->UpdateUser($param);
    }
);


// CRUD Category
$router->map(
    'GET',
    '/admin/categorie',
    function () {
        $controller = new App\Controllers\admin\AdminCategoryController();
        $controller->index();
    },

);

$router->map(
    'POST',
    '/admin/categorie',
    function () {
        $controller = new App\Controllers\admin\AdminCategoryController();
        $controller->update();
        $controller->create();
        $controller->delete();
    },

);


// CRUD Comment
$router->map(
    'GET/POST',
    '/admin/commentaire',
    function () {
        $controller = new App\Controllers\admin\AdminCommentController();
        $controller->update();
        $controller->create();
        $controller->delete();
        $controller->index();
    },

);


$router->map(
    'POST/GET',
    '/admin/tag',
    function () {
        $controller = new App\Controllers\admin\AdminTagController();
        $controller->update();
        $controller->create();
        $controller->delete();
        $controller->index();
    },

);


/* ----------------------------- FIN ADMIN -----------------------------
----------------------------- FIN ADMIN -----------------------------
 */

// PRODUIT
$router->map(
    'GET|POST',
    '/produit/[*:id_article]',
    function ($id_article) {
        $controller = new App\Controllers\ProductController();
        $controller->index($id_article);
        $controller->shoppingBag();
        // $controller->Like($id_article);
        // $controller->addComment($id_article);
    },
);

//SHOP
$router->map(
    'GET|POST',
    '/boutique/[*:param]',
    function ($param) {
        $controller = new App\Controllers\BoutiqueSearchController();
        $controller->index($param);
    }
);


/* ----------------------------- PARCOURS PANIER -----------------------------
----------------------------- PARCOURS PANIER -----------------------------
----------------------------- PARCOURS PANIER ----------------------------- */


//PANIER
// $router->map(
//     'GET/POST',
//     '/panier',
//     function () {
//         $controller = new App\Controllers\ShoppingCartController();

//         $controller->upValue();
//         $controller->downValue();
//         // $controller->shoppingBag();
//         $controller->deleteProduct();
//         $controller->singlePrice();
//         $controller->totalQuantity();
//         $controller->totalPrice();
//         $controller->index();
//     },
//     'panier'
// );

//Commande
$router->map(
    'GET/POST',
    '/commande',
    function () {
        $controller = new App\Controllers\OrderController();
        $controller->index();
        $controller->orderResume();
        $controller->validate();
    },
    'commande'
);



//livraison
$router->map(
    'GET/POST',
    '/livraison',
    function () {
        $controller = new App\Controllers\LivraisonController();
        $controller->index();
        $controller->fieldCheck();
        $controller->adressCheck();
        $controller->getAdress();
    },
    'livraison'
);

//Paiement
$router->map(
    'GET/POST',
    '/paiement',
    function () {
        $controller = new App\Controllers\PaymentController();
        $controller->index();
        $controller->payment();
        $controller->stripe();
    },
    'paiement'
);

$match = $router->match();
if (is_array($match)) {
    if (is_callable($match['target'])) {
        call_user_func_array($match['target'], $match['params']);
    }
}

try {
    $match;
} catch (NotFoundException $e) {
    return $e->error404();
}
