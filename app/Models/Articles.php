<?php

namespace App\Models;

use Database\DBConnection;


class Articles extends Model

{
    protected $table = 'articles';
    protected $id = 'id_article';
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


    public function upValue($id, $augmenter)
    {
        $req = "UPDATE articles SET sku = sku + :augmenter  WHERE id_article = :id_article";
        $stmt = $this->pdo->prepare($req);
        $stmt->execute(array(
            ":id_article" => $id,
            ":augmenter" => $augmenter
        ));
    }


    public function downValue($id, $diminuer)
    {
        $req = "UPDATE articles SET sku = sku - :diminuer WHERE id_article =:id_article";
        $stmt = $this->pdo->prepare($req);
        $stmt->execute(array(
            ":id_article" => $id,
            ":diminuer" => $diminuer
        ));
    }
}
