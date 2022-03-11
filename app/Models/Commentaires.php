<?php

namespace App\Models;


class Commentaires extends Model
{
    protected $table = 'commentaires';
    protected $id = "id_commentaire";
    protected $commentaire;
    protected $fk_id_utilisateur;
    protected $fk_id_article;

    public function getCommentById($id_article)
    {
        $sql =
            "SELECT commentaires.commentaire, utilisateurs.nom, utilisateurs.prenom
            FROM commentaires
            INNER JOIN utilisateurs ON commentaires.fk_id_utilisateur = utilisateurs.id_utilisateur
            INNER JOIN articles ON commentaires.fk_id_article = articles.id_article
            WHERE articles.id_article = $id_article";
        return $this->requete($sql)->fetchAll();
    }

    public function insertComment($value, $id_utilisateur, $id_article)
    {
        $sql = "INSERT INTO `commentaires`(`commentaire`, `fk_id_utilisateur`, `fk_id_article`) VALUES (:commentaire, :fk_id_utilisateur, :fk_id_article)";
        $commentaire = $value;
        $fk_id_utilisateur = $id_utilisateur;
        $fk_id_article = $id_article;
        return $this->requete($sql, compact('commentaire', 'fk_id_utilisateur', 'fk_id_article'));
    }

    public function getNumberOfComment($id_article)
    {
        $sql = "SELECT COUNT(commentaire) FROM commentaires WHERE fk_id_article = $id_article";
        return (int)$this->requete($sql)->fetch()['COUNT(commentaire)'];
    }
}
