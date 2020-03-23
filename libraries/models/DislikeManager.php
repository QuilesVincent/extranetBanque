<?php

namespace Models;
require_once('libraries/autoload.php');

class DislikeManager extends \Models\MainModel
{
    protected $table = "dislikeactor";
    
    public function findDislike(int $idActor, int $idUser)
    {
        $req = $this->pdo->prepare('SELECT * FROM dislikeactor WHERE id_targetActorDislike = ? AND id_targetUserDislike = ?');
        $req->execute(array($idActor, $idUser));
        $donnees = $req->fetch();
        return $donnees;
    }

    public function postDislike(int $idActor, int $idUser)
    {
            $req = $this->pdo->prepare('INSERT INTO dislikeactor(id_targetActorDislike, id_targetUserdisLike, dislike_number) VALUES(:id_targetActorDislike, :id_targetUserdisLike, :dislike_number)');
            $req->bindValue(':id_targetActorDislike', $idActor, \PDO::PARAM_INT);
            $req->bindValue(':id_targetUserdisLike', $idUser, \PDO::PARAM_INT);
            $req->bindValue(':dislike_number', 1, \PDO::PARAM_INT);
            $affectedLines = $req->execute();
    }
    
    //Puis on supprime le dislike de l'user connecté si un dislike a bien été trouvé
    public function deleteDisLike(int $idActor, int $idUser)
    {
            $req = $this->pdo->prepare('DELETE FROM dislikeactor WHERE id_targetActorDislike = ? AND id_targetUserDislike = ?');
            $affectedLines = $req->execute(array($idActor,$idUser));
    }

}