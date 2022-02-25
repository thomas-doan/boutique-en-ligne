<?php

namespace App\Controllers;
use App\Models\Model;

class SecurityController extends Model
{

    public function index()
    {
        $id = '12';
        $nom = 'jojo';
        $age = 'mon age';
        $array = [
            'klef1' => 'Jojus',
            'key2' => 'Totus',
        ];
        $testons = compact('id','nom','age','array');
        $test = $this->control($testons);
        return $test;
        
    }
    public function control()
    {
        $array = func_get_args();
        $array = 'mabite';
        $conn = 'moncul';
        foreach ($array as $key => $value){
                // On regarde si le type de string est un nombre entier (int)
                if(ctype_digit($value))
                {
                    $value = intval($value);
                }
                // Pour tous les autres types
                else
                {
                    $value = mysqli_real_escape_string($value);
                    $value = addcslashes($this->db, '%_');
                }
            }
            
            return $array; //On retourne les resultats sous forme de tableau
            
    }
}
?>
<H1>J'y suis</H1>
<?php
$class = new SecurityController();
var_dump($class->index());
?> 