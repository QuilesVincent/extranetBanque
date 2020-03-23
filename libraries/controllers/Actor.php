<?php

namespace Controllers;
require_once('libraries/autoload.php');

class Actor extends Controller
{
    protected $modelName = \Models\ActorManager::class;
    protected $userModelName = \Models\UserManager::class;
    protected $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new $this->userModelName();
    }

    public function showAll()
    {

        $controllerUser = new \Controllers\User();
        //Try to connect user
        $result = $controllerUser->connexion();
        //If result, search all actor and renderer with array of variable and require the page with all actors
        if($result) {
            $pageTitle = "Actor";
            $actors = $this->model->findAll();
            \Renderer::render('parties/allActor', compact("result", "pageTitle", "actors"));
        }
    }

    public function showBack()
    {
        //If previous page was newCom
        if(isset($_POST['submitCom'])){
            $ComController = new \Controllers\Comment();
            $modif = $ComController->insert();
            //we are only on the page of one actor, we can't to be on the page with all actors
            $this->showOneSelected();
        }
        //If previous page was paramUser
        if(isset($_POST['submitChangeUser'])){
            //Create controller User and run modification
            $userController = new \Controllers\User();
            $modif = $userController->modifDonneeUser();
            //If we were on the page of one actor we come back on that
            if(isset($_GET['actor'])) {
                $this->showOneSelected($modif);
                //Else come back on the page with all actor
            } else {
                $this->showAll();
            }
        }
        
    }

    public function showBackAllActor()
    {
        //come back to page actor selected at page all actor
        $pageTitle = "Actor";
        $actors = $this->model->findAll();
        \Renderer::render('parties/allActor', compact("pageTitle", "actors"));
    }

    public function showOneSelected(?string $modif = null)
    {
        $commentModel = new \Models\CommentManager();

        //check get actor
        if(!empty($_GET['actor']) /*&& ctype_digit($_GET['actor'])*/){
            $actorId = $_GET['actor'];
        }
        //search one actor with his id
        $actor = $this->model->find($actorId, "id_actor");
        //search all the commentaires of this actor
        $commentaires = $commentModel->findAllComment($actorId);
        $commentaireAndAuthor = [];
        foreach($commentaires as $commentaire){
            //For each commentaires, search the name of his author in the table user with the id. (if the user change username, the com to)
            $authorCommentaires = $this->userModel->find($commentaire['id_targetUser'], "id_user");
            //check if both id(in the both table commentaires and user) match
            if($authorCommentaires['id_user'] === $commentaire['id_targetUser']){
                //if they match, go add in the array of commentaire wich add in a other array
            array_push($commentaire, $authorCommentaires['userName']);
            array_push($commentaireAndAuthor, $commentaire);
            }
        }
        //particular, if we do a return from page (paramUser) to page of the actor selected and do the change on the session[];
        if($modif != null){
            $result = $this->userModel->find($_GET['user'], 'id_user');
        }

        $pageTitle = $actor['name_actor'];
        \Renderer::render('parties/actorSelected', compact('pageTitle', 'actor', 'actorId', 'commentaireAndAuthor', 'result'));
    }
}














/*
public function showAll()
    {
        $userModel = new \Models\UserManager();
        if(isset($_POST['firstNameInscription'])){
            $add = $userModel->addUser($_POST['lastNameInscription'], $_POST['firstNameInscription'], $_POST['userNameInscription'], $_POST['passwordInscription'], $_POST['secretQuestion'], $_POST['answerSecretQuestion']);
            $result = $userModel->getUser($_POST['userNameInscription'], $_POST['passwordInscription']);
        }else{
            $result = $userModel->getUser($_POST['userNameConnexion'], $_POST['passwordConnexion']);
        }
        
        if($result){
            $pageTitle = "Actor";
            $actors = $this->model->findAll();
            \Renderer::render('parties/allActor', compact("result","pageTitle", "actors"));
        }
    }



public function showAll()
    {
        if(session_id() != ''){
            $userModel = new \Models\UserManager();
            if(isset($_POST['firstNameInscription'])){
                $add = $userModel->addUser($_POST['lastNameInscription'], $_POST['firstNameInscription'], $_POST['userNameInscription'], $_POST['passwordInscription'], $_POST['secretQuestion'], $_POST['answerSecretQuestion']);
                $result = $userModel->getUser($_POST['userNameInscription'], $_POST['passwordInscription']);
            }else{
                $result = $userModel->getUser($_POST['userNameConnexion'], $_POST['passwordConnexion']);
            }
            if(!$result){
                $pageTitle = "Accueil";
                \Http::redirect('index.php?err=1');
            }
            $pageTitle = "Actor";
            $actors = $this->model->findAll();
            \Renderer::render('parties/allActor', compact("result","pageTitle", "actors"));
            }
        \Http::redirect("index.php?controller=actor&task=showAll&user=". $_GET['user']);
    }
    
*/