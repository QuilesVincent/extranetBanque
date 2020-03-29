<?php

namespace Controllers;
require_once('../libraries/autoload.php');

class User extends \Controllers\Controller
{
    protected $modelName = \Models\UserManager::class;

    public function __construct(){
        parent::__construct();
    }

    public function connexion()
    {
        //if post inscription check if all field aren't empty ; if empty redirect accueil with notation field is empty
        if(isset($_POST['submitInscription'])){
            if (empty($_POST['lastNameInscription']) || empty($_POST['firstNameInscription']) || empty($_POST['userNameInscription']) || empty($_POST['passwordInscription']) || empty($_POST['secretQuestion']) || empty($_POST['answerSecretQuestion'])) {
                \Http::redirect('index.php?fieldR=y');
            }
            //check userName is free ? adding : redirect with notation userName no free
            $verif = $this->model->find($_POST['userNameInscription'], 'userName');
            if(empty($verif)) {
                $add = $this->model->addUser($_POST['lastNameInscription'], $_POST['firstNameInscription'], $_POST['userNameInscription'], $_POST['passwordInscription'], $_POST['secretQuestion'], $_POST['answerSecretQuestion']);
                $result = $this->model->getUser($_POST['userNameInscription'], $_POST['passwordInscription']);
            } else {
                \Http::redirect('index.php?userName=no');
            }
            //if connexion, check with user post connexion
        } elseif(isset($_POST['submitConnexion'])) {
            //check information
            $result = $this->model->getUser($_POST['userNameConnexion'], $_POST['passwordConnexion']);
            //If not found, not good paswword or username, so redirect
            empty($result) ? \Http::redirect('index.php?errConnexion=y') : '';
        } else {
            //If not post connexion or inscription, it's a (retour en arrière), so create variable result with get
            $result = $this->model->find($_GET['user'], 'id_user');
        }
        //Return the informations
        return $result;
    }

    public function modifPassword()
    {
        $userName = $_POST['userName'];
        $secretQuestion = $_POST['secretQuestion'];
        $secretQuestionAnswer = $_POST['secretQuestionAnswer'];
        $password = $_POST['password'];
        //Check all field aren't empty and if empty, redirect on the page with notation get
        if(empty($userName) || empty($secretQuestion) || empty($secretQuestionAnswer) || empty($password)){
            \Http::redirect("index.php?controllers=afficheur&task=afficheResetPassword&emptyField=y");
        }
        //Vérification des données de l'utilisateur pur être sur qu'il existe, avant de faire les modifications
        $req = $this->model->getUserResetPass($userName, $secretQuestion, $secretQuestionAnswer);
        if(empty($req))
        {
            //If not good redirect with notation get
            \Http::redirect("index.php?controllers=afficheur&task=afficheResetPassword&errP=y");
        }
        else
        {
            //If good, redirect on the accueil with success message
            $reqPass = $this->model->modificationUserPassword($userName,$secretQuestionAnswer, $password);
            \Http::redirect("index.php?modifP=y");;
        }
    }

    public function modifDonneeUser()
    {
        $newUserName = $_POST['userNameChangeUser'];
        $newFirstName = $_POST['firstNameChangeUser'];
        $newLastName = $_POST['lastNameChangeUser'];
        $newUserPassword = $_POST['passwordChangeUser'];
        $newSecretQuestion = $_POST['secretQuestionChangeUser'];
        $newSecretQuestionAnswer = $_POST['secretQuestionAnswerChangeUser'];
        $idUser = $_GET['user'];
        $idUserSafe = htmlspecialchars($_GET['user']);
        //Check if previous page is an actor selected to choose the redirection after execute program
        if(isset($_GET['actor'])){
            $actorSafe = htmlspecialchars($_GET['actor']);
        };
        //Check if all fields aren't empty ; if they are, redirect with notation get (attention, actor or not, refer previously);
        if (empty($newFirstName) || empty($newLastName) || empty($newUserName) || empty($newUserPassword) || empty($newSecretQuestionAnswer)) {
            if(isset($_GET['actor'])) {
                \Http::redirect("index.php?controllers=afficheur&task=afficheChangeDonneUser&actor=$actorSafe&user=$idUserSafe&field=empty");
            }
            \Http::redirect("index.php?controllers=afficheur&task=afficheChangeDonneUser&user=$idUserSafe&field=empty");
        } else {
            //Check if userName is free.
            $reqVerif = $this->model->find($newUserName, "userName");
            //If he is free, do
            if(empty($reqVerif)) {
                $req = $this->model->modificationUserInformation($newLastName, $newFirstName, $newUserName, $newUserPassword, $newSecretQuestion, $newSecretQuestionAnswer, $idUserSafe);
            //Else, redirect with notation get (attention, actor or not, refer previously);
            } else {
                if(isset($_GET['actor'])){
                    \Http::redirect("index.php?controllers=afficheur&task=afficheChangeDonneUser&actor=$actorSafe&user=$idUser&uname=notFree");
                }
                \Http::redirect("index.php?controllers=afficheur&task=afficheChangeDonneUser&user=$idUserSafe&uname=notFree");
            }
        }
        return true;
    }

    public function logOut()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
        \Http::redirect('index.php');
    }
}