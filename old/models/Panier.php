<?php

namespace Models;


class Panier extends Model
{

    //retourne les infos de lutilisateur choisis
    public function findArticle()
    {


        $query = $this->pdo->prepare("SELECT * FROM produits");
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $query->execute();
        $article = $query->fetchall();

        return $article;
    }

    public function findProduit($nom)
    {


        $query = $this->pdo->prepare("SELECT * FROM produits WHERE nom = :nom");
        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $query->execute(array(
            ":nom" => $nom,
        ));
        $article = $query->fetchall();

        return $article;
    }

    //retourne les infos de lutilisateur choisis
    public function augmenterValeur($id, $augmenter)
    {
        $req = "UPDATE produits SET quantite = quantite + :augmenter  WHERE id =:id";
        $stmt = $this->pdo->prepare($req);
        $stmt->execute(array(
            ":id" => $id,
            ":augmenter" => $augmenter
        ));
    }


    public function diminuerValeur($id, $diminuer)
    {
        $req = "UPDATE produits SET quantite = quantite - :diminuer WHERE id =:id";
        $stmt = $this->pdo->prepare($req);
        $stmt->execute(array(
            ":id" => $id,
            ":diminuer" => $diminuer
        ));
    }
}
