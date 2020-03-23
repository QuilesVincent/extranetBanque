<?php

session_start();
require('../controllers/controleur.php');

$idUser = $_GET['user'];
$page = $_GET['page'];
$idUserSafe = htmlspecialchars($idUser);
$pageSafe = htmlspecialchars($page);
$userName = $_SESSION['userName'];
$newFirstName = $_POST['firstNameChangeUser'];
$newLastName = $_POST['lastNameChangeUser'];
$newUserName = $_POST['userNameChangeUser'];
$newUserPassword = $_POST['passwordChangeUser'];
$newSecretQuestion = $_POST['secretQuestionChangeUser'];
$newSecretQuestionAnswer = $_POST['secretQuestionAnswerChangeUser'];

if (empty($newFirstName) || empty($newLastName) || empty($newUserName) || empty($newUserPassword) || empty($newSecretQuestionAnswer)) {
    $missDonnee = 'mdic=o';
    header("Location:paramUser.php?user=$idUserSafe&page=$pageSafe&$missDonnee");
} else {
    //Vérification d'une possible utilisation de l'username. Si aucune donnée trouvé, l'username est donc disponible
    $reqVerif = $userObj->getUser($newUserName);
    $donnees = $reqVerif->fetch();
    if(empty($donnees))
    {
        $req = $userObj->modificationUserInformation($newLastName, $newFirstName,  $newUserName, $newUserPassword, $newSecretQuestion, $newSecretQuestionAnswer, $_SESSION['userName']);
        header("Location:../partie_2_accueil/accueil.php?user=$idUserSafe&page=$pageSafe");
    }
    else
    {
        header("Location:paramUser.php?user=$idUserSafe&page=$pageSafe&unf=o");
    }
}







