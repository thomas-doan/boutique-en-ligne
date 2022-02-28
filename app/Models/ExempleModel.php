<?php

namespace App\Models;



class ExempleModel extends Model

{


    protected $table = 'articles';
    protected $id = 'id_article';
    protected $id_article;
    private $titre;
    private $presentation_article;
    private $description_article;
    private $prix_article;
    private $image_article;
    private $sku;
    private $fournisseur;
    private $conditionnement;

    /**
     * Get the value of id_article
     */
    public function getId_article()
    {
        return $this->id_article;
    }

    /**
     * Set the value of id_article
     *
     * @return  self
     */
    public function setId_article($id_article)
    {
        $this->id_article = $id_article;

        return $this;
    }


    /**
     * Get the value of titre
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get the value of presentation_article
     */
    public function getPresentation_article()
    {
        return $this->presentation_article;
    }

    /**
     * Set the value of presentation_article
     *
     * @return  self
     */
    public function setPresentation_article($presentation_article)
    {
        $this->presentation_article = $presentation_article;

        return $this;
    }

    /**
     * Get the value of description_article
     */
    public function getDescription_article()
    {
        return $this->description_article;
    }

    /**
     * Set the value of description_article
     *
     * @return  self
     */
    public function setDescription_article($description_article)
    {
        $this->description_article = $description_article;

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

    /**
     * Get the value of image_article
     */
    public function getImage_article()
    {
        return $this->image_article;
    }

    /**
     * Set the value of image_article
     *
     * @return  self
     */
    public function setImage_article($image_article)
    {
        $this->image_article = $image_article;

        return $this;
    }

    /**
     * Get the value of sku
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Set the value of sku
     *
     * @return  self
     */
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * Get the value of fournisseur
     */
    public function getFournisseur()
    {
        return $this->fournisseur;
    }

    /**
     * Set the value of fournisseur
     *
     * @return  self
     */
    public function setFournisseur($fournisseur)
    {
        $this->fournisseur = $fournisseur;

        return $this;
    }

    /**
     * Get the value of conditionnement
     */
    public function getConditionnement()
    {
        return $this->conditionnement;
    }

    /**
     * Set the value of conditionnement
     *
     * @return  self
     */
    public function setConditionnement($conditionnement)
    {
        $this->conditionnement = $conditionnement;

        return $this;
    }


    public function find_article($sql)
    {

        $query = $this->db->getPDO()->prepare("

     SELECT articles.id_article, articles.titre_article, articles.presentation_article, articles.prix_article, articles.image_article, `cat1`.nom_categorie AS 'sous cat', `cat2`.`nom_categorie` AS 'cat parent', 'categorie' AS 'type'
            FROM articles
            INNER JOIN articles_categories_filtre ON articles_categories_filtre.fk_id_article = articles.id_article
            INNER JOIN categories AS `cat1` ON articles_categories_filtre.fk_id_cat_categorie = `cat1`.id_categorie 
            INNER JOIN categories AS `cat2` ON articles_categories_filtre.id_parent = `cat2`.id_categorie 
            OR articles_categories_filtre.id_parent = `cat1`.id_categorie
            WHERE MATCH(`cat2`.nom_categorie) AGAINST (:nom_categorie) OR MATCH(`cat1`.nom_categorie) AGAINST (:nom_categorie)

UNION ALL

SELECT `art1`.id_article, `art1`.titre_article, `art1`.presentation_article, `art1`.prix_article, `art1`.image_article, `cat1`.nom_categorie AS 'sous cat', `cat2`.`nom_categorie` AS 'cat parent', 'article' AS 'type'
            FROM articles_categories_filtre
            INNER JOIN articles AS `art1` ON articles_categories_filtre.fk_id_article = `art1`.`id_article`
            INNER JOIN categories AS `cat1` ON articles_categories_filtre.fk_id_cat_categorie = `cat1`.id_categorie
            INNER JOIN categories AS `cat2` ON articles_categories_filtre.id_parent = `cat2`.id_categorie
    WHERE  MATCH (`art1`.titre_article  ) AGAINST (:titre_article ) OR MATCH(`art1`.presentation_article) AGAINST (:presentation_article)

UNION ALL

SELECT articles.id_article, articles.titre_article, articles.presentation_article, articles.prix_article, articles.image_article, `cat1`.nom_categorie AS 'sous cat', `cat2`.`nom_categorie` AS 'cat parent', 'tag' AS 'type'
            FROM articles
            INNER JOIN articles_tags ON articles_tags.fk_id_article = articles.id_article
            INNER JOIN articles_categories_filtre ON articles.id_article = articles_categories_filtre.fk_id_article
            INNER JOIN categories AS `cat1` ON articles_categories_filtre.fk_id_cat_categorie = `cat1`.id_categorie
            INNER JOIN categories AS `cat2` ON articles_categories_filtre.id_parent = `cat2`.id_categorie   
            INNER JOIN tag ON tag.id_tag = articles_tags.fk_id_tag
             WHERE  MATCH (tag.nom_tag) AGAINST (:nom_tag);

         ");

        $query->setFetchMode(\PDO::FETCH_ASSOC);
        $query->execute(array(
            ":nom_categorie" => "%$sql%",
            ":presentation_article" => "%$sql%",
            ":titre_article" => "%$sql%",
            ":nom_tag" => "%$sql%"
        ));
        $article = $query->fetchall();

        return $article;
    }

    public function findId()
    {
        $query = $this->requete("SELECT id_article FROM  {$this->table} ");
        return $query->fetchAll();
    }
}
