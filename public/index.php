<?php
// session_start();

use Router\Router;
use App\Exceptions\NotFoundException;

require '../vendor/autoload.php';

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);
define('DB_NAME', 'kawa');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PWD', '');

$router = new Router($_GET['url']);




// Profil
$router->get('/profil', 'App\Controllers\UserController@index');

$router->get('/profil/modifierProfil', 'App\Controllers\UserController@modifierProfil');
$router->post('/profil/modifierProfil', 'App\Controllers\UserController@modifierProfilPost');
$router->get('/profil/modifierMotdePasse', 'App\Controllers\UserController@modifierMotdePasse');
$router->post('/profil/modifierMotdePasse', 'App\Controllers\UserController@modifierMotdePassePost');
$router->get('/profil/adresse', 'App\Controllers\UserController@adresse');
$router->post('/profil/adresse', 'App\Controllers\UserController@adressePost');
$router->get('/profil/historique', 'App\Controllers\UserController@historique');
$router->get('/inscription', 'App\Controllers\UserController@inscription');
$router->post('/inscription', 'App\Controllers\UserController@inscriptionPost');
$router->get('/connexion', 'App\Controllers\UserController@connexion');
$router->post('/connexion', 'App\Controllers\UserController@connexionPost');
$router->get('/logout', 'App\Controllers\UserController@deconnexion');


$router->get('/', 'App\Controllers\MainController@index');
$router->get('/exemple', 'App\Controllers\ExempleController@index');

/* passage d'un parametre a recupérer en argument de methode */

$router->get('/exempleid/:id', 'App\Controllers\ExempleidController@index');


/* $router->get('/posts', 'App\Controllers\BlogController@index');
$router->get('/posts/:id', 'App\Controllers\BlogController@show');
$router->get('/tags/:id', 'App\Controllers\BlogController@tag');

$router->get('/login', 'App\Controllers\UserController@login');
$router->post('/login', 'App\Controllers\UserController@loginPost');
$router->get('/logout', 'App\Controllers\UserController@logout');

$router->get('/admin/posts', 'App\Controllers\Admin\PostController@index');
$router->get('/admin/posts/create', 'App\Controllers\Admin\PostController@create');
$router->post('/admin/posts/create', 'App\Controllers\Admin\PostController@createPost');
$router->post('/admin/posts/delete/:id', 'App\Controllers\Admin\PostController@destroy');
$router->get('/admin/posts/edit/:id', 'App\Controllers\Admin\PostController@edit');
$router->post('/admin/posts/edit/:id', 'App\Controllers\Admin\PostController@update');
 */
try {
    $router->run();
    var_dump($_SESSION);
} catch (NotFoundException $e) {
    return $e->error404();
}
