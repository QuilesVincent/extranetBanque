<?php

namespace Models;
require_once('../libraries/autoload.php');

class ActorManager extends MainModel
{
    
    protected $table = "acteurpartenaire";
    public function addActor(string $name, string $content): void
    {
        $req = $this->pdo->prepare('INSERT INTO acteurpartenaire (name_actor,presentation_actor,like_actor) VALUES (:name_actor, :presentation_actor,:like_actor)');
        $req->bindValues(':name_actor', $name, PDO::PARAM_STR);
        $req->bindValues(':presentation_actor', $content, PDO::PARAM_STR);
        $req->bindValues(':like_actor', 0, PDO::PARAM_INT);
        $req->bindValues(':dislike_actor', 0, PDO::PARAM_INT);
        $affectedLines = $req->execute();
    }

    public function updateLike(int $actorId, int $update)
    {
        //Search like of the actor with his id in the table actor
        $likeReq = $this->find($actorId, "id_actor");
        //If not like and update less than 0, return false and stop (because an actor cannot have less than 0 like)
        if($likeReq["like_actor"] <= 0 && $update < 0){
            return false;
        }
        //else, do modification
        $likeModification = $likeReq["like_actor"] + $update;
        $req = $this->pdo->prepare('UPDATE acteurpartenaire set like_actor = ? WHERE id_actor = ?');
        $req->execute(array($likeModification, $actorId));
    }
    public function updateDislike(int $actorId, int $update)
    {
        //Search dislike of the actor with his id in the table actor
        $likeReq = $this->find($actorId, "id_actor");
        //If not dislike and update less than 0, return false and stop (because an actor cannot have less than 0 dislike)
        if($likeReq["dislike_actor"] <= 0 && $update < 0){
            return false;
        }
        //else, do modification
        $likeModification = $likeReq["dislike_actor"] + $update;
        $req = $this->pdo->prepare('UPDATE acteurpartenaire set dislike_actor = ? WHERE id_actor = ?');
        $req->execute(array($likeModification, $actorId));
    }
}

?>