<?php

namespace App\Models;


class Commentaires extends Model
{
    protected $table = 'commentaires';
    protected $id = "id_commentaire";
    protected $commentaire;
    protected $fk_id_utilisateur;
    protected $fk_id_article;
    protected $signaler;
    protected $date;

    public function getCommentById($id_article)
    {
        $sql =
            "SELECT commentaires.commentaire, utilisateurs.nom, utilisateurs.prenom, commentaires.date
            FROM commentaires
            INNER JOIN utilisateurs ON commentaires.fk_id_utilisateur = utilisateurs.id_utilisateur
            INNER JOIN articles ON commentaires.fk_id_article = articles.id_article
            WHERE articles.id_article = $id_article";
        return $this->requete($sql)->fetchAll();
    }

    /*     public function insertComment($value, $id_utilisateur, $id_article)
    {
        $sql = "INSERT INTO `commentaires`(`commentaire`, `fk_id_utilisateur`, `fk_id_article`) VALUES (:commentaire, :fk_id_utilisateur, :fk_id_article)";
        $commentaire = $value;
        $fk_id_utilisateur = $id_utilisateur;
        $fk_id_article = $id_article;
        return $this->requete($sql, compact('commentaire', 'fk_id_utilisateur', 'fk_id_article'));
    } */

    public function getNumberOfComment($id_article)
    {
        $sql = "SELECT COUNT(commentaire) FROM commentaires WHERE fk_id_article = $id_article";
        return (int)$this->requete($sql)->fetch()['COUNT(commentaire)'];
    }

    /**
     * Get the value of commentaire
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * Set the value of commentaire
     *
     * @return  self
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get the value of fk_id_utilisateur
     */
    public function getFk_id_utilisateur()
    {
        return $this->fk_id_utilisateur;
    }

    /**
     * Set the value of fk_id_utilisateur
     *
     * @return  self
     */
    public function setFk_id_utilisateur($fk_id_utilisateur)
    {
        $this->fk_id_utilisateur = $fk_id_utilisateur;

        return $this;
    }

    /**
     * Get the value of fk_id_article
     */
    public function getFk_id_article()
    {
        return $this->fk_id_article;
    }

    /**
     * Set the value of fk_id_article
     *
     * @return  self
     */
    public function setFk_id_article($fk_id_article)
    {
        $this->fk_id_article = $fk_id_article;

        return $this;
    }

    public function selectCommentwithArticleUser()
    {
        $sql = "SELECT  commentaires.id_commentaire, commentaires.signaler, commentaires.commentaire, utilisateurs.nom, utilisateurs.prenom, utilisateurs.role, articles.titre_article 
    FROM commentaires INNER JOIN utilisateurs ON commentaires.fk_id_utilisateur = utilisateurs.id_utilisateur INNER JOIN articles ON commentaires.fk_id_article = articles.id_article";
        return $this->requete($sql)->fetchAll();
    }

    /**
     * Get the value of signaler
     */
    public function getSignaler()
    {
        return $this->signaler;
    }

    /**
     * Set the value of signaler
     *
     * @return  self
     */
    public function setSignaler($signaler)
    {
        $this->signaler = $signaler;

        return $this;
    }

    /**
     * Get the value of date
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }
}
