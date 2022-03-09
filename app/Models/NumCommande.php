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


    /**
     * Get the value of id_num_commande
     */
    public function getId_num_commande()
    {
        return $this->id_num_commande;
    }

    /**
     * Set the value of id_num_commande
     *
     * @return  self
     */
    public function setId_num_commande($id_num_commande)
    {
        $this->id_num_commande = $id_num_commande;

        return $this;
    }

    /**
     * Get the value of fk_id_utilisateurs
     */
    public function getFk_id_utilisateurs()
    {
        return $this->fk_id_utilisateurs;
    }

    /**
     * Set the value of fk_id_utilisateurs
     *
     * @return  self
     */
    public function setFk_id_utilisateurs($fk_id_utilisateurs)
    {
        $this->fk_id_utilisateurs = $fk_id_utilisateurs;

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

    /**
     * Get the value of total_produit
     */
    public function getTotal_produit()
    {
        return $this->total_produit;
    }

    /**
     * Set the value of total_produit
     *
     * @return  self
     */
    public function setTotal_produit($total_produit)
    {
        $this->total_produit = $total_produit;

        return $this;
    }

    /**
     * Get the value of tva
     */
    public function getTva()
    {
        return $this->tva;
    }

    /**
     * Set the value of tva
     *
     * @return  self
     */
    public function setTva($tva)
    {
        $this->tva = $tva;

        return $this;
    }

    /**
     * Get the value of prix_sans_tva
     */
    public function getPrix_sans_tva()
    {
        return $this->prix_sans_tva;
    }

    /**
     * Set the value of prix_sans_tva
     *
     * @return  self
     */
    public function setPrix_sans_tva($prix_sans_tva)
    {
        $this->prix_sans_tva = $prix_sans_tva;

        return $this;
    }

    /**
     * Get the value of prix_avec_tva
     */
    public function getPrix_avec_tva()
    {
        return $this->prix_avec_tva;
    }

    /**
     * Set the value of prix_avec_tva
     *
     * @return  self
     */
    public function setPrix_avec_tva($prix_avec_tva)
    {
        $this->prix_avec_tva = $prix_avec_tva;

        return $this;
    }
}
