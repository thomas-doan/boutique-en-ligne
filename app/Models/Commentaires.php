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
            "SELECT c.commentaire, c.signaler, u.nom, u.prenom, c.date,c.id_commentaire, rep.fk_id_commentaire FROM commentaires as c 
            LEFT JOIN utilisateurs as u ON c.fk_id_utilisateur = u.id_utilisateur 
            LEFT JOIN articles as art ON c.fk_id_article = art.id_article 
            LEFT JOIN reponse_com as rep ON rep.fk_id_commentaire = c.id_commentaire 
            LEFT JOIN utilisateurs u2 ON rep.fk_id_utilisateur = u2.id_utilisateur
             WHERE art.id_article =  $id_article GROUP BY c.id_commentaire
            ";


        return $this->requete($sql)->fetchAll();
    }

    public function getAnswerById($id_article)
    {
        $sql =
            "SELECT  rep.commentaire as reponse_assoc, rep.fk_id_commentaire , u2.nom as reponse_nom, u2.prenom as reponse_prenom, rep.date as reponse_date, rep.signaler
            FROM commentaires as c
            INNER JOIN utilisateurs as u ON c.fk_id_utilisateur = u.id_utilisateur
            INNER JOIN articles as art ON c.fk_id_article = art.id_article
            INNER JOIN reponse_com as rep ON rep.fk_id_commentaire = c.id_commentaire
            INNER JOIN utilisateurs u2 ON rep.fk_id_utilisateur = u2.id_utilisateur
            WHERE art.id_article = $id_article";


        return $this->requete($sql)->fetchAll();
    }



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
        $sql = "SELECT  commentaires.id_commentaire, commentaires.signaler, commentaires.commentaire,
         utilisateurs.nom, utilisateurs.prenom, utilisateurs.role, articles.titre_article, commentaires.date
    FROM commentaires INNER JOIN utilisateurs ON commentaires.fk_id_utilisateur = utilisateurs.id_utilisateur INNER JOIN articles ON commentaires.fk_id_article = articles.id_article";
        return $this->requete($sql)->fetchAll();
    }

    public function selectAnswerCommentwithArticleUser()
    {
        $sql = "SELECT  reponse_com.fk_id_utilisateur, reponse_com.signaler, reponse_com.commentaire, reponse_com.date, reponse_com.id_reponse_com,
         utilisateurs.nom, utilisateurs.prenom, utilisateurs.role, commentaires.commentaire AS reponse_au_com
    FROM reponse_com INNER JOIN utilisateurs ON reponse_com.fk_id_utilisateur = utilisateurs.id_utilisateur INNER JOIN commentaires ON commentaires.id_commentaire = reponse_com.fk_id_commentaire";
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
