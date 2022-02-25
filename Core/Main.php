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
        if (!empty($uri) && $uri != "/" && $uri[-1] === "/" || (strpos($uri,'?')!=false)) {
            // On enléve le '/'.
            if(!empty($uri) && $uri != "/" && $uri[-1] === "/")
            {
            $uri = substr($uri, 0, -1);
            }

            $uri = str_replace('?','&',$uri);
            $test_uri = explode('&',$uri);
            $uri2 = array_shift(($test_uri));
            if(is_array($test_uri))
            {
                for ($i=0; $i <= count($test_uri) ; $i++) { 
                    $key_get = explode('=',$test_uri[$i])[0];
                    $count_oc_keys = substr_count($uri,'&'.$key_get.'=');
                    if($count_oc_keys > 1){
                        $stop = '&'.$test_uri[$i];
                        // $front_uri = mb_stristr($uri,$stop,false);
                        // $front_uri = mb_stristr($front_uri,$key_get,false);
                        unset($test_uri[$i]);
                        $new_uri = explode($key_get,$uri);
                        $and2_uri = '';
                        foreach($test_uri as $value)
                        {
                            $and2_uri .= '&'.$value;
                        }
                        $uri = $uri2.$and2_uri;
                        //'&'.$key_get.array_pop(($new_uri))
                        // $uri = $new_uri[0].$new_uri[1];
                        break 1;                      
                    }
                }
                
            }
            

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
                // if(strpos($action,'?')!=false)
                // {
                //     $explode_action = explode('?',$action);
                //     $action = $explode_action[0];
                //     $get = '&'.$explode_action[1];

                // }
                
                // On vérifie si la méthode existe
                if (method_exists($controller, $action)) {
                    // Si il reste des params on les passes à la methode
                    // (isset($params[0])) ? $controller->$action($params) : $controller->$action();
                    (isset($params[0])) ? call_user_func_array([$controller, $action], $params) : $controller->$action();
                } else {
                    http_response_code(404);
                   
                }
            }
        } else {
            // Si on n'a pas de paramètres, on va instancier un controller par default
            $controller = new MainController;
            $controller->index();
        }
    }
}
