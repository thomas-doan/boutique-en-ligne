<?php

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
