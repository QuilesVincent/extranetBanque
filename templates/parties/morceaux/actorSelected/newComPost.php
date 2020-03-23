<?php
session_start();
require_once('../controllers/controleur.php');
$idActor = $_GET['actor'];
$idUser = $_GET['user'];
$content = $_POST['contentCom'];
$page = $_GET['page'];

if(empty($content)) {
    header("Location:newCom.php?actor=$idActor&user=$idUser&page=$page&ec=o");
} else {
    $req = $userObj->getUserUserName($idUser);
    $donnees = $req->fetch();
    //Appel de la fonction pour poster les commentaires.On vérifiera dans cette fonction que l'user n'a pas déjà posté un commentaire sur cet acteur
    //Ceci avant d'effectuer le post.
    $affectedLines = $actorComment->postComment($idActor,$idUser, $content);
    if(empty($affectedLines)){
        header("Location:newCom.php?actor=$idActor&user=$idUser&page=$page&com=n");

    } else {
        header("Location:acteur.php?actor=$idActor&user=$idUser&page=$page");
    }
}





?>