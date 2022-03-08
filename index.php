<?php session_start();

use Exceptions\NotFoundException;

require('vendor/autoload.php');


$router = new AltoRouter();
$router->setBasePath('/boutique-en-ligne');
$router->map('GET|POST', '/', function () {
    $controller = new App\Controllers\MainController();
    $controller->index();
}, 'home');


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
    '/creerarticle/[*:param]',
    function ($param) {
        $controller = new App\Controllers\AdminCreateProductController();
        $controller->CreatProduct($param);
    },
    'creat product'
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
    '/commande/[i:id]',
    function ($id) {
        $controller = new App\Controllers\OrderController();
        $controller->index($id);
        $controller->orderResume();
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
