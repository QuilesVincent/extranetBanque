<?php

namespace Controllers;

require_once('libraries/autoload.php');

class Like extends Controller
{
    protected $modelName = \Models\LikeManager::class;

    public function __construct()
    {
        parent::__construct();
    }

    public function modification()
    {
        $dislikeModel = new \Models\DislikeManager();
        $modelActor = new \Models\ActorManager();
        //If user send like
        if(isset($_POST['like+'])) {
            //find if a like exist
            $likeReq = $this->model->findLike($_GET['actor'], $_GET['idUser']);
            //If not
            if(empty($likeReq)) {
                //post like and update like in the table actor
                $affectedLines = $this->model->postLike($_GET['actor'], $_GET['idUser']);
                $modelActor->updateLike($_GET['actor'], 1);
                //find if a dislike exist
                $dislikeReq = $dislikeModel->findDislike($_GET['actor'], $_GET['idUser']);
                //If yes
                if(isset($dislikeReq)) {
                    //delete the dislike and update the dislike in the table actor
                    $affectedLinesDislike = $dislikeModel->deleteDislike($_GET['actor'], $_GET['idUser']);
                    $modelActor->updateDislike($_GET['actor'], (-1));
                }
                //if like already exist redirect with a notation get 
            } else {
                \Http::redirect("index.php?controller=actor&task=showOneSelected&actor=" .$_GET['actor']. "&like=not");
            } 
        //If user send dislike
        } else {
            //find if dislike exist
            $dislikeReq = $dislikeModel->findDislike($_GET['actor'], $_GET['idUser']);
            //If not
            if(empty($dislikeReq)) {
                //post dislike and update dislike in the table actor
                $affectedLines = $dislikeModel->postDislike($_GET['actor'], $_GET['idUser']);
                $modelActor->updateDislike($_GET['actor'], 1);
                //find if like existe
                $likeReq = $this->model->findLike($_GET['actor'], $_GET['idUser']);
                //If yes
                if(isset($likeReq)) {
                    //delete the like and update the like in the table actor
                    $affectedLinesDislike = $this->model->deleteLike($_GET['actor'], $_GET['idUser']);
                    $modelActor->updateLike($_GET['actor'], (-1));
                }
                //if dislike already exist redirect with a notation get 
            } else {
                \Http::redirect("index.php?controller=actor&task=showOneSelected&actor=" .$_GET['actor']. "&dislike=not");
            }
        }
        \Http::redirect("index.php?controller=actor&task=showOneSelected&actor=" .$_GET['actor']);
    }
}