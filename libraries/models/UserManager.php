<?php

namespace Models;
require_once('../libraries/autoload.php');

class UserManager extends \Models\MainModel
{
    protected $table = "user";

    public function getUser(string $userName, string $userPassword)
    {
        //$passwordCryptUser = password_hash($passwordUser, PASSWORD_DEFAULT);
        $req = $this->pdo->prepare('SELECT * FROM user WHERE userName = :userName');
        $req->execute(array(
            ':userName' => $userName
        ));
        $resp = $req->fetch();
        if(password_verify($userPassword, $resp['userPassword'])){
            return $resp;
        }else{
            return false;
        }
    }
    //Function pour vérifier la validité d'un user en fonction de : username, secretQuestion et secretQuestionAnswser
    public function getUserResetPass(string $userName, int $secretQuestion, string $secretQuestionAnswer)
    {
        $req = $this->pdo->prepare('SELECT * FROM user WHERE userName = :userName AND secretQuestion = :secretQuestion AND secretQuestionAnswer = :secretQuestionAnswer');
        $req->execute(array(
            ':userName' => $userName,
            ':secretQuestion' => $secretQuestion,
            ':secretQuestionAnswer' => $secretQuestionAnswer
        ));
        return $req;
    }

    //Function pour ajouter un user
    public function addUser(string $lastName, string $firstName, string  $userName, string $password, int $secretQuestion, string $secretQuestionAnswer): void
    {
        $passwordCrypt = password_hash($password, PASSWORD_DEFAULT);
        $req = $this->pdo->prepare('INSERT INTO user (lastName, firstName, userName, userPassword, secretQuestion, secretQuestionAnswer) VALUES (:lastName, :firstName, :userName, :userPassword, :secretQuestion, :secretQuestionAswer)');
        $req->bindValue(':lastName',$lastName, \PDO::PARAM_STR);
        $req->bindValue(':firstName',$firstName, \PDO::PARAM_STR);
        $req->bindValue(':userName',$userName, \PDO::PARAM_STR);
        $req->bindValue(':userPassword',$passwordCrypt, \PDO::PARAM_STR);
        $req->bindValue(':secretQuestion',$secretQuestion, \PDO::PARAM_STR);
        $req->bindValue(':secretQuestionAswer',$secretQuestionAnswer, \PDO::PARAM_STR);

        $req->execute();
    }
    //Function pour modifier le password d'un user
    public function modificationUserPassword(string $userName, string $secretQuestionAnswer, string $password): void
    {
        $passwordCrypt = password_hash($password, PASSWORD_DEFAULT);
        $req = $this->pdo->prepare('UPDATE user SET userPassword = :newUserPassword WHERE userName = :userName AND secretQuestionAnswer = :secretQuestionAnswer');
        $donnees = $req->execute(array(
            ':newUserPassword' => $passwordCrypt,
            ':userName' => $userName,
            ':secretQuestionAnswer' => $secretQuestionAnswer,
        ));
    }
    //Function pour modifier les informations de comptes d'un user
    public function modificationUserInformation(string $newLastName, string $newFirstName, string $newUserName, string $newUserPassword, int $newSecretQuestion, string $newSecretQuestionAnswer, int $idUser): void
    {
        
        $newPasswordCrypt = password_hash($newUserPassword, PASSWORD_DEFAULT);

        $req = $this->pdo->prepare("UPDATE user SET lastName = :newLastName, firstName = :newFirstName, userName = :newUserName, userPassword = :newUserPassword, secretQuestion = :newSecretQuestion, secretQuestionAnswer = :newSecretQuestionAnswer WHERE id_user = :idUser");
        
        $req->bindValue(':newLastName', $newLastName, \PDO::PARAM_STR);
        $req->bindValue(':newFirstName', $newFirstName, \PDO::PARAM_STR);
        $req->bindValue(':newUserName', $newUserName, \PDO::PARAM_STR);
        $req->bindValue(':newUserPassword', $newPasswordCrypt, \PDO::PARAM_STR);
        $req->bindValue(':newSecretQuestion', $newSecretQuestion, \PDO::PARAM_STR);
        $req->bindValue(':newSecretQuestionAnswer', $newSecretQuestionAnswer, \PDO::PARAM_STR);
        $req->bindValue(':idUser', $idUser, \PDO::PARAM_INT);

        $req->execute();
    }

}