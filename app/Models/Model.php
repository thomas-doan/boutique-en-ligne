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
    public function requete(string $sql,  $attributs = null)
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
    /*     public function find(array  $donnees = Null)

    {
        $req = "SELECT * FROM {$this->table} WHERE {$this->id} = :{$this->id}";
        return $this->requete($req, $donnees)->fetch();
    } */

    /**
     * Methode qui permet de récupérer tout les enregistrements d'une table
     *
     * @return array
     */
    public function findAll()
    {
        $req = "SELECT * FROM  {$this->table}";
        $query = $this->requete($req);
        return $query->fetchAll();
    }

    // Permet de récupperer un ou plusieur enregistrement en fonction de criteres
    public function find(array $criteres, array $donnees, array $selection = Null)
    {

        // Récupére la valeur
        $champs = [];

        // On boucle pour éclater le tableau
        foreach ($criteres as $valeur) {

            $champs[] = "$valeur = :$valeur";
            // valeur = valeur associé à l'index

        }
        // On transforme le tableau champs en une string
        $liste_champs = implode(' AND ', $champs);

        if ($selection == Null) {

            $req = "SELECT * FROM $this->table WHERE $liste_champs";

            var_dump($req);
            // On exécute la requête 
            return $this->requete($req, $donnees)->fetchAll();
        } else {

            $selections = [];

            // On boucle pour éclater le tableau
            foreach ($selection as $valeur) {

                $selections[] = "$valeur = :$valeur";
                // valeur = valeur associé à l'index

                // On transforme le tableau champs en une string
                $liste_selections = implode(',', $selections);
            }

            $req = "SELECT $liste_selections FROM $this->table WHERE $liste_champs";

            var_dump($req);
            // On exécute la requête 
            return $this->requete($req, $donnees)->fetchAll();
        }
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
        $req = "UPDATE  $this->table SET  $liste_champs WHERE {$this->id} = ?";
        return $this->requete($req, $valeurs);
    }

    // DELETE
    public function delete(array $donnees = Null)
    {
        $req = "DELETE FROM {$this->table} WHERE {$this->id} =:{$this->id}";
        return $this->requete($req, $donnees);
    }
}
