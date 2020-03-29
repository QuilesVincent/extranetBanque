<?php

namespace Models;
require_once('../libraries/autoload.php');

class LikeManager extends \Models\MainModel
{
    protected $table = "likeactor";

    public function findLike(int $idActor, int $idUser)
    {
        $req = $this->pdo->prepare('SELECT * FROM likeactor WHERE id_targetActorLike = ? AND id_targetUserLike = ?');
        $req->execute(array($idActor, $idUser));
        $donnees = $req->fetch();
        return $donnees;
    }


    public function postLike(int $idActor, int $idUser)
    {
            $req = $this->pdo->prepare('INSERT INTO likeactor(id_targetActorLike, id_targetUserLike, like_number) VALUES(:id_targetActorLike, :id_targetUserLike, :like_number)');
            $req->bindValue(':id_targetActorLike', $idActor, \PDO::PARAM_INT);
            $req->bindValue(':id_targetUserLike', $idUser, \PDO::PARAM_INT);
            $req->bindValue(':like_number', 1, \PDO::PARAM_INT);
            $req->execute();
    }
    
    public function deleteLike(int $idActor, int $idUser)
    {
        $req = $this->pdo->prepare('DELETE FROM likeactor WHERE id_targetActorLike = ? AND id_targetUserLike = ?');
        $affectedLines = $req->execute(array($idActor,$idUser));
    }
}

?>