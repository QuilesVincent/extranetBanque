<?php

namespace Controllers;
require_once('../libraries/autoload.php');

class User extends \Controllers\Controller
{
    protected $modelName = \Models\UserManager::class;

    public function __construct(){
        parent::__construct();
    }

    public function connexionLogin()
    {
        if(isset($_POST['userNameConnexion']) && isset($_POST['passwordConnexion'])) {
            //check information
            $result = $this->model->getUser($_POST['userNameConnexion'], $_POST['passwordConnexion']);
            //If not found, not good paswword or username, so redirect
            if(empty($result)){
                \Http::redirect('index.php?errConnexion=y');
            } else {
                $_SESSION['connect'] = "yes";
                $_SESSION['id_user'] = $result['id_user'];
                $_SESSION['userName'] = $_POST['userNameConnexion'];
                if(empty($result['lastName'])) {
                    $pageTitle = 'première connexion';
                    \Renderer::render('parties/paramUserPremiereConnexion', compact('result', 'pageTitle'));
                } else {
                    return $result;
                }
            }
        } else {
            $result = $this->model->find($_SESSION['id_user'], "id_user");
            return $result;
        }
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
            $this->model->modificationUserPassword($userName,$secretQuestionAnswer, $password);
            \Http::redirect("index.php?modifP=y");;
        }
    }


    public function modifDonneeUserFirstConnexion()
    {
        $newUserName = $_POST['userNameChangeUser'];
        $newFirstName = $_POST['firstNameChangeUser'];
        $newLastName = $_POST['lastNameChangeUser'];
        $newUserPassword = $_POST['passwordChangeUser'];
        $newSecretQuestion = $_POST['secretQuestionChangeUser'];
        $newSecretQuestionAnswer = $_POST['secretQuestionAnswerChangeUser'];
        $idUser = $_SESSION['id_user'];
        $idUserSafe = htmlspecialchars($idUser);
        
        //Check if all fields aren't empty ; if they are, redirect with notation get (attention, actor or not, refer previously);
        if (empty($newFirstName) || empty($newLastName) || empty($newUserName) || empty($newUserPassword) || empty($newSecretQuestionAnswer)) {
            \Http::redirect("index.php?controllers=afficheur&task=afficheChangeDonneUserPremiereConnexion&user=$idUserSafe&field=empty");
            } else {
            //Check if userName is free.
            $reqVerif = $this->model->find($newUserName, "userName");
            //If he is free, do
            if(empty($reqVerif) || $reqVerif['userName'] === $_SESSION['userName']) {
                $this->model->modificationUserInformation($newLastName, $newFirstName, $newUserName, $newUserPassword, $newSecretQuestion, $newSecretQuestionAnswer, $idUserSafe);
            //Else, redirect with notation get (attention, actor or not, refer previously);
            } else {
                \Http::redirect("index.php?controllers=afficheur&task=afficheChangeDonneUserPremiereConnexion&user=$idUserSafe&uname=notFree");
            }
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
        if(isset($_GET['user'])){
            $idUser = $_GET['user'];
        } else {
            $idUser = $_SESSION['id_user'];
        }
        
        $idUserSafe = htmlspecialchars($idUser);
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
            if(empty($reqVerif) || $reqVerif['userName'] === $_SESSION['userName']) {
                $this->model->modificationUserInformation($newLastName, $newFirstName, $newUserName, $newUserPassword, $newSecretQuestion, $newSecretQuestionAnswer, $idUserSafe);
            //Else, redirect with notation get (attention, actor or not, refer previously);
            } else {
                if(isset($_GET['actor'])){
                    \Http::redirect("index.php?controllers=afficheur&task=afficheChangeDonneUser&actor=$actorSafe&user=$idUser&uname=notFree");
                }
                \Http::redirect("index.php?controllers=afficheur&task=afficheChangeDonneUser&user=$idUserSafe&uname=notFree");
            }
        }
    }

    /*
    public function modifDonneeUser()
    {
        $newUserName = $_POST['userNameChangeUser'];
        $newFirstName = $_POST['firstNameChangeUser'];
        $newLastName = $_POST['lastNameChangeUser'];
        $newUserPassword = $_POST['passwordChangeUser'];
        $newSecretQuestion = $_POST['secretQuestionChangeUser'];
        $newSecretQuestionAnswer = $_POST['secretQuestionAnswerChangeUser'];
        if(isset($_GET['user'])){
            $idUser = $_GET['user'];
        } else {
            $idUser = $_SESSION['id_user'];
        }
        
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
            if($pageTitle === "première connexion"){
                \Http::redirect("index.php?controllers=afficheur&task=afficheChangeDonneUserPremiereConnexion&user=$idUserSafe&field=empty");
            }
            \Http::redirect("index.php?controllers=afficheur&task=afficheChangeDonneUser&user=$idUserSafe&field=empty");
        } else {
            //Check if userName is free.
            $reqVerif = $this->model->find($newUserName, "userName");
            //If he is free, do
            if(empty($reqVerif) || $reqVerif['userName'] === $_SESSION['userName']) {
                $this->model->modificationUserInformation($newLastName, $newFirstName, $newUserName, $newUserPassword, $newSecretQuestion, $newSecretQuestionAnswer, $idUserSafe);
            //Else, redirect with notation get (attention, actor or not, refer previously);
            } else {
                if(isset($_GET['actor'])){
                    \Http::redirect("index.php?controllers=afficheur&task=afficheChangeDonneUser&actor=$actorSafe&user=$idUser&uname=notFree");
                }
                if($pageTitle === "première connexion"){
                    \Http::redirect("index.php?controllers=afficheur&task=afficheChangeDonneUserPremiereConnexion&user=$idUserSafe&field=empty");
                }
                \Http::redirect("index.php?controllers=afficheur&task=afficheChangeDonneUser&user=$idUserSafe&uname=notFree");
            }
        }
    }*/

    public function logOut()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
        \Http::redirect('index.php');
    }
}