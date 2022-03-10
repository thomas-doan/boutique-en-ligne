<?php session_start();

use Exceptions\NotFoundException;

require('vendor/autoload.php');


$router = new AltoRouter();
$router->setBasePath('/boutique-en-ligne');
$router->map('GET|POST', '/', function () {
    $controller = new App\Controllers\MainController();
    $controller->index();
}, 'home');


// User
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
        $controller = new App\Controllers\ProfilController();
        $controller->index();
    },
);

$router->map(
    'GET|POST',
    '/profil/modifierMotdePasse',
    function () {
        $controller = new App\Controllers\ModifierPasswordController();
        $controller->index();
        $controller->updatePassword();
    },
);

$router->map(
    'GET|POST',
    '/profil/modifierProfil',
    function () {
        $controller = new App\Controllers\ModifierProfilController();
        $controller->index();
        $controller->updateProfil();
    },
);

$router->map(
    'GET|POST',
    '/profil/adresse',
    function () {
        $controller = new App\Controllers\AdresseController();
        $controller->index();
        $controller->getAdress();
    },
);

$router->map(
    'GET|POST',
    '/profil/adresse/modifierAdresse/[i:id_adresse]',
    function ($id_adresse) {
        $controller = new App\Controllers\ModifierAdresseController();
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
        $controller = new App\Controllers\CreerAdresseController();
        $controller->index();
        $controller->createAdresse();
    },
);

$router->map(
    'GET|POST',
    '/profil/historiqueCommande',
    function () {
        $controller = new App\Controllers\HistoriqueController();
        $controller->index();
        // $controller->getCommande();
    },
);

$router->map(
    'GET|POST',
    '/profil/historiqueCommande/commande/[i:id_commande]',
    function ($id_commande) {
        $controller = new App\Controllers\CommandeController();
        $controller->index($id_commande);

        // $controller->getCommandebyId($id_commande);
    },
);

$router->map(
    'GET',
    '/search',
    function () {
        $controller = new App\Controllers\SearchController();
        $controller->index();
    },
    'search'
);



//ADMIN
$router->map(
    'GET|POST',
    '/admin/creerArticle/[*:param]',
    function ($param) {
        $controller = new App\Controllers\AdminCreateProductController();
        $controller->CreatProduct($param);
    },
    'creat product'
);

$router->map(
    'GET|POST',
    '/admin',
    function () {
        $controller = new App\Controllers\AdminCreateProductController();
        $controller->index();
    },
    'Admin index'
); 

$router->map(
    'GET|POST',
    '/admin/modifierArticle/[*:id_article]',
    function ($id_article) {
        $controller = new App\Controllers\AdminUpdateProductController();
        $controller->index($id_article);
    },
    'update product'
);

$route->map(
    'POST',
    '/admin/restocker',
    function (){
        $controller = new App\Controllers\AdminUpdateSkuController();
        $controller->index();
    }
);
    

// CRUD Category
$router->map(
    'GET',
    '/admin/categorie',
    function () {
        $controller = new App\Controllers\AdminCategoryController();
        $controller->index();
    },

);

$router->map(
    'POST',
    '/admin/categorie',
    function () {
        $controller = new App\Controllers\AdminCategoryController();
        $controller->update();
        $controller->create();
        $controller->delete();
    },

);



//PANIER
$router->map(
    'GET',
    '/panier',
    function () {
        $controller = new App\Controllers\ShoppingCartController();
        $controller->index();
    },
    'panier'
);


//Commande
$router->map(
    'GET/POST',
    '/commande',
    function () {
        $controller = new App\Controllers\OrderController();
        $controller->index();
        $controller->orderResume();
        $controller->adressCheck();
        $controller->getAdress();
        $PaymentComponent = new App\Controllers\Components\PaymentComponent();
        $PaymentComponent->payment();
    },
    'commande'
);


//PANIER


$router->map(
    'POST',
    '/panier',
    function () {
        $controller = new App\Controllers\ShoppingCartController();
        $controller->upValue();
        $controller->downValue();
        $controller->shoppingBag();
        $controller->deleteProduct();
        $controller->singlePrice();
        $controller->totalPrice();
    },
    'panier post'
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
