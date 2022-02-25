<?php

namespace App\Models;

use App\Core\Db;

class Model extends Db
{
    //Propriété contenant la Table de la BDD
    protected $table;

    // Propriété contenant l'instance de Db
    private $db;

    // $sql comptient toute la requête et $attributs comptient autant d'attributs qu'il y a de point d'interrogation
    // Methode qui permet de faire une requete prepare ou non, en fonction
    public function requete(string $sql, array $attributs = null)
    {
        // On récupère l'instance de Db
        $this->db = Db::getInstance();

        // On vérifie si on a des attributs
        if ($attributs !== null) {
            //Requête préparée
            $query = $this->db->prepare($sql);
            $query->execute($attributs);
            return $query;
        } else {
            // Requête simple
            return $this->db->query($sql);
        }
    }

    // READ
    public function findById(?string $colonne= '*',int $id)
    {
        return $this->requete("SELECT $colonne FROM $this->table WHERE id = $id")->fetch();
    }

    /**
     * Methode qui permet de récupérer tout les enregistrements d'une table
     *
     * @return array
     */
    public function findAll()
    {
        $query = $this->requete('SELECT * FROM ' . $this->table);
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
    /**
     * Insertion à partir des attribue
     * @param array Model envoie directement le model et ses attributs.
     * @return requête  
     */
    
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
        return $this->requete('UPDATE ' . $this->table . ' SET ' . $liste_champs . 'WHERE id = ?', $valeurs);
    }

    // DELETE
    public function delete(int $id)
    {
        return $this->requete("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

        /**
     * Récupère tout les colonnes dans un tableau
     * @param string le nom de la table
     * @return array Retourn un tableau comprennant toute les informations concernant la table
     */
    protected function show_column($table)
    {
        $result = $this->requete("SHOW COLUMNS FROM `$table`");
        $result->fetchAll();
        
        return $result;
    }
}
