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

$match = $router->match();
if (is_array($match)) {
    if (is_callable($match['target'])) {
        call_user_func_array($match['target'], $match['params']);
    }
}

//PANIER
$router->map(
    'GET',
    '/panier',
    function () {
        $controller = new App\Controllers\shoppingCartController();
        $controller->index();
    },
    'panier'
);

$router->map(
    'POST',
    '/panier',
    function () {
        $controller = new App\Controllers\shoppingCartController();
        $controller->upValue();
        $controller->downValue();
        $controller->shoppingBag();
        $controller->deleteProduct();
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