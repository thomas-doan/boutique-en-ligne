<?php

namespace App\Models;

class Commandes extends Model

{
    protected $table = 'commandes';
    protected $id = 'id_commande';
    protected $id_commande;
    protected $fk_id_num_commande;
    protected $fk_id_article;
    protected $nb_article;
    protected $prix_article;
    protected $prix_commande;


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
     * Get the value of fk_id_num_commande
     */
    public function getFk_id_num_commande()
    {
        return $this->fk_id_num_commande;
    }

    /**
     * Set the value of fk_id_num_commande
     *
     * @return  self
     */
    public function setFk_id_num_commande($fk_id_num_commande)
    {
        $this->fk_id_num_commande = $fk_id_num_commande;

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
     * Get the value of prix_article
     */
    public function getPrix_article()
    {
        return $this->prix_article;
    }

    /**
     * Set the value of prix_article
     *
     * @return  self
     */
    public function setPrix_article($prix_article)
    {
        $this->prix_article = $prix_article;

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
