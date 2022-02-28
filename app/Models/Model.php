<?php

namespace App\Models;



use Database\DBConnection;
use PDO;

abstract class Model
{

    protected $db;
    protected $table;
    protected $id;



    public function __construct(DBConnection $db)
    {
        $this->db = $db;
    }



    // $sql comptient toute la requête et $attributs comptient autant d'attributs qu'il y a de point d'interrogation
    // Methode qui permet de faire une requete prepare ou non, en fonction
    public function requete(string $sql, array $attributs = null)
    {

        // On vérifie si on a des attributs
        if ($attributs !== null) {
            //Requête préparée
            $query = $this->db->getPDO()->prepare($sql);
            $query->execute($attributs);
            return $query;
        } else {
            // Requête simple
            return $this->db->getPDO()->query($sql);
        }
    }

    // READ
    /** 
     * Modification de la requete findBy en attente de version de Thomas
     * @param string Specification d'une colonne à retourner, par default vaut *
     * @param int id
     * @return array||string sir la requête est soumise à une seul colonne
     */
    public function findById(?string $colonne= '*',int $id)
    {
        return $this->requete("SELECT $colonne FROM $this->table WHERE id = $id")->fetch();
    }

    public function find(int $id)
    {
        return $this->requete("SELECT * FROM {$this->table} WHERE {$this->id} = $id")->fetch();
    }

    /**
     * Methode qui permet de récupérer tout les enregistrements d'une table
     *
     * @return array
     */
    public function findAll()
    {
        $query = $this->requete("SELECT * FROM  {$this->table} ");
        return $query->fetchAll();
    }

    // Permet de récupperer un ou plusieur enregistrement en fonction de criteres
    public function findBy(array $criteres)
    {
        // Récupére l'index
        $champs = [];
        // Récupére la valeur
        $valeurs = [];

        // On boucle pour éclater le tableau
        foreach ($criteres as $champ => $valeur) {
            // Champ = index
            $champs[] = "$champ = ?";
            // valeur = valeur associé à l'index
            $valeurs[] = $valeur;
        }
        // On transforme le tableau champs en une string
        $liste_champs = implode(' AND ', $champs);

        // On exécute la requête 
        return $this->requete('SELECT * FROM ' . $this->table . ' WHERE ' . $liste_champs, $valeurs)->fetchAll();
    }

    // CREATE
    public function create(Model $model)
    {
        // Récupére l'index
        $champs = [];
        // liste des points d'intérogation pour la requête aussi long que la listre des champs
        $inter = [];
        // Récupére la valeur
        $valeurs = [];

        // On boucle pour éclater le tableau
        foreach ($model as $champ => $valeur) {
            if ($valeur != null && $champ != 'db' && $champ != 'table') {
                // Champ = index
                $champs[] = $champ;
                $inter[] = "?";
                // valeur = valeur associé à l'index
                $valeurs[] = $valeur;
            }
        }
        // On transforme le tableau champs en string
        $liste_champs = implode(', ', $champs);
        $liste_inter = implode(', ', $inter);

        // On exécute la requête 
        return $this->requete('INSERT INTO ' . $this->table . ' (' . $liste_champs . ')VALUES(' . $liste_inter . ')', $valeurs);
    }

    // HYDRATATION
    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value) {
            // On récupère le nom du setter correspondant à la clé(key)
            // titre -> setTitre
            $setter = 'set' . ucfirst($key);
            // On vérifie si le setter existe
            if (method_exists($this, $setter)) {
                // On appelle le setter
                $this->$setter($value);
            }
        }
        return $this;
    }

    // UPDATE
    public function update(int $id, Model $model)
    {
        // Récupére l'index
        $champs = [];

        // Récupére la valeur
        $valeurs = [];

        // On boucle pour éclater le tableau
        foreach ($model as $champ => $valeur) {
            if ($valeur !== null && $champ != 'db' && $champ != 'table') {
                // Champ = index
                $champs[] = "$champ = ?";
                // valeur = valeur associé à l'index
                $valeurs[] = $valeur;
            }
        }
        $valeurs[] = $id;
        // On transforme le tableau champs en string
        $liste_champs = implode(', ', $champs);

        // On exécute la requête 
        return $this->requete("UPDATE  $this->table SET  $liste_champs WHERE {$this->id} = ?", $valeurs);
    }

    // DELETE
    public function delete(int $id)
    {
        return $this->requete("DELETE FROM {$this->table} WHERE {$this->id} = ?", [$id]);
    }

    //MORE
    /**
     * Retoune l'integralité des informations de colonnes d'une table donné
     * @param string nom de la table
     * @return array retourne les information sous la forme d'un tableau
     */
    protected function show_column($table)
    {
        $result = $this->requete("SHOW COLUMNS FROM `$table`");
        $result->fetchAll();
        
        return $result;
    }
}
