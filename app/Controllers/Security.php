<?php

namespace App\Controllers;


class Security
{

    
    /**
     * Permet de sécuriser les donner d'entrée venant du client
     * @param mixed Information entrantes (compact()||POST/GET)
     * @return mixed Sortie des même information en verfiiant les chaine de caractère et les intervals
     */
    //Si la varaible à passer est une super global ne pas utilisé la function compact
    // $arguments_methode = compact('id','nom','age','array');
    // $control_donnees = $this->control($arguments_methode);
    // extract($control_donnees);
    public static function control($compact)
    {
        if(is_array($compact))
        {
        foreach ($compact as $key => $value){
                // On regarde si le type de string est un nombre entier (int)
                if(ctype_digit($value))
                {
                    $value = intval($value);
                }
                // Pour tous les autres types
                else
                {
                    $value  = strip_tags($value);
                    $value = htmlentities($value);
                    $value = htmlspecialchars($value);
                }
            }
            
            return $compact; //On retourne les resultats sous forme de tableau
        }
        else
        {
            if(ctype_digit($compact))
            {
                $compact = intval($compact);
            }
            // Pour tous les autres types
            else
            {
                $compact  = strip_tags($compact);
                $compact = htmlentities($compact);
                $compact = htmlspecialchars($compact);
            }
            return $compact;//On retourne le resultat sous forme de int ou String
        }
            
    }
}