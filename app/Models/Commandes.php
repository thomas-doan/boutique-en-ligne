<?php

namespace App\Models;

use PDO;

class Commandes extends Model
{
    protected $table = 'commandes';
    protected $id = "id_commande";
    protected $id_commande;
    protected $etat_commande;
    protected $prix_commande;
    protected $num_commande;
    protected $prix_total;
    protected $date_commande;
    protected $fk_id_utilisateur;
    protected $fk_id_article;
    protected $nb_article;

    /**
     * Get the value of id_commande
     */
    public function getId_commande()
    {
        return $this->id_commande;
    }

    /**
     * Set the value of id_commande
     *
     * @return  self
     */
    public function setId_commande($id_commande)
    {
        $this->id_commande = $id_commande;

        return $this;
    }

    /**
     * Get the value of etat_commande
     */
    public function getEtat_commande()
    {
        return $this->etat_commande;
    }

    /**
     * Set the value of etat_commande
     *
     * @return  self
     */
    public function setEtat_commande($etat_commande)
    {
        $this->etat_commande = $etat_commande;

        return $this;
    }

    /**
     * Get the value of prix_commande
     */
    public function getPrix_commande()
    {
        return $this->prix_commande;
    }

    /**
     * Set the value of prix_commande
     *
     * @return  self
     */
    public function setPrix_commande($prix_commande)
    {
        $this->prix_commande = $prix_commande;

        return $this;
    }

    /**
     * Get the value of num_commande
     */
    public function getNum_commande()
    {
        return $this->num_commande;
    }

    /**
     * Set the value of num_commande
     *
     * @return  self
     */
    public function setNum_commande($num_commande)
    {
        $this->num_commande = $num_commande;

        return $this;
    }

    /**
     * Get the value of prix_total
     */
    public function getPrix_total()
    {
        return $this->prix_total;
    }

    /**
     * Set the value of prix_total
     *
     * @return  self
     */
    public function setPrix_total($prix_total)
    {
        $this->prix_total = $prix_total;

        return $this;
    }

    /**
     * Get the value of date_commande
     */
    public function getDate_commande()
    {
        return $this->date_commande;
    }

    /**
     * Set the value of date_commande
     *
     * @return  self
     */
    public function setDate_commande($date_commande)
    {
        $this->date_commande = $date_commande;

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

    /**
     * Get the value of nb_article
     */
    public function getNb_article()
    {
        return $this->nb_article;
    }

    /**
     * Set the value of nb_article
     *
     * @return  self
     */
    public function setNb_article($nb_article)
    {
        $this->nb_article = $nb_article;

        return $this;
    }

    public function getInfoCommande($id_commande)
    {
        $sql =
            "SELECT commandes.date_commande, commandes.prix_total, adresses.ville, adresses.voie, adresses.voie_sup, adresses.code_postal, articles.titre_article, articles.prix_article, commandes.nb_article, commandes.num_commande
            FROM commandes 
            INNER JOIN articles ON commandes.fk_id_article = articles.id_article 
            INNER JOIN utilisateurs ON commandes.fk_id_utilisateur = utilisateurs.id_utilisateur
            INNER JOIN adresses ON utilisateurs.id_utilisateur = adresses.fk_id_utilisateur
            WHERE commandes.id_commande = $id_commande";
        return $this->requete($sql)->fetchAll();
    }
}
