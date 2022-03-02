<?php

namespace models;

use Database\DBconnection;

abstract class Model
{

    protected $pdo;
    protected $table;
    protected $id;

    public function __construct()
    {
        $this->pdo = DBConnection::getPdo();
    }


    public function find(int $id)
    {

        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $query->execute(compact('id'));
        $item = $query->fetch(\PDO::FETCH_ASSOC);

        return $item;
    }


    public function delete(int $id): void
    {


        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute(compact('id'));
    }



    public  function findAll(?string $order = ""): array
    {

        $sql = "SELECT * FROM {$this->table}";

        if ($order) {
            $sql .= " ORDER BY " . $order;
        }
        $resultats = $this->pdo->query($sql);
        // On fouille le résultat pour en extraire les données réelles
        $items = $resultats->fetchAll(\PDO::FETCH_ASSOC);
        return $items;
    }




    public function insert(array $sql, ?string $variable_addtionnelle, $tbl): void
    {

        $sql_def = \Tool::util($sql);


        if (!empty($variable_addtionnelle)) {
            $query = $this->pdo->prepare("INSERT INTO {$this->table} SET $sql_def, $variable_addtionnelle");
        }

        if (empty($variable_addtionnelle)) {
            $query = $this->pdo->prepare("INSERT INTO {$this->table} SET $sql_def, created_at = NOW()");
        }
        $query->execute($tbl);
    }


    public function update(array $sql, ?string $variable_addtionnelle, $tbl): void
    {

        $sql_def = \Tool::util($sql);


        if (!empty($variable_addtionnelle)) {
            $query = $this->pdo->prepare("UPDATE  {$this->table} SET $sql_def, $variable_addtionnelle");
        }

        if (empty($variable_addtionnelle)) {
            $query = $this->pdo->prepare("UPDATE  {$this->table} SET $sql_def, Where {$this->id} ");
        }
        $query->execute($tbl);
    }
}
