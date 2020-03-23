<?php

namespace Models;
require_once('libraries/autoload.php');

class CommentManager extends MainModel
{
    protected $table = "comments";

    public function findAllComment(int $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$this->table} WHERE id_targetActor = :id");

        $query->execute([':id' => $id]);

        $item = $query->fetchAll();

        return $item;
    }
    public function findOneComment(int $userId, int $actorId)
    {
        $req = $this->pdo->prepare('SELECT * FROM comments WHERE id_targetUser = ? AND id_targetActor = ?');
        $req->execute(array($userId, $actorId));
        $donnees = $req->fetch();
        return $donnees;
    }

    public function postComment(int $actorId, int $userId, string $content)
    {
        $req = $this->pdo->prepare('INSERT INTO comments (id_targetActor, id_targetUser, comment_content, comment_date) VALUES (:id_targetActor, :id_targetUser, :content, NOW())');
        $req->bindValue(':id_targetActor', $actorId, \PDO::PARAM_INT);
        $req->bindValue(':id_targetUser', $userId, \PDO::PARAM_INT);
        $req->bindValue(':content',$content, \PDO::PARAM_STR);
        $affectedLines = $req->execute();
    }

    public function modificationComment(int $actorId, int $userId, string $content)
    {
        $req = $this->pdo->prepare('UPDATE comments SET comment_content = :comment_content WHERE actorId = :actorId AND id_targetUser = :id_targetUser');
        $donnees = $req->execute(array(
            ':comment_content' => $content,
            ':actorId' => $actorId,
            ':id_targetUser' => $userId,
        ));
    }
}

?>