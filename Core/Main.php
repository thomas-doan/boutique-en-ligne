<?php

namespace App\Core;

use App\Controllers\MainController;

class Main
{
    public function start()
    {
        // 1./ Nettoyage de l'URL
        // Dans un premier temps, on doit retirer le trailling slash(slash de fin) eventuel de l'URL.

        // On récupère l'url.
        $uri = $_SERVER['REQUEST_URI'];

        // On vérifie que uri n'est pas vide et ce termine par un '/'.
        if (!empty($uri) && $uri != "/" && $uri[-1] === "/") {
            // On enléve le '/'.
            $uri = substr($uri, 0, -1);

            // On envoie un code de redirection permanente.
            http_response_code(301);

            // On redirige vers l'URl sans "/" .
            header('location: ' . $uri);
        }

        // 2./ Gestion des paramétres de l'URL
        // Exemple de notre URL: p=controleur/methode/paramètres

        // On sépare les différents paramètres dans un tableau
        $params = [];
        if (isset($_GET['p'])) {
            $params = explode('/', $_GET['p']);
        }

        if ($params[0] != null) {
            // On récuppère le nom du controller à instacier.
            $controller = '\\App\\Controllers\\' . ucfirst(array_shift(($params))) . 'Controller';

            if (!class_exists($controller)) {
                http_response_code(404);
                echo "Le controller n'existe pas, donc la page n'existe pas";
            } else {

                $controller = new $controller;

                // Si on a toujours un paramètre on appelle la methode qui porte son nom, sinon on appelle la methode index().
                $action = (isset($params[0])) ? array_shift(($params)) : 'index';

                // On vérifie si la méthode existe
                if (method_exists($controller, $action)) {
                    // Si il reste des params on les passes à la methode
                    // (isset($params[0])) ? $controller->$action($params) : $controller->$action();
                    (isset($params[0])) ? call_user_func_array([$controller, $action], $params) : $controller->$action();
                } else {
                    http_response_code(404);
                    echo "La methode n'existe pas, donc la page n'existe pas";
                }
            }
        } else {
            // Si on n'a pas de paramètres, on va instancier un controller par default
            $controller = new MainController;
            $controller->index();
        }
    }
}
