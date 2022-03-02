<?php

namespace App\Models;

use Database\DBConnection;


class Articles extends Model

{

    public function test()
    {

        //requete sql
        $req = "SELECT * FROM utilisateurs";
        $stmt = $this->db->prepare($req);
        $stmt->execute();
        $resultat = $stmt->fetch(\PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }


    protected $table = 'articles';
    protected $id = 'id_article';
}
