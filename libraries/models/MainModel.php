<?php

namespace Models;
require_once 'libraries/autoload.php';

abstract class MainModel
{
    protected $pdo;
    protected $table;

    public function __construct()
    {
        $this->pdo = \DBManager::dbConnect();
    }

    public function findAll(): array
    {;
        $query = $this->pdo->query("SELECT * FROM {$this->table}");
        $item = $query->fetchAll();
        return $item;
    }
    public function find($id, $idTarget)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE $idTarget = :id");

    // On exécute la requête en précisant le paramètre :article_id
        $query->execute([':id' => $id]);

    // On fouille le résultat pour en extraire les données réelles de l'article
        $item = $query->fetch();

        return $item;
    }
    public function delete(int $id): void
    {
        $query = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $query->execute([':id' => $id]);
    }
}
