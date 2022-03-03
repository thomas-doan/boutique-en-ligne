<?php

namespace Models;

class Renderer
{

    //render('users/profil')
    public  static function render(string $path, array $variable = [])
    {

        extract($variable); // Importe les variables dans la table des symboles
        ob_start();
        require('public/templates/' . $path . '.php');
        $pageContent = ob_get_clean();
        require('public/templates/layout.html.php');
    }
}
