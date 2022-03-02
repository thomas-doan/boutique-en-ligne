<?php

namespace App\Controllers\Components;

class Components
{

    public static function test($arg)
    {
        $resultat = 3 + $arg;

        return $resultat;
    }
}
