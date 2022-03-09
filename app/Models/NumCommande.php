<?php

namespace App\Models;




class NumCommande extends Model

{
    protected $table = 'num_commande';
    protected $id = 'id_num_commande';
    protected $id_num_commande;
    protected $fk_id_utilisateurs;
    protected $date;
    protected $total_produit;
    protected $tva;
    protected $prix_sans_tva;
    protected $prix_avec_tva;




    public function orderInsert($db, $donnees)
    {

        $req = "
                INSERT INTO num_commande (fk_id_utilisateurs, date, total_produit, prix_sans_tva, prix_avec_tva) VALUE (:fk_id_utilisateurs, NOW(), :total_produit, :prix_sans_tva, :prix_avec_tva)";
        $stmt = $db->prepare($req);
        $stmt->execute(
            $donnees
        );
    }

    public function test($db)
    {
        $req = "SELECT * FROM categories WHERE fezfezfze = 'test'";
        $stmt = $db->prepare($req);
        $stmt->execute();
    }
}
