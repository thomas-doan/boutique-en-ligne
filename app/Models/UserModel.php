<?php

namespace App\Models;



class UserModel extends Model
{
    protected $table = 'utilisateurs';
    protected $id_utilisateur;
    protected $email;
    protected $prenom;
    protected $nom;
    protected $password;
    protected $role;



    /**
     * Get the value of id_utilisateur
     */
    public function getId_utilisateur()
    {
        return $this->id_utilisateur;
    }

    /**
     * Set the value of id_utilisateur
     *
     * @return  self
     */
    public function setId_utilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;

        return $this;
    }

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of prenom
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of password
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of role
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    public function updateProfil(int $id, Model $model)
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
        return $this->requete('UPDATE ' . $this->table . ' SET ' . $liste_champs . ' WHERE id_utilisateur = ?', $valeurs);
    }
}
